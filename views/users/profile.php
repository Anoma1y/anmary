<?php require_once './engine/Session.php'; ?>
<?php require_once './models/user.php' ?>
<?php 
	Session::init();
	Session::checkSession();

	$login_msg = Session::get("login_msg");
	if (isset($login_msg)) {
	    // echo $login_msg;
	}

	$checkAdmin = new User();
	$check = $checkAdmin->checkAdministrator($_COOKIE["user_hash"]); 
	// var_dump($_COOKIE);
	var_dump($check["permissions"] === '{"admin": 1}');
	// echo "<br/ >";
	// var_dump($_SESSION);
?>


<?php          
   $username = Session::get("username");
   if (isset($username)) {
      // echo $username;
	} 
?>