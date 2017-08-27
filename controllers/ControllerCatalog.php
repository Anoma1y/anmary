<?php
	class Catalog {
	    public function all() {
	    	$productList = CatalogModel::getAllProducts();//Список продуктов
	    	$categoryList = CatalogModel::getCategory();//Список категорий
	    	$brandList = CatalogModel::getBrand();//Список брендов
	        require_once('views/catalog/index.php');
	        return true;				
	    }
	    public function category() {
		    $data = CatalogModel::getAllProducts();
	        require_once('views/catalog/index.php');
	        return true;    	
	    }
	   	public function getAllUsers() {
	    	$view = new View();
			$view->render('catalog/getAllProduct_action');
	    }
	}
?>