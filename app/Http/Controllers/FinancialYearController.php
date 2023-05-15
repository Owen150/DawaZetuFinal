<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FinancialYear;

class FinancialYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $financialYears = FinancialYear::all();
        
        return view('financialYear.index', compact('financialYears'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('financialYear.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $financialYears = new FinancialYear();
        $financialYears->name = $request->input('name');
        $financialYears->start_date = $request->input('start_date'); 
        $financialYears->end_date = $request->input('end_date'); 

        $financialYears->save();

        return redirect('financialYear')->with('status', 'Financial Year added successfully');
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
        $financialYears = FinancialYear::find($id);
        return view('financialYear.edit', compact('financialYears'));
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
        $financialYears = FinancialYear::find($id);
        $financialYears->name = $request->input('name');
        $financialYears->start_date = $request->input('start_date'); 
        $financialYears->end_date = $request->input('end_date'); 

        $financialYears->update();

        return redirect('financialYear')->with('status', 'Financial Year updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FinancialYear::find($id)->delete();
        return redirect()->back()->with('status', 'Financial Year deleted successfully');
    }
}
