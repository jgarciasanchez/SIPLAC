@extends('layouts.app')
@section('content')
@include('cursos.fragment.error')
<div class="shadow-lg">
    <div class="row">
        <div class="col-md-12">
            <div class="modal-content ">
                <div class="modal-body">
                    <div class="text-center">
                        <h5>Editar Curso</h5>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <table id="carrerasData">
                                @can('gruposData')
                                <thead>
                                    <tr>
                                        <th scope="row">Nombre</th>
                                        <th scope="row">Acciones</th>
                                    </tr>
                                </thead>
                                @endcan
                            </table>
                        </div>
                        <div class="col-sm-6">
                            <table id="gruposData">
                                 @can('gruposData')
                                    <thead>
                                        <tr>
                                            <th scope="row">Numero</th>
                                            <th scope="row">Nivel</th>
                                            <th scope="row">Acciones</th>
                                        </tr>
                                    </thead>
                                  @endcan
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $('#carrerasData').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('carrerasData')}}',
        columns: [{
                data: 'nombre',
                name: 'nombre'
            },
            {
                data: 'acciones',
                name: 'acciones',
                orderable: true,
                searchable: false
            }
        ]
    });
    $('#gruposData').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('gruposData')}}',
        columns: [{
                data: 'numero',
                name: 'numero'
            },
            {
                data: 'nivel',
                name: 'nivel'
            },
            {
                data: 'acciones',
                name: 'acciones',
                orderable: true,
                searchable: false
            }
        ]
    });
</script>

@endsection