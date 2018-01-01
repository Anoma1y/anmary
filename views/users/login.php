<?php 
	if (isset($_COOKIE["user_hash"]) && isset($_COOKIE["user_username"]) && isset($_COOKIE["user_email"]) && isset($_COOKIE["user_id"])) {
	header("Location: /");
	} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Вход</title>
	<link rel="stylesheet" href="/static/css/users.min.css">
</head>
<body>
	<section class="users">
		<div class="user_form">
			<h1>Вход</h1>
			<form action="#" method="POST">
				<div class="label">
					<label for="email">Почта</label>
				</div>
				<input type="email" name="email" id="email">
				<div class="label">
					<label for="password">Пароль</label>
					<span>Забыли пароль</span>
				</div>
				<input type="password" name="password" id="password">
				<button type="submit" name="login" id="login">Войти</button>
			</form>
			<span id="error"></span>
			<a href="/" class="back">Вернуться обратно</a>				
		</div>
	</section>
	<script src="/static/js/libs.min.js"></script>	
	<script src="/static/js/signin.js"></script>	
</body>
</html>


