<?php
	session_start();
?>
<?php require_once '/views/index/header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2 id="username"><?=$users['username'] ?></h2>
			
<hr>
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<img src="<?=$profile['photo'];?>" alt="" width="200px">
			<p>Статус: <?php if(!empty($online)) { echo "Online"; } else {echo "Offline"; } ?></p>	
			<p>Пол: <?=$gender; ?></p>
			<p>День рождения: <?=$profile['birthday']; ?></p>
			<p>Место жительства: <?=$profile['location_country']."/".$profile['location_city']; ?></p>
			<p>Дата регистрации: <?=$users['joined']; ?></p>

			<?php if ($users['hash'] == $_COOKIE['username_hash']) {
				echo "<a href='editprofile'>Редактировать профиль</a>";
			}  ?>
		</div>
		<div class="col-md-3">
			<p>В текущий момент <span>(<?=$count_complete['Complete']['count_complete'] ?>)</span> </p>
			<p>Просмотрено <span>(<?=$count_complete['Watching']['count_complete'] ?>)</span> </p>
			<p>Отложено <span>(<?=$count_complete['On-Hold']['count_complete'] ?>)</span> </p>
			<p>Брошено <span>(<?=$count_complete['Dropped']['count_complete'] ?>)</span> </p>
			<p>Запланировано <span>(<?=$count_complete['Plan to Watch']['count_complete'] ?>)</span> </p>
			<p>Всего записей <span>(<?=$count_complete['Total Entries']['count_complete'] ?>)</span> </p>
		</div>
		<div class="col-md-6">
			<p>Избранное</p>
			<div class="row">
				<div class="col-md-4">Аниме</div>
				<div class="col-md-4">Фильмы</div>
				<div class="col-md-4">Сериалы</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12" style="border: 1px solid black">

	<!-- TODO -->
			<p>Комментарии:</p>
			<form id="comment_form" action="javascript:void(null);" onsubmit="addComment()" enctype="multipart/form-data" method="POST">
				<input type="text" placeholder="Комментарий" id="new_comment" name="comment">
				<input type="submit" name="go_comment" value="Добавить комментарий">
			</form>
			<p id="qwe" onclick="getComment()">asd</p>
			<div class="get_comment">
				
			</div>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous">
 </script>
<script type="text/javascript">
window.onload = getComment();
function getComment(){
	var username = $('h2')[0].textContent;
    $.ajax({
      type: 'POST',
      url: 'action_comment',
      data: {username:username},
      success: function(data) {
      	   var comment_json = JSON.parse(data);
	      	for (var key in comment_json){
	      		$(".get_comment").append(comment_json[key]['date'] + " : " + comment_json[key]['text'] + "<br>");
	      	}
      },
      error:  function(xhr, str){
	    console.log('Возникла ошибка: ' + xhr.responseCode);
          }
    });	
};

 	function addComment() {
 			var form = $('#new_comment').val();
 			var username = $('h2')[0].textContent;
	        $.ajax({
	          type: 'POST',
	          url: 'action_addcomment',
	          data: {
	          	  form: form,
	          	  username: username
	          },
	          success: function(data) {
                console.log(data);
	          },
	          error:  function(xhr, str){
		    alert('Возникла ошибка: ' + xhr.responseCode);
	          }
	        });
    }
</script>




<?php require_once '/views/index/footer.php'; ?>
