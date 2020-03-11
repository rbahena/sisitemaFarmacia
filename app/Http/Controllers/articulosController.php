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

        // $detalleArticulo = DB::select('call pcObtieneDatosArticulo(?,?)',array($clave,$estatus));
        $detalleArticulo = DB::select('select * from vgralarticulo where sNoArticulo = :clave and bEstatus = :estatus', ['clave' => $clave, 'estatus' => $estatus]);

        if($detalleArticulo == null || empty($detalleArticulo))
             return array('error' => "La clave de producto no existe en base de datos");

       return view('articulos._detalleArticulo', array(
            'departamentos' => $departamentos,
            'laboratorios' => $laboratorios,
            'medidaSAT' => $medidaSAT
        ))->with('articulo', $detalleArticulo[0]);        
    }

    public function obtenerArticuloCtrl(){
        
        $id = $_GET['id'];
        $control = $_GET['control'];
       
        $departamentos = departamento::orderBy('sDescripcion', 'ASC')->where('bEstatus', '=', 1)->get();
        $laboratorios = laboratorio::orderBy('sDescripcion', 'ASC')->where('bEstatus', '=', 1)->get();
        $medidaSAT = medidaSAT::orderBy('sNombre','ASC')->where('bEstatus', '=', 1)->get();

        if($control == 'primero' && $id <= 0)
        {
        $detalleArticulo = DB::select('select * from vgralarticulo order by kId desc limit 1');
        }
        if($control == 'primero' && $id > 0){
            $detalleArticulo = DB::select('select * from vgralarticulo order by kId desc limit 1');
        }
        else if($control == 'ultimo' && $id <= 0 ){
        $detalleArticulo = DB::select('select * from vgralarticulo order by kId asc limit 1');
        } else if($control == 'ultimo' && $id > 0 ){
            $detalleArticulo = DB::select('select * from vgralarticulo order by kId asc limit 1');
        }

        else if($control == 'anterior' && $id > 0){
            $idNew = $id - 1;
            if($idNew == 0)
            {
                $detalleArticulo = DB::select('select * from vgralarticulo order by kId asc limit 1');
            }
             $detalleArticulo = DB::select('select * from vgralarticulo where kId = :id', ['id' =>$idNew]);
        }
        else if($control == 'anterior' && $id <= 0){
            $detalleArticulo = DB::select('select * from vgralarticulo order by kId desc limit 1');
        }
        else if($control == 'siguiente' && $id > 0){
            $idNew = $id + 1;
            $detalleArticulo = DB::select('select * from vgralarticulo where kId = :id', ['id' => $idNew]);
        }
        else if($control == 'siguiente' && $id <= 0){
            $detalleArticulo = DB::select('select * from vgralarticulo order by kId asc limit 1');
        }
        else if($detalleArticulo == null){
             return array('error' => "La clave de producto no existe en base de datos");
        }

       return view('articulos._detalleArticulo', array(
            'departamentos' => $departamentos,
            'laboratorios' => $laboratorios,
            'medidaSAT' => $medidaSAT
        ))->with('articulo', $detalleArticulo[0]);        
    }

    public function index(Request $request)
    {
   
        // if ($request->ajax()) {
        //     $data = Product::latest()->get();
        //     return Datatables::of($data)
        //             ->addIndexColumn()
        //             ->addColumn('action', function($row){
   
        //                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
   
        //                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
    
        //                     return $btn;
        //             })
        //             ->rawColumns(['action'])
        //             ->make(true);
        // }
      
        // return view('productAjax',compact('products'));
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
        if (articulo::where('sNoArticulo', '=', $request->inClave)->exists() && !empty($request->inkIdArticulo))
        {
            $response = $this->edit($request);
            return $response;
        }
        else{
        if (articulo::where('sNoArticulo', '=', $request->inClave)->exists() && empty($request->inkIdArticulo))
            return response()->json(['error'=>'La clave ya corresponde a otro articulo.','success'=>'']);

            $departamentos = departamento::orderBy('sDescripcion', 'ASC')->where('bEstatus', '=', 1)->get();
            $laboratorios = laboratorio::orderBy('sDescripcion', 'ASC')->where('bEstatus', '=', 1)->get();
            $medidaSAT = medidaSAT::orderBy('sNombre','ASC')->where('bEstatus', '=', 1)->get();  
            $parameters = $this->getParameters($request);
           $response =  DB::select('call piCreaNvoArticulo(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',array(
           $parameters[0]['pi_sArticulo'],
           $parameters[0]['pi_sDescripcion'],
           $parameters[0]['pi_sNoArticulo'],
           $parameters[0]['pi_iCodigoBarra'],
           $parameters[0]['pi_fkIdDpto'],
           $parameters[0]['pi_fkIdLab'],
           $parameters[0]['pi_sSustancia'],
           $parameters[0]['pi_sPresentacion'],
           $parameters[0]['pi_bInventario'],
           $parameters[0]['pi_bCompra'],
           $parameters[0]['pi_bVenta'],
           $parameters[0]['pi_articuloActivo'],
           $parameters[0]['pi_fFechaCadu'],
           $parameters[0]['pi_SATmedida'],
           $parameters[0]['pi_codigoProdSAT'],
           $parameters[0]['pi_stockMin'],
           $parameters[0]['pi_stockMax'],
           $parameters[0]['bImpIVA'],
           $parameters[0]['dPrecioCompra'],
           $parameters[0]['dPrecioPublico']));

          $articulo = DB::select('select * from vgralarticulo where kId = :id', ['id' => (int)$response[0]->kIdArticulo]);

            return response()->json(['error'=>'','success'=>'Producto agregado exitosamente.','html' =>
          view('articulos._detalleArticulo',array(
            'departamentos' => $departamentos,
            'laboratorios' => $laboratorios,
            'medidaSAT' => $medidaSAT
        ))->with('articulo', $articulo[0])->render()
          ]);
        }
        } catch (\Throwable $th) {
              return "error al vcargar el formulario.".$th;
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $parameters = $this->getParameters($request);
        $departamentos = departamento::orderBy('sDescripcion', 'ASC')->where('bEstatus', '=', 1)->get();
        $laboratorios = laboratorio::orderBy('sDescripcion', 'ASC')->where('bEstatus', '=', 1)->get();
        $medidaSAT = medidaSAT::orderBy('sNombre','ASC')->where('bEstatus', '=', 1)->get();  
        
            DB::select('call paNvoArticulo(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',array(
            $parameters[0]['pi_kId'],
            $parameters[0]['pi_sArticulo'],
            $parameters[0]['pi_sDescripcion'],
            $parameters[0]['pi_sNoArticulo'],
            $parameters[0]['pi_iCodigoBarra'],
            $parameters[0]['pi_fkIdDpto'],
            $parameters[0]['pi_fkIdLab'],
            $parameters[0]['pi_sSustancia'],
            $parameters[0]['pi_sPresentacion'],
            $parameters[0]['pi_bInventario'],
            $parameters[0]['pi_bCompra'],
            $parameters[0]['pi_bVenta'],
            $parameters[0]['pi_articuloActivo'],
            $parameters[0]['pi_fFechaCadu'],
            $parameters[0]['pi_SATmedida'],
            $parameters[0]['pi_codigoProdSAT'],
            $parameters[0]['pi_stockMin'],
            $parameters[0]['pi_stockMax'],
            $parameters[0]['bImpIVA'],
            $parameters[0]['dPrecioCompra'],
            $parameters[0]['dPrecioPublico']));
           $articulo = DB::select('select * from vgralarticulo where kId = :id', ['id' => (int)$request->inkIdArticulo]);
             return response()->json(['error'=>'','success'=>'Se actualizo correctamente.','html' =>
           view('articulos._detalleArticulo',array(
             'departamentos' => $departamentos,
             'laboratorios' => $laboratorios,
             'medidaSAT' => $medidaSAT
         ))->with('articulo', $articulo[0])->render()
           ]);

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
     
    public function getParameters(Request $request){      
        $parametersData = array([
            'pi_kId' => !empty($request->inkIdArticulo) ? $request->inkIdArticulo : '',
            'pi_sArticulo' =>  !empty($request->inDescripc) ?  $request->inDescripc :'',
            'pi_sDescripcion' => !empty($request->inDescripc) ? $request->inDescripc:'',
            'pi_sNoArticulo' => !empty($request->inClave) ? $request->inClave:'',
            'pi_iCodigoBarra' => !empty($request->inBarCade) ? $request->inBarCade:'',
            'pi_fkIdDpto' => !empty($request->lstDepart) ? $request->lstDepart: 0,
            'pi_fkIdLab' => !empty($request->inLab) ? $request->inLab : 0,
            'pi_sSustancia' => !empty($request->inSustan) ? $request->inSustan:'',
            'pi_sPresentacion' => !empty($request->inPresent) ? $request->inPresent:'',
            'pi_bInventario' => !empty($request->inArticuloInventario) ? (int)$request->inArticuloInventario:'',
            'pi_bCompra' =>  !empty($request->inArticuloCompra) ? (int)$request->inArticuloCompra:'',
            'pi_bVenta' =>  !empty($request->inArticuloVenta) ? (int)$request->inArticuloVenta:'', 
            'pi_articuloActivo' => !empty($request->inArticuloActivo) ? (int)$request->inArticuloActivo:'',
            'pi_fFechaCadu' => !empty($request->inFecCad) ? $request->inFecCad:Carbon::now(),
            'pi_SATmedida' => !empty($request->inSATCode) ? $request->inSATCode:'',
            'pi_codigoProdSAT' => !empty($request->inSATProd) ? $request->inSATProd:'',
            'pi_stockMin' => !empty($request->inStockMin) ? (int)$request->inStockMin:0,
            'pi_stockMax' => !empty($request->inStockMax) ? (int)$request->inStockMax:0,
            'bImpIVA' => !empty($request->inArticuloIVA) ? (int)$request->inArticuloIVA:0,
            'dPrecioCompra' => !empty($request->inPreComp)? (double)$request->inPreComp :0.00,
            'dPrecioPublico' => !empty($request->inPrePub) ? (double)$request->inPrePub:0.00,
            ]);
        return $parametersData;
    }

}