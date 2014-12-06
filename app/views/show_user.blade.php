@extends ('layout')
@section('title') Usuario @stop

@section('content')

<h2>
Usuario {{$user->id}}
</h2>

<p>
	Nombre: {{$user->username}}
</p>

<p>
  Email: {{$user->email}}
</p>



 


<p><a href="/users/{{$user->id}}/edit" class="btn btn-primary">Editar</a></p>
@stop

