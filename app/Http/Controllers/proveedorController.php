<?php

namespace App\Http\Controllers;

use App\Models\proveedorModel;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class proveedorController extends Controller
{
    public function index(Request $request)
    {
        $proveedor = DB::select("select * from vProveedor where bEstatus = :estatus", ['estatus' => 1]);

        if ($request->ajax()) {
            return Datatables::of($proveedor)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button data-toggle="tooltip" class="btn btn-primary" data-id="' . $row->kId . '" onclick="obtenerDetalleProveedor(' . $row->kId . ')" data-original-title="Edit">Ver detalle</button>';
                    $btn = $btn . ' <button data-toggle="tooltip" class="btn btn-danger" data-id="' . $row->kId . '" onclick="eliminarProveedor(' . $row->kId . ')" data-original-title="Edit">Eliminar</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('proveedores.proveedores', compact('proveedor'));
    }

    public function store(Request $request)
    {
        if ($request->funcion == "crear") {
            $proveedor = new proveedorModel();
            $proveedor->sRazonSocial = $request->form[1]['inputRazonSocial'];
            $proveedor->sRFC = $request->form[2]['inputRFC'];
            $proveedor->sPersonaContacto = $request->form[7]['inputDatosContacto'];
            $proveedor->iTelefono1 = (int) $request->form[3]['inputPrimerTelefono'];
            $proveedor->iTelefono2 = (int) $request->form[4]['inputSegundoTelefono'];
            $proveedor->iTelefonoMovil = (int) $request->form[5]['inputMovil'];
            $proveedor->sCorreo = $request->form[6]['inputEmail'];
            $proveedor->save();
            $idRegProovedor = $proveedor->kId;

            if (!empty($idRegProovedor)) {
                try {
                    $array = $request->direcciones;
                    $array_num = count($array);
                    for ($i = 0; $i < $array_num; ++$i) {
                        DB::statement('call piCreaDireccion(?,?,?,?,?,?,?,?,?,?,?,?,?)', array(
                            $array[$i]['Calle'],
                            $array[$i]['Colonia'],
                            $array[$i]['Municipio'],
                            $array[$i]['Ciudad'],
                            $array[$i]['Estado'],
                            $array[$i]['Pais'],
                            $array[$i]['Interior'],
                            $array[$i]['Exterior'],
                            (int) $array[$i]['CP'],
                            1, //Estatus
                            1, //ClienteProveedor
                            (int) $idRegProovedor, //IdClienteProveedor
                            null,
                        ));
                    }
                } catch (Throwable $e) {
                    return response()->json(['error' => $e, 'success' => 'false', 'html' => view('proveedores._detalleProveedor')->render()]);
                }

            }
            $proveedor = proveedorModel::where('kId', '=', $idRegProovedor)->get();
            $direcciones = DB::select('select * FROM relProveedorDireccion INNER JOIN catDireccion ON relProveedorDireccion.fkIdDireccion = catDireccion.kId WHERE relProveedorDireccion.fkIdProveedor = :id', ['id' => $idRegProovedor]);

        } else if ($request->funcion == "obtenerDetalle") {
            $proveedor = proveedorModel::where('kId', '=', $request->id)->get();
            $direcciones = DB::select('select * FROM relProveedorDireccion INNER JOIN catDireccion ON relProveedorDireccion.fkIdDireccion = catDireccion.kId WHERE catDireccion.bEstatus = 1 and relProveedorDireccion.fkIdProveedor = :id', ['id' => $request->id]);
        } else if ($request->funcion == "editar") {
            proveedorModel::where('kId', '=', $request->id)->update(array(
                'sRazonSocial' => $request->form[1]['inputRazonSocial'],
                'sRFC' => $request->form[2]['inputRFC'],
                'sPersonaContacto' => $request->form[7]['inputDatosContacto'],
                'iTelefono1' => $request->form[3]['inputPrimerTelefono'],
                'iTelefono2' => $request->form[4]['inputSegundoTelefono'],
                'iTelefonoMovil' => $request->form[5]['inputMovil'],
                'sCorreo' => $request->form[6]['inputEmail']));
            try {
                $array = $request->direcciones;
                $array_num = count($array);
                for ($i = 0; $i < $array_num; ++$i) {
                    if ($array[$i]['idDireccion'] != 'nvaDireccion') {
                        DB::statement('call piCreaDireccion(?,?,?,?,?,?,?,?,?,?,?,?,?)', array(
                            $array[$i]['Calle'],
                            $array[$i]['Colonia'],
                            $array[$i]['Municipio'],
                            $array[$i]['Ciudad'],
                            $array[$i]['Estado'],
                            $array[$i]['Pais'],
                            $array[$i]['Interior'],
                            $array[$i]['Exterior'],
                            (int) $array[$i]['CP'],
                            1, //Estatus
                            1, //ClienteProveedor
                            (int) $request->id, //IdClienteProveedor
                            $array[$i]['idDireccion'],
                        ));
                    } else {
                        DB::statement('call piCreaDireccion(?,?,?,?,?,?,?,?,?,?,?,?,?)', array(
                            $array[$i]['Calle'],
                            $array[$i]['Colonia'],
                            $array[$i]['Municipio'],
                            $array[$i]['Ciudad'],
                            $array[$i]['Estado'],
                            $array[$i]['Pais'],
                            $array[$i]['Interior'],
                            $array[$i]['Exterior'],
                            (int) $array[$i]['CP'],
                            1, //Estatus
                            1, //ClienteProveedor
                            (int) $request->id, //IdClienteProveedor
                            null,
                        ));
                    }

                }
            } catch (Throwable $e) {
                return response()->json(['error' => $e, 'success' => 'false', 'html' => view('proveedores._detalleProveedor')->render()]);
            }

            $proveedor = proveedorModel::where('kId', '=', $request->id)->get();
            $direcciones = DB::select('select * FROM relProveedorDireccion INNER JOIN catDireccion ON relProveedorDireccion.fkIdDireccion = catDireccion.kId WHERE catDireccion.bEstatus = 1 and relProveedorDireccion.fkIdProveedor = :id', ['id' => $request->id]);
        }
        return response()->json(['error' => '', 'success' => 'true', 'html' =>
            view('proveedores._detalleProveedor', array(
                'proveedor' => $proveedor,
                'direcciones' => $direcciones,
            ))->render()]);
    }

    public function edit($id)
    {
        $product = proveedorModel::find($id);
        return response()->json($product);
    }

    public function destroy($id)
    {
        proveedorModel::where('kId', '=', $id)->update(array('bEstatus' => 0, 'fFechaBaja' => Carbon::now()));
        //   departamento::find($id)->delete();
        return response()->json(['success' => 'Product deleted successfully.']);
    }

    public function agregaProveedor()
    {
        return response()->json(['error' => '', 'success' => 'true', 'html' => view('proveedores._agregarProveedor')->render()]);
    }

    public function obtenerArticuloCtrl()
    {
        $id = $_GET['id'];
        $control = $_GET['control'];
        $idRegistro;

        try {
            switch ($control) {
                case 'primero':
                    $proveedor = DB::select('select * from catProveedor order by kId desc limit 1');
                    $direcciones = DB::select('select * FROM relProveedorDireccion INNER JOIN catDireccion ON relProveedorDireccion.fkIdDireccion = catDireccion.kId WHERE relProveedorDireccion.fkIdProveedor = :id', ['id' => (int) $proveedor[0]->kId]);
                    break;
                case 'siguiente':
                    $idRegistro = $id + 1;
                    $proveedor = DB::select('select * from catProveedor where kId = :id', ['id' => $idRegistro]);
                    $direcciones = DB::select('select * FROM relProveedorDireccion INNER JOIN catDireccion ON relProveedorDireccion.fkIdDireccion = catDireccion.kId WHERE relProveedorDireccion.fkIdProveedor = :id', ['id' => (int) $proveedor[0]->kId]);
                    break;
                case 'anterior':
                    if ($id == 0) {
                        $proveedor = DB::select('select * from catProveedor order by kId desc limit 1');
                        $direcciones = DB::select('select * FROM relProveedorDireccion INNER JOIN catDireccion ON relProveedorDireccion.fkIdDireccion = catDireccion.kId WHERE relProveedorDireccion.fkIdProveedor = :id', ['id' => (int) $proveedor[0]->kId]);
                    } else {
                        $idRegistro = $id - 1;
                        $proveedor = DB::select('select * from catProveedor where kId = :id', ['id' => $idRegistro]);
                        $direcciones = DB::select('select * FROM relProveedorDireccion INNER JOIN catDireccion ON relProveedorDireccion.fkIdDireccion = catDireccion.kId WHERE relProveedorDireccion.fkIdProveedor = :id', ['id' => (int) $proveedor[0]->kId]);
                    }
                    break;
                case 'ultimo':
                    $proveedor = DB::select('select * from catProveedor order by kId asc limit 1');
                    $direcciones = DB::select('select * FROM relProveedorDireccion INNER JOIN catDireccion ON relProveedorDireccion.fkIdDireccion = catDireccion.kId WHERE relProveedorDireccion.fkIdProveedor = :id', ['id' => (int) $proveedor[0]->kId]);
                    break;
            }
        } catch (Throwable $e) {
            return response()->json(['error' => 'No existe registro con el id indicado', 'success' => '', 'html' => '']);
        }
        return response()->json(['error' => '', 'success' => 'true', 'html' =>
            view('proveedores._detalleProveedor', array(
                'proveedor' => $proveedor,
                'direcciones' => $direcciones,
            ))->render()]);
    }

    public function eliminarDireccion()
    {
        $id = $_GET['id'];
        DB::statement('update catDireccion set catDireccion.bEstatus = 0 where catDireccion.kId = :id', ['id' => $id]);
    }

    public function eliminarProveedor()
    {
        $id = $_GET['id'];
        DB::statement('update catProveedor set catProveedor.bEstatus = 0 where catProveedor.kId = :id', ['id' => $id]);
    }

}