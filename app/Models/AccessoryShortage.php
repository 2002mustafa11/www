<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessoryShortage extends Model
{
    use HasFactory;
    protected $fillable = ['type','name', 'price'];

}
