<?php 
	require_once 'engine/Db.php';
	/**
	 * Класс Subscribe для добавления E-Mail посетителей сайта и подписка на новости
	 */
	class Subscribe {
		/**
		 * [insert Добавление E-Mail посетителя в БД]
		 * @param  [String] $email [E-Mail]
		 * @return [Boolean or String JSON]        [true - если запрос удачный или ошибку если нет]
		 */
		public static function insert($email) {
			$db = Db::getConnection();
	        $sql = "INSERT INTO subscribe (subscribe_email, subscribe_date) VALUES (:email, now())";
	        $query = $db->prepare($sql);
	        $query->bindValue(':email', $email);
	        $result = $query->execute();
	        if ($result) {
	       		die(json_encode(true));
	       	} else {
	       		die(json_encode("Ошибка"));
	       	}
		}
	}