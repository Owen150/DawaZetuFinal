<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseOrderDetails = PurchaseOrderDetail::all();
        $products = Product::all();
        return view('purchase-order-detail.index', compact(['purchaseOrderDetails', 'products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('purchase-order.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product_id = $request->product_id;
        $order_id = 2;

        $qty_ordered = $request->qty_ordered;
        $price = $request->price;
        $code = $request->code;
        $total = $request->total;
        

        for ($i=0; $i < count($product_id) ; $i++) { 
            $datasave = [
                'product_id'    => $product_id[$i],
                'order_id'      => $order_id,
                'qty_ordered'   => $qty_ordered[$i],
                'price'         => $price[$i],
                'total'         => $total[$i],
                'code'          => $code[$i],

            ];
        // dd($datasave);

            DB::table('purchase_order_details')->insert($datasave);
        }

        return view('purchase-order.index')->with('message', 'successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseOrderDetail  $purchaseOrderDetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = PurchaseOrder::find($id);
        $products = Product::all();
        $purchaseOrderDetails = PurchaseOrderDetail::all()->where('order_id', $id);
        return view('purchase-order-detail.edit', compact(['order', 'purchaseOrderDetails', 'products']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrderDetail  $purchaseOrderDetail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::all();
        $orderDetails = PurchaseOrderDetail::find($id);
        return view('purchase-order.edit-details', compact(['orderDetails', 'products']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrderDetail  $purchaseOrderDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $orders = PurchaseOrderDetail::find($id);
        $orders->product_id = $request->product_id;
        $orders->batch_number = $request->batch_number;
        $orders->qty_received = $request->qty_received;
        $orders->expiry_date = $request->expiry_date;

        $orderId = $orders->order_id;

        $orders->update();

        return redirect('purchase-order-receive/'.$orderId)->with('status', 'Order details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrderDetail  $purchaseOrderDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrderDetail $purchaseOrderDetail)
    {
        //
    }

    
}
