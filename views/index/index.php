<?php require_once 'views/index/header.php'; ?>

<div id="main">

	<div class="bg-image"></div>
	<div class="bg_blackout"></div>
	<header class="main-header">
		<div class="header-inner-container">

		</div>
	</header>
	<div id="header-logo"> 
	<img src="../static/img/logo.png" alt="Anmary">
	</div>

	<div id="menu-open" class="ui button-square">
	<span id="icon-toggle" class="icon-box-toggle ef-1"> 	
	<i class="icon-line-top"> </i>
	<i class="icon-line-center"> </i>
	<i class="icon-line-bottom"> </i> 
	</span>

	</div>

	<nav class="menu-main-wrap">
	<ul class="ui menu menu-effect_1">
	<li> <a href="#q"> Главная   </a> <span>   </span> </li>
	<li> <a href="#w"> Каталог  </a> <span>   </span> </li>
	<li> <a href="#e"> Контакты  </a> <span>   </span> </li>
	</ul>
	</nav>
	<!-- todo fix -->
	<div class="menu-main-overlay">
	</div>

<div class="container-featured">

  <h1> Магазин прибалтийского трикотажа  </h1>



  <h4>Роскошь может быть доступной	 </h4>
  <h1 class="secondary"> ~  </h1>


</div>
<a href="#brand"><div class="arrow_down"></div></a>
</div>

<div id="brand" class="brand-area">
	<div class="container">
		<div class="brand-content">
			<div class="row">
				<div class="brand-carousel">
						<div class="single-brand" data-aos="zoom-in-down">
							<a href="#">
								<img src="../static/img/logo/vaideslide.png" alt=""></a>
						</div>
						<div class="single-brand" data-aos="zoom-in-down">
							<a href="#">
								<img src="../static/img/logo/Comvill.png" alt=""></a>
						</div>
						<div class="single-brand" data-aos="zoom-in-down">
							<a href="#">
								<img src="../static/img/logo/magnolica.png" alt=""></a>
						</div>
						<div class="single-brand" data-aos="zoom-in-down">
							<a href="#">
								<img src="../static/img/logo/TopDesign.png" alt=""></a>
						</div>
						<div class="single-brand" data-aos="zoom-in-down">
							<a href="#">
								<img src="../static/img/logo/vito-logo.png" alt=""></a>
						</div>

				</div>
			</div>
		</div>
	</div>
</div>
<div id="catalog">
	<div class="container">
		<h1>ПОПУЛЯРНЫЕ МОДЕЛИ</h1>
	</div>
	<div class="items">
		<?php 
			foreach ($data as $key) {
				echo '<div class="item" data-aos="zoom-in-down">';
				echo '<a href="/product/'.$key[id].'"><img src="'.$key[image].'" alt=""></a>';
				echo '<a href="/product/'.$key[id].'"><div class="item_name">'.$key[name].' '.$key[brand_name].'</div></a>';
				if ($key['is_sale'] == 1) {
					echo '<div class="item_old_price"><span>'.$key[price].' </span>'.$key[sale_price].'</div>';
					// echo "&nbsp;&nbsp;";
					echo '<div class="sale">Sale</div>';
				} else {
					echo '<div class="item_price">'.$key[price].'</div>';
				}
				echo '</div>';
			}
		?>
	</div>

</div>
<div id="reasons">
	<div class="container">
	<div class="container">
		<h1>Причины выбора <br /> прибалтийского трикотажа</h1>
	</div>
		<div class="reasons">
			<div class="reasons_item" data-aos="flip-right">
				<div class="reasons_img"><img src="../static/img/textile.png" alt="Textile"></div>
				<p>Уникальные и натуральные ткани</p>
			</div>
			<div class="reasons_item" data-aos="flip-right">
				<div class="reasons_img"><img src="../static/img/quality.png" alt="Quality"></div>
				<p>Высокое качество изделий</p>
			</div>
			<div class="reasons_item" data-aos="flip-left">
				<div class="reasons_img"><img src="../static/img/european_red.png" alt="European"></div>
				<p>Работа европейских дизайнеров</p>
			</div>
			<div class="reasons_item" data-aos="flip-left">
				<div class="reasons_img"><img src="../static/img/size.png" alt="Big size"></div>
				<p>Большой размерный ряд</p>
			</div>
		</div>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

//TODO 
$(function(){


$('#icon-toggle' ).bind( 'click', function(e) {
		$( this ).toggleClass( 'active' );
		e.preventDefault();
		
		$( '#menu-open' ).toggleClass( 'active' );
		$( '.menu-main-wrap' ).toggleClass( 'active' );
		
		$( '.menu-effect_1' ).toggleClass( 'active' );
		
		$( '.menu-main-overlay' ).toggleClass( 'active' );
		
		
			
});

$( '.menu-main-overlay' ).bind( 'click', function() {

	$( this ).removeClass( 'active' );
	$( '#menu-open' ).removeClass( 'active' );
	$( '#icon-toggle' ).removeClass( 'active' );
	
	$( '.menu-main-wrap' ).removeClass( 'active' );
	
	$( '.menu-effect_1' ).removeClass( 'active' );



 });
 
 });
</script>

<?php require_once 'views/index/footer.php'; ?>
