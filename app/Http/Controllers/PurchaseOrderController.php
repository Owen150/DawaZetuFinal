<?php

namespace App\Http\Controllers;

use App\Models\ConsolidatedPurchaseOrder;
use App\Models\DrawingRight;
use App\Models\Facility;
use App\Models\FacilityProduct;
use App\Models\FinancialYear;
use App\Models\InvoiceProforma;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\SupplierProduct;
use App\Models\SupplierProductCatalogue;
use App\Models\UnavailableProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('purchase-order.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userFacility = Auth::user();

        if ($userFacility->role !== 'hfp') {
            return redirect()->back(); 
        }

        $products = Product::all();
        
        $suppliers = Supplier::all();

        $facilities = $userFacility->facility_id;

        $finacialyears = FinancialYear::orderBy('created_at','desc')->get()->last();

        
        $rightsAmount = DrawingRight::where('facility_id', '=', $facilities)
                                    ->where('finacial_year_id','=',$finacialyears->id)
                                    ->where('period','=', getFinacialPeriod())
                                    ->first();
        if (!$rightsAmount) {
            return redirect()->back()->with('unsuccess', 'You need a budget to place order');
        }


        $rightsAmount = $rightsAmount->amount;
                    

        return view('purchase-order.create')->with([
            'products' => $products,
            'facilities'=> $facilities,
            'finacialyears' => $finacialyears,
            'suppliers' => $suppliers,
            'rightsAmt' => $rightsAmount
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //get the first supllier in the rank
        $supplier = Supplier::where('rank','=',1)->first();

        //get the last finacial year
        $finacialYear = FinancialYear::orderBy('created_at', 'desc')->get()->last();

        //get the facility of the user
        $userFacility = Auth::user()->facility_id;

        //stores the next supplier which is rank two
        $nextSupplier = '';

        DB::transaction(function () use($request, $supplier, $finacialYear, $userFacility) {
            $purchaseOrder = new PurchaseOrder();
            $purchaseOrder->facility_id = $userFacility;
            $purchaseOrder->finacial_year = $finacialYear->id;
            $purchaseOrder->total = $request->grand_total;
            $purchaseOrder->period = getFinacialPeriod();
            $purchaseOrder->supplier_id = $supplier->id;
            $purchaseOrder->status = $request->status;
            $purchaseOrder->status_rest = 'new';
            $purchaseOrder->save();

            //update drawing rights amount and also used amount
            $rightsAmount = DrawingRight::where('facility_id', '=', $userFacility)
                            ->where('finacial_year_id','=',$finacialYear->id)
                            ->where('period','=', getFinacialPeriod())
                            ->first();
            $rightsAmount->amount -= $request->grand_total;
            $rightsAmount->used_amount += $request->grand_total;
            $rightsAmount->update();

            //get the number of products in the request
            $detailsCount = count($request->product);

            for ($i=0; $i < $detailsCount; $i++) { 
                $purchaseOrderDetails = new PurchaseOrderDetail();
                $purchaseOrderDetails->order_id = $purchaseOrder->id;
                $purchaseOrderDetails->product_id = $request->product[$i];
                $purchaseOrderDetails->code = $request->code[$i];
                $purchaseOrderDetails->qty_ordered = $request->qty_ordered[$i];
                $purchaseOrderDetails->total = $request->rowtotal[$i];
                $purchaseOrderDetails->price = $request->price[$i];
                $purchaseOrderDetails->save();
            } 
        }, 3);

        //get the second supplier rank
        $nextSupplier = Supplier::where('id','=', $supplier->id + 1)->first();

        // get unavaliable products for the facility
        $unavailableProducts = UnavailableProduct::where('facility_id', '=', $userFacility)
                                                ->where('supplier_id', '=', $supplier->id)
                                                ->get();
        
        //if there is next
        //create a purchase order with the unavaliable products
        if ($nextSupplier && $unavailableProducts->isNotEmpty()) {
            //create purchase order header
            $nextOrder = new PurchaseOrder();
            $nextOrder->facility_id = $userFacility;
            $nextOrder->finacial_year = $finacialYear->id;
            $nextOrder->total = 0;
            $nextOrder->period = getFinacialPeriod();
            $nextOrder->supplier_id = $nextSupplier->id;
            $nextOrder->status = 'draft';
            $nextOrder->status_rest = 'new';
            $nextOrder->save();
            
            //loop througth unavailable then delete each
            foreach ($unavailableProducts as $product) {
                //get the code to check in the catalogue
                $supplierProductCode = SupplierProduct::where('suplier_id','=', $nextSupplier->id)
                                                          ->where('product_id','=',$product->product_id)
                                                          ->first();

                //check availability of product using supplier product catalogue table
                $checkAvailable = SupplierProductCatalogue::where('supplier_id','=', $nextSupplier->id)
                                                          ->where('product_code','=',$supplierProductCode->suplier_product_code)
                                                          ->first();
                

                $availableAmt = $checkAvailable->available_amount;
                if ($availableAmt > 1) {
                    $details = new PurchaseOrderDetail();
                    $details->order_id = $nextOrder->id;
                    $details->product_id = $product->product_id;
                    $details->code = $supplierProductCode->suplier_product_code;
                    $details->qty_ordered = 0;
                    $details->total = 0;
                    $details->price = $supplierProductCode->product_price;
                    $details->save();
                } else {
                    //if the product has qty of zero add to the unavailable
                    $unavailableProductsSecond = new UnavailableProduct();
                    $unavailableProductsSecond->supplier_id = $nextSupplier->id;
                    $unavailableProductsSecond->facility_id = $userFacility;
                    $unavailableProductsSecond->product_id = $product->product_id;
                    $unavailableProductsSecond->status = 0;
                    $unavailableProductsSecond->save();
                }
                //delete the product from the unavalable products
                $product->delete();
               
            }
            
            return redirect()->route('purchase-order.edit', $nextOrder->id)->with('success','Created oreder with the unavailable products');
        } else {
            return redirect()->route('purchase-order.index')->with('success','Purchase order was created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchaseOrder = PurchaseOrder::find($id);

        $supplier = Supplier::where('id','=',$purchaseOrder->supplier_id)->first();

        return view('purchase-order.show')->with([
            'purchaseOrder' => $purchaseOrder,
            'supplier' => $supplier
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userFacility = Auth::user();

        if ($userFacility->role !== 'hfp') {
            return redirect()->back(); 
        }
        $finacialyears = FinancialYear::orderBy('created_at','desc')->get()->first();

        $facilities = $userFacility->facility_id;

        $purchaseOrder = PurchaseOrder::find($id);

        $rightsAmount = DrawingRight::where('facility_id', '=', $facilities)
                                    ->where('finacial_year_id','=',$finacialyears->id)
                                    ->where('period','=', getFinacialPeriod())
                                    ->first();
        if (!$rightsAmount) {
            return redirect()->back()->with('unsuccess', 'You need a budget to place order');
        }


        $rightsAmount = $rightsAmount->amount;

        return view('purchase-order.edit')->with([
            'purchaseOrder' => $purchaseOrder,
            'rightsAmt' => $rightsAmount,
            'facilities'=> $facilities,
            'finacialyears' => $finacialyears,
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $finacialYear = FinancialYear::orderBy('created_at', 'desc')->get()->last();

        $userFacility = Auth::user()->facility_id;

        $purchaseOrder = PurchaseOrder::find($id);
        $purchaseOrder->status = 'pending approval';
        $purchaseOrder->total = $request->grand_total;
        $purchaseOrder->update();

        $rightsAmount = DrawingRight::where('facility_id', '=', $userFacility)
                                    ->where('finacial_year_id','=',$finacialYear->id)
                                    ->where('period','=', getFinacialPeriod())
                                    ->first();
        $rightsAmount->amount -= $request->grand_total;
        $rightsAmount->used_amount += $request->grand_total;
        $rightsAmount->update();


        $detailsCount = count($request->product);

        for ($i=0; $i < $detailsCount; $i++) { 
            $purchaseOrderDetails = PurchaseOrderDetail::find($request->order_details_id[$i]);
            $purchaseOrderDetails->qty_ordered = $request->qty_ordered[$i];
            $purchaseOrderDetails->total = $request->rowtotal[$i];
            $purchaseOrderDetails->update();

            //update catalogue
            /*
            $checkAvailable = SupplierProductCatalogue::where('supplier_id','=', $purchaseOrder->supplier_id)
                                                        ->where('product_code','=',$purchaseOrderDetails->product_id)
                                                        ->first();
            $checkAvailable->available_amount -= $request->qty_ordered[$i];
            $checkAvailable->update();
            */
        }

        //get the third/fouth/.. on ward supplier rank
        $nextSupplier = Supplier::where('id','=', $request->supplier_id + 1)->first();

        // get unavaliable products for the facility
        $unavailableProducts = UnavailableProduct::where('facility_id', '=', $userFacility)
                                                ->where('supplier_id', '=', $request->supplier_id)
                                                ->get();
         //if there is next
        //create a purchase order with the unavaliable products
        if ($nextSupplier && $unavailableProducts->isNotEmpty()) {
            //create purchase order header
            $nextOrder = new PurchaseOrder();
            $nextOrder->facility_id = $userFacility;
            $nextOrder->finacial_year = $finacialYear->id;
            $nextOrder->total = 0;
            $nextOrder->period = getFinacialPeriod();
            $nextOrder->supplier_id = $nextSupplier->id;
            $nextOrder->status = 'draft';
            $nextOrder->status_rest = 'new';
            $nextOrder->save();
            
            //loop througth unavailable then delete each
            foreach ($unavailableProducts as $product) {
                //check availability of product using supplier product catalogue table
               
                $supplierProductCode = SupplierProduct::where('suplier_id','=', $nextSupplier->id)
                                                          ->where('product_id','=',$product->product_id)
                                                          ->first();
                $checkAvailable = SupplierProductCatalogue::where('supplier_id','=', $nextSupplier->id)
                                                          ->where('product_code','=',$supplierProductCode->suplier_product_code)
                                                          ->first();
                $availableAmt = $checkAvailable->available_amount;
                if ($availableAmt > 1) {
                    $details = new PurchaseOrderDetail();
                    $details->order_id = $nextOrder->id;
                    $details->product_id = $product->product_id;
                    $details->code = $supplierProductCode->suplier_product_code;
                    $details->qty_ordered = 0;
                    $details->total = 0;
                    $details->price = $supplierProductCode->product_price;
                    $details->save();
                } else {
                    //if the product has qty of zero add to the unavailable
                    $unavailableProductsSecond = new UnavailableProduct();
                    $unavailableProductsSecond->supplier_id = $nextSupplier->id;
                    $unavailableProductsSecond->facility_id = $userFacility;
                    $unavailableProductsSecond->product_id = $product->product_id;
                    $unavailableProductsSecond->save();
                }
                //delete the product from the unavalable products
                $product->delete();

            
            }
            
            return redirect()->route('purchase-order.edit', $nextOrder->id)->with('success','Created order with the unavailable products');
        } else {
            return redirect()->route('purchase-order.index')->with('success','Purchase order(s) was created successfully');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * index data purchase order
     */
    public function indexData()
    {
        $userRole = Auth::user()->role;

        $purchaseOrders = PurchaseOrder::orderBy('created_at','desc')->get();

        if ($userRole == 'hfp') {
            $purchaseOrders = PurchaseOrder::where('facility_id', '=', Auth::user()->facility_id)->orderBy('created_at','desc')->get();
        }

    
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
            $obj->status = $purchaseOrder->status;
            $obj->period = $purchaseOrder->period;
            $obj->status_rest = $purchaseOrder->status_rest;
            $obj->date = $purchaseOrder->created_at->toFormattedDateString();

            array_push($purchaseOrdersArr, $obj);
        }

        return response($purchaseOrdersArr);
    }
    /**
     * get product price and code from supplier product table
    */
    public function getProdCodePrice(Request $request)
    {
        $request->validate([
            'supplier' => 'required',
            'product' => 'required'
        ]);

        $prodDetails = SupplierProduct::where('product_id','=', $request->product)->where('suplier_id','=',$request->supplier)->first();

        if ($prodDetails) {
            return response($prodDetails);
        };

    
    }


    /**
     * get order to be receieved
     */
    public function getOrder($id)
    {

        $order = PurchaseOrder::find($id);
        //dd($order);
        
        $purchaseOrder = PurchaseOrderDetail::all()->where('order_id', $order->id);
        // dd($order->purchase_order_num);

        $facilities = Facility::all();

        $supplier = Supplier::all();

        $finacialyears = FinancialYear::all();

        
        $products = Product::all();

        // return view ('purchase-order.received', compact(['order', 'facilities', 'supplier', 'products', 'finacialyears']));

        return view('purchase-order.received')->with([
            'order' => $order,
            'purchaseOrder' => $purchaseOrder,
            'facilities' => $facilities,
            'supplier' => $supplier,
            'finacialyears' => $finacialyears,
            'products' => $products
        ]);

        
    }


    /**
     * 
     * consolidate purchase order
     * 
     */
    public function consolidate()
    {
        $finacialYear = FinancialYear::orderBy('created_at', 'desc')->first();

        $suppliers = Supplier::all();

        DB::transaction(function() use ($finacialYear, $suppliers){
            foreach ($suppliers as $supplier) {

                $purchaseOrders = PurchaseOrder::where('period','=',getFinacialPeriod())
                                        ->where('finacial_year','=',$finacialYear->id)
                                        ->where('supplier_id','=',$supplier->id)
                                        ->where('consolidated','=', 0)->get();
                
                if($purchaseOrders->isNotEmpty()) {
                    $consolidated = new InvoiceProforma();
                    $consolidated->financial_year_id = $finacialYear->id;
                    $consolidated->supplier_id = $supplier->id;
                    $consolidated->period = getFinacialPeriod();
                    $consolidated->lpo = 'lpo';
                    $consolidated->approved_for_supply = 0;
                    $consolidated->approved_for_supply = 0;
                    $consolidated->payment_status = 'Pending Payment';
                    $consolidated->inv_num = 0;
                    $consolidated->status_date = now()->addDays(2);
                    $consolidated->status_co_date = now()->addDays(2);

                    $amt = 0;

                    foreach ($purchaseOrders as $purchaseOrder) {
                        $amt += $purchaseOrder->total;
                    }
                    $consolidated->amount = $amt;
                    $consolidated->save();

                    foreach ($purchaseOrders as $purchaseOrder) {
                        $consolidatedOrder = new ConsolidatedPurchaseOrder();
                        $consolidatedOrder->invoice_profoma_id = $consolidated->id;
                        $consolidatedOrder->purchase_order_id = $purchaseOrder->id;
                        $consolidatedOrder->save();
        
                        $purchaseOrder = PurchaseOrder::find($purchaseOrder->id);
                        $purchaseOrder->consolidated = 1;
                        $purchaseOrder->status = 'pending approval';
                        $purchaseOrder->status_rest = 'pending cd';
                        $purchaseOrder->update();
                    }    

                }
            }
        });


        return redirect()->back()->with('success', 'Requisitions successfully consolidated');

    }

    /**
     * 
     * recieve purchase order
     */
    public function receiveOrder(Request $request)
    {
        $facility = Auth::user()->facility_id;

        if (! $facility) {
            return redirect()->back()->with('unsuccess', 'Not allowed to receive products');
        }
        DB::transaction(function() use($request, $facility) {
            $purchaseOrder = PurchaseOrder::find($request->order_id);
            $purchaseOrder->delivery_note = $request->delivery_note;
            $purchaseOrder->delivery_note_num = $request->delivery_note_num;
            $purchaseOrder->delivered_by = $request->delivered_by;
            $purchaseOrder->delivery_vehicle_num = $request->grand_delivery_vehicle_num;   
            $purchaseOrder->status = $request->status;
            $purchaseOrder->status_rest = 'delivered';
            $purchaseOrder->date_delivered = date('Y-m-d');
            if ($request->has('file')) {
                $path = $request->file('file')->store('uploads', 'public');
                $purchaseOrder->file_path = $path;
            }
            $purchaseOrder->update();

            $prodCount = count($request->product);
            for ($i=0; $i < $prodCount; $i++) { 
                $details = PurchaseOrderDetail::find($request->details_id[$i]);
                $details->batch_number = $request->batch[$i];
                $details->qty_received = $request->qty_received[$i];
                $details->expiry_date = $request->exp_date[$i];
                
                $facilityProd = FacilityProduct::where('product_id','=',$details->product_id)->where('facility_id','=',Auth::user()->facility_id)->first();
                $facilityProd->quantity += $request->qty_received[$i];
                $facilityProd->update();

                $stock = new Stock();
                $stock->facility_id = $facility;
                $stock->product_id = $details->product_id;
                $stock->quantity = $request->qty_received[$i];
                $stock->batch = $request->batch[$i];
                $stock->exp_date = $request->exp_date[$i];
                $stock->save();

                $details->update();
            }

            
        });
       return redirect()->route('purchase-order.index')->with('success', 'Purchase order received');
    }

    /**
     * 
     * approval form county director or county PHARMACIST
     */
    public function approve(Request $request)
    {
        $request->validate([
            'profoma' => 'required',
            'user' => 'required'
        ]);

        $user = User::find($request->user);
        $profoma = InvoiceProforma::find($request->profoma);

        //check if director has approved if not we return
        if ($user->role == 'co' && $profoma->status_director == 0) {
            return response(2);
        }

        /** for county office bigger than director **/
        if ($user->role == 'co') {
            
            $profoma->status_co = 1;
            $profoma->status_date = date('Y-m-d');
            $profoma->update();

            $consolidates = ConsolidatedPurchaseOrder::where('invoice_profoma_id','=', $profoma->id)->get();

            foreach ($consolidates as $consolidate) {
                $order = PurchaseOrder::find($consolidate->purchase_order_id);
                $order->pending_co = 1;
                $order->status_rest = 'approved';
                $order->status = 'approved';
                $order->update();
            }

            return response(1);
        }        
        /** 
         * approval for county director 
         * 
        */
         if ($user->role == 'cd') {
            $profoma->status_director = 1;
            $profoma->status_date = date('Y-m-d');
            $profoma->update();

            $consolidates = ConsolidatedPurchaseOrder::where('invoice_profoma_id','=', $profoma->id)->get();

            foreach ($consolidates as $consolidate) {
                $order = PurchaseOrder::find($consolidate->purchase_order_id);
                $order->pending_director = 1;
                $order->status_rest = 'pending co';
                $order->update();
            }

            return response(1);
        }

        
    }
}
