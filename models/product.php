<?php
	class ProductModel {
		public static function getProductById() {
			$routes = explode('/', $_SERVER['REQUEST_URI']);
			$id = $routes[2];
			$db = Db::getConnection();
 	        $sql = 'SELECT * FROM product WHERE id = :id';
	        $result = $db->prepare($sql);
	        $result->bindParam(':id', $id, PDO::PARAM_STR);
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	        $result->execute();
	       	$result = $result->fetch();
			return $result;
		}
	}
?>