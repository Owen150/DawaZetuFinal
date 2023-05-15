<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\AuthSuppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthSuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('suppliers.auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if(!Auth::validate($credentials)):
            return redirect()->to('suppliers')
                ->withErrors(trans('auth.failed'));
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

        return $this->authenticated($request, $user);
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
     * @param  \App\Models\AuthSuppliers  $authSuppliers
     * @return \Illuminate\Http\Response
     */
    public function show(AuthSuppliers $authSuppliers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AuthSuppliers  $authSuppliers
     * @return \Illuminate\Http\Response
     */
    public function edit(AuthSuppliers $authSuppliers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AuthSuppliers  $authSuppliers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AuthSuppliers $authSuppliers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AuthSuppliers  $authSuppliers
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuthSuppliers $authSuppliers)
    {
        //
    }
}
