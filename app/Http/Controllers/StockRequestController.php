<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\StockRequest;
use App\RequestedItem;
use App\PreparedItem;
class StockRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.stock-request');
    }

    public function mydel($id){
        PreparedItem::find($id)->delete();
        return redirect()->route('stock.index');
    }

    public function Send(Request $request, $id)
    {

        PreparedItem::truncate();
        $items = RequestedItem::where('request_no', $id)->get();
        foreach ($items as $item) {
            PreparedItem::create(['items_id' => $item->items_id, 'quantity' => $item->quantity]);
        }

        return DataTables::of(PreparedItem::all())

        ->addColumn('item_name', function (PreparedItem $PreparedItem){

            return $PreparedItem->items->name;
        })

        ->addColumn('action', function (PreparedItem $PreparedItem) {
            $delBtn = $PreparedItem->id;
            return '<input type="button" delete_btn="'. $delBtn .'" class="removeBtn btn btn-xs btn-primary" value="Remove">';
        })

        ->make(true);
    }

    public function getRequestDetails(Request $request, $id)
    {
        
        return DataTables::of(RequestedItem::where('request_no', $id)->get())

        ->addColumn('item_name', function (RequestedItem $RequestedItem){

            return $RequestedItem->items->name;
        })

        ->addColumn('purpose', function (RequestedItem $RequestedItem){

            if ($RequestedItem->purpose == "1") {
                return 'Stock';
            }elseif ($RequestedItem->purpose == "2") {
                return 'Replacement';
            }else{
                return 'Service unit';
            }

        })

        ->addColumn('action', function ($RequestedItem) {
            return '<a href="#" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        })
        ->make(true);
    }   

    public function getRequests()
    {
        
        return DataTables::of(StockRequest::all())
        ->setRowData([
            'data-id' => '{{ $request_no }}',
            'data-status' => '{{ $status }}',
            'data-user' => '{{ $user_id }}',
        ])

        ->addColumn('status', function (StockRequest $request){

            if ($request->status == 0) {
                return 'PENDING';
            } else {
                return 'SCHEDULED';
            }
        })

        ->addColumn('reqBy', function (StockRequest $request){
            return $request->user->name;
        })

        ->addColumn('branch', function (StockRequest $request){
            return $request->branch->name;
        })

        ->addColumn('area', function (StockRequest $request){
            return $request->area->name;
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
        
    }
}
