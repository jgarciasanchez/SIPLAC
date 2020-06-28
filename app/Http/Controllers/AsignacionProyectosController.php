<?php


namespace App\Http\Controllers;

use PDF;
use App\Reportes;
use App\cursoProfesor;
use Illuminate\Http\Request;
use App\Profesores;
use Excel;
use App\Exports\ProfesoresExport;
use App\profesoresProyectos;
use Illuminate\Support\Facades\Input;
use \PhpOffice\PhpWord\IOFactory;
use Yajra\DataTables\Facades\DataTables;
use App\Proyectos;

class AsignacionProyectosController extends Controller
{

    public function index(Request $request)
    {
        return view('asignacionProyectos.index');
    }
}
