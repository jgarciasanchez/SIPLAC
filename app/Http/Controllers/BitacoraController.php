<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bitacora;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class BitacoraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nombre = $request->get('nombre');
        $accion = $request->get('accion');
        $fecha = $request->get('fecha');
        $bit = Bitacora::orderBy('created_at','DESC')
        ->nombre($nombre)
        ->accion($accion)
        ->fecha($fecha)
        ->paginate(50);
        //LAS ULTIMAS VARIABLES SON PARA RECARGAR EL DATO DE BUSQUEDA EN EL FORMULARIO DE BUSQUEDA
        return view('bitacora.index',compact('bit','nombre','accion','fecha'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

}
