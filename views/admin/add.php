
<link rel="stylesheet" href="/static/css/admin.min.css">

<div class="header">
  <a href="#" id="menu-action">
    <i class="fa fa-bars"></i>
    <span>Close</span>
  </a>
  <div class="logo">
    Anmary
  </div>
</div>
<div class="sidebar">
  <ul>
    <li><a href="/admin/add"><i class="fa fa-desktop"></i><span>Добавить товар</span></a></li>
    <li><a href="#"><i class="fa fa-server"></i><span>Добавить бренд</span></a></li>
    <li><a href="#"><i class="fa fa-calendar"></i><span>Добавить цвет</span></a></li>
    <li><a href="#"><i class="fa fa-envelope-o"></i><span>Добавить сезон</span></a></li>
    <li><a href="#"><i class="fa fa-table"></i><span>Добавить категорию</span></a></li>
</div>

<div class="main">
	<form action="addProduct" method="POST" enctype="multipart/form-data">
		<p>Название:</p> <input type="text" name="name" value="">
		<p>Артикль:</p> <input type="text" name="article" value="">
		<p>Бренд:</p> 
			<select name="brand" id="brand">
				<?php 
					foreach ($brandList as $key) {
						echo "<option value='$key[id]'>$key[brand_name]</option>";
					}
				?>			
			</select>
		
		<p>Категория:</p> 
			<select name="category" id="category">
				<?php 
					foreach ($categoryList as $key) {
						echo "<option value='$key[id]'>$key[category_name]</option>";
					}
				?>		
			</select>
		
		<p>Сезон: </p>
			<select name="season" id="season">
				<?php 
					foreach ($seasonList as $key) {
						echo "<option value='$key[id]'>$key[season_name]</option>";
					}
				?>		
			</select>
		
		<p>Размер: </p><input type="text" name="size" readonly>
		<p>Цвет: </p>
			<select name="colour" id="colour">
				<?php 
					foreach ($colorList as $key) {
						echo "<option value='$key[id]'>$key[color_name]</option>";
					}
				?>		
			</select>
		
		<p>Состав: </p><input type="text" name="composition" readonly>


	
		<p>Скидка: </p><input type="checkbox" name="is_sale">

		<p>Процент скидки</p><input type="text" id="salePercent" value="0">
		<p>Цена: </p><input type="text" name="price" value="0" id="priceProduct">
		<p>Цена со скидкой: </p><input type="text" name="sale_price" id="priceAfterSale">



		<p>Наличие: </p><input type="checkbox" name="is_availability" checked>
		<p>Изображение: </p><input id="uploadimage" type="file" name="image">
		<button>Добавить</button>
	</form>
	<p>Размер: </p>
	<div class="size_chois">
	</div>
	<p>Состав: </p>
	<div id="composition_chois">
	</div> 
</div>

<script src="/static/js/libs.min.js"></script>
<script src="/static/js/dev/add_product.js"></script>
<script>
	// salePercent >= 0 && salePercent <= 100 && salePercent[0] != '0'
	const salePercent = document.getElementById('salePercent');
	const priceProduct = document.getElementById('priceProduct');
	const priceAfterSale = document.getElementById('priceAfterSale');

	function getSale(price ,percent) {
		if (percent >= 0 && percent <= 100 && percent[0] != '0') {
			return price - (price * (percent / 100));
		} else {
			return 0;
		}
	}
	function getPercent(price, salePrice) {
		let percent = Math.floor(100 - ((salePrice * 100) / price));
		if (percent <= 100 && percent >= 0) {
			return percent;
		} else {
			return 'Ошибка';
		}
	}
	//Скидка
	salePercent.addEventListener('keyup', (e) => {
		let value = e.target.value;
		priceAfterSale.value = getSale(priceProduct.value, value);
	}, false);
	//Цена без скидки
	priceProduct.addEventListener('keyup', (e) => {
		let value = e.target.value;
		priceAfterSale.value = getSale(value, salePercent.value)
	}, false);
	//Цена после скидки
	priceAfterSale.addEventListener('keyup', (e) => {
		let value = e.target.value;
		salePercent.value = getPercent(priceProduct.value, value);
	}, false);	
</script>



