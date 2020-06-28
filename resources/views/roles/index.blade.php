@extends('layouts.app')

@section('content')
        <div class="col-md-12">
            @include('usuarios.fragment.info')
            <div class="row pt-5">
                    <div class="panel-heading">
                        @can('roles.create')
                        <a data-toggle="tooltip" data-placement="top" title="Crear un nuevo rol" href="{{ route('roles.create') }}" 
                          class="btn btn-success">
                            Crear nuevo rol
                        </a>
                        @endcan
                        <a data-toggle="tooltip" data-placement="top" class="btn btn-primary" href="{{route('usuarios.index') }}" title="Regresa a el la pantalla anterior">
                            Volver
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th colspan="3">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->description }}</td>
                                @can('roles.edit')
                                <td width="10px">
                                    <a href="{{ route('roles.edit', $role->id) }}" 
                                    class="btn btn-success btn-sm">
                                        Editar
                                    </a>
                                </td>
                                @endcan
                                @can('roles.destroy')
                                <td width="10px">
                                    {!! Form::open(['route' => ['roles.destroy', $role->id], 
                                    'method' => 'DELETE']) !!}
                                        <button class="btn btn-sm btn-danger">
                                            Eliminar
                                        </button>
                                    {!! Form::close() !!}
                                </td>
                                @endcan
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $roles->render() }}
                  </div>
                </div>
            
        </div>
@endsection