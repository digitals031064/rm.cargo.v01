<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consignee extends Model
{
    protected $fillable = ['name', 'phone_number','billing_address'];

    public function waybills()
    {
        return $this->hasMany(Waybill::class, 'consignee_id');
    }
}
