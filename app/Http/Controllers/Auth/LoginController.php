<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\LoginRequest;
use Auth;
use Redirect;

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
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(LoginRequest $request) {
        if($request->ajax())
        {
            if(Auth::attempt(['username' => $request['username'], 'password' => $request['password']] ))
                return Redirect::route('principal');
            else
                return response()->json(['message' => 'error']);
        }
    }

    public function logout() {
        Auth::logout();
        return Redirect::route('login');
    }

    public function changePassword() {
        return view('usuarios.change_password');
    }

    public function postChangePassword(Request $request) {
        if($request->ajax()){
            if(Auth::attempt(['password' => $request['password_actual']])){
                $user = User::find(Auth::user()->id);
                $user->fill([
                'password'   => bcrypt($request['password'])
                ]);
                $user->save();

                return response()->json([
                    'message' => 'correcto'
                ]);
            }else{
                return response()->json([
                    'message' => 'error'
                ]);
            }
        }
    }
}
