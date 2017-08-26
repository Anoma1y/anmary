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
    	}else {
			$src = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
			$upload = $src.$_FILES['image']['name'];
			$sql_src = '/uploads/'.$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'], $upload);
			$db = Db::getConnection();
			//Если не пустой
			if (empty($_FILES['image']['name'])) {
				$query = "UPDATE product SET name = :name,
										     article = :article,
											 brand_id = :brand_id,
											 category_id = :category_id, 
											 season_id = :season_id, 
											 size = :size, 
											 color_id = :color_id, 
											 composition = :composition, 
											 description = :description,
											 price = :price WHERE id = :id_product";
			} else {
				$query = "UPDATE product SET name = :name,
										     article = :article,
											 brand_id = :brand_id,
											 category_id = :category_id, 
											 season_id = :season_id, 
											 size = :size, 
											 color_id = :color_id, 
											 composition = :composition, 
											 description = :description,
											 price = :price,
											 image = :image WHERE id = :id_product";			 	
			 }
			$result = $db->prepare($query);
			$result->bindParam(':id_product', $_POST['product_id'], PDO::PARAM_INT);
			$result->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
			$result->bindParam(':article', $_POST['article'], PDO::PARAM_STR);
			$result->bindParam(':brand_id', $_POST['brand'], PDO::PARAM_INT);
			$result->bindParam(':category_id', $_POST['category'], PDO::PARAM_INT);
			$result->bindParam(':season_id', $_POST['season'], PDO::PARAM_INT);
			$result->bindParam(':size', $_POST['size'], PDO::PARAM_STR);
			$result->bindParam(':color_id', $_POST['colour'], PDO::PARAM_INT);
			$result->bindParam(':composition', $_POST['composition'], PDO::PARAM_STR);
			$result->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
			$result->bindParam(':price', $_POST['price'], PDO::PARAM_INT);
			if (!empty($_FILES['image']['name'])) {
		    	$result->bindParam(':image', $sql_src, PDO::PARAM_STR);
		    }
		    $result->setFetchMode(PDO::FETCH_ASSOC);
		    $result->execute();	
			die(header("Location: /admin"));
			
    	}
    }
?>		