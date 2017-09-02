<?php
	/**
	* Подключение моделей для контроллеров.
	**/
	require_once 'models/admin.php';

	require_once 'models/user.php';

	require_once 'models/catalog.php';

	require_once 'models/product.php';

	return array(
		'home_title' => 'SITE NAME',
		'charset' => 'utf8',
		'description' => 'Описание сайта',
		'keywords' => 'Ключевые, Слова, Через, Запятую',
		'site_offline' => 'yes',
		'registration ban' => 'no',
	    'host' => 'localhost',
	    
	    'dbname' => 'srv77500_anmary',

	    'user' => '',

	    'password' => '',

	    'dbcharset' => 'utf8',
	     //Пагинация AJAX
	    'record_per_page' => 9, //Записей на странице
	    'record_admin_page' => 20 
	);

