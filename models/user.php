<?php
	require_once "engine/Session.php";
	require_once "engine/Cookie.php";
	require_once "engine/functions.php";
	require_once "engine/Db.php";

	class User
	{
	    /**
	     * Возвращает пользователя с указанным id
	     * @param integer id id пользователя
	     * @return array массив с информацией о пользователе
	     */
	    public static function getUserById($id) {
	        $db = Db::getConnection();
	        $sql = 'SELECT * FROM users WHERE id = :id';
	        $result = $db->prepare($sql);
	        $result->bindParam(':id', $id, PDO::PARAM_INT);
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	        $result->execute();
	        return $result->fetch();
	    }
	    /**
	     * Метод проверки прав пользователя
	     * @param string $hash уникальный хэш
	     * @return array $result возвращает массив данных о пользователе с указанным хеш кодом
	     */
	    public static function checkPermisions($hash) {
	    	$db = Db::getConnection();
	        $sql = "SELECT role.*  FROM users, role WHERE users.hash = :hash AND users.role = role.id AND users.role = 1 LIMIT 1";
	        $result = $db->prepare($sql);
	        $result->bindParam(':hash', $hash, PDO::PARAM_STR);
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	        $result->execute();
	       	$result = $result->fetch();
	       	return $result;
	    }
	    /**
	     * Метод проверки данных пользователя 
	     * @param string логин
	     * @param  string пароль
	     * @return array возвращает все данные о пользователе
	     */
	    public static function getLoginUser($email, $password) {
	    	$db = Db::getConnection();
	        $sql = "SELECT * FROM users WHERE email = :email AND password = :password LIMIT 1";
	        $query = $db->prepare($sql);
	        $query->bindValue(':email', $email);
	        $query->bindValue(':password', $password);
	        $query->execute();
	        $result = $query->fetch(PDO::FETCH_OBJ);
	        return $result;
	    }
	    /**
	     * Метод входа пользователя в систему
	     * @param array $data POST запрос, передающий почту и пароль
	     * @return boolean вызывает метод getLoginUser для проверки совпадения логина и пароля
	     * 		   если пароль и логин верный, обновляет базу данных пользователя, добавляю время
	     * 		   входа и генерируя хэш (функцией generateCode) из 10 знаков. Добавляет информацию
	     * 		   в сессии и куки.
	     */
		public function userLogin($data) {
	        $email = $_POST['email'];
	        $password = md5(md5($_POST['password']));
	        if (strlen($email) != 0 && strlen(password) != 0) {
		        $result = User::getLoginUser($email, $password);
		        if ($result != false) {
		        	$db = Db::getConnection();
		        	$sql = "UPDATE users SET last_login = NOW(), hash = :hash WHERE email = :email";
		        	$query = $db->prepare($sql);
		        	if (!$query) {
		        		die(json_encode("Ошибка"));
		        	}
		        	//Генерация хэша из 15 символов
		        	$hash = md5(generateCode(15));
		        	$query->bindParam(':email', $email, PDO::PARAM_STR);
					$query->bindParam(':hash', $hash, PDO::PARAM_STR);
					if ($query->execute()) {
						try {
							Cookie::set("user_hash", $hash); 
							Cookie::set("user_email", $email);
							Cookie::set("user_id", $result->id);
							Cookie::set("user_username", $result->username);
				            Session::init();
				            Session::set("login", true);
				            Session::set("id", $result->id);
				            Session::set("hash", $hash);
				            Session::set("email", $result->email);
				            Session::set("username", $result->username);
				            Session::set("login_msg", "Вы вошли в систему!");
			            	die(json_encode(true));	
						} catch (Exception $e) {
							die(json_encode('Ошибка'));
						}
					} else {
						die(json_encode('Ошибка'));
					}
		        } else {
		        	die(json_encode('Неверный логин или пароль'));
		        }	        	
	        }
		}
	    /**
	     * Метод регистрации пользователя
	     * @param array $data POST запрос, передающий почту и пароль
	     * @return boolean если почта используется, отклонить, если почта уникальная - добавить запись в БД
	     */
	    public function userRegistration($data) {	
	    	$db = Db::getConnection();
	    	if (!empty($data)) {
		        $username = $data['username'];
		        $email = $data['email'];
		        $password = $data['password'];
		        //Проверка почты на уже имеющиеся
		        $chk_email = User::emailCheck($email);
		        if ($chk_email) {
		        	die(json_encode("E-Mail уже используется"));
		        }
		    	Session::destroy();
		    	Cookie::destroy();
		        $password = md5(md5($data['password']));
		        //По умолчанию 2 это обычный пользователь, 1 - админ
		        $sql = "INSERT INTO users (username, email, password, joined, role) VALUES (:username, :email, :password, now(), 2)";
		        $query = $db->prepare($sql);
		        $query->bindValue(':username', $username);
		        $query->bindValue(':email', $email);
		        $query->bindValue(':password', $password);
		        $result = $query->execute();
		        if ($result) {
		       		die(json_encode(true));
		       	} else {
		       		die(json_encode("Ошибка регистрации"));
		       	}
	    	}
	    }
	    /**
	     * Проверка на уникальность почты
	     * @param string $email Почта
	     * @return boolean вызов true если почта уникальная, false если почта уже используется
	     */
	    public static function emailCheck($email) {
	        // Соединение с БД        
	        $db = Db::getConnection();

	        // Текст запроса к БД
	        $sql = 'SELECT COUNT(*) FROM users WHERE email = :email';

	        // Получение результатов. Используется подготовленный запрос
	        $result = $db->prepare($sql);
	        $result->bindParam(':email', $email, PDO::PARAM_STR);
	        $result->execute();

	        if ($result->fetchColumn()) {
	            return true;
	        }
	        return false;
	    }
	    /**
	     * Возвращает идентификатор пользователя, если он авторизирован
	     * Иначе перенаправляет на страницу входа
	     * @return string <p>Идентификатор пользователя</p>
	     */
	    public static function checkLogged() {
	        // Если куки есть, вернем идентификатор пользователя
	        if (isset($_COOKIE['user_id'])) {
	            return $_COOKIE['user_id'];
	        }
	        // header("Location: /user/login");
	    }
	    /**
	     * Проверяет является ли пользователь гостем
	     * @return boolean результат выполнения метода
	     */
	    public static function isGuest()
	    {
	        if (isset($_SESSION['user_username'])) {
	            return false;
	        }
	        return true;
	    }
	    /**
	     * Метод удаления всех сессий и куков пользователя на сайте
	     * @return header
	     */
	    public function logoutUser() {
	    	// Удаление сессий
	    	Session::destroy();
	    	// Удаление куков
	    	Cookie::destroy();
        	// Перенаправляем пользователя на главную страницу
        	header("Location: /");
	    }
	}