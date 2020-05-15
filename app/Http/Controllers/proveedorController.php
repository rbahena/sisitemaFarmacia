<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\proveedorModel;
use Carbon\Carbon;
use DataTables;

class proveedorController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $proveedor = proveedorModel::where('bEstatus','=',1)->get();

        if ($request->ajax()) {
            return Datatables::of($proveedor)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->kId.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Editar</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->kId.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Eliminar</a>';
                     return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('proveedores.proveedores', compact('proveedor'));
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
           $proveedor = new proveedorModel();
           $proveedor->sRazonSocial =  $request->name;
           $proveedor->sRFC =  $request->RFC;
           $proveedor->sDomicilio =  $request->direccion;
           $proveedor->iTelefono = $request->telefono;
           $proveedor->sCorreo = $request->email;
           $proveedor->save();
        }

        if($request->accion == 'editar'){
            proveedorModel::where('kId', '=', $request->proveedor_id)->update(
                array('sRazonSocial' => $request->name,
                      'sRFC' => $request->RFC,
                      'sDomicilio' => $request->direccion,
                      'iTelefono' => $request->telefono,
                      'sCorreo' => $request->email
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
        $product = proveedorModel::find($id);
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
        proveedorModel::where('kId', '=', $id)->update(array('bEstatus' => 0, 'fFechaBaja' =>  Carbon::now()));
    //   departamento::find($id)->delete();
        return response()->json(['success'=>'Product deleted successfully.']);
    }
}
