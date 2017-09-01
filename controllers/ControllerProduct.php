<?php
	class Product {
	    public function indexView() {
	    	$routes = explode('/', $_SERVER['REQUEST_URI']);
	    	$data = ProductModel::getProductById();
	    	$relatedProducts = ProductModel::getRelatedProducts($data['category_id']);
	    	$lastProducts = ProductModel::lastProducts();
            $composition = explode(' ', $data['composition']);
            $cmp_i = 0;
            $sz_i = 0;
            $getComposition = array();
            $setSize;
            foreach ($composition as $key) {
            	if (strlen($key) > 1) {
	                $getComposition[$cmp_i] = str_replace('-', ' ', $key);
	                $cmp_i++;
            	}
            }
            $size = explode(' ', $data['size']);
            foreach ($size as $key) {
                $setSize = str_replace(',', ' ', $key);
                $sz_i++;
            }
            $getSize = explode(' ', $setSize);
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