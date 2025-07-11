<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceDelivery extends Model
{
    use HasFactory;

    protected $fillable = ['device_receipt_id', 'technician_id', 'customer_id', 'repair_cost','status'];
 public function technician()
    {
        return $this->belongsTo(Technician::class);
    }
    // public function supplier()
    // {
    //     return $this->belongsTo(Supplier::class);
    // }

    // public function purchases()
    // {
    //     return $this->hasMany(SparePartPurchase::class);
    // }
    public function device_receipt()
    {
        return $this->belongsTo(DeviceReceipt::class);
    }

   

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
