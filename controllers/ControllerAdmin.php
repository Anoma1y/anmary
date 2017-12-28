<?php
	class Admin {
	    public function indexView() {
	    	require_once 'engine/functions.php';
	    	$check = User::checkAdministrator($_COOKIE["user_hash"]);
	    	if ($check['permissions'] == '{"admin": 1}') {
				require_once('views/admin/index.php');
			    return true;	    		
	    	} else {
	    		die('Access Denied');
			}
	    }
	    public function add() {
	    	$check = User::checkAdministrator($_COOKIE["user_hash"]);
	    	if ($check['permissions'] == '{"admin": 1}') {
		    	$brandList = Admins::getCategory("brand");
		    	$categoryList = Admins::getCategory("category");
		    	$seasonList = Admins::getCategory("season");
		    	$colorList = Admins::getCategory("color");
				require_once('views/admin/add.php');
			    return true;  		
	    	} else {
	    		die('Access Denied');
			}
	    }
	    public function delete() {
	    	$check = User::checkAdministrator($_COOKIE["user_hash"]);
	    	if ($check['permissions'] == '{"admin": 1}') {
				require_once('views/admin/delete.php');
			    return true;  	
			   } else {
	    		die('Access Denied');
			}	    	
	    }
	    public function edit() {
	    	$check = User::checkAdministrator($_COOKIE["user_hash"]);
	    	if ($check['permissions'] == '{"admin": 1}') {
		    	$brandList = Admins::getCategory("brand");
		    	$categoryList = Admins::getCategory("category");
		    	$seasonList = Admins::getCategory("season");
		    	$colorList = Admins::getCategory("color");
		    	$productData = ProductModel::editProductById();
				require_once('views/admin/edit.php');
			    return true;  		
	    	} else {
	    		die('Access Denied');
			}    	
	    }
	    public function addProduct() {
	    	$check = User::checkAdministrator($_COOKIE["user_hash"]);
	    	if ($check['permissions'] == '{"admin": 1}') {
		    	$view = new View();
				$view->render('admin/add_product');    		
	    	} else {
	    		die('Access Denied');
			}
	    }
	    public function editProduct() {
	    	$check = User::checkAdministrator($_COOKIE["user_hash"]);
	    	if ($check['permissions'] == '{"admin": 1}') {
		    	$view = new View();
				$view->render('admin/edit_product');    		
	    	} else {
	    		die('Access Denied');
			}
	    }
	    public function getAllProducts() {
	    	$check = User::checkAdministrator($_COOKIE["user_hash"]);
	    	if ($check['permissions'] == '{"admin": 1}') {
		    	$view = new View();
				$view->render('admin/getAllProducts_action');    		
	    	} else {
	    		die('Access Denied');
			}
	    }
	}