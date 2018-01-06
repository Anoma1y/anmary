//Корзина
const addToCartBtn = document.getElementById('detail-add-to-cart');
const productId = document.getElementById('detail-product-id');
const errorText = document.getElementById('detail-product-error');
const deleteFromCartBtn = document.getElementsByClassName('cart-delete-item');
const selectedProductSize = document.getElementsByClassName('size-item');

//Установка для переменной id - id продукта
var id = productId != undefined ? productId.innerText : undefined;

//По умолчанию размер берется из нулевого элемента
var currentProductSize = void 0;
if (selectedProductSize.length != 0) {
	currentProductSize = selectedProductSize[0].checked === true ? selectedProductSize[0].innerText : undefined;
}

/**
 * [getCurrentSize [Функция для проверки всех чекбоксов и добавления из label - текст размера]
 * @param  {object} checkbox [Класс чекбоксов]
 * @return {[type]}          [возвращает массив значений]
 */
function getCurrentSize(checkbox) {
	var checkboxes = document.getElementsByClassName(checkbox);
	var checkedArray = [];
	for (let item of checkboxes) {
		if (item.checked) {
			checkedArray.push(item.innerText);
		}
	}
	return checkedArray.length > 0 ? checkedArray : null;
}

/**
 * [errorSet функция для указания ошибки]
 * @param  {String} errorId [ID - узла, в который будет записан текст ошибки]
 * @param  {String} text    [текст ошибки]
 * @return {id.text}         [запись в указанный ID - текст]
 */
function errorSet(errorId, text = "") {
	errorId.innerText = text.length > 0 ? text : "";
}
/**
 * [getSpan Функция для получения SPAN,a id, для вставки туда текста]
 * @param  {object} id         [ID узла, в котором нужен поиск]
 * @param  {string} searchNode [Название узла, который нужно найти]
 * @return {object}            [Возвращает нужный узел]
 */
function getSpan(id, searchNode) {
	for (let node of id.childNodes) {
		let searchItem = searchNode.toUpperCase();
		if (node.nodeName == searchItem) {
			return node;
		}
	}
}
//Установка для переменной currentProductSize текущего размера
//Обработчик события для label > input [ radio ]
if (selectedProductSize) {
	for (let sizeBtn of selectedProductSize) {
		sizeBtn.control.addEventListener('change', (e) => {
			currentProductSize = e.target.checked === true ? e.target.labels[0].innerText : null;
			if (sizeBtn.control.classList.contains('item_in_cart')) {
				addToCartBtn.classList.add('in-cart');
				getSpan(addToCartBtn, "span").innerText = "Удалить из корзины";
			} else {
				addToCartBtn.classList.remove('in-cart');
				getSpan(addToCartBtn, "span").innerText = "Добавить в корзину";
			}
		});
	}	
}
//Функция добавления товара в корзину
//Если кнопка добавления имеет класс in-cart, то выполняется AJAX запрос на удаления товара из корзины
//При удачном удалении, страница будет перезагружена
//Если класс in-cart не имеется, то происходит добавления товара с помощью AJAX запроса
//При удачном добавлении, страница перезагружается
if (addToCartBtn) {
	try {
		addToCartBtn.addEventListener('click', () => {
			if (currentProductSize != null) {
				if (addToCartBtn.classList.contains('in-cart')) {
					$.ajax({
						url: '../cart/deleteProductInCart',
						type: 'POST',
						data: {id: id,
							   size: currentProductSize
						},
					})
					.done(function() {
						window.location.reload();
					})
					.fail(function() {
						errorSet(errorText, "Ошибка при удалении из корзины");
					})	
				} else {
					$.ajax({
						url: '../cart/addProduct',
						type: 'POST',
						data: {id: id, 
							   size: currentProductSize
						},
					})
					.done(function() {
						window.location.reload();
					})
					.fail(function() {
						errorSet(errorText, "Ошибка добавления в корзину");
					})						
				}
			} else {
				errorSet(errorText, "Выберите размер");
			}
		})
	} catch(e) {
		errorSet(errorText, "Ошибка");
	}
}

