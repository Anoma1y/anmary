<?php 
    if (!isset($_COOKIE['username_hash'])){
    	die('Access Denied');
    }
    if ($_COOKIE['username_hash'] !== $user['hash']) {
    	die('Access Denied');
    }
?>
<?php echo "Hello {$user['username']}"; ?>
<?php 
?>

<p>Аватар: <img src="<?= $profile['photo'] ?>" alt="" width="250px"></p>
<form id="formx" action="javascript:void(null);" onsubmit="uploadImage()" enctype="multipart/form-data" method="POST">
	<p><input id="uploadimage" type="file" name="photo"></p>
	<input type="submit" name="edit" value="Изменить">
</form>

<form id="edit_info" action="javascript:void(null);" onsubmit="editInfo()" method="POST">
	<p>Пол: 
		<select name="gender" id="gender">
		<?php 
			if ($profile['gender'] == 'Male') {
				echo "<option selected value='Male'>Мужской</option>";	
				echo "<option value='Female'>Женский</option>";	
			} else if ($profile['gender'] == 'Female') {
				echo "<option value='Male'>Мужской</option>";	
				echo "<option selected value='Female'>Женский</option>";	
			} else {
				echo "<option value=''>Выберите пол</option>";	
				echo "<option value='Male'>Мужской</option>";	
				echo "<option value='Female'>Женский</option>";				
			}
		?>
		</select>
	</p>
	<p>День рождения: <input type="date" name="date" value="<?= $profile['birthday'] ?>"></p>
	<select name="country" id="country">

		<?php 
			if (!empty($countries)) {
				echo "<option value='$countries[id]'>$countries[name]</option>";
			} 
		 ?>
	</select>
	<select name="state" id="state">
		<?php 
			if (!empty($states)) {
				echo "<option value='$states[id]'>$states[name]</option>";
				foreach ($staties as $key) {
					echo "<option value='$key[id]'>$key[name]</option>";
				}
			}
		 ?>	
	</select>
	<select name="city" id="city">
		<?php 
			if (!empty($cities)) {
				echo "<option value='$cities[id]'>$cities[name]</option>";
				foreach ($citites as $key) {
					echo "<option value='$key[id]'>$key[name]</option>";
				}
			}
		 ?>	
	</select>
	<textarea name="about_me" id="" cols="30" rows="10">
		<?php 			
			if ($profile['about_me'] !== '') {
				echo $profile['about_me'];
			} 
		 ?>
	</textarea>
	<select name="invite_club">
		<?php 
			if ($profile[invite_club] == 0) {
				echo "<option selected value='0'>Нет</option>";
				echo "<option value='1'>Да</option>";
			} else {
				echo "<option value='0'>Нет</option>";
				echo "<option selected value='1'>Да</option>";
			}
		?>
	</select>
	<select name="invite_friend">
		<?php 
			if ($profile[invite_friend] == 0) {
				echo "<option selected value='0'>Нет</option>";
				echo "<option value='1'>Да</option>";
			} else {
				echo "<option value='0'>Нет</option>";
				echo "<option selected value='1'>Да</option>";
			}
		?>
	</select>
	<select name="comment_enable">
		<?php 
			if ($profile[comment_enable] == 0) {
				echo "<option selected value='0'>Нет</option>";
				echo "<option value='1'>Да</option>";
			} else {
				echo "<option value='0'>Нет</option>";
				echo "<option selected value='1'>Да</option>";
			}
		?>
	</select>
	<select name="visible_profile">
		<?php 
			if ($profile[visible_profile] == 0) {
				echo "<option selected value='0'>Нет</option>";
				echo "<option value='1'>Да</option>";
			} else {
				echo "<option value='0'>Нет</option>";
				echo "<option selected value='1'>Да</option>";
			}
		?>
	</select>
	<select name="visible_list">
		<?php 
			if ($profile[visible_list] == 0) {
				echo "<option selected value='0'>Нет</option>";
				echo "<option value='1'>Да</option>";
			} else {
				echo "<option value='0'>Нет</option>";
				echo "<option selected value='1'>Да</option>";
			}
		?>
	</select>
	<input type="submit" name="edit" value="Изменить">


</form>
<div id="results"></div>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous">
 </script>
<script type="text/javascript">
(function(){
    $.ajax({
      type: 'POST',
      url: 'action_allcountry',
      dataType: "json", 
      success: function(data) {
      	for (var key in data) {
          $('#country').append('<option value="'+ data[key]['id'] + '">'+ data[key]['name'] +'</option>')
      	}
      },
      error:  function(xhr, str){
    	console.log('Возникла ошибка: ' + xhr.responseCode);
      }
    });
})();
 	 function editInfo() {
	 	  var msg = $('#edit_info').serialize();
	        $.ajax({
	          type: 'POST',
	          url: 'action_edit',
	          data: msg,
	          success: function(data) {
                location.reload();
	          },
	          error:  function(xhr, str){
		    alert('Возникла ошибка: ' + xhr.responseCode);
	          }
	        });
    }
 	 function uploadImage() {
	    var $input = $("#uploadimage");
	    var fd = new FormData;

	    fd.append('img', $input.prop('files')[0]);

	    $.ajax({
	        url: 'action_upload',
	        data: fd,
	        processData: false,
	        contentType: false,
	        type: 'POST',
	        success: function(data) {
	        	if (data == 'Image Upload') {
	        		location.reload();
	        	}
	        },
	        error: function(er) { console.log(er) }
	    });
    }
	$('#country').on('change', function() {
		var selectedValue = this.value;
	    $.ajax({
	      type: 'POST',
	      url: 'action_countries',
	      data: {option : selectedValue},
	      dataType: "json", 
	      success: function(data) {
	      	$('#state').empty();
	        $('#city').empty();
	      	for (var key in data) {
	       		$('#state').append('<option value="'+ data[key]['id'] + '">'+ data[key]['name'] +'</option>')
	      	}
	      },
	      error:  function(xhr, str){
	    	console.log('Возникла ошибка: ' + xhr.responseCode);
	      }
	    });
	})
	$('#state').on('change', function() {
		var selectedValue = this.value;
	    $.ajax({
	      type: 'POST',
	      url: 'action_states',
	      data: {option : selectedValue},
	      dataType: "json", 
	      success: function(data) {
	      	$('#city').empty();
	      	for (var key in data) {
	       		$('#city').append('<option value="'+ data[key]['id'] + '">'+ data[key]['name'] +'</option>')
	      	}
	      },
	      error:  function(xhr, str){
	    	console.log('Возникла ошибка: ' + xhr.responseCode);
	      }
	    });
	})




</script>

