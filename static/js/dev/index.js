$(document).ready(function() {
  const get_subscribe = document.querySelector(".get_subscribe");
  const wrapperSubscribe = document.querySelector(".formSubscribe");
  const get_subscribe_email = document.getElementById("get_subscribe_email");
  const get_subscribe_btn = document.getElementById("get_subscribe_btn");
  const errorText = document.getElementById("error-subscribe");

  const emailPattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
  if (get_subscribe_email && get_subscribe_btn) {
    $(get_subscribe_btn).on("click", function() {
      var emailValue = get_subscribe_email.value;
      if (
        emailValue.match(emailPattern) &&
        emailValue.length >= 3 &&
        emailValue.length <= 100
      ) {
        $.ajax({
          url: "../users/subscribe",
          type: "POST",
          data: { email_subscribe: emailValue }
        })
          .done(function(data) {
            get_subscribe_email.setAttribute("disabled", "disabled");
            get_subscribe_btn.setAttribute("disabled", "disabled");
            wrapperSubscribe.innerHTML = "";
            get_subscribe.innerHTML = "<h2>Спасибо за подписку</h2>";
          })
          .fail(function() {
            errorText.innerText = "Ошибка";
          });
      } else {
        errorText.innerText = "Ошибка при заполнении E-Mail'a";
      }
    });
  }

  $(window).scroll(function() {
    let topWindow = $(window).scrollTop() * 0.7;
    let windowHeight = $(window).height();
    let position = topWindow / windowHeight;
    position = 1 - position;
    $(".arrow-main").css("background-color", rgba(0, 0, 0, position));
  });

  $('a[href^="#blocks-info"]').click(function() {
    if (
      location.pathname.replace(/^\//, "") ==
        this.pathname.replace(/^\//, "") &&
      location.hostname == this.hostname
    ) {
      let target = $(this.hash);
      target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
      if (target.length) {
        $("html,body").animate(
          {
            scrollTop: target.offset().top
          },
          1000
        );
        return false;
      }
    }
  });
  $("#slider").responsiveSlides({
    auto: true,
    pager: false,
    nav: true,
    speed: 800,
    namespace: "callbacks",
    before: function() {
      $(".events").append("<li>before event fired.</li>");
    },
    after: function() {
      $(".events").append("<li>after event fired.</li>");
    }
  });
});
