<?php
	class ProductModel {
		public static function getProductById() {
			$routes = explode('/', $_SERVER['REQUEST_URI']);
			$id = $routes[2];
			$db = Db::getConnection();
 	        $sql = 'SELECT product.*, brand.brand_name, category.category_name, color.color_name, season.season_name FROM product, brand, category, color, season WHERE product.id = :id and product.brand_id = brand.id and product.category_id = category.id and product.color_id = color.id and product.season_id = season.id';
	        $result = $db->prepare($sql);
	        $result->bindParam(':id', $id, PDO::PARAM_STR);
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	        $result->execute();
	       	$result = $result->fetch();
			return $result;
		}
		public static function editProductById() {
			$routes = explode('/', $_SERVER['REQUEST_URI']);
			$id = $routes[3];
			$db = Db::getConnection();
 	        $sql = 'SELECT product.*, brand.brand_name, category.category_name, color.color_name, season.season_name FROM product, category, season, color, brand WHERE product.id = :id and brand.id = product.brand_id and category.id = product.category_id and color.id = product.color_id and season.id = product.season_id';
	        $result = $db->prepare($sql);
	        $result->bindParam(':id', $id, PDO::PARAM_INT);
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	        $result->execute();
	       	$result = $result->fetch();
			return $result;
		}
		public static function getRelatedProducts($category_id) {
			try {
				$db = Db::getConnection();
	 	        $sql = 'SELECT id, name, article, price, sale_price, is_sale, image FROM product WHERE category_id = :category_id and is_availability = 1 ORDER BY RAND() LIMIT 4';
		        $result = $db->prepare($sql);
		        $result->bindParam(':category_id', $category_id, PDO::PARAM_INT);
		        $result->setFetchMode(PDO::FETCH_ASSOC);
		        $result->execute();
		        $i = 0;
		        $all = array();
		        while ($row = $result->fetch()) {
		            $all[$i] = $row;
		            $i++;
		        }
		        return $all;				
			} catch (Exception $e) {
				echo "$e";
			}
		}
		public static function lastProducts() {
			$db = Db::getConnection();
 	        $sql = 'SELECT name, article, price, sale_price, is_sale, is_availability, image FROM product WHERE is_availability = 1 LIMIT 3';
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
?>