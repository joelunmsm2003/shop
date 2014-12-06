@extends ('layout-noisepop')
@section('title') Create @stop

@section('content')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
      <link href="http://fonts.googleapis.com/css?family=Dosis" type="text/css" rel="stylesheet" /> 

 
@foreach($conteo as $conteo)


{{$conteo->id_user}}-
{{$conteo->cnt}}

__
@endforeach
    

@stop

