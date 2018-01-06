<?php 
	/**
	 * [generateCode функция генерации ХЭШ кода]
	 * @param  integer $length [длина кода]
	 * @return string         [ХЭШ код из $length символов]
	 */
	function generateCode($length=6) {
	    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI%@#!*JKLMNOPRQSTUVWXYZ0123456789";
	    $code = "";
	    $sch = strlen($chars) - 1;  
	    while (strlen($code) < $length) {
	        $code .= $chars[mt_rand(0,$sch)];  
	    }
	    return $code;
	}
	function generateInt($length=6) {
	    $chars = "0123456789";
	    $code = "";
	    $sch = strlen($chars) - 1;  
	    while (strlen($code) < $length) {
	        $code .= $chars[mt_rand(1, $sch)];  
	    }
	    return intval($code);
	}
	function generateSrc($length=6) {
	    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
	    $code = "";
	    $sch = strlen($chars) - 1;  
	    while (strlen($code) < $length) {
	        $code .= $chars[mt_rand(0,$sch)];  
	    }
	    return $code;
	}
	function checkAdmin() {
		$db = Db::getConnection();
		$hash = $_COOKIE['username_hash'];
        $sql = 'SELECT username, role_id FROM users WHERE hash = :hash';
        $result = $db->prepare($sql);
        $result->bindParam(':hash', $hash, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
       	$result = $result->fetch();
		return $result;			
	}
?>