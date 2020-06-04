<?php

namespace App\Http\Controllers;

use App\Models\empleadoModel;
use App\Models\tipoEmpleadoModel;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class empleadoController extends Controller
{
    public function index(Request $request)
    {
        $empleado = DB::select("SELECT catEmpleado.kId,
		                        catEmpleado.sNombre,
		                        catEmpleado.sApellidos,
		                        catEmpleado.sDomicilio,
		                        catEmpleado.iCveEmpleado,
		                        catEmpleado.sCorreo,
		                        DATE_FORMAT(catEmpleado.fFechaAlta,'%d/%m/%Y') AS 'fechaAlta',
		                        catEmpleado.sTelefono,
                                catTEmpleado.kId AS 'kIdTipoEmpleado',
		                        catTEmpleado.sDescripcion
		                        FROM catEmpleado
	                            INNER JOIN catTEmpleado ON catEmpleado.iTipoEmpleado = catTEmpleado.kId
	                            WHERE catEmpleado.bEstatus = :estatus", ['estatus' => 1]);
        if ($request->ajax()) {
            return Datatables::of($empleado)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button data-toggle="tooltip" class="btn btn-primary" data-id="' . $row->kId . '" onclick="obtenerDetalleEmpleado(' . $row->kId . ')" data-original-title="Edit">Ver detalle</button>';
                    $btn = $btn . ' <button data-toggle="tooltip" class="btn btn-danger" data-id="' . $row->kId . '" onclick="eliminarEmpleado(' . $row->kId . ')" data-original-title="Edit">Eliminar</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('empleados.administracion.empleados', compact('empleado'));
    }

    public function store(Request $request)
    {
        $tipoEmpleado = tipoEmpleadoModel::orderBy('sDescripcion', 'ASC')->where('bEstatus', '=', 1)->get();
        if ($request->funcion == "crear") {
            $empleado = new empleadoModel();
            $empleado->sNombre = $request->form[1]['inputNombre'];
            $empleado->sApellidos = $request->form[2]['inputApellidos'];
            $empleado->iTipoEmpleado = (int) $request->form[6]['selectTipoEmpleado'];
            $empleado->iCveEmpleado = (int) $request->form[7]['inputClave'];
            $empleado->sCorreo = $request->form[3]['inputEmail'];
            $empleado->sTelefono = $request->form[4]['inputTelefono'];
            $empleado->sMovil = $request->form[5]['inputMovil'];
            $empleado->fFechaAlta = $request->form[8]['inputFechaIngreso'];
            $empleado->save();
            $idRegEmpleado = $empleado->kId;

            if (!empty($idRegEmpleado)) {
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
                            2, //Clienteempleado
                            (int) $idRegEmpleado, //IdClienteempleado
                            null,
                        ));
                    }
                } catch (Throwable $e) {
                    return response()->json(['error' => $e, 'success' => 'false', 'html' => view('empleadoes._detalleempleado')->render()]);
                }

            }
            $empleado = empleadoModel::where('kId', '=', $idRegEmpleado)->get();
            $direcciones = DB::select('select * FROM relClienteDireccion INNER JOIN catDireccion ON relClienteDireccion.fkIdDireccion = catDireccion.kId WHERE relClienteDireccion.fkIdCliente = :id', ['id' => $idRegEmpleado]);

        } else if ($request->funcion == "obtenerDetalle") {
            $empleado = empleadoModel::where('kId', '=', $request->id)->get();
            $direcciones = DB::select('select * FROM relClienteDireccion INNER JOIN catDireccion ON relClienteDireccion.fkIdDireccion = catDireccion.kId WHERE relClienteDireccion.fkIdCliente = :id', ['id' => $request->id]);
        } else if ($request->funcion == "editar") {
            empleadoModel::where('kId', '=', $request->id)->update(array(
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
                            1, //Clienteempleado
                            (int) $request->id, //IdClienteempleado
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
                            1, //Clienteempleado
                            (int) $request->id, //IdClienteempleado
                            null,
                        ));
                    }

                }
            } catch (Throwable $e) {
                return response()->json(['error' => $e, 'success' => 'false', 'html' => view('empleadoes._detalleempleado')->render()]);
            }

            $empleado = empleadoModel::where('kId', '=', $request->id)->get();
            $direcciones = DB::select('select * FROM relempleadoDireccion INNER JOIN catDireccion ON relempleadoDireccion.fkIdDireccion = catDireccion.kId WHERE catDireccion.bEstatus = 1 and relempleadoDireccion.fkIdempleado = :id', ['id' => $request->id]);
        }
        return response()->json(['error' => '', 'success' => 'true', 'html' =>
            view('empleados.administracion._detalleEmpleado', array(
                'empleado' => $empleado,
                'direcciones' => $direcciones,
                'tipoEmpleado' => $tipoEmpleado,
            ))->render()]);
    }

    public function edit($id)
    {
        $product = empleadoModel::find($id);
        return response()->json($product);
    }

    public function destroy($id)
    {
        empleadoModel::where('kId', '=', $id)->update(array('bEstatus' => 0, 'fFechaBaja' => Carbon::now()));
        //   departamento::find($id)->delete();
        return response()->json(['success' => 'Product deleted successfully.']);
    }

    public function agregaEmpleado()
    {
        return response()->json(['error' => '', 'success' => 'true', 'html' => view('empleados.administracion._agregarEmpleado')->render()]);
    }

    public function obtenerArticuloCtrl()
    {
        $id = $_GET['id'];
        $control = $_GET['control'];
        $idRegistro;

        try {
            switch ($control) {
                case 'primero':
                    $empleado = DB::select('select * from catempleado order by kId desc limit 1');
                    $direcciones = DB::select('select * FROM relempleadoDireccion INNER JOIN catDireccion ON relempleadoDireccion.fkIdDireccion = catDireccion.kId WHERE relempleadoDireccion.fkIdempleado = :id', ['id' => (int) $empleado[0]->kId]);
                    break;
                case 'siguiente':
                    $idRegistro = $id + 1;
                    $empleado = DB::select('select * from catempleado where kId = :id', ['id' => $idRegistro]);
                    $direcciones = DB::select('select * FROM relempleadoDireccion INNER JOIN catDireccion ON relempleadoDireccion.fkIdDireccion = catDireccion.kId WHERE relempleadoDireccion.fkIdempleado = :id', ['id' => (int) $empleado[0]->kId]);
                    break;
                case 'anterior':
                    if ($id == 0) {
                        $empleado = DB::select('select * from catempleado order by kId desc limit 1');
                        $direcciones = DB::select('select * FROM relempleadoDireccion INNER JOIN catDireccion ON relempleadoDireccion.fkIdDireccion = catDireccion.kId WHERE relempleadoDireccion.fkIdempleado = :id', ['id' => (int) $empleado[0]->kId]);
                    } else {
                        $idRegistro = $id - 1;
                        $empleado = DB::select('select * from catempleado where kId = :id', ['id' => $idRegistro]);
                        $direcciones = DB::select('select * FROM relempleadoDireccion INNER JOIN catDireccion ON relempleadoDireccion.fkIdDireccion = catDireccion.kId WHERE relempleadoDireccion.fkIdempleado = :id', ['id' => (int) $empleado[0]->kId]);
                    }
                    break;
                case 'ultimo':
                    $empleado = DB::select('select * from catempleado order by kId asc limit 1');
                    $direcciones = DB::select('select * FROM relempleadoDireccion INNER JOIN catDireccion ON relempleadoDireccion.fkIdDireccion = catDireccion.kId WHERE relempleadoDireccion.fkIdempleado = :id', ['id' => (int) $empleado[0]->kId]);
                    break;
            }
        } catch (Throwable $e) {
            return response()->json(['error' => 'No existe registro con el id indicado', 'success' => '', 'html' => '']);
        }
        return response()->json(['error' => '', 'success' => 'true', 'html' =>
            view('empleadoes._detalleempleado', array(
                'empleado' => $empleado,
                'direcciones' => $direcciones,
            ))->render()]);
    }

    public function eliminarDireccion()
    {
        $id = $_GET['id'];
        DB::statement('update catDireccion set catDireccion.bEstatus = 0 where catDireccion.kId = :id', ['id' => $id]);
    }

    public function eliminarEmpleado()
    {
        $id = $_GET['id'];
        DB::statement('update catEmpleado set catEmpleado.bEstatus = 0 where catEmpleado.kId = :id', ['id' => $id]);
    }
}