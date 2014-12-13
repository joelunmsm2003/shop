<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::resource('users','UsersController');

Route::resource('products','ProductsController');

Route::resource('listar','ListarController');

Route::post("/registra", function(){

    if(Request::ajax()){

         $username = e(Input::get('username'));
         $email = e(Input::get('email'));
         $gender = e(Input::get('gender'));
         $link = e(Input::get('link'));
         $photo = e(Input::get('photo'));
         
         $password = "123";
         
         
         //$insert = User::insert_users($username,$email,$password);

          $user_new = User::where('username', '=' ,Input::get('username'))->take(100)->get();

            foreach ($user_new as $user_new)
            {   

               if ($user_new->email==$email) {  
               Auth::loginUsingId($user_new->id);
               $log ="Logeado";
               }  
               
            }

            if(!isset($log)){


                    $insert = User::insert_users($username,$email,$password,$photo,$link,$gender);

                    $user_new = User::where('email', '=' ,Input::get('email'))->take(100)->get();

                    foreach ($user_new as $user_new)
                    {   

                    if ($user_new->email==$email) {  
                    Auth::loginUsingId($user_new->id);
                    $log ="Logeado";
                    }  

                    }
            }

        return Response::json($log);
        
    }

    
});

Route::get("add_user_producto/{id}", function($id){

    $x=0;

    $products_user = Productuser::where('user_id', '=', Auth::user()->id)->take(100)->get();
    $products = Products::find($id);


    foreach ($products_user as $products_user)
    {
       
        if ($products->id == $products_user->products_id){

        return Redirect::back();
        $x=1;

        }

    }


        if ($x==0){
    
        $id_user = Auth::user()->id;
        $products = Products::find($id);
        $user = User::find($id_user);
        $user->products()->save($products);
        return Redirect::guest('/products');

        }


});


Route::post('/like', function()
{

    if(Request::ajax()){

        $x=0;

       $likevar = Input::get('likevar');

       
       
       if( substr($likevar,0,8)=="Me gusta")
       {
            $products_user = Productuser::where('user_id', '=', Auth::user()->id)->take(100)->get();
            $products = Products::find(substr($likevar,9,10));

                    foreach ($products_user as $products_user)
                    {
                        
                        if ($products->id == $products_user->products_id){
                
                        $x=1;

                        }

                    }

                    if ($x==0){

                 
                    $products = Products::find(substr($likevar,9,10));
                    $user = User::find(Auth::user()->id);
                    $user->products()->save($products);

                    }

            Productuser::update_like(Auth::user()->id,substr($likevar,9,10),1);

             

       }
       else
       {

                $products_user = Productuser::where('user_id', '=', Auth::user()->id)->take(100)->get();
                $products = Products::find(substr($likevar,12,13));

                    foreach ($products_user as $products_user)
                    {
                        
                        if ($products->id == $products_user->products_id){
                
                        $x=1;

                        }

                    }

                    if ($x==0){

                 
                    $products = Products::find(substr($likevar,12,13));
                    $user = User::find(Auth::user()->id);
                    $user->products()->save($products);

                    }
            Productuser::update_like(Auth::user()->id,substr($likevar,12,13),0);

       }

       return Response::json(substr($likevar,11,12));

     

    }
 
});


Route::post("/ver", function(){

    if(Request::ajax()){

  

            return Response::json("3333");

   
    }

});


Route::post("/iniciar", function(){

    if(Request::ajax()){

        $ini = "noLogeado";

        $user_new = User::where('email', '=' ,Input::get('email'))->take(100)->get();

        foreach ($user_new as $user_new)
            {          
               Auth::loginUsingId($user_new->id);
               $ini = "Logeado";

            }

            return Response::json($ini);

   
    }

});



Route::get('form', function(){
 //render app/views/form.blade.php
 return View::make('form');
});

Route::get('appface', function(){
 //render app/views/form.blade.php
 return View::make('appface');
});

Route::post('contador', function(){
 //render app/views/form.blade.php


               
                $contador = new Contador;

                if(isset(Auth::user()->id)){
                    
                $contador->id_user = Auth::user()->id;

                }
                else{

                $contador->id_user = "No registrado";

                }
                              
                $contador->contador  = $_POST['contador'];
                $contador->save();
                

                return Response::json($contador->id_user);
});


Route::get('/login', function(){
 
 return View::make('login');

});





