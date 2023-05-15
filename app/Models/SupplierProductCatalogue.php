<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierProductCatalogue extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'product_code',
        'available_amount',
        'product_id'
    ];
}
