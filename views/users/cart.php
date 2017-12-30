<h1>Корзина</h1>
<?php 

	
	require_once './models/cart.php';
	$get = Cart::getAllProductByCart([44, 46]);
	var_dump($get);
?>