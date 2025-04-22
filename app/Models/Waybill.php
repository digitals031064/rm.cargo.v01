<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Http;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;

class Waybill extends Model
{
    use HasFactory;
    
    protected $fillable =[
        'waybill_no',
        'type',
        'van_no',
        'consignee_id',
        'shipper_id',
        'user_id',
        'shipment',
        'price',
        'cbm',
        'weight',
        'declared_value',
        'status'
    ];

    public function consignee() {
        return $this->belongsTo(Consignee::class);
    }

    public function shipper() {
        return $this->belongsTo(Shipper::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($waybill) {
            if (empty($waybill->waybill_no)) {
                $user = Auth::user(); // Get the currently authenticated user
        
                if (!$user || empty($user->office)) {
                    throw new \Exception('Unable to generate waybill number: user or office not available.');
                }
        
                $office = strtoupper($user->office);
        
                if ($office === 'CEB') {
                    // Waybill starts with 'C'
                    $last = self::where('waybill_no', 'LIKE', 'C%')
                        ->orderByDesc(DB::raw('CAST(SUBSTRING(waybill_no, 2) AS UNSIGNED)'))
                        ->value('waybill_no');
        
                    $number = $last ? ((int) substr($last, 1)) + 1 : 100000;
                    $waybill->waybill_no = 'C' . $number;
        
                } elseif ($office === 'ZAM') {
                    // Waybill starts with 'B'
                    $last = self::where('waybill_no', 'LIKE', 'B%')
                        ->orderByDesc(DB::raw('CAST(SUBSTRING(waybill_no, 2) AS UNSIGNED)'))
                        ->value('waybill_no');
        
                    $number = $last ? ((int) substr($last, 1)) + 1 : 100000;
                    $waybill->waybill_no = 'B' . $number;
        
                } else {
                    // Default numeric waybill for MNL and others
                    $last = self::where('waybill_no', 'NOT LIKE', 'C%')
                        ->where('waybill_no', 'NOT LIKE', 'B%')
                        ->orderByDesc(DB::raw('CAST(waybill_no AS UNSIGNED)'))
                        ->value('waybill_no');
        
                    $number = $last ? ((int) $last) + 1 : 500000;
                    $waybill->waybill_no = (string) $number;
                }
            }
        });

        // Log creation event
        static::created(function ($waybill) {
            self::logActivity($waybill, 'created', 'New waybill created.');
        });

        // Log update event
        static::updated(function ($waybill) {
            self::logActivity($waybill, 'updated', 'Waybill updated.');

            $oldStatus = $waybill->getOriginal('status');
            $newStatus = $waybill->status;
    
            if (strtolower($oldStatus) !== 'arrived in van yard' && strtolower($newStatus) === 'arrived in van yard') {
                self::sendSMS($waybill);
            }
        });

        // Log deletion event
        static::deleted(function ($waybill) {
            self::logActivity($waybill, 'deleted', 'Waybill deleted.');
        });
    }

    protected static function logActivity($waybill, $action, $description)
    {
        ActivityLog::create([
            'user_id' => auth()->id() ?? $waybill->user_id,
            'waybill_id' => $waybill->id,
            'action' => $action,
            'status' => $waybill->status,
            'description' => $description,
        ]);
    }

    protected static function sendSMS($waybill)
    {
        $to = '+639173194129'; // Replace with actual recipient number
        $messageText = "Waybill #{$waybill->waybill_no} has now {$waybill->status}. Track your cargo@rmcargo.com";

        $basic  = new Basic(config('services.vonage.key'), config('services.vonage.secret'));
        $client = new Client($basic);

        try {
            $message = new SMS($to, config('services.vonage.sms_from'), $messageText);
            $client->sms()->send($message);
        } catch (\Exception $e) {
            \Log::error('Vonage SMS failed: ' . $e->getMessage());
        }
    }
}
