<link rel="stylesheet" href="/static/css/admin.css">

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


<form action="../editProduct" method="POST" enctype="multipart/form-data">
	<input type="text" name="product_id" value="<?php $getID = explode('/', $_SERVER['REQUEST_URI']); echo "$getID[3]"; ?>" style="display: none">
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
<img src="<?=$productData[image]?>" alt="">

</div>