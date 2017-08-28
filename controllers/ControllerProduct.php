<?php
	class Product {
	    public function indexView() {
	    	$routes = explode('/', $_SERVER['REQUEST_URI']);
	    	$data = ProductModel::getProductById();
			if (!empty($routes[2])) {
	       		require_once('views/product/index.php');
		        return true;				
			} 
			else {
				require_once "views/errors/404.php";
			}			
	    }
	}
?>