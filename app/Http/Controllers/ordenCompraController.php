<?php

namespace App\Http\Controllers;

use App\Models\almacenModel;
use App\Models\empleadoModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

    public function creaOrdenCompra(Request $request)
    {
        try {
            $proveedores = DB::select('select * from vProveedor where bEstatus = 1 order by kId desc');
            $empleados = empleadoModel::where('bEstatus', '=', 1)->get();
            $idOrden = DB::select('call piaInsertaOrden(?,?,?,?,?,?,?,?,?)', array(
                null,
                $request->datosOrden[0]['selectProveedor'],
                $request->datosOrden[2]['inputNumeroFactura'],
                1,
                $request->datosOrden[3]['inputFechaDocumento'],
                Carbon::now(),
                $request->datosOrden[1]['inputFechaEntrega'],
                $request->datosTotales[0]['selectEncargadoCompra'],
                $request->datosTotales[1]['inputComentarios'],
            ));
            $ordenCompra = DB::select('select * FROM vOrdenCompra WHERE IdCompra = :id', ['id' => (int) $idOrden]);
            $arrayPedido = [];
            $array = $request->productos;
            $array_num = count($array);
            for ($i = 0; $i < $array_num; ++$i) {
                if ($array[$i]['nvoRegistro'] != 'nvoRegistro') {
                    $idPedido = DB::select('call piaInsertaPedido(?,?,?,?,?,?,?,?,?,?,?)', array(
                        null,
                        (int) $ordenCompra,
                        (int) $array[$i]['AlmacenDestino'],
                        (int) $array[$i]['ArtXunidad'],
                        100,
                        (int) $array[$i]['idProducto'],
                        (int) $array[$i]['Descuento'],
                        (int) $array[$i]['TotalCompra'],
                        Carbon::now(),
                        1,
                        1,
                    ));
                } else {
                    $idPedido = DB::select('call piaInsertaPedido(?,?,?,?,?,?,?,?,?,?,?)', array(
                        null,
                        (int) $ordenCompra,
                        (int) $array[$i]['AlmacenDestino'],
                        (int) $array[$i]['ArtXunidad'],
                        100,
                        (int) $array[$i]['idProducto'],
                        (int) $array[$i]['Descuento'],
                        (int) $array[$i]['TotalCompra'],
                        Carbon::now(),
                        1,
                        1,
                    ));
                }
                $detallePedido = DB::select('select * FROM vPedido WHERE IdPedido = :id', ['id' => (int) $idPedido]);
                array_push($arrayPedido, $detallePedido);
            }
        } catch (Throwable $e) {
            return response()->json(['error' => $e, 'success' => 'false', 'html' => view('ordenCompra._detalleOrdenCompra')->render()]);
        }
        //$ordenCompra = DB::select('select * FROM relProveedorDireccion INNER JOIN catDireccion ON relProveedorDireccion.fkIdDireccion = catDireccion.kId WHERE catDireccion.bEstatus = 1 and relProveedorDireccion.fkIdProveedor = :id', ['id' => $request->id]);/
        return response()->json(['error' => '', 'success' => 'true', 'html' =>
            view('ordenCompra._detalleOrdenCompra', array(
                'ordenCompra' => $ordenCompra[0],
                'proveedores' => $proveedores,
                'empleados' => $empleados,
                'pedidos' => $arrayPedido,
            ))->render()]);
    }
}