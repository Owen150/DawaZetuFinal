<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    public function purchaseorderdetails()
    {
        return $this->hasMany(PurchaseOrderDetail::class, 'order_id');
    }

    public function purchaseorder()
    {
        return $this->hasMany(ConsolidatedPurchaseOrder::class, 'purchase_order_id');
    }

    public function facilities()
    {
        return $this->belongsTo(Facility::class, 'facility_id');
    }
}
