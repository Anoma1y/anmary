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



<?php //var_dump($_COOKIE) ?>


<?php require_once '/views/index/footer.php'; ?>
