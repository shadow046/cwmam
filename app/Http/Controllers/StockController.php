<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Warehouse;
use App\Item;
use App\Category;
use App\Stock;
use DB;
class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.stocks');
    }

    public function viewStocks(Request $request, $id)
    {
        /*$reqItems = RequestedItem::where('request_no', $id)->get();
        $stocks = Warehouse::select('items_id', 'serial', \DB::raw('SUM(CASE WHEN status = \'in\' THEN 1 ELSE 0 END) as stock'))
                    ->where('status', 'in')
                    ->groupBy('items_id')->get();
        return json_encode($return_array);*/

        $stock = Stock::select('category_id','items_id', \DB::raw('SUM(CASE WHEN status = \'in\' THEN 1 ELSE 0 END) as stock'))
                    ->where('status', 'in')
                    ->where('branch_id', $id)
                    ->groupBy('items_id')->get();


        return DataTables::of($stock)
        /*->setRowData([
            'data-id' => '{{ $request_no }}',
            'data-status' => '{{ $status }}',
            'data-user' => '{{ $user_id }}',
        ])*/

        ->addColumn('items_id', function (Stock $request){
            return $request->items_id;
        })

        ->addColumn('category', function (Stock $request){
            return $request->category_id;
        })

        ->addColumn('description', function (Stock $request){
            $item = Item::where('id', $request->items_id)->first();

            return $item->name;
        })

        ->addColumn('quantity', function (Stock $request){
            return $request->stock;
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
    public function show()
    {
        $stock = Warehouse::select('category_id','items_id', \DB::raw('SUM(CASE WHEN status = \'in\' THEN 1 ELSE 0 END) as stock'))
                    ->where('status', 'in')
                    ->groupBy('items_id')->get();


        return DataTables::of($stock)
        /*->setRowData([
            'data-id' => '{{ $request_no }}',
            'data-status' => '{{ $status }}',
            'data-user' => '{{ $user_id }}',
        ])*/

        ->addColumn('items_id', function (Warehouse $request){
            return $request->items_id;
        })

        ->addColumn('category', function (Warehouse $request){
            return $request->category_id;
        })

        ->addColumn('description', function (Warehouse $request){
            $item = Item::where('id', $request->items_id)->first();

            return $item->name;
        })

        ->addColumn('quantity', function (Warehouse $request){
            return $request->stock;
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
