const addToCartBtn = document.getElementById('detail-add-to-cart');
const productId = document.getElementById('detail-product-id');
const deleteFromCartBtn = document.getElementsByClassName('cart-delete-item');
const selectedProductSize = document.getElementsByClassName('size-item');
//Установка для переменной id - id продукта
var id = productId != undefined ? productId.innerText : undefined;

//По умолчанию размер берется из нулевого элемента
var currentProductSize = void 0;
if (selectedProductSize.length != 0) {
	currentProductSize = selectedProductSize[0].control.checked === true ? selectedProductSize[0].innerText : undefined;
}
//Установка для переменной currentProductSize текущего размера
//Обработчик события для label > input [ radio ]
if (selectedProductSize) {
	for (let sizeBtn of selectedProductSize) {
		sizeBtn.control.addEventListener('change', (e) => {
			currentProductSize = e.target.checked === true ? sizeBtn.innerText : undefined;
		});
	}	
}

//Функция добавления товара в корзину
if (addToCartBtn) {
	try {
		addToCartBtn.addEventListener('click', () => {
			$.ajax({
				url: '../cart/addProduct',
				type: 'POST',
				data: {id: id, 
					   size: currentProductSize
				},
			})
			.done(function(data) {
				window.location.reload();
			})
			.fail(function() {
				console.log("error");
			})			
		})
	} catch(e) {
		console.log(e);
	}
}

//Функция удаления товара из корзины
if (deleteFromCartBtn) {
	try {
		for (var i = 0; i < deleteFromCartBtn.length; i++) {
			deleteFromCartBtn[i].addEventListener('click', (e) => {
				id = e.target.dataset.id;
				$.ajax({
					url: '../cart/deleteProductInCart',
					type: 'POST',
					data: {id: id},
				})
				.done(function(data) {
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
