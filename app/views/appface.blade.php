@extends ('layout-noisepop')
@section('title') Bienvenido a Ania @stop

@section('content')







<script>
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
      //document.getElementById('status').innerHTML = 'Iniciar una sesion de Facebook para continuar ';
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


            

               $.post('registra',{username:nom,email:email,gender:gender,link:link,photo:photo},function(data){

                  console.log(data);

                 
                });

              

            }
          }
        );


        console.log(response);


        console.log('Successful login for: ' + response.name);


    });
  }

      $('#get').click(function(e){

      e.preventDefault();
      $.get('iniciar',function(data){

        console.log(data);

      });

    });

 

</script>


<!--Jquery Slider-->
<br>




<div id='fb-root'></div>



  
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'/>

  <style>
  
    

.image {

position: relative;

width: 100%; /* for IE 6 */



}

.loco{

 border-radius: 400px;
      }


h5 {

position: absolute;

top: 136px;

left: 0;

width: 100%;



font-size: 70px;

color:#FFF;

}


.subs,.image{


  vertical-align: middle;
  display: inline-block;
  width: 300px;
}

.subs{

  width: 20%;
}
.image{

  width: 50%;
}



</style>


<div class='image'>

 <center> <img alt='Mi titulo de la imagen' class='loco' height='400' src='http://www.ania.pe/8.gif' width='400'/></center>

      <center><h5>Noisepop</h5></center>

</div>

<div class="subs">

Hi, I'm Andy Noisepop thank you very much for visiting my blog to subscribe to beam video click here

<div class="monitor">
<br>

<div class="fb-login-button" scope="public_profile,email" onlogin="checkLoginState();" data-max-rows="4" data-size="large" data-show-faces="false" data-auto-logout-link="true" >Subscribe to the videos here</div>
<div id="status"></div>



</div>


</div>





@stop
