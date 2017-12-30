<?php require_once './models/user.php'; ?>
<?php
	if (isset($_COOKIE["user_hash"]) && isset($_COOKIE["user_username"]) && isset($_COOKIE["user_email"]) && isset($_COOKIE["user_id"])) {
	 	header("Location: /");
	 } 
	$user = new User();
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
	    $userReg = $user->userLogin($_POST);
	}
?>


<form action="" method="POST">
	<input type="text" placeholder="Почта" name="email">
	<input type="text" placeholder="Пароль" name="password">
	<input type="submit" name="login" value="Войти">
</form>
