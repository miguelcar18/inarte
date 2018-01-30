<?php

namespace App\Http\Controllers;

use App\Evento;
use Illuminate\Http\Request;
use App\Http\Requests\EventosRequest;
use Session;
use App;
use Auth;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use Input;
use Redirect;
use Response;

class EventosController extends Controller
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
        $eventos = Evento::All();
        return view('eventos.index', compact('eventos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('eventos.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventosRequest $request)
    {
        if($request->ajax()){
            $separarFecha = explode('-', $request['fecha']);
            $fechaSql     = $separarFecha[2].'-'.$separarFecha[1].'-'.$separarFecha[0];

            $campos = [
                'fecha'          => $fechaSql, 
                'lugar'          => $request['lugar'], 
                'participantes'  => $request['participantes']
            ];
            Evento::create($campos);

            return response()->json([
                'validations' => true
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $evento)
    {
        return view('eventos.show', ['evento' => $evento]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function edit(Evento $evento)
    {
        return view('eventos.edit', ['evento' => $evento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function update(EventosRequest $request, Evento $evento)
    {
        if($request->ajax())
        {
            $separarFecha = explode('-', $request['fecha']);
            $fechaSql     = $separarFecha[2].'-'.$separarFecha[1].'-'.$separarFecha[0];

            $campos = [
                'fecha'          => $fechaSql, 
                'lugar'          => $request['lugar'], 
                'participantes'  => $request['participantes']
            ];
            $evento->fill($campos);
            $evento->save();
            return response()->json([
                'validations'       => true,
                'nuevoContenido'    => $campos           
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evento $evento)
    {
        if (is_null ($evento))
            \App::abort(404);
        $nombreCompleto = $evento->fecha.' - '.$evento->lugar;
        $id = $evento->id;
        $evento->delete();
        if (\Request::ajax()) {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Evento "' . $nombreCompleto .'" eliminado satisfactoriamente',
                'id'      => $id
            ));
        } else {
            $mensaje = 'Evento "'. $nombreCompleto .'" eliminado satisfactoriamente';
            Session::flash('message', $mensaje);
            return Redirect::route('eventos.index');
        }
    }
}
