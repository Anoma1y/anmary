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
    		die();
    	} 
    	else {
			if (!empty($_FILES) && !empty($_POST)) {
				if ($_FILES['uploadimage']['error'] == 0) {
					if ($_FILES["uploadimage"]["size"] > 800000) {
						die("Большой размер файла");
					}
					$randomSrc = generateSrc(50);
					$src = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
					$upload = $src.$randomSrc.".jpg";
					$sql_src = '/uploads/'.$randomSrc.".jpg";
					move_uploaded_file($_FILES['uploadimage']['tmp_name'], $upload);
					$query = 'INSERT INTO product (name, article, brand_id, category_id, season_id, size, color_id, composition, percentSale, is_sale, price, sale_price, is_availability, image) VALUES (:name, :article, :brand_id, :category_id, :season_id, :size, :color_id, :composition, :percentSale, :is_sale, :price, :sale_price, :is_availability, :image)'; 
					$result_insert = $db->prepare($query);
					$result_insert->bindParam(':name', $_POST['productTitle'], PDO::PARAM_STR);
					$result_insert->bindParam(':article', $_POST['productArticle'], PDO::PARAM_STR);
					$result_insert->bindParam(':brand_id', $_POST['productBrand'], PDO::PARAM_INT);
					$result_insert->bindParam(':category_id', $_POST['productCategory'], PDO::PARAM_INT);
					$result_insert->bindParam(':season_id', $_POST['productSeason'], PDO::PARAM_INT);
					$result_insert->bindParam(':size', $_POST['productSize'], PDO::PARAM_STR);
					$result_insert->bindParam(':color_id', $_POST['productColour'], PDO::PARAM_INT);
					$result_insert->bindParam(':composition', $_POST['productComposition'], PDO::PARAM_STR);
					$result_insert->bindParam(':percentSale', $_POST['productPercent'], PDO::PARAM_INT);
					$result_insert->bindParam(':is_sale', $_POST['productIsSale'], PDO::PARAM_INT);
					$result_insert->bindParam(':price', $_POST['productPrice'], PDO::PARAM_INT);
					$result_insert->bindParam(':sale_price', $_POST['productPriceAfterSale'], PDO::PARAM_INT);
					$result_insert->bindParam(':is_availability', $_POST['productIsAvailability'], PDO::PARAM_INT);
				    $result_insert->bindParam(':image', $sql_src, PDO::PARAM_STR);
				    $result_insert->setFetchMode(PDO::FETCH_ASSOC);
				    $result_insert->execute();
				    die(true);	
				}
			}    		
    	}
    }
?>