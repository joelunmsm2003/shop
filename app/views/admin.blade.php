@extends ('layout')
@section('title')  @stop

@section('content')

<br>
<br>
<br><h4>email: joelunmsm2003@gmail.com</h4>
<h4>pass: 123</h4>
<form action='admin' method='post'>

		<li><input class="form" id="email" placeholder="Email" type ="text" name ="email"></li>
		<li>{{$errors->first('email')}}<br></li>
		<input class="form" id="password" placeholder="Contraseña" type ="password" name ="password">
       <li>{{$errors->first('password')}}<br></li></li>
		<li><input class="form-login" value="Iniciar Sesion" type="submit"> <br></li>
		
</form>
@if (Auth::id()==1)
<p><a href="/users/create">Create</a></p>
@endif


<br><br><br>
<div id="regis">

 <!--<h2><a href="/form" class='btn' >Registrate, es gratis</a></h2>-->






@stop