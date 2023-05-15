<?php

namespace App\Http\Controllers;

use App\Models\FacilityProduct;
use App\Models\FacilityReOrderLevel;
use App\Models\FillTopUpDetails;
use App\Models\Product;
use App\Models\TopUp;
use App\Models\TopUpDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topups = TopUp::all();
        return view('topup.index', compact('topups'));
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

        foreach ($topupDetails as $topupDetail) {

            if ($topupDetail->quantity <= $topupDetail->reorder_level_back_store) {
                $product_id = $topupDetail->product_id;

                $products = Product::where('id', '=', $product_id)->get();
                $reorderLevels = FacilityProduct::where('quantity', '<=', $topupDetail->reorder_level_back_store)->get();
            }
        }

        return view('topup.create', compact(['topups', 'topupDetails', 'reorderLevels', 'products']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        // $request->validate([
        //     'requested_by' => 'required',
        //     'requested_date' => 'required',
        // ]);

        DB::transaction(function () use ($request) {
            $topup = new TopUp();
            $topup->requested_by = $request->requested_by;
            $topup->request_date = $request->request_date;
            $topup->status = 'pending';

            $topup->save();
        });

        $topupCount = count($request->product_name);

        for ($i = 0; $i < $topupCount; $i++) {
            $topupDetails = new TopUpDetails();
            $topupDetails->product_name = $request->product_name[$i];
            $topupDetails->strength = $request->strength[$i];
            $topupDetails->unit_of_issue = $request->unit_of_issue[$i];
            $topupDetails->unit_size = $request->unit_size[$i];
            $topupDetails->available_units = $request->available_units[$i];
            $topupDetails->requested_units = $request->requested_units[$i];

            $topupDetails->requested_by = $request->requested_by;
            $topupDetails->request_date = $request->request_date;
            $topupDetails->save();
        }

        return redirect('/topup')->with('status', 'Product Top Up Request made successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function show(TopUp $topUp, $id)
    {
        $topups = TopUp::find($id);
        $request_id = $topups->requested_by;

        $facilityProducts = FacilityProduct::get();
        $topupDetails = TopUpDetails::where('requested_by', '=', $request_id)->get();

        foreach ($facilityProducts as $facilityProduct) {

            if ($facilityProduct->quantity <= $facilityProduct->reorder_level_back_store) {
                $product_id = $facilityProduct->product_id;

                $products = Product::where('id', '=', $product_id)->get();
                $reorderLevels = FacilityProduct::where('quantity', '<=', $facilityProduct->reorder_level_back_store)->get();
            }
        }

        return view('topup.show', compact(['topups', 'topupDetails', 'facilityProducts', 'products']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function edit(TopUp $topUp, $id)
    {
        $topups = TopUp::find($id);

        $reorderLevels = FacilityProduct::all();

        $topupDetails = TopUpDetails::get();
        return view('topup.edit', compact(['topups', 'topupDetails', 'reorderLevels']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TopUp $topUp, $id)
    {
        // dd($request);
        $topups = TopUp::find($id);
        $topups->requested_by = $request->requested_by;
        $topups->request_date = $request->request_date;

        $topups->update();

        $request_id = $request->requested_by;
        $topupDetails = TopUpDetails::where('requested_by', '=', $request_id)->get();
        // dd($topupDetails);

        $topupCount = count($request->product_name);

        for ($i = 0; $i < $topupCount; $i++) {
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

        return redirect('/topup')->with('status', 'Top Up Request Details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function destroy(TopUp $topUp, $id)
    {
        $topup = TopUp::find($id);
        $topup->delete();

        return redirect('/topup')->with('status', 'Record deleted successfully');
    }

    public function processed($id)
    {
        $topups = TopUp::find($id);
        $request_id = $topups->requested_by;

        $facilityProducts = FacilityProduct::get();
        $topupDetails = FillTopUpDetails::where('requested_by', '=', $request_id)->get();

        foreach ($facilityProducts as $facilityProduct) {

            if ($facilityProduct->quantity <= $facilityProduct->reorder_level_back_store) {
                $product_id = $facilityProduct->product_id;

                $products = Product::where('id', '=', $product_id)->get();
                $reorderLevels = FacilityProduct::where('quantity', '<=', $facilityProduct->reorder_level_back_store)->get();
            }
        }

        return view('topup.processed', compact(['topups', 'topupDetails', 'facilityProducts', 'products']));
    }
}
