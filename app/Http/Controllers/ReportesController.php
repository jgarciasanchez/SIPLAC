<?php

namespace App\Http\Controllers;

use PDF;
use App\Reportes;
use App\cursoProfesor;
use Illuminate\Http\Request;
use App\Profesores;
use Excel;
use App\Exports\ProfesoresExport;
use App\Horarios;
use App\profesoresProyectos;
use Illuminate\Support\Facades\Input;
use \PhpOffice\PhpWord\IOFactory;
use Yajra\DataTables\Facades\DataTables;

class ReportesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $list = Profesores::all()->where('estado', '=', 'A');
        return view('Reportes.index', compact('list'));
    }

    public function create($id)
    {
        $list = cursoProfesor::id($id)->paginate(0);

        // $list = cursoProfesor::cursos("Jordan", "")
        // ->paginate(0);
        dd($list);
        // $list = Reportes::nombre("Redes")
        //     ->paginate(10);
        $pdf = PDF::loadView('Reportes.reporte2', compact('list'));
        return $pdf->stream();
    }

    public function tomaDia($i)
    {
        switch ($i) {
            case "1":
                return "L";
                break;
            case "2":
                return "M";
                break;
            case "3":
                return "I";
                break;
            case "4":
                return "J";
                break;
            case "5":
                return "V";
                break;
            case "6":
                return "S";
                break;
        }
    }

    public function semanal()
    {
        $horarios = session("horario");

        // dd($horario);
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $sectionStyle = array(
            'orientation' => 'landscape',
        );
        $section = $phpWord->addSection($sectionStyle);
        $header = array('size' => 16, 'bold' => true);


        $fancyTableStyleName = 'Fancy Table';
        $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 80, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'cellSpacing' => 0);
        $fancyTableFirstRowStyle = array('borderBottomSize' => 18, 'borderBottomColor' => '000000');
        $fancyTableCellStyle = array('valign' => 'center');
        $fancyTableFontStyle = array('bold' => true);
        $cellColSpan1 = array('gridSpan' => 3, 'valign' => 'center', 'bgColor' => 'ffda21', 'valign' => 'center');
        $cellColSpan2 = array('gridSpan' => 4, 'valign' => 'center', 'bgColor' => '358fbf', 'valign' => 'center');
        $cellColSpan3 = array('gridSpan' => 4, 'valign' => 'center', 'bgColor' => 'd6a780', 'valign' => 'center');
        $cellColSpan4 = array('gridSpan' => 2, 'valign' => 'center', 'bgColor' => 'c61521', 'valign' => 'center');
        $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);

        $nrc = 0;
        $nivel = "";
        $codigo = "";
        $curso = "";
        $grupo = "";
        $horarioS = "";
        $aula = "";
        $profesor = "";
        $lista = array();
        $horarioAux = array();
        $carrera = "";
        $band = true;
        $aux = array();
        foreach ($horarios as $horario) {
            //  dd($horarios);
            $aux = $horario;
            if ($nrc == 0) {
                $carrera = $horario->nombre;
                $nrc = $horario->nrc;
                $nivel = $horario->nivel;
                $codigo = $horario->codigo;
                $curso = $horario->nombre_cur;
                $grupo = $horario->numero;

                $horarioS = $this->tomaDia($horario->daysOfWeek) . ":" . substr($horario->startTime, 0, 5) . "-" . substr($horario->endTime, 0, 5);
                $aula = $horario->aula_num;

                $profesor = $horario->apellido1 . " " . $horario->apellido2 . " " . $horario->nombre1;
                // dd($nrc, $horarioS, $horario);
            } else if ($nrc == $horario->nrc) {
                // dd($nrc, $horario->nrc);
                $horarioS = $horarioS . "\n" . $this->tomaDia($horario->daysOfWeek) . ":" . substr($horario->startTime, 0, 5) . "-" . substr($horario->endTime, 0, 5);
                $aula = $aula . "\n" . $horario->aula_num;
                // dd($nrc, $horarioS, $horario);
            } else {
                // dd($nrc, $aula, $horarioS);
                array_push($horarioAux, $carrera);
                array_push($horarioAux, $nrc);
                array_push($horarioAux, $nivel);
                array_push($horarioAux, $codigo);
                array_push($horarioAux, $curso);
                array_push($horarioAux, $grupo);
                array_push($horarioAux, $horarioS);
                array_push($horarioAux, $aula);
                array_push($horarioAux, $profesor);
                array_push($lista, $horarioAux);
                $horarioAux = array();
                $carrera = $horario->nombre;
                $nrc = $horario->nrc;
                $nrc = $horario->nrc;
                $nivel = $horario->nivel;
                $codigo = $horario->codigo;
                $curso = $horario->nombre_cur;
                $grupo = $horario->numero;

                $horarioS = $this->tomaDia($horario->daysOfWeek) . ":" . substr($horario->startTime, 0, 5) . "-" . substr($horario->endTime, 0, 5);
                $aula = $horario->aula_num;

                $profesor = $horario->apellido1 . " " . $horario->apellido2 . " " . $horario->nombre1;
            }
        }
        if ($aux->nrc == $nrc) {
            array_push($horarioAux, $carrera);
            array_push($horarioAux, $nrc);
            array_push($horarioAux, $nivel);
            array_push($horarioAux, $codigo);
            array_push($horarioAux, $curso);
            array_push($horarioAux, $grupo);
            array_push($horarioAux, $horarioS);
            array_push($horarioAux, $aula);
            array_push($horarioAux, $profesor);
            array_push($lista, $horarioAux);
        }

        //  dd($lista);

        $grupoActual = 0;

        for ($i = 0; $i < count($lista); $i++) {
            if ($grupoActual == 0) {
                $section->addText("Carrera:" . "  " . $lista[$i][0], $header);
                $grupoActual = $lista[$i][5];
                $table = $section->addTable($fancyTableStyleName);
                $table->addRow(450);
                $table->addCell(2000, $fancyTableCellStyle)->addText('Nivel', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('NRC', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('Codigo', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('Curso', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('Grupo', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('Horario', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('Aula', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('Profesor', $fancyTableFontStyle);
            } else if ($grupoActual != $lista[$i][5]) {
                $section->addPageBreak();
                $section->addText($lista[$i][0], $header);
                $grupoActual = $lista[$i][5];
                $table = $section->addTable($fancyTableStyleName);
                $table->addRow(900);
                $table->addCell(2000, $fancyTableCellStyle)->addText('Nivel', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('NRC', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('Codigo', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('Curso', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('Grupo', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('Horario', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('Aula', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('Profesor', $fancyTableFontStyle);
            }

            $table->addRow(900);
            $table->addCell(2000)->addText($lista[$i][2]);
            $table->addCell(2000)->addText($lista[$i][1]);
            $table->addCell(2000)->addText($lista[$i][3]);
            $table->addCell(2000)->addText($lista[$i][4]);
            $table->addCell(2000)->addText($lista[$i][5]);
            $table->addCell(2000)->addText($lista[$i][6]);
            $table->addCell(2000)->addText($lista[$i][7]);
            $table->addCell(2000)->addText($lista[$i][8]);
        }


        $objectWriter = IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objectWriter->save(storage_path('TestWordFile.docx'));
        } catch (Exception $e) {
        }

        return response()->download(storage_path('TestWordFile.docx'));
    }

    public function datos($ids)
    {
        $idsA = explode(",", $ids);
        $datos = array();
        $info = array();
        array_push($info, "1");
        array_push($info, "1");
        array_push($info, "1");
        $band = false;
        $profesores = array();
        $jornadas = array();
        $arrayProyectos = array();
        $arrayCursos = array();
        foreach ($idsA as $id) {
            $jornadaC = 0;
            $band = false;
            $proyectos = null;
            $cursos = null;
            $profesor = Profesores::ced($id)->paginate(99999999);
            array_push($profesores, $profesor);
            foreach ($profesor as $prof) {
                $id = $prof->id;
            }
            $listProfP = Profesores::proyectoJoinID($id)->paginate(99999999);
            foreach ($listProfP as $item) {
                if ($item->proy_id != null) {
                    $band = true;
                }
            }
            if ($band) {
                $proyectos = profesoresProyectos::id($id)->paginate(99999999);
            }
            array_push($arrayProyectos, $proyectos);
            $band = false;
            $listProfC = Profesores::cursoJoinID($id)->paginate(99999999);
            foreach ($listProfC as $item) {
                if ($item->cur_id != null)
                    $band = true;
            }
            if ($band) {
                $cursos = cursoProfesor::id($id)->paginate(99999999);
                // dd($cursos);
                foreach ($cursos as $item) {
                    $jornadaC += $item->horas_contacto;
                }
            }
            array_push($jornadas, $jornadaC);
            array_push($arrayCursos, $cursos);
        }
        array_push($datos, $profesores);
        array_push($datos, $arrayCursos);
        array_push($datos, $arrayProyectos);
        array_push($datos, $jornadas);
        array_push($datos, $ids);
        array_push($datos, $info);
        return $datos;
    }

    public function updateReporte2(Request $request, $ids)
    {
        $idsA = explode(",", $ids);
        $plaNom = $request->get('plaNom');
        $fecha_ini = $request->get('fecha_ini');
        $fecha_fin = $request->get('fecha_fin');
        $info = array();
        array_push($info, $plaNom);
        array_push($info, $fecha_ini);
        array_push($info, $fecha_fin);

        $band = false;
        $profesores = array();
        $jornadas = array();
        $arrayProyectos = array();
        $arrayCursos = array();
        foreach ($idsA as $id) {
            $jornadaC = 0;
            $band = false;
            $proyectos = null;
            $cursos = null;
            $profesor = Profesores::ced($id)->paginate(99999999);
            array_push($profesores, $profesor);
            foreach ($profesor as $prof) {
                $id = $prof->id;
            }
            $listProfP = Profesores::proyectoJoinID($id)->paginate(99999999);
            foreach ($listProfP as $item) {
                if ($item->proy_id != null) {
                    $band = true;
                }
            }
            if ($band) {
                $proyectos = profesoresProyectos::id($id)->paginate(99999999);
            }
            array_push($arrayProyectos, $proyectos);
            $band = false;
            $listProfC = Profesores::cursoJoinID($id)->paginate(99999999);
            foreach ($listProfC as $item) {
                if ($item->cur_id != null)
                    $band = true;
            }
            if ($band) {
                $cursos = cursoProfesor::id($id)->paginate(99999999);
                // dd($cursos);
                foreach ($cursos as $item) {
                    $jornadaC += $item->horas_contacto;
                }
            }
            array_push($jornadas, $jornadaC);
            array_push($arrayCursos, $cursos);
        }
        $count = count($profesores);
        // dd($info);
        return view('Reportes.reporte2', compact('arrayCursos', 'arrayProyectos', 'profesores', 'jornadas', 'ids', 'info'));
    }

    public function infoReporte(Request $request, $ids, $op, $tp)
    {
        $arrayDatos = $this->datos($ids);
        $profesores = $arrayDatos[0];
        $arrayCursos = $arrayDatos[1];
        $arrayProyectos = $arrayDatos[2];
        $jornadas = $arrayDatos[3];
        $ids = $arrayDatos[4];
        $info = $arrayDatos[5];
        $count = count($profesores);
        if ($op == 1) {
            if ($tp == 1) {
                return view('Reportes.reporte1', compact('arrayCursos', 'arrayProyectos', 'profesores', 'jornadas', 'ids'));
            } else if ($tp == 2) {
                return view('Reportes.reporte2', compact('arrayCursos', 'arrayProyectos', 'profesores', 'jornadas', 'ids', 'info'));
            } else if ($tp == 3) {
                // dd("vista");
                return view('Reportes.reporte3', compact('arrayCursos', 'arrayProyectos', 'profesores', 'jornadas'));
            } else {
                return view('Reportes.reporte4', compact('arrayCursos', 'profesores', 'ids'));
            }
        } elseif ($op == "2") {
            if ($tp == "1") {
                $phpWord = new \PhpOffice\PhpWord\PhpWord();
                $sectionStyle = array(
                    'orientation' => 'landscape',
                );
                $section = $phpWord->addSection($sectionStyle);
                $header = array('size' => 16, 'bold' => true);

                $section->addTextBreak(1);


                $fancyTableStyleName = 'Fancy Table';
                $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 80, 'alignment' => 'LEFT', 'cellSpacing' => 0);
                $fancyTableFirstRowStyle = array('borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF');
                $fancyTableCellStyle = array('valign' => 'center');
                $fancyTableFontStyle = array('bold' => true);
                $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center');
                $cellRowContinue = array('vMerge' => 'continue');
                $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);

                for ($i = 0; $i < count($profesores); $i++) {
                    foreach ($profesores[$i] as $prof) {
                        $section->addText($prof->nombre1 . " " . $prof->apellido1, $header);
                        if ($arrayCursos[$i] != null) {
                            $table = $section->addTable($fancyTableStyleName);
                            $table->addRow(900);
                            $table->addCell(2000, $fancyTableCellStyle)->addText('Nombre del curso', $fancyTableFontStyle);
                            $table->addCell(2000, $fancyTableCellStyle)->addText('Código', $fancyTableFontStyle);
                            $table->addCell(2000, $fancyTableCellStyle)->addText('NRC', $fancyTableFontStyle);
                            $table->addCell(2000, $fancyTableCellStyle)->addText('Grupo', $fancyTableFontStyle);
                            $table->addCell(2000, $fancyTableCellStyle)->addText('Créditos', $fancyTableFontStyle);
                            $table->addCell(2000, $fancyTableCellStyle)->addText('Horas Contacto', $fancyTableFontStyle);
                            $table->addCell(2000, $fancyTableCellStyle)->addText('Jornada', $fancyTableFontStyle);
                            $band = true;
                            foreach ($arrayCursos[$i] as $curso) {
                                $table->addRow();
                                $table->addCell(2000)->addText("{$curso->nombre_cur}");
                                $table->addCell(2000)->addText("{$curso->codigo}");
                                $table->addCell(2000)->addText("{$curso->nrc}");
                                $table->addCell(2000)->addText("{$curso->numero}");
                                $table->addCell(2000)->addText("{$curso->creditos}");
                                $table->addCell(2000)->addText("{$curso->horas_contacto}");
                                $count = count($arrayCursos[$i]);
                                if ($band) {
                                    $text = "";
                                    if ($jornadas[$i] <= 5)
                                        $text = "1/4 TC (10 hrs)";
                                    elseif ($jornadas[$i] <= 8)
                                        $text = "1/2 TC (20 hrs)";
                                    elseif ($jornadas[$i] <= 11)
                                        $text = "3/4 TC (30 hrs)";
                                    else
                                        $text = "TC (40 hrs)";
                                    $table->addCell(2000, $cellRowSpan)->addText($text);
                                    $band = false;
                                } else {
                                    $table->addCell(2000, $cellRowContinue);
                                }
                            }
                        }
                        if ($arrayProyectos[$i] != null) {
                            // dd($arrayProyectos);
                            $section->addText('Proyectos', $header);
                            $table = $section->addTable($fancyTableStyleName);
                            $table->addRow(900);
                            $table->addCell(2000, $fancyTableCellStyle)->addText('Nombre del proyecto', $fancyTableFontStyle);
                            $table->addCell(2000, $fancyTableCellStyle)->addText('Código SIA', $fancyTableFontStyle);
                            $table->addCell(2000, $fancyTableCellStyle)->addText('Jornada', $fancyTableFontStyle);
                            foreach ($arrayProyectos[$i] as $proy) {
                                $table->addRow();
                                $table->addCell(2000)->addText("{$proy->nombre}");
                                $table->addCell(2000)->addText("{$proy->codigo_sia}");
                                $table->addCell(2000)->addText("{$proy->codigo_sia}");
                            }
                        }
                    }
                }
                $objectWriter = IOFactory::createWriter($phpWord, 'Word2007');
                try {
                    $objectWriter->save(storage_path('TestWordFile.docx'));
                } catch (Exception $e) {
                }

                return response()->download(storage_path('TestWordFile.docx'));
            } else  if ($tp == 3) {
                $phpWord = new \PhpOffice\PhpWord\PhpWord();
                $sectionStyle = array(
                    'orientation' => 'landscape',
                );
                $section = $phpWord->addSection($sectionStyle);
                $header = array('size' => 16, 'bold' => true);

                // 2. Advanced table
                $section->addTextBreak(1);
                $section->addText('Fancy table', $header);

                $fancyTableStyleName = 'Fancy Table';
                $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 80, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'cellSpacing' => 0);
                $fancyTableFirstRowStyle = array('borderBottomSize' => 18, 'borderBottomColor' => '000000');
                $fancyTableCellStyle = array('valign' => 'center');
                $fancyTableFontStyle = array('bold' => true);
                $cellColSpan1 = array('gridSpan' => 3, 'valign' => 'center', 'bgColor' => 'ffda21', 'valign' => 'center');
                $cellColSpan2 = array('gridSpan' => 4, 'valign' => 'center', 'bgColor' => '358fbf', 'valign' => 'center');
                $cellColSpan3 = array('gridSpan' => 4, 'valign' => 'center', 'bgColor' => 'd6a780', 'valign' => 'center');
                $cellColSpan4 = array('gridSpan' => 2, 'valign' => 'center', 'bgColor' => 'c61521', 'valign' => 'center');
                $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
                $table = $section->addTable($fancyTableStyleName);
                $table->addRow(450);
                $table->addCell(2000, $cellColSpan1)->addText('Propietarios');
                $table->addCell(2000, $cellColSpan2)->addText('I Ciclo');
                $table->addCell(2000, $cellColSpan3)->addText('II Ciclo');
                $table->addCell(2000, $cellColSpan4)->addText('Consolidacion Anual');
                $table->addRow(900);
                $table->addCell(2000, $fancyTableCellStyle)->addText('Categoria', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('Profesores', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('Horas contexto', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('Jornada', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('Jornada ', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('Horas', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('H. contacto', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('Jornada', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('Jornada sustitucion', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('Horas', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('H. contacto', $fancyTableFontStyle);
                $table->addCell(2000, $fancyTableCellStyle)->addText('Horas', $fancyTableFontStyle);


                $objectWriter = IOFactory::createWriter($phpWord, 'Word2007');
                try {
                    $objectWriter->save(storage_path('TestWordFile.docx'));
                } catch (Exception $e) {
                }

                return response()->download(storage_path('TestWordFile.docx'));
            } else {
                $phpWord = new \PhpOffice\PhpWord\PhpWord();
                $sectionStyle = array(
                    'orientation' => 'landscape',
                );
                $section = $phpWord->addSection($sectionStyle);
                $header = array('size' => 16, 'bold' => true);

                $section->addText('UNIVERSIDAD NACIONAL<w:br />SEDE REGIONAL BRUNCA<w:br />CAMPUS PÉREZ ZELEDÓN<w:br />DIRECCIÓN ACADÉMICA', $header);

                $fancyTableStyleName = 'Fancy Table';
                $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 80, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'cellSpacing' => 0);
                $fancyTableFirstRowStyle = array('borderBottomSize' => 18, 'borderBottomColor' => '000000');
                $fancyTableCellStyle = array('valign' => 'center');
                $fancyTableFontStyle = array('bold' => true);
                $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
                $table = $section->addTable($fancyTableStyleName);
                $table->addRow(450);
                $table->addCell(2000, array('gridSpan' => 8, 'vMerge' => 'restart'))->addText('ENTREGA PROGRAMAS DEL ? CICLO ?');
                $table->addRow(450);
                $table->addCell(2000)->addText('Profesor');
                $table->addCell(2000)->addText('Código');
                $table->addCell(2000)->addText('NRC');
                $table->addCell(2000)->addText('Grupo');
                $table->addCell(2000)->addText('Curso');
                $table->addCell(2000)->addText('Digital');
                $table->addCell(2000)->addText('Fecha impreso');
                $table->addCell(2000)->addText('Firma');
                for ($i = 0; $i < count($profesores); $i++) {
                    foreach ($profesores[$i] as $prof) {
                        if ($arrayCursos[$i] != null) {
                            foreach ($arrayCursos[$i] as $curso) {
                                $table->addRow();
                                $table->addCell(2000)->addText("{$prof->nombre1} {$prof->apellido1} {$prof->apellido2}");
                                $table->addCell(2000)->addText("{$curso->codigo}");
                                $table->addCell(2000)->addText("{$curso->nrc}");
                                $table->addCell(2000)->addText("{$curso->numero}");
                                $table->addCell(2000)->addText("{$curso->nombre_cur}");
                                $table->addCell(2000)->addText("");
                                $table->addCell(2000)->addText("");
                                $table->addCell(2000)->addText("");
                            }
                        }
                    }
                }



                $objectWriter = IOFactory::createWriter($phpWord, 'Word2007');
                try {
                    $objectWriter->save(storage_path('TestWordFile.docx'));
                } catch (Exception $e) {
                }

                return response()->download(storage_path('TestWordFile.docx'));
            }
        }
    }

    public function reporte2($ids, $fecI, $fecF, $inf)
    {
        // dd($ids);
        $datos = $this->datos($ids);
        $profesores = $datos[0];
        $arrayCursos = $datos[1];
        $arrayProyectos = $datos[2];
        $jornadas = $datos[3];
        $ids = $datos[4];

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $sectionStyle = array(
            'orientation' => 'landscape',
        );
        $section = $phpWord->addSection($sectionStyle);
        $header = array('size' => 16, 'bold' => true);

        // 2. Advanced table
        $section->addTextBreak(1);
        $section->addText('Fancy table', $header);

        $fancyTableStyleName = 'Fancy Table';
        $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 80, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'cellSpacing' => 0);
        $fancyTableFirstRowStyle = array('borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF');
        $fancyTableCellStyle = array('valign' => 'center');
        $fancyTableFontStyle = array('bold' => true);
        $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
        $table = $section->addTable($fancyTableStyleName);
        $table->addRow(900);
        $table->addCell(2000, $fancyTableCellStyle)->addText('Nombre Completo', $fancyTableFontStyle);
        $table->addCell(2000, $fancyTableCellStyle)->addText('Cedula', $fancyTableFontStyle);
        $table->addCell(2000, $fancyTableCellStyle)->addText('Vigencia de nombramiento', $fancyTableFontStyle);
        $table->addCell(2000, $fancyTableCellStyle)->addText('Jornada de contratacion', $fancyTableFontStyle);
        $table->addCell(2000, $fancyTableCellStyle)->addText('Informacion curso/proyecto', $fancyTableFontStyle);
        $table->addCell(2000, $fancyTableCellStyle)->addText('Plaza y codigo presupuestario', $fancyTableFontStyle);
        $table->addCell(2000, $fancyTableCellStyle)->addText('Tipo de nombramiento', $fancyTableFontStyle);

        // dd(count($profesores));
        for ($i = 0; $i < count($profesores); $i++) {
            foreach ($profesores[$i] as $prof) {
                $band = true;
                $count = 0;
                if ($arrayCursos[$i] != null) {
                    $count += count($arrayCursos[$i]);
                }
                if ($arrayProyectos[$i] != null) {
                    $count += count($arrayProyectos[$i]);
                }
                $row = $table->addRow();
                $row->addCell(2000, array('vMerge' => 'restart'))->addText("{$prof->nombre1} {$prof->apellido1} {$prof->apellido2}");
                $row->addCell(2000, array('vMerge' => 'restart'))->addText("{$prof->cedula}");
                $jor = "";
                if ($jornadas[$i] <= 5) {
                    $jor = "1/4 TC (10 hrs)";
                } else if ($jornadas[$i] <= 8) {
                    $jor = "1/2 TC (20 hrs)";
                } else if ($jornadas[$i] <= 11) {
                    $jor = "3/4 TC (30 hrs)";
                } else {
                    $jor = "TC (40 hrs)";
                }

                if ($arrayCursos[$i] != null) {
                    foreach ($arrayCursos[$i] as $item) {
                        if ($band) {
                            if ($fecI != "1" && $fecI != "1") {
                                $row->addCell(2000)->addText("del " . $fecI . " al " . $fecF);
                            } else {
                                $row->addCell(2000);
                            }
                            $row->addCell(2000, array('vMerge' => 'restart'))->addText($jor);
                            $lista = "Nombre: {$item->nombre_cur}<w:br />Codigo: {$item->codigo}<w:br />NRC: {$item->nrc}<w:br />Grupo: {$item->numero}<w:br />Creditos: {$item->creditos}<w:br />Contacto: {$item->horas_contacto}<w:br />";
                            $table->addCell(2000)->addText($lista);
                            if ($inf != "1") {
                                $table->addCell(2000)->addText($inf);
                            } else {
                                $row->addCell(2000);
                            }
                            if ($item->tipo_asingnacion == "P") {
                                $table->addCell(2000)->addText("Plaza permanente");
                            } else if ($item->tipo_asingnacion == "P2") {
                                $table->addCell(2000)->addText("Plaza permanente 2");
                            } else {
                                $table->addCell(2000)->addText("Plaza suplente");
                            }
                            $band = false;
                        } else {
                            $row = $table->addRow();
                            $row->addCell(2000, array('vMerge' => 'continue'));
                            $row->addCell(2000, array('vMerge' => 'continue'));
                            if ($inf != "1") {
                                $table->addCell(2000)->addText($inf);
                            } else {
                                $row->addCell(2000);
                            }
                            $row->addCell(2000, array('vMerge' => 'continue'));
                            $lista = "Curso: {$item->nombre_cur}<w:br />Codigo: {$item->codigo}<w:br />NRC: {$item->nrc}<w:br />Grupo: {$item->numero}<w:br />Creditos: {$item->creditos}<w:br />Contacto: {$item->horas_contacto}<w:br />";
                            $table->addCell(2000)->addText($lista);
                            if ($inf != "1") {
                                $table->addCell(2000)->addText($inf);
                            } else {
                                $row->addCell(2000);
                            }
                            if ($item->tipo_asingnacion == "P") {
                                $table->addCell(2000)->addText("Permanente");
                            } else {
                                $table->addCell(2000)->addText("Suplente");
                            }
                        }
                    }
                }

                if ($arrayProyectos[$i] != null) {
                    foreach ($arrayProyectos[$i] as $proy) {
                        if ($band) {
                            if ($fecI != "1" && $fecI != "1") {
                                $row->addCell(2000)->addText("del " . $fecI . " al " . $fecF);
                            } else {
                                $row->addCell(2000);
                            }
                            $row->addCell(2000, array('vMerge' => 'restart'))->addText($jor);
                            $lista = "Proyecto: {$proy->nombre}<w:br />Codigo SIA: {$proy->codigo_sia}<w:br />";
                            $table->addCell(2000)->addText($lista);
                            if ($inf != "1") {
                                $table->addCell(2000)->addText($inf);
                            } else {
                                $row->addCell(2000);
                            }
                            $table->addCell(2000)->addText("Plazo fijo");
                        } else {
                            $row = $table->addRow();
                            $row->addCell(2000, array('vMerge' => 'continue'));
                            $row->addCell(2000, array('vMerge' => 'continue'));
                            if ($fecI != "1" && $fecI != "1") {
                                $row->addCell(2000)->addText("del " . $fecI . " al " . $fecF);
                            } else {
                                $row->addCell(2000);
                            }
                            $row->addCell(2000, array('vMerge' => 'continue'));
                            $lista = "Proyecto: {$proy->nombre}<w:br />Codigo SIA: {$proy->codigo_sia}<w:br />";
                            $table->addCell(2000)->addText($lista);
                            if ($inf != "1") {
                                $table->addCell(2000)->addText($inf);
                            } else {
                                $row->addCell(2000);
                            }
                            $table->addCell(2000)->addText("Plazo fijo");
                        }
                    }
                }
                if ($arrayProyectos[$i] == null && $arrayCursos[$i] == null) {
                    $row->addCell(2000)->addText("");
                    $row->addCell(2000)->addText("");
                    $row->addCell(2000)->addText("");
                    $row->addCell(2000)->addText("");
                    $row->addCell(2000)->addText("");
                }
            }
        }


        $objectWriter = IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objectWriter->save(storage_path('TestWordFile.docx'));
        } catch (Exception $e) {
        }

        return response()->download(storage_path('TestWordFile.docx'));
    }

    public function excel()
    {
        return Excel::download(new ProfesoresExport, 'Profesores.xlsx');
    }
}
