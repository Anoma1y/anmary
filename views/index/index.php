<?php require_once '/views/index/header.php'; ?>




	<header id="main">
		<div class="bg-image"></div>
		<div class="bg_blackout"></div>
		<div class="container">
			<div class="row">
					<ul id="mobile_nav">
 						<a class="close_mobile">X</a>
 						<li>
 							<a href="#">
 								<img src="../static/img/logo.png" alt="">
 							</a>
 						</li>
 						<li><a href="/">Главная</a></li>
						<li><a href="/catalog/all">Каталог</a></li>
						<li><a href="/contacts">Контакты</a></li>
					</ul>							
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="logo">
						<img src="../static/img/logo.png" alt="">
					</div>
				</div>
				<div class="col-md-9 col-sm-6 col-xs-6">
					<ul id="nav">
						<li><a href="/">Главная</a></li>
						<li><a href="/catalog/all">Каталог</a></li>
						<li><a href="/contacts">Контакты</a></li>
					</ul>
					<div id="mobile_toggle">
						<div id="nav_toggle"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12" data-aos="flip-up" data-aos-duration="1000">
					<h1>МАГАЗИН <br> ПРИБАЛТИЙСКОГО <br> ТРИКОТАЖА</h1>
					<h3>Роскошь может быть <br> доступной</h3>					
				</div>
			</div>
			<div class="row">
				<div class="col-md-2 col-md-offset-5">
					<a href="#brand"><div class="arrow_down"></div></a>
				</div>
			</div>
		</div>
	</header>

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
		 					echo '<a href="/product/'.$key[id].'"><img src="../static/img/banner_8.jpg" alt=""></a>';
		 					echo '<a href="/product/'.$key[id].'"><p class="item_name">'.$key[name].' '.$key[article].'</p></a>';
		 					if ($key['is_sale'] == 1) {
		 						echo '<span class="item_old_price">'.$key[sale_price].'</span>';
		 						echo "&nbsp;&nbsp;";
		 						echo '<span class="item_price">'.$key[price].'</span>';
		 					} else {
		 						echo '<span class="item_price">'.$key[price].'</span>';
		 					}
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
						<div class="reasons_img"><img src="../static/img/textile.png" alt=""></div>
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
						<div class="reasons_img"><img src="../static/img/european_red.png" alt=""></div>
						<p>Работа европейских дизайнеров</p>
					</div>
				</div>
				<div class="col-md-6 clearPadding">
					<div class="reasons_item" data-aos="flip-left">
						<div class="reasons_img"><img src="../static/img/size.png" alt=""></div>
						<p>Большой размерный ряд</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




<?php require_once '/views/index/footer.php'; ?>
