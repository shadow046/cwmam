<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\LccImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Lcc;
use App\LccCustomer;
use App\Mspg;
use App\CustomerBranch;
use App\Warehouse;
use App\Stock;

class ImportController extends Controller
{
    public function pg(Request $request)
    {
        function generateRandomString($length = 25) 
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $check = LccCustomer::where('id', $randomString)->first();
            if ($check) {
                generateRandomString(25);
            }else{
                return $randomString;
            }
        }
        $file = $request->file('upload');
        $import = new LccImport;
        $data = Excel::toArray($import, $file);
        $error = 0;
        $itemswitherror = [];
        foreach ($data[0] as $key => $value) {
            $add = new Mspg;
            $add->Company = $value[0];
            $add->Branch = $value[1];
            $add->Handling_branch = $value[2];
            $add->Store_name = $value[3];
            $add->Brand = $value[4];
            $add->Serial = $value[5];
            $add->Start = $value[6];
            $add->End = $value[7];
            $add->Status = 'Under Warranty';
            $add->save();
        }
        if ($error == 1) {
            return back()->withErrors([$itemswitherror]);
        }else{
            return back()->withStatus('Excel File Imported Successfully');
        }
    }
    
    public function mspg(Request $request)
    {
        function generateRandomString($length = 25) 
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $check = LccCustomer::where('id', $randomString)->first();
            if ($check) {
                generateRandomString(25);
            }else{
                return $randomString;
            }
        }
        $file = $request->file('upload');
        $import = new LccImport;
        $data = Excel::toArray($import, $file);
        $error = 0;
        $itemswitherror = [];
        foreach ($data[0] as $key => $value) {
            $add = new Mspg;
            $add->Company = $value[0];
            $add->Branch = $value[1];
            $add->Handling_branch = $value[2];
            $add->Store_name = $value[3];
            $add->Brand = $value[4];
            $add->Serial = $value[5];
            $add->Start = $value[6];
            $add->End = $value[7];
            $add->Status = 'Under Warranty';
            $add->save();
        }
        if ($error == 1) {
            return back()->withErrors([$itemswitherror]);
        }else{
            return back()->withStatus('Excel File Imported Successfully');
        }
    }
    
    public function lcc(Request $request)
    {
        function generateRandomString($length = 25) 
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $check = LccCustomer::where('id', $randomString)->first();
            if ($check) {
                generateRandomString(25);
            }else{
                return $randomString;
            }
        }
        $file = $request->file('upload');
        $import = new LccImport;
        $data = Excel::toArray($import, $file);
        $error = 0;
        $itemswitherror = [];
        foreach ($data[0] as $key => $value) {
            $myRandomString = generateRandomString(25);
            $lccid = LccCustomer::select('id as myid')->where('customer_name', $value[0])->first();

            if ($lccid) {
                $lcc = Lcc::where('id', $myRandomString)->first();
                if (!$lcc) {
                    $add = new Lcc;
                    $add->id = $myRandomString;
                    $add->lcc_customer_id = $lccid->myid;
                    $add->Item_description = $value[1];
                    $add->Serial = $value[2];
                    $add->Receiving_date = $value[3];
                    $add->End_warranty = $value[4];
                    $add->Specifications = $value[5];
                    $add->Status = 'Under Warranty';
                    $add->save();
                }elseif ($lcc) {
                    $error = 1;
                    array_push($itemswitherror, $value[0]);
                }
            }else{
                $error = 1;
                array_push($itemswitherror, $value[0]);
            }
        }
        if ($error == 1) {
            return back()->withErrors([$itemswitherror]);
        }else{
            return back()->withStatus('Excel File Imported Successfully');
        }
    }

    public function lcc_customer(Request $request)
    {
        function generateRandomString($length = 25) 
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $check = LccCustomer::where('id', $randomString)->first();
            if ($check) {
                generateRandomString(25);
            }else{
                return $randomString;
            }
        }
        $file = $request->file('upload');
        $import = new LccImport;
        $data = Excel::toArray($import, $file);
        $error = 0;
        $itemswitherror = [];
        foreach ($data[0] as $key => $value) {
            $myRandomString = generateRandomString(25);
            $lcc = LccCustomer::where('customer_name', $value[0])->first();
            if (!$lcc) {
                $add = new LccCustomer;
                $add->id = $myRandomString;
                $add->customer_name = $value[0];
                $add->Status = 'Active';
                $add->save();
            }elseif ($lcc) {
                $error = 1;
                array_push($itemswitherror, $value[0]);
            }
            /*if (!$lcc) {
                $add = new Lcc;
                $add->Customer_name = $value[0];
                $add->Item_description = $value[1];
                $add->Serial = $value[2];
                $add->Receiving_date = $value[3];
                $add->End_warranty = $value[4];
                $add->Specifications = $value[5];
                $add->Status = 'Active';
                $add->save();
            }elseif ($lcc) {
                $error = 1;
                array_push($itemswitherror, $value[0]);
            }*/
        }
        if ($error == 1) {
            return back()->withErrors([$itemswitherror]);
        }else{
            return back()->withStatus('Excel File Imported Successfully');
        }
    }
    /*public function warestore(Request $request)
    {
        $file = $request->file('upload');
        $import = new WarehouseImport;
        $data = Excel::toArray($import, $file);
        $error = 0;
        $itemswitherror = [];
        $itemswithsuccess = [];
        $count = 0;
        foreach ($data[0] as $key => $value) {
            $items = Customer::where('code', $value[0])->first();
            if ($items) {
                $count = $count + 1;
                if ($value[1] || $value[1] != 0) {
                    $branch = CustomerBranch::where('customer_id', $items->id)->where('code', $value[1])->first();
                    if (!$branch) {
                        $add = new CustomerBranch;
                        $add->customer_branch = $value[2];
                        $add->address = $value[3];
                        $add->code = $value[1];
                        $add->customer_id = $items->id;
                        if ($value[4]) {
                            $add->contact = $value[4];
                        }
                        $add->status = '1';
                        $add->save();
                    }
                }else{
                    $error = 1;
                    array_push($itemswitherror, $value[1].'-'.$count);
                }
            }else if (!$items) {
                $error = 1;
                array_push($itemswitherror, $value[0]);
            }
        }
        if ($error == 1) {
            return back()->withErrors([$itemswitherror]);
        }else{
            return back()->withStatus('Excel File Imported Successfully');
        }
    }*/
    
    public function lcsc(Request $request)
    {
        $file = $request->file('upload');
        $import = new WarehouseImport;
        $data = Excel::toArray($import, $file);
        $error = 0;
        $itemswitherror = [];
        foreach ($data[0] as $key => $value) {
            $items = Item::where('item', $value[0])->first();
            if ($items) {
                if ($value[1] && $value[1] != 0) {
                    for ($i=1; $i <= $value[1]; $i++) { 
                        $add = new Warehouse;
                        $add->user_id = auth()->user()->id;
                        $add->category_id = $items->category_id;
                        $add->items_id = $items->id;
                        $add->serial = '-';
                        $add->status = 'in';
                        $add->save();
                    }
                }
            }elseif (!$items) {
                $error = 1;
                array_push($itemswitherror, $value[0]);
            }
        }
        if ($error == 1) {
            return back()->withErrors([$itemswitherror]);
        }else{
            return back()->withStatus('Excel File Imported Successfully');
        }
    }
}