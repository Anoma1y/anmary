<?php
	require_once "engine/Db.php";
	class CatalogModel {
	    public static function getPrice() {
			$db = Db::getConnection();
 	        $sql = 'SELECT price FROM product';
	        $result = $db->prepare($sql);
	    	$result->setFetchMode(PDO::FETCH_ASSOC);
	    	$result->execute();
	        $i = 0;
	        $all = array();
	        while ($row = $result->fetch()) {
	            $all[$i] = $row;
	            $i++;
	        }
	        return $all;
		}
		public static function countItems() {
			$db = Db::getConnection();
 	        $sql = 'SELECT id FROM product';
	        $result = $db->prepare($sql);
	    	$result->setFetchMode(PDO::FETCH_ASSOC);
	    	$result->execute();
	    	$count = $result->rowCount();
	        return $count;			
		}
		public static function getCategory($value) {
			$db = Db::getConnection();
 	        $sql = 'SELECT * FROM '.$value.' ORDER BY id';
	        $result = $db->prepare($sql);
	    	$result->setFetchMode(PDO::FETCH_ASSOC);
	    	$result->execute();
	        $i = 0;
	        $all = array();
	        while ($row = $result->fetch()) {
	            $all[$i] = $row;
	            $i++;
	        }
	        return $all;			
		}

		public static function getLastProduct($count = 5) {
			$db = Db::getConnection();
 	        $sql = 'SELECT product.id, product.name, product.article, product.price, product.sale_price, product.is_sale, product.image ,category.category_name, brand.brand_name FROM product, brand, category WHERE product.brand_id = brand.id AND product.category_id = category.id AND is_availability = 1 ORDER BY product.id DESC LIMIT :count';
	        $result = $db->prepare($sql);
	    	$result->setFetchMode(PDO::FETCH_ASSOC);
	    	$result->bindParam(':count', $count, PDO::PARAM_INT);
	    	$result->execute();
	        $i = 0;
	        $all = array();
	        while ($row = $result->fetch()) {
	            $all[$i] = $row;
	            $i++;
	        }
	        return $all;			
		}
		public static function getPopularModel() {
			$db = Db::getConnection();
 	        $sql = 'SELECT product.*, brand.brand_name FROM product, brand WHERE brand.id = product.brand_id ORDER BY RAND() LIMIT 8';
	        $result = $db->prepare($sql);
	    	$result->setFetchMode(PDO::FETCH_ASSOC);
	    	$result->execute();
	        $i = 0;
	        $all = array();
	        while ($row = $result->fetch()) {
	            $all[$i] = $row;
	            $i++;
	        }
	        return $all;		
		}
	}