<?php require_once 'views/index/header.php'; ?>

<section class="contacts">
	<div class="container">
		<h2 class="line-title">Контакты</h2>
		<div class="our_contacts">
			<div class="our_contacts_item left-items" data-aos="zoom-in" data-aos-duration="500">
				<div class="our_contacts_item_icon">
					<i class="fa fa-phone" aria-hidden="true"></i>
				</div>
				<div class="our_contacts_item_info">
					<h4>Телефон</h4>
					<span><?=$info['telephone']?></span>
				</div>
			</div>
			<div class="our_contacts_item right-items" data-aos="zoom-in" data-aos-duration="500">
				<div class="our_contacts_item_icon">
					<i class="fa fa-envelope-open" aria-hidden="true"></i>
				</div>
				<div class="our_contacts_item_info">
					<h4>Почта</h4>
					<span><?=$info['email']?></span>
				</div>
			</div>
			<div class="our_contacts_item left-items" data-aos="zoom-in" data-aos-duration="500">
				<div class="our_contacts_item_icon">
					<i class="fa fa-calendar" aria-hidden="true"></i>
				</div>
				<div class="our_contacts_item_info">
					<h4>График работы</h4>
					<span><?=$info['schedule']?></span>
				</div>
			</div>
			<div class="our_contacts_item right-items" data-aos="zoom-in" data-aos-duration="500">
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
	<h2 class="line-title">Обратная связь</h2>
		<div class="feedback" data-aos="zoom-in" data-aos-duration="800">
			<div class="feedback__form">
				<form action="javascript:void(null);" method="POST" id="sendEmailForm">
					<input type="text" name="form-name" id="form-name" placeholder="Имя">
					<input type="text" name="form-email" id="form-email" placeholder="E-Mail">
					<textarea name="form-text" id="form-text" placeholder="Вопрос"></textarea>
					<button id="sendEmailBtn">Отправить</button>

				</form>
			</div>
		</div>
	</div>
</section>

<?php require_once 'views/index/footer.php'; ?>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADny6Mjy49YDCexGxeRlvNFbi0QdbVqRA&callback=initMap"></script>
<script>
	function initMap(){var a={lat:lat,lng:lng},n=new google.maps.Map(document.getElementById("map"),{zoom:17,center:a});new google.maps.Marker({position:a,map:n})}var lat=60.0067346,lng=30.2571044;
</script>
<script type="text/javascript" src="/static/js/contacts.js"></script>