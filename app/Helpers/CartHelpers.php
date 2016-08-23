<?php 
	namespace App\Helpers;
	use Session;
	class CartHelpers
	{
		public static function addCart($data)
		{
			Session::push('cart',$data);
		}

		public static function deleteCart($id)
		{
    		 $products = session('cart');
		        foreach ($products as $key => $value)
		        {
		            if ($value['id'] == $id) 
		            {                
		                unset($products [$key]);            
		            }
		        }
			Session::push('cart',$products);
    	}


    	public static function updateChart($data)
    	{
    		$cart = Session::get('cart.program');

		foreach($cart as &$item) {
    		if ($item['id'] == '1xx') { 
        		$item['id'] = '2xx';
        	break;
    		}
		}
		Session::put('cart.program', $cart);
    	}
	}
?>