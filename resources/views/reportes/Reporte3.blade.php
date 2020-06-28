@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<div class="shadow-lg">
    <div class="row">
        <div class="col-md-12">
            <div class="modal-content ">
                <div class="modal-body">
                    <div class="form-inline mb-3">
                        <div>
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="ver" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Descargar
                            </button>
                            <div class="dropdown-menu" aria-labelledby="ver">
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <div>
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="13">AREA DE DESARROLLO SOCIAL</th>
                                    </tr>
                                    <tr>
                                        <th colspan="13">CONSOLIDACION DE HORAS ACADEMICAS</th>
                                    </tr>
                                    <tr>
                                        <th colspan="3">Propietarios</th>
                                        <th colspan="4">I Ciclo</th>
                                        <th colspan="4">II Ciclo</th>
                                        <th colspan="2">Consolidacion Anual</th>
                                    </tr>
                                    <tr>
                                        <th class="mx-auto" scope="row">Categoria</th>
                                        <th class="mx-auto" scope="row"></th>
                                        <th class="mx-auto" scope="row">Profesores</th>
                                        <th class="mx-auto" scope="row">Horas contacto</th>
                                        <th class="mx-auto" scope="row">Jornada</th>
                                        <th class="mx-auto" scope="row">Jornada Sustitucion</th>
                                        <th class="mx-auto" scope="row">Horas</th>
                                        <th class="mx-auto" scope="row">Horas contacto</th>
                                        <th class="mx-auto" scope="row">Jornada</th>
                                        <th class="mx-auto" scope="row">Jornada Sustitucion</th>
                                        <th class="mx-auto" scope="row">Horas</th>
                                        <th class="mx-auto" scope="row">Horas contacto</th>
                                        <th class="mx-auto" scope="row">Horas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
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