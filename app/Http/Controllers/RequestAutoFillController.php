<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\FacilityExternalRequests;
use App\Models\FacilityProduct;
use App\Models\RequestAutoFill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestAutoFillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $facility_products = FacilityProduct::where('product_id', '=', Auth::User()->facility_id)->get();
        // dd($facility_products);
        $facilities = Facility::all();

        return view('subcounty_pharmacist.fill_details.index', compact('facility_products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $requestFill = new RequestAutoFill();
        $requestFill->facility_id = $request->facility_id;
        $requestFill->product_id = $request->product_id;
        $requestFill->quantity = $request->quantity;
        $requestFill->save();

        return redirect('/sub_county_pharmacist');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestAutoFill  $requestAutoFill
     * @return \Illuminate\Http\Response
     */
    public function show(RequestAutoFill $requestAutoFill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequestAutoFill  $requestAutoFill
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestAutoFill $requestAutoFill, $id)
    {
        $facilityExternalRequest = FacilityExternalRequests::find($id);
        dd($facilityExternalRequest);

        $facility_products = FacilityProduct::where('product_id', '=', $id)->get();
        $facilities = Facility::all();
        return view('subcounty_pharmacist.fill_details.index', compact(['facility_products', 'facilities']));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequestAutoFill  $requestAutoFill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestAutoFill $requestAutoFill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestAutoFill  $requestAutoFill
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestAutoFill $requestAutoFill)
    {
        //
    }
}
