<?php
	/**
	*Profile Models 
	*/
	require_once "/engine/db.php";
	class Profiles {
	    public static function getUsers() {
			$routes = explode('/', $_SERVER['REQUEST_URI']);
			$username = $routes[2];
			$db = Db::getConnection();
 	        $sql = 'SELECT * FROM users WHERE username = :username and status = 1';
	        $result = $db->prepare($sql);
	        $result->bindParam(':username', $username, PDO::PARAM_STR);
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	        $result->execute();
	       	$result = $result->fetch();
			return $result;
		}
	    public static function getRussianGender($gender)
	    {
	        switch ($gender) {
	            case 'Male':
	                return 'Мужской';
	                break;
	            case 'Female':
	                return 'Женский';
	                break;
	        }
	    }
		public static function getUserProfile() {
			$routes = explode('/', $_SERVER['REQUEST_URI']);
			$username = $routes[2];
			$db = Db::getConnection();
 	        $sql = "SELECT users.username, user_profile.*, countries.name as CountryName, states.name as StateName, cities.name as CityName
					FROM users, user_profile, countries, states, cities
					WHERE user_profile.user_id = users.id and 
						  user_profile.country_id = countries.id and 
						  states.id = user_profile.states_id and 
						  cities.id = user_profile.city_id and 
						  users.username = :username";
	        $result = $db->prepare($sql);
	        $result->bindParam(':username', $username, PDO::PARAM_STR);
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	        $result->execute();
	       	$result = $result->fetch();
			return $result;			
		}
		public static function checkOnline() {
			$routes = explode('/', $_SERVER['REQUEST_URI']);
			$username = $routes[2];
			$db = Db::getConnection();
 	        $sql = 'SELECT * FROM online_users WHERE username = :username';
	        $result = $db->prepare($sql);
	        $result->bindParam(':username', $username, PDO::PARAM_STR);
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	        $result->execute();
	       	$result = $result->fetch();
			return $result;			
		}
		public static function checkUser() {
			$routes = explode('/', $_SERVER['REQUEST_URI']);
			$username = $routes[2];
			$hash = $_COOKIE['username_hash'];
			$db = Db::getConnection();
 	        $sql = 'SELECT * FROM users WHERE hash = :hash';
	        $result = $db->prepare($sql);
	        $result->bindParam(':hash', $hash, PDO::PARAM_STR);
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	        $result->execute();
	       	$result = $result->fetch();
			return $result;
		}
		public static function getAnimeProgress($status) {
			$routes = explode('/', $_SERVER['REQUEST_URI']);
			$username = $routes[2];
			$db = Db::getConnection();
			$sql = "SELECT COUNT(user_id) as count_complete from users, anime_progress, status_progress WHERE users.username = '$username' and status_progress.id = anime_progress.status_id and status_progress.id = $status";
 			$result = $db->prepare($sql);
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	        $result->execute();
	       	$result = $result->fetch();
			return $result;		
		}
		public static function getTotalAnimeProgress() {
			$routes = explode('/', $_SERVER['REQUEST_URI']);
			$username = $routes[2];
			$db = Db::getConnection();
			$sql = "SELECT COUNT(user_id) as count_complete from users, anime_progress, status_progress WHERE users.username = '$username' and status_progress.id = anime_progress.status_id";
 			$result = $db->prepare($sql);
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	        $result->execute();
	       	$result = $result->fetch();
			return $result;		
		}
		public static function getAllCount() {
			$counts = array("Complete" => self::getAnimeProgress(1), 
							"Watching" => self::getAnimeProgress(2), 
							"On-Hold" => self::getAnimeProgress(3), 
							"Dropped" => self::getAnimeProgress(4), 
							"Plan to Watch" => self::getAnimeProgress(5),
							"Total Entries" => self::getTotalAnimeProgress());
			return $counts;
		}
		/**
		 * Функции редактирования профиля
		*/	
		public static function editUser() {
	 	    $sql = 'SELECT * FROM users WHERE username = :username and status = 1';
	        $result = $db->prepare($sql);
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	        $result->execute();
	       	$result = $result->fetch();
			return $result;		
		}
		public static function getProfileEdit() {
			$username = $_COOKIE['username_hash'];
			$db = Db::getConnection();
 	        $sql = 'SELECT user_profile.* FROM user_profile INNER JOIN users ON user_profile.user_id = users.id WHERE users.hash = :username';
	        $result = $db->prepare($sql);
	        $result->bindParam(':username', $username, PDO::PARAM_STR);
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	        $result->execute();
	       	$result = $result->fetch();
			return $result;				
		}
		public static function getAllCountries() {
			$db = Db::getConnection();
 	        $sql = "SELECT * FROM countries";
	        $result = $db->prepare($sql);
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	        $result->execute();
	        $i = 0;
	        $countries = array();
	        while ($row = $result->fetch()) {
	            $countries[$i]['sortname'] = $row['sortname'];
	            $countries[$i]['name'] = $row['name'];
	            $countries[$i]['id'] = $row['id'];
	            $i++;
	        }
	        return $countries;		
		}
		public static function getAllStatesUser($id) {
			$db = Db::getConnection();
			$sql = "SELECT * FROM states WHERE country_id = :id";
			$result = $db->prepare($sql);
	        $result->bindParam(':id', $id, PDO::PARAM_INT);
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	        $result->execute();
	        $i = 0;
	        $countries = array();
	        while ($row = $result->fetch()) {
	            $countries[$i]['name'] = $row['name'];
	            $countries[$i]['id'] = $row['id'];
	            $i++;
	        }
	        return $countries;	
		}
		public static function getAllCitiesUser($id) {
			$db = Db::getConnection();
			$sql = "SELECT * FROM cities WHERE state_id = :id";
			$result = $db->prepare($sql);
	        $result->bindParam(':id', $id, PDO::PARAM_INT);
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	        $result->execute();
	        $i = 0;
	        $countries = array();
	        while ($row = $result->fetch()) {
	            $countries[$i]['name'] = $row['name'];
	            $countries[$i]['id'] = $row['id'];
	            $i++;
	        }
	        return $countries;	
		}
		public static function getCountries() {
			$hash = $_COOKIE['username_hash'];
			$db = Db::getConnection();
 	        $sql = "SELECT countries.* FROM countries, users, user_profile WHERE user_profile.user_id = users.id and users.hash = :hash and user_profile.country_id = countries.id";
	        $result = $db->prepare($sql);
	        $result->bindParam(':hash', $hash, PDO::PARAM_STR);
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	        $result->execute();
	        $result = $result->fetch();
	        return $result;		
		}
		public static function getStates() {
			$hash = $_COOKIE['username_hash'];
			$db = Db::getConnection();
 	        $sql = "SELECT states.name, states.id FROM states, users, user_profile WHERE user_profile.user_id = users.id and users.hash = :hash and user_profile.states_id = states.id";
	        $result = $db->prepare($sql);
	        $result->bindParam(':hash', $hash, PDO::PARAM_STR);
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	        $result->execute();
	        $result = $result->fetch();
	        return $result;			
		}
		public static function getCities() {
			$hash = $_COOKIE['username_hash'];

			$db = Db::getConnection();
 	        $sql = "SELECT cities.name, cities.id FROM cities, users, user_profile WHERE user_profile.user_id = users.id and users.hash = :hash and user_profile.city_id = cities.id";
	        $result = $db->prepare($sql);
	        $result->bindParam(':hash', $hash, PDO::PARAM_STR);
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	        $result->execute();
	        $result = $result->fetch();
	        return $result;			
		}
	}