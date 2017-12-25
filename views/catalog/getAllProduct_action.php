<?php 

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
    $sql = 'SELECT id, name, price, sale_price, is_sale, is_availability, image FROM product WHERE price >= '.$priceMin.' AND price <= '.$priceMax.$filterQuery.' ORDER BY id DESC LIMIT :start_from, :record_per_page';
    //Запрос на количество записей и количество страниц
    $sql1 = 'SELECT id FROM product WHERE price >= '.$priceMin.' AND price <= '.$priceMax.$filterQuery.' ORDER BY id';
    $order_by = 'id';
    $q = new Pagination(1, $params["record_per_page"], $sql, $sql1, $order_by);
    $q->getPages();

