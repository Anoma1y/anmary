<?php
	class Profile {
	    public function indexView() {
	    	$routes = explode('/', $_SERVER['REQUEST_URI']);
	    	$users = Profiles::getUsers();
	    	$title['name'] = "Профиль | $users[username]";
	    	$online = Profiles::checkOnline();
	    	$profile = Profiles::getUserProfile();
	    	$gender = Profiles::getRussianGender($profile["gender"]);
	    	$count_complete = Profiles::getAllCount();
	    	$comments = Comment::getComments();
			if (!empty($users)) {
	       		require_once('views/profile/index.php');
		        return true;				
			} 
			else if($routes[3] == 'editprofile'){
				$title['name'] = 'Редактирование профиля';
				$this->editProfile();
			} 
			else {
				require_once "views/errors/404.php";
			}
	    }
	    public function editProfile() {
	    	$user = Profiles::checkUser();
	    	$profile = Profiles::getProfileEdit();
	    	$all_countries = Profiles::getAllCountries();
	    	$countries = Profiles::getCountries();
	    	if (!empty($countries)) {
	    		$staties = Profiles::getAllStatesUser($countries["id"]);
	    	}
	    	$states = Profiles::getStates();
	    	if (!empty($states)) {
	    		$citites = Profiles::getAllCitiesUser($states["id"]);
	    	}
	    	$cities = Profiles::getCities();
       		require_once('views/profile/edit.php');
	        return true;	    	
	    }
		public function action_upload() {
			$view = new View();
			$view->render('profile/action_upload');
		}	 
		public function action_edit() {
			$view = new View();
			$view->render('profile/action_edit');
		}	 
		public function action_allcountry() {
			$view = new View();
			$view->render('profile/action_allcountry');
		}   
		public function action_countries() {
			$view = new View();
			$view->render('profile/action_countries');
		}
		public function action_states() {
			$view = new View();
			$view->render('profile/action_states');
		}
		public function action_comment() {
			$view = new View();
			$view->render('profile/action_comment');			
		}
		public function action_addcomment() {
			$view = new View();
			$view->render('profile/action_addcomment');			
		}
	}
?>