<?php 
    require_once 'engine/functions.php';
    // require_once 'models/user.php';
    
	$db = Db::getConnection();
    $sql = 'SELECT product.id, product.name, product.article, brand.brand_name, category.category_name, season.season_name, product.size, color.color_name, product.composition, product.price, product.sale_price, product.percentSale, product.is_availability, product.is_sale  FROM product, category, brand, color, season WHERE category.id = product.category_id and brand.id = product.brand_id and color.id = product.color_id and season.id = product.season_id';
    $result = $db->prepare($sql);
	$result->setFetchMode(PDO::FETCH_ASSOC);
	$result->execute();
    $i = 0;
    $all = array();
    while ($row = $result->fetch()) {
        $all[$i] = $row;
        $i++;
    }
    die(json_encode($all));