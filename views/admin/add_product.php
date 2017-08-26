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
			if (!empty($_FILES) && !empty($_POST)) {
				if ($_FILES['image']['error'] == 0) {
					$src = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
					$upload = $src.$_FILES['image']['name'];
					$sql_src = '/uploads/'.$_FILES['image']['name'];
					move_uploaded_file($_FILES['image']['tmp_name'], $upload);
					$query = 'INSERT INTO product (name, article, brand_id, category_id, season_id, size, color_id, composition, description, price, image) VALUES (:name, :article, :brand_id, :category_id, :season_id, :size, :color_id, :composition, :description, :price, :image)'; 
					$result_insert = $db->prepare($query);
					$result_insert->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
					$result_insert->bindParam(':article', $_POST['article'], PDO::PARAM_STR);
					$result_insert->bindParam(':brand_id', $_POST['brand'], PDO::PARAM_INT);
					$result_insert->bindParam(':category_id', $_POST['category'], PDO::PARAM_INT);
					$result_insert->bindParam(':season_id', $_POST['season'], PDO::PARAM_INT);
					$result_insert->bindParam(':size', $_POST['size'], PDO::PARAM_STR);
					$result_insert->bindParam(':color_id', $_POST['colour'], PDO::PARAM_INT);
					$result_insert->bindParam(':composition', $_POST['composition'], PDO::PARAM_STR);
					$result_insert->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
					$result_insert->bindParam(':price', $_POST['price'], PDO::PARAM_INT);
				    $result_insert->bindParam(':image', $sql_src, PDO::PARAM_STR);
				    $result_insert->setFetchMode(PDO::FETCH_ASSOC);
				    $result_insert->execute();	
					die(header("Location: /admin"));
				}
			}    		
    	}
    }


?>