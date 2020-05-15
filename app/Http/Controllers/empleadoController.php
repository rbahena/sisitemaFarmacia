<?php

namespace App\Http\Controllers;

use App\Models\tipoEmpleadoModel;
use App\Models\empleadoModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;

class empleadoController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $empleado = empleadoModel::where('bEstatus','=',1)->get();
        $tipoEmpleado = tipoEmpleadoModel::orderBy('sDescripcion', 'ASC')->where('bEstatus', '=', 1)->get();
        if ($request->ajax()) {
            return Datatables::of($empleado)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->kId.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Editar</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->kId.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Eliminar</a>';
                     return $btn;
                })
                ->addColumn('tipoEmpleado', function ($empleado) {
                    $valor = tipoEmpleadoModel::select('sDescripcion')->where('kId', '=', $empleado->iTipoEmpleado)->get();
                    $tipo ='<td>'.$valor[0]['sDescripcion'].'</td>';
                    return $tipo;
                })
                ->addColumn('fechaAlta', function ($row) {
                    $fecha ='<td>'.$row->fFechaAlta.'</td>';
                    return $fecha;
                })
                ->rawColumns(['action','tipoEmpleado','fechaAlta'])
                ->make(true);
        }

        return view('empleados.administracion.adminEmpleados', compact('empleado', 'tipoEmpleado'));
    }

    public function verDetalle(Request $request){
        
    }
     
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
        if($request->accion == 'crear'){
           $empleado = new empleadoModel();
           $empleado->sNombre =  $request->name;
           $empleado->sApellidoPatterno =  $request->apellidoPaterno;
           $empleado->sApellidoMaterno =  $request->apellidoMaterno;
           $empleado->sDomicilio = $request->domicilio;
           $empleado->iTipoEmpleado = $request->tipoEmpleado;
           $empleado->iCveEmpleado = $request->claveEmpleado;
           $empleado->sCorreo = $request->email;
           $empleado->sTelefono = $request->telefono;
           $empleado->sMovil = $request->celular;
           $empleado->fFechaAlta = $request->fecha;
           $empleado->save();
        }

        if($request->accion == 'editar'){
            empleadoModel::where('kId', '=', $request->empleado_id)->update(
                array('sNombre' => $request->name,
                      'sApellidoPatterno' => $request->apellidoPaterno,
                      'sApellidoMaterno' => $request->apellidoMaterno,
                      'sDomicilio' => $request->domicilio,
                      'iTipoEmpleado' => $request->tipoEmpleado,
                      'iCveEmpleado' => $request->claveEmpleado,
                      'sCorreo' => $request->email,
                      'sTelefono' => $request->telefono,
                      'sMovil' => $request->celular,
                      'fFechaAlta' => $request->fecha
                    ));
        }       
        return response()->json(['success'=>'Product saved successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = empleadoModel::find($id);
        return response()->json($product);
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        empleadoModel::where('kId', '=', $id)->update(array('bEstatus' => 0, 'fFechaBaja' =>  Carbon::now()));
    //   departamento::find($id)->delete();
        return response()->json(['success'=>'Product deleted successfully.']);
    }

    public function agregarEmpleado(){
        $tipoEmpleado = tipoEmpleadoModel::orderBy('sDescripcion', 'ASC')->where('bEstatus', '=', 1)->get();
        return view('empleados.administracion.agregarEmpleado', array(
            'tipoEmpleado' => $tipoEmpleado
        ));
    }
}
