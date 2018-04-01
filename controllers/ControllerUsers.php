<?php
	require_once "engine/Session.php";
	require_once "engine/Cookie.php";
	require_once 'models/subscribe.php';
    $params = include('config.php');
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
			// $view = new View();
			// $view->render('users/register');
		}
	    public function logout() {
	    	if (isset($_COOKIE)) {
		    	// Удаление сессий
		    	Session::destroy();
		    	// Удаление куков
		    	Cookie::destroy();
	        	// Перенаправляем пользователя на главную страницу
	        	header("Location: /");
	    	}
	    }
		public function login_action() {
			if (!empty($_POST)) {
				$user = User::userLogin($_POST);
				return $user;				
			}
		}
		public function signup_action() {
			if (!empty($_POST)) {
				$user = User::userRegistration($_POST);
				return $user;
			}
		}
		public function profile() {
       		require_once('views/users/profile.php');
	        return true;		
		}
		public function subscribe() {
			if (!empty($_POST)) {
				$email = $_POST["email_subscribe"];
				Subscribe::insert($email);				
			} else {
				return false;
			}
		}
	}