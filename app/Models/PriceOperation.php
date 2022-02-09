<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceOperation extends Model
{
    use HasFactory;
    protected $fillable = [
        'price_name',
        'price_value',
    ];
}
