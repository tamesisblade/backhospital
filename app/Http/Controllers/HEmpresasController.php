<?php

namespace App\Http\Controllers;

use App\Models\H_empresas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class HEmpresasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos = DB::table('hsp_empresas as emp')
        ->leftjoin('ciudad as c', 'emp.ciudad','=','c.idciudad')
        ->leftjoin('hsp_tipo as tp','emp.tipo_id','=','tp.id')
        ->select('emp.*', 'c.nombre as nombre_ciudad','c.idciudad','tp.nombre as tipoNombre','tp.id as tipoId')
        ->get();
        return $datos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->id > 0){
            $dato = H_empresas::find($request->id);
        }else{
            $dato = new H_empresas();
        }
        $dato->nombre = $request->nombre;
        $dato->direccion = $request->direccion;
        $dato->ciudad = $request->ciudad;
        $dato->convencional = $request->convencional;
        $dato->movil = $request->movil;
        $dato->email = $request->email;
        $dato->observacion = $request->observacion;
        $dato->estado = $request->estado;
        $dato->encargado = $request->encargado;
        $dato->tipo_seguro = $request->tipo_seguro;
        $dato->num_trabajadores = $request->num_trabajadores;
        $dato->tipo_id = $request->tipo_id;
        $dato->save();
        return $dato;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\H_empresas  $h_empresas
     * @return \Illuminate\Http\Response
     */
    public function show(H_empresas $h_empresas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\H_empresas  $h_empresas
     * @return \Illuminate\Http\Response
     */
    public function edit(H_empresas $h_empresas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\H_empresas  $h_empresas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, H_empresas $h_empresas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\H_empresas  $h_empresas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dato = H_empresas::find($id);
        $dato->delete();
        return $dato;
    }
    public function h_empresasActivas()
    {        
        $datos = DB::table('hsp_empresas as emp')
        ->leftjoin('hsp_tipo as t', 'emp.tipo_id','=','t.id')
        ->select('emp.*', 't.nombre as tipoNombre')
        ->where('emp.estado',1)
        ->orderby('emp.created_at','desc')
        ->get();
        return $datos;
    }
    public function ciudad()
    {
        $datos = DB::table('ciudad as c')
        ->select('c.*')
        ->get();
        return $datos;
    }
}
