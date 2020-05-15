<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
   
    public function moduloInventario()
    {
        return view('layouts.inventario');
    }

    public function moduloAdministracion()
    {
        return view('layouts.administracion');
    }

    public function moduloServicios()
    {
        return view('layouts.servicios');
    }

    public function notFound()
    {
        return view('layouts.notFound');
    }

    
}
