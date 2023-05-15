<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\FinancialYear;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use stdClass;

class CpController extends Controller
{
    /**
     * show purchase orders for executives
     */
    public function index()
    {
        $finacialYear = FinancialYear::orderBy('created_at','desc')->first();

        if (!$finacialYear) {
            return view('cp.purchase-order.index')->with('unsuccess','Add Finacial year');
        }
        
        return view('cp.purchase-order.index');
    }

    public function getDat()
    {
        $finacialYear = FinancialYear::orderBy('created_at','desc')->first();

        $purchaseOrders = PurchaseOrder::where('finacial_year','=',$finacialYear->id)
                                        ->orderBy('created_at','desc')
                                        ->get();
        $purchaseOrdersArr = [];

        foreach ($purchaseOrders as $purchaseOrder) {
            $obj = new stdClass;
            $obj->id = $purchaseOrder->id;
            $obj->purchase_order_num = $purchaseOrder->purchase_order_num;
            $obj->facility = Facility::where('id','=',$purchaseOrder->facility_id)->first()->name;
            $obj->finacial_year = FinancialYear::where('id','=',$purchaseOrder->finacial_year)->first()->name;
            $obj->total = number_format($purchaseOrder->total, 2);
            $obj->sub_county = Facility::where('id','=',$purchaseOrder->facility_id)->first()->sub_county;
            $obj->ward = Facility::where('id','=',$purchaseOrder->facility_id)->first()->ward;
            $obj->location = Facility::where('id','=',$purchaseOrder->facility_id)->first()->location;
            $obj->status = $purchaseOrder->status_rest;
            $obj->period = $purchaseOrder->period;
            $obj->date = $purchaseOrder->created_at->toFormattedDateString();
                                
            array_push($purchaseOrdersArr, $obj);
        }
                                
        return response($purchaseOrdersArr);
    }
}
