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
use App\Grupos;
use App\Carreras;
use App\GrupoCurso;
use DB;

class horarioController2 extends Controller
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
        $car = $request->get('carrera_select');  //Busqueda por curso
        $cic = $request->get('ciclos_select');  //Busqueda por ciclo
        $grup = $request->get('grupos_select'); //Busqueda por grupo

        $horarios = Horarios::orderBy('nombre', 'asc')
            ->orderBy('numero', 'asc')
            ->filtro2($car, $cic, $grup);
        // dd($horarios);
        $HorariosTodos = Cursos::cursoAll();  // todos los horarios 

        if ($car != "Ninguno") {
            foreach ($horarios as $item) {
                $this->cargaInformacion($item);
            }
        } else {
            if ($cic != "Ninguno") {
                foreach ($horarios as $item) {
                    $this->cargaInformacion($item);
                }
            } else {
                if ($grup != "Ninguno") {
                    foreach ($horarios as $item) {
                        $this->cargaInformacion($item);
                    }
                }
            }
        }

        $aulas = Aulas::get();
        $cursos = Cursos::asignados();
        $ciclos = Ciclo::get();
        $grupos = GrupoCurso::get();
        $carrera = Carreras::get();
        $nivel =  ["I", "II", "III", "IV", "V"];

        foreach ($ciclos as $item) {
            $timestamp = $item->fecha_inicio;
            $dateValue = strtotime($item->fecha_inicio);
            $yr = date("Y", $dateValue) . " ";
            $item['año'] = $yr;
        }
        // dd(count($horarios));
        if($car == "Ninguno" && $cic == "Ninguno" && $grup == "Ninguno"){
            
        } else {
            session(['horario' => $horarios]);
        }
            
        
        
        return view('horarios2.index', compact('cursos', 'aulas', 'ciclos', 'grupos', 'carrera', 'nivel', 'horarios', 'HorariosTodos'));
    }

    public function guardarEventos(Request $request)
    {

        $input = json_decode($_POST['datosArray']);

        return ($this->store($input));
    }

    public function store($request)
    {

        $respuestas = array();
        $eventos = $request;

        //Primero Revisamos que los cursos no se contrapongan o se sobrepasen los limites de horas
        //GruposCursos::



        foreach ($eventos as $item) {
            if ($item->stored == "no") {
                if ($this->validaHorario($item) != "ok") {
                    $gruposCursos = GruposCursos::find($item->curso);
                    $curso = Cursos::find($gruposCursos->curso_id);

                    $respuestas[] = ['nrc' => $item->curso, 'mensaje' => "Error: " . "Exeso de horas disponibles Curso:" . $curso->nombre_cur . " NRC:" . $gruposCursos->nrc]; //

                } else {
                    if ($this->validaAula($item) != "ok") {
                        $aula = Aulas::find($item->aula);
                        $gruposCursos = GruposCursos::find($item->curso);
                        $curso = Cursos::find($gruposCursos->curso_id);

                        $respuestas[] = ['nrc' => $item->curso, 'mensaje' => "Error: " . "Para el curso: " . $curso->nombre_cur . " Aula ocupada: " . $aula->numero]; //
                    }
                }
            }
        }


        //Si no hubieron contradicciones se procede a guardar todos los eventos, de los contrario no se guarda ninguno
        if (count($respuestas) == 0) {

            foreach ($eventos as $item) {

                if ($item->stored == "no") {

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

    public function cargaInformacion($item)
    {
        $ciclo = Ciclo::find($item->ciclo_id);
        $idCurso = GruposCursos::find($item->grup_cursos_id)->curso_id;
        $curso = Cursos::find($idCurso);

        $item['title'] = $curso->nombre_cur; //starttime, ya lo lleva y endtime, tambien y dayOfweek,
        $item['curso_id'] = $item->grup_cursos_id;
        $item['ciclo_id'] = $item->ciclo_id;
        $item['aula_id'] = $item->aula_id;
        $item['startRecur'] = $ciclo->fecha_inicio;
        $item['endRecur'] = $ciclo->fecha_fin;
        $item['color'] = $curso->color;
        $item['groupId'] = $curso->id;
        $item['stored'] = 'si';
    }

    public function tomaDia($i)
    {
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

    public function validaHorario($item)
    {

        $cur1 = $item->curso;
        $horaIni = $item->start_time;
        $horaFin = $item->end_time;
        $respuesta = DB::select("SELECT func_revision_horas($cur1,'$horaIni','$horaFin')");

        $resultado = $this->recorreRespuesta($respuesta);

        return $resultado;
    }

    public function validaAula($item)
    {
        $cur1 = $item->curso;
        $horaIni = $item->start_time;
        $horaFin = $item->end_time;
        $aula = $item->aula;
        $ciclo = $item->ciclo;
        $dia = $item->day;
        $respuesta = DB::select("SELECT func_revisa_aul('$aula','$horaIni','$horaFin','$ciclo','$dia')");

        $resultado = $this->recorreRespuesta($respuesta);

        return $resultado;
    }

    public function validaMismo($item)
    { //en proceso
        $horaIni = $item->start_time;
        $horaFin = $item->end_time;
        $ciclo = $item->ciclo;
        $dia = $item->day;

        $gruposCursos = GruposCursos::find($item->curso);
        $curso = Cursos::find($gruposCursos->curso_id);

        $respuesta = DB::select("SELECT func_revisa_mismo('$curso->id','$horaIni','$horaFin','$dia','$ciclo')");

        $resultado = $this->recorreRespuesta($respuesta);
        return $resultado;
    }

    public function recorreRespuesta($respuesta)
    {
        $cadena = "" . json_encode($respuesta[0]);

        $cont = 0;
        for ($i = 0; $i < strlen($cadena) - 3; $i++) {
            if ($cadena[$i] == ":") {
                $cont++;
                if ($cont == 5) {
                    return $cadena[$i + 2] . $cadena[$i + 3];
                }
            }
        }
    }
}
