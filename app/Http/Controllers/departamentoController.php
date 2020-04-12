<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\departamento;
use DataTables;

class departamentoController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = departamento::where('kId','!=',0)->where('bEstatus','=',1)->get();

        if ($request->ajax()) {
            return Datatables::of($books)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->kId.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Editar</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->kId.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Eliminar</a>';
                     return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('departamentos.departamentos', compact('books'));
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
            $dpto = new departamento();
            $dpto->sDescripcion =  $request->name;
            $dpto->save();
        }

        if($request->accion == 'editar'){
            departamento::where('kId', '=', $request->product_id)->update(array('sDescripcion' => $request->name));
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
        $product = departamento::find($id);
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
        departamento::where('kId', '=', $id)->update(array('bEstatus' => 0));
    //   departamento::find($id)->delete();
     
        return response()->json(['success'=>'Product deleted successfully.']);
    }
}