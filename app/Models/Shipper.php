<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipper extends Model
{
    protected $fillable = ['name', 'phone_number','shipping_address'];

    public function waybills()
    {
        return $this->hasMany(Waybill::class, 'consignee_id');
    }
}
