<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use App\User;
use App\Area;
use App\Branch;
use App\UserLog;

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
        $title = 'Users';
        if (!auth()->user()->hasanyrole('Administrator|Head')) {
            return redirect('/');
        }
        if (auth()->user()->hasrole('Head')) {
            $areas = Area::where('id', auth()->user()->area->id)->get();
        }
        return view('pages.user', compact('users', 'areas','roles', 'title'));
    }

    public function getUsers()
    {
        if (!auth()->user()->hasrole('Administrator')) {
            $users = User::where('id', '!=', auth()->user()->id)
                ->where('branch_id', auth()->user()->branch->id)
                ->get();
        }else{
            $users = User::where('id', '!=', auth()->user()->id)->get();
        }
        //dd($user);
        return DataTables::of($users)
        ->setRowData([
            'data-id' => '{{$id}}',
            'data-status' => '{{ $status }}',
        ])
        
        ->addColumn('fname', function (User $user){
            
            return $user->name. ' ' . $user->lastname;
        })

        ->addColumn('area', function (User $user){
            return $user->area->area;
        })

        ->addColumn('branch', function (User $user){
            return $user->branch->branch;
        })

        ->addColumn('role', function (User $user){
            return $user->roles->first()->name;
        })

        ->addColumn('status', function (User $user){

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
        $data = Branch::select('branch', 'id')->where('area_id', $request->id)->get();
        if (auth()->user()->hasrole('Head')) {
            $data = Branch::where('id', auth()->user()->branch->id)->get();
        }
        //dd($data);
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
            'first_name' => ['required', 'string', 'min:3', 'max:255'],
            'last_name' => ['required', 'string', 'min:3', 'max:255'],
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
            
            $user->name = ucwords(strtolower($request->input('first_name')));
            $user->lastname = ucwords(strtolower($request->input('last_name')));
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
            'first_name' => ['required', 'string', 'min:3', 'max:255'],
            'last_name' => ['required', 'string', 'min:3', 'max:255'],
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
            $user->name = ucwords(strtolower($request->input('first_name')));
            $user->lastname = ucwords(strtolower($request->input('last_name')));
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
