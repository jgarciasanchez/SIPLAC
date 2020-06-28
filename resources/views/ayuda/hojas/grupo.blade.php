@extends('layouts.app')

@section('content')
    
            <div class="col-md-12">
            <div class="text-center"cl>
                <h1>Ayuda Grupos</h1>
            </div>
            <div class="row">
                <!-- menu de accesos a el ayuda  -->
                    @include('ayuda.menu')
                <!-- paginas para mostrar los datos de ayuda -->
                <div class="col-sm-10">
                   <img width="90%" height="80%" src="indice.png" alt="Imagen no disponible">  
                </div>
            </div>
                
        </div>

@endsection
