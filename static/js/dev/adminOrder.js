const btnCloseOrder = document.getElementsByClassName('tdBtnCloseOrder');

/**
 * [Завершение заказа]
 */
if (btnCloseOrder) {
	for (let completeOrder of btnCloseOrder) {
		completeOrder.addEventListener('click', e => {
			var code = e.target.dataset.code;
			if (code) {
				if (confirm("Подтвердите завершение заказа") === true) {
					$.ajax({
						url: 'completeOrder',
						type: 'POST',
						data: {code: code},
					})
					.done(function(data) {
						if (JSON.parse(data) == true) {
							window.location.reload();
						}
					})
					.fail(function() {
						console.log("error");
					})					
				}
			}
		})
	}
}