<?php

	class Users {
		
		public function index() {
			$data['users'] = User::getAllUsers();
			$data['title'] = 'Hello';
			$view = new View();
			$view->render('users/index', $data);
		}
	  
		public function login() {
			$view = new View();
			$view->render('users/login');
		}
	    public function logout()
	    {
	        session_start();
	        unset($_SESSION["username"]);
	        setcookie("username_id", $_COOKIE['username_id'], time()-60*60*24*30, '/', 'site.loc');
	        setcookie("username_hash", $_COOKIE['username_hash'], time()-60*60*24*30, '/', 'site.loc');	 
            header("Location: /");
	    }
		public function login_action() {
			$view = new View();
			$view->render('users/login_action');
		}
	}

?>