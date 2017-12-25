<?php
	require_once "engine/Db.php";
	class CatalogModel {
	    public static function getAllProducts() {
			$db = Db::getConnection();
 	        $sql = 'SELECT * FROM product';
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
		public static function filter($brandFilterList = [], $categoryFilterList = [], $priceMin = 0, $priceMax = 999999) {
			$db = Db::getConnection();
			$filterQuery = "";
			if (!empty($categoryFilterList)) {
				$filterQuery = $filterQuery.' AND category_id IN ('.implode(",",$categoryFilterList).')';
			}
			if (!empty($brandFilterList)) {
				$filterQuery = $filterQuery.' AND brand_id IN ('.implode(",",$brandFilterList).')';
			}
	        $sql = 'SELECT product.id FROM product WHERE product.price >= '.$priceMin.' AND product.price <= '.$priceMax.''.$filterQuery;
	        $result = $db->prepare($sql);
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	    	$result->execute();
	        $i = 0;
	        $res = array();
	        while ($row = $result->fetch()) {
	            $res[$i] = $row;
	            $i++;
	        }
	        return $res;
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
		public static function getCategory() {
			$db = Db::getConnection();
 	        $sql = 'SELECT * FROM category';
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
		public static function getBrand() {
			$db = Db::getConnection();
 	        $sql = 'SELECT * FROM brand';
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