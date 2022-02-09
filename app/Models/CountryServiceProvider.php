<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryServiceProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'country_service_provider',
    ];
}
