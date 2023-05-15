<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountyTopUpRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'facility_product_id'
    ];
}
