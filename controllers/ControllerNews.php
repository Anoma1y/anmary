<?php
	class News {
		public function index() {
	        require_once('views/news/index.php');
	        return true;
		}
		public function getNews() {
	    	require_once 'engine/ajax_pagination.php';
		    $params = include('engine/config.php');
		    //Основной запрос
			$sql = 'SELECT * FROM news ORDER BY news_date DESC, id DESC LIMIT :start_from, :record_per_page';	
		    //Запрос на количество записей и количество страниц
		    $sql1 = 'SELECT id FROM news ORDER BY id';
		    $order_by = 'id';
		    $q = new Pagination(1, $params["record_per_page"], $sql, $sql1, $order_by);
		    $q->getPages();
		}
	}