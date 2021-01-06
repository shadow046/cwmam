<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mspg;
use App\Puregold;
use App\ShoeMart;
use App\Lcc;
use App\smma;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
