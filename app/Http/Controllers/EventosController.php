<?php

namespace App\Http\Controllers;


use App\Cursos;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use App\Exceptions\Handler;
use App\AreasAcademicas;
use App\Bitacora;
use App\Aulas;
use App\Ciclo;
use App\HorarioN;
use App\Grupos;
use App\Carreras;

class EventosController extends Controller
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
        $cur = $request->get('cursos_id');  //Busqueda por curso
        $aul = $request->get('aula_id');  //Busqueda por aula
        $cic = $request->get('ciclo_id');  //Busqueda por ciclo
        $grup = $request->get('grupo_id'); //Busqueda por grupo
        $carr = $request->get('carrera_id'); //Busqueda por carrera
        $niv = $request->get('nivel_id');  //Busqueda por nivel 

        $horarios = HorarioN::filtro($aul, $cur, $cic, $grup,$carr,$niv); // se encarga de revisar que es lo que se quiere , ciclos , cursos , aulas , carreras 

        $ciclos = Ciclo::get();
        foreach ($ciclos as $item){
            $timestamp = $item->fecha_inicio;
            $dateValue = strtotime($item->fecha_inicio);                     
            $yr = date("Y", $dateValue) ." ";
            $item['año'] = $yr;
        }

        if($cur!="Ninguno"){
            $suma= 0; 
            $suma= $this->sumaHUsadas($suma,$horarios);//SUMA NO SQL , (PROCESO)
            foreach ($horarios as $item){
                $this->cargaInformacion($item);
                $this->colorInfo($item,"1");
                $item['HorasSumadas'] = $suma; //SUMA NO SQL , AUN NO SE COMO POR AHORA ASI
            }
        }else{
           if($aul!="Ninguno"){
                $suma= 0; 
                $suma= $this->sumaHUsadas($suma,$horarios);//SUMA NO SQL , (PROCESO)
                foreach ($horarios as $item){
                    $this->cargaInformacion($item);
                    $this->colorInfo($item,"2");
                    $item['HorasSumadas'] = $suma; //SUMA NO SQL , AUN NO SE COMO POR AHORA ASI
                }
            }
            else{
                if($cic!="Ninguno"){
                    $suma= 0; 
                    $suma= $this->sumaHUsadas($suma,$horarios);//SUMA NO SQL , (PROCESO)
                    foreach ($horarios as $item){
                        $this->cargaInformacion($item);
                        $this->colorInfo($item,"3");
                         $item['HorasSumadas'] = $suma; //SUMA NO SQL , AUN NO SE COMO POR AHORA ASI
                    }
                }
                else{
                    if ($grup!="Ninguno") {
                        $suma= 0; 
                        $suma= $this->sumaHUsadas($suma,$horarios);//SUMA NO SQL , (PROCESO)
                        foreach ($horarios as $item){
                            $this->cargaInformacion($item);
                            $this->colorInfo($item,"4");
                             $item['HorasSumadas'] = $suma; //SUMA NO SQL , AUN NO SE COMO POR AHORA ASI
                        }
                    }else{
                        if ($carr!="Ninguno") {
                            $suma= 0; 
                            $suma= $this->sumaHUsadas($suma,$horarios);//SUMA NO SQL , (PROCESO)
                            foreach ($horarios as $item){
                                $this->cargaInformacion($item);
                                $this->colorInfo($item,"5");
                                 $item['HorasSumadas'] = $suma; //SUMA NO SQL , AUN NO SE COMO POR AHORA ASI
                            }
                        }
                        elseif ($niv!="Ninguno") {
                            $suma= 0; 
                            $suma= $this->sumaHUsadas($suma,$horarios);//SUMA NO SQL , (PROCESO)
                            foreach ($horarios as $item){
                                $this->cargaInformacion($item);
                                $this->colorInfo($item,"6");
                                $item['HorasSumadas'] = $suma; //SUMA NO SQL , AUN NO SE COMO POR AHORA ASI
                            }
                        }
                    }
                }
            }
        }
        $variableIdH='000';
        $aulas = Aulas::get();
        $cursos = Cursos::get();
        $grupos = Grupos::get();
        $carrera = Carreras::get();
        $HorariosTodos = Cursos::cursoAll(); // todos los horarios que exsitan 
        $this->sumaHorasAll($HorariosTodos);
        $horas; $minutos;    //$Hdisponible=[1,2,3,4,5,6]; 
        //dd($HorariosTodos);

        for($i=0; $i<24; $i++){ $horas[$i]=$i; }
        for($i=0; $i<60; $i++){ $minutos[$i]=$i; }
        //$minutos =
        $nivel =  ["I","II","III","IV","V"];
        $codificado = json_encode($horarios); 
      
        return view('Eventos.index',compact('horarios',
                                            'cursos','aulas','ciclos','codificado','grupos','carrera',
                                            'horas','minutos','nivel','variableIdH','HorariosTodos'));
    }

    public function sumaHorasAll($horarios){ // este metodo es para que al insertar en el select le cargue info pero es solo una idea que por ahora va funcionando 
        $suma= 0;      
        foreach ($horarios as $item){
            $t1 = strtotime($item->startTime);
            $t2 = strtotime($item->endTime);
            $aux = gmdate('H:i:s', $t2 - $t1);

            $string = strval($aux);  
            $hor = preg_split ("[:]", $string);
            $suma = $suma + $hor[0];
            $item['HorasEspecificas'] = $hor[0];
        }

        foreach ($horarios as $item){
            $item['HorasSumadas'] = $suma;
        }
    }

    public function prueba(Request $request)
    {
        dd($id);
    }

     public function update(Request $request,$id)
    {
         return redirect()->route('eventos.index')->with('info','Curso actualizado correctamente');
    }

    public function ajaxRequest(Request $request)
    {
        $input = $request->except(['_token','_method']);
        print_r("guti: ");

        foreach ($input as $item){
            return $item[0];   
        }
             

       /* $horarios = HorarioN::find($input["id"]);
        print_r($horarios);
        $data = array('id'=>$input["id"],"startTime"=>$input["startTime"],
                    "endTime"=>$input["endTime"],"daysOfWeek"=>$input["daysOfWeek"],
                    "cur_id"=>$input["cur_id"],"ciclo_id"=>$input["ciclo_id"],"aula_id"=>$input["aula_id"]);
        $horarios->update($data);
        dd("llega info");*/
        //return response()->json($input["informacion"]);
        return response()->json(['success'=>'Got Simple Ajax Request get.']);
        return redirect()->route('eventos.index')->with('info','Horario editado correctamente'); 

    }

    public function ajaxRequestPost(Request $request)
    {
        $input = $request->except(['_token','_method']);
        print_r($input);

       /* $horarios = HorarioN::find($input["id"]);
        print_r($horarios);
        $data = array('id'=>$input["id"],"startTime"=>$input["startTime"],
                    "endTime"=>$input["endTime"],"daysOfWeek"=>$input["daysOfWeek"],
                    "cur_id"=>$input["cur_id"],"ciclo_id"=>$input["ciclo_id"],"aula_id"=>$input["aula_id"]);
        $horarios->update($data);
        dd("llega info");*/
        return response()->json(['success'=>'Got Simple Ajax Request.']);
        return redirect()->route('eventos.index')->with('info','Horario editado correctamente'); 

    }

    public function recarga(Request $request){
        return redirect()->route('eventos.index')->with('info','Horario editado correctamente'); 
    }

    public function store(Request $request)
    { 


        $nom = $request->get('aula_idM');
        $hor = $request->get('Hinicio');
        $min = $request->get('Minicio');

        $cur = $request->get('cursos_idM');
        $cic = $request->get('ciclos_idM');
        $horD = $request->get('Hdisponibles');
        $dia = $request->get('dias');

        dd($nom." --".$cur);
         
       Validator::make($request->all(), [
            'aula_idM' => ['required', 'string', 'max:255'],
            'Hinicio' => ['required', 'string', 'max:255'],
            'Minicio' => ['required', 'int', 'max:255'],
            'cursos_idM' => ['required', 'int', 'max:255'],
            'ciclos_idM' => ['required', 'string', 'max:255'],
            'Hdisponibles' => ['required', 'string', 'max:255'],
            'dias' => ['required', 'string', 'max:255'],
        ])->validate();
        $data = $request->all();
        $auxInicio=$hor.":".$min.":00";
        $horasUsadas=$hor+$horD;
        $auxFin =$horasUsadas.":".$min.":00";
     
        HorarioN::create([
            'startTime' => $auxInicio,
            'endTime' => $auxFin,
            'daysOfWeek' => $data['dias'],
            'cur_id' => $data['cursos_idM'],
            'ciclo_id' => $data['ciclos_idM'],
            'aula_id' => $data['aula_idM'],  
            'dia' => $data['dias'], 
        ]);
        return redirect()->route('eventos.index')->with('info','Horario agregado correctamente'); 
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

    public function sumaHUsadas($suma,$horarios){ //ESTE METODO HACE EL SUM DE SLQ
        foreach ($horarios as $item){
            $t1 = strtotime($item->startTime);
            $t2 = strtotime($item->endTime);
            $aux = gmdate('H:i:s', $t2 - $t1);

            $string = strval($aux);  
            $hor = preg_split ("[:]", $string);
            $suma = $suma + $hor[0];
            $item['HorasEspecificas'] = $hor[0];
        }
        return $suma;

    }

    public function cargaInformacion($item){
        $string = strval($item->startTime);  
        $hor = preg_split ("[:]", $string);
        $curso=Cursos::find($item->cur_id);
        $ciclo=Ciclo::find($item->ciclo_id);
        $item['H'] = $hor[0];
        $item['M'] = $hor[1];
        $item['title'] = Cursos::find($item->cur_id)->nombre_cur;
        $item['horas'] = $curso->horas;
        $item['curso'] =$curso->nombre_cur.' ('.$curso->nrc.')';
        $item['horaIni'] = $item->startTime;
        $item['horaFin'] = $item->endTime;
        $item['dia'] =  $this->tomaDia($item->daysOfWeek);
        $item['Ndia'] =  $item->daysOfWeek;
        $item['ciclo'] = $ciclo->ciclo.'  (Fecha I:   '.$ciclo->fecha_inicio.')     (Fecha F:   '.$ciclo->fecha_fin.')';
        $item['aula'] = Aulas::find($item->aula_id)->numero;
        $item['idHorario'] = $item->idHorario;

    }

    public function colorInfo($item,$color){
        switch ($color) {
            case "1":
                $item['color'] = "Blue";
                $item['textColor'] = "white";
                break;
            case "2":
                $item['color'] = "red";
                $item['textColor'] = "white";
                break;
            case "3":
                $item['color'] = "green";
                $item['textColor'] = "white";
                break;
            case "4":
                $item['color'] = "yellow";
                $item['textColor'] = "black";
                break;
            case "5":
                $item['color'] = "purple";
                $item['textColor'] = "white";
                break;
            case "6":
                $item['color'] = "lghtblue";
                $item['textColor'] = "white";
                break;
        }
    }
}
