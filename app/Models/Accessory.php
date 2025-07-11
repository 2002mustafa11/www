<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    use HasFactory;
    protected $fillable = ['type','device_type','name', 'price','stock','image'];

    public function accessorySales()
    {
        return $this->hasMany(AccessorySale::class);
    }

}
