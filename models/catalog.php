<?php
	require_once "/engine/db.php";
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
		public static function getPopularModel() {
			$db = Db::getConnection();
 	        $sql = 'SELECT * FROM product ORDER BY RAND() LIMIT 8';
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