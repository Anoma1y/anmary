<?php require_once 'views/index/header.php'; ?>
<section id="main_slider">
	<!-- <div class="container"> -->
		<div class="main_slider">
			<ul class="rslides" id="slider">
				<li>
					<img src="static/img/slider/first.jpg" alt="Slider">
		          <div class="caption">
		          	
		          	<h2>Элегантность и качество</h2>
		          	<h4>лучшие цены</h4>
		          </div>
				</li>
				<li>
					<img src="static/img/slider/second.jpg" alt="Slider">
		          <div class="caption">
		          	<h2>Стильная женская одежда</h2>
		          	<h4>из стран прибалтики</h4>
		          </div>
				</li>
				<li>
					<img src="static/img/slider/third.jpg" alt="Slider">
		          <div class="caption">
		          	<h4>Высокое качество изделий</h4>
		          	<h2>Уникальные натуральные ткани</h2>
		          </div>
				</li>
			</ul>			
		</div>
    <a class="arrow-main" href="#blocks-info">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </a>
	<!-- </div> -->
</section>

<section id="blocks-info">
	<div class="blocks">
		<div class="block new_collections" data-aos="zoom-in-right" data-aos-duration="500">
			<div class="collection_info">
				<div class="collection_name">
					<h2>Осень/Зима</h2>
					<h2>2017/2018</h2>
					<p>Новое поступление</p>
				</div>
				<a href="/catalog/last_season">Смотреть коллекцию</a>
			</div>
			<div class="overlay"></div>
		</div>
		<div class="block season_sale" data-aos="zoom-in-down" data-aos-duration="500">
			<a href="/catalog/sale" class="season_sale_info">
				<p>Сезонная распродажа</p>
				<h1>Sale</h1>
			</a>
		</div>
		<div class="block new_arrivals" data-aos="zoom-in-left" data-aos-duration="500">
			<div class="overlay"></div>
			<div class="arrivals_info">
				<h1>Последнее поступление</h1>
				<a href="/catalog/newest">Смотреть</a>
			</div>			
		</div>
		<div class="block subscribe" data-aos="zoom-in-up" data-aos-duration="500">
			<div class="overlay"></div>
			<div class="get_subscribe">
				<h2>Подписаться на рассылку</h2>
			</div>
			<div class="formSubscribe">
				<input type="text" placeholder="Введите E-Mail" id="get_subscribe_email" name="get_subscribe_email">
				<button id="get_subscribe_btn" name="get_subscribe_btn"><i class="fa fa-plus"></i></button>
				<span id="error-subscribe"></span>
			</div>
		</div>
		<div class="block all_catalog" data-aos="zoom-in-left" data-aos-duration="500">
			<div class="overlay"></div>
			<div class="catalog_info">
				<h2>Большой выбор женской одежды</h2>
			</div>
			<a href="/catalog/all" class="get_catalog">
				Перейти в каталог
			</a>
		</div>
	</div>
</section>


<section id="latest_viewed">
	<div class="container">
		<h2 class="line-title">Рекомендуем</h2>
	</div>
	<div class="container">
		<div class="product_list" data-aos="zoom-in" data-aos-duration="1000">
			<?php foreach ($lastProduct as $key => $product): ?>
				<div class="product" >
					<div class="product__image">
						<a href="/product/<?=$product[id];?>">
							<img src="<?=$product[image];?>" alt="Latest Product">
						</a>
					</div>
					<div class="product__info">
						<p class="product__brand"><?=$product[brand_name];?></p>
						<p class="product__title"><?=$product[name];?> <?=$product[article];?></p>
						<?php if ($product['is_sale'] == 0): ?>
							<span class="product__price"><?=$product[price];?></span>
						<?php elseif ($product['is_sale'] == 1): ?>
							<span class="product__price product__price-old"><?=$product[price];?></span>
							<span class="product__price product__price-sale"><?=$product[sale_price];?></span>
						<?php endif ?>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</section>

<section class="featured_brand" id="featured_brand">
	<div class="container">
		<h2 class="line-title">Популярные бренды</h2>
	</div>
	<div class="container brand_container">
		<div class="brand_item" data-aos="zoom-in-left">
			<img src="/static/img/logo/Comvill.png" alt="Logo">
		</div>
		<div class="brand_item" data-aos="zoom-in-left">
			<img src="/static/img/logo/magnolica.png" alt="Logo">
		</div>
		<div class="brand_item" data-aos="zoom-in-up">
			<img src="/static/img/logo/TopDesign.png" alt="Logo">
		</div>
		<div class="brand_item" data-aos="zoom-in-right">
			<img src="/static/img/logo/vaideslide.png" alt="Logo">
		</div>
		<div class="brand_item" data-aos="zoom-in-right">
			<img src="/static/img/logo/vito-logo.png" alt="Logo">
		</div>
	</div>
</section>


 

<?php require_once 'views/index/footer.php'; ?>
<script type="text/javascript" src="static/js/index.js"></script>