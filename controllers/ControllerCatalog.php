<?php
	class Catalog {
		/**
		* Главная страница каталога 
		**/
	    public function all() {
	    	$productList = CatalogModel::getAllProducts();
	    	$categoryList = CatalogModel::getCategory();
	    	$brandList = CatalogModel::getBrand();//Список брендов
	    	$countItems = CatalogModel::countItems();
	    	$filter = CatalogModel::filter();
	        require_once('views/catalog/index.php');
	        return true;				
	    }
	    public function getAllProduct() {
	    	require_once 'engine/ajax_pagination.php';
		    $params = include('engine/config.php');
		    $priceMin = $_POST["state"]["minPrice"];
		    $priceMax = $_POST["state"]["maxPrice"];
		    $categoryFilterList = $_POST["state"]["categoryFilter"];
		    $brandFilterList = $_POST["state"]["brandFilter"];
		    $filterQuery = "";
		    if (!empty($categoryFilterList)) {
		        $filterQuery = $filterQuery.' AND category_id IN ('.implode(",",$categoryFilterList).')';
		    }
		    if (!empty($brandFilterList)) {
		        $filterQuery = $filterQuery.' AND brand_id IN ('.implode(",",$brandFilterList).')';
		    }
		    //Основной запрос на поиск по фильтру
		    $sql = 'SELECT product.id, product.name, product.article, brand.brand_name, product.price, product.sale_price, product.size, product.is_sale, product.is_availability, product.image FROM product, brand WHERE product.brand_id = brand.id AND price >= '.$priceMin.' AND price <= '.$priceMax.$filterQuery.' ORDER BY id DESC LIMIT :start_from, :record_per_page';
		    //Запрос на количество записей и количество страниц
		    $sql1 = 'SELECT id FROM product WHERE price >= '.$priceMin.' AND price <= '.$priceMax.$filterQuery.' ORDER BY id';
		    $order_by = 'id';
		    $q = new Pagination(1, $params["record_per_page"], $sql, $sql1, $order_by);
		    $q->getPages();
	    }
	    public function category() {
		    $data = CatalogModel::getAllProducts();
	        require_once('views/catalog/index.php');
	        return true;    	
	    }
	}
?>