<?php require_once 'header.php'; ?>
<div class="main">

<div class="add">
	<form action="#" method="POST" enctype="multipart/form-data">
		<input type="text" name="productId" id="productId" value="<?php $getID = explode('/', $_SERVER['REQUEST_URI']); echo "$getID[3]"; ?>" style="display: none">
		<div class="left-col">
			<div class="left_block">
				<label for="productTitle">Название</label>	
				<input type="text" id="productTitle" name="productTitle" value="<?=$productData[name]?>">
			</div>
			<div class="left_block">
				<label for="productArticle">Артикль</label>
				<input type="text" id="productArticle" name="productArticle" value="<?=$productData[article]?>">
			</div>
			<div class="left_block">
				<label for="productBrand">Бренд</label>
				<select name="productBrand" id="productBrand">
					<?php 
						echo "<option value='$productData[brand_id]'>$productData[brand_name]</option>";
						foreach ($brandList as $key) {
							echo "<option value='$key[id]'>$key[brand_name]</option>";
						}
					?>			
				</select>
			</div>
			<div class="left_block">
				<label for="productCategory">Категория</label> 
				<select name="productCategory" id="productCategory">
					<?php 
						echo "<option value='$productData[category_id]'>$productData[category_name]</option>";
						foreach ($categoryList as $key) {
							echo "<option value='$key[id]'>$key[category_name]</option>";
						}
					?>		
				</select>
			</div>
			<div class="left_block">
				<label for="productSeason">Сезон</label>
				<select name="productSeason" id="productSeason">
					<?php 
						echo "<option value='$productData[season_id]'>$productData[season_name]</option>";
						foreach ($seasonList as $key) {
							echo "<option value='$key[id]'>$key[season_name]</option>";
						}
					?>		
				</select>
			</div>
			<div class="left_block">
				<label for="productColour">Цвет</label>
				<select name="productColour" id="productColour">
					<?php 
						echo "<option value='$productData[color_id]'>$productData[color_name]</option>";
						foreach ($colorList as $key) {
							echo "<option value='$key[id]'>$key[color_name]</option>";
						}
					?>		
				</select>
			</div>
			<div class="left_block">
				<img src="<?=$productData[image]?>" id="previewImage" alt="">
			</div>
		</div>
		<div class="center-col">
			<div class="center-block">
				<div class="input_size">
					<label for="productSize">Размер</label>
					<input type="text" name="productSize" id="productSize" value="<?=$productData[size]?>" readonly>					
				</div>
				<div class="size_chois" id="size_chois"></div>	
			</div>
			<div class="center-block">
				<div class="input_composition">
					<label for="productComposition">Состав</label><input type="text" name="productComposition" id="productComposition" readonly value="<?=$productData[composition]?>">
					<div id="composition_chois"></div> 
				</div>
			</div>
		</div>
		<div class="right-col">
			<div class="right_block">
				<label for="productSalePercent">Процент скидки</label>
				<input type="text" name="productSalePercent" id="productSalePercent" value='<?=$productData[percentSale]?>'>	
			</div>
			<div class="right_block">
				<label for="productPrice">Цена</label>
				<input type="text" name="productPrice" id="productPrice" value="<?=$productData[price]?>">
			</div>
			<div class="right_block">
				<label for="productPriceAfterSale">Цена со скидкой</label>
				<input type="text" name="productPriceAfterSale" id="productPriceAfterSale" value="<?=$productData[sale_price]?>">
			</div>
			<div class="right_block">
				<label for="productIsSale">Скидка</label>
				<input type="checkbox" <?php if ($productData['is_sale'] == 1) echo "checked"; ?> name="productIsSale" id="productIsSale">
			</div>
			<div class="right_block">
				<label for="productIsavailability">Наличие</label>
				<input type="checkbox" name="productIsavailability" id="productIsavailability" <?php if ($productData['is_availability'] == 1) echo "checked"; ?>>
			</div>
			<div class="right_block">
				<label for="uploadimage">Изображение</label>
				<input  type="file" name="uploadimage" id="uploadimage">
			</div>
			<div class="right_block">
				<input type="submit" value="Изменить" id="editProduct" name="editProduct">
			</div>
		</div>
	</form>
</div>
<script src="/static/js/adminEdit.js"></script>


