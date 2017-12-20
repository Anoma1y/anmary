'use strict';

var productData = [];
var url = 'admin/getAllProducts';

//Id th for sorting
var productIdTh = document.getElementById('productIdTh');
var productTitleTh = document.getElementById('productTitleTh');
var productArticleTh = document.getElementById('productArticleTh');
var productBrandTh = document.getElementById('productBrandTh');
var productCategoryTh = document.getElementById('productCategoryTh');
var productSeasonTh = document.getElementById('productSeasonTh');
var productAvailabilityTh = document.getElementById('productAvailabilityTh');
var productIsSaleTh = document.getElementById('productIsSaleTh');
//Class for sorting
var sortingProduct = document.getElementsByClassName('sortingProduct');

function ajax(type, url) {
	var xhr = new XMLHttpRequest();
	return new Promise(function (res, rej) {
		xhr.open(type, url, true);
		xhr.send();
		xhr.onload = function () {
			if (xhr.status >= 200 && xhr.status < 300) {
				var data = JSON.parse(xhr.responseText);
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

var _iteratorNormalCompletion = true;
var _didIteratorError = false;
var _iteratorError = undefined;

try {
	for (var _iterator = sortingProduct[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
		var sorting = _step.value;

		sorting.addEventListener('click', function (e) {
			var id_name = e.target.id.split('-')[1];
			e.target.classList.toggle("activeDesc");
			var activeDesc = false;
			if (e.target.classList[1] !== undefined) {
				activeDesc = true;
			}
			getProduct(productData, id_name, activeDesc);
		}, false);
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