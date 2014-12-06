@extends ('layout')
@section('title') Lista de Users @stop

@section('content')
<!-- Latest compiled and minified CSS -->


<h2>
Lista de Usuarios
</h2>
<div class="panel-heading">
<table class="table">
<tr>
	<th>Photo</th>
	<th>Email</th>
	<th>Name</th>
	
	
	<th>Gender</th>
	<th>URL</th>
	<th>Deseos</th>
	<th>Editar</th>

</tr>



@foreach ($users as $user)
	<tr>

			<td>
		<img src="{{$user->photo}}"  class ="fade" height="100" width="100">
		</td>
		<td>
		{{$user->username}}
		</td>
		<td>
			{{$user->email}}
		</td>

	
		<td>
			{{$user->gender}}
		</td>
		<td>
			<a href="{{$user->link}}" >Facebook</a>
		</td>
	
		<td>
			<p><a href="/productsuser/{{$user->id}}" >Sus deseos</a></p>
		</td>
		<td>
			<p><a href="/users/{{$user->id}}/edit" >Editar Datos</a></p>
		</td>
	</tr>

@endforeach


  

</table>



</div>

<p><a href="/users/create" class="btn btn-primary">Create</a></p>


@stop