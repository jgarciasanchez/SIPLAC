@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<div class="shadow-lg">
    <div class="row">
        <div class="col-md-12">
            <div class="modal-content ">
                <div class="modal-body">
                    <div class="form-inline mb-3">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="ver" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Descargar
                            </button>
                            <div class="dropdown-menu" aria-labelledby="ver">
                                <a class="dropdown-item" href="{{ route('infoReporte', [$ids, 2, 4]) }}">Word</a>
                            </div>
                    </div>
                    <div class="text-center">
                        <div>
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                    <th class="mx-auto" scope="row">Profesor</th>
                                            <th style="width: 8%" class="mx-auto" scope="row">Código</th>
                                            <th style="width: 8%" class="mx-auto" scope="row">NRC</th>
                                            <th style="width: 5%" class="mx-auto" scope="row">Grupo</th>
                                            <th class="mx-auto" scope="row">Curso</th>
                                            <th style="width: 8%" class="mx-auto" scope="row">Digital</th>
                                            <th style="width: 13%" class="mx-auto" scope="row">Fecha impreso</th>
                                            <th style="width: 20%" class="mx-auto" scope="row">Firma</th>
                                    </tr>

                                </thead>
                                <tbody>
                                @for ($i = 0; $i < count($profesores); $i++) 
                                            @foreach ($profesores[$i] as $prof) 
                                                @if ($arrayCursos[$i] != null)
                                                    @foreach ($arrayCursos[$i] as $item)
                                                        <tr>
                                                            <td>{{ $prof->nombre1 }} {{ $prof->apellido1 }} {{ $prof->apellido2 }} </td>
                                                            <td>{{ $item->codigo }}</td>
                                                            <td>{{ $item->nrc }}</td>
                                                            <td>{{ $item->numero }}</td>
                                                            <td>{{ $item->nombre_cur  }}</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
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

@endsection
