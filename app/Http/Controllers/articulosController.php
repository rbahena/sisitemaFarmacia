<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\departamento;
use App\Models\laboratorio;
use App\Models\medidaSAT;
use App\Models\articulo;
use Carbon\Carbon;

class articulosController extends Controller
{
    public function verInventario(){
        $departamentos = departamento::orderBy('sDescripcion', 'ASC')->where('bEstatus', '=', 1)->get();
        $laboratorios = laboratorio::orderBy('sDescripcion', 'ASC')->where('bEstatus', '=', 1)->get();
        $inventario = articulo::orderBy('sArticulo', 'desc')->where('bEstatus', '=', 1)->get();
        return view('articulos.listadoInventario', array(
            'inventario' => $inventario,
            'departamentos' => $departamentos,
            'laboratorios' => $laboratorios
        ));
    }

    public function detalleArticulo(){
        $departamentos = departamento::orderBy('sDescripcion', 'ASC')->where('bEstatus', '=', 1)->get();
        $laboratorios = laboratorio::orderBy('sDescripcion', 'ASC')->where('bEstatus', '=', 1)->get();
        $medidaSAT = medidaSAT::orderBy('sNombre','ASC')->where('bEstatus', '=', 1)->get();
        return view('articulos._agregarArticulo', array(
            'departamentos' => $departamentos,
            'laboratorios' => $laboratorios,
            'medidaSAT' => $medidaSAT
        ));
    }

    public function obtenerArticulo(){
        
        $clave = $_GET['clave'];
        $estatus = 1;
        $departamentos = departamento::orderBy('sDescripcion', 'ASC')->where('bEstatus', '=', 1)->get();
        $laboratorios = laboratorio::orderBy('sDescripcion', 'ASC')->where('bEstatus', '=', 1)->get();
        $medidaSAT = medidaSAT::orderBy('sNombre','ASC')->where('bEstatus', '=', 1)->get();

        $detalleArticulo = DB::select('call pcObtieneDatosArticulo(?,?)',array($clave,$estatus));


        if($detalleArticulo == null)
             return array('error' => "La clave de producto no existe en base de datos");

       return view('articulos._detalleArticulo', array(
            'departamentos' => $departamentos,
            'laboratorios' => $laboratorios,
            'medidaSAT' => $medidaSAT
        ))->with('articulo', $detalleArticulo[0]);        
    }
    public function index(Request $request)
    {
   
        if ($request->ajax()) {
            $data = Product::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('productAjax',compact('products'));
    }
     
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
        if (articulo::where('sNoArticulo', '=', $request->inClave)->exists())
          return response()->json(['error'=>'La clave ya corresponde a otro articulo.','success'=>'']);
         
          $departamentos = departamento::orderBy('sDescripcion', 'ASC')->where('bEstatus', '=', 1)->get();
          $laboratorios = laboratorio::orderBy('sDescripcion', 'ASC')->where('bEstatus', '=', 1)->get();
          $medidaSAT = medidaSAT::orderBy('sNombre','ASC')->where('bEstatus', '=', 1)->get();

          $pi_sArticulo = $request->inDescripc;
         $pi_sDescripcion = $request->inDescripc;
         $pi_sNoArticulo = $request->inClave;
         $pi_iCodigoBarra = $request->inBarCade;
         $pi_fkIdDpto = $request->lstDepart;
         $pi_fkIdLab = $request->inLab;
         $pi_sSustancia = $request->inSustan;
         $pi_sPresentacion = $request->inPresent;
         $pi_bInventario = (int)$request->inArticuloInventario;
         $pi_bCompra =  (int)$request->inArticuloCompra;
         $pi_bVenta =  (int)$request->inArticuloVenta;
         $pi_articuloActivo = (int)$request->inArticuloActivo;
         $pi_fFechaCadu = $request->inFecCad;
         $pi_SATmedida = $request->inSATCode;
         $pi_codigoProdSAT = $request->inSATProd;
         $pi_stockMin = $request->inStockMin;
         $pi_stockMax = $request->inStockMax;
         $bImpIVA = (int)$request->inArticuloIVA;
         $dPrecioCompra = (double)$request->inPreComp;
         $dPrecioPublico = (double)$request->inPrePub;

            DB::select('call piCreaNvoArticulo(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',array(
            $pi_sArticulo,
            $pi_sDescripcion,
            $pi_sNoArticulo,
            $pi_iCodigoBarra,
            $pi_fkIdDpto,
            $pi_fkIdLab,
            $pi_sSustancia,
            $pi_sPresentacion,
            $pi_bInventario,
            $pi_bCompra,
            $pi_bVenta,
            $pi_articuloActivo,
            $pi_fFechaCadu,
            $pi_SATmedida,
            $pi_codigoProdSAT,
            $pi_stockMin,
            $pi_stockMax,
            $bImpIVA,
            $dPrecioCompra,
            $dPrecioPublico
          ));
          
          return response()->json(['success'=>'Producto agregado exitosamente.']);
        } catch (\Throwable $th) {
              return $th;
        }

        // Product::updateOrCreate(['id' => $request->product_id],
        //         ['name' => $request->name, 'detail' => $request->detail]);        
   
        // return response()->json(['success'=>'Product saved successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
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
        Product::find($id)->delete();
     
        return response()->json(['success'=>'Product deleted successfully.']);
    }
     


}