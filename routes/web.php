<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\ReportesController;

Route::get('/', function () {
	return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('/inicio', 'HomeController@inicio')->name('inicio');

//-------------------------Ayuda------------------------------
Route::get('ayuda', 'HomeController@ayuda')->name('home.ayuda');
Route::get('ayuda/usuario', 'HomeController@usuario')->name('ayuda.usuario');
Route::get('ayuda/profesor', 'HomeController@profesor')->name('ayuda.profesor');
Route::get('ayuda/aula', 'HomeController@aula')->name('ayuda.aula');
Route::get('ayuda/curso', 'HomeController@curso')->name('ayuda.curso');
Route::get('ayuda/proyecto', 'HomeController@proyecto')->name('ayuda.proyecto');
Route::get('ayuda/ciclo', 'HomeController@ciclo')->name('ayuda.ciclo');
Route::get('ayuda/carrera', 'HomeController@carrera')->name('ayuda.carrera');
Route::get('ayuda/cursosCarrera', 'HomeController@cursosCarrera')->name('ayuda.cursosCarrera');
Route::get('ayuda/grupo', 'HomeController@grupo')->name('ayuda.grupo');
Route::get('ayuda/horario', 'HomeController@horario')->name('ayuda.horario');
Route::get('ayuda/reporte', 'HomeController@reporte')->name('ayuda.reporte');
Route::get('ayuda/backups', 'HomeController@backups')->name('ayuda.backups');
Route::get('ayuda/bitacora', 'HomeController@bitacora')->name('ayuda.bitacora');





// Route::resource('profesores','ProfesorController');
//esta parte realiza las validaciones de los permisos sobre cada ruta
Route::middleware(['auth'])->group(function () {
	//usuarios
	Route::get('/listaUsuarios', 'UsuariosController@listar')->name('listaUsuarios')
		->middleware('permission:listar');

	Route::post('usuario/store', 'UsuariosController@store')->name('usuarios.store')
		->middleware('permission:usuarios.create');

	Route::get('usuario', 'UsuariosController@index')->name('usuarios.index')
		->middleware('permission:usuarios.index');

	Route::get('usuario/create', 'UsuariosController@create')->name('usuarios.create')
		->middleware('permission:usuarios.create');

	Route::put('usuario/{a}', 'UsuariosController@update')->name('usuarios.update')
		->middleware('permission:usuarios.edit');

	Route::get('usuario/{a}', 'UsuariosController@show')->name('usuarios.show')
		->middleware('permission:usuarios.show');

	Route::delete('usuario/{a}', 'UsuariosController@destroy')->name('usuarios.destroy')
		->middleware('permission:usuarios.destroy');

	Route::get('usuario/{a}/edit', 'UsuariosController@edit')->name('usuarios.edit')
		->middleware('permission:usuarios.edit');

//roles
	Route::post('roles/store', 'RoleController@store')->name('roles.store')
		->middleware('permission:roles.create');

	Route::get('roles', 'RoleController@index')->name('roles.index')
		->middleware('permission:roles.index');

	Route::get('roles/create', 'RoleController@create')->name('roles.create')
		->middleware('permission:roles.create');

	Route::put('roles/{role}', 'RoleController@update')->name('roles.update')
		->middleware('permission:roles.edit');

	Route::get('roles/{role}', 'RoleController@show')->name('roles.show')
		->middleware('permission:roles.show');

	Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')
		->middleware('permission:roles.destroy');

	Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')
		->middleware('permission:roles.edit');

	//profesores
	Route::post('profesores/store', 'ProfesorController@store')->name('profesores.store')
		->middleware('permission:profesores.create');

	Route::get('profesores', 'ProfesorController@index')->name('profesores.index')
		->middleware('permission:profesores.index');

	Route::get('profesores/create', 'ProfesorController@create')->name('profesores.create')
		->middleware('permission:profesores.create');

	Route::put('profesores/{a}', 'ProfesorController@update')->name('profesores.update')
		->middleware('permission:profesores.edit');

	Route::get('profesores/{a}', 'ProfesorController@show')->name('profesores.show')
		->middleware('permission:profesores.show');

	Route::delete('profesores/{a}', 'ProfesorController@destroy')->name('profesores.destroy')
		->middleware('permission:profesores.destroy');

	Route::get('profesores/{a}/edit', 'ProfesorController@edit')->name('profesores.edit')
		->middleware('permission:profesores.edit');

	//cursos
	Route::post('cursos/store', 'CursosController@store')->name('cursos.store')
		->middleware('permission:cursos.create');

	Route::get('cursos', 'CursosController@index')->name('cursos.index')
		->middleware('permission:cursos.index');

	Route::get('cursos/create', 'CursosController@create')->name('cursos.create')
		->middleware('permission:cursos.create');

	Route::put('cursos/{a}', 'CursosController@update')->name('cursos.update')
		->middleware('permission:cursos.edit');

	Route::get('cursos/{a}', 'CursosController@show')->name('cursos.show')
		->middleware('permission:cursos.show');

	Route::delete('cursos/{a}', 'CursosController@destroy')->name('cursos.destroy')
		->middleware('permission:cursos.destroy');

	Route::get('cursos/{a}/edit', 'CursosController@edit')->name('cursos.edit')
		->middleware('permission:cursos.edit');

	Route::get('/listaCursos', 'CursosController@listar')->name('listaCursos')
		->middleware('permission:listaCursos');

	Route::get('estadoGrupo/{idCurso}/{idGrupo}', 'CursosController@estadoGrupo')->name('estadoGrupo')
		->middleware('permission:estadoGrupo');

	Route::get('editRelations/{idCurso}', 'CursosController@editRelations')->name('editRelations')
		->middleware('permission:editRelations');

	Route::get('estadoCarrera/{idCurso}/{idCarrera}', 'CursosController@estadoCarrera')->name('estadoCarrera')->middleware('permission:estadoCarrera');

	Route::get('next/{act}/{id}', 'CursosController@next')->name('next')
		->middleware('permission:next');

	Route::get('carrerasData', 'CursosController@carrerasData')->name('carrerasData')
		->middleware('permission:carrerasData');


	Route::get('gruposData', 'CursosController@gruposData')->name('gruposData')
	->middleware('permission:gruposData');

	//-------------------------Aulas-----------------------------------

	Route::post('aulas/store', 'AulasController@store')->name('aulas.store')
		->middleware('permission:aulas.create');

	Route::get('aulas', 'AulasController@index')->name('aulas.index')
		->middleware('permission:aulas.index');

	Route::get('aulas/create', 'AulasController@create')->name('aulas.create')
		->middleware('permission:aulas.create');

	Route::put('aulas/{a}', 'AulasController@update')->name('aulas.update')
		->middleware('permission:aulas.edit');

	Route::get('aulas/{a}', 'AulasController@show')->name('aulas.show')
		->middleware('permission:aulas.show');

	Route::delete('aulas/{a}', 'AulasController@destroy')->name('aulas.destroy')
		->middleware('permission:aulas.destroy');

	Route::get('aulas/{a}/edit', 'AulasController@edit')->name('aulas.edit')
		->middleware('permission:aulas.edit');

	//------------------------BITACORA-----------------------------------
	Route::get('bitacora', 'BitacoraController@index')->name('bitacora.index')
		->middleware('permission:bitacora.index');

	//------------------------backups-----------------------------------

	Route::post('backups/store', 'BackupController@store')->name('backups.store')
		->middleware('permission:backups.create');

	Route::get('backups', 'BackupController@index')->name('backups.index')
		->middleware('permission:backups.index');

	Route::get('backups/create', 'BackupController@create')->name('backups.create')
		->middleware('permission:backups.create');

	Route::put('backups/{a}', 'BackupController@update')->name('backups.update')
		->middleware('permission:backups.edit');

	Route::get('backups/{a}', 'BackupController@show')->name('backups.show')
		->middleware('permission:backups.show');

	Route::delete('backups/{a}', 'BackupController@destroy')->name('backups.destroy')
		->middleware('permission:backups.destroy');

	Route::get('backups/{a}/edit', 'BackupController@edit')->name('backups.edit')
		->middleware('permission:backups.edit');

	Route::get('backups/{a}', 'BackupController@download')->name('backups.download')
	->middleware('permission:backups.download');

	//-------------------------REPORTES------------------------------
	// Route::resource('reportes','ReportesController');

	Route::get('reportes', 'ReportesController@index')->name('reportes.index')
		->middleware('permission:backups.index');

	Route::get('reporte2/{id}/{fecI}/{fecf}/{inf}', 'ReportesController@reporte2')->name('reporte2');
	
	Route::get('profesoresDataReportes', 'ReportesController@profesoresDataReportes')->name('profesoresDataReportes');
	

	Route::get('reporte', 'ReportesController@reporte')->name('reporte')
	->middleware('permission:reporte.reporte');

	Route::get('infoReporte/{id}/{op}/{tp}', 'ReportesController@infoReporte')->name('infoReporte')
	->middleware('permission:infoReporte.infoReporte');

	Route::get('excel', 'ReportesController@excel')->name('excel')
	->middleware('permission:excel.excel');

	Route::post('updateReporte2/{ids}', 'ReportesController@updateReporte2')->name('updateReporte2')
	->middleware('permission:updateReporte2.updateReporte2');

	Route::get('semanal', 'ReportesController@semanal')->name('semanal')
	->middleware('permission:semanal.semanal');

	//-------------------------CARRERAS-----------------------------------
	Route::get('/listaCarreras', 'CarrerasController@listar')->name('listaCarreras')
		->middleware('permission:listaCarreras');

	Route::post('carrera/store', 'CarrerasController@store')->name('carrera.store')
		->middleware('permission:carrera.create');

	Route::get('carrera', 'CarrerasController@index')->name('carrera.index')
		->middleware('permission:carrera.index');

	Route::get('carrera/create', 'CarrerasController@create')->name('carrera.create')
		->middleware('permission:carrera.create');

	Route::put('carrera/{a}', 'CarrerasController@update')->name('carrera.update')
		->middleware('permission:carrera.edit');

	Route::get('carrera/{a}', 'CarrerasController@show')->name('carrera.show')
		->middleware('permission:carrera.show');

	Route::delete('carrera/{a}', 'CarrerasController@destroy')->name('carrera.destroy')
		->middleware('permission:carrera.destroy');

	Route::get('carrera/{a}/edit', 'CarrerasController@edit')->name('carrera.edit')
		->middleware('permission:carrera.edit');

	//-------------------------AREA ACADEMICA-----------------------------------

	Route::post('areaacademica/store', 'AreaAcademicaController@store')->name('areaacademica.store')
		->middleware('permission:areaacademica.create');

	Route::get('areaacademica', 'AreaAcademicaController@index')->name('areaacademica.index')
		->middleware('permission:areaacademica.index');

	Route::get('areaacademica/create', 'AreaAcademicaController@create')->name('areaacademica.create')
		->middleware('permission:areaacademica.create');

	Route::put('areaacademica/{a}', 'AreaAcademicaController@update')->name('areaacademica.update')
		->middleware('permission:areaacademica.edit');

	Route::get('areaacademica/{a}', 'AreaAcademicaController@show')->name('areaacademica.show')
		->middleware('permission:areaacademica.show');

	Route::delete('areaacademica/{a}', 'AreaAcademicaController@destroy')->name('areaacademica.destroy')
		->middleware('permission:areaacademica.destroy');

	Route::get('areaacademica/{a}/edit', 'AreaAcademicaController@edit')->name('areaacademica.edit')
		->middleware('permission:areaacademica.edit');

	//-------------------------CICLO------------------------------
	Route::get('/listaCiclo', 'CicloController@listar')->name('listaCiclo')
		->middleware('permission:listaCiclo');

	Route::post('ciclo/store', 'CicloController@store')->name('ciclo.store')
		->middleware('permission:ciclo.create');

	Route::get('ciclo', 'CicloController@index')->name('ciclo.index')
		->middleware('permission:ciclo.index');

	Route::get('ciclo/create', 'CicloController@create')->name('ciclo.create')
		->middleware('permission:ciclo.create');

	Route::put('ciclo/{a}', 'CicloController@update')->name('ciclo.update')
		->middleware('permission:ciclo.edit');

	Route::get('ciclo/{a}', 'CicloController@show')->name('ciclo.show')
		->middleware('permission:ciclo.show');

	Route::delete('ciclo/{a}', 'CicloController@destroy')->name('ciclo.destroy')
		->middleware('permission:ciclo.destroy');

	Route::get('ciclo/{a}/edit', 'CicloController@edit')->name('ciclo.edit')
		->middleware('permission:ciclo.edit');


		//-------------------------GRUPOS------------------------------

	Route::get('/listaGrupos', 'GruposController@listar')->name('listaGrupos')
		->middleware('permission:listaGrupos');

	Route::post('grupos/store', 'GruposController@store')->name('grupos.store')
		->middleware('permission:grupos.create');

	Route::get('grupos', 'GruposController@index')->name('grupos.index')
		->middleware('permission:grupos.index');

	Route::get('grupos/create', 'GruposController@create')->name('grupos.create')
		->middleware('permission:grupos.create');

	Route::put('grupos/{a}', 'GruposController@update')->name('grupos.update')
		->middleware('permission:grupos.edit');

	Route::get('grupos/{a}', 'GruposController@show')->name('grupos.show')
		->middleware('permission:grupos.show');

	Route::delete('grupos/{a}', 'GruposController@destroy')->name('grupos.destroy')
		->middleware('permission:grupos.destroy');

	Route::get('grupos/{a}/edit', 'GruposController@edit')->name('grupos.edit')
		->middleware('permission:grupos.edit');

//-------------------------CURSOS_CARRERAS------------------------------

	Route::post('cursosCarrera/store', 'CursosCarreraController@store')->name('cursosCarrera.store')
		->middleware('permission:cursosCarrera.create');

	Route::get('cursosCarrera', 'CursosCarreraController@index')->name('cursosCarrera.index')
		->middleware('permission:cursosCarrera.index');

	Route::get('cursosCarrera/create', 'CursosCarreraController@create')->name('cursosCarrera.create')
		->middleware('permission:cursosCarrera.create');

	Route::put('cursosCarrera/{a}', 'CursosCarreraController@update')->name('cursosCarrera.update')
		->middleware('permission:cursosCarrera.edit');

	Route::get('cursosCarrera/{a}', 'CursosCarreraController@show')->name('cursosCarrera.show')
		->middleware('permission:cursosCarrera.show');

	Route::delete('cursosCarrera/{a}', 'CursosCarreraController@destroy')->name('cursosCarrera.destroy')
		->middleware('permission:cursosCarrera.destroy');

	Route::get('cursosCarrera/{a}/edit', 'CursosCarreraController@edit')->name('cursosCarrera.edit')
		->middleware('permission:cursosCarrera.edit');

	//-------------------------PROYECTOS------------------------------
	Route::resource('proyectos', 'ProyectosController');

	Route::post('proyectos/store', 'ProyectosController@store')->name('proyectos.store')
		->middleware('permission:proyectos.create');

	Route::get('proyectos', 'ProyectosController@index')->name('proyectos.index')
		->middleware('permission:proyectos.index');

	Route::get('proyectos/create', 'ProyectosController@create')->name('proyectos.create')
		->middleware('permission:proyectos.create');

	Route::put('proyectos/{a}', 'ProyectosController@update')->name('proyectos.update')
		->middleware('permission:proyectos.edit');

	Route::get('proyectos/{a}', 'ProyectosController@show')->name('proyectos.show')
		->middleware('permission:proyectos.show');

	Route::delete('proyectos/{a}', 'ProyectosController@destroy')->name('proyectos.destroy')
		->middleware('permission:proyectos.destroy');

	Route::get('proyectos/{a}/edit', 'ProyectosController@edit')->name('proyectos.edit')
		->middleware('permission:proyectos.edit');

	Route::get('profesoresData', 'ProyectosController@profesoresData')->name('profesoresData');

	Route::get('/proyecto_busqueda', 'ProyectosController@search')->name('proyecto_busqueda')->middleware('permission:proyecto_busqueda');

	Route::get('estadoProfesor/{idProfesor}/{idProyecto}', 'ProyectosController@estadoProfesor')->name('estadoProfesor')->middleware('permission:estadoProfesor');
});


//-------------------------ASIGNACION PROYECTOS------------------------------

Route::resource('asignacionProyectos', 'AsignacionProyectosController');

Route::get('proyectos', 'AsignacionProyectosController@index')->name('proyectos.index');

//-------------------------HORARIO------------------------------
Route::get('/listaHorarios', 'HorarioController@listar')->name('listaHorarios');
Route::resource('horario', 'horarioController');

//-------------------------PROYECTOS------------------------------
Route::resource('proyectos', 'ProyectosController');
Route::get('/proyecto_busqueda', 'ProyectosController@search')->name('proyecto_busqueda');
Route::get('estadoProfesor/{idProfesor}/{idProyecto}', 'ProyectosController@estadoProfesor')->name('estadoProfesor');


//-------------------------Horarios------------------------------
Route::resource('eventos', 'EventosController');
Route::get('ajaxRequest', 'EventosController@ajaxRequest')->name('ajaxRequest');
Route::post('ajaxRequestPost', 'EventosController@ajaxRequestPost')->name('ajaxRequestPost');

Route::post('/ajaxSolicitud', 'horarioController@guardarEventos')->name('ajaxSolicitud');

Route::post('/ajaxValidaHorario', 'horarioController@revisaEvento')->name('ajaxValidaHorario');


//-------------------------Asignacion de Cursos------------------------------

Route::get('asignacioncursos','AsignacionCursosController@index')->name('asignacioncursos.index');

Route::get('asignacioncursos/create','AsignacionCursosController@create')->name('asignacioncursos.create');

Route::get('asignacioncursos/store','AsignacionCursosController@store')->name('asignacioncursos.store');

Route::get('asignacioncursos/{a}/edit','AsignacionCursosController@edit')->name('asignacioncursos.edit');

Route::delete('asignacioncursos/{a}', 'AsignacionCursosController@destroy')->name('asignacioncursos.destroy');

Route::put('asignacioncursos/{a}', 'AsignacionCursosController@update')->name('asignacioncursos.update');


//-------------------------Asignacion de actividades------------------------------

Route::get('actividades','actividadesController@index')->name('actividades.index');

/*
Route::post('asignacioncursos/store', 'AsignacionCursosController@store')->name('asignacioncursos.store')
		->middleware('permission:asignacioncursos.create');

	Route::get('asignacioncursos', 'AsignacionCursosController@index')->name('asignacioncursos.index')
		->middleware('permission:asignacioncursos.index');

	Route::get('asignacioncursos/create', 'AsignacionCursosController@create')->name('asignacioncursos.create')
		->middleware('permission:asignacioncursos.create');

	Route::put('asignacioncursos/{a}', 'AsignacionCursosController@update')->name('asignacioncursos.update')
		->middleware('permission:asignacioncursos.edit');

	Route::get('asignacioncursos/{a}', 'AsignacionCursosController@show')->name('asignacioncursos.show')
		->middleware('permission:asignacioncursos.show');

	Route::delete('asignacioncursos/{a}/delete', 'AsignacionCursosController@delete')->name('asignacioncursos.dele')
		->middleware('permission:asignacioncursos.delete');

	Route::get('asignacioncursos/{a}/edit', 'AsignacionCursosController@edit')->name('asignacioncursos.edit')
		->middleware('permission:asignacioncursos.edit');
		*/

//-------------------------HORARIO------------------------------
Route::get('/listaHorarios', 'HorarioController2@listar')->name('listaHorarios');
Route::resource('horario2', 'horarioController2');


Route::post('/carrera/{id}',function($id){
	session(['carrera' => $id]);
});