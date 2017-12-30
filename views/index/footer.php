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
						<li><a href="/">Главная</a></li>
						<li><a href="/catalog">Каталог</a></li>
						<li><a href="/news">Новости</a></li>
						<li><a href="/contacts">Контакты</a></li>
					</ul>
				</nav>
				<nav>
					<h4>Каталог</h4>
					<ul class="footer_menu">
						<li><a href="/catalog/newest">Новинки</a></li>
						<li><a href="/catalog/sale">Скидки</a></li>
						<li><a href="/catalog/last_season">Новый сезон</a></li>
					</ul>
				</nav>
			</div>
			<div class="footer-right">
				<div class="footer_contact">
					<h3>Связаться с нами</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. In, maxime!</p>
				</div>
				<div class="footer_email">
					<p><?=$info["email"]?></p>
				</div>
				<div class="footer_social">
					<i class="fa fa-vk" aria-hidden="true"></i>
					<i class="fa fa-skype" aria-hidden="true"></i>
					<i class="fa fa-odnoklassniki" aria-hidden="true"></i>
				</div>
			</div>
		</div>
	</footer>
	<!--[if lt IE 9]>
	<script src="libs/html5shiv/es5-shim.min.js"></script>
	<script src="libs/html5shiv/html5shiv.min.js"></script>
	<script src="libs/html5shiv/html5shiv-printshiv.min.js"></script>
	<script src="libs/respond/respond.min.js"></script>
	<![endif]-->
	
	<script src="/static/js/polyfill.object-fit.min.js"></script>
	<script>
		objectFit.polyfill({
			selector: 'img', 
			fittype: 'cover', 
			disableCrossDomain: 'true'
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
	</script>
</body>
</html>