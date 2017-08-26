<form id="formx" action="javascript:void(null);" onsubmit="call()" method="POST">
	<input type="text" placeholder="Логин" name="username">
	<input type="text" placeholder="Пароль" name="password">
	<input type="submit" name="submit" value="Войти">
</form>
<div id="results"></div>
<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
 <script>
 	 function call() {
	 	  var msg   = $('#formx').serialize();
	        $.ajax({
	          type: 'POST',
	          url: 'login_action',
	          data: msg,
	          success: function(data) {
	            if (data === "Ok") {
	            	window.location = "/";
	            }
	            else {
	                $('#results').html(data);
	            }
	          },
	          error:  function(xhr, str){
		    alert('Возникла ошибка: ' + xhr.responseCode);
	          }
	        });
    }
 </script>