<?php 
if (isset($_COOKIE['user_hash'])){
   	$hash = $_COOKIE['user_hash'];
    $db = Db::getConnection();
    $sql = "SELECT users.hash FROM users WHERE users.hash = :hash";
    $result = $db->prepare($sql);
    $result->bindParam(':hash', $hash, PDO::PARAM_STR);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();
    $result = $result->fetch();
	if ($_COOKIE['user_hash'] !== $result['hash']) {
		die();
	} else {
		$getID = explode('/', $_SERVER['REQUEST_URI']);
		if (!empty($getID[3])) {
			$query = 'DELETE FROM product WHERE id = :id_product'; 
			$result_insert = $db->prepare($query);
			$result_insert->bindParam(':id_product', $getID[3], PDO::PARAM_INT);
		    $result_insert->setFetchMode(PDO::FETCH_ASSOC);
		    $result_insert->execute();		
		    die(header('Location: /admin'));		
		} else {
			die(header('Location: /admin'));
		}		

	}
}