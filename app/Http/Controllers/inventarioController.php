<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\departamento;
use App\Models\articulo;
use Carbon\Carbon;

class inventarioController extends Controller
{
    public function verInventario(){
        $departamentos = departamento::orderBy('sDescripcion', 'ASC')->where('bEstatus', '=', 1)->get();
        $inventario = articulo::orderBy('sArticulo', 'desc')->where('bEstatus', '=', 1)->get();
        return view('empleados.vendedor.inventarioCrud', array(
            'inventario' => $inventario,
            'departamentos' => $departamentos,
        ))->with('success', 'Lista de compras.');
    }

    public function agregarArticulo(Request $request){
        
        $nuevoArticulo = new articulo();

        $nuevoArticulo->sArticulo = strtoupper($request->input('nombreArticulo'));
        $nuevoArticulo->sDescripcion = strtoupper($request->input('descripcionArticulo'));
        $nuevoArticulo->fFechaAlta = Carbon::now();
        $nuevoArticulo->bEstatus = 1;

        $nuevoArticulo->save();
        return back()->with('success', 'Relacion precio / proveedor registrada correctamente.');

    }
}
