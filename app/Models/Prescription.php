<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'product',
        'quantity',
        'patient_number',
        'patient_name',
        'prescription_date',
        'prescription_cost',
    ];
}
