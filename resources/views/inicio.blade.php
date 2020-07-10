

<?php
    use App\Carreras;
    $carreras = Carreras::get();
    if(session('curso') != null){ dd('hola');};
?>

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


						<div class="row">
							<div class="col-sm-2">	
                                <div class="form-group">
                                    <form action="" method="POST" name="myform" onchange="setCarrera()">

                                    {!! Form::label('Carrera','Carrera') !!}
                                        <select id="select_carrera" name="select_carrera" class="form-control" >
                                            @foreach ($carreras as $item)
                                            <option value={{$item->id}}>{{$item->nombre}}</option>
                                            @endforeach
                                        </select>


                                    </form>
                                </div>
							</div>

							<div class="col-sm-10" >	

                                <div class="content1">

                                    <div >
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
						</div>
	


	@endsection


