<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use App\User;
use App\Branch;
use App\Warehouse;
use App\StockRequest;
use App\Stock;
use App\Defective;
use App\UserLog;

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

        if (auth()->user()->branch->branch != "Warehouse") {
            $units = Stock::wherein('status', ['in', 'service unit'])->count();
            $returns = Defective::where('status', '!=', 'Received')->count();
            $stockreq = StockRequest::where('branch_id', auth()->user()->branch->id)
                ->where('status', '!=', '2')
                ->count();
        }else{
            $stockreq = StockRequest::where('status', '!=', '2')->count();
            $units = Warehouse::where('status', 'in')->count();
            $returns = Defective::wherein('status', ['For return', 'For receiving'])->count();
        }

        return view('pages.home', compact('stockreq', 'units', 'returns'));
    }

    public function activity()
    {
        if (auth()->user()->roles->first()->name == 'Administrator') {
            $act = UserLog::all();
        }else{
            $act = UserLog::where('user_id', auth()->user()->id);
        }
        
        //dd($act);
        return DataTables::of($act)
        
        ->addColumn('date', function (UserLog $request){

            return $request->updated_at->toFormattedDateString();

        })

        ->addColumn('time', function (UserLog $request){
            return $request->updated_at->toTimeString();

        })

        ->addColumn('username', function (UserLog $request){
            $username = User::where('id', $request->user_id)->first();
            return $username->email;
        })

        ->addColumn('fullname', function (UserLog $request){
            $username = User::where('id', $request->user_id)->first();
            return $username->name;
        })

        ->addColumn('userlevel', function (UserLog $request){
            $username = User::where('id', $request->user_id)->first();
            return $username->roles->first()->name;
        })
                
        ->make(true);

    }
    
    public function service_units()
    {
        $users = User::all();
        return view('pages.service-units', compact('users'));
    }

}
