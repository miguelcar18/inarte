<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['as' => 'principal', 'uses' => 'BackController@index']);
Route::resource('usuarios', 'UserController');
Route::resource('disciplinas', 'DisciplinasController');
Route::resource('matriculas', 'MatriculasController');
Route::resource('mensualidades', 'MensualidadesController');
Route::resource('constancias', 'ConstanciasController');
Route::resource('personal', 'PersonalController');
Route::resource('eventos', 'EventosController');
Route::resource('eventosPrivados', 'EventosPrivadosController');
Route::resource('cursos', 'CursosController');
//Route::resource('horarios', 'HorariosController');
Route::resource('sugerencias', 'SugerenciasController');
Auth::routes();
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
Route::get('restaurar-contrasena', ['as' => 'change_password', 'uses' =>'LoginController@changePassword']);
Route::post('profile/change-password', ['as' => 'postChangePassword', 'uses' => 'LoginController@postChangePassword']);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/iconos', function () {
    return view('iconos');
});
Route::get('/morosos-mensualidades', ['as' => 'morosos', 'uses' => 'MensualidadesController@morosos']);
Route::post('/morosos-mensualidades', ['as' => 'postMorosos', 'uses' => 'MensualidadesController@resultadosMorosos']);
Route::get('/selectDisciplina/{id}', ['as' => 'selectDisciplina', 'uses' => 'EventosPrivadosController@busquedaDisciplina']);