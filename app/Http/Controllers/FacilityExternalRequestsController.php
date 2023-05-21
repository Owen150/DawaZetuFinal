<?php

namespace App\Http\Controllers;

use App\Models\CountyPharmacist;
use App\Models\Delivery;
use App\Models\Facility;
use App\Models\FacilityExternalRequests;
use App\Models\FacilityExternalRequestsDetails;
use App\Models\FacilityLocalRequests;
use App\Models\FacilityProduct;
use App\Models\FilledStoreRequests;
use App\Models\Product;
use App\Models\SubCountyPharmacist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacilityExternalRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facility_requests = FacilityLocalRequests::all();
        $facilityExternalRequests = FacilityExternalRequests::all();
       
        $facility_id = Auth::User()->facility_id;
        $fillExternalRequests = FilledStoreRequests::where('requested_facility', '=', $facility_id)->get();
        
        $products = Product::all();
        $facilities = Facility::all();

        return view('facility_requests.facility_external_requests.index', compact(['facility_requests', 'facilityExternalRequests', 'fillExternalRequests', 'products', 'facilities']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $users = Auth::User()->facility_id;
        if($users != NULL)
        {
            $facility_products = FacilityProduct::where('facility_id', '=', $users)->get();
            $products = Product::get();
            $facilities = Facility::all();

            return view('facility_requests.facility_external_requests.create', compact(['users', 'facility_products', 'products', 'facilities']));
        }
        else 
        {
            $message = 'User has no assigned facility';
            dd($message);
            return view('facility_requests.facility_external_requests.create', compact(['users', 'message']));
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
        // dd($request);
        $request_id = uniqid(10000, 99999999);

        $facilityExternalRequests = new FacilityExternalRequests();
        $facilityExternalRequests->requested_by = $request->requested_by;
        $facilityExternalRequests->request_date = $request->request_date;
        $facilityExternalRequests->facility_id = $request->facility_id;
        $facilityExternalRequests->status = 1;
        $facilityExternalRequests->request_id = $request_id;
        
        $facilityExternalRequests->save();

        $facilityExternalRequestsCount = count($request->product_name);

        for ($i=0; $i < $facilityExternalRequestsCount; $i++) { 
            $facilityExternalRequestsDetails = new FacilityExternalRequestsDetails();
            $facilityExternalRequestsDetails->product_name = $request->product_name[$i];
            $facilityExternalRequestsDetails->strength = $request->strength[$i];
            $facilityExternalRequestsDetails->unit_of_issue = $request->unit_of_issue[$i];
            $facilityExternalRequestsDetails->unit_size = $request->unit_size[$i];
            $facilityExternalRequestsDetails->available_units = $request->available_units[$i];
            $facilityExternalRequestsDetails->requested_units = $request->requested_units[$i];

            $facilityExternalRequestsDetails->requested_by = $request->requested_by;
            $facilityExternalRequestsDetails->request_date = $request->request_date;
            $facilityExternalRequestsDetails->facility_id = $request->facility_id;
            $facilityExternalRequestsDetails->request_id = $request_id;
            $facilityExternalRequestsDetails->save();
        }

        return redirect('/facility_store_request')->with('status', 'Facility Store Request created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FacilityExternalRequests  $facilityExternalRequests
     * @return \Illuminate\Http\Response
     */
    public function show(FacilityExternalRequests $facilityExternalRequests, $id)
    {
        $users = Auth::User()->name;
        if($users != NULL)
        {
            $facilityExternalRequests = FacilityExternalRequests::find($id);
            if ( $facilityExternalRequests->status == 1 ) {
                # code...
                $facility_products = FacilityProduct::where('facility_id', '=', $users)->get();
                $request_id = $facilityExternalRequests->request_id;
                
                $facilityExternalRequestsDetails = FacilityExternalRequestsDetails::where('request_id', '=', $request_id)->get();
                $products = Product::get();
                $facilities = Facility::all();
                
                // PENDING APPROVAL
                return view('facility_requests.facility_details_views.show_subcounty_request', compact(['users', 'facility_products', 'products', 'facilityExternalRequests', 'facilityExternalRequestsDetails', 'facilities']));
            }
            elseif ($facilityExternalRequests->status == 2 || $facilityExternalRequests->status == 3) {
                # code...
                $facility_products = FacilityProduct::where('facility_id', '=', $users)->get();
                $request_id = $facilityExternalRequests->request_id;
                
                $facilityExternalRequestsDetails = FilledStoreRequests::where('request_id', '=', $request_id)->get();
                $products = Product::get();
                $facilities = Facility::all();
                
                // APPROVED AND PROCESSED
                return view('subcounty_pharmacist.show', compact(['users', 'facility_products', 'products', 'facilityExternalRequests', 'facilityExternalRequestsDetails', 'facilities']));
            }
            elseif ($facilityExternalRequests->status == 4 ) {
                # code...
                $facility_products = FacilityProduct::where('facility_id', '=', $users)->get();
                $request_id = $facilityExternalRequests->request_id;
                
                $facilityExternalRequestsDetails = FilledStoreRequests::where('request_id', '=', $request_id)->get();
                $comments = CountyPharmacist::where('request_id', '=', $request_id)->get('comments');
                // dd($comments);
                $products = Product::get();
                $facilities = Facility::all();

                return view('facility_requests.facility_details_views.show_amended', compact(['users', 'facility_products', 'products', 'facilityExternalRequests', 'facilityExternalRequestsDetails', 'facilities', 'comments']));
            }
            elseif ($facilityExternalRequests->status == 5 ) {
                # code...
                $facility_products = FacilityProduct::where('facility_id', '=', $users)->get();
                $request_id = $facilityExternalRequests->request_id;
                
                $facilityExternalRequestsDetails = FilledStoreRequests::where('request_id', '=', $request_id)->get();
                $comments = CountyPharmacist::where('request_id', '=', $request_id)->get('comments');
                $delivery = Delivery::where('request_id', '=', $request_id)->get('delivered_by');
                // dd($comments);
                $products = Product::get();
                $facilities = Facility::all();
                return view('facility_requests.facility_details_views.show_delivery', compact(['users', 'facility_products', 'products', 'facilityExternalRequests', 'facilityExternalRequestsDetails', 'facilities', 'comments', 'delivery']));
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FacilityExternalRequests  $facilityExternalRequests
     * @return \Illuminate\Http\Response
     */
    public function edit(FacilityExternalRequests $facilityExternalRequests, $id)
    {
        $users = Auth::User()->name;
        if($users != NULL)
        {
            $facilityExternalRequests = facilityExternalRequests::find($id);
            $facility_products = FacilityProduct::where('facility_id', '=', $users)->get();
            $request_id = $facilityExternalRequests->request_id;

            $facilityExternalRequestsDetails = FacilityExternalRequestsDetails::where('request_id', '=', $request_id)->get();

            $products = Product::get();
            $facilities = Facility::all();

            return view('subcounty_pharmacist.edit', compact(['users', 'facility_products', 'products', 'facilityExternalRequests', 'facilityExternalRequestsDetails','facilities']));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FacilityExternalRequests  $facilityExternalRequests
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FacilityExternalRequests $facilityExternalRequests, $id)
    {
        $request_id = FacilityExternalRequests::find($id);
        $request_id->status = 2;
        $request_id->update();
        
        $fill_request_details = new FilledStoreRequests();

        $fill_request_detailsCount = count($request->product_name);
        for ($i=0; $i < $fill_request_detailsCount; $i++) { 
            $fill_request_details->product_name = $request->product_name[$i];
            $fill_request_details->strength = $request->strength[$i];
            $fill_request_details->unit_of_issue = $request->unit_of_issue[$i];
            $fill_request_details->unit_size = $request->unit_size[$i];
            $fill_request_details->available_units = $request->available_units[$i];
            $fill_request_details->requested_units = $request->requested_units[$i];
            $fill_request_details->allocated_units = $request->allocated_units[$i];
            $fill_request_details->requested_facility = $request->requested_facility[$i];

            $fill_request_details->request_id = $request_id->request_id;
            $fill_request_details->processed_by = Auth::User()->id;
            $fill_request_details->save();
        }

        $sub_county_details = new SubCountyPharmacist();
        $sub_county_details->request_id = $request_id->request_id;
        $sub_county_details->requested_by = $request_id->requested_by;
        $sub_county_details->request_date = $request_id->request_date;
        $sub_county_details->facility_id = $request_id->facility_id;
        $sub_county_details->status = 2;
        $sub_county_details->save();

        return redirect('/sub_county_pharmacist')->with('status', 'Facility Store Request Filled Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FacilityExternalRequests  $facilityExternalRequests
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacilityExternalRequests $facilityExternalRequests)
    {
        //
    }
}
