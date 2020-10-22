<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Loan;
use Auth;
use App\Item;
use App\Branch;
use App\Stock;
use App\UserLog;
class LoanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasrole('Administrator')) {
            return redirect('/');
        }
        return view('pages.loan');

    }

    public function getItemCode(Request $request){
        

        $cat = Item::select('category_id')
            ->where('items.id', $request->id)
            ->first();
        
        $items = Item::select('item', 'id')
            ->where('category_id', $cat->category_id)
            ->get();
        
        return response()->json($items);
        
    }

    public function table(Request $request)
    {
        $myloans = Loan::select('loans.id', 'loans.items_id', 'loans.to_branch_id', 'loans.from_branch_id', 'branches.id as branchid', 'branches.branch', 'loans.updated_at', 'items.item', 'loans.status', 'loans.updated_at')
            ->where('loans.from_branch_id', auth()->user()->branch->id)
            ->where('loans.status', '!=', 'completed')
            ->join('branches', 'loans.to_branch_id', '=', 'branches.id')
            ->join('items', 'loans.items_id', '=', 'items.id')
            ->get();

        $loans = Loan::select('loans.id', 'loans.items_id', 'loans.to_branch_id', 'loans.from_branch_id', 'branches.id as branchid', 'branches.branch', 'loans.updated_at', 'items.item', 'loans.status', 'loans.updated_at')
            ->where('loans.to_branch_id', auth()->user()->branch->id)
            ->where('loans.status', '!=', 'completed')
            ->join('branches', 'loans.from_branch_id', '=', 'branches.id')
            ->join('items', 'loans.items_id', '=', 'items.id')
            ->get();

        $merge = $loans->merge($myloans);
        return Datatables::of($merge)

        ->addColumn('date', function (Loan $request){

            return $request->updated_at->toFormattedDateString().' '.$request->updated_at->toTimeString();
        })

        ->addColumn('stat', function (Loan $request){
            
            if ($request->to_branch_id == auth()->user()->branch->id) {
                return 'IN-BOUND';
            }else{
                return 'OUT-BOUND';
            }

        })

        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function stock(Request $request)
    {

        $item = Item::where('id', $request->item)->first();
        $stock = Stock::where('id', $request->item)->first();


        $update = Stock::where('id', $request->item)->where('branch_id', auth()->user()->branch->id)->first();
        $update->status = 'loan';
        $update->id_branch = $request->branch;
        $update->user_id = auth()->user()->id;
        $update->save();

        $add = new Stock;
        $add->category_id = $item->category_id;
        $add->branch_id = $request->branch;
        $add->items_id = $request->item;
        $add->user_id = auth()->user()->id;
        $add->serial = $stock->serial;
        $add->status = $request->id;
        $add->id_branch = auth()->user()->branch->id;
        $data = $add->save();

        return response()->json($data);
    }

    public function stockUpdate(Request $request)
    {
        $update = Stock::where('branch_id', auth()->user()->branch->id)
            ->where('status', $request->id)
            ->where('id_branch', $request->branch)
            ->first();
        $item = Item::where('id', $update->items_id)->first();
        $branch = Branch::where('id', $update->id_branch)->first();
        $update->status = 'in';
        $update->user_id = auth()->user()->id;
        $log = new UserLog;
        $log->activity = "Received request $item->item from $branch->branch." ;
        $log->user_id = auth()->user()->id;
        $log->save();
        $data = $update->save();

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getitem(Request $request)
    {
        $serial = Stock::where('branch_id', auth()->user()->branch->id)
            ->where('status', $request->id)
            ->where('id_branch', $request->branch)
            ->first();
        return response()->json($serial);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $loan = Loan::where('id', $request->id)->first();
        $branch = Branch::where('id', $loan->from_branch_id)->first();
        $item = Item::where('id', $loan->items_id)->first();
        $loan->status = $request->status;
        $loan->user_id = auth()->user()->id;
        $log = new UserLog;
        $log->activity = "Approved request $item->item from $branch->branch" ;
        $log->user_id = auth()->user()->id;
        $log->save();
        $data = $loan->save();

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
