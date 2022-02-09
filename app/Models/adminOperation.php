<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adminOperation extends Model
{
    use HasFactory;
    protected $fillable = [
        'operation_name',
        'operation_value',
    ];
}
