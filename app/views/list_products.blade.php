@extends ('layout')
@section('title') Lista de Productos @stop

@section('content')


<!-- Latest compiled and minified CSS -->


<h3>
Lista de Productos
</h3>



@if (Auth::id()==1)
<p><a href="/products/create" >Create</a></p>
@endif


<div id="col_1">


      <h3>Busqueda</h3>

      <input type="text" id ="search" class="form">

        <h3><a href="/products">Todos</a></h3>

        <h3>Tipo</h3>

        @foreach ($tipo as $tipo)

           <li class="cli">{{$tipo->tipo}}</li>

        @endforeach

        <h3>Caracteristica</h3>

        @foreach ($caracteristica as $caracteristica)

            <li class="cli">{{$caracteristica->caracteristica}}</li>

        @endforeach


</div>



<div id="col_2">

 


     @foreach ($products as $product)


 

  <li  class="col_2_article_1">
       

        <a href="/products/{{$product->id}}"><img src="{{$product->imagen}}" class="fade" height="330" width="250"></a><br>
        <a style="cursor: default">{{$product->tipo}}</a>
        <a style="cursor: default">{{$product->caracteristica}}</a>
        
      

       

     

   <!--<a style="cursor: pointer"><div id="megusta" class="megusta">Me gusta {{$product->id}}</div></a>

   <a style="cursor: pointer"><div id="nomegusta"  class="nomegusta">No me gusta {{$product->id}}</div> </a>-->
                
@if (Auth::id()==1)



        <a href="/products/{{$product->id}}/edit"  role="button">Editar</a>
       
        <a href="/products/{{$product->id}}"  >Ver detalles</a>
        <!--<a href="/add_user_producto/{{$product->id}}"  role="button">Me gusta ♥</a>-->
       {{Form::open(array('method'=>'delete','route'=>['products.destroy',$product->id]))}} 
        <a><button type="submit">Delete</button></a>
        {{Form::close()}}


@else


<div id ="details">
<a href="/products/{{$product->id}}"  role="button">Ver detalles</a>

</div>

<div id="details_cor">
  @if(Auth::check())

           @foreach($product_user as $pu)

           @if ($product->id==$pu->products_id)
           <a style="cursor: default">♥</a>

           @endif

           @endforeach

        @endif

</div>


@endif 


  
</li>


@endforeach

</div>


<script>

$(".nomegusta").hide();
$(document).ready(function(){


       $('.megusta').click(function(){

              var x= $(this).text();

           
              $.post('like',{likevar:x},function(data){
              console.log(data);
              //document.getElementById('like').innerHTML =data;

              });

      });

          $('.nomegusta').click(function(){

              var x= $(this).text();
           

              $.post('like',{likevar:x},function(data){
              console.log(data);
              //document.getElementById('like').innerHTML =data;

              });

      });

      });

</script>



 <script src="//code.jquery.com/jquery-1.10.2.js"></script>





<script>

$(document).ready(function(){
$( ".cli" ).click(function() {

  var val = $(this).text().toLowerCase();
console.log(val);


$(".col_2_article_1").hide();
       $(".col_2_article_1").each(function()
      {

      var text= $(this).text().toLowerCase();
      console.log(text);

        if (text.match(val))
      {
        $(this).show();
       
      } 

       });

});

});
</script>



<script type="text/javascript">
 
$(document).ready(function(){

  $("#search").keyup(function()
  {

    var val = $(this).val().toLowerCase();

   /*caracter  por caracter val*/
   console.log(val);

    $(".col_2_article_1").hide();

      $(".col_2_article_1").each(function()
      {

      var text= $(this).text().toLowerCase();

      /*muestra todos text*/
      

      if (text.indexOf(val)!=-1)
      {
        $(this).show();
       
      }

       });

  });

});

</script>



@stop