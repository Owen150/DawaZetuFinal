<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * 
     * for executive dashboard
     */
    public function index()
    {
        return view('dashboard');
    }


    /**
     * 
     * for facilities dashboard
     * 
     */
    public function facilityDashboard()
    {
        return view('facility-dashboard');
    }


    /**
     * 
     * for scp dashboard
     * 
     */
    public function scpDashboard()
    {
        return view('scp_dashboard');
    }

    /**
     * 
     * for co dashboard
     * 
     */
    public function coDashboard()
    {
        return view('co_dashboard');
    }
}
