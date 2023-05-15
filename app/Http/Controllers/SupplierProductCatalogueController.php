<?php

namespace App\Http\Controllers;

use App\Exports\SupplierCatalogue;
use App\Exports\SupplierExistingCatalogue;
use App\Imports\SupplierCatalogue as ImportsSupplierCatalogue;
use App\Models\Supplier;
use App\Models\SupplierProductCatalogue;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SupplierProductCatalogueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplierProductCatalogue = SupplierProductCatalogue::orderBy('created_at', 'desc')->get();
        $suppliers = Supplier::all();
        return view('supplier-product-catalogue.index', compact('supplierProductCatalogue', 'suppliers'));
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
     * @param  \App\Models\SupplierProductCatalogue  $supplierProductCatalogue
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierProductCatalogue $supplierProductCatalogue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupplierProductCatalogue  $supplierProductCatalogue
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplierProductCatalogue $supplierProductCatalogue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupplierProductCatalogue  $supplierProductCatalogue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupplierProductCatalogue $supplierProductCatalogue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplierProductCatalogue  $supplierProductCatalogue
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierProductCatalogue $supplierProductCatalogue)
    {
        //
    }

    /**
     * 
     * supplier product catalogue download 
     * 
     */
    public function excelDownload(Request $request)
    {   //get selected supplier
        $supplierId = Supplier::where('id','=', $request->supplier)->first();

        $checkSupplierId = SupplierProductCatalogue::where('supplier_id','=',$request->supplier)->get();

        if ($checkSupplierId->isNotEmpty()) {
            return Excel::download(new SupplierExistingCatalogue($supplierId->id), $supplierId->name.'_catalogue.xlsx');
        }

        return Excel::download(new SupplierCatalogue($supplierId->id), $supplierId->name.'_catalogue.xlsx');
    }

    /**
     * 
     * supplier product catalogue download 
     * 
     */
    public function excelUpload(Request $request)
    {  
        try {
            Excel::import(new ImportsSupplierCatalogue(), request()->file('supplier_catalogue'));
        } catch (QueryException $th) {
            return redirect()->back()->with('unsuccess','Check your excel file for any missing values');
        }
         
        return redirect()->back()->with('success','file uploaded successfully');
    }
}
