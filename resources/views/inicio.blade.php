@extends('layouts.app')
	@section('content')
    
        <!-- Styles -->
        <style>
            .content1 {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

        </style>

	    <div class="flex-center position-ref full-height">

            <div class="content1">
                 <div>
                    <img width="25%" height="15%" src="indice.png" alt="">   
                </div>
                <div class="title m-b-md">
                     {{ config('SIPLAC', 'SIPLAC') }}
                </div>
               <div class="">
                    <p class="h2">Sistema De Planificacion Academica</p>
                </div>
            </div>
        </div>

	@endsection
