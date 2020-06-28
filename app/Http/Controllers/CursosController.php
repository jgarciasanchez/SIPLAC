<?php

namespace App\Http\Controllers;

use App\AreasAcademicas;
use App\Carreras;
use App\Cursos;
use App\cursosCarrera;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use App\GrupoCurso;
use App\Grupos;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;

class CursosController extends Controller
{
    /**
     * Agregado del middleware para asegurar que solo los usuarios autenticados pueden acceder
     * a estas rutas
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    private $curso;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $nombre_cur = $request->get('nombre_cur');
        $codigo = $request->get('codigo');

        $nombre1 = $request->get('nombre_cur'); /*  AREA DATOS*/
        $area1 = $request->get('area');
        $nrc = $request->get('nrc');

        $list = Cursos:: /* REVISAR EL ASUNTO DE LAS AREAS Y EL ORDEN   orderBy('nombre')  */nombre($nombre1) /* -> */
            ->codigo($codigo)
            ->area($area1)
            ->paginate(999999999);

        foreach ($list as $item) {
            $item['nombreArea'] = AreasAcademicas::find($item->are_id)->nombreArea;
        }
        if ($area1 == "soc") {
            /* dd($list); */
        }

        return view('cursos.index', compact('list'));
    }

    public function gruposData(Request $request)
    {
        $id = session('curso');
        // dd($id);
        $grupos = Grupos::joincursos()->paginate(999999);
        $aux = new Collection();
        foreach ($grupos as $t) {
            if ($t->cur_id == null || $t->cur_id == $id) {
                $aux->push($t);
            }
        }
        // dd($aux);
        $band = false;
        foreach ($grupos as $t) {
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
        return DataTables::of($aux)
            ->addColumn('acciones', function ($a) use ($id) {
                if ($a->cur_id == $id) {
                    
                    return '<a class="btn btn-primary btn-sm" href="'.route('estadoGrupo', [$id, $a->id]).'">Eliminar</a>';
                } else {
                    return '<a class="btn btn-secondary btn-sm" href="'.route('estadoGrupo', [$id, $a->id]).'">Agregar</a>';
                };
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function carrerasData(Request $request)
    {
        $id = session('curso');
        $carreras = Carreras::joinCursos()->paginate(999999);
        $aux = new Collection();
        foreach ($carreras as $t) {
            if ($t->cur_id == null || $t->cur_id == $id) {
                $aux->push($t);
            }
        }
        $band = false;
        foreach ($carreras as $t) {
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
        return DataTables::of($aux)
            ->addColumn('acciones', function ($a) use ($id) {
                if ($a->cur_id == $id) {
                    return '<a class="btn btn-primary btn-sm" href="'.route('estadoCarrera', [$id, $a->id]).'">Eliminar</a>';
                } else {
                    return '<a class="btn btn-secondary btn-sm" href="'.route('estadoCarrera', [$id, $a->id]).'">Agregar</a>';
                };
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function editRelations(Request $request, $id)
    {
        $cursos = Cursos::find($id);
        $list = AreasAcademicas::orderBy('nombreArea')
            ->nombre(null)
            ->id('')
            ->get();

        return view('cursos.editRelations', (compact('cursos', 'list')));
    }
    public function listar()
    {
        return view('Cursos.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carreras= Carreras::get();
        $list = AreasAcademicas::orderBy('nombreArea')
            ->nombre(null)
            ->id('')
            ->get();
        return view('cursos.create', compact('list','carreras'));
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
            'nombre_cur' => ['required', 'string', 'max:255'],
            'codigo' => ['required', 'string', 'max:255'],
            'creditos' => ['required', 'int', 'max:255'],
            'horas' => ['required', 'int', 'max:255'],
            'color' => [
                'required',
                'regex:/(#(?:[0-9a-f]{2}){2,4}|#[0-9a-f]{3}|(?:rgba?|hsla?)\((?:\d+%?(?:deg|rad|grad|turn)?(?:,|\s)+){2,3}[\s\/]*[\d\.]+%?\))/i', // <--- not working
            ],
            'horas_contacto' => ['required', 'int', 'max:255'],
            'are_id' => ['required', 'string', 'max:255'],
            'carrera_id' => ['required', 'string', 'max:255']
        ])->validate(); //ultima linea es por si algo sale mal retorna la vista anterior con la lista de errores        //creacion de la entidad

        $data = $request->all();
        //verificar campo estado
        if (isset($_POST['estado'])) {
            $data['estado'] = 'A';
        } else {
            $data['estado'] = 'I';
        }

        Cursos::create([
            'nombre_cur' => $data['nombre_cur'],
            'codigo' => $data['codigo'],
            'creditos' => $data['creditos'],
            'carrera_id' => $data['carrera_id'],
            'horas' => $data['horas'],
            'estado' => $data['estado'],
            'horas_contacto' => $data['horas_contacto'],
            'color' => $data['color'],
            'are_id' => $data['are_id'],
        ]);

        return redirect()->route('cursos.index')->with('info', 'Curso agregado correctamente');;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cursos = Cursos::find($id);
        $carreras= Carreras::get();
        $areaAct= AreasAcademicas::find($cursos->are_id);
        $carreraAct= Carreras::find($cursos->carrera_id);
        $list = AreasAcademicas::orderBy('nombreArea')
            ->nombre(null)
            ->id('')
            ->get();

        session(['curso' => $id]);
        return view('cursos.edit', compact('cursos', 'list','carreras','carreraAct','areaAct'));
    }

    public function estadoCarrera(Request $request, $idCurso, $idCarrera)
    {
        $relacion = cursosCarrera::buscar($idCurso, $idCarrera)->first();
        $accion = '';
        if ($relacion == null) {
            cursosCarrera::insertar($idCurso, $idCarrera);
            $accion = 'agregado';
        } else {
            cursosCarrera::eliminar($idCurso, $idCarrera);
            $accion = 'eliminado';
        }
        return back()->with('info', 'Grupo ' . $accion . ' correctamente');
    }


    public function estadoGrupo($idCurso, $idGrupo)
    {
        $relacion = GrupoCurso::buscar($idCurso, $idGrupo)->first();
        $accion = '';
        if ($relacion == null) {
            GrupoCurso::insertar($idCurso, $idGrupo);
            $accion = 'agregado';
        } else {
            GrupoCurso::eliminar($idCurso, $idGrupo);
            $accion = 'eliminado';
        }
        return back()->with('info', 'Grupo ' . $accion . ' correctamente');
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


        $cursos = Cursos::find($id);
        Validator::make($request->all(), [
            'nombre_cur' => ['required', Rule::unique('siplac_curso')->ignore($cursos->id, 'id')],
            'codigo' => ['required'],
            'creditos' =>  ['required', 'int', 'max:255'],
            'horas' =>  ['required', 'int', 'max:255'],
            'horas_contacto' =>  ['required', 'int', 'max:255'],
            'are_id' => ['required'],
            'carrera_id' => ['required'],
        ])->validate(); //ultima linea es por si algo sale mal retorna la vista anterior con la lista de errores

        $data = $request->all();
        //Si el campo el check box no esta en true entoces no llega valor por lo que hay q agregarlo
        if (isset($_POST['estado'])) {
            $data['estado'] = 'A';
        } else {
            $data['estado'] = 'I';
        }

        $cursos->update($data);
        return redirect()->route('cursos.index')->with('info', 'Curso actualizado correctamente');
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
        $curso = Cursos::find($id);
        $data['estado'] = '';
        $accion = '';
        if ($curso->estado == 'A') {
            $data['estado'] = 'I';
            $accion = 'Desactivado';
        } else {
            $data['estado'] = 'A';
            $accion = 'Activado';
        }
        Validator::make($data, [
            'estado' => '',
        ])->validate();

        $curso->update($data);
        return back()->with('info', 'Curso ' . $accion . ' correctamente');
    }
}
