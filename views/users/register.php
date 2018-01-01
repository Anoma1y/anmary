<?php 
	if (isset($_COOKIE["user_hash"]) && isset($_COOKIE["user_username"]) && isset($_COOKIE["user_email"]) && isset($_COOKIE["user_id"])) {
	header("Location: /");
	} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Регистрация</title>
	<link rel="stylesheet" href="/static/css/users.min.css">
</head>
<body>
	<section class="users">
		<div class="user_form">
			<h1>Регистрация</h1>
			<form action="#" method="POST">
				<div class="label">
					<label for="username">Логин</label>
				</div> 
				<input type="text" id="username" name="username" />
				<div class="label">
					<label for="email">Почта</label>
				</div> 
				<input type="email" id="email" name="email" />
				<div class="label">
					<label for="password">Пароль</label>
				</div> 
				<input type="password" id="password" name="password" />
				<button type="submit" name="register" id="register">Регистрация</button>
			</form>
			<span id="error"></span>
			<a href="/" class="back">Вернуться обратно</a>				
		</div>
	</section>
	<script src="/static/js/libs.min.js"></script>	
	<script src="/static/js/signup.js"></script>	
</body>
</html>




