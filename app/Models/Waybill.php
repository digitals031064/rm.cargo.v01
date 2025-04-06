<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
