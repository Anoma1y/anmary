let productData = [];
const url = 'admin/getAllProducts';

//Id th for sorting
const productIdTh = document.getElementById('productIdTh');
const productBrandTh = document.getElementById('productBrandTh');
const productCategoryTh = document.getElementById('productCategoryTh');
const productSeasonTh = document.getElementById('productSeasonTh');
const productAvailabilityTh = document.getElementById('productAvailabilityTh');
const productIsSaleTh = document.getElementById('productIsSaleTh');
//Class for sorting
const sortingProduct = document.getElementsByClassName('sortingProduct');

function ajax(type, url) {
	let xhr = new XMLHttpRequest();
	return new Promise((res, rej) => {
		xhr.open(type, url, true);
		xhr.send();
		xhr.onload = () => {
			if (xhr.status >= 200 && xhr.status < 300) {
				let data = JSON.parse(xhr.responseText);
				for (let key in data) {
					productData[key] = Object.keys(data[key]).map(elem => data[key][elem] )
				}
				res(productData);
			} else {
				rej({
					status: xhr.status,
					statusText: xhr.statusText
				});
			}
		};
	    xhr.onerror = () => {
		rej({
			status: xhr.status,
			statusText: xhr.statusText
		});
	    };
	})
}
window.onload = ajax('GET', url).then((data) => {
	getProduct(data)
}).catch(() => {
	console.log('Error');
})

for (let sorting of sortingProduct) {
	sorting.addEventListener('click', (e) => {
		 e.target.classList.toggle("activeDesc");
		 let activeDesc = false;
		 if (e.target.classList[1] !== undefined) {
		 	activeDesc = true;
		 }
		 let numberColumn = e.target.cellIndex;
		getProduct(productData, numberColumn, activeDesc);
	}, false);
}

function getProduct(obj, cellIndex = 0, activeDesc = false) {
	let sorting = (numSortingColumn, desc) => {
		obj.sort((a, b) => {
			if (a[numSortingColumn] > b[numSortingColumn]) {
				let f = desc === true ? -1 : 1;
				return f;
			}
			else if (a[numSortingColumn] < b[numSortingColumn]) {
				let f = desc === true ? 1 : -1;
				return f;
			}
			else {
				return 0;
			}
		});
		return true;		
	}
	let desc = activeDesc;
	let numSortingColumn = cellIndex;
	let ss = sorting(numSortingColumn, desc);
	const tbody = document.getElementById('tbody');
	tbody.innerHTML = '';
	for (let key in obj) {
		const tr = document.createElement('tr');
		for (var i = 0; i < Object.keys(obj[key]).length; i++) {
			let td = document.createElement('td');
			if (Object.keys(obj[key])[i] === 'is_availability' || Object.keys(obj[key])[i] === 'is_sale') {
				td.textContent = obj[key][Object.keys(obj[key])[i]] == 1 ? 'Да' : 'Нет';
			} else {
				td.textContent = obj[key][Object.keys(obj[key])[i]];
			}
			tr.appendChild(td);
		}
		let tdBtnEdit = document.createElement('td');
		tdBtnEdit.className = 'tdBtnEdit';
		tdBtnEdit.onclick = function() {return editItem(obj[key][0])};
		tdBtnEdit.textContent = 'Изменить';
		tr.appendChild(tdBtnEdit);
		let tdBtnDelete = document.createElement('td');
		tdBtnDelete.className = 'tdBtnDelete';
		tdBtnDelete.onclick = function() {return deleteItem(obj[key][0])};
		tdBtnDelete.textContent = 'Удалить';
		tr.appendChild(tdBtnDelete);
		tbody.appendChild(tr);
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