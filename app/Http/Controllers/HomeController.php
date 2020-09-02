<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;

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
     */
    public function index()
    {
        //return Activity::all();
        return view('pages.home');
    }
    public function service_center()
    {
        return view('pages.service-center');
    }
    public function customer()
    {
        return view('pages.customer');
    }
    public function stock_request()
    {
        return view('pages.stock-request');
    }
    public function users()
    {
        return view('pages.users');
    }
}
