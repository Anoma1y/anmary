<?php
	class Product {
	    public function indexView() {
	    	$routes = explode('/', $_SERVER['REQUEST_URI']);
	    	$data = ProductModel::getProductById();
	    	$relatedProducts = ProductModel::getRelatedProducts($data['category_id']);
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