<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\StockRequest;
use App\RequestedItem;
use App\PreparedItem;
use App\Warehouse;
use App\Category;
use App\Item;
use Auth;
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

    /*public function Send(Request $request, $id)
    {
        $reqItems = RequestedItem::where('request_no', $id)->get();
        $stocks = Warehouse::select('items_id', 'serial', \DB::raw('SUM(CASE WHEN status = \'in\' THEN 1 ELSE 0 END) as stock'))
                    ->where('status', 'in')
                    ->groupBy('items_id')->get();
        return json_encode($return_array);
    }*/

    public function getsendDetails(Request $request, $id){

        return DataTables::of(PreparedItem::where('request_no', $id)->get())

        ->addColumn('item_name', function (PreparedItem $PreparedItem){

            return strtoupper($PreparedItem->items->name);
        })

        ->addColumn('serial', function (PreparedItem $PreparedItem){

            return strtoupper($PreparedItem->serial);
        })

        ->make(true);

    }

    public function generateBarcodeNumber() {
        $random = mt_rand(1, 999); // better than rand()
        $today = Carbon::now()->format('d-m-Y');
        $number = $today.'-'.$random;
        //dd($number);
        //dd($today);
        // call the same function if the barcode exists already
        if ($this->barcodeNumberExists($number)) {
            return generateBarcodeNumber();
        }
    
        // otherwise, it's valid and can be used
        //return $number;
        return response()->json($number);
    }
    
    public function barcodeNumberExists($number) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return StockRequest::where('request_no', $number)->exists();
    }

    public function getRequestDetails(Request $request, $id)
    {
        
        return DataTables::of(RequestedItem::where('request_no', $id)->get())

        ->addColumn('item_name', function (RequestedItem $RequestedItem){

            return strtoupper($RequestedItem->items->name);
        })

        ->addColumn('purpose', function (RequestedItem $RequestedItem){

            if ($RequestedItem->purpose == "1") {
                return 'STOCK';
            }elseif ($RequestedItem->purpose == "2") {
                return 'REPLACEMENT';
            }else{
                return 'SERVICE UNIT';
            }

        })
        ->make(true);
    }   

    public function getRequests()
    {
        $user = Auth::user()->branch->id;
        //dd($user);
        if ($user != '999') {
            $stock = StockRequest::where('status', '!=', '2')
                ->where('branch_id', $user)
                ->get();
        }else{
            $stock = StockRequest::where('status', '!=', '2')
                ->get();
        }
        
        return DataTables::of($stock)
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

        ->addColumn('created_at', function (StockRequest $request){
            
            return $request->created_at->toFormattedDateString().' '.$request->created_at->toTimeString();
        })

        ->addColumn('reqBy', function (StockRequest $request){
            return strtoupper($request->user->name);
        })

        ->addColumn('branch', function (StockRequest $request){
            return strtoupper($request->branch->name);
        })

        ->addColumn('area', function (StockRequest $request){
            return strtoupper($request->area->name);
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

        //dd(Auth::user()->area->id);
        if ($request->stat == 'ok') {

            $reqno = new StockRequest;
            $reqno->request_no = $request->reqno;
            $reqno->user_id = Auth::user()->id;
            $reqno->branch_id = Auth::user()->branch->id;
            $reqno->area_id = Auth::user()->area->id;
            $reqno->status = 0;
            $data = $reqno->save();

        }
        if ($request->stat == 'notok') {
            $reqitem = new RequestedItem;
            $reqitem->request_no = $request->reqno;
            $reqitem->items_id = $request->item;
            $reqitem->purpose = $request->purpose;
            $reqitem->quantity = $request->qty;
            $data = $reqitem->save();
        }

        return response()->json($data);
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
        if ($request->stat == 'ok') {
            $reqno = StockRequest::where('request_no', $request->reqno)->first();
            $reqno->status = '1';
            $reqno->schedule = $request->datesched;
            $data = $reqno->save();
        }else{
            $reqbranch= StockRequest::where('request_no', $request->reqno)->first();
            $item = Warehouse::where('status', 'in')
                ->where('items_id', $request->item)
                ->where('serial', $request->serial)
                ->first();
            $item->status = 'sent';
            $item->branch_id = $reqbranch->branch_id;
            $item->schedule = $request->datesched;;
            $item->save();
            $prep = new PreparedItem;
            $prep->items_id = $request->item;
            $prep->request_no = $request->reqno;
            $prep->serial = $request->serial;
            $prep->branch_id = $reqbranch->branch_id;
            $prep->save();

            $data = $user->save();
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
