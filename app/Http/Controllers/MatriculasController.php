<?php

namespace App\Http\Controllers;

use App\Matricula;
use App\Disciplina;
use Illuminate\Http\Request;
use App\Http\Requests\MatriculasRequest;
use Session;
use App;
use Auth;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use Input;
use Redirect;
use Response;

class MatriculasController extends Controller
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
        $matriculas = Matricula::All();
        return view('matriculas.index', compact('matriculas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $disciplinas = array('' => "Seleccione") + Disciplina::orderBy('nombre','asc')->pluck('nombre', 'id')->toArray();
        return view('matriculas.new', compact('disciplinas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MatriculasRequest $request)
    {
        if($request->ajax()){
            $separarFecha = explode('-', $request['fechaNacimiento']);
            $fechaSql     = $separarFecha[2].'-'.$separarFecha[1].'-'.$separarFecha[0];
            $campos = [
                'cedula'                => $request['cedula'], 
                'nombre'                => $request['nombre'],
                'cedulaRepresentante'   => $request['cedulaRepresentante'], 
                'representante'         => $request['representante'],
                'fechaNacimiento'       => $fechaSql, 
                'disciplina'            => $request['disciplina']
            ];
            Matricula::create($campos);
            return response()->json([
                'validations' => true,
                'campos' => $campos
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function show(Matricula $matricula)
    {
        return view('matriculas.show', ['matricula' => $matricula]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function edit(Matricula $matricula)
    {
        $disciplinas = array('' => "Seleccione") + Disciplina::orderBy('nombre','asc')->pluck('nombre', 'id')->toArray();
        return view('matriculas.edit', ['matricula' => $matricula, 'disciplinas' => $disciplinas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function update(MatriculasRequest $request, Matricula $matricula)
    {
        if($request->ajax()){
            $separarFecha = explode('-', $request['fechaNacimiento']);
            $fechaSql     = $separarFecha[2].'-'.$separarFecha[1].'-'.$separarFecha[0];
            $campos = [
                'cedula'                => $request['cedula'], 
                'nombre'                => $request['nombre'],
                'cedulaRepresentante'   => $request['cedulaRepresentante'], 
                'representante'         => $request['representante'],
                'fechaNacimiento'       => $fechaSql, 
                'disciplina'            => $request['disciplina']
            ];
            $matricula->fill($campos);
            $matricula->save();
            return response()->json([
                'validations'       => true,
                'nuevoContenido'    => $campos           
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matricula $matricula)
    {
        if (is_null ($matricula))
            \App::abort(404);
        $nombreCompleto = $matricula->nombre;
        $id = $matricula->id;
        $matricula->delete();
        if (\Request::ajax()) {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Matricula de "' . $nombreCompleto .'" eliminada satisfactoriamente',
                'id'      => $id
            ));
        } else {
            $mensaje = 'Matricula de "'. $nombreCompleto .'" eliminada satisfactoriamente';
            Session::flash('message', $mensaje);
            return Redirect::route('matriculas.index');
        }
    }
}
