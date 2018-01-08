<?php require_once 'header.php'; ?>

<div class="add_news">
	<form action="../admin/addNews" method="POST" enctype="multipart/form-data">
		<div>
			<label for="news-add-title">Заголовок новости</label>
			<input type="text" id="news-add-title" name="news-add-title">
		</div>
		<div>
			<label for="news-add-text">Текст новости</label>
			<textarea id="news-add-text" name="news-add-text"></textarea>
		</div>
		<div>
			<label for="news-add-image">Изображение</label>
			<input type="file" id="news-add-image" name="news-add-image">
		</div>
		<div>
			<label for="news-add-btn">Добавить</label>
			<input type="submit" id="news-add-btn" name="news-add-btn" value="Добавить">
		</div>
	</form>
</div>