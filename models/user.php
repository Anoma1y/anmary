<?php
	require_once "/engine/db.php";

	class User
	{
	    public static function getCurrentUser() {
			$db = Db::getConnection();
			$hash = $_COOKIE['username_hash'];
	        $sql = 'SELECT role FROM users WHERE hash = :hash';
	        $result = $db->prepare($sql);
	        $result->bindParam(':hash', $hash, PDO::PARAM_STR);
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	        $result->execute();
	       	$result = $result->fetch();
			return $result;	
	    }
	}