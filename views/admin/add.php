
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
		<p>Размер: <input type="text" name="size" value="" disabled></p>
		<p>Цвет: 
			<select name="colour" id="colour">
				<?php 
					foreach ($colorList as $key) {
						echo "<option value='$key[id]'>$key[color_name]</option>";
					}
				?>		
			</select>
		</p>
		<p>Состав: <input type="text" name="composition" value="asd" placeholder="Состав"></p>
		<p>Скидка: <input type="checkbox" name="is_sale"></p>
		<p>Цена: <input type="text" name="price" value="777" placeholder="Цена"></p>
		<p>Цена со скидкой: <input type="text" name="sale_price" value="0" placeholder="Цена со скидкой"></p>
		<p>Наличие: <input type="checkbox" name="is_availability" checked></p>
		<p><input id="uploadimage" type="file" name="image"></p>
		<button>Добавить</button>
	</form>
	<div class="size_chois">
		42<input type="checkbox" value="42" name="size_chois">
		44<input type="checkbox" value="44" name="size_chois">
		46<input type="checkbox" value="46" name="size_chois">
		48<input type="checkbox" value="48" name="size_chois">
		50<input type="checkbox" value="50" name="size_chois">
		52<input type="checkbox" value="52" name="size_chois">
		54<input type="checkbox" value="54" name="size_chois">
		56<input type="checkbox" value="56" name="size_chois">
	</div>
</div>

<script src="/static/js/libs.min.js"></script>
<script>
//Добавление размера
$('input[name="size_chois"]').on('change', function() {
	if (this.checked) {
		if ($('input[name="size"]').val().length <= 1) {
			$('input[name="size"]').val($('input[name="size"]').val() + this.value);
		} else {
			$('input[name="size"]').val($('input[name="size"]').val() + "," + this.value);
		}
	} else if (this.checked === false) {
		var str = $('input[name="size"]').val();
		if (str.length == 2) {
			$('input[name="size"]').val(str.replace(new RegExp(this.value,"g"), ""));
		} else if (str.length > 2) {
			$('input[name="size"]').val(str.replace(new RegExp("," + this.value,"g"), ""));
		}
	}
})
</script>



