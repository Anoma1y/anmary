<?php 
	if (!empty($_POST)) {
		require_once "/engine/db.php";
		$db = Db::getConnection();
		$username = $_POST['username'];
		$db = Db::getConnection();
	        $sql = 'SELECT users.id, users.username, user_comments.text, user_comments.from_user_id, user_comments.date, user_comments.user_like
				FROM user_comments, users
				WHERE users.id = user_comments.to_user_id and users.username = :username';
	    $result = $db->prepare($sql);
	    $result->bindParam(':username', $username, PDO::PARAM_STR);
	    $result->setFetchMode(PDO::FETCH_ASSOC);
	    $result->execute();
	    $i = 0;
	    $comments = array();
	    while ($row = $result->fetch()) {
	        $comments[$i] = $row;
	        $i++;
	    }
	    die(json_encode($comments));		
	}
?>