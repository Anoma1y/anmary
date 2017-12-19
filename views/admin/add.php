
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
		<p>Название:</p> <input type="text" id="productTitle" name="name" value="">
		<p>Артикль:</p> <input type="text" id="productArticle" name="article" value="">
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
		
		<p>Размер: </p><input type="text" name="size" id="productSize" readonly>
		<p>Цвет: </p>
			<select name="colour" id="colour">
				<?php 
					foreach ($colorList as $key) {
						echo "<option value='$key[id]'>$key[color_name]</option>";
					}
				?>		
			</select>
		
		<p>Состав: </p><input type="text" name="composition" readonly id="productComposition">


	
		<p>Скидка: </p><input type="checkbox" name="is_sale">

		<p>Процент скидки</p><input type="text" id="salePercent" value="0">
		<p>Цена: </p><input type="text" name="price" value="0" id="priceProduct">
		<p>Цена со скидкой: </p><input type="text" name="sale_price" id="priceAfterSale">



		<p>Наличие: </p><input type="checkbox" name="is_availability" checked>
		<p>Изображение: </p><input id="uploadimage" type="file" name="image">
		<button>Добавить</button>
	</form>
	<p>Размер: </p>
	<div class="size_chois" id="size_chois">
	</div>
	<p>Состав: </p>
	<div id="composition_chois">
	</div> 
</div>

<script src="/static/js/libs.min.js"></script>
<script src="/static/js/dev/add_product.js"></script>
<script>
	const salePercent = document.getElementById('salePercent');
	const priceProduct = document.getElementById('priceProduct');
	const priceAfterSale = document.getElementById('priceAfterSale');
	const compositions = {
		wool: { ru: "Шерсть", eng: "wool" },
		polyester: { ru: "Полиэстер", eng: "polyester" },
		viscose: { ru: "Вискоза", eng: "viscose" },		
		elastane: { ru: "Эластан", eng: "elastane" },		
		cotton: { ru: "Хлопок",	eng: "cotton" },		
		polyamide: { ru: "Полиамид", eng: "polyamide" },		
		nylon: { ru: "Нейлон",	eng: "nylon" },		
		lyen: { ru: "Лен",	eng: "lyen" },
		silk: { ru: "Шелк",	eng: "silk" }
	}
	const sizeName = [42,44,46,48,50,52,54,56,58,60];
	const productComposition = document.getElementById('productComposition');
	const sizeCheckbox = document.getElementsByName('size_chois');
	const productSize = document.getElementById('productSize');
	let productCompositionArr = [];
	let sizeArr = [];

	function createCheckBox(sizeName) {
		const appendTo = document.getElementById('size_chois');
		for (var key of sizeName) {
			let checkBox = document.createElement('input');
			let label = document.createElement('label');
			checkBox.type = 'checkbox';
			checkBox.value = key;
			checkBox.name = "size_chois";
			checkBox.id = `size_${key}`;
			label.htmlFor = `size_${key}`;
			label.textContent =  key;
			appendTo.appendChild(label);
			appendTo.appendChild(checkBox);
		}
	}

	window.onload = init;

	function init() {
		createCheckBox(sizeName);
		for (let size of sizeCheckbox) {
			size.addEventListener('change', function(e){
				function addToProductSize(arr){
					if (arr.length >= 1) {
						arr.sort(function(a, b) {
							if (a > b) {
								return 1;
							} else {
								return -1;
							}
						})
						productSize.value = arr.join(", ");
					} else if (arr.length == 0) {
						productSize.value = "";
					}
				}
				if (e.target.checked) {
					sizeArr.push(parseInt(e.target.value));
					addToProductSize(sizeArr);
				} else {
					sizeArr.splice(sizeArr.indexOf(parseInt(e.target.value)), 1);
					addToProductSize(sizeArr);
				}
			}, false);
		}
		for (let key in compositions) {
			window[`composition_${key}`] = key;
			window[`composition_${key}`] = new Composition(compositions[key]["ru"], compositions[key]["eng"], key);
			window[`composition_${key}`].addInput();
		}
	}
	
	class Composition{
		constructor(composition_ru, composition, id) {
		    this.composition_ru = composition_ru;
		    this.composition = composition;
		    this.id = id;
		    this.check = 0;
		    this.str = "";
		    this.count = 0;
		    this.container = document.getElementById('composition_chois');
		}
		createLabel(appendTo, id) {
			const label = document.createElement('label');
			label.htmlFor = id;
			label.textContent =  this.composition_ru;
			appendTo.appendChild(label);
		}
		createInput(appendTo, type, value = "", func = null) {
			const elem = document.createElement('input');
			elem.type = type;
			elem.id = `${type}_${this.id}`;
			elem.value = value;
			if (func !== null) {
				elem.onclick = func
			}
			if (type == 'checkbox') {
				this.createLabel(appendTo, `${type}_${this.id}`);
			}
			appendTo.appendChild(elem);

		}
		addInput() {
			const div = document.createElement('div');
			div.className = `composition_box`;
			this.container.appendChild(div);
			this.createInput(div, 'checkbox');
			this.createInput(div, 'text');
			this.createInput(div, 'button', "Добавить", function(e) { 
				let id = e.target.id.split('_')[1];
				window[`composition_${id}`].add(); 
			});
			this.createInput(div, 'button', "Удалить", function(e) { 
				let id = e.target.id.split('_')[1];
				window[`composition_${id}`].delete(); 
			});
		}
		renderValue(arr) {
			productComposition.value = arr.join(", ");
		}
		add() {
			let checkBox = document.getElementById(`checkbox_${this.id}`);
			let count = document.getElementById(`text_${this.id}`);
			if (checkBox.checked && this.check == 0 && count.value >= 1 && count.value <= 100) {
				this.str = `${this.composition_ru}-${count.value}%`;
				this.count = count.value;
				this.check = 1;
				productCompositionArr.push(this.str);
				this.renderValue(productCompositionArr);
			}
		} 
		delete() {
			let checkBox = document.getElementById(`checkbox_${this.id}`);
			let count = document.getElementById(`text_${this.id}`);
			if (checkBox.checked && this.check == 1) {
				if (checkBox.checked) {
					productCompositionArr.splice(productCompositionArr.indexOf(this.str), 1);
					this.renderValue(productCompositionArr);
					checkBox.checked = false;
					count.value = '';
					this.check = 0;
				}			
			}
		}
	}

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



