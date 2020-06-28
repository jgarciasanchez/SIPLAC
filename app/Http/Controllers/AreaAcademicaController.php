<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BitacoraController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\Auth;
use App\AreasAcademicas;
class AreaAcademicaController extends Controller
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
        $nombre = $request->get('nombre');
        $list = AreasAcademicas::orderBy('id')
        ->nombre($nombre)
        ->paginate(9999999);
        return view('Area_Academica.index',compact('list'));
    }

    public function listar(){
        return view('areaacademica.index'); //areaacademica
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('Area_Academica.create');
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
            'nombreArea' => ['required', 'string', 'max:50'],
            'descripcion' => ['required', 'string', 'max:1024'],
            'estado' => ['required', 'string', 'max:1'],
        ])->validate();//ultima linea es por si algo sale mal retorna la vista anterior con la lista de errores
        //creacion de la entidad
        $data = $request->all();
         AreasAcademicas::create([
            'nombreArea' => $data['nombreArea'],
            'descripcion' => $data['descripcion'],
            'estado' => $data['estado'],
        ]);
        return redirect()->route('areaacademica.index')->with('info','AreasAcademicas agregado correctamente'); ;
    }


      /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $AreasAcademicas = AreasAcademicas::find($id);
        return view('Area_Academica.edit',compact('AreasAcademicas'));
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


          $AreasAcademicas = AreasAcademicas::find($id);

        //reglas de validacion
        Validator::make($request->all(), [
            'nombreArea' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string', 'max:1024'],
            'estado' => ['required', 'string', 'max:1'],
        ])->validate();//ultima linea es por si algo sale mal retorna la vista anterior con la lista de errores
        $data = $request->all();
         $AreasAcademicas->update($data);
         //metodo crea la bitacora
        
         return redirect()->route('areaacademica.index')->with('info','AreasAcademicas actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $AreasAcademicas = AreasAcademicas::find($id);
        $data['estado'] = '';
        $accion = '';
       if($AreasAcademicas->estado=='A'){
            $data['estado'] = 'I';
            $accion = 'desactivado';
       }else{
            $data['estado'] = 'A';
             $accion = 'activado';
       }
       Validator::make($data, [
               'estado'=>'',
          ])->validate();
       $AreasAcademicas->update($data);
       return back()->with('info','AreasAcademicas '.$accion.' correctamente');
    }
}