//Функция удаления товара из корзины
if (deleteFromCartBtn) {
	try {
		for (var i = 0; i < deleteFromCartBtn.length; i++) {
			deleteFromCartBtn[i].addEventListener('click', (e) => {
				let target = e.target.dataset;
				let id = target.id;
				let size = target.size;
				$.ajax({
					url: '../cart/deleteProductInCart',
					type: 'POST',
					data: {id: id,
						   size: size
					},
				})
				.done(function() {
					window.location.reload();
				})
				.fail(function() {
					console.log("error");
				})			
			})
		}
	} catch(e) {
		console.log(e);
	}
}

/**
 * Оформление заказа
 */
// orderName
// orderEmail
// orderTelephone
// orderComment
// orderBtnSend
//Форма заказа
// const orderName = document.getElementById('order-user-name');
// const orderEmail = document.getElementById('order-user-email');
// const orderTelephone = document.getElementById('order-user-telephone');
// const orderComment = document.getElementById('order-user-comment');
// const orderBtnSend = document.getElementById('order-user-submit');
// Валидация данных в форме отправки заказа
class Validation {
	constructor() {
		this.emailPattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
		this.namePattern = /^[a-zA-ZА-Яа-яЁё]+$/i;
		this.telephonePattern = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
		this.textPattern = /^[a-zA-ZА-Яа-яЁё\d\s%,.?!#$№:*()]+$/g;
	}
	errorText(nodeError, text = "") {
		try {
			var error = document.getElementById(nodeError);
			error.innerText = text;
		} catch(e) {
			console.log(e);
		}
		
	}
	validationEmail(email) {
		return new Promise((res, rej) => {
			if (email.match(this.emailPattern)) {
				res();
			} else {
				rej();
			}			
		})
	}
	validationName(name) {
		return new Promise((res, rej) => {
			if (typeof name == "string") {
				if (name.match(this.namePattern) && name.length > 3 && name.length <= 40) {
					res();
				} else {
					rej();
				}				
			}
		})
	}
	validationText(text) {
		return new Promise((res, rej) => {
			if (typeof text == "string") {
				if (text.match(this.textPattern) && text.length > 3 && text.length <= 500) {
					res();
				} else {
					rej();
				}				
			}		
		})
	}
	validationTelephone(telephone) {
		return new Promise((res, rej) => {
			if (typeof telephone == "string") {
				if (telephone.match(this.telephonePattern)) {
					res();
				} else {
					rej();
				}
			}
		})
	}	
}
class Order extends Validation{
	constructor() {
		super();
		this.orderName = document.getElementById('order-user-name');
		this.orderEmail = document.getElementById('order-user-email');
		this.orderTelephone = document.getElementById('order-user-telephone');
		this.orderComment = document.getElementById('order-user-comment');
		this.orderBtnSend = document.getElementById('order-user-submit');
	}
	getEmail() {
		if (this.orderEmail != undefined && this.orderEmail.value.length != 0) {
			return this.orderEmail.value;
		}
	}
	getName() {
		if (this.orderName != undefined && this.orderName.value.length != 0) {
			return this.orderName.value;
		}
	}
	getTelephone() {
		if (this.orderTelephone != undefined && this.orderTelephone.value.length != 0) {
			return this.orderTelephone.value;
		}
	}
	getText() {
		if (this.orderComment != undefined && this.orderComment.value.length != 0) {
			return this.orderComment.value;
		}
	}
	orderSend(url, data) {
		$.ajax({
			url: url,
			type: "POST",
			data: {data: data},
		})
		.done(function() {
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
	}
	async orderCheck() {
		try {
			await this.validationName(this.getName());
			await this.validationEmail(this.getEmail());
			await this.validationTelephone(this.getTelephone());
			await this.validationText(this.getText());
			this.errorText("error", "");
		} catch(e) {
			this.errorText("error", "Ошибка");
		}
		
	}
}
var order = new Order();

