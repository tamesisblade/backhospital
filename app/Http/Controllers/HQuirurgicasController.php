<?php

namespace App\Http\Controllers;

use App\Models\HQuirurgicas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class HQuirurgicasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dato =  DB::table('hsp_quirugicas as q')
        ->leftjoin('hsp_usuarios as med','q.idmedico','=','med.idusuario')
        ->leftjoin('hsp_usuarios as u','q.idusuario','=','u.idusuario')
        ->leftjoin('hsp_especialidades as e','q.idespecialidad','=','e.id')
        ->leftjoin('hsp_especialidades as he','med.idespecialidad','=','he.id')
        ->select('q.id as idquirurgica', 'q.estado as quirur_estado', 'q.observacion', 'q.fseguimiento', 'q.idmedico', 'q.idespecialidad as quirur_idespecialidad', 
        'med.nombres as medico_nombres', 'med.apellidos as medico_apellidos','med.cedula','med.convencional','med.movil','med.direccion','med.email','med.fnacimiento','he.nombre as medico_especialidad',
        'u.nombres as usuario_nombres', 'u.apellidos as usuario_apellidos',
        'e.id as idespecialidad','e.nombre as name_especialidad')
        ->orderby('q.created_at','desc')
        ->get();
        return $dato;
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
        if($request->id >0){
            $dato = HQuirurgicas::find($request->id);
        }else{
            $dato= new HQuirurgicas();
        }
        $dato->idmedico = $request->idmedico;
        $dato->idespecialidad = $request->idespecialidad;
        $dato->fseguimiento = $request->fseguimiento;
        $dato->estado = $request->estado;
        $dato->observacion = $request->observacion;
        $dato->idusuario = $request->idusuario;
        $dato->save();
        return $dato;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HQuirurgicas  $hQuirurgicas
     * @return \Illuminate\Http\Response
     */
    public function show(HQuirurgicas $hQuirurgicas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HQuirurgicas  $hQuirurgicas
     * @return \Illuminate\Http\Response
     */
    public function edit(HQuirurgicas $hQuirurgicas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HQuirurgicas  $hQuirurgicas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HQuirurgicas $hQuirurgicas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HQuirurgicas  $hQuirurgicas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dato = HQuirurgicas::find($id);
        $dato->delete();
        return $dato;
    }
    public function quirurgicas_pendientes()
    {
        $datos = DB::table('hsp_quirugicas as q')
        ->leftjoin('hsp_usuarios as med','q.idmedico','=','med.idusuario')
        ->select('med.nombres as medico_nombres', 'med.apellidos as medico_apellidos', 'q.fseguimiento','q.observacion')
        ->where('q.estado',2)
        ->orderby('q.created_at','desc')
        ->get();
        return $datos;
    }
    public function quirurgicas_usuario_pendientes($id)
    {
        $datos = DB::table('hsp_quirugicas as q')
        ->leftjoin('hsp_usuarios as med','q.idmedico','=','med.idusuario')
        ->select('med.nombres as medico_nombres', 'med.apellidos as medico_apellidos', 'q.fseguimiento','q.observacion')
        ->where('q.estado',2)
        ->where('q.idusuario',$id)
        ->orderby('q.created_at','desc')
        ->get();
        return $datos;
    }
    public function quirurgicas_usuario ($id)
    {
        $dato =  DB::table('hsp_quirugicas as q')
        ->leftjoin('hsp_usuarios as med','q.idmedico','=','med.idusuario')
        ->leftjoin('hsp_usuarios as u','q.idusuario','=','u.idusuario')
        ->leftjoin('hsp_especialidades as e','q.idespecialidad','=','e.id')
        ->leftjoin('hsp_especialidades as he','med.idespecialidad','=','he.id')
        ->where('q.idusuario',$id)
        ->select('q.id as idquirurgica', 'q.estado as quirur_estado', 'q.observacion', 'q.fseguimiento', 'q.idmedico', 'q.idespecialidad as quirur_idespecialidad', 
        'med.nombres as medico_nombres', 'med.apellidos as medico_apellidos','med.cedula','med.convencional','med.movil','med.direccion','med.email','med.fnacimiento','he.nombre as medico_especialidad',
        'u.nombres as usuario_nombres', 'u.apellidos as usuario_apellidos',
        'e.id as idespecialidad','e.nombre as name_especialidad')
        ->orderby('q.created_at','desc')
        ->get();
        return $dato;
    }
}
