<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Spatie\Permission\Models\Role;
use App\Branch;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        Role::create(['name'=>'super-admin']);
        Role::create(['name'=>'admin']);
        Role::create(['name'=>'head']);
        Branch::create(['email'=>'vher@test.com', 'name'=>'San Juan', 'address'=>'441 Lt. Artiaga St., Brgy. Corazon De Jesus San Juan City', 'head'=>'Vergilio Cabacungan', 'phone'=>'0998-5883595', 'status'=>'1']);
        $this->middleware('guest')->except('logout');
    }
}
