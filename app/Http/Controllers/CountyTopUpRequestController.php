<?php

namespace App\Http\Controllers;

use App\Models\CountyTopUpRequest;
use App\Models\FacilityProduct;
use App\Models\StoreTopUp;
use App\Models\StoreTopUpDetails;
use App\Models\TopUp;
use Illuminate\Http\Request;

class CountyTopUpRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topups = StoreTopUp::where('status', '=', 'processed')->get();
        return view('county-top-up-requests.index', compact('topups'));
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
     * @param  \App\Models\CountyTopUpRequest  $countyTopUpRequest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topups = StoreTopUp::find($id);
        $topupdetails = StoreTopUpDetails::where('request_id', '=', $topups->id )->get();
        return view('county-top-up-requests.processed', compact('topups', 'topupdetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CountyTopUpRequest  $countyTopUpRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(CountyTopUpRequest $countyTopUpRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CountyTopUpRequest  $countyTopUpRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $topups = StoreTopUp::find($id);
        $topups->status = $request->status;
        $topups->status = 'approved';

        if ($topups->update()) {
            return redirect()->back()
                ->with('success', 'Status updated successfully');
        }
        return redirect()->back()
            ->with('unsuccess', 'System Error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CountyTopUpRequest  $countyTopUpRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(CountyTopUpRequest $countyTopUpRequest)
    {
        //
    }

    public function comment(Request $request, $id)
    {
        $topups = StoreTopUp::find($id);
        $topups->comment = $request->comment;
        $topups->status = 'ammended';

        if ($topups->update()) {
            return redirect()->back()
                ->with('success', 'Status updated successfully');
        }
        return redirect()->back()
            ->with('unsuccess', 'System Error');
    }
}
