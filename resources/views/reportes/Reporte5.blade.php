@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<div class="shadow-lg">
    <div class="row">
        <div class="col-md-12">
            <div class="modal-content ">
                <div class="modal-body">
                    <div class="form-inline mb-3">
                            
                    </div>
                    <div class="text-center">
                        <div>
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th class="mx-auto">Horas</th>
                                        <th class="mx-auto">Lunes</th>
                                        <th class="mx-auto">Martes</th>
                                        <th class="mx-auto">Miercoles</th>
                                        <th class="mx-auto">Jueves</th>
                                        <th class="mx-auto">Viernes</th>
                                        <th class="mx-auto">Sabado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($f = 7; $f < 22; $f++)
                                        <tr>
                                            @for($c = 0; $c < 7; $c++)
                                                @if($c == 0)
                                                    @if($f < 13)
                                                        <td>{{ $f }}:00</td>
                                                    @else
                                                        <td>{{ $f - 12 }}:00</td>
                                                    @endif
                                                @else
                                                    @php
                                                        $band = false;
                                                    @endphp
                                                    @foreach($horarios as $horario)
                                                        @if($horario->daysOfWeek ==  $c)
                                                            @php
                                                                $ini = substr($horario->startTime, 0, 2);
                                                                $fin = substr($horario->endTime, 0, 2);
                                                                $count = abs($ini - $fin);
                                                            @endphp
                                                                @if($f == $ini)
                                                                    <td rowspan="{{$count}}">tA</td>
                                                                    @php
                                                                        $band = true;
                                                                    @endphp
                                                                @elseif($f > $ini && $f < $fin)
                                                                    @php
                                                                        $band = true;
                                                                    @endphp
                                                                @endif
                                                        @endif
                                                    @endforeach
                                                    @if($band != true)
                                                        <td></td>
                                                    @endif
                                                @endif
                                            @endfor
                                        </tr>
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