<?php

namespace App\Http\Controllers;

use App\Models\CategoryType;
use Illuminate\Http\Request;

class CategoryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category-type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category-type.create');
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
            'name'=>'required'
        ]);

        $type = new CategoryType();
        $type->name = $request->name;
        
        if ($type->save()) {
            return response(1);
        }

        return response(0);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryType  $categoryType
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryType $categoryType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryType  $categoryType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = CategoryType::find($id);

        return view('category-type.edit')->with('type',$type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoryType  $categoryType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $type = CategoryType::find($id);
        $type->name = $request->name;
        
        if ($type->update()) {
            return response(1);
        }

        return response(0);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryType  $categoryType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = CategoryType::find($id);

        if ($type->delete()) {
            return response(1);
        }

        return response(0);

    }

    /**
     * 
     * index page data
     */
    public function indexData()
    {
        $type = CategoryType::all();

        return response($type);
    }
}
