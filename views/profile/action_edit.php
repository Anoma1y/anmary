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
			$db = Db::getConnection();
			$sql = "UPDATE user_profile, users SET gender = :gender,
												   birthday = :birthday,
												   country_id = :country_id,
												   states_id = :states_id, 
												   city_id = :city_id, 
												   about_me = :about_me, 
												   invite_club = :invite_club, 
												   invite_friend = :invite_friend, 
												   comment_enable = :comment_enable,
												   visible_profile = :visible_profile,
												   visible_list = :visible_list 
					WHERE user_profile.user_id = users.id and users.hash = :hash";
			$result = $db->prepare($sql);
			$result->bindParam(':hash', $_COOKIE['username_hash'], PDO::PARAM_STR);
		    $result->bindParam(':gender', $_POST['gender'], PDO::PARAM_STR);
		    $result->bindParam(':birthday', $_POST['date'], PDO::PARAM_STR);
		    $result->bindParam(':country_id', $_POST['country'], PDO::PARAM_INT);
		    $result->bindParam(':states_id', $_POST['state'], PDO::PARAM_INT);
		    $result->bindParam(':city_id', $_POST['city'], PDO::PARAM_INT);
		    $result->bindParam(':about_me', $_POST['about_me'], PDO::PARAM_STR);
		    $result->bindParam(':invite_club', $_POST['invite_club'], PDO::PARAM_INT);
		    $result->bindParam(':invite_friend', $_POST['invite_friend'], PDO::PARAM_INT);
		    $result->bindParam(':comment_enable', $_POST['comment_enable'], PDO::PARAM_INT);
		    $result->bindParam(':visible_profile', $_POST['visible_profile'], PDO::PARAM_INT);
		    $result->bindParam(':visible_list', $_POST['visible_list'], PDO::PARAM_INT);
		    $result->setFetchMode(PDO::FETCH_ASSOC);
		    $result->execute();	
			die("Изменения сохранены");
    	}
    }
?>		