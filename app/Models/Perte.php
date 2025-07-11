<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perte extends Model
{
    use HasFactory;
    protected $fillable = ['notes', 'technician_id', 'money'];
    
    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }
}
