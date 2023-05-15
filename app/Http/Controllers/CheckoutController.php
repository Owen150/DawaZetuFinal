<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\FacilityProduct;
use App\Models\Prescription;
use App\Models\PrescriptionDetails;
use App\Models\Product;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function show($id)
    {
        return view('prescriptions.checkout.show');
    }

    //Simple checkout - patient sent out
    public function outside(Request $request)
    {
        $checkout = new Checkout();
        // $patient_id = $request->patient_id;
        // $prescription_id = $request->prescription_id;
        $patient_id = '1';
        $prescription_id = '1';

        $details = [
            'patient_id' => $patient_id,
            'prescription_id' => $prescription_id,
            'status' => 'outside',
        ];

        DB::table('checkouts')->insert($details);
        return redirect('/prescriptions')->with('status', 'Patient prescription completed successfully');
    }

    //Simple checkout - patient within hospital
    public function inHouse(Request $request)
    {
        $checkout = new Checkout();

        $patient_id = $request->patient_number;
        $product_id = $request->product_id;
        $prescription_id = '1';
        $quantity = $request->quantity;

        for ($i=0; $i < count($quantity) ; $i++) { 
            $datasave = [
                'product_id'         => $product_id[$i],
                'quantity'           => $quantity[$i],
            ];

            DB::table('products')->where('id', $product_id)->decrement('package_quantity', 1);
            // DB::table('products')->where('id', $product_id)->decrement('package_quantity', 1);
        }

        $details = [
            'patient_id' => $patient_id,
            'prescription_id' => $prescription_id,
            'status' => 'inhouse',
        ];

        // dd($details);

        DB::table('checkouts')->insert($details);
        
        //REMOVE PRESCRIPTION FROM ROW AFTER DISPENSE
        // $id = $request->id;
        // Prescription::where('id', $id)->delete();

        return redirect('/prescriptions')->with('status', 'Patient prescription completed successfully');
    }

    public function release(Request $request, $id)
    {
        $prescription = Prescription::find($id);

        $status = $request->status;

        $userFacility = Auth::user()->facility_id;

        if($status == 'outside'){
            $prescription->status = 'buy outside';
            $prescription->update();
            return redirect()->route('prescriptions.index')->with('status', 'Patient prescription completed successfully');       
        }

        $totals = 0;
        $stockTotal = 0;
        

        if ($status == 'inhouse') {
            $prescription->status = 'inhouse';
            $prescription->update();

            $productsCount = count($request->product);    

            for ($i=0; $i < $productsCount; $i++) { 
                //minus facility product qty
                $facilityProduct = FacilityProduct::where('product_id','=',$request->product[$i])
                                ->where('facility_id','=', $userFacility)
                                ->first();
                $changeToPositive = $facilityProduct->quantity - $request->quantity[$i];
                if ($changeToPositive < 0) {
                    $facilityProduct->quantity = 0;
                } else {
                    $facilityProduct->quantity = $changeToPositive;
                }
                //$facilityProduct->update();

                
                //find the prescription
                $prescDetails = PrescriptionDetails::where('id','=', $request->details_id[$i])->first();
                //get qty from prescription for each product
                $prescTotals = $request->quantity[$i];
                //stock first in first out
                $productStocks = Stock::where('product_id','=',$request->product[$i])->where('facility_id','=',$userFacility)->get();


                //stock count for one product
                $stockss = count($productStocks);

                foreach ($productStocks as $zeroeth) {
                    $expiryDate = Carbon::createFromFormat('Y-m-d', $zeroeth->exp_date);
                    $today = Carbon::now();
                    $isExpired = $today->gte($expiryDate);

                    if (! $isExpired) { 
                        $stockTotal += $zeroeth->quantity;
                    }
                }


                $result = $stockTotal - $prescTotals;

                if ($result >= 0) {
                    $productStocksTwo = Stock::where('product_id','=',$request->product[$i])->where('facility_id','=',$userFacility)->orderBy('exp_date','asc')->get();
                   
                    $availableStockTwo = count($productStocksTwo);

                    if ($availableStockTwo > 0) {

                        $remove = $prescTotals;

                        if ($remove > 0) { 
                            foreach ($productStocksTwo as $key => $two) {
                                $expiryDate = Carbon::createFromFormat('Y-m-d', $two->exp_date);
                                $today = Carbon::now();
                                $isExpired = $today->gte($expiryDate);
        

                                if (! $isExpired && $two->quantity > 0) { 
                                    $qtyCheck = $two->quantity - $remove;

                                    if ($qtyCheck >= 0) {
                                        $two->quantity = $qtyCheck;
                                        $remove = 0;
                                    } 
                                    if ($qtyCheck < 0) {
                                        $two->quantity = 0;
                                        $remove = abs($qtyCheck);
                                    } 

                                    $two->update();
                                } else {
                                    continue;
                                }
                            }
                        }   
                        /*
                        $myLastElement = $productStocksTwo->last();
                        $myLastElement->quantity = abs($result);
                        $myLastElement->update();    
                        */
                        
                    }
                    
                    $stockTotal = 0;
                }
                /*
                if ($result < 0) {
                    $productStocksThree = Stock::where('product_id','=',$request->product[$i])->where('facility_id','=',$userFacility)->get();
                    
                    $availableStockThree = count($productStocksThree);
                    if ($availableStockThree > 0) {
                        foreach ($productStocksThree as $key => $three) {
                            $expiryDate = Carbon::createFromFormat('Y-m-d', $three->exp_date);
                            $today = Carbon::now();
                            $isExpired = $today->gte($expiryDate);
                        
                            if (! $isExpired) { 
                                $three->quantity = 0;
                                $three->update();
                            }
                        }

                        $prescDetails->to_buy_outside = abs($result);
                        $prescDetails->update();
                    }
                    $stockTotal = 0;
                }

                if ($result == 0) {
                    $productStocksOne = Stock::where('product_id','=',$request->product[$i])->where('facility_id','=',$userFacility)->get();
                    $availableStockOne = count($productStocksOne);

                    if ($availableStockOne > 0) {
                        for ($p=0; $p <= count($productStocksOne); $p++) { 
                            $expiryDate = Carbon::createFromFormat('Y-m-d', $productStocksOne[$p]->exp_date);
                            $today = Carbon::now();
                            $isExpired = $today->gte($expiryDate);
                        
                            if (! $isExpired) { 
                                $productStocksOne[$p]->quantity = 0;
                                $productStocksOne[$p]->update();
                            }
                        }
                    } 
                }
                */
            }
            

        }
        return redirect()->route('prescriptions.index')->with('status', 'Patient prescription completed successfully');       
    }

}
