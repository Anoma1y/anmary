	//Box for size checkbox
	const sizeCheckbox = document.getElementsByName('size_chois');
	//Product info
	const productId = document.getElementById('productId');
	const productComposition = document.getElementById('productComposition');
	const productSize = document.getElementById('productSize');
	const productTitle = document.getElementById('productTitle');
	const productArticle = document.getElementById('productArticle');
	const productCategory = document.getElementById('productCategory');
	const productBrand = document.getElementById('productBrand');
	const productSeason = document.getElementById('productSeason');
	const productIsSale = document.getElementById('productIsSale');
	const productPercent = document.getElementById('productSalePercent');
	const productPrice = document.getElementById('productPrice');
	const productPriceAfterSale = document.getElementById('productPriceAfterSale');
	const productIsAvailability = document.getElementById('productIsavailability');
	//Button
	const addProductBtn = document.getElementById('addProduct');
	const editProductBtn = document.getElementById('editProduct');	
	const previewImage = document.getElementById('previewImage');
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

	var errorText = document.getElementById('error');
	var successText = document.getElementById('success');

	var productCompositionArr = [];
	var sizeArr = [];

	var isSaleCheck = false;

	/**
	 * [getSale Функция получение скидки]
	 * @param  {Number} price   [Цена]
	 * @param  {Number} percent [Процент скидки]
	 * @return {Number}         [Цена после скидки]
	 */
	function getSale(price ,percent) {
		if (percent >= 0 && percent <= 100 && percent[0] != '0') {
			return price - (price * (percent / 100));
		} else {
			return 0;
		}
	}

	/**
	 * [getPercent Функция получения процента скидки]
	 * @param  {Number} price     [Начальная цена]
	 * @param  {Number} salePrice [Цена после скидки]
	 * @return {Number}           [Процент между ценой и ценой со скидкой]
	 */
	function getPercent(price, salePrice) {
		let percent = Math.floor(100 - ((salePrice * 100) / price));
		if (percent <= 100 && percent >= 0) {
			return percent;
		} else {
			return 'Ошибка';
		}
	}

	/**
	 * [getSelected Функция получения текущего значения в теге Select]
	 * @param  {Node} sel [Селектор Select]
	 * @return {String}     [Возвращает текущее значение в option]
	 */
	function getSelected(sel) {
		if (sel.options) {
			for (var i = 0; i < sel.options.length; i++) {
				if (sel.options[i].selected) {
					return sel.options[i].value;
				}
			}			
		}
	}
	//Перевод булевого значения в цифровой
	function translateBoolToInt(val) {
		return val === true ? 1 : 0;
	}
	if (addProductBtn) {
		addProductBtn.addEventListener('click', ajaxAdd, false);
	}
	if (editProductBtn) {
		editProductBtn.addEventListener('click', ajaxEdit, false);
	}
	function ajaxAdd(e) {
		e.preventDefault();

		if (productTitle.value.length >= 1 && productArticle.value.length >= 1 && productSize.value.length >= 1 && productComposition.value.length >= 1 && productPercent.value.length >= 1 && productPrice.value.length >= 1 && productPriceAfterSale.value.length >= 1) {
			let xhr = new XMLHttpRequest();
			let url = 'addProduct';
			let file = document.getElementById('uploadimage').files[0];
			let fd = new FormData();
			
			xhr.open('POST', url, true);
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

			xhr.onreadystatechange = () => { 
				if (xhr.readyState != 4) return;
				if (xhr.status != 200) {
					console.log(`${xhr.status} : ${xhr.statusText}`);
					errorText.textContent = 'Ошибка';
				} else {
					if (xhr.responseText == 1) {
						window.location = './';
					}
				}
			}			
		} else {
			errorText.textContent = "Заполните все поля!";
		}
	}

	function ajaxEdit(e) {
		e.preventDefault();
		if (productTitle.value.length >= 1 && productArticle.value.length >= 1 && productSize.value.length >= 1 && productComposition.value.length >= 1 && productPercent.value.length >= 1 && productPrice.value.length >= 1 && productPriceAfterSale.value.length >= 1) {
			let xhr = new XMLHttpRequest();
			let url = '../editProduct';
			let file = document.getElementById('uploadimage').files[0];
			let fd = new FormData();
		
			xhr.open('POST', url, true);
			fd.append("uploadimage", file);
			fd.append("productId", productId.value);
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
			xhr.onreadystatechange = () => { // (3)
				if (xhr.readyState != 4) return;
				if (xhr.status != 200) {
					console.log(`${xhr.status} : ${xhr.statusText}`);
					errorText.textContent = 'Ошибка';
				} else {
					if (xhr.responseText == 1) {
						window.location = '../';
					}
				}
			}			
		} else {
			errorText.textContent = "Заполните все поля!";
		}
	}
	function createCheckBox(sizeName) {
		const appendTo = document.getElementById('size_chois');
		if (appendTo) {
			for (var key of sizeName) {
				let div = document.createElement('div');
				let checkBox = document.createElement('input');
				let label = document.createElement('label');
				checkBox.type = 'checkbox';
				checkBox.value = key;
				checkBox.name = "size_chois";
				checkBox.id = `size_${key}`;
				label.htmlFor = `size_${key}`;
				label.textContent =  key;
				div.appendChild(label);
				div.appendChild(checkBox);
				appendTo.appendChild(div);
			}			
		}
	}

	window.onload = init;

	function init() {
		createCheckBox(sizeName);
		for (let size of sizeCheckbox) {
			size.addEventListener('change', e => {
				let addToProductSize = arr => {
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
			window[`composition_${key}`].init();
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
		init() {
			const div = document.createElement('div');
			if (this.container) {
				div.className = `composition_box`;
				this.container.appendChild(div);
				this.createInput(div, 'checkbox');
				this.createInput(div, 'text');
				this.createInput(div, 'button', "Добавить", e => { 
					let id = e.target.id.split('_')[1];
					window[`composition_${id}`].add(); 
				});
				this.createInput(div, 'button', "Удалить", e => { 
					let id = e.target.id.split('_')[1];
					window[`composition_${id}`].delete(); 
				});				
			}

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


	if (productPercent) {
		//Скидка
		productPercent.addEventListener('keyup', (e) => {
			let value = e.target.value;
			if (isSaleCheck) {
				productPriceAfterSale.value = value != 0 ? getSale(productPrice.value, value) : productPrice.value;
			}
		}, false);		
	}
	if (productPrice) {
		//Цена без скидки
		productPrice.addEventListener('keyup', (e) => {
			let value = e.target.value;
			if (isSaleCheck) {
				productPriceAfterSale.value = productPercent.value != 0 ? Math.floor(getSale(value, productPercent.value)) : value;
			} else {
				productPriceAfterSale.value = productPrice.value;
			}
		}, false);		
	}
	productIsSale.addEventListener('change', (e) => {
		if (e.target.checked) {
			isSaleCheck = true;
			productPriceAfterSale.value = productPercent.value != 0 ? Math.floor(getSale(productPrice.value, productPercent.value)) : productPrice.value;
		} else {
			isSaleCheck = false;
			productPriceAfterSale.value = productPrice.value;
		}
	}, false)
	if (productPriceAfterSale) {
		//Цена после скидки
		productPriceAfterSale.addEventListener('keyup', (e) => {
			let value = e.target.value;
			productPercent.value = getPercent(productPrice.value, value);
		}, false);			
	}





