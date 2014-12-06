<!DOCTYPE html>
<html>

	<head>
	<title>@yield('title','Aprendiendo')</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="http://fonts.googleapis.com/css?family=Dosis" type="text/css" rel="stylesheet" /> 
<link href="http://fonts.googleapis.com/css?family=Varela Round" type="text/css" rel="stylesheet" /> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="icon" type="http://ecoaventuravida.com/assets/img/22236.png" href="http://ecoaventuravida.com/assets/img/22236.png" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
     
        {{ HTML::style('assets/css/style.css') }}
 
        {{ HTML::style('assets/js/jquery.elevatezoom.js') }}
        {{ HTML::style('assets/js/jquery-1.8.3.min.js') }}
        {{ HTML::style('assets/css/component.css') }}



     </head>

<body>



<header>

<h1><a href="/products">Ania </a></h1>
<div id="top-nav">
<nav>

<div id="top-menu">
      <ul class="nav">
           
            

           
             <li><a href="/products" class="selected">Galeria</a></li>
            <li><a href="/map" class="selected">Donde Estamos</a></li>
            

            
            @if (Auth::check())
            
            @if (Auth::id()==1)

            <li><a href="/users/" class="selected">Usuarios</a></li>
            <li><a href="/files" class="selected">Subir Imagenes</a></li>
            
            @else
            <li><a href="/productsuser/{{Auth::id()}}" class="selected">Mi Lista de Deseos</a></li>
            
                <li><a href="/" class="selected"> <span class="glyphicon glyphicon-earphone"></span> &nbsp;Contacto </a>
                <ul>
                     <li><a href="/" class="selected">013232666</a></li>
               
                </ul>
            </li>
            @endif

            <li><a href="/users/{{Auth::id()}}" class="selected">Bienvenido, {{Auth::user()->username}}</a></li>
        
            @else

            
           <li><a href="/login" class="selected">Ingresar</a></li>
                 
            @endif
                 <li><a href="/logout" class="selected"><span class="glyphicon glyphicon-cog"></span></a>
                <ul>
                     <li><a href="/ayuda" class="selected">Ayuda</a></li>
                     <li><a href="/" class="selected">Blog</a></li>
                     <li><a href="/creador" class="selected">Quien creo Ania?</a></li>
                     <li><a href="/logout" class="selected">Salir</a></li>
                </ul>

            </li>
                  
           
       </ul>
</div>

</nav>


<section id="social">
@if (Auth::check())
  <img src="{{Auth::user()->photo}}"  class ="fade-icon" height="60" width="60">

@endif
</section>
</div>

</header>


<section id="contenido">
      
@yield('content') 




    
</section>






    </body>
</html>