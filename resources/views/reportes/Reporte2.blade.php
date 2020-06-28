@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<div class="shadow-lg">
    <div class="row">
        <div class="col-md-12">
            <div class="modal-content ">
                <div class="modal-body">
                    <div class="form-inline mb-3">
                        {!! Form::open(['route'=>['updateReporte2', $ids],'method'=>'POST','class' => 'form-inline']) !!}
                            <label class="mx-2" for="fecha_ini">Fecha de inicio</label>
                            <input type="date" name="fecha_ini" class="form-control">
                            <label class="mx-2" for="fecha_fin">Fecha final</label>
                            <input type="date" name="fecha_fin" class="form-control">
                            <input type="text" name="plaNom" class="form-control mx-2">
                            <button type="submit" class="btn btn-success mx-2">Aplicar</button>
                        {!! Form::close() !!}
                        <div>
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="ver" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Descargar
                            </button>
                            <div class="dropdown-menu" aria-labelledby="ver">
                                <a class="dropdown-item" href="{{ route('reporte2', [$ids, $info[1], $info[2], $info[0]]) }}">Word</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <div>
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th class="mx-auto" scope="row">Nombre Completo</th>
                                        <th class="mx-auto" scope="row">Cedula de Identidad</th>
                                        <th class="mx-auto" scope="row">Vigencia del Nombramiento</th>
                                        <th class="mx-auto" scope="row">Jornada de Contratación</th>
                                        <th class="mx-auto" scope="row">Información Curso/Proyecto</th>
                                        <th class="mx-auto" scope="row">Plaza y Código Presupuestario</th>
                                        <th class="mx-auto" scope="row">Tipo de Nombramiento</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < count($profesores); $i++) 
                                        @foreach ($profesores[$i] as $prof) 
                                        @php 
                                            $band = true;
                                            $count = 0;
                                            if ($arrayCursos[$i] != null){
                                                $count += count($arrayCursos[$i]);
                                            }
                                            if ($arrayProyectos[$i] != null){
                                                $count += count($arrayProyectos[$i]);
                                            }
                                        @endphp
                                        @if($arrayProyectos[$i] == null && $arrayCursos[$i] == null)
                                        <tr>
                                            <td> {{ $prof->nombre1 }} {{ $prof->apellido1 }} {{ $prof->apellido2 }}</td>
                                            <td> {{ $prof->cedula  }} </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @endif
                                        @if ($arrayCursos[$i] != null)
                                            @foreach ($arrayCursos[$i] as $item)
                                                <tr>
                                                    @if($band)
                                                    <td rowspan={{$count}}> {{ $prof->nombre1 }} {{ $prof->apellido1 }} {{ $prof->apellido2 }}</td>
                                                    <td rowspan={{$count}}> {{ $prof->cedula  }}  </td>
                                                    @endif
                                                    @if($info[1] != "1" && $info[2] != "1")
                                                        <td>
                                                            <h6><small> <b>del </b> {{ $info[1] }} <b>al</b> {{ $info[2] }}</small></h6>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                    @endif
                                                    @if($band)
                                                    <td rowspan="{{$count}}">
                                                        @if($jornadas[$i] <= 5) 
                                                        1/4 TC (10 hrs) 
                                                        @elseif($jornadas[$i] <=8) 
                                                        1/2 TC (20 hrs) 
                                                        @elseif($jornadas[$i] <=11) 
                                                        3/4 TC (30 hrs) 
                                                        @else 
                                                        TC (40 hrs) 
                                                        @endif
                                                    </td> 
                                                    @php 
                                                        $band = false
                                                    @endphp
                                                    @endif
                                                    <td align="left">
                                                        <h6><small> <b>Curso: </b> {{ $item->nombre_cur }}</small></h6>
                                                        <h6><small> <b>Codigo: </b> {{ $item->codigo }}</small></h6>
                                                        <h6><small> <b>NRC: </b> {{ $item->nrc }}</small></h6>
                                                        <h6><small> <b>Grupo: </b> {{$item->numero}}</small></h6>
                                                        <h6><small> <b>Creditos: </b> {{ $item->creditos }}</small></h6>
                                                        <h6><small> <b>HC: </b> {{ $item->horas_contacto }}</small></h6>
                                                    </td>
                                                    @if($info[0] != "1")
                                                        <td>
                                                            <h6><small> {{ $info[0] }} </small></h6>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                    @endif
                                                    <td>{{ $item->tipo_asingnacion }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        @if ($arrayProyectos[$i] != null)
                                            @foreach ($arrayProyectos[$i] as $item)
                                                <tr>
                                                    @if($band)
                                                    <td rowspan={{$count}}> {{ $prof->nombre1 }} {{ $prof->apellido1 }} {{ $prof->apellido2 }}</td>
                                                    <td rowspan={{$count}}> {{ $prof->cedula  }} </td>
                                                    @endif
                                                    @if($info[1] != "1" && $info[2] != "1")
                                                        <td>
                                                            <h6><small> <b>del </b> {{ $info[1] }} <b>al</b> {{ $info[2] }}</small></h6>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                    @endif
                                                    @if($band)
                                                    @php
                                                        $count = 0;
                                                        if ($arrayCursos[$i] != null){
                                                            $count += count($arrayCursos[$i]);
                                                        }
                                                        if ($arrayProyectos[$i] != null){
                                                            $count += count($arrayProyectos[$i]);
                                                        }
                                                    @endphp
                                                    <td rowspan="{{$count}}">
                                                        @if($jornadas[$i] <= 5) 
                                                        1/4 TC (10 hrs) 
                                                        @elseif($jornadas[$i] <=8) 
                                                        1/2 TC (20 hrs) 
                                                        @elseif($jornadas[$i] <=11) 
                                                        3/4 TC (30 hrs) 
                                                        @else 
                                                        TC (40 hrs) 
                                                        @endif
                                                    </td> 
                                                    @php 
                                                        $band = false
                                                    @endphp
                                                    @endif
                                                    <td align="left">
                                                        <h6><small> <b>Proyecto: </b> {{ $item->nombre }}</small></h6>
                                                        <h6><small> <b>Codigo SIA: </b> {{ $item->codigo_sia }}</small></h6>
                                                    </td>
                                                    @if($info[0] != "1")
                                                        <td>
                                                            <h6><small> {{ $info[0] }} </small></h6>
                                                        </td>
                                                    @else
                                                        <td></td>
                                                    @endif
                                                    <td>Plazo fijo</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        @endforeach
                                    @endfor
                                </tbody>
                            </table>
                        </div>	
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
	var table = $('#profesoresDataReportes').DataTable({
		"columns": [
			null,
			null,
			null,
			null,
			{ "width": "10%" }
  		],
		select: true,
		"sScrollX": "100%",
    	"sScrollXInner": "100%",
	});

	$('#button1').click(function() {
		var ids = $.map(table.rows('.selected').data(), function(item) {
			return item[3]
		});
		if(ids[0] != null){
			window.location.href = "{{url('infoReporte')}}" + "/" + ids + "/" + 1 + "/" + 1;
		}
	});
	$('#button2').click(function() {
		var ids = null;
		ids = $.map(table.rows('.selected').data(), function(item) {
			return item[3]
		});
		if(ids[0] != null){
			window.location.href = "{{url('infoReporte')}}" + "/" + ids + "/" + 1 + "/" + 2;
		}
	});
	$('#button3').click(function() {
		var ids = $.map(table.rows('.selected').data(), function(item) {
			return item[3]
		});
		window.location.href = "{{url('infoReporte')}}" + "/" + ids + "/" + 1 + "/" + 3;
	});
	$('#button4').click(function() {
		var ids = $.map(table.rows('.selected').data(), function(item) {
			return item[3]
		});
		if(ids[0] != null){
			window.location.href = "{{url('infoReporte')}}" + "/" + ids + "/" + 1 + "/" + 4;
		} else {
			window.location.href = "{{url('infoReporte')}}" + "/" + ids + "/" + 1 + "/" + 4;
		}
		
	});
</script>

@endsection