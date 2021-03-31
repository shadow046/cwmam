<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Mspg;
use App\Puregold;
use App\ShoeMart;
use App\Lcc;
use App\smma;
use Auth;


class SearchController extends Controller
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
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $mspg = Mspg::where('Serial', $request->serial)->first();
        $pg = Puregold::where('Serial', $request->serial)->first();
        $sm = ShoeMart::where('Serial', $request->serial)->first();
        $smma = smma::where('Serial', $request->serial)->first();
        $lcc = Lcc::where('Serial', $request->serial)->first();

        if ($mspg) {
            return response()->json(['data' => $mspg, 'type' => 'mspg']);
        }elseif ($pg) {
            return response()->json(['data' => $pg, 'type' => 'pg']);
        }elseif ($sm) {
            return response()->json(['data' => $sm, 'type' => 'sm']);
        }elseif ($lcc) {
            return response()->json(['data' => $lcc, 'type' => 'lcc']);
        }elseif ($smma) {
            return response()->json(['data' => $smma, 'type' => 'smma']);
        }else{
            $search = '0';
            return response()->json($search);
        }
    }

    public function global(Request $request)
    {
        $mspg = Mspg::where('Serial', 'LIKE', '%'.$request->serial.'%')->first();
        $pg = Puregold::where('Serial', 'LIKE', '%'.$request->serial.'%')->first();
        $sm = ShoeMart::where('Serial', 'LIKE', '%'.$request->serial.'%')->first();
        $smma = smma::where('Serial', 'LIKE', '%'.$request->serial.'%')->first();
        $lcc = Lcc::where('Serial', 'LIKE', '%'.$request->serial.'%')->first();

        if ($mspg) {
            return response()->json(['data' => $mspg, 'type' => 'mspg']);
        }elseif ($pg) {
            return response()->json(['data' => $pg, 'type' => 'pg']);
        }elseif ($sm) {
            return response()->json(['data' => $sm, 'type' => 'sm']);
        }elseif ($lcc) {
            return response()->json(['data' => $lcc, 'type' => 'lcc']);
        }elseif ($smma) {
            return response()->json(['data' => $smma, 'type' => 'smma']);
        }else{
            $search = '0';
            return response()->json(['data' => '0', 'type' => 'none']);
        }
    }

    public function getLCC()
    {
            $lcc = Lcc::where('Serial', '!=', '')->get();
            return DataTables::of($lcc)
                ->make(true);
    }

    public function getMSPG()
    {

    return DataTables::of(Mspg::where('Serial', '!=', '')->get())
        ->addColumn('Status', function (){
            return 'Under Warranty';
        })
    
        ->addColumn('Start', function (){
            return 'asdasdasd';
        })
        ->addColumn('End', function (){
            return 'sadasdas';
        })
        ->addColumn('Store_name', function (){
            return 'sadasdas';
        })
        ->make(true);
    }

    public function getPUREGOLD()
    {

    return DataTables::of(Puregold::where('Serial', '!=', '')->get())
        ->addColumn('Status', function (){
            return 'Under Warranty';
        })
        ->make(true);
    }

    public function getSHOEMART()
    {

    return DataTables::of(Shoemart::where('Serial', '!=', '')->get())
        ->addColumn('Status', function (){
            return 'Under Warranty';
        })
        ->make(true);
    }

    public function getSMMA()
    {

    return DataTables::of(Smma::where('Serial', '!=', '')->get())
        ->addColumn('Status', function (){
            return 'Under Warranty';
        })
        ->make(true);
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
        //
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
