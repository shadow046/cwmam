<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Warehouse;
use App\Item;
use App\Category;
use App\Stock;
use DB;
use Auth;
class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('pages.stocks', compact('categories'));
    }

    public function viewStocks(Request $request, $id)
    {

        $stock = Stock::select('category_id','items_id', \DB::raw('SUM(CASE WHEN status = \'in\' THEN 1 ELSE 0 END) as stock'))
                    ->where('status', 'in')
                    ->where('branch_id', $id)
                    ->groupBy('items_id')->get();


        return DataTables::of($stock)
       
        ->addColumn('items_id', function (Stock $request){
            return $request->items_id;
        })

        ->addColumn('category', function (Stock $request){
            $cat = Category::find($request->category_id);
            return strtoupper($cat->name);
        })

        ->addColumn('description', function (Stock $request){
            $item = Item::where('id', $request->items_id)->first();

            return strtoupper($item->name);
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
        $add->name = ucfirst($request->item);
        $data = $add->save();

        return response()->json($data);
    }

    public function addCategory(Request $request){

        $add = new Category;
        $add->name = ucfirst($request->cat);
        $data = $add->save();

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $add = new Warehouse;
        $add->category_id = $request->cat;
        $add->items_id = $request->item;
        $add->serial = $request->serial;
        $add->status = 'in';
        $data = $add->save();

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

            $item = Item::where('name', $columns[0])->first();
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

            if ($columns[0] != $item->name) {
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
            return $cat->name;
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
