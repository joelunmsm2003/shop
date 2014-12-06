<?php

class AutController extends BaseController {


	public function user()
	{

		
		$data =  Input::all();
	
		$userdata = array(
				'email' => Input::get('email'),
				'password' => Hash::make(Input::get('password'))
				);


			$reglas = array(

				'email' => 'required|min:5|max:100',
				'password'=> 'required'
			);

			

			$validar = Validator::make($data,$reglas);

			if($validar->fails())

			{
				return Redirect::back()->withErrors($validar);
				

			}
			else
			{	

				//Auth::loginUsingId(1);
				//return Redirect::to('/products');

			$user_new = User::where('email', '=' ,Input::get('email'))->take(100)->get();

        	foreach ($user_new as $user_new)
            {          
               //Auth::loginUsingId($user_new->id);
               //$ini = "Logeado";

            	if($user_new->id ==1){
            			Auth::loginUsingId($user_new->id);
					
						return Redirect::to('/products');
            	}

            	

            }


			}


	
   }


	


}
