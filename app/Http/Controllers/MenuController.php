<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $menu = DB::SELECT("SELECT * FROM menu WHERE grupo_id = ? ORDER BY orden",[$request->idgrupo]);
        return $menu;
    }
    public function menuHospital(Request $request){
        $menu = DB::SELECT("SELECT * FROM menu WHERE grupo_id = ? and estado = 1 ORDER BY orden",[$request->idgrupo]);
        return $menu;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
    }
    public function grupos()
    {
        $dato = DB::SELECT("SELECT * FROM  hsp_grupos WHERE estado = 1");
        return $dato;
    }
    public function listaMenu()
    {
        $menu = DB::SELECT("SELECT m.*, g.nombre as grupo, g.descripcion 
        FROM menu m, hsp_grupos g 
        WHERE  m.grupo_id = g.id
        ORDER BY grupo_id ASC, orden ASC");
        return $menu;
    }
    public function add_editMenu(Request $request)
    {
        if(!empty($request->idmenu) && $request->idmenu != null  ){
            $datos = Menu::find($request->idmenu);
        }else{
            $datos = new Menu();
        }
        // return $datos;

        $datos->orden = $request->orden;
        $datos->url = $request->url;
        $datos->name = $request->nombre;
        $datos->icon = $request->icono;
        $datos->grupo_id = $request->grupo;
        
        $datos->save();

        return $datos;
    }
    public function eliminarMenu($id)
    {
        $menu = Menu::find($id);
        $menu->delete();
        return $menu;
    }
}
