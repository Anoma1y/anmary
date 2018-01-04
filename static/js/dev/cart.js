const addToCartBtn = document.getElementById('detail-add-to-cart');
const productId = document.getElementById('detail-product-id');
const deleteFromCartBtn = document.getElementsByClassName('cart-delete-item');
var id = void 0;

if (addToCartBtn) {
	addToCartBtn.addEventListener('click', () => {
		if (productId) {
			id = productId.innerText;
		}
		$.ajax({
			url: '../cart/addProduct',
			type: 'POST',
			data: {id: id},
		})
		.done(function(data) {
			console.log(JSON.parse(data));
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	})	
}
if (deleteFromCartBtn) {
	for (var i = 0; i < deleteFromCartBtn.length; i++) {
		deleteFromCartBtn[i].addEventListener('click', (e) => {
			id = e.target.dataset.id;
			$.ajax({
				url: '../cart/deleteProductInCart',
				type: 'POST',
				data: {id: id},
			})
			.done(function(data) {
				window.location = '../cart';
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		})
	}

}