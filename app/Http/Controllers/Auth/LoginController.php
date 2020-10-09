<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Spatie\Permission\Models\Role;
use App\Branch;
use App\Area;
use App\User;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*Role::create(['name'=>'super-admin']);
        Role::create(['name'=>'admin']);
        Role::create(['name'=>'head']);
        Area::create(['area'=>'Metro Manila']);
        Area::create(['area'=>'North Luzon']);
        Area::create(['area'=>'South Luzon']);
        Area::create(['area'=>'Visaya']);
        Area::create(['area'=>'Mindanao']);
        //Branch::create(['area_id'=>'1','email'=>'vher@test.com', 'name'=>'San Juan', 'address'=>'441 Lt. Artiaga St., Brgy. Corazon De Jesus San Juan City', 'head'=>'Vergilio Cabacungan', 'phone'=>'0998-5883595', 'status'=>'1']);
        $user = User::create(['area_id'=>'1', 'name'=>'Jerome Lopez', 'email'=>'emorej046@gmail.com', 'password'=>bcrypt('1'), 'branch_id'=>'1', 'status'=>'1']);
        $user->save();
        $user->assignRole('admin');
        //*/
        $this->middleware('guest')->except('logout');
    }
}
