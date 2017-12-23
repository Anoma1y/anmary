<?php require_once 'views/index/header.php'; ?>


<header>
	<div class="container">
		<div class="header_info">
			<div class="user_info">
				<div class="icon">
					<i class="fa fa-user-circle" aria-hidden="true"></i>
				</div>
				<div class="user_control">
					<span class="sign_in">Войти</span>
					<span class="sign_up">Регистрация</span>
				</div>
			</div>
			<div class="logo">
				<img src="/static/img/2.svg" alt="">
			</div>
			<div class="shop_info">
				<div class="compare_info">
					<span class="info_count">13</span>
					<i class="fa fa-heart-o" aria-hidden="true"></i>
				</div>
				<div class="products_info">
					<span class="info_count">13</span>
					<i class="fa  fa-shopping-basket" aria-hidden="true"></i>
					<span>4500</span>					
				</div>
			</div>
		</div>
	</div>
	<div class="menu_container">
		<div class="header_menu">
			<div class="container">
				<div class="search">
					<i class="fa fa-search" aria-hidden="true"></i>
				</div>	
				<nav class="navigation">
					<ul>
						<li><a href="#">Link-1</a></li>
						<li><a href="#">Link-2</a></li>
						<li><a href="#">Link-3</a></li>
						<li><a href="#">Link-4</a></li>
						<li><a href="#">Link-5</a></li>
						<li><a href="#">Link-6</a></li>
					</ul>
				</nav>
				<div class="social_network">
					
				</div>		
			</div>
		</div>
	</div>
</header>


<!-- <section id="main_slider">
	<div class="container">
		<div class="main_slider">
			<ul class="rslides" id="slider">
				<li>
					<img src="static/img/slider/first.jpg" alt="Slider">
				</li>
				<li>
					<img src="static/img/slider/second.jpg" alt="Slider">
				</li>
				<li>
					<img src="static/img/slider/third.jpg" alt="Slider">
				</li>
			</ul>			
		</div>
		
	</div>
</section> -->

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
			<div class="product">
				<div class="product__image">
					<a href="#">
						<img src="/static/img/product/prod-1.png" alt="Latest Product">
					</a>
				</div>
				<div class="product__info">
					<p class="product__brand">Vaide</p>
					<p class="product__title">Product Title</p>
					<span class="product__price">2 001</span>
				</div>
			</div>
			<div class="product">
				<div class="product__image">
					<a href="#">
						<img src="/static/img/product/prod-2.png" alt="Latest Product">
					</a>
				</div>
				<div class="product__info">
					<p class="product__brand">Vaide</p>
					<p class="product__title">Product Title</p>
					<span class="product__price product__price-old">2 002</span>
					<span class="product__price product__price-sale">1 750</span>
				</div>
			</div>
			<div class="product">
				<div class="product__image">
					<a href="#">
						<img src="/static/img/product/prod-3.png" alt="Latest Product">
					</a>
				</div>
				<div class="product__info">
					<p class="product__brand">ComvilL</p>
					<p class="product__title">Product Title</p>
					<span class="product__price">2 003</span>
				</div>
			</div>
			<div class="product">
				<div class="product__image">
					<a href="#">
						<img src="/static/img/product/prod-4.png" alt="Latest Product">
					</a>
				</div>
				<div class="product__info">
					<p class="product__brand">Vaide</p>
					<p class="product__title">Product Title</p>
					<span class="product__price">2 004</span>
				</div>
			</div>
			<div class="product">
				<div class="product__image">
					<a href="#">
						<img src="/static/img/product/prod-5.png" alt="Latest Product">
					</a>
				</div>
				<div class="product__info">
					<p class="product__brand">Vaide</p>
					<p class="product__title">Product Title</p>
					<span class="product__price">2 005</span>
				</div>
			</div>
		</div>
	</div>
</section>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="/static/js/responsiveslides.min.js"></script>
<script>
	$("#slider").responsiveSlides({
		auto: true,
		pager: false,
		nav: true,
		speed: 500,
		namespace: "callbacks",
		before: function () {
			$('.events').append("<li>before event fired.</li>");
		},
		after: function () {
			$('.events').append("<li>after event fired.</li>");
		}
	});
</script>
<?php require_once 'views/index/footer.php'; ?>
