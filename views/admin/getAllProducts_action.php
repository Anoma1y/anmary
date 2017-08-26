<?php 
    require_once 'engine/functions.php';
    checkAdmin();
    require_once 'engine/ajax_pagination.php';
    $params = include('engine/config.php');
    $sql = 'SELECT product.*, category.category_name, brand.brand_name, color.color_name, season.season_name FROM product, category, brand, color, season WHERE category.id = product.category_id and brand.id = product.brand_id and color.id = product.color_id and season.id = product.season_id ORDER BY id DESC LIMIT :start_from, :record_per_page';
    $sql1 = 'SELECT * FROM product ORDER BY DESC id';
    $order_by = 'id';
    $q = new Pagination(1, $params["record_admin_page"], $sql, $sql1, $order_by);
    $q->getPages();
