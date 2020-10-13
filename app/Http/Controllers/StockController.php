<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Warehouse;
use App\Item;
use App\Category;
use App\Stock;
use App\CustomerBranch;
use App\Customer;
use DB;
use Auth;
class StockController extends Controller
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
        $categories = Category::all();
        $service_units = Stock::where('branch_id', Auth::user()->branch->id)
            ->where('status', 'service unit')
            ->join('categories', 'stocks.category_id', '=', 'categories.id')
            ->get();
        $customers = Stock::where('branch_id', Auth::user()->branch->id)
            ->where('status', 'service unit')
            ->join('customer_branches', 'stocks.customer_branches_id', '=', 'customer_branches.id')
            ->join('categories', 'stocks.category_id', '=', 'categories.id')
            ->join('customers', 'customer_branches.customer_id', '=', 'customers.id')
            ->join('items', 'stocks.items_id', '=', 'items.id')
            ->get();
        //dd($customers);
        return view('pages.stocks', compact('categories', 'service_units', 'customers'));
    }

    public function category(Request $request){
        //$data = Item::select('id', 'item')->where('category_id', $request->id)->get();
        $cat = Stock::where('branch_id', Auth::user()->branch->id)
            ->where('status', 'service unit')
            ->where('customer_branches_id', $request->id)
            ->join('customer_branches', 'stocks.customer_branches_id', '=', 'customer_branches.id')
            ->join('categories', 'stocks.category_id', '=', 'categories.id')
            ->join('customers', 'customer_branches.customer_id', '=', 'customers.id')
            ->get();
        return response()->json($cat);
    }

    public function description(Request $request){
        //$data = Item::select('id', 'item')->where('category_id', $request->id)->get();
        $desc = Stock::where('branch_id', Auth::user()->branch->id)
            ->where('status', 'service unit')
            ->where('customer_branches_id', $request->customerid)
            ->where('stocks.category_id', $request->categoryid)
            ->join('customer_branches', 'stocks.customer_branches_id', '=', 'customer_branches.id')
            ->join('categories', 'stocks.category_id', '=', 'categories.id')
            ->join('customers', 'customer_branches.customer_id', '=', 'customers.id')
            ->join('items', 'stocks.items_id', '=', 'items.id')
            ->get();
            //dd($customer);
        return response()->json($desc);
    }

    public function serial(Request $request){
        $serial = Stock::where('branch_id', Auth::user()->branch->id)
            ->where('status', 'service unit')
            ->where('customer_branches_id', $request->customerid)
            ->where('stocks.category_id', $request->categoryid)
            ->where('stocks.items_id', $request->descid)
            ->join('customer_branches', 'stocks.customer_branches_id', '=', 'customer_branches.id')
            ->join('categories', 'stocks.category_id', '=', 'categories.id')
            ->join('customers', 'customer_branches.customer_id', '=', 'customers.id')
            ->join('items', 'stocks.items_id', '=', 'items.id')
            ->get();
            //dd($customer);
        return response()->json($serial);
    }

    public function service()
    {
        return view('pages.service-unit');

    }

    public function serviceUnit()
    {
        $stock = Stock::where('status', 'service unit')
                    ->where('branch_id', Auth::user()->branch->id)
                    ->get();

        return DataTables::of($stock)

        ->addColumn('date', function (Stock $request){

            return $request->updated_at->toFormattedDateString().' '.$request->updated_at->toTimeString();
        })
       
        ->addColumn('items_id', function (Stock $request){
            return $request->items_id;
        })

        ->addColumn('category', function (Stock $request){
            $cat = Category::find($request->category_id);
            return strtoupper($cat->category);
        })

        ->addColumn('description', function (Stock $request){
            $item = Item::where('id', $request->items_id)->first();

            return strtoupper($item->item);
        })

        ->addColumn('serial', function (Stock $request){
            return $request->serial;
        })

        ->addColumn('client', function (Stock $request){
            $client = CustomerBranch::where('id', $request->customer_branches_id)->first();
            return $client->customer_branch;
        })

        ->make(true);
    }

    public function autocompleteCustomer(Request $request)
    {

        $customer = CustomerBranch::where("customer_branch", "LIKE", "%{$request->id}%")
                    ->where('customer_id', $request->client)
                    ->limit(10)
                    ->get();
        return response()->json($customer);
    }

    public function autocompleteClient(Request $request)
    {

        $client = Customer::where("customer", "LIKE", "%{$request->id}%")
                    ->limit(10)
                    ->get();
        return response()->json($client);
    }

    
    public function viewStocks(Request $request)
    {

        $stock = Stock::select('category_id','items_id', \DB::raw('SUM(CASE WHEN status = \'in\' THEN 1 ELSE 0 END) as stock'))
                    ->where('status', 'in')
                    ->where('branch_id', Auth::user()->branch->id)
                    ->groupBy('items_id')->get();


        return DataTables::of($stock)
       
        ->addColumn('items_id', function (Stock $request){
            return $request->items_id;
        })

        ->addColumn('category', function (Stock $request){
            $cat = Category::find($request->category_id);
            return strtoupper($cat->category);
        })

        ->addColumn('description', function (Stock $request){
            $item = Item::where('id', $request->items_id)->first();

            return strtoupper($item->item);
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
    
    public function addItem(Request $request){

        $add = new Item;
        $add->category_id = $request->cat;
        $add->item = ucfirst($request->item);
        $data = $add->save();

        return response()->json($data);
    }

    public function servicein(Request $request){

        $stock = Stock::where('id', $request->serial)->first();

        $stock->status = $request->status;
        $data = $stock->save();

        return response()->json($data);
    }


    public function addCategory(Request $request){

        $add = new Category;
        $add->category = ucfirst($request->cat);
        $data = $add->save();

        return response()->json($data);
    }

    public function serviceOut(Request $request)
    {
        $stock = Stock::where('items_id', $request->item)
                    ->where('branch_id', Auth::user()->branch->id)
                    ->where('serial', $request->serial)
                    ->where('status', 'in')
                    ->first();
        $stock->status = $request->purpose;
        $stock->customer_branches_id = $request->customer;
        $data = $stock->save();

        return response()->json($data);
    }

    public function store(Request $request)
    {
        if (Auth::user()->branch->id == '999') {
            $add = new Warehouse;
            $add->category_id = $request->cat;
            $add->items_id = $request->item;
            $add->serial = $request->serial;
            $add->status = 'in';
            $data = $add->save();
        }else{
            $add = new Stock;
            $add->category_id = $request->cat;
            $add->branch_id = Auth::user()->branch->id;
            $add->items_id = $request->item;
            $add->serial = $request->serial;
            $add->status = 'in';
            $data = $add->save();
        }
        

        return response()->json($data);
    }

    public function import(Request $request)
    {
        //get file
        $upload = $request->file('upload-file');
        $filePath = $upload->getRealPath();
        //open and read
        $file = fopen($filePath, 'r');
        $header = fgetcsv($file);

        $escapedHeader=[];
        //validate
        foreach ($header as $key => $value) {
            $lheader = strtolower($value);
            array_push($escapedHeader, $lheader);
        }

        //looping throu other columns
        $notfound=[];
        $duplicate=[];
        $dup = false;
        while ($columns = fgetcsv($file)) {

            $item = Item::where('item', $columns[0])->first();
            $serial = $columns[1];

            if ($columns[1] == "") {
                $serial = 'N/A';
            }else{
                $find = Stock::where('serial', $columns[1])
                    ->where('status', 'in')->first();
                if ($find) {
                    array_push($duplicate, $columns[1]);
                    $dup = true;
                }
            }

            if ($columns[0] != $item->item) {
                array_push($notfound, $columns[0]);
            }else {

                //dd($item->category->id);    
                if ($dup == false) {
                    $stock = new Stock;
                    $stock->category_id = $item->category->id;
                    $stock->items_id = $item->id;
                    $stock->status = 'in';
                    $stock->branch_id = Auth::user()->branch_id;
                    $stock->serial = $serial;
                    //dd($stock);
                    $stock->save();
                }
                
            }        
        }

        return redirect()->route('stocks.index');
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
        
        ->addColumn('items_id', function (Warehouse $request){
            return $request->items_id;
        })

        ->addColumn('category', function (Warehouse $request){
            $cat = Category::find($request->category_id);
            return $cat->category;
        })

        ->addColumn('description', function (Warehouse $request){
            $item = Item::where('id', $request->items_id)->first();

            return $item->item;
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
