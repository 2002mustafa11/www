<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessorySale extends Model
{
    use HasFactory;
    protected $fillable = ['accessory_id','technician_id', 'quantity','total_price'];

    public function accessory()
    {
        return $this->belongsTo(Accessory::class);
    }
    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }
}
