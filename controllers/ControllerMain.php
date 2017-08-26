<?php
	class Main {
		public function index() {
			$getPopularModel = CatalogModel::getPopularModel();
			$view = new View();
			$view->render('index/index', $getPopularModel);
		}
	}

?>