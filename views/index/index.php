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
					<p>4500</p>					
				</div>
			</div>
		</div>
	</div>
	<div class="menu_container">
		<div class="header_menu">
			<div class="header_container">
				<div class="search">
					<i class="fa fa-search" id="searchBtn" aria-hidden="true"></i>
					<div class="search_input">
						<input type="text" class="searchText" id="searchText" placeholder="Поиск">
						<button id="search"><i class="fa fa-search" aria-hidden="true"></i></button>		
					</div>
				</div>	
				<nav class="navigation">
					<div class="mobile-menu">
						<a class="mobile-trigger" href="#" id="mobile-trigger"><span></span></a>
						<nav class="menu-main-wrap">
							<ul class="ui menu menu-effect_1">
								<li><a href="#">Главная</a></li>
								<li><a href="#">Каталог</a></li>
								<li><a href="#">Link-3</a></li>
								<li><a href="#">Link-4</a></li>
								<li><a href="#">Link-5</a></li>
								<li><a href="#">Контакты</a></li>
							</ul>
						</nav>
						<div class="menu-main-overlay"></div>
					</div>
					<ul>
						<li><a href="#">Главная</a></li>
						<li><a href="#">Каталог</a></li>
						<li><a href="#">Link-3</a></li>
						<li><a href="#">Link-4</a></li>
						<li><a href="#">Link-5</a></li>
						<li><a href="#">Контакты</a></li>
					</ul>
				</nav>
				<div class="social_network">
					<i class="fa fa-vk" aria-hidden="true"></i>
					<i class="fa fa-skype" aria-hidden="true"></i>
					<i class="fa fa-odnoklassniki" aria-hidden="true"></i>
				</div>		
			</div>
		</div>
	</div>
</header>


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
			<div class="product">
				<div class="product__image">
					<a href="#">
						<img src="http://via.placeholder.com/238x350" alt="Latest Product">
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
						<img src="http://via.placeholder.com/238x350" alt="Latest Product">
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
						<img src="http://via.placeholder.com/238x350" alt="Latest Product">
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
						<img src="http://via.placeholder.com/238x350" alt="Latest Product">
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
						<img src="http://via.placeholder.com/238x350" alt="Latest Product">
					</a>
				</div>
				<div class="product__info">
					<p class="product__brand">Vaide</p>
					<p class="product__title">Product Title</p>
					<span class="product__price">2 005</span>
				</div>
			</div>
						<div class="product">
				<div class="product__image">
					<a href="#">
						<img src="http://via.placeholder.com/238x350" alt="Latest Product">
					</a>
				</div>
				<div class="product__info">
					<p class="product__brand">Vaide</p>
					<p class="product__title">Product Title</p>
					<span class="product__price">2 005</span>
				</div>
			</div>
						<div class="product">
				<div class="product__image">
					<a href="#">
						<img src="http://via.placeholder.com/238x350" alt="Latest Product">
					</a>
				</div>
				<div class="product__info">
					<p class="product__brand">Vaide</p>
					<p class="product__title">Product Title</p>
					<span class="product__price">2 005</span>
				</div>
			</div>
						<div class="product">
				<div class="product__image">
					<a href="#">
						<img src="http://via.placeholder.com/238x350" alt="Latest Product">
					</a>
				</div>
				<div class="product__info">
					<p class="product__brand">Vaide</p>
					<p class="product__title">Product Title</p>
					<span class="product__price">2 005</span>
				</div>
			</div>
						<div class="product">
				<div class="product__image">
					<a href="#">
						<img src="http://via.placeholder.com/238x350" alt="Latest Product">
					</a>
				</div>
				<div class="product__info">
					<p class="product__brand">Vaide</p>
					<p class="product__title">Product Title</p>
					<span class="product__price">2 005</span>
				</div>
			</div>
						<div class="product">
				<div class="product__image">
					<a href="#">
						<img src="http://via.placeholder.com/238x350" alt="Latest Product">
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
<footer>
	<div class="container">
		<div class="footer-left">
			<div class="footer_logo">
				<h1>Anmary</h1>
			</div>
			<div class="footer_about">
				<h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam molestias eligendi officiis in. Voluptate officia, velit dolore. Molestias, obcaecati, quidem.</h4>
			</div>
			<div class="copyright">
				<p>© 2016 - 2017 Anmary</p>
			</div>
		</div>
		<div class="footer-center">
			<nav>
				<h4>Навигация</h4>
				<ul class="footer_menu">
					<li><a href="#">Ссылка-1</a></li>
					<li><a href="#">Ссылка-2</a></li>
					<li><a href="#">Ссылка-3</a></li>
					<li><a href="#">Ссылка-4</a></li>
				</ul>
			</nav>
			<nav>
				<h4>Каталог</h4>
				<ul class="footer_menu">
					<li><a href="#">Ссылка-1</a></li>
					<li><a href="#">Ссылка-2</a></li>
					<li><a href="#">Ссылка-3</a></li>
					<li><a href="#">Ссылка-4</a></li>
				</ul>
			</nav>
		</div>
		<div class="footer-right">
			<div class="footer_contact">
				<h3>Связаться с нами</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. In, maxime!</p>
			</div>
			<div class="footer_email">
				<p>email@mail.ru</p>
			</div>
			<div class="footer_social">
				<i class="fa fa-vk" aria-hidden="true"></i>
				<i class="fa fa-skype" aria-hidden="true"></i>
				<i class="fa fa-odnoklassniki" aria-hidden="true"></i>
			</div>
		</div>
	</div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="/static/js/responsiveslides.min.js"></script>
<script>
	$("#slider").responsiveSlides({
		auto: true,
		pager: false,
		nav: true,
		speed: 1000,
		namespace: "callbacks",
		before: function() {
			$('.events').append("<li>before event fired.</li>");
		},
		after: function() {
			$('.events').append("<li>after event fired.</li>");
		}
	});
	$('#searchBtn').on('click', function() {
		$(this).fadeOut('400');
		$('.search_input').fadeIn('400');
	});
	//Mobile Menu
	$('#mobile-trigger').bind('click', function (e) {
		$(this).toggleClass('active');
		e.preventDefault();
		$('.menu-main-overlay').fadeIn('400', function () {
			$('#menu-open').toggleClass('active');
			$('.menu-main-wrap').toggleClass('active');
			$('.menu-effect_1').toggleClass('active');
		});
	});

	$('.menu-main-overlay').bind('click', function () {
		$('.menu-main-overlay').fadeOut('400', function () {
			$('#menu-open').removeClass('active');
			$('#icon-toggle').removeClass('active');
			$('.menu-main-wrap').removeClass('active');
			$('.menu-effect_1').removeClass('active');
		});
	});
	$(window).resize(function() {
		if ($(window).width() >= 996) {
			$('.menu-main-overlay').fadeOut('400', function () {
				$('#menu-open').removeClass('active');
				$('#icon-toggle').removeClass('active');
				$('.menu-main-wrap').removeClass('active');
				$('.menu-effect_1').removeClass('active');
			});
		}
	});

</script>
<?php require_once 'views/index/footer.php'; ?>
