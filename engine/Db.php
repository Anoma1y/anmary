<?php
	class Db{
	    public static function getConnection() {
	        try {
		        $paramsPath = 'config.php';
		        $params = include($paramsPath);
		        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
		        $db = new PDO($dsn, $params['user'], $params['password']);
		        $db->exec("set names {$params['dbcharset']}");
		        return $db;	        	
	        } catch (PDOException $e) {
	        	die("Не удалось подключиться к базе данных" . $e->getMessage());  
	        }

	    }
	}
