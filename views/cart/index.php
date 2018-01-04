<?php 
	require_once 'engine/Session.php';
	Session::init();
	require_once 'views/index/header.php';
?>


<section class="user-cart">
	<div class="container">
		<div class="title">
			<h1><span>Корзина</span></h1>
		</div>
		<div class="cart-container">
			<div class="cart-list">
				<table class="cart-table">
					<thead>
						<th class="cart-table-image"></th>
						<th class="cart-table-description">Описание</th>
						<th class="cart-table-size">Размер</th>
						<th class="cart-table-brand">Бренд</th>
						<th class="cart-table-category">Категория</th>
						<th class="cart-table-price">Цена</th>
					</thead>
					<tbody>
						<?php foreach ($cartItems as $item): ?>
							<tr>
								<td class="cart-table-image">
									<a href="../product/<?=$item[id]?>"><img src="<?=$item[image]?>" alt=""></a>
								</td>
								<td class="cart-table-description"><?=$item[name]?> <?=$item[article]?> <?=$item[composition]?></td>
								<td class="cart-table-size"><?=$item[size]?></td>
								<td class="cart-table-brand"><?=$item[brand_name]?></td>
								<td class="cart-table-category"><?=$item[category_name]?></td>
								<?php if ($item["is_sale"] == 1): ?>
									<td class="cart-table-price"><?=$item[sale_price]?>
										<span class="cart-delete-item" data-id="<?=$item["id"];?>">X</span>
									</td>
								<?php elseif($item['is_sale'] == 0): ?>
									<td class="cart-table-price"><?=$item[price]?>
										<span class="cart-delete-item" data-id="<?=$item["id"];?>">X</span>
									</td>
								<?php endif ?>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<div class="cart-total-price">
					<span>Сумма: </span><span><?=$totalPrice?></span>
				</div>
			</div>

		</div>
	</div>
</section>



	<?php  require_once 'views/index/footer.php'; ?>
	<script type="text/javascript" src="/static/js/cart.js"></script>




