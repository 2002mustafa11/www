<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salaire extends Model
{
    use HasFactory;

    protected $fillable = ['technician_id', 'money'];
    
    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }
}
