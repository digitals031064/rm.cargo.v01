<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    // Specifies which fields are mass assignable
    protected $fillable = ['user_id', 'waybill_id', 'action', 'status', 'description'];

    /**
     * Relationship: An activity log belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: An activity log belongs to a waybill.
     */
    public function waybill()
    {
        return $this->belongsTo(Waybill::class);
    }

}
