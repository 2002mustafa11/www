<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePartPurchase extends Model
{
    use HasFactory;

    protected $fillable = ['supplier_id','spare_parts_type','buyer_name','seller_name', 'quantity', 'total_price', 'purchase_date','return'];


    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
