<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BitacoraController;
use App\Ciclo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use App\Exceptions\Handler;
use DB;


class CicloController extends Controller
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
        $ciclo = $request->get('ciclo');
        $fecha_inicio = $request->get('fecha_inicio');
        $fecha_fin = $request->get('fecha_fin');

        $list = Ciclo::orderBy('id')
            ->ciclo($ciclo)
            ->fecha_inicio($fecha_inicio,$fecha_fin)
            ->fecha_fin($fecha_fin,$fecha_inicio)
            ->paginate(999999999);
        

        return view('ciclo.index',compact('list'));
    }

    public function listar(){
        return view('Ciclo.index');
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('ciclo.create');
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
    DB::table('siplac_ciclo')
    ->update(['estado' => 'I']);
        Validator::make($request->all(), [
            'ciclo' => ['required', 'int','max:3'],
            'fecha_inicio' => ['required', 'string', 'max:10'],
            'fecha_fin' => ['required', 'string', 'max:10'],
            'estado' => ['required', 'string', 'max:1'],
        ])->validate();//ultima linea es por si algo sale mal retorna la vista anterior con la lista de errores
        //creacion de la entidad
        $data = $request->all();
        if($data['fecha_inicio'] < $data['fecha_fin']){
            Ciclo::create([
                'ciclo' => $data['ciclo'],
                'fecha_inicio' => $data['fecha_inicio'],
                'fecha_fin' => $data['fecha_fin'],
                'estado' => $data['estado'],
            ]);
            return redirect()->route('ciclo.index')->with('info','Ciclo agregado correctamente'); 

        }else{
             return redirect()->route('ciclo.index')->with('info','Ciclo no registrado, fecha de cierre de ciclo inferior a la de inicio'); 
        }    }


      /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ciclo = Ciclo::find($id);
        $ciclos = ['1','2','3',];
        return view('ciclo.edit',compact('ciclo','ciclos'));
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
    DB::table('siplac_ciclo')
    ->update(['estado' => 'I']);
	$ciclo = Ciclo::find($id);
        //reglas de validacion
        Validator::make($request->all(), [
            'ciclo' => ['required'],
            'fecha_inicio' => ['required',],
            'fecha_fin' => ['required',],
            'estado' => ['required',],
        ])->validate();;//ultima linea es por si algo sale mal retorna la vista anterior con la lista de errores
         $data = $request->all();

         //metodo crea la bitacora
         if($data['fecha_inicio'] < $data['fecha_fin']){
            $ciclo->update($data);
            return redirect()->route('ciclo.index')->with('info','Ciclo actualizado correctamente'); 

        }else{
             return redirect()->route('ciclo.index')->with('info','Ciclo no actualizado, fecha de cierre de ciclo inferior a la de inicio'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //metodo crea la bitacora
         $ciclo = Ciclo::find($id);
        $data['estado'] = '';
        $accion = '';
        DB::table('siplac_ciclo')
        ->update(['estado' => 'I']);

       if($ciclo->estado=='A'){
            $data['estado'] = 'I';
            $accion = 'desactivado';
       }else{
            $data['estado'] = 'A';
             $accion = 'activado';
       }
       Validator::make($data, [
               'estado'=>'',
          ])->validate();
       //actualizar bitacora
       
        $ciclo->update($data);
       return back()->with('info','Ciclo '.$accion.' correctamente');
    }
}
