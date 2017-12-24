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
			if ($_FILES["uploadimage"]["size"] > 800000) {
				die("Большой размер файла");
			}
			$src = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
			$upload = $src.$_FILES['uploadimage']['name'];
			$sql_src = '/uploads/'.$_FILES['uploadimage']['name'];
			move_uploaded_file($_FILES['uploadimage']['tmp_name'], $upload);

			$db = Db::getConnection();
			//Если не пустой
			if (empty($_FILES['uploadimage']['name'])) {
				$query = "UPDATE product SET name = :name,
										     article = :article,
											 brand_id = :brand_id,
											 category_id = :category_id, 
											 season_id = :season_id, 
											 size = :size, 
											 color_id = :color_id, 
											 composition = :composition,
											 percentSale = :percentSale, 
											 is_sale = :is_sale,
											 price = :price,
											 sale_price = :sale_price,
											 is_availability = :is_availability 
											 WHERE id = :id_product";
			} else {
				$query = "UPDATE product SET name = :name,
										     article = :article,
											 brand_id = :brand_id,
											 category_id = :category_id, 
											 season_id = :season_id, 
											 size = :size, 
											 color_id = :color_id, 
											 composition = :composition,
											 percentSale = :percentSale, 
											 is_sale = :is_sale,
											 price = :price,
											 sale_price = :sale_price,
											 is_availability = :is_availability,
											 image = :image 
											 WHERE id = :id_product";			 	
			 }
			$result = $db->prepare($query);
			$result->bindParam(':id_product', $_POST['productId'], PDO::PARAM_INT);
			$result->bindParam(':name', $_POST['productTitle'], PDO::PARAM_STR);
			$result->bindParam(':article', $_POST['productArticle'], PDO::PARAM_STR);
			$result->bindParam(':brand_id', $_POST['productBrand'], PDO::PARAM_INT);
			$result->bindParam(':category_id', $_POST['productCategory'], PDO::PARAM_INT);
			$result->bindParam(':season_id', $_POST['productSeason'], PDO::PARAM_INT);
			$result->bindParam(':size', $_POST['productSize'], PDO::PARAM_STR);
			$result->bindParam(':color_id', $_POST['productColour'], PDO::PARAM_INT);
			$result->bindParam(':composition', $_POST['productComposition'], PDO::PARAM_STR);
			$result->bindParam(':percentSale', $_POST['productPercent'], PDO::PARAM_INT);
			$result->bindParam(':is_sale', $_POST['productIsSale'], PDO::PARAM_INT);
			$result->bindParam(':price', $_POST['productPrice'], PDO::PARAM_INT);
			$result->bindParam(':sale_price', $_POST['productPriceAfterSale'], PDO::PARAM_INT);
			$result->bindParam(':is_availability', $_POST['productIsAvailability'], PDO::PARAM_INT);
			if (!empty($_FILES['uploadimage']['name'])) {
		    	$result->bindParam(':image', $sql_src, PDO::PARAM_STR);
		    }
		    $result->setFetchMode(PDO::FETCH_ASSOC);
		    $result->execute();	
			die(true);	
			
    	}
    }
?>		