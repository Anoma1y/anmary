'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

//Box for size checkbox
var sizeCheckbox = document.getElementsByName('size_chois');
//Product info
var productId = document.getElementById('productId');
var productComposition = document.getElementById('productComposition');
var productSize = document.getElementById('productSize');
var productTitle = document.getElementById('productTitle');
var productArticle = document.getElementById('productArticle');
var productCategory = document.getElementById('productCategory');
var productBrand = document.getElementById('productBrand');
var productSeason = document.getElementById('productSeason');
var productIsSale = document.getElementById('productIsSale');
var productPercent = document.getElementById('productSalePercent');
var productPrice = document.getElementById('productPrice');
var productPriceAfterSale = document.getElementById('productPriceAfterSale');
var productIsAvailability = document.getElementById('productIsavailability');
//Button
var addProductBtn = document.getElementById('addProduct');
var editProductBtn = document.getElementById('editProduct');
var previewImage = document.getElementById('previewImage');
var compositions = {
	wool: { ru: "Шерсть", eng: "wool" },
	polyester: { ru: "Полиэстер", eng: "polyester" },
	viscose: { ru: "Вискоза", eng: "viscose" },
	elastane: { ru: "Эластан", eng: "elastane" },
	cotton: { ru: "Хлопок", eng: "cotton" },
	polyamide: { ru: "Полиамид", eng: "polyamide" },
	nylon: { ru: "Нейлон", eng: "nylon" },
	lyen: { ru: "Лен", eng: "lyen" },
	silk: { ru: "Шелк", eng: "silk" }
};
var sizeName = [42, 44, 46, 48, 50, 52, 54, 56, 58, 60];

var errorText = document.getElementById('error');
var successText = document.getElementById('success');

var productCompositionArr = [];
var sizeArr = [];

function getSale(price, percent) {
	if (percent >= 0 && percent <= 100 && percent[0] != '0') {
		return price - price * (percent / 100);
	} else {
		return 0;
	}
}

function getPercent(price, salePrice) {
	var percent = Math.floor(100 - salePrice * 100 / price);
	if (percent <= 100 && percent >= 0) {
		return percent;
	} else {
		return 'Ошибка';
	}
}

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
		var xhr = new XMLHttpRequest();
		var url = 'addProduct';
		var file = document.getElementById('uploadimage').files[0];
		var fd = new FormData();

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
		xhr.onreadystatechange = function () {
			if (xhr.readyState != 4) return;
			if (xhr.status != 200) {
				console.log(xhr.status + ' : ' + xhr.statusText);
				errorText.textContent = 'Ошибка';
			} else {
				if (xhr.responseText == 1) {
					window.location = './';
				}
			}
		};
	} else {
		errorText.textContent = "Заполните все поля!";
	}
}

