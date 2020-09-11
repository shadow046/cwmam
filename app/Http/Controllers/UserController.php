<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use App\User;
use App\Area;
use App\Branch;
use Validator;
class UserController extends Controller
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
        $users = User::all();
        $areas = Area::all();
        $roles = Role::all();
        
        return view('pages.user1', compact('users', 'areas','roles'));
    }

    public function getUsers()
    {
        
        return DataTables::of(User::get()->all())
        ->setRowData([
            'data-id' => '{{$id}}',
            'data-toggle' => 'modal',
            'data-status' => '{{ $status }}',
            'data-area' => '{{ $area_id }}',
            'data-branch' => '{{ $branch_id }}',
            'data-target' => '#userModal'
        ])
        
        ->addColumn('area', function ($user){
            return $user->area->name;
        })

        ->addColumn('branch', function ($user){
            return $user->branch->name;
        })

        ->addColumn('role', function ($user){
            return $user->roles->first()->name;
        })

        ->addColumn('status', function ($user){

            if ($user->status == 1) {
                return 'Active';
            } else {
                return 'Inactive';
            }
        })

        ->setRowClass('{{ $id % 2 == 0 ? "edittr" : "edittr"}}') 

        ->make(true);
    }

    public function getBranchName(Request $request)
    {
        $data = Branch::select('name', 'id')->where('area_id', $request->id)->get();
        
        return response()->json($data);
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
        $validator = Validator::make($request->all(), [
            'full_name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'branch' => ['required', 'string'],
            'area' => ['required', 'string'],
            'role' => ['required', 'string'],
            'status' => ['required', 'string'],
            'password' => ['required', 'string', 'min:1', 'confirmed'],
            'password_confirmation' => 'required|same:password'
        ]);

        if ($validator->passes()) {

            $user = new User;

            $user->name = $request->input('full_name');
            $user->email = $request->input('email');
            $user->area_id = $request->input('area');
            $user->branch_id = $request->input('branch');
            $user->status = $request->input('status');
            $user->password = bcrypt($request->input('password'));

            $data = $user->save();
            $user->assignRole($request->input('role'));
            return response()->json($data);
        }
       
        return response()->json(['error'=>$validator->errors()->all()]);
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
        $validator = Validator::make($request->all(), [
            'full_name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'branch' => ['required', 'string'],
            'area' => ['required', 'string'],
            'role' => ['required', 'string'],
            'status' => ['required', 'string'],
            //'password' => ['required', 'string', 'min:1', 'confirmed'],
            //'password_confirmation' => 'required|same:password'
        ]);

        if ($validator->passes()) {

            $user = User::find($id);
            $user->name = $request->input('full_name');
            $user->email = $request->input('email');
            $user->area_id = $request->input('area');
            $user->branch_id = $request->input('branch');
            $user->status = $request->input('status');
            //$user->password = $request->input(bycrpt('password'));
            $data = $user->save();
            $user->syncRoles($request->input('role'));

            return response()->json($data);
        }
       
        return response()->json(['error'=>$validator->errors()->all()]);
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
