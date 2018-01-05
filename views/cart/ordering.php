<?php 
	require_once 'engine/Session.php';
	Session::init();
	require_once 'views/index/header.php'; 
?>
<section class="user-cart">
	<div class="container">
		<div class="title">
			<h1><span>Оформление заказа</span></h1>
		</div>
		<div class="ordering">
			<form action="#" class="form-ordering">
				<label for="order-user-name">Имя</label>
				<input type="text" name="order-user-name" id="order-user-name">

				<label for="order-user-email">E-Mail</label>
				<input type="email" name="order-user-email" id="order-user-email">

				<label for="order-user-telephone">Контактный телефон</label>

			</form>			
		</div>

	</div>
</section>


<?php require_once 'views/index/footer.php'; ?>

