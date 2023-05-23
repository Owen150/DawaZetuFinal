<?php

namespace App\Http\Controllers;

use App\Models\County;
use App\Models\FinancialYear;
use App\Models\Location;
use App\Models\Role;
use App\Models\Subcounty;
use App\Models\Ward;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $counties = County::all();
        $subcounties = Subcounty::all();
        $wards = Ward::all();
        $locations = Location::all();
        $financialYears = FinancialYear::all();
        return view('settings.index', compact(['counties', 'subcounties', 'wards', 'locations', 'financialYears']));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function storeCounty(Request $request)
    {
        $request->validate([
            'county_name' => 'required'
        ]);

        County::create($request->all());
        return redirect()->route('settings_index')
            ->with('success', 'County Added Successfully');
    }

    public function storeSubcounty(Request $request)
    {
        $request->validate([
            'county_id' => 'required',
            'subcounty_name' => 'required'
        ]);

        Subcounty::create($request->all());
        return redirect()->route('settings_index')
            ->with('success', 'Subcounty Added Successfully');
    }

    public function storeWard(Request $request)
    {
        $request->validate([
            'county_id' => 'required',
            'subcounty_id' => 'required',
            'ward_name' => 'required',
        ]);

        Ward::create($request->all());
        return redirect()->route('settings_index')
            ->with('success', 'Ward Created Successfully');
    }

    public function storeLocation(Request $request)
    {
        $request->validate([
            'county_id' => 'required',
            'subcounty_id' => 'required',
            'ward_id' => 'required',
            'location_name' => 'required'
        ]);

        Location::create($request->all());
        return redirect()->route('settings_index')
            ->with('success', 'Location Created Successfully');
    }

    public function storeFinancialYear(Request $request)
    {
        $financialYears = new FinancialYear();
        $financialYears->name = $request->input('name');
        $financialYears->start_date = $request->input('start_date');
        $financialYears->end_date = $request->input('end_date');
        $financialYears->save();

        return redirect()->route('settings_index')
            ->with('success', 'Financial Year added successfully');
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'role_name' => 'required',
            'role_initials' => 'required'
        ]);

        Role::create($request->all());

        return redirect()->route('settings_index')
            ->with('success', 'Role created successfully');
    }
}
