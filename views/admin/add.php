
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
		<p>Название:</p> <input type="text" id="productTitle" name="productTitle" value="Title">
		<p>Артикль:</p> <input type="text" id="productArticle" name="productArticle" value="Article">
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
		
		<p>Размер: </p><input type="text" name="productSize" id="productSize" value="42, 46" readonly>
		<p>Цвет: </p>
			<select name="productColour" id="productColour">
				<?php 
					foreach ($colorList as $key) {
						echo "<option value='$key[id]'>$key[color_name]</option>";
					}
				?>		
			</select>
		
		<p>Состав: </p><input type="text" name="productComposition" id="productComposition" readonly value="chtoto">


	
		<p>Скидка: </p><input type="checkbox" name="productIsSale" id="productIsSale">

		<p>Процент скидки</p><input type="text" name="salePercent" id="salePercent" value="10">
		<p>Цена: </p><input type="text" name="priceProduct"  id="priceProduct" value="5000">
		<p>Цена со скидкой: </p><input type="text" name="sale_price" id="priceAfterSale" value="4500">



		<p>Наличие: </p><input type="checkbox" name="is_availability" id="is_availability" checked>
		<p>Изображение: </p><input  type="file" name="uploadimage" id="uploadimage">
		<input type="submit" value="Добавить" id="addProduct">
	</form>
	<p>Размер: </p>
	<div class="size_chois" id="size_chois">
	</div>
	<p>Состав: </p>
	<div id="composition_chois">
	</div> 
</div>

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
	const addProductBtn = document.getElementById('addProduct');
	let productCompositionArr = [];
	let sizeArr = [];

	function getSelected(sel) {
		if (sel.options) {
			for (var i = 0; i < sel.options.length; i++) {
				if (sel.options[i].selected) {
					return sel.options[i].value;
				}
			}			
		}
	}
	function translateBoolToInt(val) {
		return val === true ? 1 : 0;
	}
	addProduct.addEventListener('click', function(e){
		e.preventDefault();
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'addProduct', true);

		let productTitle = document.getElementById('productTitle');
		let productArticle = document.getElementById('productArticle');
		let productCategory = document.getElementById('productCategory');
		let productBrand = document.getElementById('productBrand');
		let productSeason = document.getElementById('productSeason');
		let productSize = document.getElementById('productSize');
		let productComposition = document.getElementById('productComposition');
		let productIsSale = document.getElementById('productIsSale');
		let productPercent = document.getElementById('salePercent');
		let productPrice = document.getElementById('priceProduct');
		let productPriceAfterSale = document.getElementById('priceAfterSale');
		let productIsAvailability = document.getElementById('is_availability');

		var file = document.getElementById('uploadimage').files[0];
		var fd = new FormData();

		fd.append("uploadimage", file);
		fd.append("productTitle", productTitle.value);
		fd.append("productArticle", productArticle.value);
		fd.append("productCategory", getSelected(productCategory));
		fd.append("productBrand", getSelected(productBrand));
		fd.append("productColour", getSelected(productColour));
		fd.append("productSeason", getSelected(productSeason));
		fd.append("productSize", productSize.value);
		fd.append("productComposition", productComposition.value);
		fd.append("productIsSale", translateBoolToInt(productIsSale.checked));
		fd.append("productPercent", productPercent.value);
		fd.append("productPrice", productPrice.value);
		fd.append("productPriceAfterSale", productPriceAfterSale.value);
		fd.append("productIsAvailability", translateBoolToInt(productIsAvailability.checked));
		xhr.send(fd);
		xhr.onreadystatechange = function() { // (3)
			if (xhr.readyState != 4) return;
			if (xhr.status != 200) {
				console.log(`${xhr.status} : ${xhr.statusText}`);
			} else {
				console.log(xhr.responseText);
			}
		}
	}, false);


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
			let count = document.getElementById(`text_${this.id}`).value;

			if (checkBox.checked && this.check == 0 && count >= 1 && count <= 100 ) {
				this.str = `${this.composition_ru}-${count}%`;
				this.count = count;
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
		priceAfterSale.value = Math.floor(getSale(value, salePercent.value));
	}, false);

	//Цена после скидки
	priceAfterSale.addEventListener('keyup', (e) => {
		let value = e.target.value;
		salePercent.value = getPercent(priceProduct.value, value);
	}, false);	

</script>



