<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProforma extends Model
{
    use HasFactory;

    protected $fillable = [
        'financial_year_id',
        'facility_id',
        'total',
        'status',
        'lpo',
        'approved_for_supply',
    ];


    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
