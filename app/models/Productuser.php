<?php



class Productuser extends Eloquent  {

	protected $fillable = array('id','user_id','products_id','like');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */



	protected $table = 'products_user';


	public static function update_like($user_id,$products_id,$like)
    
    {
 
        $query = DB::table('products_user')
                  ->where('user_id', $user_id, 'AND')
                  ->where('products_id', $products_id)
                  ->update(array(
                   'like' => $like
        ));
 
        return $query;
 
    }  
       public function products()
    
    {
        return $this->hasMany("Products");
    } 

	

}
