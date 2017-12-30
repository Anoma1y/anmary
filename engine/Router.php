<?php
/**
 *
 * Класс Route - роутинг
 *
 */

class Route 
{
	static function start() {
		$routes = Route::getURI();

		$class_name = "Main";
		$method_name = "index";

		if (!empty($routes[1])) {
			$class_name = $routes[1];
		}

		if (!empty($routes[2])) {
			$method_name = $routes[2];
		}
		$file_name = "controllers/Controller".$class_name.".php";
		try {
			/* Если 4 и более уровней URL - вызывает ошибку */
			if ($routes[1] != "admin") {
				if (count($routes) >= 4) {
					Route::ErrorPage404();
					die();
				}				
			}
			/* Проверка на пустой URL и если имеется знак "/" - обработать и удалить его */
			if (($routes[2] !== "") and ($routes[3] !== "") and ($routes[4] !== "") and ($routes[5] !== "")) {
				if (file_exists($file_name)) {
					require_once $file_name;
				}
				else {
					throw new Exception('File not found: '.$file_name);
				}
				$class = ucfirst($class_name);
				if (class_exists($class)) {
					$controller = new $class();
				}
				elseif ($controller == 'product') {
					$controller = new $class;
				}
				else {
					throw new Exception('Class not found: '.$class);
				}
				if (method_exists($controller, $method_name)) {
					$controller->$method_name();
				}
				else if (class_exists($class)) {
					$controller->indexView();
				}
				else {
					throw new Exception('Method not found: '.$method_name);
				}
			}
			else {
				$uri = preg_replace("#/$#", "", $_SERVER['REQUEST_URI']); 
				header("Location: $uri"); 
			}
		} 
		catch (Exception $e) {
			if (file_exists('debug')) {
				Route::ErrorPage404();
			}else {	
				echo $e->getMessage();
			}
		}
	}
	
	static function  ErrorPage404()	{
		require_once "views/errors/404.php";
    }

   	static function  getURI() {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return explode('/', $_SERVER['REQUEST_URI']);
        }
	}
}