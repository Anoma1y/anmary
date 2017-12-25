<?php
	class Main {
		public function index() {
			$lastProduct = CatalogModel::getLastProduct(10);
	        require_once('views/index/index.php');
	        return true;
		}
	}
?>