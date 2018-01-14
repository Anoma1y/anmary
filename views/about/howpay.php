<?php require_once 'views/index/header.php'; ?>

<div class="about">
	<div class="container howpay">
		<h2 class="line-title">Способы сделать заказ</h2>
		<div class="how-make-order">
			<div class="make-order-ul">
				<p>Если Вы определились с моделью и размером, то заказать и купить товары в нашем магазине можно люым, из нижеперечисленных способов:</p>
				<div class="make-order-ul-step"><i class="fa fa-chevron-right" aria-hidden="true"></i>Вы можете позвонить нам по телефону, указанному в <a href="../contacts">контактах</a>, и мы проконсультируем Вас по размерам и моделям, и примем заказ</div>
				<div class="make-order-ul-step"><i class="fa fa-chevron-right" aria-hidden="true"></i>Можно воспользоваться формой для отправки <a href="../contacts">сообщений</a> на сайте или написать на E-Mail</div>
				<div class="make-order-ul-step"><i class="fa fa-chevron-right" aria-hidden="true"></i>Можно оформить заказ непосредственно на сайте. Дл этого выберите понравившиеся модели, укажите размер и нажмите кнопку "Добавить в корзину", перейдите в корзину и оформите заказ</div>
			</div>

		<h2 class="line-title">Как сделать заказ</h2>
			<div class="make-order-step">
				<div class="step-title">
					<h4>Шаг 1</h4>
				</div>
				<div class="step-content">
					<div class="step-content-text">
						<p>На странице товара, выберите подходящий размер и нажмите кнопку «Добавить в корзину». Каждый размер добавляется в корзину.</p>
					</div>
					<div class="step-content-image">
						<img src="/static/img/about/111.jpg" alt="How buy 1">
					</div>
				</div>
			</div>
			<div class="make-order-step">
				<div class="step-content">
					<div class="step-content-text">
						<p>Чтобы подобрать размер, перейдите на страницу «Определить свой размер».</p>
					</div>
					<div class="step-content-image">
						<img src="/static/img/about/222.jpg" alt="How buy 2">
					</div>
				</div>
			</div>
			<div class="make-order-step">
				<div class="step-title">
					<h4>Шаг 2</h4>
				</div>
				<div class="step-content">
					<div class="step-content-text">
						<p>Для продолжения оформления заказа Вам необходимо перейти в «Корзину».</p>
					</div>
					<div class="step-content-image">
						<img src="/static/img/about/333.jpg" alt="How buy 3">
					</div>
				</div>
			</div>
			<div class="make-order-step">
				<div class="step-title">
					<h4>Шаг 3</h4>
				</div>
				<div class="step-content">
					<div class="step-content-text">
						<p>Для продолжения оформления заказа нажмите «Оформить».</p>
					</div>
					<div class="step-content-image">
						<img src="/static/img/about/444.jpg" alt="How buy 4">
					</div>
				</div>
			</div>			
		</div>
		
			<h2 class="line-title">Как оплатить</h2>
				<div class="how-pay-order">
			<p>Оплата товара производится наличными денежными средствами или с помощью банковской карты, после примерки, в магазине по адресу - <?=$info['address'];?></p>


			<p>Вы также можете зарезервировать понравившийся Вам товар. Если Вы не можете подьехать в ближайшее время, или, не обладаете в настоящий момент денежными средствами, а очень понравилась модель, то она непременно Вас дождется. Мы отложим ее для Вас на срок до 5 дней.</p>
			</div>
	</div>
</div>

<?php require_once 'views/index/footer.php'; ?>
<script type="text/javascript">
	var imageOverlay = $('<div id="overlay-image"></div>');
	var overlayImg = $("<img>");
	imageOverlay.append(overlayImg);

	$("body").append(imageOverlay);
	
	$('.step-content-image img').on('click', function(){
		var imgSrc = $(this).attr("src");

		overlayImg.attr("src", imgSrc);
		imageOverlay.fadeIn('400');
	});	
	
	$("#overlay-image").click(function() {
		$(this).fadeOut('400');
	});
</script>