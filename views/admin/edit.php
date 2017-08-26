<h1 align="center">Изменить товар</h1>

<form action="addProduct" method="POST" enctype="multipart/form-data">
	<p><input type="text" name="name" value="<?=$productData[name]?>" placeholder="Название"></p>

	<p><input type="text" name="article" value="<?=$productData[article]?>" placeholder="Артикль"></p>

	<p>
		<select name="brand" id="brand">
			<?php 
				echo "<option value='$productData[brand_id]'>$productData[brand_name]</option>";
				foreach ($brandList as $key) {
					echo "<option value='$key[id]'>$key[brand_name]</option>";
				}
			?>			
		</select>
	</p>
	<p>
		<select name="category" id="category">
			<?php 
				echo "<option value='$productData[category_id]'>$productData[category_name]</option>";
				foreach ($categoryList as $key) {
					echo "<option value='$key[id]'>$key[category_name]</option>";
				}
			?>		
		</select>
	</p>

	<p>
		<select name="season" id="season">
			<?php 
				echo "<option value='$productData[season_id]'>$productData[season_name]</option>";
				foreach ($seasonList as $key) {
					echo "<option value='$key[id]'>$key[season_name]</option>";
				}
			?>		
		</select>
	</p>
	<p><input type="text" name="size" value="<?=$productData[size]?>" placeholder="Размер"></p>
	<p>
		<select name="colour" id="colour">
			<?php 
				echo "<option value='$productData[color_id]'>$productData[color_name]</option>";
				foreach ($colorList as $key) {
					echo "<option value='$key[id]'>$key[color_name]</option>";
				}
			?>		
		</select>
	</p>

	<p><input type="text" name="composition" value="<?=$productData[composition]?>" placeholder="Состав"></p>
	<p><input type="text" name="description" value="<?=$productData[description]?>" placeholder="Описание"></p>
	<p><input type="text" name="price" value="<?=$productData[price]?>" placeholder="Цена"></p>
	<p><input id="uploadimage" type="file" name="image"></p>
	<input type="submit" name="add" value="Добавить">
</form>
<!-- Название: <input type="text" id="name_composition"><br>
Концентрация: <input type="text" id="amount_composition"><br>
<input type="submit" value="Добавить"> -->

<img src="<?=$productData[image]?>" alt="">

