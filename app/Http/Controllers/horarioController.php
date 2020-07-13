<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Exceptions\Handler;
use App\Horarios;
use App\Aulas;
use App\Ciclo;
use App\Cursos;
use App\Carreras;
use App\HorarioN;
use App\GruposCursos;
use DB;
class horarioController extends Controller
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


    public function index(Request $request)
    {
        $cur = $request->get('cursos_select');  //Busqueda por curso
        $aul = $request->get('aulas_select');  //Busqueda por aula
        $cic = $request->get('ciclos_select');  //Busqueda por ciclo
        $grup = $request->get('grupos_select'); //Busqueda por grupo
        $carr = null;
        $niv = $request->get('nivel_id');  //Busqueda por nivel 
        //$horarios = Horarios::filtro($aul, $cur, $cic, $grup, $carr, $niv);
        $horarios = Horarios::filtro($aul, $cur, $cic, $grup, $carr, $niv);
        $HorariosTodos = Cursos::cursoAll();  // todos los horarios 

        if($cur!="Ninguno"){
            //dd($cur);
            foreach ($horarios as $item){
                $this->cargaInformacion($item);
            }     
        }else{
            if($aul!="Ninguno"){
                foreach ($horarios as $item){
                    $this->cargaInformacion($item);
                } 
            }else{
                if($cic!="Ninguno"){
                    foreach ($horarios as $item){
                        $this->cargaInformacion($item);
                    } 
                }else{
                    if($grup!="Ninguno"){
                        foreach ($horarios as $item){
                            $this->cargaInformacion($item);
                        } 
                    }
                }
            }
        }

       $cur1="4";
       $horaIni = "10:00:00";
       $horaFin = "11:00:00";
       $queries = DB::select("SELECT func_revision_horas($cur1,'$horaIni','$horaFin')");
       //dd($queries);

        $aulas = Aulas::get();
        $cursos = Cursos::asignados();
        $ciclos = Ciclo::get();
        $grupos = GruposCursos::get();
        $carrera = Carreras::get();
        $nivel =  ["I","II","III","IV","V"];

        foreach ($ciclos as $item){
            $timestamp = $item->fecha_inicio;
            $dateValue = strtotime($item->fecha_inicio);                     
            $yr = date("Y", $dateValue) ." ";
            $item['año'] = $yr;
        }
       
        return view('horarios.index',compact('cursos','aulas','ciclos','grupos','carrera','nivel','horarios','HorariosTodos'));
    }

    public function guardarEventos(Request $request)
    {

        $input = json_decode($_POST['datosArray']);
        $input2=json_decode($_POST['jsondata']);

        $this->eliminaHorarios($input2);

        return($this->store($input));

    }

    public function eliminaHorarios($request){
        $contador=0;
        foreach ($request as $item){    
            $horario = horarios::find($item);
            if($horario!=null){
                $contador++;
                $horario->delete();
            }   
        }
        return $contador;

    }

    public function store($request)
    { 
        
        $respuestas = Array(); 
        $eventos = $request;

        //Primero Revisamos que los cursos no se contrapongan o se sobrepasen los limites de horas
        //GruposCursos::
         foreach ($eventos as $item){
            if($item->stored=="no"){
                if($this->validaHorario($item) != "ok"){
                    $gruposCursos = GruposCursos::find($item->curso);
                    $curso = Cursos::find($gruposCursos->curso_id);
                    $respuestas[] = ['nrc'=>$item->curso,'mensaje'=>"Error: "."Exeso de horas disponibles Curso:".$curso->nombre_cur." NRC: ".$gruposCursos->nrc]; //

                }else{
                    if($this->validaAula($item) != "ok"){
                        $aula = Aulas::find($item->aula);
                        $gruposCursos = GruposCursos::find($item->curso);
                        $curso = Cursos::find($gruposCursos->curso_id);
                
                        $respuestas[] = ['nrc'=>$item->curso,'mensaje'=>"Error: "."Para el curso: ".$curso->nombre_cur." Aula ocupada: ".$aula->numero]; //
                    }else{
                        if($this->validaMismo($item) != "ok"){
                            $gruposCursos = GruposCursos::find($item->curso);
                            $curso = Cursos::find($gruposCursos->curso_id);
                    
                            $respuestas[] = ['nrc'=>$item->curso,'mensaje'=>"Error: "."Para el curso: ".$curso->nombre_cur." ya esta en estas horas este mismo dia ".$this->tomaDia($item->day)]; //
                        }
                    }
                }
            }
        }


        //Si no hubieron contradicciones se procede a guardar todos los eventos, de los contrario no se guarda ninguno
        if(count($respuestas)==0){

            foreach ($eventos as $item){

                if($item->stored=="no"){

                    Horarios::create([
                        'startTime' => $item->start_time,
                        'endTime' => $item->end_time,
                        'daysOfWeek' => $item->day,
                        'grup_cursos_id' => $item->curso,
                        'ciclo_id' => $item->ciclo,
                        'aula_id' => $item->aula,
                    ]);
                }
            }

        }

        return response()->json($respuestas);
    }

    public function cargaInformacion($item){ 
        $ciclo=Ciclo::find($item->ciclo_id);
        $grup = GruposCursos::find($item->grup_cursos_id);
        $idCurso=$grup->curso_id;
        $curso = Cursos::find($idCurso);

        $item['title'] = $curso->nombre_cur." (".$grup->nrc.")"; 
        $item['curso_id'] = $item->grup_cursos_id;
        $item['ciclo_id'] = $item->ciclo_id;
        $item['aula_id'] = $item->aula_id;
        $item['startRecur'] = $ciclo->fecha_inicio;
        $item['endRecur'] = $ciclo->fecha_fin;
        $item['color'] = $curso->color;
        $item['groupId'] = $curso->id;
        $item['stored'] = 'si';
    }

    public function tomaDia($i){
        switch ($i) {
            case "1":
                return "Lunes";
                break;
            case "2":
                return "Martes";
                break;
            case "3":
                return "Miercoles";
                break;
            case "4":
                return "Jueves";
                break;
            case "5":
                return "Viernes";
                break;
            case "6":
                return "Sabado";
                break;
            case "7":
                return "Domingo";
                break;
        }
    }

    public function validaHorario($item){
        $gruposCursos = GruposCursos::find($item->curso);
        $curso = Cursos::find($gruposCursos->curso_id);

        $horaIni = $item->start_time;
        $horaFin = $item->end_time;
        $respuesta = DB::select("SELECT func_revision_horas('$curso->id','$horaIni','$horaFin','$gruposCursos->grupos_id')");
 
        $resultado= $this->recorreRespuesta($respuesta);

        return $resultado;
     }

    public function validaAula($item){
        $gruposCursos = GruposCursos::find($item->curso);
        $horaIni = $item->start_time;
        $horaFin = $item->end_time;
        $aula= $item->aula;
        $ciclo = $item->ciclo;
        $dia = $item->day;
        $respuesta = DB::select("SELECT func_revisa_aul('$aula','$horaIni','$horaFin','$ciclo','$dia')");

        $resultado= $this->recorreRespuesta($respuesta);

        return $resultado;
    }

    public function validaMismo($item){ //en proceso

        $horaIni = $item->start_time;
        $horaFin = $item->end_time;
        $ciclo = $item->ciclo;
        $dia = $item->day;

        $respuesta = DB::select("SELECT func_revisa_mismo('$horaIni','$horaFin','$dia','$item->ciclo','$item->curso')");

        $resultado= $this->recorreRespuesta($respuesta);
        return $resultado;
    }
 
     public function recorreRespuesta($respuesta){
         $cadena="".json_encode($respuesta[0]);
 
         $cont=0;
         for($i=0;$i<strlen($cadena)-3;$i++)
         {
             if($cadena[$i]==":"){
                 $cont++;
                 if($cont==5){
                     return $cadena[$i+2].$cadena[$i+3];
                 }
             }
 
         }
    }


}
