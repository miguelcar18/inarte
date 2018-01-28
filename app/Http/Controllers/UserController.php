<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use Auth;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use Redirect;
use Response;
use Session;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            if($this->user->rol != 1){
                Session::flash('message', 'Sin privilegios');
                return Redirect::route('principal');
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::All();
        return view('usuarios.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        if($request->ajax()) {
            if(!empty($request->file('foto'))) {
                $file = $request->file('foto');
                $nombre = str_replace(':', '_', Carbon::now()->toDateTimeString().$file->getClientOriginalName());
                $nombre = str_replace(' ', '_', $nombre);
                \Storage::disk('users')->put($nombre,  \File::get($file));
            }
            else
                $nombre = '';

            User::create([
                'name'      => $request['name'],
                'email'     => $request['email'], 
                'rol'       => $request['rol'], 
                'username'  => $request['username'], 
                'password'  => bcrypt($request['password']), 
                'path'      => $nombre,
                'details'   => $request['details']
            ]);
            
            return response()->json([
                'validations' => true
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, $id)
    {
        $user = User::find($id);
        return view('usuarios.profile', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, $id)
    {
        $user = User::find($id);
        return view('usuarios.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserCreateRequest $request, User $user, $id)
    {
        $user = User::find($id);
        //if((Auth::user()->rol == 1 || Auth::user()->id == $id) && $request->ajax()){
        if($request->ajax()){
            if(!empty($request->file('foto')) and $request->file('foto') != ''){
                \File::delete('uploads/usuarios/'.$user->path);
                $file = $request->file('foto');
                $nombre = str_replace(':', '_', Carbon::now()->toDateTimeString().$file->getClientOriginalName());
                $nombre = str_replace(' ', '_', $nombre);
                \Storage::disk('users')->put($nombre,  \File::get($file));
            }   
            else
                $nombre = $user->path;

            $user->fill([
                'username'  => $request['username'], 
                'name'      => $request['name'],
                'email'     => $request['email'], 
                'rol'       => $request['rol'], 
                'details'   => $request['details'],
                'path'      => $nombre
                ]);
            $user->save();
            return Response::json([
                'validations'   => true,
                'photo'         => $nombre
            ]);
        }
        else{
            Session::flash('message', 'Sin privilegios');
            return Redirect::route('principal');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $id)
    {
        $user = User::find($id);
        if (is_null ($user)){
            \App::abort(404);
        }
        $user->delete();

        if (\Request::ajax()){
            \File::delete('uploads/users/'.$user->path);
            return Response::json(array (
                'success' => true,
                'msg'     => 'Usuario "' . $user->username . '" eliminado satisfactoriamente',
                'id'      => $user->id,
            ));
        } else {
            Session::flash('message', 'Usuario "' . $user->username . '" eliminado satisfactoriamente');
            return Redirect::route('usuarios.index');
        }
    }
}
