<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Exceptions\Handler;
use App\Horarios;
use App\Aulas;
use App\Ciclo;
use App\Cursos;
use App\cursosCiclo;
use App\Grupos;
use App\Carreras;
use App\cursosCarrera;
class CursosCarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
// carga la vista de horarios
    public function goHorario(){
        return view('horarios.index');
    }
// carga el horario de una aula en especifico 
    public function cargarHorarios(){
        $horarios = Horarios::orderBy('id')->get();
        return $horarios;
    }
    // muestra el horario de un curso especifico
    public function mostrarHorarioGrupo($id){

    }
// carga los grupos de acuedo a una carrera
    public function cargarGrupos($id){
        $grupos = Grupos::orderBy('id')->get();
        return $grupos;
    }
    public function index(Request $request)
    {
        $cursosL = Cursos::orderBy('id')->get();

        $date = date('Y/m/d', time());
        $carreras = Carreras::orderBy('id')->get();
        //*$cicloL = Ciclo::orderBy('id')->get();

        return view('cursosCarrera.index', compact('cursosL'), compact('carreras'));    
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
        Validator::make($request->all(), [
            'curso_id' => ['required', 'string', 'max:255'],
            'carrera_id' => ['required', 'string', 'max:255'],
        ])->validate(); //ultima linea es por si algo sale mal retorna la vista anterior con la lista de errores
        //creacion de la entidad
        $data = $request->all();
        //verificar campo estado
        cursosCarrera::create([
            'carrera-id' => $data['carrera_id'],
            'cursos_id' => $data['curso_id'],
        ]);

        return redirect()->route('cursosCarrera.index')->with('info', 'curso y carrera relacionados con exito');
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
