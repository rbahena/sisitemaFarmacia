<?php

namespace App\Http\Controllers;

use App\Models\listaModel;
use DataTables;
use Illuminate\Http\Request;

class listaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = listaModel::where('bEstatus', '=', 1)->get();

        if ($request->ajax()) {
            return Datatables::of($books)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->kId . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Editar</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->kId . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Eliminar</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('listas.listas', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->accion == 'crear') {
            $lista = new listaModel();
            $lista->sLista = $request->name;
            $lista->sDescripcion = $request->descripcion;
            $lista->sFormula = $request->formaula;
            $lista->save();
        }

        if ($request->accion == 'editar') {
            listaModel::where('kId', '=', $request->product_id)->update(array('sLista' => $request->name, 'sDescripcion' => $request->descripcion, 'sFormula' => $request->formaula));
        }
        return response()->json(['success' => 'Product saved successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = listaModel::find($id);
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
        listaModel::where('kId', '=', $id)->update(array('bEstatus' => 0));
        //   departamento::find($id)->delete();
        return response()->json(['success' => 'Product deleted successfully.']);
    }
}
