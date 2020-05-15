<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\almacenModel;
use DataTables;

class almacenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $almacen = almacenModel::where('bEstatus','=',1)->get();

        if ($request->ajax()) {
            return Datatables::of($almacen)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->kId.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Editar</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->kId.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Eliminar</a>';
                     return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('almacenes.almacenes', compact('almacen'));
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
            $lista = new almacenModel();
            $lista->sAlmacen =  $request->name;
            $lista->sCveAlmacen = $request->clave;
            $lista->save();
        }

        if($request->accion == 'editar'){
            almacenModel::where('kId', '=', $request->almacen_id)->update(array('sAlmacen' => $request->name,'sCveAlmacen' => $request->clave));
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
        $product = almacenModel::find($id);
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
        almacenModel::where('kId', '=', $id)->update(array('bEstatus' => 0));
    //   departamento::find($id)->delete();
        return response()->json(['success'=>'Product deleted successfully.']);
    }
}
