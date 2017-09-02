<?php require_once 'views/catalog/header.php'; ?>
<div class="contacts">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="contact-info">
					<p class="contact-name">Магазин прибалтийского трикотажа</p>
					<span>Адрес</span>
					<p class="contact-adress">
					    г. Санкт Петербург, пр. Испытателей, 30,
                        ТЦ Миллер, 2 этаж
                        Остановка метро: Комендантский проспект
					</p>
					<span>Телефон</span>
					<p class="contact-telephone">
						+7-(963)-040-25-19 
					</p>
					<span>E-Mail</span>
					<p class="contact-email">
						nt-nt@mail.ru
					</p>
				</div>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<div class="map">
					<div id="map"></div>
				</div>
			</div>
		</div>
	</div>
</div>
	<script>
		      function initMap() {

        var uluru = {lat: 60.006932, lng: 30.2646299};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
	</script>, 
	    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADny6Mjy49YDCexGxeRlvNFbi0QdbVqRA&callback=initMap">
    </script>
<?php require_once 'views/index/footer.php'; ?>
