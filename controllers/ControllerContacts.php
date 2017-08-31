<?php
	class Contacts {
		public function index() {
			// $getPopularModel = CatalogModel::getPopularModel();
			$data = [];
			$view = new View();
			$view->render('contacts/index', $data);
		}
	}
?>