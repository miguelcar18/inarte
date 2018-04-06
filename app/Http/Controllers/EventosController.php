<?php

namespace App\Http\Controllers;

use App\Evento;
use App\Matricula;
use App\MatriculasEvento;
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
        $matriculas = array('' => "Seleccione") + Matricula::orderBy('nombre','asc')->get()->pluck('cedula_nombre', 'id')->toArray();
        return view('eventos.new', compact('matriculas'));
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
                'fecha'     => $fechaSql, 
                'lugar'     => $request['lugar'], 
                'nombre'    => $request['nombre']
            ];
            Evento::create($campos);

            $ultimoIdOrden = \DB::getPdo()->lastInsertId();
            for($i = 0; $i < count($request['matriculaA']); $i++){
                $camposCarga = [
                    'matricula' => $request['matriculaA'][$i], 
                    'evento'    => $ultimoIdOrden
                ];
                MatriculasEvento::create($camposCarga);
            }

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
        $datos = MatriculasEvento::where('evento', $evento->id)->get();
        return view('eventos.show', ['evento' => $evento, 'datos' => $datos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function edit(Evento $evento)
    {
        $matriculas = array('' => "Seleccione") + Matricula::orderBy('nombre','asc')->get()->pluck('cedula_nombre', 'id')->toArray();
        $listado = MatriculasEvento::where('evento', $evento->id)->get();
        return view('eventos.edit', ['evento' => $evento, 'matriculas' => $matriculas, 'listado' => $listado]);
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
                'fecha'     => $fechaSql, 
                'lugar'     => $request['lugar'], 
                'nombre'    => $request['nombre']
            ];
            $evento->fill($campos);
            $evento->save();

            for($i = 0; $i < count($request['matriculaA']); $i++){
                $busqueda = MatriculasEvento::where('evento', $evento->id)->where('matricula', $request['matriculaA'][$i])->get();
                if(count($busqueda) == 0){
                    $camposCarga = [
                        'matricula' => $request['matriculaA'][$i], 
                        'evento'    => $evento->id
                    ];
                    MatriculasEvento::create($camposCarga);
                }
            }
            $listadoCargados = MatriculasEvento::where('evento', $evento->id)->get();
            foreach ($listadoCargados as $dato) {
                if (!in_array($dato->matricula, $request['matriculaA'])) {
                    MatriculasEvento::where('id', $dato->id)->delete();
                }
            }

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
        $nombreCompleto = $evento->nombre.' - '.date_format(date_create($evento->fecha), 'd/m/Y');
        $id = $evento->id;
        $matriculasEvento = MatriculasEvento::where('evento', $id)->delete();
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
