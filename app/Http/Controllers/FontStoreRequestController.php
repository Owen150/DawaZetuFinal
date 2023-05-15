<?php

namespace App\Http\Controllers;

use App\Models\FontStoreRequest;
use App\Models\FrontStoreRequstDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FontStoreRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $front_requests = FontStoreRequest::orderBy('created_at','desc')->get();

        return view('front-store-requests.index', compact('front_requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->role !== 'pharmacist') {
            return redirect()->back()->with('unsuccess','You do not have permission to make requests');
        }

        return view('front-store-requests.create', compact('user'));
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
            'facility_id' => 'required',
            'requisition_number' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $front_request = new FontStoreRequest();
            $front_request->facility_id = $request->facility_id;
            $front_request->requisition_number = $request->requisition_number;
            $front_request->requester = $request->user_id;
            $front_request->status = 'pending';
            $front_request->save();
    
            $product_count = count($request->product);
    
            for ($i=0; $i < $product_count; $i++) { 
                $front_request_details = new FrontStoreRequstDetail();
                $front_request_details->font_store_requests_id = $front_request->id;
                $front_request_details->product_id = $request->product_id[$i];
                $front_request_details->quantity = $request->quantity[$i];
                $front_request_details->save();
            }
        });

        return redirect('/front-store-requests')->with('succes','Request has been saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FontStoreRequest  $fontStoreRequest
     * @return \Illuminate\Http\Response
     */
    public function show(FontStoreRequest $fontStoreRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FontStoreRequest  $fontStoreRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(FontStoreRequest $fontStoreRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FontStoreRequest  $fontStoreRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FontStoreRequest $fontStoreRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FontStoreRequest  $fontStoreRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(FontStoreRequest $fontStoreRequest)
    {
        //
    }
}
