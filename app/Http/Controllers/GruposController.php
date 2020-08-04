<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BitacoraController;
use App\AreasAcademicas;
use App\Grupos;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use App\Exceptions\Handler;
class GruposController extends Controller
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

        $nivel = $request->get('niveles');
        $numero = $request->get('numero');
        $niveles =  ["I","II","III","IV","V"];

        $list = Grupos::filtro($numero,$nivel) 
            ->paginate(9999999);

        return view('grupos.index',compact('list','niveles'));
    }

    public function listar(){
        return view('Cursos.index');
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $niveles =  ["I","II","III","IV","V"];
        return view('grupos.create',compact('niveles'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'numero' =>  ['required', 'int', 'max:9999'],
            'niveles' => ['required', 'string', 'max:255'],
        ])->validate();


        $data = $request->all();

        if(isset($_POST['estado'])){
            $data['estado'] = 'A';
        }else{
           $data['estado'] = 'I';
        }
        Grupos::create([
            'numero' => $data['numero'],
            'nivel' => $data['niveles'],
            'estado' => $data['estado'],
        ]);

        return redirect()->route('grupos.index')->with('info','Grupo agregado correctamente'); ;
    }

      /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grupos = Grupos::find($id);
        $GrupoGurso= GruposCursos
        $nivel =  ["I","II","III","IV","V"];
        $cicloAc = Grupos::find($grupos->ciclo_id);
        $cursoAc = Cursos::find($cursos->curso_id);
        dd($cursoAc);
        return view('grupos.edit',compact('grupos','nivel','cicloAc','cursoAc'));    
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
          $grupos = Grupos::find($id);
          Validator::make($request->all(), [
            'numero' => ['required', Rule::unique('siplac_grupos')->ignore($grupos->id,'id')],
            'nivel' => ['required'],
          ])->validate();//ultima linea es por si algo sale mal retorna la vista anterior con la lista de errores

          $data = $request->all();
          //Si el campo el check box no esta en true entoces no llega valor por lo que hay q agregarlo
          if(isset($_POST['estado'])){
                $data['estado']= 'A';
            }else{
                 $data['estado']='I';
          }
          
         $grupos->update($data);
         return redirect()->route('grupos.index')->with('info','Grupo actualizado correctamente');


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
        $grupo = Grupos::find($id);
        $data['estado'] = '';
        $accion = '';
       if($grupo->estado=='A'){
            $data['estado'] = 'I';
            $accion = 'Desactivado';
       }else{
            $data['estado'] = 'A';
             $accion = 'Activado';
       }
       Validator::make($data, [
               'estado'=>'',
          ])->validate();

       $grupo->update($data);
       return back()->with('info','Grupo '.$accion.' correctamente');
    }
}

