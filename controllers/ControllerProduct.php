<?php
	require_once 'engine/Cart.php';
	/**
	 * Класс Product
	 */
	class Product {
		/**
		 * [indexView метод контроллера товара по ID]
		 * Возвращает сгенерированную страницу
		 */
	    public function indexView() {
	    	$routes = explode('/', $_SERVER['REQUEST_URI']);
	    	try {
		    	$data = ProductModel::getProductById();
		    	$relatedProducts = ProductModel::getRelatedProducts($data['category_id']);
		    	$lastProducts = ProductModel::lastProducts();
	            $composition = explode(' ', $data['composition']);
	            $checkCart = UserCart::getProductsById($data["id"]);
	            $checkSizeInCart = UserCart::getProductsByIdSize($data["id"]);
	            if (empty($data)) {
	            	throw new Exception();
	            }
	            $cmp_i = 0;
	            $sz_i = 0;
	            $getComposition = array();
	            foreach ($composition as $key) {
	            	if (strlen($key) > 1) {
		                $getComposition[$cmp_i] = str_replace('-', ' ', $key);
		                $cmp_i++;
	            	}
	            }
	            $getSize = explode(', ', $data['size']);
				if (!empty($routes[2])) {
		       		require_once('views/product/index.php');
			        return true;				
				} 
				else {
					require_once "views/errors/404.php";
				}	    		
	    	} catch (Exception $e) {
	    		require_once "views/errors/404.php";
	    	}
			
	    }
	}
