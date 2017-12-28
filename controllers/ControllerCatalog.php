<?php
	class Catalog {
		/**
		* Главная страница каталога 
		**/
	    public function all() {
	    	$priceList = CatalogModel::getPrice();
	    	$categoryList = CatalogModel::getCategory();
	    	$brandList = CatalogModel::getBrand();
	    	$seasonList = CatalogModel::getSeason();
	    	$countItems = CatalogModel::countItems();
	        require_once('views/catalog/index.php');
	        return true;				
	    }
	    //Метод получение списка товаров
	    public function getAllProduct() {
	    	require_once 'engine/ajax_pagination.php';
		    $params = include('engine/config.php');
		    $priceMin = $_POST["state"]["minPrice"];
		    $priceMax = $_POST["state"]["maxPrice"];
		    $categoryFilterList = $_POST["state"]["categoryFilter"];
		    $brandFilterList = $_POST["state"]["brandFilter"];
		    $seasonFilterList = $_POST["state"]["seasonFilter"];
		    $isSaleFilterList = $_POST["state"]["isSaleFilter"];
		    $sortValue = $_POST["sort"];
			$searchValue = $_POST["searchValue"];
		    $filterQuery = "";
		    $sortQuery = "";
		    $searchLike = "";
		    //Добавление фильтра категорий (categoryFilterList содержит массив категорий товаров)
		    if (!empty($categoryFilterList)) {
		        $filterQuery = $filterQuery.' AND category_id IN ('.implode(",",$categoryFilterList).')';
		    }
		    //Добавление фильтра брендов (brandFilterList содержит массив брендов товаров)
		    if (!empty($brandFilterList)) {
		        $filterQuery = $filterQuery.' AND brand_id IN ('.implode(",",$brandFilterList).')';
		    }
		    //Добавление фильтра сезонов (seasonFilterList содержит массив сезонов товаров)
		    if (!empty($seasonFilterList)) {
		        $filterQuery = $filterQuery.' AND season_id IN ('.implode(",",$seasonFilterList).')';
		    }
		    //Добавления фильтра скидок (1 или 0)
		    if (strlen($isSaleFilterList) != 0) {
		        $filterQuery = $filterQuery.' AND is_sale = 1 ';
		    }
		    //Сортировка товаров
		    if ($sortValue == "sortByNewest") {
		    	$sortQuery = "product.id DESC";
		    } else if ($sortValue == "sortBySales") {
		    	$sortQuery = "product.is_sale DESC";
		    } else if ($sortValue == "sortByPriceLower") {
		    	$sortQuery = "product.price DESC";
		    } else if ($sortValue == "sortByPriceHigher") {
		    	$sortQuery = "product.price";
		    }
		    //Добавление фильтра поискового запроса
		    if (!empty($searchValue) && strlen($searchValue) >= 3 && strlen($searchValue) <= 20) {
		    	$searchLike = ' AND (product.name LIKE "'.$searchValue.'" OR product.article LIKE "'.$searchValue.'" or product.composition LIKE "'.$searchValue.'")';
		    }
		    //Основной запрос
			$sql = 'SELECT product.id, product.name, product.article, brand.brand_name, product.price, product.sale_price, product.size, product.composition, product.is_sale, product.is_availability, product.image FROM product, brand, season WHERE product.season_id = season.id AND product.brand_id = brand.id AND product.price >= '.$priceMin.' AND product.price <= '.$priceMax.$filterQuery.$searchLike.' ORDER BY '.$sortQuery.' LIMIT :start_from, :record_per_page';	
		    //Запрос на количество записей и количество страниц
		    $sql1 = 'SELECT id FROM product WHERE price >= '.$priceMin.' AND price <= '.$priceMax.$filterQuery.$searchLike.' ORDER BY id';
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