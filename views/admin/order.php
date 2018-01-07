<?php require_once 'header.php'; ?>
	<div class="order_list">
		<table>
			<tr>
				<th>Код</th>
				<th>Имя</th>
				<th>Телефон</th>
				<th>Почта</th>
				<th>Комментарий</th>
				<th>Товары</th>
				<th>Дата заказа</th>
				<th>Дата завершение заказа</th>
				<th>Статус</th>
				<th></th>
			</tr>
			<tbody>
			<?php foreach ($order as $index => $item): ?>

				<tr <?php if ($item["status"] == 1): ?> <?php echo "class='order-close'" ?> <?php endif ?>>
					<td><?=$item["code"];?></td>
					<td><?=$item["name"];?></td>
					<td><?=$item["telephone"];?></td>
					<td><?=$item["email"];?></td>
					<td><?=$item["comment"];?></td>
					<td>
						<?php $sssize = $orderDecode[$index]; ?>
						<?php foreach ($productOrder[$index] as $data): ?>
							<p class="order-detail-product"><?=$data["name"];?> <?=$data["article"];?>
								(<?php foreach ($sssize[$data["id"]]["size"] as $key): ?>
									<?=$key;?>
								<?php endforeach ?>)
								<span class="order-product-price"><?=$data["sale_price"];?> руб.</span>
							</p>
						<?php endforeach ?>
					</td>
					<td><?=$item["dateOrder"];?></td>
					<td><?=$item["dateCompleteOrder"];?></td>
					<td>
						<?php if ($item["status"] == 1): ?>
							Выполнен
						<?php else: ?>
							Ожидается
						<?php endif ?>
					</td>
					<?php if ($item["status"] == 0): ?>
						<td class="tdBtnCloseOrder" data-code="<?=$item["code"]?>">Завершить</td>
					<?php else: ?>
						<td></td>
					<?php endif ?>
				</tr>
			<?php endforeach ?>
			</tbody>
		</table>
	</div>



<script src="/static/js/libs.min.js"></script>
<script src="/static/js/adminOrder.js"></script>
<?php require_once 'footer.php'; ?>

