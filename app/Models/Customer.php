<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone'];

    public function DeviceDelivery()
    {
        return $this->hasMany(DeviceDelivery::class);
    }

    public function DeviceReceipt()
    {
        return $this->hasMany(DeviceReceipt::class);
    }
}
