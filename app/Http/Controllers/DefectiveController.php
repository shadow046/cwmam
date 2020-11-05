<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\User;
use App\Defective;
use App\Branch;
use App\Item;
use App\UserLog;
use Auth;
class DefectiveController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $users = User::all();
        if (auth()->user()->branch->branch != 'Warehouse') {
            return view('pages.branch.return', compact('users'));
        }else{
            return view('pages.warehouse.return', compact('users'));
        }
    }

    public function table()
    {
        $defective = Defective::select('defectives.updated_at', 'branch_id as branchid', 'defectives.id as id', 'items.item', 'items.id as itemid', 'defectives.serial', 'defectives.status')
            ->where('branch_id', auth()->user()->branch->id)
            ->join('items', 'defectives.items_id', '=', 'items.id')
            ->where('status', '!=', 'received')
            ->get();
            
        $waredef =Defective::select('branches.branch', 'branches.id as branchid', 'defectives.updated_at', 'defectives.id as id', 'items.item', 'items.id as itemid', 'defectives.serial', 'defectives.status')
            ->where('defectives.status', 'For receiving')
            ->join('items', 'defectives.items_id', '=', 'items.id')
            ->join('branches', 'defectives.branch_id', '=', 'branches.id')
            ->get();

        $repair = Defective::select('branches.branch', 'branches.id as branchid', 'defectives.updated_at', 'defectives.id as id', 'items.item', 'items.id as itemid', 'defectives.serial', 'defectives.status')
            ->where('defectives.status', 'Received')
            ->join('items', 'defectives.items_id', '=', 'items.id')
            ->join('branches', 'defectives.branch_id', '=', 'branches.id')
            ->get();

        if (auth()->user()->branch->branch == 'Warehouse' && !auth()->user()->hasrole('Repair')) {
            $data = $waredef;
        }else if (auth()->user()->branch->branch == 'Warehouse' && auth()->user()->hasrole('Repair')){
            $data = $repair;
        }else{
            $data = $defective;
        }
        return DataTables::of($data)
        
        ->addColumn('date', function (Defective $data){
            return $data->updated_at->toFormattedDateString().' '.$data->updated_at->toTimeString();
        })

        ->addColumn('category', function (Defective $data){

            $cat = Item::select('categories.category')
                ->where('items.id', $data->itemid)
                ->join('categories', 'items.category_id', '=', 'categories.id')
                ->first();
            return $cat->category;
        })

        ->addColumn('status', function (Defective $data){

            if ($data->status == 'in') {
                return 'For return';
            }else{
                return $data->status;
            }
        })

        ->make(true);
    }

    public function update(Request $request)
    {
        if (auth()->user()->branch->branch != 'Warehouse') {

            $update = Defective::where('branch_id', auth()->user()->branch->id)
                ->where('id', $request->id)
                ->where('status', 'For return')
                ->first();
            $item = Item::where('id', $update->items_id)->first();
            $branch = Branch::where('id', auth()->user()->branch->id)->first();

            $log = new UserLog;
            $log->activity = "Return defective $item->item to warehouse." ;
            $log->user_id = auth()->user()->id;
            $log->save();
            $update->status = $request->status;
            $update->user_id = auth()->user()->id;
            $data = $update->save();

        }else{
            if ($request->status == 'Received') {
                $update = Defective::where('id', $request->id)
                    ->where('branch_id', $request->branch)
                    ->where('status', 'For receiving')
                    ->first();
                $item = Item::where('id', $update->items_id)->first();
                $branch = Branch::where('id', $update->branch_id)->first();

                $log = new UserLog;
                $log->activity = "Received defective $item->item from $branch->branch." ;
                $log->user_id = auth()->user()->id;
                $log->save();
                $update->status = $request->status;
                $update->user_id = auth()->user()->id;
                $data = $update->save();
            }

            if ($request->status == 'Repaired') {
                $repaired = Defective::where('id', $request->id)
                    ->where('branch_id', $request->branch)
                    ->where('status', 'Received')
                    ->first();
                $item = Item::where('id', $repaired->items_id)->first();
                $cat = Category::where('id', $item->category_id)->first();

                $add = new Warehouse;
                $add->category_id = $cat->id;
                $add->items_id = $repaired->items_id;
                $add->status = 'in';
                $add->user_id = auth()->user()->id;
                $add->save();

                $log = new UserLog;
                $log->activity = "Add $item->item from Repair to Stock." ;
                $log->user_id = auth()->user()->id;
                $data = $log->save();

            }
        }
        
        return response()->json($data);

    }
}
