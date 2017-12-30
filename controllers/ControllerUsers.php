<?php
    
    $params = include('engine/config.php');
	class Users {
		public function index() {
			$data['users'] = User::getAllUsers();
			$data['title'] = 'Hello';
			$view = new View();
			$view->render('users/index', $data);
		}
	  
		public function signin() {
			$view = new View();
			$view->render('users/login');
		}
		public function signup() {
			$view = new View();
			$view->render('users/register');
		}
	    public function logout() {
	    	User::logoutUser();
	    }
		public function login_action() {
			$view = new View();
			$view->render('users/login_action');
		}
		public function profile() {
       		require_once('views/users/profile.php');
	        return true;		
		}
		public function cart() {
       		require_once('views/users/cart.php');
	        return true;		
		}
	}