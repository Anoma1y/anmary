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
	<input type="text" name="productId" id="productId" value="<?php $getID = explode('/', $_SERVER['REQUEST_URI']); echo "$getID[3]"; ?>" style="display: none">
	
	<p>Название: <input type="text" id="productTitle" name="productTitle" value="<?=$productData[name]?>" placeholder="Название"></p>

	<p>Артикль: <input type="text" id="productArticle" name="productArticle" value="<?=$productData[article]?>" placeholder="Артикль"></p>

	<p>Бренд: 
		<select name="productBrand" id="productBrand">
			<?php 
				echo "<option value='$productData[brand_id]'>$productData[brand_name]</option>";
				foreach ($brandList as $key) {
					echo "<option value='$key[id]'>$key[brand_name]</option>";
				}
			?>			
		</select>
	</p>
	<p>Категория: 
		<select name="productCategory" id="productCategory">
			<?php 
				echo "<option value='$productData[category_id]'>$productData[category_name]</option>";
				foreach ($categoryList as $key) {
					echo "<option value='$key[id]'>$key[category_name]</option>";
				}
			?>		
		</select>
	</p>

	<p>Сезон: 
		<select name="productSeason" id="productSeason">
			<?php 
				echo "<option value='$productData[season_id]'>$productData[season_name]</option>";
				foreach ($seasonList as $key) {
					echo "<option value='$key[id]'>$key[season_name]</option>";
				}
			?>		
		</select>
	</p>
	<p>Размер: <input type="text" name="productSize" id="productSize" value="<?=$productData[size]?>" readonly></p>
	<p>Цвет: 
		<select name="productColour" id="productColour">
			<?php 
				echo "<option value='$productData[color_id]'>$productData[color_name]</option>";
				foreach ($colorList as $key) {
					echo "<option value='$key[id]'>$key[color_name]</option>";
				}
			?>		
		</select>
	</p>

	<p>Состав: <input type="text" name="productComposition" id="productComposition" value="<?=$productData[composition]?>" readonly></p>

	<p>Скидка: <input type="checkbox" <?php if ($productData['is_sale'] == 1) echo "checked"; ?> name="productIsSale" id="productIsSale"></p>

	<p>Процент скидки</p><input type="text" name="productSalePercent" id="productSalePercent" value='<?=$productData[percentSale]?>'>


	<p>Цена: <input type="text" name="productPrice" id="productPrice" value="<?=$productData[price]?>" placeholder="Цена"></p>
	<p>Цена со скидкой: <input type="text" name="productPriceAfterSale" id="productPriceAfterSale" value="<?=$productData[sale_price]?>" placeholder="Цена со скидкой"></p>
	<p>Наличие: <input type="checkbox" name="productIsavailability" id="productIsavailability" <?php if ($productData['is_availability'] == 1) echo "checked"; ?>></p>
	<p><input id="uploadimage" type="file" name="uploadimage"></p>
	<input type="submit" name="editProduct" id="editProduct" value="Добавить">
</form>
	<p>Размер: </p>
	<div class="size_chois" id="size_chois">
	</div>
	<p>Состав: </p>
	<div id="composition_chois">
	</div> 
	<img src="<?=$productData[image]?>" width="400px" id="previewImage" alt="">

</div>

<script src="/static/js/adminEdit.js"></script>