function ajaxEdit(e) {
	e.preventDefault();
	if (productTitle.value.length >= 1 && productArticle.value.length >= 1 && productSize.value.length >= 1 && productComposition.value.length >= 1 && productPercent.value.length >= 1 && productPrice.value.length >= 1 && productPriceAfterSale.value.length >= 1) {
		var xhr = new XMLHttpRequest();
		var url = '../editProduct';
		var file = document.getElementById('uploadimage').files[0];
		var fd = new FormData();

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
		xhr.onreadystatechange = function () {
			// (3)
			if (xhr.readyState != 4) return;
			if (xhr.status != 200) {
				console.log(xhr.status + ' : ' + xhr.statusText);
				errorText.textContent = 'Ошибка';
			} else {
				if (xhr.responseText == 1) {
					window.location = '../';
				}
			}
		};
	} else {
		errorText.textContent = "Заполните все поля!";
	}
}
function createCheckBox(sizeName) {
	var appendTo = document.getElementById('size_chois');
	if (appendTo) {
		var _iteratorNormalCompletion = true;
		var _didIteratorError = false;
		var _iteratorError = undefined;

		try {
			for (var _iterator = sizeName[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
				var key = _step.value;

				var checkBox = document.createElement('input');
				var label = document.createElement('label');
				checkBox.type = 'checkbox';
				checkBox.value = key;
				checkBox.name = "size_chois";
				checkBox.id = 'size_' + key;
				label.htmlFor = 'size_' + key;
				label.textContent = key;
				appendTo.appendChild(label);
				appendTo.appendChild(checkBox);
			}
		} catch (err) {
			_didIteratorError = true;
			_iteratorError = err;
		} finally {
			try {
				if (!_iteratorNormalCompletion && _iterator.return) {
					_iterator.return();
				}
			} finally {
				if (_didIteratorError) {
					throw _iteratorError;
				}
			}
		}
	}
}

window.onload = init;

function init() {
	createCheckBox(sizeName);
	var _iteratorNormalCompletion2 = true;
	var _didIteratorError2 = false;
	var _iteratorError2 = undefined;

	try {
		for (var _iterator2 = sizeCheckbox[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
			var size = _step2.value;

			size.addEventListener('change', function (e) {
				var addToProductSize = function addToProductSize(arr) {
					if (arr.length >= 1) {
						arr.sort(function (a, b) {
							if (a > b) {
								return 1;
							} else {
								return -1;
							}
						});
						productSize.value = arr.join(", ");
					} else if (arr.length == 0) {
						productSize.value = "";
					}
				};
				if (e.target.checked) {
					sizeArr.push(parseInt(e.target.value));
					addToProductSize(sizeArr);
				} else {
					sizeArr.splice(sizeArr.indexOf(parseInt(e.target.value)), 1);
					addToProductSize(sizeArr);
				}
			}, false);
		}
	} catch (err) {
		_didIteratorError2 = true;
		_iteratorError2 = err;
	} finally {
		try {
			if (!_iteratorNormalCompletion2 && _iterator2.return) {
				_iterator2.return();
			}
		} finally {
			if (_didIteratorError2) {
				throw _iteratorError2;
			}
		}
	}

	for (var key in compositions) {
		window['composition_' + key] = key;
		window['composition_' + key] = new Composition(compositions[key]["ru"], compositions[key]["eng"], key);
		window['composition_' + key].init();
	}
}

var Composition = function () {
	function Composition(composition_ru, composition, id) {
		_classCallCheck(this, Composition);

		this.composition_ru = composition_ru;
		this.composition = composition;
		this.id = id;
		this.check = 0;
		this.str = "";
		this.count = 0;
		this.container = document.getElementById('composition_chois');
	}

	_createClass(Composition, [{
		key: 'createLabel',
		value: function createLabel(appendTo, id) {
			var label = document.createElement('label');
			label.htmlFor = id;
			label.textContent = this.composition_ru;
			appendTo.appendChild(label);
		}
	}, {
		key: 'createInput',
		value: function createInput(appendTo, type) {
			var value = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : "";
			var func = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;

			var elem = document.createElement('input');
			elem.type = type;
			elem.id = type + '_' + this.id;
			elem.value = value;
			if (func !== null) {
				elem.onclick = func;
			}
			if (type == 'checkbox') {
				this.createLabel(appendTo, type + '_' + this.id);
			}
			appendTo.appendChild(elem);
		}
	}, {
		key: 'init',
		value: function init() {
			var div = document.createElement('div');
			if (this.container) {
				div.className = 'composition_box';
				this.container.appendChild(div);
				this.createInput(div, 'checkbox');
				this.createInput(div, 'text');
				this.createInput(div, 'button', "Добавить", function (e) {
					var id = e.target.id.split('_')[1];
					window['composition_' + id].add();
				});
				this.createInput(div, 'button', "Удалить", function (e) {
					var id = e.target.id.split('_')[1];
					window['composition_' + id].delete();
				});
			}
		}
	}, {
		key: 'renderValue',
		value: function renderValue(arr) {
			productComposition.value = arr.join(", ");
		}
	}, {
		key: 'add',
		value: function add() {
			var checkBox = document.getElementById('checkbox_' + this.id);
			var count = document.getElementById('text_' + this.id).value;

			if (checkBox.checked && this.check == 0 && count >= 1 && count <= 100) {
				this.str = this.composition_ru + '-' + count + '%';
				this.count = count;
				this.check = 1;
				productCompositionArr.push(this.str);
				this.renderValue(productCompositionArr);
			}
		}
	}, {
		key: 'delete',
		value: function _delete() {
			var checkBox = document.getElementById('checkbox_' + this.id);
			var count = document.getElementById('text_' + this.id);
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
	}]);

	return Composition;
}();

if (productPercent) {
	//Скидка
	productPercent.addEventListener('keyup', function (e) {
		var value = e.target.value;
		productPriceAfterSale.value = getSale(productPrice.value, value);
	}, false);
}
if (productPrice) {
	//Цена без скидки
	productPrice.addEventListener('keyup', function (e) {
		var value = e.target.value;
		productPriceAfterSale.value = Math.floor(getSale(value, productPercent.value));
	}, false);
}
if (productPriceAfterSale) {
	//Цена после скидки
	productPriceAfterSale.addEventListener('keyup', function (e) {
		var value = e.target.value;
		productPercent.value = getPercent(productPrice.value, value);
	}, false);
}