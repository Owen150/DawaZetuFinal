<?php

namespace App\Http\Controllers;

use App\Models\FacilityProduct;
use App\Models\FillTopUpDetails;
use App\Models\Product;
use App\Models\TopUp;
use App\Models\TopUpDetails;
use Illuminate\Http\Request;

class FillTopUpDetailsController extends Controller
{
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

        return view('storetopup.filltopupDetails.show', compact(['topups', 'topupDetails', 'facilityProducts' ,'products']));
    }

    public function edit($id)
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

        return view('storetopup.filltopupDetails.edit', compact(['topups', 'topupDetails', 'facilityProducts' ,'products']));
    }

    public function update(Request $request, $id)
    {
        $topups = TopUp::find($id);
        $topups->status = 'Processed';
        
        $topups->update();

        $request_id = $request->requested_by;
        $topupDetails = TopUpDetails::where('requested_by', '=', $request_id)->get();

        $topupCount = count($request->product_name);
        // dd($request);

        for ($i=0; $i < $topupCount; $i++) { 
            $topupDetails = new FillTopUpDetails();
            $topupDetails->product_name = $request->product_name[$i];
            $topupDetails->strength = $request->strength[$i];
            $topupDetails->unit_of_issue = $request->unit_of_issue[$i];
            $topupDetails->unit_size = $request->unit_size[$i];
            $topupDetails->available_units = $request->available_units[$i];
            $topupDetails->requested_units = $request->requested_units[$i];
            $topupDetails->allocated_units = $request->allocated_units[$i];
            $topupDetails->status = 'Processed';

            $topupDetails->requested_by = $request->requested_by;
            $topupDetails->request_date = $request->request_date;

            $topupDetails->save();
        }

        return redirect('/storetopup')->with('status', 'Top Up Request Details updated successfully');
    }

    public function delete($id)
    {
        $topup = TopUp::find($id);
        $topup->delete();

        return redirect('/storetopup')->with('status', 'Record deleted successfully');
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

        return view('storetopup.filltopupDetails.processed', compact(['topups', 'topupDetails', 'facilityProducts' ,'products']));
    }
}
