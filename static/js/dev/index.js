$(document).ready(function() {
   
    const get_subscribe = document.querySelector('.get_subscribe');
    const wrapperSubscribe = document.querySelector('.formSubscribe');
    const get_subscribe_email = document.getElementById('get_subscribe_email');
    const get_subscribe_btn = document.getElementById('get_subscribe_btn');
    const errorText = document.getElementById('error-subscribe');

    const emailPattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
    if (get_subscribe_email && get_subscribe_btn) {
        $(get_subscribe_btn).on('click', function() {
            var emailValue = get_subscribe_email.value;
            if (emailValue.match(emailPattern) && emailValue.length >= 3 && emailValue.length <= 100) {
                $.ajax({
                    url: '../users/subscribe',
                    type: 'POST',
                    data: {email_subscribe: emailValue},
                })
                .done(function(data) {
                    get_subscribe_email.setAttribute('disabled', 'disabled');
                    get_subscribe_btn.setAttribute('disabled', 'disabled');
                    wrapperSubscribe.innerHTML = "";
                    get_subscribe.innerHTML = "<h2>Спасибо за подписку</h2>";
                })
                .fail(function() {
                    errorText.innerText = "Ошибка";
                })
            } else {
                errorText.innerText = "Ошибка при заполнении E-Mail\'a";
            }
        })
    }



	$('a[href^="#brand"], a[href^="#main"]').on('click', function (e) {
        e.preventDefault();
        var target = this.hash;
        $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top+2
        }, 800, 'swing', function () {
            window.location.hash = target;
        });
    });

      $("#slider").responsiveSlides({
        auto: true,
        pager: false,
        nav: true,
        speed: 800,
        namespace: "callbacks",
        before: function () {
          $('.events').append("<li>before event fired.</li>");
        },
        after: function () {
          $('.events').append("<li>after event fired.</li>");
        }
      });
});