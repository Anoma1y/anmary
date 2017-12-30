<?php
	require_once "engine/Session.php";
	require_once "engine/Cookie.php";
	require_once "engine/functions.php";
	require_once "engine/Db.php";

	class User
	{
	    public static function getCurrentUser() {
			$db = Db::getConnection();
			$hash = $_COOKIE['username_hash'];
	        $sql = 'SELECT role FROM users WHERE hash = :hash';
	        $result = $db->prepare($sql);
	        $result->bindParam(':hash', $hash, PDO::PARAM_STR);
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	        $result->execute();
	       	$result = $result->fetch();
			return $result;	
	    }
	    public static function checkAdministrator($hash) {
	    	$db = Db::getConnection();
	        $sql = "SELECT role.*  FROM users, role WHERE users.hash = :hash AND users.role = role.id AND users.role = 1 LIMIT 1";
	        $result = $db->prepare($sql);
	        $result->bindParam(':hash', $hash, PDO::PARAM_STR);
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	        $result->execute();
	       	$result = $result->fetch();
	       	if ($result["id"] == "1") {
	       		return $result;
	       	}
			return false;
	    }
	    public function getLoginUser($email, $password) {
	    	$db = Db::getConnection();
	        $sql = "SELECT * FROM users WHERE email = :email AND password = :password LIMIT 1";
	        $query = $db->prepare($sql);
	        $query->bindValue(':email', $email);
	        $query->bindValue(':password', $password);
	        $query->execute();
	        $result = $query->fetch(PDO::FETCH_OBJ);
	        return $result;
	    }
		public function userLogin($data) {
		        $email = $data['email'];
		        $password = md5(md5($data['password']));
		        //добавить проверку...
		        $result = $this->getLoginUser($email, $password);
		        if ($result) {
		        	$db = Db::getConnection();
		        	$sql = "UPDATE users SET last_login = NOW(), hash = :hash WHERE email = :email";
		        	$query = $db->prepare($sql);
		        	$hash = md5(generateCode(10));
		        	$query->bindParam(':email', $data["email"], PDO::PARAM_STR);
					$query->bindParam(':hash', $hash, PDO::PARAM_STR);
					$query->execute();
					Cookie::set("user_hash", $hash); 
					Cookie::set("user_email", $data["email"]);
		            Session::init();
		            Session::set("login", true);
		            Session::set("id", $result->id);
		            Session::set("hash", $hash);
		            Session::set("email", $result->email);
		            Session::set("username", $result->username);
		            Session::set("login_msg", "Вы вошли в систему!");
		        } else {
		        	die();
		        }
		}
	    public function userRegistration($data) {
	    	$db = Db::getConnection();
	        $username = $data['username'];
	        $email = $data['email'];
	        $password = $data['password'];
	        $chk_email = $this->emailCheck($email);
	         //добавить проверку...
	         //добавить проверку...
	         //добавить проверку...
	         //добавить проверку...
	        if ($chk_email) {
	        	return;
	        }
	        $password = md5(md5($data['password']));
	        $sql = "INSERT INTO users (username, email, password, joined, role) VALUES (:username, :email, :password, now(), 2)";
	        $query = $db->prepare($sql);
	        $query->bindValue(':username', $username);
	        $query->bindValue(':email', $email);
	        $query->bindValue(':password', $password);
	        $result = $query->execute();
	    }

	    public function emailCheck($email)
	    {
	    	$db = Db::getConnection();
	        $sql = "SELECT email FROM users WHERE email = :email";
	        $query = $db->prepare($sql);
	        $query->bindValue(':email', $email);
	        $query->execute();
	        if ($query->rowCount() > 0) {
	            return true;
	        } else {
	            return false;
	        }
	    }
	    public function logoutUser() {
	    	Session::destroy();
	    	Cookie::destroy();
	    }
	}