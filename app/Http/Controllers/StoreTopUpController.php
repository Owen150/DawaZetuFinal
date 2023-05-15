<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\FacilityProduct;
use App\Models\Product;
use App\Models\StoreTopUp;
use App\Models\StoreTopUpDetails;
use App\Models\TopUp;
use App\Models\TopUpDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreTopUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topups = TopUp::all();
        $facilities = Facility::all();
        $storetopups = StoreTopUp::all();
        $products = Product::all();

        $topupDetails = FacilityProduct::get();

        foreach ($topupDetails as $topupDetail) {

            if ($topupDetail->quantity <= $topupDetail->reorder_level_back_store) {
                $product_id = $topupDetail->product_id;

                $products = Product::where('id', '=', $product_id)->get();
                $reorderLevels = FacilityProduct::where('quantity', '<=', $topupDetail->reorder_level_back_store)->get();

            }
        }

        return view('storetopup.index', compact(['topups', 'facilities', 'storetopups', 'topupDetails', 'products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topups = TopUp::all();
        $topupDetails = FacilityProduct::get();
        $products = Product::all();
        $facilities = Facility::all();

        return view('storetopup.create', compact(['topups', 'topupDetails', 'products', 'facilities']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function () use($request){
            $storetopup = new StoreTopUp();
            $storetopup->requested_by = $request->requested_by;
            $storetopup->request_date = $request->request_date;
            $storetopup->facility_id = $request->facility_id;
            $storetopup->request_id = $request->request_id;
            $storetopup->status = 'SCP Pending';

            $storetopup->save();
        });

        $topupCount = count($request->product_name);

        for ($i=0; $i < $topupCount; $i++) { 
            $topupDetails = new StoreTopUpDetails();
            $topupDetails->product_name = $request->product_name[$i];
            $topupDetails->strength = $request->strength[$i];
            $topupDetails->unit_of_issue = $request->unit_of_issue[$i];
            $topupDetails->unit_size = $request->unit_size[$i];
            $topupDetails->available_units = $request->available_units[$i];
            $topupDetails->requested_units = $request->requested_units[$i];

            $topupDetails->requested_by = $request->requested_by;
            $topupDetails->request_date = $request->request_date;
            $topupDetails->status = 'SCP Pending';
            $topupDetails->request_id = $request->request_id;
            $topupDetails->save();
        }

        return redirect('/storetopup')->with('status', 'Product Top Up Request made successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StoreTopUp  $storeTopUp
     * @return \Illuminate\Http\Response
     */
    public function show(StoreTopUp $storeTopUp, $id)
    {
        $storetopup = StoreTopUp::find($id);
        $storetopupDetails = StoreTopUpDetails::where('requested_by', '=', $storetopup->requested_by)->get();

        $facilities = Facility::all();
        $products = Product::all();

        return view('storetopup.show', compact(['storetopup', 'storetopupDetails', 'facilities', 'products']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StoreTopUp  $storeTopUp
     * @return \Illuminate\Http\Response
     */
    public function edit(StoreTopUp $storeTopUp, $id)
    {
        $storetopup = StoreTopUp::find($id);
        $storetopupDetails = StoreTopUpDetails::where('requested_by', '=', $storetopup->requested_by)->get();

        $facilities = Facility::all();
        $products = Product::all();

        return view('storetopup.edit', compact(['storetopup', 'storetopupDetails', 'facilities', 'products']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StoreTopUp  $storeTopUp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StoreTopUp $storeTopUp, $id)
    {
        $storetopup = StoreTopUp::find($id);
        $storetopup->requested_by = $request->requested_by;
        $storetopup->request_date = $request->request_date;
        $storetopup->facility_id = $request->facility_id;
        $storetopup->request_id = $request->request_id;
        $storetopup->status = 'SCP Pending';

        $storetopup->update();

        $request_id = $request->requested_by;
        $topupDetails = TopUpDetails::where('requested_by', '=', $request_id)->get();
        // dd($topupDetails);

        $topupCount = count($request->product_name);

        for ($i=0; $i < $topupCount; $i++) { 
            $topupDetails = new TopUpDetails();
            $topupDetails->product_name = $request->product_name[$i];
            $topupDetails->strength = $request->strength[$i];
            $topupDetails->unit_of_issue = $request->unit_of_issue[$i];
            $topupDetails->unit_size = $request->unit_size[$i];
            $topupDetails->available_units = $request->available_units[$i];
            $topupDetails->requested_units = $request->requested_units[$i];
            $topupDetails->facility = $request->facility[$i];

            $topupDetails->requested_by = $request->requested_by;
            $topupDetails->request_date = $request->request_date;

            $topupDetails->update();
        }

        return redirect('/storetopup')->with('status', 'Top Up Request Details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoreTopUp  $storeTopUp
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreTopUp $storeTopUp, $id)
    {
        $topup = TopUp::find($id);
        $topup->delete();

        return redirect('/storetopup')->with('status', 'Record deleted successfully');
    }
}
