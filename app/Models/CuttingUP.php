<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuttingUP extends Model
{
    use HasFactory;
    protected $fillable = ['id','company','model','content'];

}
