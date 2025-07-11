<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone','specialty'];

    public function DeviceReceipt()
    {
        return $this->hasMany(DeviceReceipt::class);
    }
    public function DeviceDelivery()
    {
        return $this->hasMany(DeviceDelivery::class);
    }
    public function AccessorySale()
    {
        return $this->hasMany(AccessorySale::class);
    }
}
