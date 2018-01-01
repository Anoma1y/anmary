<?php
	/**
	* Подключение моделей для контроллеров.
	**/
	require_once 'models/admin.php';

	require_once 'models/user.php';

	require_once 'models/catalog.php';

	require_once 'models/product.php';

	
	/* Основные настройки */
	return array(
		'home_title' => 'SITE NAME',
		'charset' => 'utf8',
		'description' => 'Описание сайта',
		'keywords' => 'Ключевые, Слова, Через, Запятую',
		'site_offline' => 'yes',
		'registration ban' => 'no',
	    'host' => 'localhost', //Хост БД
	    'dbname' => 'srv77500_anmary', //Имя БД
	    'user' => 'root', //Логин от БД
	    'password' => '', //Пароль от БД
	    'dbcharset' => 'utf8', //Кодировка БД
	     //Пагинация AJAX
	    'record_per_page' => 9, //Записей на странице
	    'record_admin_page' => 20, //Записей на странице админки
	    //Куки
	    'domain' => 'anmary',
	    //Информация о магазине
	    'schedule' => 'Пн-вс, с 10:00 до 20:00',

	);

