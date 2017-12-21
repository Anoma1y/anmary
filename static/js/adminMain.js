'use strict';

var productData = [];
var url = 'admin/getAllProducts';

// //Айди для 
// const productIdTh = document.getElementById('productIdTh');
// const productTitleTh = document.getElementById('productTitleTh');
// const productArticleTh = document.getElementById('productArticleTh');
// const productBrandTh = document.getElementById('productBrandTh');
// const productCategoryTh = document.getElementById('productCategoryTh');
// const productSeasonTh = document.getElementById('productSeasonTh');
// const productAvailabilityTh = document.getElementById('productAvailabilityTh');
// const productIsSaleTh = document.getElementById('productIsSaleTh');

//Класс для сортировки
var sortingProduct = document.getElementsByClassName('sortingProduct');

//Получение всех товаров (принимает 2 параметра: тип и ссылку)
function ajax(type, url) {
	var xhr = new XMLHttpRequest();
	return new Promise(function (res, rej) {
		xhr.open(type, url, true);
		xhr.send();
		xhr.onload = function () {
			if (xhr.status >= 200 && xhr.status < 300) {
				var data = JSON.parse(xhr.responseText);
				//создание массива объектов для последующей сортировки
				productData = Array.prototype.slice.call(data);
				res(data);
			} else {
				rej({
					status: xhr.status,
					statusText: xhr.statusText
				});
			}
		};
		xhr.onerror = function () {
			rej({
				status: xhr.status,
				statusText: xhr.statusText
			});
		};
	});
}
window.onload = ajax('GET', url).then(function (data) {
	getProduct(data);
}).catch(function () {
	console.log('Error');
});

//Объявление обработчика событий для сортировки по столбцам
//полученные по классу "sortingProduct"
var _iteratorNormalCompletion = true;
var _didIteratorError = false;
var _iteratorError = undefined;

try {
	for (var _iterator = sortingProduct[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
		var sorting = _step.value;

		sorting.addEventListener('click', function (e) {
			var id_name = e.target.id.split('-')[1];
			//добавления класса activeDesc для проверки сортировки по столбцу
			e.target.classList.toggle("activeDesc");
			var activeDesc = false;
			if (e.target.classList[1] !== undefined) {
				activeDesc = true;
			}
			//вызов функции для добавления и сортировки всех товаров
			//принимает 3 параметра: объект с данными, текущий столбец таблицы (равен названию в БД) и true/false выбранного столбца
			getProduct(productData, id_name, activeDesc);
		}, false);
	}

	//функция для добавления и сортировки товаров
	//принимает 3 параметра: объект с данными, текущий столбец таблицы (равен названию в БД) и true/false выбранного столбца
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

function getProduct(obj) {
	var column = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'id';
	var activeDesc = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;

	var sorting = function sorting(sortingColumn, desc) {
		obj.sort(function (a, b) {
			if (sortingColumn == 'id' || sortingColumn == 'price' || sortingColumn == 'sale_price' || sortingColumn == 'percentSale') {
				a[sortingColumn] = parseInt(a[sortingColumn]);
				b[sortingColumn] = parseInt(b[sortingColumn]);
				if (a[sortingColumn] < b[sortingColumn]) {
					var f = desc === true ? -1 : 1;
					return f;
				}
				if (a[sortingColumn] > b[sortingColumn]) {
					var _f = desc === true ? 1 : -1;
					return _f;
				}
			} else {
				if (desc) {
					return a[sortingColumn].localeCompare(b[sortingColumn]);
				} else {
					return b[sortingColumn].localeCompare(a[sortingColumn]);
				}
			}
		});
		return true;
	};
	var desc = activeDesc;
	var SortingColumn = column;
	var ss = sorting(SortingColumn, desc);
	var tbody = document.getElementById('tbody');
	if (ss) {
		tbody.innerHTML = '';

		var _loop = function _loop(key) {
			var tr = document.createElement('tr');
			for (i = 0; i < Object.keys(obj[key]).length; i++) {
				var td = document.createElement('td');
				if (Object.keys(obj[key])[i] === 'is_availability' || Object.keys(obj[key])[i] === 'is_sale') {
					td.textContent = obj[key][Object.keys(obj[key])[i]] == 1 ? 'Да' : 'Нет';
				} else {
					td.textContent = obj[key][Object.keys(obj[key])[i]];
				}
				tr.appendChild(td);
			}
			var tdBtnEdit = document.createElement('td');
			tdBtnEdit.className = 'tdBtnEdit';
			tdBtnEdit.onclick = function () {
				return editItem(obj[key]['id']);
			};
			tdBtnEdit.textContent = 'Изменить';
			tr.appendChild(tdBtnEdit);
			var tdBtnDelete = document.createElement('td');
			tdBtnDelete.className = 'tdBtnDelete';
			tdBtnDelete.onclick = function () {
				return deleteItem(obj[key]['id']);
			};
			tdBtnDelete.textContent = 'Удалить';
			tr.appendChild(tdBtnDelete);
			tbody.appendChild(tr);
		};

		for (var key in obj) {
			var i;

			_loop(key);
		}
	}
}

//Удаление товара с подтверждением
function deleteItem(id) {
	if (confirm("Подтвердите удаление") === true) {
		window.location = "admin/delete/" + id;
	}
}
//Переход на страницу редактирования товара
function editItem(id) {
	window.location = "admin/edit/" + id;
}
var items = ['Privet', 'kak', 'dela', 'Gay'];
items.sort(function (a, b) {
	return a.localeCompare(b);
});
console.log(items);
// items равен ['adieu', 'café', 'cliché', 'communiqué', 'premier', 'réservé']