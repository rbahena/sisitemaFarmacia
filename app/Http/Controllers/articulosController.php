<?php

namespace App\Http\Controllers;

use App\Models\articulo;
use App\Models\codigoBarraModel;
use App\Models\departamento;
use App\Models\imagen;
use App\Models\laboratorio;
use App\Models\listaModel;
use App\Models\medidaSAT;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class articulosController extends Controller
{
    public function verInventario()
    {
        $departamentos = departamento::orderBy('sDescripcion', 'ASC')->where('bEstatus', '=', 1)->get();
        $laboratorios = laboratorio::orderBy('sDescripcion', 'ASC')->where('bEstatus', '=', 1)->get();
        $inventario = articulo::orderBy('sArticulo', 'desc')->where('bEstatus', '=', 1)->get();
        return view('articulos.listadoInventario', array(
            'inventario' => $inventario,
            'departamentos' => $departamentos,
            'laboratorios' => $laboratorios,
        ));
    }

    public function detalleArticulo()
    {
        $departamentos = departamento::orderBy('sDescripcion', 'ASC')->where('bEstatus', '=', 1)->get();
        $laboratorios = laboratorio::orderBy('sDescripcion', 'ASC')->where('bEstatus', '=', 1)->whereNotNull('sClave')->get();
        $medidaSAT = medidaSAT::orderBy('sNombre', 'ASC')->where('bEstatus', '=', 1)->get();
        $tipoLista = listaModel::orderBy('sLista', 'ASC')->where('bEstatus', '=', 1)->get();
        return view('articulos._agregarArticulo', array(
            'departamentos' => $departamentos,
            'laboratorios' => $laboratorios,
            'medidaSAT' => $medidaSAT,
            'tipoLista' => $tipoLista,
        ));
    }

    public function obtenerArticulo()
    {
        $clave = $_GET['clave'];
        $estatus = 1;

        $catalogos = $this->getCatalogos(); //obtiene
        $detalleArticulo = DB::select('select * from vGralArticulo where sClaveLab = :clave and bEstatus = :estatus', ['clave' => $clave, 'estatus' => $estatus]);

        if ($detalleArticulo == null || empty($detalleArticulo)) {
            return array('error' => "La clave de producto no existe en base de datos");
        }

        if (!is_null($detalleArticulo[0]->kIdImage)) {
            $catalogos['imagen'] = $this->getImagen($detalleArticulo[0]->kIdImage);
        }

        if (!is_null($detalleArticulo[0])) {
            $catalogos['codigosBarra'] = $this->getCodeBar($detalleArticulo[0]->kId);
        }

        return response()->json(['error' => '',
            'success' => 'Producto encontrado correctamente.',
            'html' => view('articulos._detalleArticulo',
                array('catalogos' => $catalogos))->with('articulo', $detalleArticulo[0])->render()]);
    }

    public function obtenerArticuloCtrl()
    {
        $id = $_GET['id'];
        $control = $_GET['control'];
        $idRegistro;

        $catalogos = $this->getCatalogos();
        try {
            switch ($control) {
                case 'primero':
                    $detalleArticulo = DB::select('select * from vGralArticulo order by kId desc limit 1');
                    if (!is_null($detalleArticulo[0]->kIdImage) || $detalleArticulo[0]->kIdImage != '') {
                        $catalogos['imagen'] = $this->getImagen($detalleArticulo[0]->kIdImage);
                    }

                    $catalogos['codigosBarra'] = $this->getCodeBar($detalleArticulo[0]->kId);
                    break;
                case 'siguiente':
                    $idRegistro = $id + 1;
                    $detalleArticulo = DB::select('select * from vGralArticulo where kId = :id', ['id' => $idRegistro]);
                    if (!is_null($detalleArticulo[0]->kIdImage) || $detalleArticulo[0]->kIdImage != '') {
                        $catalogos['imagen'] = $this->getImagen($detalleArticulo[0]->kIdImage);
                    }

                    $catalogos['codigosBarra'] = $this->getCodeBar($detalleArticulo[0]->kId);
                    break;
                case 'anterior':
                    $idRegistro = $id - 1;
                    $detalleArticulo = DB::select('select * from vGralArticulo where kId = :id', ['id' => $idRegistro]);
                    if (!is_null($detalleArticulo[0]->kIdImage) || $detalleArticulo[0]->kIdImage != '') {
                        $catalogos['imagen'] = $this->getImagen($detalleArticulo[0]->kIdImage);
                    }

                    $catalogos['codigosBarra'] = $this->getCodeBar($detalleArticulo[0]->kId);
                    break;
                case 'ultimo':
                    $detalleArticulo = DB::select('select * from vGralArticulo order by kId asc limit 1');
                    if (!is_null($detalleArticulo[0]->kIdImage) || $detalleArticulo[0]->kIdImage != '') {
                        $catalogos['imagen'] = $this->getImagen($detalleArticulo[0]->kIdImage);
                    }

                    $catalogos['codigosBarra'] = $this->getCodeBar($detalleArticulo[0]->kId);
                    break;
            }
        } catch (Throwable $e) {
            return response()->json(['error' => 'No existe registro con el id indicado', 'success' => '', 'html' => '']);
        }
        return response()->json(['error' => '', 'success' => 'success', 'html' =>
            view('articulos._detalleArticulo', array(
                'catalogos' => $catalogos,
            ))->with('articulo', $detalleArticulo[0])->render()]);
    }

    public function index(Request $request)
    {
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
            if (!empty($request->inputIdArticulo)) {
                $response = $this->edit($request);
                return $response;
            } else {
                if (articulo::where('sArticulo', '=', $request->inputNombreFarmaco)->exists() && empty($request->inputIdArticulo)) {
                    return response()->json(['error' => 'Ya existe un articulo con el mismo nombre.', 'success' => '']);
                }

                $catalogos = $this->getCatalogos();

                $parameters = $this->getParameters($request);
                $response = DB::select('call piCreaNvoArticulo(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array(
                    $parameters[0]['pi_sArticulo'],
                    $parameters[0]['pi_sDescripcion'],
                    $parameters[0]['pi_sNoArticulo'],
                    $parameters[0]['pi_fkIdDpto'],
                    $parameters[0]['pi_fkIdLab'],
                    $parameters[0]['pi_sSustancia'],
                    $parameters[0]['pi_sPresentacion'],
                    $parameters[0]['pi_bInventario'],
                    $parameters[0]['pi_bCompra'],
                    $parameters[0]['pi_bVenta'],
                    $parameters[0]['pi_bEstatus'],
                    $parameters[0]['pi_fFechaCadu'],
                    $parameters[0]['pi_SATmedida'],
                    $parameters[0]['pi_codigoProdSAT'],
                    $parameters[0]['pi_stockMin'],
                    $parameters[0]['pi_stockMax'],
                    $parameters[0]['bImpIVA'],
                    $parameters[0]['dPrecioCompra'],
                    $parameters[0]['pi_dPrecioVenta'],
                    $parameters[0]['pi_dPrecioLunes'],
                    $parameters[0]['pi_dPrecioMayorista'],
                    $parameters[0]['pi_dPrecioNormal'],
                    $parameters[0]['pi_fkIdLista'],
                    $parameters[0]['pi_iColectivo'],
                ));

                if (!empty($request->inputImgBase64)) {
                    $imagen = new imagen();
                    $imagen->bImage = $request->inputImgBase64;
                    $imagen->fkIdArticulo = (int) $response[0]->kIdArticulo;
                    $imagen->save();
                }

                $articulo = DB::select('select * from vGralArticulo where kId = :id', ['id' => (int) $response[0]->kIdArticulo]);
                $IdArticulo = (int) $articulo[0]->kId;
                $numeroCodigos = $request->inputNumeroCodigos;
                $codigos = $request->inputCodigosBarras;

                $catalogos['codigosBarra'] = DB::select('call piInsertaCodigo(?,?,?)', array($IdArticulo, $codigos, $numeroCodigos));
                $catalogos['imagen'] = $this->getImagen($articulo[0]->kIdImage);

                return response()->json(['error' => '', 'success' => 'Producto agregado exitosamente.', 'html' =>
                    view('articulos._detalleArticulo', array(
                        'catalogos' => $catalogos,
                    ))->with('articulo', $articulo[0])->render(),
                ]);
            }
        } catch (\Throwable $th) {
            return "error al vcargar el formulario." . $th;
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
        $catalogos = $this->getCatalogos();

        DB::select('call paNvoArticulo(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array(
            $parameters[0]['pi_kId'],
            $parameters[0]['pi_sArticulo'],
            $parameters[0]['pi_sDescripcion'],
            $parameters[0]['pi_sNoArticulo'],
            '',
            $parameters[0]['pi_fkIdDpto'],
            $parameters[0]['pi_fkIdLab'],
            $parameters[0]['pi_sSustancia'],
            $parameters[0]['pi_sPresentacion'],
            $parameters[0]['pi_bInventario'],
            $parameters[0]['pi_bCompra'],
            $parameters[0]['pi_bVenta'],
            $parameters[0]['pi_bEstatus'],
            $parameters[0]['pi_fFechaCadu'],
            $parameters[0]['pi_SATmedida'],
            $parameters[0]['pi_codigoProdSAT'],
            $parameters[0]['pi_stockMin'],
            $parameters[0]['pi_stockMax'],
            $parameters[0]['bImpIVA'],
            $parameters[0]['dPrecioCompra'],
            $parameters[0]['pi_dPrecioVenta'],
            $parameters[0]['pi_dPrecioLunes'],
            $parameters[0]['pi_dPrecioMayorista'],
            $parameters[0]['pi_dPrecioNormal'],
            $parameters[0]['pi_fkIdLista'],
            $parameters[0]['pi_iColectivo'])
        );
        $articulo = DB::select('select * from vGralArticulo where kId = :id', ['id' => (int) $request->inputIdArticulo]);

        if (!empty($request->inputImgBase64)) {
            if (imagen::where('fkIdArticulo', '=', (int) $articulo[0]->kId)->where('bEstatus', '=', 1)->exists()) {
                imagen::where('fkIdArticulo', '=', (int) $articulo[0]->kId)->update(array('bImage' => $request->inputImgBase64));
            } else {
                $insertImagen = new imagen();
                $insertImagen->bImage = $request->inputImgBase64;
                $insertImagen->fkIdArticulo = (int) $articulo[0]->kId;
                $insertImagen->save();
            }
        }
        $articulo = DB::select('select * from vGralArticulo where kId = :id', ['id' => (int) $request->inputIdArticulo]);
        $IdArticulo = (int) $articulo[0]->kId;
        $numeroCodigos = $request->inputNumeroCodigos;
        $codigos = $request->inputCodigosBarras;

        $catalogos['codigosBarra'] = DB::select('call piInsertaCodigo(?,?,?)', array($IdArticulo, $codigos, $numeroCodigos));
        $catalogos['imagen'] = $this->getImagen($articulo[0]->kIdImage);

        return response()->json(['error' => '', 'success' => 'Actualizado correctamente', 'html' =>
            view('articulos._detalleArticulo', array(
                'catalogos' => $catalogos,
            ))->with('articulo', $articulo[0])->render(),
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
    }

    public function getParameters(Request $request)
    {
        $parametersData = array([
            'pi_kId' => !empty($request->inputIdArticulo) ? $request->inputIdArticulo : '',
            'pi_sArticulo' => !empty($request->inputNombreFarmaco) ? $request->inputNombreFarmaco : '',
            'pi_sDescripcion' => !empty($request->inputDescripcion) ? $request->inputDescripcion : '',
            'pi_sNoArticulo' => '',
            'pi_fkIdDpto' => !empty($request->selectDepartamento) ? $request->selectDepartamento : 0,
            'pi_fkIdLab' => !empty($request->selectLaboratorio) ? $request->selectLaboratorio : 1,
            'pi_sSustancia' => !empty($request->inputSustancia) ? $request->inputSustancia : '',
            'pi_sPresentacion' => !empty($request->inputPresentacion) ? $request->inputPresentacion : '',
            'pi_bInventario' => !empty($request->checkEsInventario) ? (int) $request->checkEsInventario : '',
            'pi_bCompra' => !empty($request->checkEsCompra) ? (int) $request->checkEsCompra : '',
            'pi_bVenta' => !empty($request->checkEsVenta) ? (int) $request->checkEsVenta : '',
            'pi_bEstatus' => !empty($request->checkEsActivo) ? (int) $request->checkEsActivo : '',
            'pi_fFechaCadu' => Carbon::now(),
            'pi_SATmedida' => !empty($request->selectUnidadesSat) ? $request->selectUnidadesSat : 1,
            'pi_codigoProdSAT' => !empty($request->inputCodigoSat) ? $request->inputCodigoSat : '',
            'pi_stockMin' => !empty($request->inputStockMinimo) ? $request->inputStockMinimo : 0,
            'pi_stockMax' => !empty($request->inputStockMaximo) ? $request->inputStockMaximo : 0,
            'bImpIVA' => !empty($request->checkEsIVA) ? (int) $request->checkEsIVA : '',
            'dPrecioCompra' => 0.00,
            'pi_dPrecioVenta' => !empty($request->inputPrecioPublico) ? (double) $request->inputPrecioPublico : 0.00,
            'pi_dPrecioLunes' => !empty($request->inputPrecioLunes) ? (double) $request->inputPrecioLunes : 0.00,
            'pi_dPrecioMayorista' => !empty($request->inputPrecioMayoreo) ? (double) $request->inputPrecioMayoreo : 0.00,
            'pi_dPrecioNormal' => !empty($request->inputPrecioNormal) ? (double) $request->inputPrecioNormal : 0.00,
            'pi_fkIdLista' => !empty($request->selectTipoLista) ? $request->selectTipoLista : 1,
            'pi_iColectivo' => !empty($request->inputColectivo) ? (int) $request->inputColectivo : 0,
        ]);
        return $parametersData;
    }

    public function getCodeBars(Request $request)
    {
        $categories = array();
        foreach ($request as $parametro) {
            if ($parametro == "inBarCade_1") {
                return "hpls";
                array_push($categories, $parametro);
            }
        }
        return $categories;
    }

    public function getCatalogos()
    {
        $departamentos = departamento::orderBy('sDescripcion', 'ASC')->where('bEstatus', '=', 1)->get();
        $laboratorios = laboratorio::orderBy('sDescripcion', 'ASC')->where('bEstatus', '=', 1)->get();
        $medidaSAT = medidaSAT::orderBy('sNombre', 'ASC')->where('bEstatus', '=', 1)->get();
        $tipoLista = listaModel::orderBy('sLista', 'ASC')->where('bEstatus', '=', 1)->get();
        $imagen = '';
        $codigos = '';
        return array(
            'departamentos' => $departamentos,
            'laboratorios' => $laboratorios,
            'medidaSAT' => $medidaSAT,
            'tipoLista' => $tipoLista,
            'imagen' => $imagen,
            'codigosBarra' => $codigos,
        );
    }

    public function getImagen($idImagen)
    {
        return imagen::where('kId', '=', $idImagen)->where('bEstatus', '=', 1)->get();
    }

    public function getCodeBar($idArticulo)
    {
        return codigoBarraModel::where('fkIdArticulo', '=', $idArticulo)->where('bEstatus', '=', 1)->get();
    }
}