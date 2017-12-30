
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
	<form action="#" method="POST" enctype="multipart/form-data">
		<p>Название:</p> <input type="text" id="productTitle" name="productTitle" value="">
		<p>Артикль:</p> <input type="text" id="productArticle" name="productArticle" value="">
		<p>Бренд:</p> 
			<select name="productBrand" id="productBrand">
				<?php 
					foreach ($brandList as $key) {
						echo "<option value='$key[id]'>$key[brand_name]</option>";
					}
				?>			
			</select>
		
		<p>Категория:</p> 
			<select name="productCategory" id="productCategory">
				<?php 
					foreach ($categoryList as $key) {
						echo "<option value='$key[id]'>$key[category_name]</option>";
					}
				?>		
			</select>
		
		<p>Сезон: </p>
			<select name="productSeason" id="productSeason">
				<?php 
					foreach ($seasonList as $key) {
						echo "<option value='$key[id]'>$key[season_name]</option>";
					}
				?>		
			</select>
		
		<p>Размер: </p><input type="text" name="productSize" id="productSize" value="" readonly>
		<p>Цвет: </p>
			<select name="productColour" id="productColour">
				<?php 
					foreach ($colorList as $key) {
						echo "<option value='$key[id]'>$key[color_name]</option>";
					}
				?>		
			</select>
		
		<p>Состав: </p><input type="text" name="productComposition" id="productComposition" readonly value="">


	
		<p>Скидка: </p><input type="checkbox" name="productIsSale" id="productIsSale">

		<p>Процент скидки</p><input type="text" name="productSalePercent" id="productSalePercent" value="">

		<p>Цена: </p><input type="text" name="productPrice"  id="productPrice" value="">

		<p>Цена со скидкой: </p><input type="text" name="productPriceAfterSale" id="productPriceAfterSale" value="">

		<p>Наличие: </p><input type="checkbox" name="productIsavailability" id="productIsavailability" checked>
		
		<p>Изображение: </p><input  type="file" name="uploadimage" id="uploadimage">
		<input type="submit" value="Добавить" id="addProduct">
		<p id="error"></p>
		<p id="success"></p>

	</form>
	<p>Размер: </p>
	<div class="size_chois" id="size_chois">
	</div>
	<p>Состав: </p>
	<div id="composition_chois">
	</div> 
</div>

<script src="/static/js/adminEdit.js"></script>



