<?php require_once 'views/catalog/header.php'; ?>
<div class="contacts">
	<div class="container">
				<div class="contact-info">
					<p class="contact-name">Магазин прибалтийского трикотажа</p>
					<span>Адрес</span>
					<p class="contact-adress">
					    г. Санкт Петербург, ул. Фёдора Абрамова, 8,
                        Остановка метро: Парнас
					</p>
					<span>Телефон</span>
					<p class="contact-telephone">
						+7-(904)-619-10-24 
					</p>
					<span>E-Mail</span>
					<p class="contact-email">
						nt-nt@mail.ru
					</p>
				</div>
			<div class="container">
				<div class="map">
					<div id="map"></div>
				</div>
			</div>
	</div>
</div>
<script>
function initMap(){var a={lat:lat,lng:lng},n=new google.maps.Map(document.getElementById("map"),{zoom:15,center:a});new google.maps.Marker({position:a,map:n})}var lat=60.072677,lng=30.33763;
</script>, 
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADny6Mjy49YDCexGxeRlvNFbi0QdbVqRA&callback=initMap">
</script>
<?php require_once 'views/index/footer.php'; ?>
