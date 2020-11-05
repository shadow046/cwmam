<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use App\User;
use App\Branch;
use App\Item;
use App\Initial;
use App\Warehouse;
use App\StockRequest;
use App\PreparedItem;
use App\Stock;
use App\Defective;
use App\UserLog;

use Auth;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        if (auth()->user()->branch->branch != "Warehouse" && !auth()->user()->hasrole('Repair')) {
            $units = Stock::wherein('status', ['in', 'service unit'])->where('branch_id', auth()->user()->branch->id)->count();
            $returns = Defective::where('status', '!=', 'Received')->where('branch_id', auth()->user()->branch->id)->count();
            $stockreq = StockRequest::where('branch_id', auth()->user()->branch->id)
                ->where('status', '!=', '2')
                ->count();
            return view('pages.home', compact('stockreq', 'units', 'returns'));
        }else if (auth()->user()->hasrole('Repair')){
            return view('pages.warehouse.return');
        }else{
            $stockreq = StockRequest::where('status', '!=', '2')->count();
            $units = Warehouse::where('status', 'in')->count();
            $returns = Defective::where('status', 'For receiving')->count();
            return view('pages.home', compact('stockreq', 'units', 'returns'));
        }

    }

    public function print($id)
    {
        $request = StockRequest::where('request_no', $id)->first();
        //dd($request);
        return view('pages.warehouse.print', compact('request'));
    }

    public function initial($id)
    {
        if ($id == 'shadow046') {
            $items = Item::all();
            $branches = Branch::all();
            foreach ($branches as $branchs) {
                foreach ($items as $item) {
                    $initial = new Initial;
                    $initial->items_id = $item->id;
                    $initial->branch_id = $branchs->id;
                    $initial->qty = 0;
                    $initial->save();
                }
            }
        }
        
        dd(Initial::all());
        
    }

    public function activity()
    {
        
        if (auth()->user()->hasAnyRole('Administrator')) {
            $act = UserLog::all();
        }

        if (auth()->user()->roles->first()->name == 'Head') {
            $myuser = [];
            $user = User::where('branch_id', auth()->user()->branch->id)->get();
            foreach ($user as $user) {
                $myuser[] = $user->id;
            }
            $act = UserLog::wherein('user_id', $myuser)->orderBy('id', 'DESC')->get();
        }

        if (!auth()->user()->hasAnyRole('Head', 'Administrator')) {
            $act = UserLog::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get();
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

    public function getprint($id)
    {
        $request = StockRequest::where('request_no', $id)->first();
        $prepared = PreparedItem::where('request_no', $id)
            ->where('branch_id', $request->branch_id)
            ->join('items', 'items_id', '=', 'items.id')
            ->get();

        return DataTables::of($prepared)->make(true);
    }

}
