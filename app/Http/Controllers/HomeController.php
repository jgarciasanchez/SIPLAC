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
        return view('inicio');
    }
     public function ayuda()
    {
        return view('ayuda.index');
    }
     public function inicio()
    {
        return view('inicio');
    }
    public function usuario()
    {
        return view('ayuda.hojas.usuario');
    }
      public function profesor()
    {
        return view('ayuda.hojas.profesor');
    }  public function aula()
    {
        return view('ayuda.hojas.aula');
    }  public function curso()
    {
        return view('ayuda.hojas.curso');
    }  public function proyecto()
    {
        return view('ayuda.hojas.proyecto');
    }  public function ciclo()
    {
        return view('ayuda.hojas.ciclo');
    }  public function carrera()
    {
        return view('ayuda.hojas.carrera');
    }  public function cursosCarrera()
    {
        return view('ayuda.hojas.cursosCarrera');
    }  public function grupo()
    {
        return view('ayuda.hojas.grupo');
    }  public function horario()
    {
        return view('ayuda.hojas.horario');
    }  public function reporte()
    {
        return view('ayuda.hojas.reporte');
    }  public function backups()
    {
        return view('ayuda.hojas.backups');
    }  public function bitacora()
    {
        return view('ayuda.hojas.bitacora');
    }
}

