<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Support\Facades\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $suppliers = new Supplier();
        $suppliers->name = Request::input('name');
        $suppliers->location = Request::input('location');
        $suppliers->license = Request::input('license');
        $suppliers->contracts = Request::input('contracts');
        $suppliers->contract_number = Request::input('contract_number');
        $suppliers->rank = Request::input('rank');

        $suppliers->save();

        return redirect('suppliers')->with('status', 'Supplier profile created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $suppliers, $id)
    {
        $suppliers = Supplier::find($id);
        return view('suppliers.show', compact('suppliers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $suppliers, $id)
    {
        $suppliers = Supplier::find($id);
        return view('suppliers.edit', compact('suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $suppliers, $id)
    {
        $suppliers = Supplier::find($id);
        $suppliers->name = Request::input('name');
        $suppliers->location = Request::input('location');
        $suppliers->license = Request::input('license');
        $suppliers->contracts = Request::input('contracts');
        $suppliers->contract_number = Request::input('contract_number');
        $suppliers->rank = Request::input('rank');
        
        $suppliers->update();

        return redirect('suppliers')->with('status', 'Supplier info updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $suppliers, $id)
    {
        Supplier::find($id)->delete();
        return redirect()->back()->with('status', 'Supplier deleted successfully');
    }
}
