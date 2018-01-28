<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\User;
use Auth;
use Carbon\Carbon;
use Input;
use Redirect;
use Response;
use Session;
use Validator;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('usuarios.login');
    }

    public function store(LoginRequest $request) {
        if($request->ajax())
        {
            if(Auth::attempt(['username' => $request['username'], 'password' => $request['password']] ))
                return Redirect::route('principal');
            else
                return response()->json(['message' => 'error']);
        }
    }

    public function changePassword() {
        return view('usuarios.change_password');
    }

    public function postChangePassword(Request $request) {
        if($request->ajax())
        {
            if(Auth::attempt(['password' => $request['password_actual']]))
            {
                $user = User::find(Auth::user()->id);
                $user->fill([
                'password'   => bcrypt($request['password'])
                ]);
                $user->save();

                return response()->json([
                    'message' => 'correcto'
                ]);
            }
            else
            {
                return response()->json([
                    'message' => 'error'
                ]);
            }
        }

    }

    public function logout() {
        Auth::logout();
        return Redirect::route('login');
    }
}
