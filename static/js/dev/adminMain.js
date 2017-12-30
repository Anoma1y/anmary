let productData = [];
const url = 'admin/getAllProducts';

//Класс для сортировки
const sortingProduct = document.getElementsByClassName('sortingProduct');

//Получение всех товаров (принимает 2 параметра: тип и ссылку)
function ajax(type, url) {
	let xhr = new XMLHttpRequest();
	return new Promise((res, rej) => {
		xhr.open(type, url, true);
		xhr.send();
		xhr.onload = () => {
			if (xhr.status >= 200 && xhr.status < 300) {
				let data = JSON.parse(xhr.responseText);
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
	    xhr.onerror = () => {
		rej({
			status: xhr.status,
			statusText: xhr.statusText
		});
	    };
	})
}
window.onload = ajax('GET', url).then((data) => {
	getProduct(data);
}).catch(() => {
	console.log('Error');
})

//Объявление обработчика событий для сортировки по столбцам
//полученные по классу "sortingProduct"
for (let sorting of sortingProduct) {
	sorting.addEventListener('click', (e) => {
		let id_name = e.target.id.split('-')[1];
		//добавления класса activeDesc для проверки сортировки по столбцу
		e.target.classList.toggle("activeDesc");
		let activeDesc = false;
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
function getProduct(obj, column = 'id', activeDesc = false) {
	let sorting = (sortingColumn, desc) =>{
		obj.sort((a,b) => {
			if (sortingColumn == 'id' || sortingColumn == 'price' || sortingColumn == 'sale_price' || sortingColumn == 'percentSale') {
				a[sortingColumn] = parseInt(a[sortingColumn]);
				b[sortingColumn] = parseInt(b[sortingColumn]);
				if (a[sortingColumn] < b[sortingColumn]) {
					let f = desc === true ? -1 : 1;
					return f;
				}
				if (a[sortingColumn] > b[sortingColumn]) {
					let f = desc === true ? 1 : -1;
					return f;
				}
			} else {
				if (desc) {return a[sortingColumn].localeCompare(b[sortingColumn]);}
				else { return b[sortingColumn].localeCompare(a[sortingColumn]); }
			}
		});
		return true;
	}
	let desc = activeDesc;
	let SortingColumn = column;
	let ss = sorting(SortingColumn, desc);
	const tbody = document.getElementById('tbody');
	if (ss) {
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
			tdBtnEdit.onclick = function() {return editItem(obj[key]['id'])};
			tdBtnEdit.textContent = 'Изменить';
			tr.appendChild(tdBtnEdit);
			let tdBtnDelete = document.createElement('td');
			tdBtnDelete.className = 'tdBtnDelete';
			tdBtnDelete.onclick = function() {return deleteItem(obj[key]['id'])};
			tdBtnDelete.textContent = 'Удалить';
			tr.appendChild(tdBtnDelete);
			tbody.appendChild(tr);
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
