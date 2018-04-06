<?php

namespace App\Http\Controllers;

use App\Personal;
use Illuminate\Http\Request;
use App\Http\Requests\PersonalRequest;
use Session;
use App;
use Auth;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use Input;
use Redirect;
use Response;

class PersonalController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personal = Personal::All();
        return view('personal.index', compact('personal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('personal.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()){
            $separarFecha = explode('-', $request['fechaIngreso']);
            $fechaSql     = $separarFecha[2].'-'.$separarFecha[1].'-'.$separarFecha[0];
            if(!empty($request->file('foto'))) {
                $file = $request->file('foto');
                $nombre = str_replace(':', '_', Carbon::now()->toDateTimeString().$file->getClientOriginalName());
                $nombre = str_replace(' ', '_', $nombre);
                $nombre = Carbon::now()->toDateTimeString().$file->getClientOriginalName();
                \Storage::disk('personals')->put($nombre,  \File::get($file));
            }
            else{
                $nombre = '';
            }
            $campos = [
                'foto'          => $nombre, 
                'cargo'         => $request['cargo'], 
                'edad'          => $request['edad'], 
                'nombre'        => $request['nombre'], 
                'cedula'        => $request['cedula'], 
                'fechaIngreso'  => $fechaSql, 
                'telefono'      => $request['telefono'], 
                'tipo'          => $request['tipo'], 
                'eventos'       => $request['eventos'], 
            ];
            Personal::create($campos);
            return response()->json([
                'validations' => true
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function show(Personal $personal)
    {
        return view('personal.show', ['personal' => $personal]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function edit(Personal $personal)
    {
        return view('personal.edit', ['personal' => $personal]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function update(PersonalRequest $request, Personal $personal)
    {
        if($request->ajax()){
            $separarFecha = explode('-', $request['fechaIngreso']);
            $fechaSql     = $separarFecha[2].'-'.$separarFecha[1].'-'.$separarFecha[0];
            if(!empty($request->file('foto')) and $request->file('foto') != ''){
                \File::delete('uploads/personal/'.$personal->foto);
                $file = $request->file('foto');
                $nombre = str_replace(':', '_', Carbon::now()->toDateTimeString().$file->getClientOriginalName());
                $nombre = str_replace(' ', '_', $nombre);
                $nombre = Carbon::now()->toDateTimeString().$file->getClientOriginalName();
                \Storage::disk('personals')->put($nombre,  \File::get($file));
            }   
            else{
                $nombre = $personal->foto;
            }

            $campos = [
                'foto'          => $nombre, 
                'cargo'         => $request['cargo'], 
                'edad'          => $request['edad'], 
                'nombre'        => $request['nombre'], 
                'cedula'        => $request['cedula'], 
                'fechaIngreso'  => $fechaSql, 
                'telefono'      => $request['telefono'], 
                'tipo'          => $request['tipo'], 
                'eventos'       => $request['eventos'], 
            ];
            $personal->fill($campos);
            $personal->save();
            return response()->json([
                'validations' => true,
                'nuevoContenido' => $personal         
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personal $personal)
    {
        if (is_null ($personal))
            \App::abort(404);
        $nombreCompleto = $personal->nombre;
        $id = $personal->id;
        \File::delete('uploads/personal/'.$personal->foto);
        $personal->delete();
        if (\Request::ajax()) {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Personal "' . $nombreCompleto .'" eliminado satisfactoriamente',
                'id'      => $id
            ));
        } else {
            $mensaje = 'Personal "'. $nombreCompleto .'" eliminado satisfactoriamente';
            Session::flash('message', $mensaje);
            return Redirect::route('personal.index');
        }
    }
}
