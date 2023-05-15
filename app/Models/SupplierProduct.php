<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierProduct extends Model
{
    use HasFactory;


    protected $fillable = [
        'suplier_id',
        'product_id',
        'suplier_product_code',
        'product_price',
    ];


    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
