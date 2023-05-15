<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    protected $fillable = [
        'county_id',
        'subcounty_id',
        'location_id',
        'ward_name'
    ];
}