Route::get('/', function(){
 //render app/views/form.blade.php
 //return View::make('login');
 return Redirect::guest('/products');

});
//->before('auth.basic');






Route::post('form-submit', array('before'=>'csrf',function(){
 //form validation come here
}));



Route::get('login2', ['before' => 'auth.basic', function(){
    return View::make('hello');
}]);

Route::get('map', function()
{
	return View::make('map');
	
});


Route::post('admin','AutController@user');

Route::post('login','AutController@user');

Route::get('logout', function()
{
	Auth::logout();
	return Redirect::to('/login');
	
});


Route::get('files', function()
{
        $directory ="/home/byte/Escritorio/shop-laravel-master/public/assets/img";
        //$directory ="/home1/irene24/public_html/www.ania.pe/assets/img";  

        $files = File::allFiles($directory);

        return View::make('fileform')->with('files',$files);
});

Route::get('admin', function()
{

        return View::make('admin');
});





/*Upload file*/




Route::post('/fileform', function()
{
	
	$destinationPath='public/assets/img/';

   
	$name = Input::file('myfile')->getClientOriginalName();

 

	Input::file('myfile')->move($destinationPath,$name);



    return Redirect::to('/products/create');
   
	
});

Route::post('/fileform_1', function()
{
    
    $destinationPath='public/assets/img/';

    $name = Input::file('myfile')->getClientOriginalName();

    Input::file('myfile')->move($destinationPath,$name);

    return Redirect::to('/files');
   
    
});




/*Blog*/

Route::get("new", function(){

    $user = new User;//creamos un modelo user
    $dni = new Dni;//creamos un modelo dni
    $post = new Post;//creamos un modelo post
    $comment = new Comment;//creamos un modelo comment


    $post->user_id = 1;
    $post->title = "Post de juan";
    $post->content = "Contenido de juan";
    $post->save();//guardamos un modelo post
    $comment->user_id = 1;
    $comment->post_id = 1;
    $comment->subject = "Hola soy juan";
    $comment->comment = "hola soy juan";
    $comment->save();//guardamos un modelo comment
    $dni->user_id = 2;
    $dni->numero = "99999999-W";
    $dni->save();//guardamos un modelo dni
});

Route::get("nuevo_curso", function(){
 
    $curso = new Curso;
    $curso->curso = "Programación con php";//si estamos aquí es que somos muy buenos
    $curso->save();
 
});

Route::get("nuevo_producto", function(){
 
    $products = new Products;
    $products->caracteristica = "Holap";//si estamos aquí es que somos muy buenos
    $products->save();
 
});

Route::get("add_user_curso", function(){

	$curso = Curso::find(1);
	$user = User::find(1);
	$user->cursos()->save($curso);
});






Route::get("curso", function(){
 
    $user = User::find(1);
    if(count($user->cursos) == 0){
        echo "El usuario no ha contratado ningún curso";
    }else{
        foreach($user->cursos as $curso){
            echo $curso->curso;
        }
    }
});

Route::get('/estadistica', function(){
 

    $conteo= Contador::groupby('id_user')->orderby('cnt','desc')->get(array('id_user', DB::raw('count(*) as cnt')));


   
    return View::make('estadistica')->with('conteo', $conteo);

});

Route::get("producto", function(){
 
    $user = User::find(1);
    echo count($user->products);
    if(count($user->products) == 0){
        echo "El usuario no ha contratado ningún curso";
    }else{
        foreach($user->products as $products){
            echo $products->tipo;
        }
    }
});


//podemos obtener a un usuario por su id
Route::get('productsuser/{id}', function($id)
{
 

    $user = User::find($id);
    //print_r($user->products);
    return View::make('deseos')->with('id_user', $user);
 
});

Route::get('canvas', function()
{
 
  return View::make('canvas');
 
});

Route::get('creador', function()
{
 
  return View::make('creador');
 
});

Route::get('ayuda', function()
{
 
  return View::make('ayuda');
 
});

Route::get('tutorial', function()
{
 
  return View::make('ayuda');
 
});

Route::get('email', function()
{
    
    $data = User::find(1)->get()->toArray();
    var_dump($data[0]);


    Mail::send('email', $data[2], function ($message) {
    $message->subject('Aqui viiiiii ');
    $message->to('joelunmsm@gmail.com');
    });


 
});

Route::get('angular', 'UsersController@angular');