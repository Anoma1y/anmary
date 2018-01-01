'use strict';

var input_email = document.getElementById('email');
var input_password = document.getElementById('password');
var button = document.getElementById('login');
var error = document.getElementById('error');
var checkEmail = false;
var checkPassword = false;

input_password.addEventListener('change', function (e) {
	var target = e.target;
	if (target.value.length >= 3 && target.value.length <= 50) {
		target.style.borderColor = 'green';
		checkPassword = true;
	} else {
		checkPassword = false;
		target.style.borderColor = 'red';
	}
});
input_email.addEventListener('change', function (e) {
	var target = e.target;
	if (target.value != '') {
		if (target.value.match(/^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i)) {
			target.style.borderColor = 'green';
			checkEmail = true;
		} else {
			checkEmail = false;
			target.style.borderColor = 'red';
		}
	}
});

button.addEventListener('click', function (e) {
	e.preventDefault();
	if (checkPassword === true && checkEmail === true) {
		$.ajax({
			url: 'login_action',
			type: 'POST',
			data: {
				email: input_email.value,
				password: input_password.value
			}
		}).done(function (data) {
			var status = JSON.parse(data);
			if (status === true) {
				window.location = "/";
			} else {
				error.innerText = status;
			}
		}).fail(function () {
			console.log("error");
		});
	} else if (!checkEmail || !checkPassword) {
		error.innerText = 'Введите логин и пароль';
	}
});