<?php 
    if (isset($_COOKIE['username_hash'])){
	   	$hash = $_COOKIE['username_hash'];
	    $db = Db::getConnection();
	    $sql = "SELECT users.hash FROM users WHERE users.hash = :hash";
	    $result = $db->prepare($sql);
	    $result->bindParam(':hash', $hash, PDO::PARAM_STR);
	    $result->setFetchMode(PDO::FETCH_ASSOC);
	    $result->execute();
	    $result = $result->fetch();
    	if ($_COOKIE['username_hash'] !== $result['hash']) {
    		die();
    	} 
    	else {
			if (!empty($_FILES)) {
				if ($_FILES['img']['error'] == 0) {
					$src = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
					$upload = $src.$_FILES['img']['name'];
					$sql_src = '/uploads/'.$_FILES['img']['name'];
					move_uploaded_file($_FILES['img']['tmp_name'], $upload);
					$query = "UPDATE user_profile, users SET photo = :photo
	       						                         WHERE user_profile.user_id = users.id 
	       						                         and users.hash = :hash";
					$result_insert = $db->prepare($query);
					$result_insert->bindParam(':hash', $hash, PDO::PARAM_STR);
				    $result_insert->bindParam(':photo', $sql_src, PDO::PARAM_STR);
				    $result_insert->setFetchMode(PDO::FETCH_ASSOC);
				    $result_insert->execute();	
					die('Image Upload');
				}
			}    		
    	}
    }
?>		