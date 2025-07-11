<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceReceipt extends Model
{
    use HasFactory;

    protected $fillable = ['Cost','SN','box_number','device_type','device_issue','customer_id','notes', 'technician_id', 'status','delivery_date'];

    public function deliveries()
    {
        return $this->hasMany(DeviceDelivery::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }
}


