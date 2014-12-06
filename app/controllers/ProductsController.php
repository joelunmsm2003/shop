<?php

class ProductsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		    $tipo = Products::groupBy('tipo')->get();
            $caracteristica = Products::groupBy('caracteristica')->get();

			$products = Products::all();
			if (Auth::check()){

			$product_user = Productuser::where('user_id', '=' ,Auth::user()->id)->take(100)->get();
			return View::make('list_products')
			->with('products',$products)
			->with('product_user',$product_user)
			->with('tipo',$tipo)
			->with('caracteristica',$caracteristica);

			}
			else{

			return View::make('list_products')
			->with('products',$products)
			->with('tipo',$tipo)
			->with('caracteristica',$caracteristica);
		
			}
	         
			
	

		

		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

        
		$directory ="/home/byte/Escritorio/shop-laravel-master/public/assets/img";
		
		//$directory="/home1/irene24/public_html/www.ania.pe/assets/img";
		$files = File::allFiles($directory);

		return View::make('form_products')->with('files',$files);

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		if (Auth::user()){

			$user = new Products;
			$data = Input::all();
			$user-> fill($data);
			$user-> save();
			return Redirect::action('ProductsController@index');

		}

		else{

			return Redirect::guest('/login');

		}

	

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)


	{   
	

		$user = Products::find($id);
	
		return View::make('show',array('user'=>$user));

	
	

	    	
	   
	
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$products = Products::find($id);

        $directory ="/home/byte/Escritorio/shop-laravel-master/public/assets/img";
        //$directory ="/home/byte/Escritorio/shop-laravel-master-v2/public/assets/img";
        //$directory="/home1/irene24/public_html/www.ania.pe/assets/img";

        $files = File::allFiles($directory);



		return View::make('edit')
		->with( 'files',$files )
		->with( 'products',$products );
		
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{   

		$user = Products::find($id);
	$data = Input::all();

	
	$user-> fill($data);
	$user-> save();

	return Redirect::action('ProductsController@index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		
       
		$products = Products::find($id);
		 $products->delete();

	return Redirect::action('ProductsController@index');

	}




}
