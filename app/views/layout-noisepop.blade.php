<!DOCTYPE html>
<html>

	<head>
	<title>@yield('title','Aprendiendo')</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="http://fonts.googleapis.com/css?family=Dosis" type="text/css" rel="stylesheet" /> 
<link href="http://fonts.googleapis.com/css?family=Varela Round" type="text/css" rel="stylesheet" /> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
     
        {{ HTML::style('assets/css/style.css') }}
   {{ HTML::style('assets/css/component.css') }}


<title>VISIT COUNTER</title>
<style>
.counter{
background-color:black;
color:black;
font-weight:bold;}
</style>

<SCRIPT>
expireDate = new Date
expireDate.setMonth(expireDate.getMonth()+6)
jcount = eval(cookieVal("jaafarCounter"))
jcount++
document.cookie = "jaafarCounter="+jcount+";expires=" + expireDate.toGMTString()
console.log(jcount);

   $.ajax({

            url:'contador',
            type:'post',
            data: {"contador":jcount},

            success:function(response){

      
            console.log(response);


            }
            });



function cookieVal(cookieName) {
thisCookie = document.cookie.split("; ")
for (i=0; i<thisCookie.length; i++){
if (cookieName == thisCookie[i].split("=")[0]){
return thisCookie[i].split("=")[1]

}
}
return 0
}

function page_counter(){
for (i=0;i<(7-jcount.toString().length);i++)
document.write('<span class="counter">0</span>')
for (y=0;y<(jcount.toString().length);y++)
document.write('<span class="counter">'+jcount.toString().charAt(y)+'</span>')
}
</SCRIPT>

<SCRIPT>
page_counter(jcount);
</SCRIPT>

     </head>

<body>



<header>

<h1><a href="/products">Noisepop </a></h1>
<div id="top-nav">
<nav>

<div id="top-menu">
      <ul class="nav">
           
            

            

            
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

            <li><a href="" class="selected">Bienvenido, {{Auth::user()->username}}</a></li>
        
            @else

            
       
                 
            @endif
                 <li><a href="/logout" class="selected"><span class="glyphicon glyphicon-cog"></span></a>
                <ul>
                 
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
<style>

section#contenido1{

  background: #fff;
  padding-top: 109px;
  height: 569px;
}
</style>

<section id="contenido1">
      
@yield('content') 




    
</section>






    </body>
</html>
