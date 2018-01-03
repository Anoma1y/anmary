
	var checkEmail = false;
	var checkName = false;
	var checkText = false;
	$('#form-email').on('blur', function(e){
        if($(this).val() != '') {
            var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
            if(pattern.test($(this).val())){
                $(this).css({'border' : '1px solid #569b44'});
                checkEmail = true;
                $('#error').css('opacity', 0);
            } else {
                $(this).css({'border' : '1px solid #ff0000'});
                checkEmail = false;
                $('#error').css('opacity', 1);
           		$('#error').text('Укажите правильный адрес E-mail');
            }
        } else {
            $(this).css({'border' : '1px solid #ff0000'});
            checkEmail = false;
            $('#error').css('opacity', 1);
            $('#error').text('Укажите почту');
        }
	})
	$('#form-name').on('blur', function(e){
        if($(this).val() != '') {
	        $(this).css({'border' : '1px solid #569b44'});
	        checkName = true;
	        $('#error').css('opacity', 0);
        } else {
            $(this).css({'border' : '1px solid #ff0000'});
            checkName = false;
            $('#error').css('opacity', 1);
            $('#error').text('Укажите имя');
        }
	});
	$('#form-text').on('blur', function(e){
        if($(this).val().length >= 20) {
	        $(this).css({'border' : '1px solid #569b44'});
	        checkText = true;
            $('#error').css('opacity', 0);
        } else {
            $(this).css({'border' : '1px solid #ff0000'});
            checkText = false;
            $('#error').css('opacity', 1);
            $('#error').text('Сообщение должно быть больше 20 символов');
        }
	})
	$('#form-name, #form-email').on('keypress', function(e){
		e = e || window.event;
		if (e.keyCode == 13 || e.which == 13) {
			e.preventDefault() ? e.preventDefault() : e.returnValue = false;
		}
	})
	//Ajax send email
	$('#sendEmailBtn').on('click', function(e) {
		e.preventDefault();
		const formArray = $('#sendEmailForm').serializeArray();
		const name = $('#form-name').val();
		const email = $('#form-email').val();
		const text = $('#form-text').val();
		if (checkEmail === true && checkName === true && checkText === true) {
			$.ajax({
				url: 'contacts/sendEmail',
				type: 'POST',
				data: {
					name: name,
					email: email,
					text: text
				}
			}).done(function() {
				$('#sendEmailBtn').fadeOut('400');
				setTimeout(function(){
					$('#sendEmailBtn').after('<h2 class="sendOk">Отправлено</h2>');
				}, 250);
			})
			.fail(function() {
				$('#error').css('opacity', 1);
				$('#error').text('Ошибка при отправке');
				$('#sendEmailBtn').val("Отправить");
			})
			.always(function() {
				$('#sendEmailBtn').val("Отправка");
			});
		} else {
			if (!checkEmail) {
				$('#form-email').css({'border' : '1px solid #ff0000'});
			} else {
				$('#form-email').css({'border' : '1px solid #569b44'});
			}
			if (!checkName) {
				$('#form-name').css({'border' : '1px solid #ff0000'});
			} else {
				$('#form-name').css({'border' : '1px solid #569b44'});
			}
			if (!checkText) {
				$('#form-text').css({'border' : '1px solid #ff0000'});
			} else {
				$('#form-text').css({'border' : '1px solid #569b44'});
			}
			$('#error').css('opacity', 1);
			$('#error').text('Заполните все поля');
		}

	});
