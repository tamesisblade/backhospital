<?php

namespace App\Http\Controllers;

use App\Models\HTipo;
use Illuminate\Http\Request;

class HTipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dato = HTipo::get();
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
        if($request->id > 0){
            $dato = HTipo::find($request->id);
        }else{
            $dato = new HTipo();
        }
        $dato->nombre = $request->nombre;
        $dato->descripcion = $request->descripcion;
        $dato->estado = $request->estado;
        $dato->save();
        return $dato;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HTipo  $hTipo
     * @return \Illuminate\Http\Response
     */
    public function show(HTipo $hTipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HTipo  $hTipo
     * @return \Illuminate\Http\Response
     */
    public function edit(HTipo $hTipo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HTipo  $hTipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HTipo $hTipo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HTipo  $hTipo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dato = HTipo::find($id);
        $dato->delete();
        return $dato;
    }
    public function tipos_activos()
    {
        $dato = HTipo::where('estado',1)
        ->get();
        return $dato;
    }
}
