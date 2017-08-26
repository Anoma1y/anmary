<?php 
    require_once 'engine/ajax_pagination.php';
    $params = include('engine/config.php');
    //минимальная и максимальца цена
    $minPrice = intval($_POST['state']['min']);
    $maxPrice = intval($_POST['state']['max']);
    //название категории (по умолчанию - все)
    $categoryName = $_POST['state']['cat_li'];
    $brandName = $_POST['state']["brand_li"];
    $brand_li = explode('_', $brandName);
    $cat_id = explode('_', $categoryName);
    //Вывод только по ценовому диапазону, все категории и все бренды
    if ($categoryName == "all_category" && $brandName == "all_brand") {
        $sql = "SELECT id, name, price FROM product WHERE price <= $maxPrice and price >= $minPrice ORDER BY id DESC LIMIT :start_from, :record_per_page";
        $sql1 = "SELECT id FROM product WHERE price <= $maxPrice and price >= $minPrice ORDER BY id";
    }
    //Вывод только по ценовому диапазону и по категориям
    elseif ($categoryName !== "all_category" && $brandName == "all_brand") {
        $sql = "SELECT id, name, price FROM product WHERE price <= $maxPrice and price >= $minPrice and category_id = $cat_id[1] ORDER BY id DESC LIMIT :start_from, :record_per_page";
        $sql1 = "SELECT id FROM product WHERE price <= $maxPrice and price >= $minPrice and category_id = $cat_id[1] ORDER BY id";        
    }
    //Вывод только по ценовому диапазону и по брендами
    elseif ($categoryName == "all_category" && $brandName !== "all_brand") {
        $sql = "SELECT id, name, price FROM product WHERE price <= $maxPrice and price >= $minPrice and brand_id = $brand_li[1] ORDER BY id DESC LIMIT :start_from, :record_per_page";
        $sql1 = "SELECT id FROM product WHERE price <= $maxPrice and price >= $minPrice and brand_id = $brand_li[1] ORDER BY id";
    }
    //Вывод по ценовому диапазону, категориям и брендам
    elseif ($categoryName !== "all_category" && $brandName !== "all_brand") {
        $sql = "SELECT id, name, price FROM product WHERE price <= $maxPrice and price >= $minPrice and brand_id = $brand_li[1] and category_id = $cat_id[1] ORDER BY id DESC LIMIT :start_from, :record_per_page";
        $sql1 = "SELECT id FROM product WHERE price <= $maxPrice and price >= $minPrice and brand_id = $brand_li[1] ORDER BY id";
    }
    //Сортировка по айди
    $order_by = 'id';
    $q = new Pagination(1, $params["record_per_page"], $sql, $sql1, $order_by);
    $q->getPages();

