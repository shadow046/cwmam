<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Branch;
use App\Area;
use App\Item;
use App\Stock;
use DB;
use Validator;
class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $branch = Branch::all()->sortBy('name');
        $areas = Area::all();
        return view('pages.branch', compact('branch', 'areas'));
    }

    public function showModal()
    {
        $branch = Branch::all()->sortBy('name');
        $areas = Area::all();
        //dd($branches);
        return view('modal.add-branch', compact('branch', 'areas'));
    }

    public function getStocks(Request $request, $id)
    {
        $details = DB::table('items')
            ->select(
                        'stocks.items_id',
                        'items.name',
                        DB::raw
                        (
                            'SUM(CASE WHEN stocks.status = \'in\' THEN 1 ELSE 0 END) as stock'
                        ),
                        DB::raw
                        (
                            'SUM(CASE WHEN stocks.status = \'out\' THEN 1 ELSE 0 END) as stock_out'
                        ),
                        DB::raw
                        (
                            'SUM(CASE WHEN stocks.status = \'in\' THEN 1 ELSE 0 END) - SUM(CASE WHEN stocks.status = \'out\' THEN 1 ELSE 0 END) as available'
                        )
                    )
            ->join('stocks', 'stocks.items_id', '=', 'items.id')
            ->where('branch_id', $id)
            ->groupBy('items_id')
            ->get();

        return DataTables::of($details)

        ->make(true);
    }

    public function getBranches()
    {
        
        return DataTables::of(Branch::all())
        ->setRowData([
            'data-id' => '{{$id}}',
            'data-status' => '{{ $status }}',
        ])
        ->addColumn('area', function (Branch $branch){
            return $branch->area->name;
        })
        ->addColumn('status', function (Branch $branch){

            if ($branch->status == 1) {
                return 'Active';
            } else {
                return 'Inactive';
            }
        })
        ->make(true);
    }


    /*public function getBranchName(Request $request)
    {
        $data = Branch::select('name', 'id')->where('area_id', $request->id)->get();
        
        return response()->json($data);
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch_name' => ['required', 'string', 'min:5', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'address' => ['required', 'string', 'min:10', 'max:255'],
            'area' => ['required', 'string', 'min:1', 'max:255'],
            'contact_person' => ['required', 'string', 'min:3', 'max:255'],
            'mobile' => ['required', 'string', 'min:8', 'max:255'],
            'status' => ['required', 'string', 'min:1', 'max:255'],
        ]);

        if ($validator->passes()) {

            $branch = new Branch;

            $branch->name = $request->input('branch_name');
            $branch->email = $request->input('email');
            $branch->address = $request->input('address');
            $branch->area_id = $request->input('area');
            $branch->head = $request->input('contact_person');
            $branch->phone = $request->input('mobile');
            $branch->status = $request->input('status');

            $data = $branch->save();

            return response()->json($data);
        }
       
        return response()->json(['error'=>$validator->errors()->all()]);
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
    public function update(Request $request, $id)
    {
        //$this->validate($request,[
        $validator = Validator::make($request->all(), [
            'branch_name' => ['required', 'string', 'min:5', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'address' => ['required', 'string', 'min:10', 'max:255'],
            'area' => ['required', 'string', 'min:1', 'max:255'],
            'contact_person' => ['required', 'string', 'min:3', 'max:255'],
            'mobile' => ['required', 'string', 'min:8', 'max:255'],
            'status' => ['required', 'string', 'min:1', 'max:255'],
        ]);

        if ($validator->passes()) {

            $branch = Branch::find($id);

            $branch->name = $request->input('branch_name');
            $branch->email = $request->input('email');
            $branch->address = $request->input('address');
            $branch->area_id = $request->input('area');
            $branch->head = $request->input('contact_person');
            $branch->phone = $request->input('mobile');
            $branch->status = $request->input('status');

            $data = $branch->save();

            return response()->json($data);
        }
       
        return response()->json(['error'=>$validator->errors()->all()]);
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
