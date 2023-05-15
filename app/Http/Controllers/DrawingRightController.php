<?php

namespace App\Http\Controllers;

use App\Models\AllocatedBudget;
use App\Models\DrawingRight;
use App\Models\Facility;
use App\Models\FinancialYear;
use Illuminate\Http\Request;
use stdClass;

class DrawingRightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('drawing-rights.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $finacialReference = FinancialYear::orderBy('created_at','desc');
    
        $financialYear = $finacialReference->first();

        if (!$financialYear) {
            return redirect()->back()->with('unsuccess','Please add finacial year');
        }

        $allocatedBudget = AllocatedBudget::where('finacial_year_id', '=', $financialYear->id)
            ->where('period', '=', getFinacialPeriod())
            ->orderBy('created_at','desc')->first();

        if (! $allocatedBudget) {
            return redirect()->back()->with('unsuccess','Please add allocated budget to proceed');
        }

        $facilities = Facility::all();

        $allFinancialYears = $finacialReference->get();
        


        if ($facilities->isEmpty()) {
            return redirect()->back()->with('unsuccess','Please add facility to proceed');
        }

        $budget = 0;

        $existingDrawingRights = DrawingRight::where('allocated_budget_id', '=', $allocatedBudget->id)->get();

        foreach ($existingDrawingRights as $item) {

         
            $budget += (int)  $item->amount;
        }

        $finalBudget = $allocatedBudget->budget - $budget;

        

        return view('drawing-rights.create')->with([
            'financialYear' => $financialYear,
            'budget_left' => $finalBudget,
            'facilities' => $facilities,
            'allFinancialYears' => $allFinancialYears,
            'allocatedBudget' => $allocatedBudget
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
            'facility' => 'required',
            'workload' => 'required',
            'amount' => 'required',
            'end_date' => 'required',
            'allocated_budget'=> 'required'
        ]);

        $finacialReference = FinancialYear::orderBy('created_at','desc');
    
        $financialYear = $finacialReference->first();

        $count = count($request->facility);

        $total = 0;

        for ($i=0; $i < $count; $i++) { 
            $total += $request->amount[$i];
            $rights = new DrawingRight();
            $rights->facility_id = $request->facility[$i];
            $rights->finacial_year_id = $financialYear->id;
            $rights->workload = $request->workload[$i];
            $rights->period = getFinacialPeriod();
            $rights->amount = $request->amount[$i];
            $rights->used_amount = 0;
            $rights->original_amount = $request->original_amount;
            $rights->end_date = $request->end_date;
            $rights->allocated_budget_id = $request->allocated_budget;
            
            $rights->save();
               
        }

       

        return redirect()->route('drawing-rights.index')->with('success', 'Rights have been allocated');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DrawingRight  $drawingRight
     * @return \Illuminate\Http\Response
     */
    public function show(DrawingRight $drawingRight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DrawingRight  $drawingRight
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $right = DrawingRight::find($id);

        return view('drawing-rights.edit')->with('right', $right);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DrawingRight  $drawingRight
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'finacial_year' => 'required',
            'facility' => 'required',
            'worload' => 'required',
            'period' => 'required',
            'amount' => 'required',
            'end_date' => 'required',
        ]);


        $rights = DrawingRight::find($id);
        $rights->facility_id = $request->facility;
        $rights->finacial_year_id = $request->finacial_year;
        $rights->workload = $request->worload;
        $rights->period = $request->period;
        $rights->amount = $request->amount;
        $rights->end_date = $request->end_date;
        $rights->allocated_budget_id = $request->allocated_budget;
        
        if ($rights->update()) {
            return response(1);
        }

        return response(0);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DrawingRight  $drawingRight
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $right =  DrawingRight::find($id);
        
        if ($right->delete()) {
            return response(1);
        } 
        return response(0);
    }

    public function indexData()
    {
        $rights = DrawingRight::orderBy('finacial_year_id', 'desc')->get();

        //empty array to store object
        $rightArr = [];

        foreach ($rights as $right) {
            $obj = new stdClass;
            $obj->id = $right->id;
            $obj->facility_id = Facility::where('id','=',$right->facility_id)->first()->name;
            $obj->finacial_year_id = FinancialYear::where('id','=',$right->finacial_year_id)->first()->name;
            $obj->workload = $right->workload;
            $obj->period = $right->period;
            $obj->amount = number_format($right->original_amount, 2);
            $obj->end_date = $right->end_date;
            $obj->used_amount = number_format($right->used_amount, 2);

            array_push($rightArr, $obj);
        }

        return response($rightArr);
    }

    /***
     * 
     * facility data for drawing rights
     * 
     */
    public function facilityData($id)
    {
        $facility = Facility::find($id);

        if ($facility) {
            return response($facility);
        }
        return response(0);

    }
}
