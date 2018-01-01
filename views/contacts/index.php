<?php require_once 'views/index/header.php'; ?>

<section class="contacts">
	<div class="container">
		<div class="our_contacts">
			<div class="our_contacts_item">
				<div class="our_contacts_item_icon">
					<i class="fa fa-phone" aria-hidden="true"></i>
				</div>
				<div class="our_contacts_item_info">
					<h4>Телефон</h4>
					<span><?=$info['telephone']?></span>
				</div>
			</div>
			<div class="our_contacts_item">
				<div class="our_contacts_item_icon">
					<i class="fa fa-envelope-open" aria-hidden="true"></i>
				</div>
				<div class="our_contacts_item_info">
					<h4>Почта</h4>
					<span><?=$info['email']?></span>
				</div>
			</div>
			<div class="our_contacts_item">
				<div class="our_contacts_item_icon">
					<i class="fa fa-calendar" aria-hidden="true"></i>
				</div>
				<div class="our_contacts_item_info">
					<h4>График работы</h4>
					<span><?=$info['schedule']?></span>
				</div>
			</div>
			<div class="our_contacts_item">
				<div class="our_contacts_item_icon">
					<i class="fa fa-map-marker" aria-hidden="true"></i>
				</div>
				<div class="our_contacts_item_info">
					<h4>Адрес</h4>
					<span><?=$info['address']?></span>
				</div>
			</div>
		</div>
		
		<div class="map">
			<div id="map"></div>
		</div>
	</div>
	<div class="container">
		<div class="title">
			<h1><span>Связаться с нами</span></h1>
		</div>
	</div>
	<div class="container">
		<div class="feedback">
			<div class="feedback__form">
				<form action="#" method="POST" id="feedback_form">
					<input type="text" name="feedback_name" id="feedback_name" placeholder="Имя">
					<input type="text" name="feedback_email" id="feedback_email" placeholder="E-Mail">
					<textarea name="feedback_text" id="feedback_text" placeholder="Вопрос"></textarea>
					<button id="feedback_btn">Отправить</button>

				</form>
			</div>
		</div>
	</div>
</section>
<script src="/static/js/libs.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADny6Mjy49YDCexGxeRlvNFbi0QdbVqRA&callback=initMap"></script>
<script>
	function initMap(){var a={lat:lat,lng:lng},n=new google.maps.Map(document.getElementById("map"),{zoom:14,center:a});new google.maps.Marker({position:a,map:n})}var lat=60.072691,lng=30.337614;
</script>
<?php require_once 'views/index/footer.php'; ?>
