<?php

namespace App\Http\Controllers;

use App\Constancia;
use App\Personal;
use Illuminate\Http\Request;
use App\Http\Requests\ConstanciasRequest;
use Session;
use App;
use Auth;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use Input;
use Redirect;
use Response;

class ConstanciasController extends Controller
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
        $constancias = Constancia::All();
        return view('constancias.index', compact('constancias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personals = array('' => "Seleccione") + Personal::orderBy('nombre','asc')->get()->pluck('cedula_nombre', 'id')->toArray();
        return view('constancias.new', compact('personals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConstanciasRequest $request)
    {
        if($request->ajax()){
            $campos = [
                'dirigido'  => $request['dirigido'], 
                'personal'  => $request['personal'], 
                'tipo'      => $request['tipo']
            ];
            Constancia::create($campos);
            return response()->json([
                'validations' => true
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Constancia  $constancia
     * @return \Illuminate\Http\Response
     */
    public function show(Constancia $constancia)
    {
        return view('constancias.show', ['constancia' => $constancia]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Constancia  $constancia
     * @return \Illuminate\Http\Response
     */
    public function edit(Constancia $constancia)
    {
        $personals = array('' => "Seleccione") + Personal::orderBy('nombre','asc')->get()->pluck('cedula_nombre', 'id')->toArray();
        return view('constancias.edit', ['constancia' => $constancia, 'personals' => $personals]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Constancia  $constancia
     * @return \Illuminate\Http\Response
     */
    public function update(ConstanciasRequest $request, Constancia $constancia)
    {
        if($request->ajax())
        {
            $campos = [
                'dirigido'  => $request['dirigido'], 
                'personal'  => $request['personal'], 
                'tipo'      => $request['tipo']
            ];
            $constancia->fill($campos);
            $constancia->save();
            return response()->json([
                'validations'       => true,
                'nuevoContenido'    => $campos           
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Constancia  $constancia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Constancia $constancia)
    {
        if (is_null ($constancia))
            \App::abort(404);
        $nombreCompleto = $constancia->nombrePersonal->nombre;
        $id = $constancia->id;
        $constancia->delete();
        if (\Request::ajax()) {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Constancia de "' . $nombreCompleto .'" eliminada satisfactoriamente',
                'id'      => $id
            ));
        } else {
            $mensaje = 'Constancia "'. $nombreCompleto .'" eliminada satisfactoriamente';
            Session::flash('message', $mensaje);
            return Redirect::route('constancias.index');
        }
    }
}
