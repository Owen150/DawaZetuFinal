<?php

namespace App\Http\Controllers;

use App\Models\CountyPharmacist;
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

class CountyPharmacistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facility_requests = FacilityLocalRequests::all();
        $facilityExternalRequests = FacilityExternalRequests::where('status', '=', 2)->get();
        $approvedExternalRequests = FacilityExternalRequests::where('status', '=', 3)->get();
        $amendedExternalRequests = FacilityExternalRequests::where('status', '=', 4)->get();

        return view('county_pharmacist.index', compact(['facility_requests', 'facilityExternalRequests', 'approvedExternalRequests', 'amendedExternalRequests']));
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
        $id = $request->id;
        $request_id = $request->request_id;

        if ($request->comments != NULL) {
            # code...
            $amended_requests = new CountyPharmacist();
            $amended_requests->requested_by = $request->requested_by;
            $amended_requests->request_date = $request->request_date;
            $amended_requests->processed_by = $request->processed_by;
            $amended_requests->facility_id = $request->facility_id;
            $amended_requests->comments = $request->comments;

            $amended_requests->status = 4;
            $amended_requests->request_id = $request_id;
        
            $amended_requests->save();

            $sub_county_details = SubCountyPharmacist::where('request_id', '=', $request->request_id)
                                                    ->update(['status' => 4]);

            $request_id = FacilityExternalRequests::where('request_id', '=', $request->request_id)
                                                    ->update(['status' => 4]);

            return redirect('/county_pharmacist')->with('status', 'Sub County Request Amendment created successfully');
            // dd('NULL');
        }
        elseif ($request->comments == NULL ) {
            // REQUEST APPROVED
            $sub_county_details = SubCountyPharmacist::where('request_id', '=', $request->request_id)
                                                    ->update(['status' => 3]);

            $request_id = FacilityExternalRequests::where('request_id', '=', $request->request_id)
                                                    ->update(['status' => 3]);

            return redirect('/county_pharmacist')->with('status', 'Sub County Request Approved Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CountyPharmacist  $countyPharmacist
     * @return \Illuminate\Http\Response
     */
    public function show(CountyPharmacist $countyPharmacist, $id)
    {
       return view('county_pharmacist.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CountyPharmacist  $countyPharmacist
     * @return \Illuminate\Http\Response
     */
    public function edit(CountyPharmacist $countyPharmacist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CountyPharmacist  $countyPharmacist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CountyPharmacist $countyPharmacist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CountyPharmacist  $countyPharmacist
     * @return \Illuminate\Http\Response
     */
    public function destroy(CountyPharmacist $countyPharmacist)
    {
        //
    }
}
