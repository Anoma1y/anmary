<?php require_once './models/user.php'; ?>
<?php 
	if (isset($_COOKIE["user_hash"]) && isset($_COOKIE["user_username"]) && isset($_COOKIE["user_email"]) && isset($_COOKIE["user_id"])) {
	 	header("Location: /");
	 } 
	$user = new User();
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
	    $userReg = $user->userRegistration($_POST);
	}
?>
<form action="" method="POST">
	Username: <input type="text" id="username" name="username" />
	Email: <input type="text" id="email" name="email" />
	Password: <input type="text" id="password" name="password" />
	<button name="register">Ok</button>
</form>
