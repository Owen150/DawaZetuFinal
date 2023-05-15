<?php

namespace App\Http\Controllers;

use App\Models\Consolidate;
use App\Models\ConsolidatedPurchaseOrder;
use App\Models\Facility;
use App\Models\FinancialYear;
use App\Models\InvoiceProforma;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class InvoiceProformaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoiceProforma = InvoiceProforma::orderBy('created_at','desc')->get();

        $suppliers = Supplier::all();

        return view('profomas.index', compact('invoiceProforma', 'suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facilities = Facility::all();
        $financialYears = FinancialYear::all();
        $users = User::all();
        return view('profomas.create')->with([
            'facilities' => $facilities,
            'financialYears' => $financialYears,
            'users' => $users,
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
            'financial_year_id' => 'required',
            'facility_id' => 'required',
            'total' => 'required',
            'status' => 'required',
            'lpo' => 'required',
            'approved_for_supply' => 'required',
        ]);

        InvoiceProforma::create($request->all());

        return redirect()->route('profomas.index')
            ->with('success', 'Invoice created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InvoiceProforma  $invoiceProforma
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoiceProforma = InvoiceProforma::find($id);

        $consolidations = ConsolidatedPurchaseOrder::where('invoice_profoma_id','=', $invoiceProforma->id)->get();

        //stores purchase order id from consolidated purchase order
        $colls = new Collection();

        $arr = [];

        foreach ($consolidations as $consolidation) {

            //array_push($arr, $consolidation->purchase_order_id);

            $colls->push($consolidation->purchase_order_id);
        }


        return view('profomas.show', compact('invoiceProforma', 'consolidations','colls'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvoiceProforma  $invoiceProforma
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceProforma $invoiceProforma)
    {
        $facilities = Facility::all();
        $financialYears = FinancialYear::all();
        $invoiceProforma = InvoiceProforma::find($invoiceProforma);
        return view('profomas.edit')->with([
            'facilities' => $facilities,
            'financial_years' => $financialYears,
            'invoice_proforma' => $invoiceProforma,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvoiceProforma  $invoiceProforma
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoiceProforma $invoiceProforma)
    {
        $request->validate([]);
        $invoiceProforma = InvoiceProforma::find($invoiceProforma);
        $invoiceProforma->update($request->all());

        return redirect()->route('profomas.index')
            ->with('success', 'Invoice updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvoiceProforma  $invoiceProforma
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoiceProforma $invoiceProforma)
    {
        $invoiceProforma = InvoiceProforma::find($invoiceProforma);
        $invoiceProforma->delete();
        return redirect()->route('profomas.index')
            ->with('success', 'Invoice deleted successfully');
    }
}
