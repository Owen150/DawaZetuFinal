<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\PrescriptionDetails;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prescriptions = Prescription::all();
        return view('prescriptions.index', compact('prescriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('prescriptions.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product' => 'required',
            'quantity' => 'required',
            'patient_number'=> 'required',
            'patient_name'  => 'required',
            'prescription_date' => 'required',
        ]);

        DB::transaction(function() use ($request) {
            $prescription = new Prescription();
            $prescription->patient_number = $request->patient_number;
            $prescription->patient_name = $request->patient_name;
            $prescription->prescription_date = $request->prescription_date;
            $prescription->status = 'pending';
            $prescription->save();
        
            $productCount = count($request->product);
        
            for ($i=0; $i < $productCount; $i++) { 
                $prescDetails = new PrescriptionDetails();
                $prescDetails->prescription_id = $prescription->id;
                $prescDetails->product = $request->product[$i];
                $prescDetails->quantity = $request->quantity[$i];
                $prescDetails->patient_number = $prescription->patient_number;
                $prescDetails->save();
            }
        });

        return redirect()->route('prescriptions.index')->with('status', 'Prescription added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prescription = Prescription::find($id);
        $prescription_details = PrescriptionDetails::all()->where('patient_number', $prescription->patient_number);
        $products = Product::all();
        return view('prescriptions.show', compact(['prescription', 'products' ,'prescription_details']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */

    public function dispense(Request $request, $id)
    {
        $dispense_id = Prescription::find($id);

        $data = $request->validate([
            'status' => 'required'
        ]);
        
        $dispense = $request->status;
        // dd($dispense);
        $prescriptions = Prescription::all();

        DB::table('prescriptions')->where('id', $id)->update(['status' => $dispense]);
        return view('prescriptions.index', compact('prescriptions'));
    }

    public function edit($id)
    {
        $prescription = Prescription::find($id);
        $prescription_details = PrescriptionDetails::all()->where('patient_number', $prescription->patient_number);
        $products = Product::all();
        return view('prescriptions.edit', compact(['prescription', 'products' ,'prescription_details']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prescription $prescription)
    {
        $currentTime = Carbon::now();
        $data = $request->validate([
            'product' => 'required',
            'quantity' => 'required',
            'patient_number'=> 'required',
            'patient_name'  => 'required',
            'prescription_date' => 'required',
            'prescription_cost' => 'required',

        ]);



        // UPDATING PRESCRIPTION
        $patient_number = $request->patient_number;
        $patient_name = $request->patient_name;
        $prescription_date = $request->prescription_date;
        $prescription_cost = $request->prescription_cost;

        $prescription = [
            'patient_number' => $patient_number,
            'patient_name' => $patient_name,
            'prescription_date' => $prescription_date,
            'prescription_cost' => $prescription_cost,
            'created_at' =>$currentTime,
        ];

        $data=array('patient_number'=>$patient_number,"patient_name"=>$patient_name,"prescription_date"=>$prescription_date,
        "prescription_cost"=>$prescription_cost, "created_at"=>$currentTime);
        DB::table('prescriptions')->update($data);


        // UPDATING PRESCRIPTION DETAILS
        $product = $request->product;
        $quantity = $request->quantity;
        $patient_number = $request->patient_number;

        for ($i=0; $i < count($product); $i++) { 
            $datasave = [
                'product'            => $product[$i],
                'quantity'           => $quantity[$i],
                'patient_number'     => $patient_number,
                'created_at'         => $currentTime,
            ];
            
            $datasave_array=array('product'=>$product, "quantity"=>$quantity, "patient_number"=>$patient_number, "created_at"=>$currentTime);
            DB::table('prescription_details')->update($datasave_array);
        }

        return redirect('/prescriptions')->with('status', 'Prescription added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prescription $prescription)
    {
        //
    }

    public function pos()
    {
        $products = Product::all();
        $orders = PurchaseOrder::all();
        $orderDetails = PurchaseOrderDetail::all();
        return view('prescriptions.pos', compact(['products', 'orderDetails', 'orders']));
    }

    public function posIndex()
    {
        $products = Product::all();
        $orders = PurchaseOrder::all();
        $orderDetails = PurchaseOrderDetail::all();
        return view('prescriptions.pos.pos-index', compact(['products', 'orderDetails', 'orders']));
    }

    public function posTest($id)
    {
        $prescription = Prescription::find($id);

        $prescription_details = PrescriptionDetails::where('prescription_id','=', $prescription->id)->get();

        return view('prescriptions.checkout.show', compact(['prescription', 'prescription_details']));
    }
}
