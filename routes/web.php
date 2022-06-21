<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});




//=======APIS NORTH HOSPITAL========================
Route::resource('hospitalnorte','LoginNorthHospitalController');
Route::resource('h_empresas','HEmpresasController');
Route::resource('h_visitas','HVisitasController');
Route::resource('h_especialidades','HEspecialidadesController');
Route::resource('h_medicos','HMedicosController');
Route::resource('h_quirurgicas','HQuirurgicasController');
Route::resource('h_tipos','HTipoController');
Route::get('h_empresasActivas','HEmpresasController@h_empresasActivas');
Route::get('v_pendientes','HVisitasController@visitas_pendientes');
Route::get('listaMedicos','HMedicosController@solo_medicos');
Route::get('birthday','HMedicosController@medicos_birthday');
Route::post('historicoHospital','HVisitasController@historicoHospital');
Route::get('menuHospital','MenuController@menuHospital');
Route::get('t_activos','HTipoController@tipos_activos');
Route::get('ciudad','HEmpresasController@ciudad');
Route::get('grupos','MenuController@grupos');
Route::get('h_visitas_reporte','HVisitasController@h_visitas_reporte');
Route::get('v_pendientesUser/{id}','HVisitasController@visitas_usuario_pendientes');
Route::get('visitasUser/{id}','HVisitasController@visitas_usuario');
Route::get('quirurgicas_pendientes','HQuirurgicasController@quirurgicas_pendientes');
Route::get('qui_pendientesUser/{id}','HQuirurgicasController@quirurgicas_usuario_pendientes');
Route::get('quirurgicasUser/{id}','HQuirurgicasController@quirurgicas_usuario');
