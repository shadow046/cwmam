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
use App\Branch;
use App\User;
use App\UserLog;
use Mail;
use Auth;
class StockRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        if (auth()->user()->hasanyrole('Repair')) {
            return redirect('/');
        }
        $title = 'Stock Request';

        $stocks = Warehouse::select('items_id', 'serial', \DB::raw('SUM(CASE WHEN status = \'in\' THEN 1 ELSE 0 END) as stock'))
            ->where('status', 'in')
            ->groupBy('items_id')->get();
        $categories = Category::all();
        return view('pages.stock-request', compact('stocks', 'categories', 'title'));
    }

    public function getItemCode(Request $request){
        $data = Item::select('id', 'item')->where('category_id', $request->id)->get();
        return response()->json($data);
    }

    public function getCatReq(Request $request){
        $catreqs = RequestedItem::select('categories.category', 'categories.id')
            ->where('request_no', $request->reqno)
            ->join('items', 'items.id', '=', 'requested_items.items_id')
            ->join('categories', 'categories.id', '=', 'items.category_id')
            ->get();
        return response()->json($catreqs);
    }

    public function getStock(Request $request){
        if (auth()->user()->branch->branch == 'Warehouse') {
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
        if (auth()->user()->branch->branch == 'Warehouse') {
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

    public function prepitemdetails(Request $request, $id)
    {
        return DataTables::of(PreparedItem::where('request_no', $id)->get())

        ->addColumn('item_name', function ($PreparedItem){

            return strtoupper($PreparedItem->items->item);
        })

        ->make(true);
    }   

    public function getRequestDetails(Request $request, $id)
    {
        return DataTables::of(RequestedItem::where('request_no', $id)->get())

        ->addColumn('item_name', function (RequestedItem $RequestedItem){

            return strtoupper($RequestedItem->items->item);
        })

        ->addColumn('stock', function (RequestedItem $RequestedItem){
            $data = Warehouse::select(\DB::raw('SUM(CASE WHEN status = \'in\' THEN 1 ELSE 0 END) as stock'))
                ->where('status', 'in')
                ->where('items_id',$RequestedItem->items->id)
                ->groupBy('items_id')
                ->first();
            
            return strtoupper($data->stock);
        })

        ->addColumn('purpose', function (RequestedItem $RequestedItem){

            if ($RequestedItem->purpose == "3") {
                return 'STOCK';
            }elseif ($RequestedItem->purpose == "2") {
                return 'REPLACEMENT';
            }elseif ($RequestedItem->purpose == "1") {
                return 'SERVICE UNIT';
            }

        })
        ->make(true);
    }   

    public function getRequests()
    {
        $user = auth()->user()->branch->id;
        if (auth()->user()->branch->branch != 'Warehouse'){
            $stock = StockRequest::wherein('status',  ['0', '1', '4', '5'])
                ->where('branch_id', $user)
                ->get();
        }else if(auth()->user()->hasRole('Viewer')){
            $stock = StockRequest::wherein('status',  ['0', '1', '4', '5', '6'])
                ->get();
        }else{
            $stock = StockRequest::wherein('status',  ['0', '1', '4', '5'])
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
            }else if ($request->status == 1){
                return 'SCHEDULED';
            }else if ($request->status == 4){
                return 'INCOMPLETE';
            }else if ($request->status == 5){
                return 'RESCHEDULED';
            }else if ($request->status == 6){
                return 'UNRESOLVED';
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
            
            $reqno->save();
            sleep(1);
            $reqitem = RequestedItem::select('items.item', 'quantity')
                ->where('request_no', $request->reqno)
                ->join('items', 'items.id', '=', 'requested_items.items_id')
                ->get();
            
            $cc = User::select('email')
                ->where('branch_id', '1')
                ->join('model_has_roles', 'model_id', '=', 'users.id')
                ->where('role_id', '6')
                ->get();
            $allemails = array();
            $allemails[] = 'jerome.lopez.ge2018@gmail.com';
            foreach ($cc as $email) {
                $allemails[]=$email->email;
            }

            Mail::send('mail', ['reqitem' => $reqitem, 'reqno' => $request->reqno, 'branch'=>auth()->user()->branch->branch],function( $message) use ($allemails){ 
                $message->to('gerard.mallari@gmail.com', 'Gerald Mallari')->subject 
                    (auth()->user()->branch->branch); 
                $message->from('ideaservmailer@gmail.com', 'NO REPLY'); 
                $message->cc($allemails); 
            });

            $data = $log->save();

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

    public function prepitem(Request $request)
    {
        $preparedItem = PreparedItem::where('branch_id', $request->branchid)
            ->where('request_no', $request->reqno)
            ->first();

        if ($preparedItem) {
            $data = '1';
        }else{
            $data = '0';
        }

        return response()->json($data);

    }
    public function received(Request $request)
    {
        $data = '0';
        foreach ($request->id as $del) {
            $preparedItems = PreparedItem::select('prepared_items.items_id as itemid', 'prepared_items.serial as serial')
                ->join('items', 'prepared_items.items_id', '=', 'items.id')
                ->where('branch_id', auth()->user()->branch->id)
                ->where('request_no', $request->reqno)
                ->where('prepared_items.id', $del)
                ->first();
            $prepared = PreparedItem::where('branch_id', auth()->user()->branch->id)
                ->where('request_no', $request->reqno)
                ->where('prepared_items.id', $del)
                ->first();
            $items = Item::where('id', $preparedItems->itemid)->first();
            $stock = new Stock;
            $stock->category_id = $items->category_id;
            $stock->branch_id = auth()->user()->branch->id;
            $stock->items_id = $preparedItems->itemid;
            $stock->user_id = auth()->user()->id;
            $stock->serial = $preparedItems->serial;
            $stock->status = 'in';
            $stock->save();
            $log = new UserLog;
            $log->activity = "Received $items->item(S/N: $preparedItems->serial) with Request no. $request->reqno ";
            $log->user_id = auth()->user()->id;
            $log->save();
            $prepared->delete();
        }
        $preparedItem = PreparedItem::where('branch_id', auth()->user()->branch->id)
            ->where('request_no', $request->reqno)
            ->first();
        if ($preparedItem) {
            $reqno = StockRequest::where('request_no', $request->reqno)->first();
            $reqno->status = 4;
            $reqno->save();
            $data = '1';
        }else{
            $reqno = StockRequest::where('request_no', $request->reqno)->first();
            $reqno->status = $request->status;
            $reqno->save();
        }
        return response()->json($data);
    }

    public function update(Request $request)
    {
        if ($request->stat == 'ok') {

            $reqno = StockRequest::where('request_no', $request->reqno)->first();
            $reqno->status = $request->status;
            $reqno->schedule = $request->datesched;
            $reqno->save();
            sleep(2);
            $prepitem = PreparedItem::select('items.item', 'serial', 'branch_id')
                ->where('request_no', $request->reqno)
                ->join('items', 'items.id', '=', 'prepared_items.items_id')
                ->get();
            $reqbranch = PreparedItem::select('branch_id')
                ->where('request_no', $request->reqno)
                ->first();

            $branch = Branch::where('id', $request->branchid)->first();
            $email = $branch->email;
            Mail::send('sched', ['prepitem' => $prepitem, 'sched'=>$request->datesched,'reqno' => $request->reqno,'branch' =>$branch],function( $message) use ($branch, $email){ 
                $message->to($email, $branch->head)->subject 
                    (auth()->user()->branch->branch); 
                $message->from('ideaservmailer@gmail.com', 'NO REPLY - Warehouse'); 
                $message->cc(['emorej046@gmail.com', 'gerard.mallari@gmail.com']); 
            });

            $data = "true";
        }else if($request->stat == 'resched'){
            if ($request->status == '5') {
                $reqno = StockRequest::where('request_no', $request->reqno)->first();
                $reqno->status = $request->status;
                $reqno->schedule = $request->datesched;
                $data = $reqno->save();
            }else if($request->status == '6') {
                $reqno = StockRequest::where('request_no', $request->reqno)->first();
                $reqno->status = $request->status;
                $data = $reqno->save();
            }
            
        }else{
            $item = Warehouse::where('status', 'in')
                ->where('items_id', $request->item)
                ->first();
            $item->status = 'sent';
            $item->request_no = $request->reqno;
            $item->branch_id = $request->branchid;
            $item->schedule = $request->datesched;
            $item->user_id = auth()->user()->id;
            $item->save();

            $scheditem = Item::where('id', $request->item)->first();
            $sched = StockRequest::where('request_no', $request->reqno)->first();
            $prep = new PreparedItem;
            $prep->items_id = $request->item;
            $prep->request_no = $request->reqno;
            $prep->serial = $request->serial;
            $prep->branch_id = $request->branchid;
            $prep->save();
            sleep(2);
            $log = new UserLog;
            $log->activity = "Schedule $scheditem->item(S/N: $request->serial) with Request no. $request->reqno ";
            $log->user_id = auth()->user()->id;
            $data = $log->save();
        }
        return response()->json($data);
    }

    public function dest(Request $request)
    {
        $delete = StockRequest::where('request_no', $request->reqno)->where('status', '0')->first();
        $delete->status = 3;
        $log = new UserLog;
        $log->activity = "Delete request no. $request->reqno" ;
        $log->user_id = auth()->user()->id;
        $log->save();
        $data = $delete->save();
        return response()->json($data);
    }
}
