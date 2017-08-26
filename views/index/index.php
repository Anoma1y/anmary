<?php require_once '/views/index/header.php'; ?>

<div id="brand" class="brand-area">
	<div class="container">
		<div class="brand-content">
			<div class="row">
				<div class="brand-carousel">
						<div class="single-brand" data-aos="zoom-in-down">
							<a href="#">
								<img src="../static/img/vaideslide.png" alt=""></a>
						</div>
						<div class="single-brand" data-aos="zoom-in-down">
							<a href="#">
								<img src="../static/img/vaideslide.png" alt=""></a>
						</div>
						<div class="single-brand" data-aos="zoom-in-down">
							<a href="#">
								<img src="../static/img/vaideslide.png" alt=""></a>
						</div>
						<div class="single-brand" data-aos="zoom-in-down">
							<a href="#">
								<img src="../static/img/vaideslide.png" alt=""></a>
						</div>
						<div class="single-brand" data-aos="zoom-in-down">
							<a href="#">
								<img src="../static/img/vaideslide.png" alt=""></a>
						</div>
						<div class="single-brand" data-aos="zoom-in-down">
							<a href="#">
								<img src="../static/img/vaideslide.png" alt=""></a>
						</div>
						<div class="single-brand" data-aos="zoom-in-down">
							<a href="#">
								<img src="../static/img/vaideslide.png" alt=""></a>
						</div>
						<div class="single-brand" data-aos="zoom-in-down">
							<a href="#">
								<img src="../static/img/vaideslide.png" alt=""></a>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="catalog">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3>Популярные модели</h3>
			</div>
		</div>
		<div class="items" >
		 		<div class="row">
		 			<?php 
		 				foreach ($data as $key) {
		 					echo '<div class="col-md-3 col-sm-6">';
		 					echo '<div class="item" data-aos="zoom-in-down">';
		 					echo '<img src="../static/img/banner_8.jpg" alt="">';
		 					echo '<p class="item_name">'.$key[name].'</p>';
		 					echo '<p class="item_price">'.$key[price].'</p>';
		 					echo '</div></div>';
		 				}
		 			?>
		 		</div>
		 	</div> 
		 	<div class="row">
		 		<div class="col-md-4 col-md-offset-4">
		 			<a href="#" class="get_catalog">Посмотреть полный каталог</a>
		 		</div>		 			
		 	</div>	
	</div>
</div>
<div id="reasons">
	<div class="container">
		<div class="row">
			<h3>Причины выбора <br> прибалтийского трикотажа</h3>
		</div>
		<div class="reasons">
			<div class="row">
				<div class="col-md-6 clearPadding">
					<div class="reasons_item" data-aos="flip-right">
						<div class="reasons_img"><img src="../static/img/quality.png" alt=""></div>
						<p>Уникальные и натуральные ткани</p>
					</div>
				</div>
				<div class="col-md-6 clearPadding">
					<div class="reasons_item" data-aos="flip-right">
						<div class="reasons_img"><img src="../static/img/quality.png" alt=""></div>
						<p>Высокое качество изделий</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 clearPadding">
					<div class="reasons_item" data-aos="flip-left">
						<div class="reasons_img"><img src="../static/img/quality.png" alt=""></div>
						<p>Работа европейских дизайнеров</p>
					</div>
				</div>
				<div class="col-md-6 clearPadding">
					<div class="reasons_item" data-aos="flip-left">
						<div class="reasons_img"><img src="../static/img/quality.png" alt=""></div>
						<p>Большой размерный ряд</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-2 col-sm-3 col-xs-4">
				<div class="footer_menu">
					<p>Информация</p>
					<ul>
						<li><a href="#main">Главная</a></li>
						<li><a href="#">Контакты</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-2 col-sm-3 col-xs-4">
				<div class="footer_menu">
					<p>Каталог</p>
					<ul>
						<li><a href="#">Все</a></li>
<!-- 						<li><a href="#">Главная</a></li>
						<li><a href="#">Главная</a></li>
						<li><a href="#">Главная</a></li> -->
					</ul>
				</div>
			</div>
			<div class="col-md-3 col-md-offset-5 col-sm-6 col-xs-4">
				<div class="credit_card">
					<p>Принимаем к оплате:</p>
					<div class="card_item">
						<img src="../static/img/maestro.png" alt="">
					</div>
					<div class="card_item">
						<img src="../static/img/maestro.png" alt="">
					</div>
					<div class="card_item">
						<img src="../static/img/maestro.png" alt="">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="copyright">
					<div class="logo">
						<img src="../static/img/logo.png" alt="">
					</div>
					<span>
						Авторские права © 2017 "Магазин"
					</span>
				</div>	
			</div>
			<div class="col-md-6">
				<div class="contact">
					<div class="telephone">
						<p>7-(963)-040-25-19</p>
					</div>
					<div class="adress">
						<p>г. Санкт Петербург, Скобелевский пр.,</p>
						<p>ТЦ Президентский, 2 этаж</p>
						<p>nt-nt@mail.ru</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
		<script src="static/js/aos.js"></script>
		<script src="static/js/owl.carousel.min.js"></script>
		<script>
		    AOS.init();

			$(document).ready(function() {
				$(window).resize(function(event) {
					var chechMenu = document.getElementById('mobile_nav').style.display;
					if (chechMenu == "block" && event.currentTarget.innerWidth >= 1040) {
						$("#mobile_nav").stop().hide("300");
						$('.logo').stop().show()
					}
				})
				$('.close_mobile').click(function() {
					$("#mobile_nav").stop().hide('300');
					$('.logo').stop().show()					
				});
				$('#mobile_toggle').on('click', function(){
					$('.logo').hide()
					$('#mobile_nav').show('400');
				});
				$('a[href^="#brand"], a[href^="#main"]').on('click', function (e) {
			        e.preventDefault();
			        var target = this.hash;
			        $target = $(target);
			        $('html, body').stop().animate({
			            'scrollTop': $target.offset().top+2
			        }, 800, 'swing', function () {
			            window.location.hash = target;
			        });
			    });
				$(".brand-carousel").owlCarousel({
			        autoPlay: true, 
			        slideSpeed:3000,
			        pagination:false,
			        navigation:false,	  
			        items : 3,
			    }); 
			});
		</script>

<?php //var_dump($_COOKIE) ?>


<?php //require_once '/views/index/footer.php'; ?>
