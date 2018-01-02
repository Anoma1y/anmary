<?php
	require_once "engine/Session.php";
	require_once "engine/Cookie.php";
    $params = include('engine/config.php');
	class Cart {
		public function indexView(){
	        require_once('views/cart/index.php');
	        return true;
		}
	}
