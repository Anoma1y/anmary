<?php session_start(); 
	  require_once 'views/index/header.php';
?>
<br>

<img src="<?=$anime['picture'];?>" alt="">
<h1><?=$anime['name']?></h1>

<p>Жанры</p>

<?=print_r($genre);?>