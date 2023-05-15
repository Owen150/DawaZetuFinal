<?php

namespace App\Http\Controllers;

use App\Exports\ExistingSupplierProductExport;
use App\Exports\SupplierProductExport;
use App\Imports\SupplierProductImport;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\SupplierProduct;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use stdClass;

class SupplierProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();

        return view('suppler-product.index')->with('suppliers', $suppliers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplers = Supplier::orderBy('created_at','desc')->get();
        $products = Product::orderBy('created_at','desc')->get();

        return view('suppler-product.create')->with([
            'suppliers' =>$supplers,
            'products'=> $products
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
            'supplier' => 'required|integer',
            'product' => 'required|integer',
            'code' => 'required',
            'price' => 'required'
        ]);

        $supplerProduct = new SupplierProduct();
        $supplerProduct->suplier_id = $request->supplier;
        $supplerProduct->product_id = $request->product;
        $supplerProduct->suplier_product_code = $request->code;
        $supplerProduct->product_price = $request->price;

        if ($supplerProduct->save()) {
            return response(1);
        }

        return response(0);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupplierProduct  $supplierProduct
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierProduct $supplierProduct)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupplierProduct  $supplierProduct
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplerProduct = SupplierProduct::find($id);

        $supplers = Supplier::orderBy('created_at','desc')->get();

        $products = Product::orderBy('created_at','desc')->get();

        return view('suppler-product.edit')->with([
            'supplierProduct' => $supplerProduct,
            'suppliers' =>$supplers,
            'products'=> $products
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupplierProduct  $supplierProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier' => 'required|integer',
            'product' => 'required|integer',
            'code' => 'required',
            'price' => 'required'
        ]);

        $supplerProduct = SupplierProduct::find($id);
        $supplerProduct->suplier_id = $request->supplier;
        $supplerProduct->product_id = $request->product;
        $supplerProduct->suplier_product_code = $request->code;
        $supplerProduct->product_price = $request->price;

        if ($supplerProduct->update()) {
            return response(1);
        }

        return response(0);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplierProduct  $supplierProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplerProduct = SupplierProduct::find($id);

        if ($supplerProduct->delete()) {
            return response(1);
        } 
        return response(0);
    }


    public function indexData()
    {
        $supplerProducts = SupplierProduct::orderBy('created_at', 'desc')->get();

        $sp_arr = [];

        foreach ($supplerProducts as $supplerProduct) {
            $obj = new stdClass;
            $obj->suplier_id = Supplier::where('id', '=', $supplerProduct->suplier_id)->first()->name;
            $obj->product_id = Product::where('id','=',$supplerProduct->product_id)->first()->product_name;
            $obj->suplier_product_code = $supplerProduct->suplier_product_code;
            $obj->price = $supplerProduct->product_price;

            array_push($sp_arr, $obj);
        }

        return response($sp_arr);
    }

    /**
     * 
     * Download supplier product excel sheet
     * 
     */
    public function excelDownload(Request $request)
    {
        $supplierId = Supplier::where('id','=', $request->supplier)->first();

        if (! $supplierId) {
            return redirect()->back()->with('unsuccess', 'Supplier was not found');
        }

        $checkSupplierId = SupplierProduct::where('suplier_id','=',$request->supplier)->get();


        if ($checkSupplierId->isNotEmpty()) {
            return Excel::download(new ExistingSupplierProductExport($supplierId->id), $supplierId->name.'_supplier.xlsx');
        }

        return Excel::download(new SupplierProductExport($supplierId->id, $supplierId->name), $supplierId->name.'_supplier.xlsx');
    }

    /**
     * 
     * upload excel file and initiate storing process
     * by default the process is queued
     * 
     */
    public function excelUpload(Request $request)
    {
        try {
            Excel::import(new SupplierProductImport(), request()->file('supplier_product'));
        } catch (QueryException $th) {
            return redirect()->back()->with('unsuccess','Check your excel file for any missing values');
        }
       
        return redirect()->back()->with('success','file uploaded successfully');
    }
}
