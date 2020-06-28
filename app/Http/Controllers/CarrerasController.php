<?php

namespace App\Http\Controllers;

use App\AreasAcademicas;
use App\Http\Controllers\BitacoraController;
use App\Carreras;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use App\Exceptions\Handler;

class CarrerasController extends Controller
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
        $nombre1 = $request->get('nombre');
        $area1 = $request->get('area');
        $list = Carreras::
            nombre($nombre1)
            ->area($area1)
            ->paginate(9999999);

        foreach ($list as $item){
            $item['nombreArea'] = AreasAcademicas::find($item->are_id)->nombreArea;

        }
        return view('Carrera.inicio', compact('list'));
    }

    public function listar()
    {
        return view('Carrera.inicio');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $nivel =  ["I","II","III","IV","V"];
        $list = AreasAcademicas::orderBy('nombreArea')
            ->nombre(null)
            ->id('')
            ->get();
        return view('Carrera.create', compact('list','nivel'));
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
            'are_id' => ['required', 'string', 'max:255'],
            'fecha_apertura' => ['required', 'string', 'max:255'],
            'fecha_cierre' => [''],
            'niv_id' => ['required', 'string', 'max:255'],
        ])->validate(); //ultima linea es por si algo sale mal retorna la vista anterior con la lista de errores
        
	//creacion de la entidad
        $data = $request->all();
        //verificar campo estado

        if($data['fecha_cierre']!= null){
            if($data['fecha_apertura'] < $data['fecha_cierre']){
                 Carreras::create([
                    'nombre' => $data['nombre'],
                    'are_id' => $data['are_id'],
                    'fecha_apertura' => $data['fecha_apertura'],
                    'fecha_cierre' => $data['fecha_cierre'],
                    'grado' => $data['niv_id'],
                    'estado' => 'A',
                ]);
                
        }else{
                return redirect()->route('carrera.index')->with('info', 'fecha de inicio superior a la de cierre, Carrera no registrada');
            }    
        }else{

             Carreras::create([
                'nombre' => $data['nombre'],
                'are_id' => $data['are_id'],
                'fecha_apertura' => $data['fecha_apertura'],
                'fecha_cierre' => $data['fecha_cierre'],
                'grado' => $data['niv_id'],
                'estado' => 'A',
              ]);
            return redirect()->route('carrera.index')->with('info', 'Carrera agregada correctamente');
        }
      }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   

        $nivel =  ["I","II","III","IV","V"];
        $carrera = Carreras::find($id);
        $nivAct= $carrera->grado;
        $list = AreasAcademicas::orderBy('nombreArea')
            ->nombre(null)
            ->id('')
            ->get();
        return view('Carrera.edit', compact('carrera', 'list','nivel','nivAct'));
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
	$carrera = Carreras::find($id);
        Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'max:255'],
            'are_id' => ['required', 'string', 'max:255'],
            'fecha_apertura' => ['required', 'string', 'max:255'],
            'fecha_cierre' => [''],
            'grado' => ['required', 'string', 'max:255'],
        ])->validate(); //ultima linea es por si algo sale mal retorna la vista anterior con la lista de errores
        $data = $request->all();

        //metodo crea la bitacora
        if($data['fecha_cierre']!= null){
            if($data['fecha_apertura'] < $data['fecha_cierre']){
                $carrera->update($data);
                return redirect()->route('carrera.index')->with('info', 'Carrera actualizada correctamente');
            }else{
                return redirect()->route('carrera.index')->with('info', 'fecha de inicio superior a la de cierre, Carrera no actualizada');
            }
        }else{
            $carrera->update($data);
            return redirect()->route('carrera.index')->with('info', 'Carrera actualizada correctamente');
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
        $carrera = Carreras::find($id);

        $data['estado'] = '';
        $accion = '';
        if ($carrera->estado == 'A') {
            $data['estado'] = 'I';
            $accion = 'Desactivado';
        } else {
            $data['estado'] = 'A';
            $accion = 'Activado';
        }
        Validator::make($data, [
            'estado' => '',
        ])->validate();
        //actualizar bitacora
        
        $carrera->update($data);
        return back()->with('info', 'Carrera ' . $accion . ' correctamente');
    }
}
