<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aulas;
use Illuminate\Support\Facades\Validator;

class AulasController extends Controller
{
    //
    public function __construct()
  {
      $this->middleware('auth');
  }

  public function listar(){
      return view('aulas.index');
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {

      $nombre = $request->get('numero');
      $capacidad = $request->get('capacidad');

      $list = Aulas::orderBy('numero')

      ->Codigo($nombre)
      ->Capacidad($capacidad)
      ->paginate(9999999);

      return view('aulas.index',compact('list'));
  }

  public function create()
  {
       return view('aulas.create');
  }

  public function store(Request $request)
  {
      //reglas de validacion
 	Validator::make($request->all(), [
            'numero' => ['required', 'string', 'max:4'],
            'capacidad' => ['required', 'int', 'max:99999']
        ])->validate();

      $data = $request->all();
  //verificar campo estado
      if(isset($_POST['estado'])){
          $data['estado'] = 'A';
      }else{
         $data['estado'] = 'I';
      }
       Aulas::create([
          'numero' => $data['numero'],
          'estado' => $data['estado'],
          'capacidad' => $data['capacidad'],
          'cam_id'=>1,
      ]);

      return redirect()->route('aulas.index')->with('info','Aula agregada correctamente'); 
  }

  /**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function edit($id)
{
    $aula = Aulas::find($id);
    return view('aulas.edit',compact('aula'));
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
      $aula= Aulas::find($id);

	//reglas de validacion
 	Validator::make($request->all(), [
            'numero' => ['required', 'string', 'max:4'],
             'estado' => ['required'],
            'capacidad' => ['required', 'int', 'max:99999']
        ])->validate();


      $data = $request->all();
      //Si el campo el check box no esta en true entoces no llega valor por lo que hay q agregarlo
  

     $aula->update($data);
     return redirect()->route('aulas.index')->with('info','Aula actualizada correctamente');
}

/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function destroy($id)
{

    $aula = Aulas::find($id);
    $data['estado'] = '';
    $accion = '';
   if($aula->estado=='A'){
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
   $aula->update($data);
   return back()->with('info','Aula '.$accion.' correctamente');
}

}
