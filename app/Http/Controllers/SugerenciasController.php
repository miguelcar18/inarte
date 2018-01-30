<?php

namespace App\Http\Controllers;

use App\Sugerencia;
use Illuminate\Http\Request;
use App\Http\Requests\SugerenciasRequest;
use Session;
use App;
use Auth;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use Input;
use Redirect;
use Response;

class SugerenciasController extends Controller
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
        $sugerencias = Sugerencia::All();
        return view('sugerencias.index', compact('sugerencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sugerencias.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SugerenciasRequest $request)
    {
        if($request->ajax()){
            $campos = [
                'nombre'        => $request['nombre'], 
                'sugerencia'    => $request['sugerencia']
            ];
            Sugerencia::create($campos);
            return response()->json([
                'validations' => true
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sugerencia  $sugerencia
     * @return \Illuminate\Http\Response
     */
    public function show(Sugerencia $sugerencia)
    {
        return view('sugerencias.show', ['sugerencia' => $sugerencia]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sugerencia  $sugerencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Sugerencia $sugerencia)
    {
        return view('sugerencias.edit', ['sugerencia' => $sugerencia]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sugerencia  $sugerencia
     * @return \Illuminate\Http\Response
     */
    public function update(SugerenciasRequest $request, Sugerencia $sugerencia)
    {
        if($request->ajax())
        {
            $campos = [
                'nombre'        => $request['nombre'], 
                'sugerencia'    => $request['sugerencia']
            ];
            $sugerencia->fill($campos);
            $sugerencia->save();
            return response()->json([
                'validations'       => true,
                'nuevoContenido'    => $campos           
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sugerencia  $sugerencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sugerencia $sugerencia)
    {
        if (is_null ($sugerencia))
            \App::abort(404);
        $nombreCompleto = $sugerencia->id;
        $id = $sugerencia->id;
        $sugerencia->delete();
        if (\Request::ajax()) {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Sugerencia "' . $nombreCompleto .'" eliminada satisfactoriamente',
                'id'      => $id
            ));
        } else {
            $mensaje = 'Sugerencia "'. $nombreCompleto .'" eliminada satisfactoriamente';
            Session::flash('message', $mensaje);
            return Redirect::route('sugerencias.index');
        }
    }
}
