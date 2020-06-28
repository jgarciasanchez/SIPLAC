<?php

namespace App\Http\Controllers;

use App\Profesores;
use App\profesoresProyectos;
use App\Proyectos;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProyectosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $nombre = $request->get('nombre');
        $list = Proyectos::orderBy('id')
            ->Nombre($nombre)
            ->paginate(99999999);

        return view('proyectos.index', compact('list'));
    }

    public function create()
    {
        return view('proyectos.create');
    }

    public function update(Request $request, $id)
    {
        // dd("hola");
        $proyecto = Proyectos::find($id);
        // dd($proyecto);
        //reglas de validacion
        Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'max:100'],
            'codigo_sia' => ['required', 'string', 'max:8'],
            'descripcion' => ['required', 'string', 'max:500'],
            'fecha_inicio' => ['required', 'string', 'max:50'],
            'fecha_final' => ['required', 'string', 'max:50'],
        ])->validate();//ultima linea es por si algo sale mal retorna la vista anterior con la lista de errores
         $data = $request->all();
         
        // dd($data);
         //metodo crea la bitacora
         if($data['fecha_inicio'] < $data['fecha_final']){
            $proyecto->update($data);
            return redirect()->route('proyectos.index')->with('info','Proyecto actualizado correctamente'); 
            
        }else{
             return redirect()->route('proyectos.index')->with('info','Proyecto no actualizado, fecha de cierre de proyecto inferior a la de inicio'); 
        }  

    }

    public function store(Request $request)
    {

        $data = $request->all();

        Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'max:100'],
            'codigo_sia' => ['required', 'string', 'max:8'],
            'descripcion' => ['required', 'string', 'max:500'],
            'fecha' => '',
            'fecha_inicio' => ['required', 'string', 'max:50'],
            'fecha_final' => ['required', 'string', 'max:50'],
        ])->validate(); //ultima linea es por si algo sale mal retorna la vista anterior con la lista de errores
        //creacion de la entidad

        //verificar campo estado
      
        if($data['fecha_inicio'] < $data['fecha_final']){
            Proyectos::create([
                'nombre' => $data['nombre'],
                'codigo_sia' => $data['codigo_sia'],
                'descripcion' => $data['descripcion'],
                'fecha' => '',
                'fecha_inicio' => $data['fecha_inicio'],
                'fecha_final' => $data['fecha_final'],
            ]);
            return redirect()->route('proyectos.index')->with('info', 'Proyecto agregado correctamente');;
            
        }else{
             return redirect()->route('proyectos.index')->with('info','Proyecto no registrado, fecha final posterior a la inicial'); 
        }  
    }
    public function destroy($id)
    {
        
        $proyectos = Proyectos::find($id);
        $data['estado'] = '';
        $accion = '';
       if($proyectos->estado=='A'){
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
       
       $proyectos->update($data);
       return back()->with('info','Profesor '.$accion.' correctamente');

     }

    public function edit($id)
    {
        $proyecto = Proyectos::find($id);

        $profesores = Profesores::joinProyectos()->paginate(999999);
        $aux = new Collection();
        foreach ($profesores as $t) {
            if ($t->proy_id == null || $t->proy_id == $id) {
                $aux->push($t);
            }
        }
        $band = false;
        foreach ($profesores as $t) {
            foreach ($aux as $a) {
                if ($t->id == $a->id) {
                    $band = true;
                }
            }
            if ($band == false) {
                $aux->push($t);
            } else {
                $band = false;
            }
        }
        return view('proyectos.edit', compact('proyecto', 'profesores'));
    }

    public function profesoresData(Request $request)
    {
        
        return DataTables::of($aux)
            ->addColumn('acciones', function ($a) use ($id) {
                if ($a->proy_id == $id) {
                    return '<a class="btn btn-primary btn-sm" href="'.route('estadoProfesor', [$id, $a->id]).'">Eliminar</a>';
                } else {
                    return '<a class="btn btn-secondary btn-sm" href="'.route('estadoProfesor', [$id, $a->id]).'">Agregar</a>';
                };
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function estadoProfesor($idProyecto, $idProfesor)
    {
        $relacion = profesoresProyectos::buscar($idProfesor, $idProyecto)->first();
        $accion = '';
        if ($relacion == null) {
            profesoresProyectos::insertar($idProfesor, $idProyecto);
            $accion = 'agregado';
        } else {
            profesoresProyectos::eliminar($idProfesor, $idProyecto);
            $accion = 'eliminado';
        }
        return back()->with('info', 'Profesor ' . $accion . ' correctamente');
    }
    public function search(Request $request)
    {
        $output = '';
        if ($request->ajax()) {
            $nombre = $request->search;
            $list = Proyectos::orderBy('id')
                ->Nombre($nombre)
                ->paginate(0);
            foreach ($list as $item) {
                $output .= '<tr>' .
                    '<td>' . $item->nombre . '</td>' .
                    '<td>' . $item->descripcion . '</td>' .
                    '<td>' . $item->fecha_inicio . '</td>' .
                    '<td>' . $item->fecha_final . '</td>' .
                    '</tr>';
            }
            // return Response($output);             
        }
        return Response($output);
    }
}
