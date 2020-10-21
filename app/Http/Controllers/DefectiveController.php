<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\User;
use App\Defective;
use App\Branch;
use App\Item;
use Auth;
class DefectiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        if (auth()->user()->branch->branch != 'Warehouse') {
            return view('pages.branch.return', compact('users'));
        }else{
            return view('pages.warehouse.return', compact('users'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function table()
    {
        $defective = Defective::select('defectives.updated_at', 'defectives.id as id', 'items.item', 'items.id as itemid', 'defectives.serial', 'defectives.status')
            ->where('branch_id', auth()->user()->branch->id)
            ->join('items', 'defectives.items_id', '=', 'items.id')
            ->where('status', '!=', 'received')
            ->get();
            
        $waredef =Defective::select('branches.branch', 'branches.id as branchid', 'defectives.updated_at', 'defectives.id as id', 'items.item', 'items.id as itemid', 'defectives.serial', 'defectives.status')
            ->where('defectives.status', 'For receiving')
            ->join('items', 'defectives.items_id', '=', 'items.id')
            ->join('branches', 'defectives.branch_id', '=', 'branches.id')
            ->get();
        //dd($defective);

        if (auth()->user()->branch->branch == 'Warehouse') {
            $data = $waredef;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        if (auth()->user()->branch->branch != 'Warehouse') {
            $update = Defective::where('branch_id', auth()->user()->branch->id)
                ->where('id', $request->id)
                ->where('status', 'in')
                ->first();
        }else{
            $update = Defective::where('id', $request->id)
                ->where('branch_id', $request->branch)
                ->where('status', 'For receiving')
                ->first();
        }
        
        $update->status = $request->status;
        $update->user_id = auth()->user()->id;
        $data = $update->save();

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
