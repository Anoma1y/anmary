<?php $info = include('engine/info.php'); require_once 'engine/Cart.php'; Session::init();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Магазин женской одежды Анмари</title>
	<meta name="description" content="Магазин женской одежды в Санкт-Петербурге. Трикотаж от известных европейских (Италия, Польша, Латвия, Франция) производителей женской одежды Vaide, Comvill, Top Design, MADO, Ancora и т.д.">
	<meta name="google-site-verification" content="XTGy26KTjTbJvVrvgTcx4V98DO1COFmE_3cVT-R8DTk" />
	<meta name="yandex-verification" content="ef739025f523584c" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" sizes="180x180" href="/static/img/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/static/img/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/static/img/favicon/favicon-16x16.png">
	<link rel="manifest" href="/static/img/favicon/manifest.json">
	<link rel="mask-icon" href="/static/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="apple-mobile-web-app-title" content="Anmary">
	<meta name="application-name" content="Anmary">
	<meta name="theme-color" content="#ffffff">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="/static/css/responsiveslides.css">
	<link rel="stylesheet" href="/static/css/simplePagination.css">
	<link rel="stylesheet" href="/static/css/polyfill.object-fit.min.css">
	<link rel="stylesheet" href="/static/css/aos.css">
	<link rel="stylesheet" href="/static/css/main.min.css">
	<script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter47320977 = new Ya.Metrika({ id:47320977, clickmap:true, trackLinks:true, accurateTrackBounce:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script>
	<noscript><div><img src="https://mc.yandex.ru/watch/47320977" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
</head>
<body>

<header>
	<div class="header-top">
		<div class="container">
			<div class="header-top-left">
				<div class="header-top-email">
					<i class="fa fa-envelope" aria-hidden="true"></i>
					<a href="mailto:<?=$info["email"];?>"><?=$info["email"];?></a>
				</div>
				<div class="header-top-telephone">
					<i class="fa fa-phone" aria-hidden="true"></i>
					<span><?=$info["telephone"];?></span>
				</div>
			</div>
			<div class="header-top-right">
				<div class="header-top-user">
                    <?php if (!isset($_COOKIE["user_username"])): ?>
						<div>
							<i class="fa fa-sign-in" aria-hidden="true"></i><a href="/users/signin">Вход</a>
						</div>
						<div>
							<i class="fa fa-user-plus" aria-hidden="true"></i><a href="/users/signup">Регистрация</a>
						</div>                     
                    <?php else: ?>
						<div>
							<i class="fa fa-sign-out" aria-hidden="true"></i><a href="/users/logout">Выход</a>
						</div>
						<div>
							<i class="fa fa-user-circle" aria-hidden="true"></i><a href="../admin">Мой профиль</a>
						</div>
                    <?php endif; ?>

				</div>
				<div class="header-top-cart">
					<a href="../cart">
						<div class="cart-total">
							<i class="fa fa-shopping-basket" aria-hidden="true"></i>
								<span class="cart-total-price"><?php echo UserCart::getTotalPrice(UserCart::getCartItems());?></span> 
								(Товаров: <span id="cart-quantity" class="cart-quantity"><?php echo UserCart::countItems();?></span>)
						</div>
					</a>
				</div>	
			</div>
		</div>
	</div>
	<div class="menu_container">
		<div class="header-middle">
			<div class="header_container">
				<div class="header-logo">
					<img src="/static/img/logo.svg" alt="Logo">
				</div>
				<div class="header-search">
					<form class="search-content" method="#" action="#">
						<input type="text" class="searchText" id="searchText" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Поиск';}" required="" value="Поиск">
						<button id="search"><i class="fa fa-search" aria-hidden="true"></i></button>		
					</form>
				</div>
				<div class="social-network">
					<div class="social-network-item">
						<i class="fa fa-vk" aria-hidden="true"></i>
					</div>
					<div class="social-network-item">
						<i class="fa fa-skype" aria-hidden="true"></i>
					</div>
					<div class="social-network-item">
						<i class="fa fa-facebook" aria-hidden="true"></i>
					</div>
				</div>	
			</div>
		</div>
	</div>
	<div class="menu_container">
		<div class="header-bottom">
			<div class="header-menu">
				<div class="container">
					<nav class="navigation">
						<div class="mobile-menu">
							<a class="mobile-trigger" href="#" id="mobile-trigger"><span></span></a>
							<nav class="menu-main-wrap">
								<ul class="ui menu menu-effect_1">
									<li><a href="/">Главная</a></li>
									<li><a href="/news">Новости</a></li>
									<li><a href="/catalog/newest">Новинки</a></li>
									<li><a href="/catalog/all">Каталог</a></li>
									<li><a href="/catalog/sale">Скидки</a></li>
									<li><a href="/contacts">Контакты</a></li>
								</ul>
							</nav>
							<div class="menu-main-overlay"></div>
						</div>
						<ul>
							<li><a href="/">Главная</a></li>
							<li><a href="/news">Новости</a></li>
							<li><a href="/catalog/newest">Новинки</a></li>
							<li><a href="/catalog/all">Каталог</a></li>
							<li><a href="/catalog/sale">Скидки</a></li>
							<li><a href="/contacts">Контакты</a></li>
						</ul>
					</nav>						
				</div>
			</div>
		</div>
	</div>
</header>	