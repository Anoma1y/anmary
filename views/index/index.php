<?php require_once 'views/index/header.php'; ?>
<section id="main_slider">
	<div class="container">
		<div class="main_slider">
			<ul class="rslides" id="slider">
				<li>
					<img src="static/img/slider/first.jpg" alt="Slider">
		          <div class="caption">
		          	<h4>SOMTHING IS BETTER</h4>
		          	<h2>Fashion Lorrem</h2>
		          </div>
				</li>
				<li>
					<img src="static/img/slider/second.jpg" alt="Slider">
		          <div class="caption">
		          	<h4>SOMTHING IS BETTER</h4>
		          	<h2>Lorem ipsum.</h2>
		          </div>
				</li>
				<li>
					<img src="static/img/slider/third.jpg" alt="Slider">
		          <div class="caption">
		          	<h4>SOMTHING IS BETTER</h4>
		          	<h2>dolor sit amet.</h2>
		          </div>
				</li>
			</ul>			
		</div>
		
	</div>
</section>

<section>
	<div class="blocks">
		<div class="block new_collections">
			<div class="collection_info">
				<div class="collection_name">
					<h2>Осень/Зима</h2>
					<h2>2017/2018</h2>
					<p>Новое поступление</p>
				</div>
				<a href="#">Смотреть коллекцию</a>
			</div>
			<div class="overlay"></div>
		</div>
		<div class="block season_sale">
			<div class="season_sale_info">
				<p>Сезонная распродажа</p>
				<h1>Sale</h1>
			</div>
		</div>
		<div class="block new_arrivals">
			<div class="overlay"></div>
			<div class="arrivals_info">
				<h1>Последнее поступление</h1>
				<a href="#">Смотреть</a>
			</div>			
		</div>
		<div class="block subscribe">
			<div class="overlay"></div>
			<div class="get_subscribe">
				<h2>Подписаться на рассылку</h2>
			</div>
			<div class="formSubscribe">
				<input type="text" placeholder="Введите E-Mail" id="get_subscribe" name="get_subscribe">
				<button id="get_subscribe_btn" name="get_subscribe_btn"><i class="fa fa-plus"></i></button>
			</div>
		</div>
		<div class="block all_catalog">
			<div class="overlay"></div>
			<div class="catalog_info">
				<h2>Большой выбор женской одежды</h2>
			</div>
			<a href="#" class="get_catalog">
				Перейти в каталог
			</a>
		</div>
	</div>
</section>


<section id="latest_viewed">
	<div class="container">
		<div class="title">
			<h1>Lorem ipsum dolor sit.</h1>
			<h3>Lorem ipsum dolor sit amet, consectetur.</h3>
		</div>
	</div>
	<div class="container">
		<div class="product_list">
			<?php foreach ($lastProduct as $key => $product): ?>
				
				
				<div class="product">
					<div class="product__image">
						<a href="/product/<?=$product[id];?>">
							<img src="<?=$product[image];?>" alt="Latest Product">
						</a>
					</div>
					<div class="product__info">
						<p class="product__brand"><?=$product[brand_name];?></p>
						<p class="product__title"><?=$product[name];?><?=$product[article];?></p>
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
		<div class="title">
			<h1>Популярные бренды</h1>
			<h3>Lorem ipsum dolor sit amet, consectetur.</h3>
		</div>
	</div>
	<div class="container brand_container">
		<div class="brand_item">
			<a href="#">
				<img src="/static/img/logo/comvill.png" alt="Logo">
			</a>
		</div>
		<div class="brand_item">
			<a href="#">
				<img src="/static/img/logo/magnolica.png" alt="Logo">
			</a>
		</div>
		<div class="brand_item">
			<a href="#">
				<img src="/static/img/logo/TopDesign.png" alt="Logo">
			</a>
		</div>
		<div class="brand_item">
			<a href="#">
				<img src="/static/img/logo/vaideslide.png" alt="Logo">
			</a>
		</div>
		<div class="brand_item">
			<a href="#">
				<img src="/static/img/logo/vito-logo.png" alt="Logo">
			</a>
		</div>
	</div>
</section>

<script src="static/js/libs.min.js"></script>
<script src="/static/js/responsiveslides.min.js"></script>
<script src="static/js/index.js"></script> 

<?php require_once 'views/index/footer.php'; ?>
