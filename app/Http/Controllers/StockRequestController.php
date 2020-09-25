<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\StockRequest;
use App\RequestedItem;
use App\PreparedItem;
use App\Warehouse;
use App\Category;
use App\Item;
class StockRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Warehouse::select('items_id', 'serial', \DB::raw('SUM(CASE WHEN status = \'in\' THEN 1 ELSE 0 END) as stock'))
                    ->where('status', 'in')
                    ->groupBy('items_id')->get();
        $categories = Category::all();
        //dd($stocks);
        return view('pages.stock-request', compact('stocks', 'categories'));
    }

    public function getItemCode(Request $request){
        $data = Item::select('id', 'name')->where('category_id', $request->id)->get();
        
        return response()->json($data);
        
    }

    public function getStock(Request $request){
        //$data = Stock::select('id', 'name')->where('category_id', $request->id)->get();
        $data = Warehouse::select(\DB::raw('SUM(CASE WHEN status = \'in\' THEN 1 ELSE 0 END) as stock'))
                    ->where('status', 'in')
                    ->where('items_id', $request->id)
                    ->groupBy('items_id')
                    ->get();
                    
        return response()->json($data);
        
    }

    public function getSerials(Request $request){
        //$data = Stock::select('id', 'name')->where('category_id', $request->id)->get();
        $data = Warehouse::select('items_id', 'serial')
                    ->where('status', 'in')
                    ->where('items_id', $request->id)
                    ->get();
                    
        return response()->json($data);
        
    }

    public function Send(Request $request, $id)
    {
        $reqItems = RequestedItem::where('request_no', $id)->get();
        $stocks = Warehouse::select('items_id', 'serial', \DB::raw('SUM(CASE WHEN status = \'in\' THEN 1 ELSE 0 END) as stock'))
                    ->where('status', 'in')
                    ->groupBy('items_id')->get();
        return json_encode($return_array);
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
        ->make(true);
    }   

    public function getRequests()
    {
        
        return DataTables::of(StockRequest::where('status', '!=', '2')->get())
        ->setRowData([
            'data-id' => '{{ $request_no }}',
            'data-status' => '{{ $status }}',
            'data-user' => '{{ $user_id }}',
        ])

        ->addColumn('status', function (StockRequest $request){

            if ($request->status == 0) {
                return 'PENDING';
            }else{
                return 'SCHEDULED';
            }
        })

        ->addColumn('sched', function (StockRequest $request){
            return $request->schedule;
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
        if ($request->stat == 'ok') {
            $reqno = StockRequest::where('request_no', $request->reqno)->first();
            $reqno->status = '1';
            $reqno->schedule = $request->datesched;
            $data = $reqno->save();
        }else{
            $qty = $request->qty;
            for ($i=0; $i < $qty; $i++) { 
                $item = Warehouse::where('status', 'in')
                    ->where('items_id', $request->item)
                    ->first();
                $item->status = 'sent';
                $item->save();
            }
            $data = 'save';
        }
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
        PreparedItem::find($id)->delete($id);
        //return redirect()->route('stock.index');
    }
}
