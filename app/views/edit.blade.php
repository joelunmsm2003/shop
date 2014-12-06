@extends ('layout')
@section('title') Create @stop

@section('content')
<p>
	Nombre: {{$products->tipo}}
</p>

<h2>Editar</h2>
 

<div id="col_1_cp">






	<h2>Completar</h2>

			{{ Form::open(array('action' => array('ProductsController@update', $products->id),'method'=>'PUT' )) }}
	 
			<li><p>Tipo:</p><input class="form" id="tipo" placeholder="Tipo" type ="text" name ="tipo" value="{{$products->tipo}}"></li>
			<li><p>Descripcion:</p><input class="form" id="caracteristica" placeholder="Caracteristica" type ="text" name ="caracteristica" value="{{$products->caracteristica}}"></li>
			<h2><p>Imagenes :</p></h2>
			
			<li><p>A :</p> <input class="form" id="imagen" placeholder="Imagen" type ="text" name ="imagen" value="{{$products->imagen}}"></li>
			
			<li><p>B :</p> <input class="form" id="imagen_1" placeholder="Imagen_1" type ="text" name ="imagen_1" value="{{$products->imagen_1}}"></li>
			<li><p>C :</p> <input class="form" id="imagen_2" placeholder="Imagen_2" type ="text" name ="imagen_2" value="{{$products->imagen_2}}"></li>
		    <li><p>D :</p> <input class="form" id="imagen_3" placeholder="Imagen_3" type ="text" name ="imagen_3" value="{{$products->imagen_3}}"></li>
		

			{{Form::button('Actualizar',array('type'=>'submit','class'=>'btn btn-2 btn-2a')) }}

			{{ Form::close() }}




</div>


<div id="col_2_cp">


@foreach ($files as $file)

           <img src="/assets/img/{{substr($file, 60, 70)}}" height="80" width="80"  alt="...">
           <!--<img src="/assets/img/{{substr($file, 49, 70)}}" height="100" width="80"  alt="...">-->

@endforeach

</div>

<p><a href="/products" class="btn">Return</a></p>

@stop