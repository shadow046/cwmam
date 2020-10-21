<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;
use App\User;
use App\Branch;
use App\Warehouse;
use App\StockRequest;
use App\Stock;
use App\Defective;
use Auth;

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
        /*$users = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'Viewer');
        })->get();
        foreach ($users as $user) {
            $user->syncRoles('Head');
        }
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'Head');
        })->get();
        return dd($user);*/

        if (Auth::user()->branch->branch != "Warehouse") {
            $units = Stock::wherein('status', ['in', 'service unit'])->count();
            $returns = Defective::where('status', '!=', 'Received')->count();
            $stockreq = StockRequest::where('branch_id', Auth::user()->branch->id)
                ->where('status', '!=', '2')
                ->count();
        }else{
            $stockreq = StockRequest::where('status', '!=', '2')->count();
            $units = Warehouse::where('status', 'in')->count();
            $returns = Defective::wherein('status', ['For return', 'For receiving'])->count();
        }

        return view('pages.home', compact('stockreq', 'units', 'returns'));
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
        $users = User::all();
        return view('pages.users', compact('users'));
    }

    public function service_units()
    {
        $users = User::all();
        return view('pages.service-units', compact('users'));
    }

    public function return()
    {
        $users = User::all();
        return view('pages.return', compact('users'));
    }
}
