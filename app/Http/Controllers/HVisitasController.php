<?php

namespace App\Http\Controllers;

use App\Models\HVisitas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use PhpParser\Node\Stmt\Else_;

class HVisitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos = DB::table('hsp_visitas as vis')
        ->leftjoin('hsp_empresas as emp', 'vis.idempresa','=','emp.id')
        ->leftjoin('hsp_usuarios as u', 'vis.idusuario','=','u.idusuario')
        ->select('vis.*', 'emp.nombre as empresa','u.nombres','u.apellidos')
        ->orderby('vis.created_at','desc')
        ->get();
        return $datos;
    }
    public function h_visitas_reporte(Request $request){
        //========reportes QUIRUGICO=====
        if($request->quiruguica){
            if($request->id){
                $reporte = $this->ReporteQuirugicoIndividual($request->id,$request->fromDate,$request->toDate);
            }else{
                $reporte = $this->ReporteQuirugicoGeneral($request->fromDate,$request->toDate);
            }
            return $reporte;
          
        }
        //========reportes por visitas=====
        //reporte individual
        if($request->id){
            $visitas = DB::SELECT("CALL `reporteIndVisitas`('$request->id','$request->fromDate','$request->toDate');
            ");
        }
        //reporte general 
        else{
            $visitas = DB::SELECT("CALL`reporteGQuirurgico`('$request->fromDate','$request->toDate')
            ");
        }
     
        return $visitas;
    }

    public function ReporteQuirugicoIndividual($id,$fromDate,$toDate){
        //reporte individual
        $visitas = DB::SELECT("CALL `reporteIndQuirurgico`('$id','$fromDate','$toDate')
    
      
            ");
        return $visitas;
    }
    public function ReporteQuirugicoGeneral($fromDate,$toDate){
        $visitas = DB::SELECT("CALL`reporteGQuirurgico`('$fromDate','$toDate')
        "); 
        return $visitas;
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
            $dato = HVisitas::find($request->id);
        }
        else{
            $dato = new HVisitas();
        }
        $dato->idusuario = $request->idusuario;
        $dato->idempresa = $request->idempresa;
        $dato->fecha_visita = $request->fecha_visita;
        $dato->observacion = $request->observacion;
        $dato->estado = $request->estado;
        $dato->save();
        return $dato;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HVisitas  $hVisitas
     * @return \Illuminate\Http\Response
     */
    public function show(HVisitas $hVisitas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HVisitas  $hVisitas
     * @return \Illuminate\Http\Response
     */
    public function edit(HVisitas $hVisitas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HVisitas  $hVisitas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HVisitas $hVisitas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HVisitas  $hVisitas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dato = HVisitas::findOrFail($id);
        $dato->delete();
        return $dato;
    }
    public function visitas_pendientes()
    {
        $datos = DB::table('hsp_visitas as vis')
        ->leftjoin('hsp_empresas as emp', 'vis.idempresa','=','emp.id')
        ->select('vis.*', 'emp.nombre as empresa')
        ->where('vis.estado',2)
        ->orderby('vis.created_at','desc')
        ->get();
        return $datos;
    }
    public function historicoHospital(Request $request)
    {
        $res = DB::INSERT('INSERT INTO `his_auditoria`(`idusuario`, `accion`) VALUES (?,?)',[$request->idusuario,$request->accion]);
        return $res;
    }
    public function visitas_usuario_pendientes($id)
    {
        $datos = DB::table('hsp_visitas as vis')
        ->leftjoin('hsp_empresas as emp', 'vis.idempresa','=','emp.id')
        ->select('vis.*', 'emp.nombre as empresa')
        ->where('vis.estado',2)
        ->where('vis.idusuario',$id)
        ->orderby('vis.created_at','desc')
        ->get();
        return $datos;
    }
    public function visitas_usuario($id)
    {
        $datos = DB::table('hsp_visitas as vis')
        ->leftjoin('hsp_empresas as emp', 'vis.idempresa','=','emp.id')
        ->select('vis.*', 'emp.nombre as empresa')
        ->where('vis.idusuario',$id)
        ->orderby('vis.created_at','desc')
        ->get();
        return $datos;
    }
}
