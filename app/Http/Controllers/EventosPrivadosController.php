<?php

namespace App\Http\Controllers;

use App\EventoPrivado;
use App\Matricula;
use App\MatriculasEventoPrivado;
use App\Disciplina;
use Illuminate\Http\Request;
use App\Http\Requests\EventosPrivadosRequest;
use Session;
use App;
use Auth;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use Input;
use Redirect;
use Response;

class EventosPrivadosController extends Controller
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
        $eventos = EventoPrivado::All();
        return view('eventosPrivados.index', compact('eventos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$matriculas = array('' => "Seleccione") + Matricula::orderBy('nombre','asc')->get()->pluck('cedula_nombre', 'id')->toArray();
        $matriculas = array('' => "Seleccione");
        $disciplinas = array('' => "Seleccione") + Disciplina::orderBy('nombre','asc')->pluck('nombre', 'id')->toArray();
        return view('eventosPrivados.new', compact('matriculas', 'disciplinas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventosPrivadosRequest $request)
    {
        if($request->ajax()){
            $separarFecha = explode('-', $request['fecha']);
            $fechaSql     = $separarFecha[2].'-'.$separarFecha[1].'-'.$separarFecha[0];

            $campos = [
                'fecha'         => $fechaSql, 
                'lugar'         => $request['lugar'], 
                'nombre'        => $request['nombre'],
                'empresa'       => $request['empresa'],
                'disciplina'    => $request['disciplina']
            ];
            EventoPrivado::create($campos);

            $ultimoIdOrden = \DB::getPdo()->lastInsertId();
            for($i = 0; $i < count($request['matriculaA']); $i++){
                $camposCarga = [
                    'matricula' => $request['matriculaA'][$i], 
                    'evento'    => $ultimoIdOrden
                ];
                MatriculasEventoPrivado::create($camposCarga);
            }

            return response()->json([
                'validations' => true
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EventoPrivado  $eventoPrivado
     * @return \Illuminate\Http\Response
     */
    public function show(EventoPrivado $eventoPrivado, $id)
    {
        $eventoPrivado = EventoPrivado::find($id);
        $datos = MatriculasEventoPrivado::where('evento', $eventoPrivado->id)->get();
        return view('eventosPrivados.show', ['evento' => $eventoPrivado, 'datos' => $datos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EventoPrivado  $eventoPrivado
     * @return \Illuminate\Http\Response
     */
    public function edit(EventoPrivado $eventoPrivado, $id)
    {
        $eventoPrivado = EventoPrivado::find($id);
        $matriculas = array('' => "Seleccione") + Matricula::where('disciplina', $eventoPrivado->disciplina)->orderBy('nombre','asc')->get()->pluck('cedula_nombre', 'id')->toArray();
        $disciplinas = array('' => "Seleccione") + Disciplina::orderBy('nombre','asc')->pluck('nombre', 'id')->toArray();
        $listado = MatriculasEventoPrivado::where('evento', $eventoPrivado->id)->get();
        return view('eventosPrivados.edit', ['evento' => $eventoPrivado, 'matriculas' => $matriculas, 'listado' => $listado, 'disciplinas' => $disciplinas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EventoPrivado  $eventoPrivado
     * @return \Illuminate\Http\Response
     */
    public function update(EventosPrivadosRequest $request, EventoPrivado $eventoPrivado, $id)
    {
        if($request->ajax())
        {
            $eventoPrivado = EventoPrivado::find($id);
            $separarFecha = explode('-', $request['fecha']);
            $fechaSql     = $separarFecha[2].'-'.$separarFecha[1].'-'.$separarFecha[0];

            $campos = [
                'fecha'         => $fechaSql, 
                'lugar'         => $request['lugar'], 
                'nombre'        => $request['nombre'],
                'empresa' 	    => $request['empresa'],
                'disciplina'    => $request['disciplina']
            ];
            $eventoPrivado->fill($campos);
            $eventoPrivado->save();

            for($i = 0; $i < count($request['matriculaA']); $i++){
                $busqueda = MatriculasEventoPrivado::where('evento', $eventoPrivado->id)->where('matricula', $request['matriculaA'][$i])->get();
                if(count($busqueda) == 0){
                    $camposCarga = [
                        'matricula' => $request['matriculaA'][$i], 
                        'evento'    => $eventoPrivado->id
                    ];
                    MatriculasEventoPrivado::create($camposCarga);
                }
            }
            $listadoCargados = MatriculasEventoPrivado::where('evento', $eventoPrivado->id)->get();
            foreach ($listadoCargados as $dato) {
                if (!in_array($dato->matricula, $request['matriculaA'])) {
                    MatriculasEventoPrivado::where('id', $dato->id)->delete();
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
     * @param  \App\EventoPrivado  $eventoPrivado
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventoPrivado $eventoPrivado, $id)
    {
        $eventoPrivado = EventoPrivado::find($id);
        if (is_null ($eventoPrivado))
            \App::abort(404);
        $nombreCompleto = $eventoPrivado->nombre.' - '.date_format(date_create($eventoPrivado->fecha), 'd/m/Y');
        $id = $eventoPrivado->id;
        $matriculasEvento = MatriculasEventoPrivado::where('evento', $id)->delete();
        $eventoPrivado->delete();
        if (\Request::ajax()) {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Evento "' . $nombreCompleto .'" eliminado satisfactoriamente',
                'id'      => $id
            ));
        } else {
            $mensaje = 'Evento "'. $nombreCompleto .'" eliminado satisfactoriamente';
            Session::flash('message', $mensaje);
            return Redirect::route('eventosPrivados.index');
        }
    }

    public function busquedaDisciplina(Request $request, $id){
        if($request->ajax()){
            $matriculas = Matricula::where('disciplina', $id)->orderBy('nombre','asc')->get()->pluck('cedula_nombre', 'id')->toArray();
            return Response::json(array(
                'correcto'      =>  true,
                'matriculas'    =>  $matriculas
            ));
        }
    }
}
