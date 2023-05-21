<?php

namespace App\Http\Controllers;

use App\Models\County;
use App\Models\Facility;
use App\Models\Location;
use App\Models\Subcounty;
use App\Models\Ward;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('facilities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcounty = Subcounty::all();
        $wards = Ward::all();
        $location = Location::all();
        return view('facilities.create')->with([
            'subcounty' => $subcounty,
            'wards' => $wards,
            'location' => $location
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'contact_num' => 'required',
            'sub_county' => 'required',
            'ward' => 'required',
            'location' => 'required',
        ]);

        $facilities = new Facility();
        $facilities->name = $request->name;
        $facilities->type = $request->type;
        $facilities->address = $request->address;
        $facilities->email = $request->email;
        $facilities->contact_num = $request->contact_num;
        $facilities->sub_county = $request->sub_county;
        $facilities->ward = $request->ward;
        $facilities->location = $request->location;
        $facilities->lat = 0;
        $facilities->lng = 0;

        if ($facilities->save()) {
            return response(1);
        }

        return response(0);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function show(Facility $facility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $facility = Facility::find($id);

        return view('facilities.edit')->with('facility', $facility);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'contact_num' => 'required',
            'sub_county'> 'required',
            'ward' => 'required',
            'location' => 'required',
        ]);

        $facilities = Facility::find($id);
        $facilities->name = $request->name;
        $facilities->type = $request->type;
        $facilities->address = $request->address;
        $facilities->email = $request->email;
        $facilities->contact_num = $request->contact_num;
        $facilities->sub_county = $request->sub_county;
        $facilities->ward = $request->ward;
        $facilities->location = $request->location;
        $facilities->lat = 0;
        $facilities->lng = 0;

        if ($facilities->update()) {
            return response(1);
        }

        return response(0);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $right =  Facility::find($id);
        
        if ($right->delete()) {
            return response(1);
        } 
        return response(0);
    }

    public function indexData()
    {
        $facilities = Facility::orderBy('type', 'desc')->get();

        return response($facilities);
    }
    /**
     * 
     * facility requisitions
     */
}
