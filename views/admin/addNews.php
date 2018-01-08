<?php 
	require_once 'engine/functions.php';
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
    		die("Access Denied");
    	} 

    	else {
			if (!empty($_FILES) && !empty($_POST)) {
				if ($_FILES['news-add-image']['error'] == 0) {
					if ($_FILES["news-add-image"]["size"] > 400000) {
						die("Большой размер файла");
					}
					$randomSrc = generateSrc(50);
					$src = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
					$upload = $src.$randomSrc.".jpg";
					$sql_src = '/uploads/'.$randomSrc.".jpg";
					move_uploaded_file($_FILES['news-add-image']['tmp_name'], $upload);
					$query = 'INSERT INTO news (news_title, news_text, news_image, news_date) VALUES (:news_title, :news_text, :news_image, now())'; 
					$result_insert = $db->prepare($query);
					$result_insert->bindParam(':news_title', $_POST['news-add-title'], PDO::PARAM_STR);
					$result_insert->bindParam(':news_text', $_POST['news-add-text'], PDO::PARAM_STR);
					$result_insert->bindParam(':news_image', $sql_src, PDO::PARAM_STR);
				    $result_insert->setFetchMode(PDO::FETCH_ASSOC);
				    $result_insert->execute();
				    header('Location: ../admin');
				}
			}    		
    	}
    }
