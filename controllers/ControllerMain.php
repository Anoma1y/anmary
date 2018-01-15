<?php
	
	class Main {
		public function index() {
			$lastProduct = CatalogModel::getPopularModel(10);
	        require_once('views/index/index.php');
	        return true;
		}
	}