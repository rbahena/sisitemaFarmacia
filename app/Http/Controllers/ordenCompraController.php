<?php

namespace App\Http\Controllers;

use App\Models\almacenModel;
use App\Models\empleadoModel;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ordenCompraController extends Controller
{
    public function ordenCompra()
    {
        $proveedores = DB::select('select * from vProveedor where bEstatus = 1 order by kId desc');
        $empleados = empleadoModel::where('bEstatus', '=', 1)->get();
        return view('ordenCompra._ordenCompra', array(
            'proveedores' => $proveedores,
            'empleados' => $empleados));
    }

    public function obtenerDatosProveedor()
    {
        $idProveedor = $_GET['id'];
        $razonSocial = DB::select('select sRazonSocial from vProveedor where kId = :id', ['id' => $idProveedor]);
        $personaContacto = DB::select('select sPersonaContacto from vProveedor where kId = :id', ['id' => $idProveedor]);
        return response()->json(['error' => '', 'success' => 'true', 'razonSocial' => $razonSocial[0], 'personaContacto' => $personaContacto[0]]);
    }

    public function obtenerDatosProducto()
    {
        $idProducto = $_GET['id'];
        $producto = DB::select('select * from vGralArticulo where kId = :id', ['id' => $idProducto]);
        return response()->json(['error' => '', 'success' => 'true', 'data' => $producto[0]]);
    }

    public function obtenerAlmacenes()
    {
        $almacenes = almacenModel::orderBy('sAlmacen', 'ASC')->where('bEstatus', '=', 1)->get();
        return response()->json($almacenes);
    }

    public function obtenerProductos()
    {
        $articulos = DB::select('select kId, sArticulo, sNoArticulo from vGralArticulo order by kId desc');
        return response()->json($articulos);
    }

}