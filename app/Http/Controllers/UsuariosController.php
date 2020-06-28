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
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class UsuariosController extends Controller
{

    use RegistersUsers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
       public function __construct()
    {
        $this->middleware('auth');
    }

    public function listar(){
        return view('usuarios.index');
    }

    public function index(Request $request)
    {
        $nombre = $request->get('nombre');
        $usuario = $request->get('usuario');

        $list = User::orderBy('estado')
        ->usuario($usuario)
        ->nombre($nombre)
        ->paginate(999999999);

        return view('usuarios.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {      
        $roles = Role::paginate(6);
        return view('usuarios.create', compact('roles'));
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
            'nombre' => ['required', 'string', 'max:255'],
            'usuario' => ['required', 'string', 'max:255', 'unique:SIPLAC_usuarios'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
            'estado' => 'required',
        ])->validate();//ultima linea es por si algo sale mal retorna la vista anterior con la lista de errores
        //creacion de la entidad
        $data = $request->all();
       $usuario = User::create([
            'nombre' => $data['nombre'],
            'usuario' => $data['usuario'],
            'password' => Hash::make($data['password']),
            'estado' => $data['estado'],
        ]);
//se buscan los roles que se asignaron a el usuario
        $roles = [];
        $contador = 0;
        if($request->get('roles')){
              foreach ($request->get('roles') as $idp) {
                $roles[$contador] = Role::find($idp);
                $contador++;
            }  
        }
        
//se agregan los roles al usuario
        $usuario->syncRoles($roles);
        return redirect()->route('usuarios.index')->with('info','Usuario agregado correctamente'); ;

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
        $user = User::find($id);
        $roles = Role::paginate(6);

        return view('usuarios.edit', compact('user', 'roles'));
    }

    /**
     * Verifica que el los datos cumplan las reglas, si es asi entoces actualiza y si no entoces retrocede y manda un msj.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         $user = User::find($id);
          Validator::make($request->all(), [
               'nombre'=>'required',
               'usuario'=>['required', Rule::unique('siplac_usuarios')->ignore($user->id,'id')],
               'password'=>'',
               'estado'=>'',
          ])->validate();//ultima linea es por si algo sale mal retorna la vista anterior con la lista de errores
          //validar si el campo esta vacio o no
          $data = $request->all();

          if($data['password']!=null){
                $data['password']= bcrypt($data['password']);
            }else{
                unset($data['password']);
            }
         $user->update($data);
         //se buscan los roles que se asignaron a el usuario
        $roles = [];
        $contador = 0;
         if($request->get('roles')){
              foreach ($request->get('roles') as $idp) {
                $roles[$contador] = Role::find($idp);
                $contador++;
            }  
        }
        //se agregan los roles al usuario
        $user->syncRoles($roles);
         return redirect()->route('usuarios.index')->with('info','Usuario actualizado correctamente');


    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userLogin = Auth::user();
        if($userLogin->id!=$id){
            $user = User::find($id);
            $data['estado'] = '';
            $accion = '';

           if($user->estado=='A'){
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
           
           $user->update($data);
           return back()->with('info','Usuario '.$accion.' correctamente');
        }else{
            return back()->with('info','No se puede desactivar usted mismo');
        }
     }

}
