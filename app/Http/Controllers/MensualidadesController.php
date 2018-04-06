<?php

namespace App\Http\Controllers;

use App\Mensualidad;
use App\Matricula;
use Illuminate\Http\Request;
use App\Http\Requests\MensualidadesRequest;
use Session;
use App;
use Auth;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use Input;
use Redirect;
use Response;

class MensualidadesController extends Controller
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
        $mensualidades = Mensualidad::All();
        return view('mensualidades.index', compact('mensualidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $matriculas = array('' => "Seleccione") + Matricula::orderBy('nombre','asc')->get()->pluck('cedula_nombre', 'id')->toArray();
        return view('mensualidades.new', compact('matriculas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MensualidadesRequest $request)
    {
        if($request->ajax()){
            $campos = [ 
                'banco'         => $request['banco'], 
                'comprobante'   => $request['comprobante'], 
                'mes'           => $request['mes'], 
                'anio'          => $request['anio'], 
                'matricula'     => $request['matricula']
            ];
            Mensualidad::create($campos);
            return response()->json([
                'validations' => true
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mensualidad  $mensualidad
     * @return \Illuminate\Http\Response
     */
    public function show(Mensualidad $mensualidad, $id)
    {
        $mensualidad = Mensualidad::find($id);
        return view('mensualidades.show', ['mensualidad' => $mensualidad]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mensualidad  $mensualidad
     * @return \Illuminate\Http\Response
     */
    public function edit(Mensualidad $mensualidad, $id)
    {
        $mensualidad = Mensualidad::find($id);
        $matriculas = array('' => "Seleccione") + Matricula::orderBy('nombre','asc')->get()->pluck('cedula_nombre', 'id')->toArray();
        return view('mensualidades.edit', ['mensualidad' => $mensualidad, 'matriculas' => $matriculas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mensualidad  $mensualidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mensualidad $mensualidad, $id)
    {
        $mensualidad = Mensualidad::find($id);
        if($request->ajax())
        {
            $campos = [ 
                'banco'         => $request['banco'], 
                'comprobante'   => $request['comprobante'], 
                'mes'           => $request['mes'], 
                'anio'          => $request['anio'], 
                'matricula'     => $request['matricula']
            ];
            $mensualidad->fill($campos);
            $mensualidad->save();
            return response()->json([
                'validations'       => true,
                'nuevoContenido'    => $campos           
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mensualidad  $mensualidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mensualidad $mensualidad, $id)
    {
        $mensualidad = Mensualidad::find($id);
        if (is_null ($mensualidad))
            \App::abort(404);
        $nombreCompleto = 'de '.$mensualidad->nombreMatricula->nombre.' del mes de '.$mensualidad->mes.' y del año '.$mensualidad->anio;
        $id = $mensualidad->id;
        $mensualidad->delete();
        if (\Request::ajax()) {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Mensualidad ' . $nombreCompleto .' eliminada satisfactoriamente',
                'id'      => $id
            ));
        } else {
            $mensaje = 'Mensualidad '. $nombreCompleto .' eliminada satisfactoriamente';
            Session::flash('message', $mensaje);
            return Redirect::route('mensualidades.index');
        }
    }
}
