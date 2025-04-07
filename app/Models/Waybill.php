<?php

namespace App\Models;

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
        $messageText = "Waybill #{$waybill->id} has now {$waybill->status}.";

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
