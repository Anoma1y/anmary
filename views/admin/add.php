<h1 align="center">Добавить товар</h1>






<!-- <form id="formx" action="javascript:void(null);" onsubmit="uploadImage()" enctype="multipart/form-data" method="POST"> -->
	<form action="addProduct" method="POST" enctype="multipart/form-data">
	<p><input type="text" name="name" value="asd" placeholder="Название"></p>

	<p><input type="text" name="article" value="asd" placeholder="Артикль"></p>

	<p>
		<select name="brand" id="brand">
			<?php 
				foreach ($brandList as $key) {
					echo "<option value='$key[id]'>$key[brand_name]</option>";
				}
			?>			
		</select>
	</p>
	<p>
		<select name="category" id="category">
			<?php 
				foreach ($categoryList as $key) {
					echo "<option value='$key[id]'>$key[category_name]</option>";
				}
			?>		
		</select>
	</p>

	<p>
		<select name="season" id="season">
			<?php 
				foreach ($seasonList as $key) {
					echo "<option value='$key[id]'>$key[season_name]</option>";
				}
			?>		
		</select>
	</p>
	<p><input type="text" name="size" value="asd" placeholder="Размер"></p>
	<p>
		<select name="colour" id="colour">
			<?php 
				foreach ($colorList as $key) {
					echo "<option value='$key[id]'>$key[color_name]</option>";
				}
			?>		
		</select>
	</p>

	<p><input type="text" name="composition" value="asd" placeholder="Состав"></p>
	<p><input type="text" name="description" value="asd" placeholder="Описание"></p>
	<p><input type="text" name="price" value="777" placeholder="Цена"></p>

	<p><input id="uploadimage" type="file" name="image"></p>
	<input type="submit" name="add" value="Добавить">
</form>