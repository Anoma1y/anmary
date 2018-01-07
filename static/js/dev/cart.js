//Добавление в корзину (продукт)
const addToCartBtn = document.getElementById('detail-add-to-cart');
const productId = document.getElementById('detail-product-id');
const errorText = document.getElementById('detail-product-error');
const deleteFromCartBtn = document.getElementsByClassName('cart-delete-item');
const selectedProductSize = document.getElementsByClassName('size-item');
//Добавление в корзину (каталог)
const addToCartBtnCatalog = document.getElementsByClassName('add_to_cart');
//Заказ
const orderName = document.getElementById('order-user-name');
const orderEmail = document.getElementById('order-user-email');
const orderTelephone = document.getElementById('order-user-telephone');
const orderComment = document.getElementById('order-user-comment');
const orderBtnSend = document.getElementById('order-user-submit');
const orderingWrapper = document.getElementById('orderingWrapper');

var order = void 0;
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

//Форма заказа
// Валидация данных в форме отправки заказа
/**
 * Класс Validation для проверки введенных данных
 */
class Validation {
	constructor() {
		this.emailPattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
		this.namePattern = /^[a-zA-ZА-Яа-яЁё]+$/i;
		this.telephonePattern = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
		this.textPattern = /^[a-zA-ZА-Яа-яЁё\d\s%,.?!#$№:*()]+$/g;
	}
	/**
	 * [errorText функция для вывода ошибки]
	 * @param  {Node} nodeError [id узла куда выводить ошибку]
	 * @param  {String} text      []
	 */
	errorText(nodeError, text = "") {
		try {
			if (nodeError) {
				var error = document.getElementById(nodeError);
				error.innerText = text;			
			}
		} catch(e) {
			console.log(e);
		}
	}
	/**
	 * [validationEmail Метод проверки почты]
	 * @param  {String} email [Почта]
	 * @return {String}       [Если соответствует regepx то возвращает email]
	 * @return {String} 	  [Если не соответствует regexp то выводит текст ошибки]
	 */
	validationEmail(email) {
		return new Promise((res, rej) => {
			if (email.match(this.emailPattern)) {
				res(email);
			} else {
				rej("Ошибка при заполнении поля Почта");
			}			
		})
	}
	/**
	 * [validationName Метод проверки имени]
	 * @param  {String} name [Имя]
	 * @return {String}       [Если соответствует regepx то возвращает name]
	 * @return {String} 	  [Если не соответствует regexp то выводит текст ошибки]
	 */
	validationName(name) {
		return new Promise((res, rej) => {
			if (typeof name == "string") {
				if (name.match(this.namePattern) && name.length > 3 && name.length <= 40) {
					res(name);
				} else {
					rej("Ошибка при заполнении поля Имя");
				}				
			}
		})
	}
	/**
	 * [validationText Метод проверки текста комментария]
	 * @param  {String} text [Почта]
	 * @return {String}       [Если соответствует regepx то возвращает text]
	 * @return {String} 	  [Если не соответствует regexp то выводит текст ошибки]
	 */
	validationText(text) {
		return new Promise((res, rej) => {
			if (typeof text == "string") {
				if (text.match(this.textPattern) && text.length > 3 && text.length <= 500) {
					res(text);
				} else {
					rej("Ошибка при заполнении поля Комментарий");
				}				
			}		
		})
	}
	/**
	 * [validationTelephone Метод проверки телефона]
	 * @param  {String} telephone [Почта]
	 * @return {String}       [Если соответствует regepx то возвращает telephone]
	 * @return {String} 	  [Если не соответствует regexp то выводит текст ошибки]
	 */
	validationTelephone(telephone) {
		return new Promise((res, rej) => {
			if (typeof telephone == "string") {
				if (telephone.match(this.telephonePattern)) {
					res(telephone);
				} else {
					rej("Ошибка при заполнении поля Контактный телефон");
				}
			}
		})
	}	
}

/**
 * Класс Order для проверки и отправки AJAX запросом заказа
 */
class Order extends Validation{
	constructor(orderName, orderEmail, orderTelephone, orderComment, orderBtnSend, url) {
		super();
		this.url = url;
		this.orderName = orderName; 
		this.orderEmail = orderEmail; 
		this.orderTelephone = orderTelephone; 
		this.orderComment = orderComment; 
		this.orderBtnSend = orderBtnSend; 
	}
	/**
	 * [init Метод для добавления обработчика событий для кнопки подтвердить заказ]
	 * {Function} [вызывает метод orderCheck()]
	 */
	init() {
		this.orderBtnSend.addEventListener('click', e => {
			e.preventDefault();
			this.orderCheck();
		})
	}
	/**
	 * [getEmail Метод получения текущей почты]
	 * @return {[type]} [Возвращает текст узла]
	 * @return {String} [Если текст узла пустой, то выводит текст ошибки]
	 */
	getEmail() {
		if (this.orderEmail != undefined && this.orderEmail.value.length != 0) {
			return this.orderEmail.value;
		} else {
			this.errorText("error", "Заполните поле Почта");
		}
	}
	/**
	 * [getName Метод получения текущего имени]
	 * @return {[type]} [Возвращает текст узла]
	 * @return {String} [Если текст узла пустой, то выводит текст ошибки]
	 */
	getName() {
		if (this.orderName != undefined && this.orderName.value.length != 0) {
			return this.orderName.value;
		} else {
			this.errorText("error", "Заполните поле Имя");
		}
	}
	/**
	 * [getTelephone Метод получения текущего телефона]
	 * @return {[type]} [Возвращает текст узла]
	 * @return {String} [Если текст узла пустой, то выводит текст ошибки]
	 */
	getTelephone() {
		if (this.orderTelephone != undefined && this.orderTelephone.value.length != 0) {
			return this.orderTelephone.value;
		} else {
			this.errorText("error", "Заполните поле Контактный телефон");
		}
	}
	/**
	 * [getText Метод получения текущего комментария]
	 * @return {[type]} [Возвращает текст узла]
	 * @return {String} [Если текст узла пустой, то выводит текст ошибки]
	 */
	getText() {
		if (this.orderComment != undefined && this.orderComment.value.length != 0) {
			return this.orderComment.value;
		} else {
			this.errorText("error", "Заполните поле Комментарий");
		}
	}
	/**
	 * [orderSend AJAX запрос для отправки данных с формы]
	 * @param  {String} url  [URL ссылку]
	 * @param  {Object} data [Объект данных]
	 * @return {Function}      [Возвращает функцию]
	 * @return {Function} 	   [Возвращает текст ошибки]
	 */
	orderSend(url, data) {
		return new Promise((res, rex) => {
			$.ajax({
				url: url,
				type: "POST",
				data: {data: data},
			})
			.done(function(data) {
				let status = JSON.parse(data);
				res(parseInt(status));
			})
			.fail(function() {
				rej("Ошибка при отправке данных");
			})			
		});
	}
	/**
	 * [orderCheck Метод для проверки полей формы и добавления данных в объект data]
	 */
	
	async orderCheck() {
		try {
			let name = await this.validationName(this.getName());
			let email = await this.validationEmail(this.getEmail());
			let telephone = await this.validationTelephone(this.getTelephone());
			let text = await this.validationText(this.getText());
			let data = {
				name: name,
				email: email,
				telephone: telephone,
				text: text
			}
			this.errorText("error", "");
			let ajax = await this.orderSend(this.url, data);
			if (ajax == 1) {
				window.location = "/cart/order_status";
			} else {
				this.errorText("error", "Ошибка при отправке данных");
			}
		} catch(e) {
			this.errorText("error", e);
		}
	}
}

if (orderName && orderEmail && orderTelephone && orderComment && orderBtnSend) {
	order = new Order(orderName, orderEmail, orderTelephone, orderComment, orderBtnSend,"addOrder");
	order.init();
}
