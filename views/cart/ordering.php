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

		<div class="ordering" id="orderingWrapper">
			<div class="order-confirm-list">
				<table class="order-confirm-table">
					<thead>
						<th>Товар</th>
						<th>Размер</th>
						<th>Цена</th>
					</thead>
					<tbody>
						<?php foreach ($cartItems as $item): ?>
							<?php foreach ($item["size"] as $sizeArr): ?>
								<?php foreach ($sizeArr as $size): ?>
									<tr>
										<td class="cart-table-description">
											<p class="description-name"><span class="strong"><?=$item[name]?> <?=$item[article]?></span> <?=$item[composition]?> <?=$item[brand_name]?> <?=$item[category_name]?></p>
										</td>
										<td class="cart-table-size">
											<?=$size;?>
										</td>
										<?php if ($item["is_sale"] == 1): ?>
											<td class="cart-table-price"><span class="price-name"><?=$item[sale_price]?></span>
											</td>
										<?php elseif($item['is_sale'] == 0): ?>
											<td class="cart-table-price"><span class="price-name"><?=$item[price]?></span>
											</td>
										<?php endif ?>
									</tr>										
								<?php endforeach ?>
							<?php endforeach ?>
						<?php endforeach ?>	
					</tbody>
				</table>
				<div class="order-confirm-price">
					<div class="order-confirm-count-items">
						<span>Количество товаров</span><span class="items-counts"><?=$countItems;?></span>
					</div>
					<div class="order-confirm-count-items">
						<span>Сумма</span><span class="items-prices"><?=$totalPrice;?></span>
					</div>						
				</div>					
		
			</div>
			<div class="order-confirm-form">
				<form action="#" class="form-ordering" method="POST">
					<div>				
						<label for="order-user-name">Имя</label>
						<input type="text" name="order-user-name" id="order-user-name" value="Ivan">
					</div>	
					<div>
						<label for="order-user-email">Почта</label>
						<input type="email" name="order-user-email" id="order-user-email" value="nt-nt@mail.ru">
					</div>
					<div>
						<label for="order-user-telephone">Контактный телефон</label>
						<input type="text" name="order-user-telephone" id="order-user-telephone" value="+79516606759">
					</div>
					<div>
						<label for="order-user-comment">Комментарий к заказу</label>
						<textarea name="order-user-comment" id="order-user-comment"></textarea>
					</div>
					<div class="form-ordering-button">
						<span class="order-error" id="error"></span>
						<button id="order-user-submit" name="order-user-submit">
							<i class="fa fa-share" aria-hidden="true"></i> Подтвердить
						</button>
					</div>
				</form>	
			</div>
		</div>

	</div>
</section>


<?php require_once 'views/index/footer.php'; ?>
<script type="text/javascript" src="/static/js/cart.js"></script>
