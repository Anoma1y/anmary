<?php 
	if (!empty($_POST)) {
		if ($_POST['form'] !== '') {
			require_once "/engine/db.php";
			if (isset($_COOKIE['username_hash'])) {
				$hash = $_COOKIE['username_hash'];
				$db = Db::getConnection();
			    $sql_find = 'SELECT username FROM users WHERE hash = :hash';
		        $author = $db->prepare($sql_find);
		        $author->bindParam(':hash', $hash, PDO::PARAM_STR);
		        $author->setFetchMode(PDO::FETCH_ASSOC);
		        $author->execute();
		        $author = $author->fetch();
		        if ($author['username'] !== $_POST['username']) {
		        	$sql_add = 'INSERT user_comments(from_from_user_id, to_user_id, text, date) VALUES (:from_user_id, :to_to_user_id, :text, NOW())';
					$result_add = $db->prepare($sql_add);
			        $result_add->bindParam(':from_user_id', $from_user_id, PDO::PARAM_INT);
			        $result_add->bindParam(':to_to_user_id', $to_to_user_id, PDO::PARAM_INT);
			        $result_add->bindParam(':text', $text, PDO::PARAM_STR);
			        $result_add->execute();
		        } else {
		        	die('Вы не можете оставить комментарий самому себе');
		        }
			}

		}
	}

?>