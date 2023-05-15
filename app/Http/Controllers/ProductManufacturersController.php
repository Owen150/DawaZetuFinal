<?php

namespace App\Http\Controllers;

use App\Models\ProductManufacturers;
use Illuminate\Http\Request;

class ProductManufacturersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productManufacturers = ProductManufacturers::all();
        return view('productManufacturers.index', compact('productManufacturers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productManufacturers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productManufacturers = $request->validate([
            'name' => 'required',
            'location' => 'required',
        ]);

        // dd($productManufacturers);
        $productManufacturers = new ProductManufacturers();
        $productManufacturers->name = $request->Input('name');
        $productManufacturers->location = $request->Input('location');
        $productManufacturers->save();

        return redirect('/productManufacturers')->with('status', 'Manufacturer added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductManufacturers  $productManufacturers
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productManufacturers = ProductManufacturers::find($id);
        return view('productManufacturers.show', compact('productManufacturers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductManufacturers  $productManufacturers
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productManufacturers = ProductManufacturers::find($id);
        return view('productManufacturers.edit', compact('productManufacturers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductManufacturers  $productManufacturers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $productManufacturers = $request->validate([
            'name' => 'required',
            'location' => 'required',
        ]);

        $productManufacturers = ProductManufacturers::find($id);
        $productManufacturers->name = $request->Input('name');
        $productManufacturers->location = $request->Input('location');
        $productManufacturers->update();

        return redirect('/productManufacturers')->with('status', 'Manufacturer edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductManufacturers  $productManufacturers
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductManufacturers::find($id)->delete();
        return redirect()->back()->with('status', 'Product Manufacturer deleted successfully');
    }

    public function disable(Request $request, $id) 
    {
        // dd('thus');
        $productManufacturers = $request->validate([
            'disabled' => '',
        ]);

        $productManufacturers = ProductManufacturers::find($id);
        if ( $productManufacturers->disabled == false) {
            $disabled = true;

            $productManufacturers->disabled = $disabled;
            $productManufacturers->update();

            return redirect('/productManufacturers')->with('status', 'Manufacturer disabled, click `icon` to reverse');

        } else if ( $productManufacturers->disabled == true ) {
            $disabled = false;

            $productManufacturers->disabled = $disabled;
            $productManufacturers->update();

            return redirect('/productManufacturers')->with('status', 'Manufacturer disabled, click `icon` to reverse');
        }
        //  = $request->Input('disabled'
    }
}
