@extends ('layout')
@section('title') Usuario @stop



@section('content')
<script src='/assets/js/jquery-1.8.3.min.js'></script>
  <script src='/assets/js/jquery.elevatezoom.js'></script>
  <!--
  <div id="detalle_1">
   <div id="edit">
   <div id="edit_img">
<img id="zoom_01" src='/assets/img/img2.png' data-zoom-image="{{$user->imagen_1}}" width ="360px" height="450px">
 </div>
 </div>
 </div>-->
<!-- Nav tabs -->

  <div id="detalle_1">

   <div id="edit">
   <div id="edit_img">


    <li class="img_show_ini"><img src="{{$user->imagen}}" width ="360px" height="450px"><a></a></li>
    <li class="img_show"><img src="{{$user->imagen}}" width ="360px" height="450px"><a>{{$user->imagen}}</a></li>
    <li class="img_show"><img src="{{$user->imagen_1}}" width ="360px" height="450px"><a>{{$user->imagen_1}}</a></li>
    <li class="img_show"><img src="{{$user->imagen_2}}" width ="360px" height="450px"><a>{{$user->imagen_2}}</a></li>
    <li class="img_show"><img src="{{$user->imagen_3}}" width ="360px" height="450px"><a>{{$user->imagen_3}}</a></li>
   </div>

<script>
    $('#zoom_01').elevateZoom({
    zoomType: "inner",
cursor: "crosshair",
zoomWindowFadeIn: 500,
zoomWindowFadeOut: 750
   }); 
</script>


 
  <li class="edit_t"><img src="{{$user->imagen}}" width ="120px" height="140px"><a>{{$user->imagen}}</a></li>

<li class="edit_t"><img src="{{$user->imagen_1}}" width ="120px" height="140px"><a>{{$user->imagen_1}}</a></li>

   <li class="edit_t"><img src="{{$user->imagen_2}}" width ="120px" height="140px"><a>{{$user->imagen_2}}</a></li>
   <li class="edit_t"><img src="{{$user->imagen_3}}" width ="120px" height="140px"><a>{{$user->imagen_3}}</a></li>

</div>

</div>

<div id="detalle_2">

<h2>
Product : {{$user->id}}
</h2>

<h2>
  Nombre: {{$user->tipo}}
</h2>

  <h2>Caracteristica: {{$user->caracteristica}}</h2>
  <br><br>
   @if (Auth::check())

<a href="/add_user_producto/{{$user->id}}" class="btn btn-2 btn-2a">Agregar a mi lista de deseos</a>

@else
<form id="form1" runat="server">
    
    <a href="#" id="btnShowSimple" class="btn btn-2 btn-2a" >Agregar a mi lista de deseos</a>
   <!-- <input type="button" id="btnShowSimple" value="Agregar a mi lista de deseos" class="btn btn-2 btn-2a" width="10"/>
-->
    
    <br /><br />       
    
    <div id="output"></div>
    
    <div id="overlay" class="web_dialog_overlay"></div>
    
    <div id="dialog" class="web_dialog">

   

    <br>


    <div class="fb-login-button" scope="public_profile,email" onlogin="checkLoginState();" data-max-rows="4" data-size="large" data-show-faces="false" data-auto-logout-link="true">Registrate con Facebook</div>
    <br><br>
    <div id="status"></div>

        
    

</form>
@if (Auth::id()==1)
<p><a href="/users/create">Create</a></p>
@endif

<br>


    <script type="text/javascript">

  // This is called with the results from from FB.getLoginStatus().


  
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.

      testAPI();


    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Conectate con Facebook';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Iniciar una sesion de Facebook para continuar ';
      //document.getElementById("post").style.visibility="hidden";
 
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '818903454809467',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.1' // use version 2.1
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.



  function testAPI() {

    
    console.log('Welcome!  Fetching your information.... ');

    FB.api('/me', 
   
    function(response) {
     

     var nom = response.name ;
     var email = response.email;
     var gender = response.gender;
     var link = response.link;
     
     FB.api(
        "/me/picture",
        {
          "redirect": false,
          "height": "200",
          "type": "normal",
          "width": "200"
        },
        function (response) {
        if (response && !response.error) {
        var photo= response.data.url;
        console.log(photo);
        console.log(link);

               $.post('../registra',{username:nom,email:email,gender:gender,link:link,photo:photo},function(data){

                  console.log(data);

                if(data="Logeado"){

                url = $(location).attr('href');
                $(location).attr('href',url);


                }



                });

            }
          }
        );


        console.log(response);


        console.log('Successful login for: ' + response.name);
        document.getElementById('status').innerHTML =
        'Gracias por logearte, ' + response.name + '!';


        document.getElementById('post').innerHTML =
        'Ingresar'

        document.getElementById('nombre').innerHTML =
        'Bienvenida '+ response.name +'!';

    });
  }

      $('#get').click(function(e){

      e.preventDefault();
      $.get('iniciar',function(data){

        console.log(data);

      });

    });

 



    </script>







@endif


</div>

<script>
$(document).ready(function(){
$(".img_show_1 a").hide();
$(".edit_t a").hide();
$(".img_show").hide();
$( ".edit_t" ).click(function() {


var val = $(this).text().toLowerCase();
/*console.log(val);//Muestra 1 edit_t del click*/


$(".img_show a").hide();
$(".img_show_ini").hide();
       $(".img_show").each(function()
      {

      var text= $(this).text().toLowerCase();
      //console.log(text);//Muestra todos los img_show

        if (text.match(val))
      {
        $(this).show();
        $(".img_show").hide();
        console.log($(this).show());
      } 

       });

});

});

</script>
<br><br><br><br>
@if (Auth::id()==1)
<p><a href="/products/{{$user->id}}/edit" class="btn btn-primary">Editar</a></p>
@endif
<script type="text/javascript">

        $(document).ready(function ()
        {
            $("#btnShowSimple").click(function (e)
            {
                ShowDialog(false);
                e.preventDefault();
            });

            $("#btnShowModal").click(function (e)
            {
                ShowDialog(true);
                e.preventDefault();
            });

            $("#btnClose").click(function (e)
            {
                HideDialog();
                e.preventDefault();
            });

            $("#btnSubmit").click(function (e)
            {
                var brand = $("#brands input:radio:checked").val();
                $("#output").html("<b>Your favorite mobile brand: </b>" + brand);
                HideDialog();
                e.preventDefault();
            });
        });

        function ShowDialog(modal)
        {
            $("#overlay").show();
            $("#dialog").fadeIn(300);

            if (modal)
            {
                $("#overlay").unbind("click");
            }
            else
            {
                $("#overlay").click(function (e)
                {
                    HideDialog();
                });
            }
        }

        function HideDialog()
        {
            $("#overlay").hide();
            $("#dialog").fadeOut(300);
        } 
        
    </script>

@stop




    