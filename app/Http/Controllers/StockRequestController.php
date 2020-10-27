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
use App\Stock;
use App\UserLog;
use Auth;
class StockRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $stocks = Warehouse::select('items_id', 'serial', \DB::raw('SUM(CASE WHEN status = \'in\' THEN 1 ELSE 0 END) as stock'))
            ->where('status', 'in')
            ->groupBy('items_id')->get();
        $categories = Category::all();
        return view('pages.stock-request', compact('stocks', 'categories'));
    }

    public function getItemCode(Request $request){
        $data = Item::select('id', 'item')->where('category_id', $request->id)->get();
        return response()->json($data);
    }

    public function getStock(Request $request){
        if (auth()->user()->branch->id == '999') {
            $data = Warehouse::select(\DB::raw('SUM(CASE WHEN status = \'in\' THEN 1 ELSE 0 END) as stock'))
                ->where('status', 'in')
                ->where('items_id', $request->id)
                ->groupBy('items_id')
                ->get();
        }else{
            $data = Stock::select(\DB::raw('SUM(CASE WHEN status = \'in\' THEN 1 ELSE 0 END) as stock'))
                ->where('status', 'in')
                ->where('items_id', $request->id)
                ->where('branch_id', auth()->user()->branch->id)
                ->groupBy('items_id')
                ->get();
        }
        return response()->json($data);
    }

    public function getSerials(Request $request){
        if (auth()->user()->branch->id == '999') {
            $data = Warehouse::select('items_id', 'serial')
                ->where('status', 'in')
                ->where('items_id', $request->id)
                ->get();
        }else{
            $data = Stock::select('id', 'items_id', 'serial')
                ->where('status', 'in')
                ->where('items_id', $request->id)
                ->where('branch_id', auth()->user()->branch->id)
                ->get();
        }
        return response()->json($data);
    }

    public function getsendDetails(Request $request, $id){

        return DataTables::of(PreparedItem::where('request_no', $id)->get())

        ->addColumn('item_name', function (PreparedItem $PreparedItem){

            return strtoupper($PreparedItem->items->item);
        })

        ->addColumn('serial', function (PreparedItem $PreparedItem){

            return strtoupper($PreparedItem->serial);
        })

        ->make(true);

    }

    public function generateBarcodeNumber() {
        $random = mt_rand(1, 999); 
        $today = Carbon::now()->format('d-m-Y');
        $number = $today.'-'.$random;
        if ($this->barcodeNumberExists($number)) {
            return generateBarcodeNumber();
        }
        return response()->json($number);
    }
    
    public function barcodeNumberExists($number) {
        return StockRequest::where('request_no', $number)->exists();
    }

    public function getRequestDetails(Request $request, $id)
    {
        return DataTables::of(RequestedItem::where('request_no', $id)->get())

        ->addColumn('item_name', function (RequestedItem $RequestedItem){

            return strtoupper($RequestedItem->items->item);
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
        $user = auth()->user()->branch->id;
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
            return strtoupper($request->branch->branch);
        })

        ->addColumn('area', function (StockRequest $request){
            return strtoupper($request->area->area);
        })

        ->make(true);
    }

    public function store(Request $request)
    {
        if ($request->stat == 'ok') {
            $reqno = new StockRequest;
            $reqno->request_no = $request->reqno;
            $reqno->user_id = auth()->user()->id;
            $reqno->branch_id = auth()->user()->branch->id;
            $reqno->area_id = auth()->user()->area->id;
            $reqno->status = 0;
            $log = new UserLog;
            $log->activity = "Create Stock Request no. $request->reqno";
            $log->user_id = auth()->user()->id;
            $log->save();
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


    public function received(Request $request)
    {
        $preparedItems = PreparedItem::select('prepared_items.items_id as itemid', 'prepared_items.serial as serial')
            ->join('items', 'prepared_items.items_id', '=', 'items.id')
            //->join('categories', 'items.category_id', '=', 'categories.id')
            ->where('branch_id', auth()->user()->branch->id)
            ->where('request_no', $request->reqno)
            ->get();
        foreach ($preparedItems as $preparedItem) {
            
            $items = Item::where('id', $preparedItem->itemid)->first();
            //dd($items);
            $stock = new Stock;
            $stock->category_id = $items->category_id;
            $stock->branch_id = auth()->user()->branch->id;
            $stock->items_id = $preparedItem->itemid;
            $stock->user_id = auth()->user()->id;
            $stock->serial = $preparedItem->serial;
            $stock->status = 'in';
            $data = $stock->save();
        }
            
        return response()->json($data);
    }

    public function update(Request $request)
    {
        if ($request->stat == 'ok') {
            $reqno = StockRequest::where('request_no', $request->reqno)->first();
            //dd($reqno);
            $reqno->status = $request->status;
            $reqno->user_id = auth()->user()->id;
            $reqno->schedule = $request->datesched;
            $data = $reqno->save();
        }else{
            $reqbranch= StockRequest::where('request_no', $request->reqno)->where('branch_id', auth()->user()->branch->id)->first();
            $item = Warehouse::where('status', 'in')
                ->where('items_id', $request->item)
                ->where('serial', $request->serial)
                ->first();
            $item->status = 'sent';
            $item->request_no = $request->reqno;
            $item->branch_id = $reqbranch->branch_id;
            $item->schedule = $request->datesched;;
            $item->user_id = auth()->user()->id;
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

    public function dest(Request $request)
    {
        $delete = StockRequest::where('request_no', $request->reqno)->first();
        $delete->status = 3;
        $log = new UserLog;
        $log->activity = "Delete request no. $request->reqno" ;
        $log->user_id = auth()->user()->id;
        $log->save();
        $data = $delete->save();
        return response()->json($data);
    }
}
