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

class SubCountyPharmacistController extends Controller
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

        return view('subcounty_pharmacist.index', compact(['facility_requests', 'facilityExternalRequests']));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCountyPharmacist  $subCountyPharmacist
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $facilityExternalRequestsID = FacilityExternalRequests::find($id);
        // dd($facilityExternalRequests->request_id);
        $users = Auth::User()->name;
        if($users != NULL)
        {
            $facilityExternalRequests = SubCountyPharmacist::find($id);
            // where('request_id', '=', $facilityExternalRequestsID->request_id)->get('status');
            // dd($facilityExternalRequests);
            if ($facilityExternalRequests->status == 2) {
                # code...
                $facility_products = FacilityProduct::where('facility_id', '=', $users)->get();
                $request_id = $facilityExternalRequests->request_id;
                
                $facilityExternalRequestsDetails = FilledStoreRequests::where('request_id', '=', $request_id)->get();
                $products = Product::get();
                $facilities = Facility::all();
                
                // APPROVED AND PROCESSED
                return view('county_pharmacist.show', compact(['users', 'facility_products', 'products', 'facilityExternalRequests', 'facilityExternalRequestsDetails', 'facilities']));
            }
            elseif ( $facilityExternalRequests->status == 3) {
                # code...
                $facility_products = FacilityProduct::where('facility_id', '=', $users)->get();
                $request_id = $facilityExternalRequests->request_id;
                
                $facilityExternalRequestsDetails = FilledStoreRequests::where('request_id', '=', $request_id)->get();
                $products = Product::get();
                $facilities = Facility::all();
                
                // APPROVED AND PROCESSED
                return view('facility_requests.facility_details_views.show_county_approved', compact(['users', 'facility_products', 'products', 'facilityExternalRequests', 'facilityExternalRequestsDetails', 'facilities']));
            }
            elseif ($facilityExternalRequests->status == 4 ) {
                # code...
                $facility_products = FacilityProduct::where('facility_id', '=', $users)->get();
                $request_id = $facilityExternalRequests->request_id;
                
                $facilityExternalRequestsDetails = FilledStoreRequests::where('request_id', '=', $request_id)->get();
                $comments = CountyPharmacist::where('request_id', '=', $request_id)->get();
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
     * @param  \App\Models\SubCountyPharmacist  $subCountyPharmacist
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCountyPharmacist $subCountyPharmacist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCountyPharmacist  $subCountyPharmacist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCountyPharmacist $subCountyPharmacist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCountyPharmacist  $subCountyPharmacist
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCountyPharmacist $subCountyPharmacist)
    {
        //
    }
}
