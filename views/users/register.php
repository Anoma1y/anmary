<?php require_once './models/user.php'; ?>
<?php 
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
