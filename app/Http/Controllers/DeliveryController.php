<?php

namespace App\Http\Controllers;

use App\Models\CountyPharmacist;
use App\Models\Delivery;
use App\Models\Facility;
use App\Models\FacilityExternalRequests;
use App\Models\FacilityLocalRequests;
use App\Models\FacilityProduct;
use App\Models\FilledStoreRequests;
use App\Models\Product;
use App\Models\SubCountyPharmacist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facility_requests = FacilityLocalRequests::all();
        $facilityExternalRequests = FacilityExternalRequests::where('status', '=', 3)->get();
        $facilities = Facility::all();

        return view('delivery.index', compact(['facility_requests', 'facilityExternalRequests', 'facilities']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $delivery
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request_id = $request->request_id;
        // dd($request_id);

        $delivery = new Delivery();
        $delivery->delivery_facility = $request->facility_id;
        $delivery->processed_by = $request->processed_by;
        $delivery->approved_by = $request->approved_by;
        $delivery->request_id = $request->request_id;
        $delivery->delivery_date = $request->delivery_date;
        $delivery->issued_to = $request->issued_to;
        $delivery->delivered_by = $request->delivered_by;

        $delivery->save();

        // $county_details = CountyPharmacist::find($request_id);
        // $county_details->status = 5;
        // $county_details->update();
        // dd($request->request_id);
        
        SubCountyPharmacist::where('request_id', '=', $request->request_id)
                                                ->update(['status' => 5]);

        FacilityExternalRequests::where('request_id', '=', $request->request_id)
                                                ->update(['status' => 5]);

        return redirect('/delivery')->with('status', 'Delivery Completed Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = Auth::User()->name;
        if($users != NULL)
        {
            $facilityExternalRequests = SubCountyPharmacist::find($id);
            // dd($facilityExternalRequests);
            $facility_products = FacilityProduct::where('facility_id', '=', $users)->get();
            $request_id = $facilityExternalRequests->request_id;
            
            $facilityExternalRequestsDetails = FilledStoreRequests::where('request_id', '=', $request_id)->get();
            $products = Product::get();
            $facilities = Facility::all();
            
            return view('delivery.show', compact(['users', 'facility_products', 'products', 'facilityExternalRequests', 'facilityExternalRequestsDetails', 'facilities']));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = Auth::User()->name;
        if($users != NULL)
        {
            $facilityExternalRequests = SubCountyPharmacist::find($id);
            // dd($facilityExternalRequests);
            $facility_products = FacilityProduct::where('facility_id', '=', $users)->get();
            $request_id = $facilityExternalRequests->request_id;
            
            $facilityExternalRequestsDetails = FilledStoreRequests::where('request_id', '=', $request_id)->get();
            $products = Product::get();
            $facilities = Facility::all();
            
            return view('delivery.edit', compact(['users', 'facility_products', 'products', 'facilityExternalRequests', 'facilityExternalRequestsDetails', 'facilities']));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Delivery $delivery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivery $delivery)
    {
        //
    }
}
