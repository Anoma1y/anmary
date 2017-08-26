<?php
	class Admin {
	    public function indexView() {
	    	require_once 'engine/functions.php';
	    	$user = User::getCurrentUser();
	    	if ($user['role'] == "admin") {
				require_once('views/admin/index.php');
			    return true;	    		
	    	} else {
	    		die('Access Denied');
			}
	    }
	    public function add() {
	    	$user = User::getCurrentUser();
	    	if ($user['role'] == "admin") {
		    	$brandList = Admins::getBrand();
		    	$categoryList = Admins::getCategory();
		    	$seasonList = Admins::getSeason();
		    	$colorList = Admins::getColor();
				require_once('views/admin/add.php');
			    return true;  		
	    	} else {
	    		die('Access Denied');
			}
	    }
	    public function delete() {
	    	$user = User::getCurrentUser();
	    	if ($user['role'] == "admin") {
				require_once('views/admin/delete.php');
			    return true;  	
			   } else {
	    		die('Access Denied');
			}	    	
	    }
	    public function addProduct() {
	    	$user = User::getCurrentUser();
	    	if ($user['role'] == "admin") {
		    	$view = new View();
				$view->render('admin/add_product');    		
	    	} else {
	    		die('Access Denied');
			}
	    }
	    public function getAllProducts() {
	    	$user = User::getCurrentUser();
	    	if ($user['role'] == "admin") {
		    	$view = new View();
				$view->render('admin/getAllProducts_action');    		
	    	} else {
	    		die('Access Denied');
			}
	    }
	}