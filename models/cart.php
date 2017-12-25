<?php
	require_once "engine/Session.php";
	require_once "engine/Cookie.php";
	require_once "engine/Db.php";

	class Cart {
	    public static function getAllProductByCart($arr = []) {
			$db = Db::getConnection();
	        $sql = 'SELECT * FROM product WHERE id IN ('.implode(",",$arr).')';
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
	}