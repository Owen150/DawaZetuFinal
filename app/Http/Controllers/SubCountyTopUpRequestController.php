<?php

namespace App\Http\Controllers;

use App\Models\FacilityProduct;
use App\Models\SubCountyTopUpRequest;
use App\Models\TopUp;
use Illuminate\Http\Request;

class SubCountyTopUpRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topups = TopUp::where('status', '=' , 'processed')->get(); 
        return view('sub-county-top-up-requests.index', compact('topups'));
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
     * @param  \App\Models\SubCountyTopUpRequest  $subCountyTopUpRequest
     * @return \Illuminate\Http\Response
     */
    public function show(SubCountyTopUpRequest $subCountyTopUpRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCountyTopUpRequest  $subCountyTopUpRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCountyTopUpRequest $subCountyTopUpRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCountyTopUpRequest  $subCountyTopUpRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCountyTopUpRequest $subCountyTopUpRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCountyTopUpRequest  $subCountyTopUpRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCountyTopUpRequest $subCountyTopUpRequest)
    {
        //
    }
}
