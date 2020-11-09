<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use App\CustomerBranch;
use App\Customer;
class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('pages.customer');
    }

    public function customertable()
    {

        $customer = Customer::all();

        return DataTables::of($customer)

        ->make(true);

    }

    public function branchindex(Request $request, $id)
    {
        return view('pages.customerbranch');
    }

    public function customerbranchtable($id)
    {

        $customer = CustomerBranch::where('customer_id', $id);

        return DataTables::of($customer)

        ->addColumn('status', function (CustomerBranch $data){
            return 'Active';
        })

        ->make(true);

    }
}
