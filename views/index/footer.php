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






	<!--[if lt IE 9]>
	<script src="libs/html5shiv/es5-shim.min.js"></script>
	<script src="libs/html5shiv/html5shiv.min.js"></script>
	<script src="libs/html5shiv/html5shiv-printshiv.min.js"></script>
	<script src="libs/respond/respond.min.js"></script>
	<![endif]-->
			<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
		<script src="static/js/aos.js"></script>
		<script src="static/js/owl.carousel.min.js"></script>
	<script type="text/javascript">
	// (function(){var script={'scripts': 
	// 	[{"src": "/static/js/libs.min.js", "async": false},
	// 	 {"src": "/static/js/index.js", "async": false},]}; for(var i=0;i<script["scripts"].length;i++){s=document.createElement('script');s.type="text/javascript";s.async=script["scripts"][i]['async'];s.src=script["scripts"][i]['src'];document.body.appendChild(s)};})();
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

</body>
</html>