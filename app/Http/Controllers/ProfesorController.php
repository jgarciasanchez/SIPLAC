<?php

namespace App\Http\Controllers;

use App\Profesores;
use App\AreasAcademicas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use App\Exceptions\Handler;



class ProfesorController extends Controller
{

    /**
     * Agregado del middleware para asegurar que solo los usuarios autenticados pueden acceder
     * a estas rutas
     */
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
        $nombre1 = $request->get('nombre1');
        $apellido1 = $request->get('apellido1');
        $cedula = $request->get('cedula');

        $list = Profesores::orderBy('estado')
        ->nombre($nombre1)
        ->apellidos($apellido1)
        ->cedula($cedula)
        ->paginate(99999999);

        return view('Profesores.index',compact('list'));
    }

    public function listar(){
        return view('Profesores.index');
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas_academicas = AreasAcademicas::get();
        
        //tipos de categorias de los profesores
         $categorias = ['Categoria 1', 'Categoria 2','Categoria 3', 'Categoria 4'];
        return view('Profesores.create',compact('areas_academicas','categorias'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //reglas de validacion
        Validator::make($request->all(), [
            'nombre1' => ['required', 'string', 'max:20'],
            'nombre2' => '',
            'cedula' => ['required', 'string', 'max:20','unique:siplac_profesores'],
            'apellido1' => ['required', 'string', 'max:30'],
            'apellido2' => ['required', 'string', 'max:30'],
            'fnacimiento' => ['required', 'string', 'max:255'],
            'fsalida' => '',
            'fingreso' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'string', 'max:255'],
            'categoria' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:50'],
            'telefono' => ['required', 'int', 'max:1000000000'],
            'area_academica_id'=>['required'],
        ])->validate();//ultima linea es por si algo sale mal retorna la vista anterior con la lista de errores
        //creacion de la entidad
        $data = $request->all();
    //verificar campo estado
        if(isset($_POST['estado'])){
            $data['estado'] = 'A';
        }else{
           $data['estado'] = 'I';
        }

         Profesores::create([
            'nombre1' => $data['nombre1'],
            'nombre2' => $data['nombre2'],
            'cedula' => $data['cedula'],
            'apellido1' => $data['apellido1'],
            'apellido2' => $data['apellido2'],
            'fnacimiento' => $data['fnacimiento'],
            'fsalida' => $data['fsalida'],
            'fingreso' => $data['fingreso'],
            'estado' => $data['estado'],
            'categoria' => $data['categoria'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
            'area_academica_id' => $data['area_academica_id']
        ]);
        return redirect()->route('profesores.index')->with('info','Profesor agregado correctamente'); 
    }


      /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $areas_academicas = AreasAcademicas::get();
        $profesor = Profesores::find($id);
       //tipos de categorias de los profesores
        $categorias = ['Categoria 1', 'Categoria 2','Categoria 3', 'Categoria 4'];
        return view('Profesores.edit',compact('profesor','areas_academicas','categorias'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

          $profesor = Profesores::find($id);
          Validator::make($request->all(), [
            'nombre1' => ['required'],
            'nombre2' => [''],
            'cedula' => ['required', Rule::unique('siplac_profesores')->ignore($profesor->id,'id')],
            'apellido1' => ['required'],
            'apellido2' => ['required'],
            'fnacimiento' => ['required'],
            'fsalida' => '',
            'fingreso' => ['required'],
            'estado' => ['required'],
            'categoria' => ['required'],
            'email' => ['required'],
            'telefono' => ['required', 'int', 'max:1000000000'],
            'area_academica_id'=>['required'],
          ])->validate();//ultima linea es por si algo sale mal retorna la vista anterior con la lista de errores
          $data = $request->all();
          $profesor->update($data);
         return redirect()->route('Profesores.index')->with('info','Profesor actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profesor = Profesores::find($id);
        $data['estado'] = '';
        $accion = '';
       if($profesor->estado=='A'){
            $data['estado'] = 'I';
            $accion = 'Desactivado';
       }else{
            $data['estado'] = 'A';
             $accion = 'Activado';
       }
       Validator::make($data, [
               'estado'=>'',
          ])->validate();
       //actualizar bitacora
       
       $profesor->update($data);
       return back()->with('info','Profesor '.$accion.' correctamente');
    }
}
