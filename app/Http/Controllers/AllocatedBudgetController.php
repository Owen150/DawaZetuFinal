<?php

namespace App\Http\Controllers;

use App\Models\AllocatedBudget;
use App\Models\FinancialYear;
use Illuminate\Http\Request;
use stdClass;

class AllocatedBudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('allocated-budget.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $finacialYear = FinancialYear::orderBy('created_at','desc')->first();

        if (! $finacialYear) {
            return redirect()->back()->with('unsuccess','Please create financial year');
        }

        return view('allocated-budget.create')->with('finacialYear', $finacialYear);
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
            'financial_year' => 'required|integer',
            'period'=> 'required',
            'budget' => 'required'
        ]);

        $allocatedBudget = new AllocatedBudget();
        $allocatedBudget->finacial_year_id = $request->financial_year;
        $allocatedBudget->period = $request->period;
        $allocatedBudget->budget = $request->budget;

        if ($allocatedBudget->save()) {
            return response(1);
        }

        return response(0);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AllocatedBudget  $allocatedBudget
     * @return \Illuminate\Http\Response
     */
    public function show(AllocatedBudget $allocatedBudget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AllocatedBudget  $allocatedBudget
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $finacialYear = FinancialYear::orderBy('created_at','desc')->get();

        

        $allocatedBudget = AllocatedBudget::find($id);

        return view('allocated-budget.edit')->with([
            'finacialYear' => $finacialYear,
            'allocatedBudget' => $allocatedBudget
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AllocatedBudget  $allocatedBudget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'financial_year' => 'required|integer',
            'period'=> 'required',
            'budget' => 'required'
        ]);

        $allocatedBudget = AllocatedBudget::find($id);
        $allocatedBudget->finacial_year_id = $request->financial_year;
        $allocatedBudget->period = $request->period;
        $allocatedBudget->budget = $request->budget;

        if ($allocatedBudget->save()) {
            return response(1);
        }

        return response(0);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AllocatedBudget  $allocatedBudget
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $allocatedBudget = AllocatedBudget::find($id);

        if ($allocatedBudget->delete()) {
            return response(1);
        }

        response(0);
    }

    /**
     * index data
     */
    public function indexData()
    {
        $allocatedBudget = AllocatedBudget::orderBy('created_at','desc')->get();

        $allocatedBudgetArr = [];

    

        foreach ($allocatedBudget as $budget) {
            $obj = new stdClass;
            $obj->id = $budget->id;
            $obj->financial_year = FinancialYear::where('id','=',$budget->finacial_year_id)->first()->name;
            $obj->period = $budget->period;
            $obj->budget = $budget->budget;


            array_push($allocatedBudgetArr, $obj);
        }

        return response($allocatedBudgetArr);
    }
}
