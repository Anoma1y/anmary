<?php require_once 'header.php'; ?>

<div class="add">
	<form action="#" method="POST" enctype="multipart/form-data">
		<div class="left-col">
			<div class="left_block">
				<label for="productTitle">Название</label>
				<input type="text" id="productTitle" name="productTitle" value="">			
			</div>
			<div class="left_block">
				<label for="productArticle">Артикль</label>
				<input type="text" id="productArticle" name="productArticle" value="">			
			</div>
			<div class="left_block">
				<label for="productBrand">Бренд</label>
				<select name="productBrand" id="productBrand">
					<?php 
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
						foreach ($colorList as $key) {
							echo "<option value='$key[id]'>$key[color_name]</option>";
						}
					?>		
				</select>			
			</div>			
		</div>
		<div class="center-col">
			<div class="center-block">
				<div class="input_size">
					<label for="productSize">Размер</label>
					<input type="text" name="productSize" id="productSize" value="" readonly>					
				</div>
				<div class="size_chois" id="size_chois"></div>			
			</div>

			<div class="center-block">
				<div class="input_composition">
					<label for="productComposition">Состав</label><input type="text" name="productComposition" id="productComposition" readonly value="">
					<div id="composition_chois"></div> 
				</div>
			</div>
		</div>
		<div class="right-col">
			<div class="right_block">
				<label for="productSalePercent">Процент скидки</label>
				<input type="text" name="productSalePercent" id="productSalePercent" value="0">
			</div>
			<div class="right_block">
				<label for="productPrice">Цена</label>
				<input type="text" name="productPrice" id="productPrice" value="">
			</div>
			<div class="right_block">
				<label for="productPriceAfterSale">Цена со скидкой</label>
				<input type="text" name="productPriceAfterSale" id="productPriceAfterSale" value="">
			</div>
			<div class="right_block">				
				<label for="productIsSale">Скидка</label>
				<input type="checkbox" name="productIsSale" id="productIsSale">
			</div>
			<div class="right_block">
				<label for="productIsavailability">Наличие</label>
				<input type="checkbox" name="productIsavailability" id="productIsavailability" checked>
			</div>
			<div class="right_block">
				<label for="uploadimage">Изображение</label>
				<input  type="file" name="uploadimage" id="uploadimage">
			</div>
			<div class="right_block">
				<input type="submit" value="Добавить" id="addProduct">
			</div>
		</div>
		<p id="error"></p>
		<p id="success"></p>

	</form>

</div>

<script src="/static/js/adminEdit.js"></script>



