<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\FacilityLocalRequests;
use App\Models\FacilityLocalRequestsDetails;
use App\Models\FacilityProduct;
use App\Models\FilledLocalRequests;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FacilityLocalRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facility_requests = FacilityLocalRequests::all();
        return view('facility_requests.facility_local_request.index', compact('facility_requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = Auth::User()->facility_id;
        if($users != NULL)
        {
            $facility_products = FacilityProduct::where('facility_id', '=', $users)->get();
            $products = Product::get();

            return view('facility_requests.facility_local_request.create', compact(['users', 'facility_products', 'products']));
        }
        else 
        {
            $message = 'User has no assigned facility';
            dd($message);
            return view('facility_requests.facility_local_request.create', compact(['users', 'message']));
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request_id = uniqid(10000, 99999999);
        // dd($request_id);

        $facilityLocalRequests = new FacilityLocalRequests();
        $facilityLocalRequests->requested_by = $request->requested_by;
        $facilityLocalRequests->request_date = $request->request_date;
        $facilityLocalRequests->status = 1;
        $facilityLocalRequests->request_id = $request_id;
        
        $facilityLocalRequests->save();

        $facilityLocalRequestsCount = count($request->product_name);

        for ($i=0; $i < $facilityLocalRequestsCount; $i++) { 
            $facilityLocalRequestsDetails = new FacilityLocalRequestsDetails();
            $facilityLocalRequestsDetails->product_name = $request->product_name[$i];
            $facilityLocalRequestsDetails->strength = $request->strength[$i];
            $facilityLocalRequestsDetails->unit_of_issue = $request->unit_of_issue[$i];
            $facilityLocalRequestsDetails->unit_size = $request->unit_size[$i];
            $facilityLocalRequestsDetails->available_units = $request->available_units[$i];
            $facilityLocalRequestsDetails->requested_units = $request->requested_units[$i];

            $facilityLocalRequestsDetails->requested_by = $request->requested_by;
            $facilityLocalRequestsDetails->request_date = $request->request_date;
            $facilityLocalRequestsDetails->request_id = $request_id;
            $facilityLocalRequestsDetails->save();
        }

        return redirect('/facility_local_request')->with('status', 'Product Request Made Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FacilityLocalRequests  $facilityLocalRequests
     * @return \Illuminate\Http\Response
     */
    public function show(FacilityLocalRequests $facilityLocalRequests, $id)
    {
        $users = Auth::User()->name;
        if($users != NULL)
        {
            $facilityLocalRequests = FacilityLocalRequests::find($id);
            if ( $facilityLocalRequests->status == 1 ) 
            {
                $facility_products = FacilityProduct::where('facility_id', '=', $users)->get();
                $request_id = $facilityLocalRequests->request_id;

                $facilityLocalRequestsDetails = FacilityLocalRequestsDetails::where('request_id', '=', $request_id)->get();
                $products = Product::get();

                return view('facility_requests.facility_local_request.show', compact(['users', 'facility_products', 'products', 'facilityLocalRequests', 'facilityLocalRequestsDetails']));
            }
            elseif ($facilityLocalRequests->status == 2) {
                # code...
                $facility_products = FacilityProduct::where('facility_id', '=', $users)->get();
                $request_id = $facilityLocalRequests->request_id;
                // dd($request_id);
                
                $facilityLocalRequestsDetails = FilledLocalRequests::where('request_id', '=', $request_id)->get();
                $products = Product::get();
                $facilities = Facility::all();
                
                return view('facility_requests.facility_details_views.show_local_processed', compact(['users', 'facility_products', 'products', 'facilityLocalRequests', 'facilityLocalRequestsDetails', 'facilities']));
           
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FacilityLocalRequests  $facilityLocalRequests
     * @return \Illuminate\Http\Response
     */
    public function edit(FacilityLocalRequests $facilityLocalRequests, $id)
    {
        $users = Auth::User()->name;
        if($users != NULL)
        {
            $facilityLocalRequests = FacilityLocalRequests::find($id);
            $facility_products = FacilityProduct::where('facility_id', '=', $users)->get();
            $request_id = $facilityLocalRequests->request_id;

            $facilityLocalRequestsDetails = FacilityLocalRequestsDetails::where('request_id', '=', $request_id)->get();
            $products = Product::get();

            return view('facility_requests.facility_external_requests.edit', compact(['users', 'facility_products', 'products', 'facilityLocalRequests', 'facilityLocalRequestsDetails']));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FacilityLocalRequests  $facilityLocalRequests
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FacilityLocalRequests $facilityLocalRequests, $id)
    {
        // dd($request);
        $request_id = FacilityLocalRequests::find($id);
        $request_id->status = 2;
        $request_id->update();
        
        $fill_request_details = new FilledLocalRequests();
        $fill_request_detailsCount = count($request->product_name);

        for ($i=0; $i < $fill_request_detailsCount; $i++) { 
            $fill_request_details->product_name = $request->product_name[$i];
            $fill_request_details->strength = $request->strength[$i];
            $fill_request_details->unit_of_issue = $request->unit_of_issue[$i];
            $fill_request_details->unit_size = $request->unit_size[$i];
            $fill_request_details->available_units = $request->available_units[$i];
            $fill_request_details->requested_units = $request->requested_units[$i];
            $fill_request_details->allocated_units = $request->allocated_units[$i];

            $fill_request_details->request_id = $request_id->request_id;
            $fill_request_details->save();
        }

        return redirect('/facility_store_request')->with('status', 'Facility Pharmacy Request Filled Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FacilityLocalRequests  $facilityLocalRequests
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacilityLocalRequests $facilityLocalRequests)
    {
        //
    }

    public function filledLocalRequest()
    {
        // $request_details
    }
}
