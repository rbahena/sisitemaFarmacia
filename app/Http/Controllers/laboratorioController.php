<?php

namespace App\Http\Controllers;

use App\Models\laboratorio;
use DataTables;
use Illuminate\Http\Request;

class laboratorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = laboratorio::where('kId', '!=', 0)->where('bEstatus', '=', 1)->whereNotNull('sClave')->get();

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

        return view('laboratorios.laboratorios', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (empty($request->name) || empty($request->clave)) {
            return response()->json(['error' => 'faltan datos', 'success' => 'false']);
        }

        if ($request->accion == 'crear') {
            if (laboratorio::where('sClave', '=', $request->clave)->where('bEstatus', '=', 1)->exists()) {
                return response()->json(['error' => 'La clave ya existe', 'success' => 'false']);
            }

            $labo = new laboratorio();
            $labo->sDescripcion = $request->name;
            $labo->sClave = $request->clave;
            $labo->save();
        }

        if ($request->accion == 'editar') {
            laboratorio::where('kId', '=', $request->product_id)->update(array('sDescripcion' => $request->name, 'sClave' => $request->clave));
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
        $labo = laboratorio::find($id);
        return response()->json($labo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        laboratorio::where('kId', '=', $id)->update(array('bEstatus' => 0));
        //   departamento::find($id)->delete();

        return response()->json(['success' => 'Product deleted successfully.']);
    }
}
