
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
	<form action="addProduct" method="POST" enctype="multipart/form-data">
		<p>Название: <input type="text" name="name" value="asd" placeholder="Название"></p>
		<p>Артикль: <input type="text" name="article" value="asd" placeholder="Артикль"></p>
		<p>Бренд: 
			<select name="brand" id="brand">
				<?php 
					foreach ($brandList as $key) {
						echo "<option value='$key[id]'>$key[brand_name]</option>";
					}
				?>			
			</select>
		</p>
		<p>Категория: 
			<select name="category" id="category">
				<?php 
					foreach ($categoryList as $key) {
						echo "<option value='$key[id]'>$key[category_name]</option>";
					}
				?>		
			</select>
		</p>
		<p>Сезон: 
			<select name="season" id="season">
				<?php 
					foreach ($seasonList as $key) {
						echo "<option value='$key[id]'>$key[season_name]</option>";
					}
				?>		
			</select>
		</p>
		<p>Размер: <input type="text" name="size" readonly></p>
		<p>Цвет: 
			<select name="colour" id="colour">
				<?php 
					foreach ($colorList as $key) {
						echo "<option value='$key[id]'>$key[color_name]</option>";
					}
				?>		
			</select>
		</p>
		<p>Состав: <input type="text" name="composition" readonly></p>
		<p>Скидка: <input type="checkbox" name="is_sale"></p>
		<p>Цена: <input type="text" name="price" value="777" placeholder="Цена"></p>
		<p>Цена со скидкой: <input type="text" name="sale_price" value="0" placeholder="Цена со скидкой"></p>
		<p>Наличие: <input type="checkbox" name="is_availability" checked></p>
		<p><input id="uploadimage" type="file" name="image"></p>
		<button>Добавить</button>
	</form>
	<div class="size_chois">
	</div>
	<div id="composition_chois">
	</div> 
</div>

<script src="/static/js/libs.min.js"></script>
<script src="/static/js/add_product.js"></script>




