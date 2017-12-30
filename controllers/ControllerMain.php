<?php
	class Main {
		public function index() {
			$info = include('engine/info.php');
			$lastProduct = CatalogModel::getPopularModel(10);
	        require_once('views/index/index.php');
	        return true;
		}
	}
?>