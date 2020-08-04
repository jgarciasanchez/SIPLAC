<?php

namespace App\Http\Controllers;

use App\Carreras;
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
use App\GrupoCurso;
use App\Ciclo;
use App\Grupos;
use App\Cursos;
use App\Profesores;
use App\cursoProfesor;
use DB;

class AsignacionCursosController extends Controller
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

        $ciclo = Ciclo::where('estado','=','A')->first();


        $list = GrupoCurso::where('ciclo_id','=',$ciclo->id)->orderBy('id')
        ->paginate(99999999);
        
        foreach($list as $item){
            $profPermanente = CursoProfesor::where('nrc_id','=',$item->id)->where('tipo_asingnacion','=','P')->first();
            $profPermanente2 = CursoProfesor::where('nrc_id','=',$item->id)->where('tipo_asingnacion','=','P2')->first();
            if($profPermanente == null){
                $nombreProf = 'Sin asignar';
            }
            else{
                $profe = Profesores::find($profPermanente->profesor_id);
                $nombreProf = $profe['nombre1'] .' '. $profe['apellido1'];
            }

            if($profPermanente2 == null){
                $nombreProf2 = 'Sin asignar';
            }
            else{
                $profe2 = Profesores::find($profPermanente2->profesor_id);
                $nombreProf2 = $profe2['nombre1'] .' '. $profe2['apellido1'];
            }

            $dateValue = strtotime( Ciclo::find($item->ciclo_id)->fecha_inicio);                     
            $yr = date("Y", $dateValue) ." ";
            $item['a�o'] = $yr;

            $item['nombreCurso'] = Cursos::find($item->curso_id)->nombre_cur;
            $item['nombreCiclo'] = Ciclo::find($item->ciclo_id)->ciclo.'('.$yr.')';
            //$item['nombreGrupo'] = Grupos::find($item->grupos_id)->numero;
            $item['nombreProfe'] = $nombreProf;
            $item['nombreProfe2'] = $nombreProf2;
            $item['carrera'] = (Carreras::find((Cursos::find($item->curso_id))->carrera_id))->nombre;
        }
        // dd($list);
        return view('asignacioncursos.index',compact('list'));
    }
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        $profesores = Profesores::get();
        $cursos = Cursos::get();
        $ciclos = Ciclo::get();

        return view('asignacioncursos.create',compact('profesores','ciclos','cursos'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

      //  dd($request);


    Validator::make($request->all(), [
        'nrc' => ['required', 'string', 'max:255'],
        'grupo' => ['required', 'int','max:1000'],
        'ciclo_id' => ['required', 'string', 'max:255'],
        'curso_id' => ['required', 'string', 'max:255'],
    ])->validate(); //ultima linea es por si algo sale mal retorna la vista anterior con la lista de errores
    


    $data = $request->all();

    GrupoCurso::create([

        'nrc'  => $data['nrc'],
        'grupo' => $data['grupo'],
        'ciclo_id' => $data['ciclo_id'],
        'curso_id' => $data['curso_id']

    ]);


    $nrc_id = GrupoCurso::where('nrc','=',$data['nrc'])->first();


    $per = $request->get('profesorPermanente_id');
    $per2 = $request->get('segundoProfesorPermanente_id');
    $sup = $request->get('profesorSuplente_id');
    if($per!="Ninguno"){
        CursoProfesor::create([
            'tipo_asingnacion' => 'P',
            'estado' => 'A',
            'nrc_id' => $nrc_id['id'],
            'profesor_id' => $data['profesorPermanente_id']
        ]);
    }


    if($per2!="Ninguno"){
        CursoProfesor::create([
            'tipo_asingnacion' => 'P2',
            'estado' => 'A',
            'nrc_id' => $nrc_id['id'],
            'profesor_id' => $data['segundoProfesorPermanente_id']
        ]);
    }

    if($sup!="Ninguno"){
        CursoProfesor::create([
            'tipo_asingnacion' => 'T',
            'estado' => 'A',
            'nrc_id' => $nrc_id['id'],
            'profesor_id' => $data['profesorSuplente_id']
        ]);
    }





    return redirect()->route('asignacioncursos.index')->with('info', 'NRC agregada correctamente');

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $grupoCurso = GrupoCurso::find($id);
        $nrc = $grupoCurso->nrc;
        $ciclos = Ciclo::get();
        $cursos =Cursos::get();
        $profesores = Profesores::get();

        


        $cicloAc = Ciclo::find($grupoCurso ->ciclo_id);
        $cursoAc = Cursos::find($grupoCurso ->curso_id);
  
        $profPermanente = CursoProfesor::where('nrc_id','=',$grupoCurso->id)->where('tipo_asingnacion','=','P')->first();
        $segundoProfPermanente = CursoProfesor::where('nrc_id','=',$grupoCurso->id)->where('tipo_asingnacion','=','P2')->first();
        $profSuplente = CursoProfesor::where('nrc_id','=',$grupoCurso->id)->where('tipo_asingnacion','=','T')->first();
        
        if($profPermanente!=null){
            $profe = Profesores::find($profPermanente->profesor_id);
        }else{
            $profe=null;
        }


        if($segundoProfPermanente!=null){
            $segundoProfe = Profesores::find($segundoProfPermanente->profesor_id);
        }else{
            $segundoProfe=null;
        }

        if($profSuplente!=null){
            $profeT = Profesores::find($profSuplente->profesor_id);
        }else{
             $profeT=null;
        }
        //dd($segundoProfPermanente);
        return view('asignacioncursos.edit',compact('nrc','profesores','ciclos','cursos','grupoCurso','profe','profeT','segundoProfe','cicloAc','cursoAc'));

    }

    public function destroy($id){

        $profPermanente = CursoProfesor::where('nrc_id','=',$id)->where('tipo_asingnacion','=','P')->first();

        if( $profPermanente != null){
            $profPermanente->delete();
        }

        $profSuplente = CursoProfesor::where('nrc_id','=',$id)->where('tipo_asingnacion','=','T')->first(); 
        if($profSuplente != null){
            $profSuplente->delete();
        }
    
        $grupoCurso = GrupoCurso::find($id);
        $grupoCurso->delete();


        return back()->with('info', 'NRC ' . 'eliminado'. ' correctamente');
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id){

        $grupoCurso = GrupoCurso::find($id);


        Validator::make($request->all(), [
            'nrc' => ['required', 'string', 'max:255'],
            'grupo' => ['required', 'int','max:1000'],
            'ciclo_id' => ['required', 'string', 'max:255'],
            'curso_id' => ['required', 'string', 'max:255'],
        ])->validate(); //ultima linea es por si algo sale mal retorna la vista anterior con la lista de errores
        

        $data = $request->all();
        //dd($grupoCurso->id);
        
        $profPermanente = CursoProfesor::where('nrc_id','=',$grupoCurso->id)->where('tipo_asingnacion','=','P')->first();
        $segundoProfPermanente = CursoProfesor::where('nrc_id','=',$grupoCurso->id)->where('tipo_asingnacion','=','P2')->first();
        $profSustituto = CursoProfesor::where('nrc_id','=',$grupoCurso->id)->where('tipo_asingnacion','=','T')->first();

        //$profPermanente->profesor_id = $request['profesorPermanente_id'];*/

        //dd($profPermanente);
        $per = $request->get('profesorPermanente_id');
        $per2 = $request->get('segundoProfesorPermanente_id');
        $sup = $request->get('profesorSuplente_id');

       
        if($per!="Ninguno"){
            if($profPermanente != null){ 
                DB::table('siplac_curso_profesor')
                ->where('nrc_id', $grupoCurso->id)
                ->where('tipo_asingnacion', 'P')
                ->update(['profesor_id' => $data['profesorPermanente_id']]);
            }
            else{
                CursoProfesor::create([
                    'tipo_asingnacion' => 'P',
                    'estado' => 'A',
                    'nrc_id' => $grupoCurso->id,
                    'profesor_id' => $data['profesorPermanente_id']
                ]);
            }
        }
        else{
            if($profPermanente != null){ $profPermanente->delete(); };
        }

        if($per2 !="Ninguno"){
            if($segundoProfPermanente  != null){ 
                DB::table('siplac_curso_profesor')
                ->where('nrc_id', $grupoCurso->id)
                ->where('tipo_asingnacion', 'P2')
                ->update(['profesor_id' => $data['segundoProfesorPermanente_id']]);
            }
            else{
                CursoProfesor::create([
                    'tipo_asingnacion' => 'P2',
                    'estado' => 'A',
                    'nrc_id' => $grupoCurso->id,
                    'profesor_id' => $data['segundoProfesorPermanente_id']
                ]);
            }
        }
        else{
            if($segundoProfPermanente != null){ $segundoProfPermanente->delete(); };
        }
        
        
        if($sup!="Ninguno"){
            if($profSustituto != null){
                DB::table('siplac_curso_profesor')
                ->where('nrc_id', $grupoCurso->id)
                ->where('tipo_asingnacion', 'T')
                ->update(['profesor_id' => $data['profesorSuplente_id']]);
            }
            else{
                CursoProfesor::create([
                    'tipo_asingnacion' => 'T',
                    'estado' => 'A',
                    'nrc_id' => $grupoCurso->id,
                    'profesor_id' => $data['profesorSuplente_id']
                ]);

            }

        }
        else{
            if($profSustituto != null){ $profSustituto->delete(); };
        }
        


        $grupoCurso->update($data);


        return redirect()->route('asignacioncursos.index')->with('info', 'Se asigno el NRC completamente');
    } 
}