<?php
	/**
	 * Абстрактный класс AdminBase содержит общую логику для контроллеров, которые 
	 * используются в панели администратора
	 */
	abstract class UserAdmin
	{

	    /**
	     * Метод, который проверяет пользователя на то, является ли он администратором
	     * @return boolean
	     */
	    public static function checkAdmin()
	    {
	        // Проверяем авторизирован ли пользователь. Если нет, он будет переадресован
	        // Получаем информацию о текущем пользователе
	        $check = User::checkPermisions($_COOKIE["user_hash"]);
	        // // Если роль текущего пользователя "admin", пускаем его в админпанель
	        if ($check['permissions'] == '{"admin": 1}') {
	            return true;
	        }
	        // Иначе завершаем работу с сообщением об закрытом доступе
	        die('Access denied');
	    }
	}

	class Admin extends UserAdmin{
	    /**
	     * Вывод главной страницы админ-панели
	     * @return boolean
	     */
	    public function indexView() {
	        // Проверка доступа
	        self::checkAdmin();
	    	require_once 'engine/functions.php';
			require_once('views/admin/index.php');
		    return true;	    		
	    }
	    /**
	     * Вывод страницы добавления товара
	     * @return boolean
	     */
	    public function add() {
	        // Проверка доступа
	        self::checkAdmin();
	    	$brandList = Admins::getBrand();
	    	$categoryList = Admins::getCategory();
	    	$seasonList = Admins::getSeason();
	    	$colorList = Admins::getColor();
			require_once('views/admin/add.php');
		    return true;  		
	    }
	    /**
	     * Метод, вызывающий удаление товара
	     * @return boolean
	     */
	    public function delete() {
	        // Проверка доступа
	        self::checkAdmin();
			require_once('views/admin/delete.php');
		    return true;  	
        }
	    /**
	     * Вывод страницы редактирования товара
	     * @return boolean
	     */
	    public function edit() {
	        // Проверка доступа
	        self::checkAdmin();
	    	$brandList = Admins::getBrand();
	    	$categoryList = Admins::getCategory();
	    	$seasonList = Admins::getSeason();
	    	$colorList = Admins::getColor();
	    	$productData = ProductModel::editProductById();
			require_once('views/admin/edit.php');
		    return true;  		
	    }
	    /**
	     * Метод вызова метода добавления товара
	     * @return boolean
	     */
	    public function addProduct() {
	        // Проверка доступа
	        self::checkAdmin();
	    	$view = new View();
			$view->render('admin/add_product');    		
	    }
	    /**
	     * Метод вызова метода редактирования товара
	     * @return boolean
	     */
	    public function editProduct() {
	        // Проверка доступа
	        self::checkAdmin();
	    	$view = new View();
			$view->render('admin/edit_product');    		
	    }
	    /**
	     * Метод вызова метода получения списка всех товаров
	     * @return boolean
	     */
	    public function getAllProducts() {
	        // Проверка доступа
	        self::checkAdmin();
	    	$view = new View();
			$view->render('admin/getAllProducts_action');    		
	    }
	    /**
	     * Вывод страницы заказов
	     * @return boolean
	     */
	    public function order() {
	        // Проверка доступа
	        self::checkAdmin();
	        $order = Admins::getOrder();
	        
	        $orderDecode = [];
	        foreach ($order as $key) {
	        	array_push($orderDecode, json_decode($key["product"], true));
	        }
	        $id = [];
	        $size = [];
	        foreach ($orderDecode as $key) {
	        	array_push($id, array_keys($key));
	        }
	        $productOrder = [];
	        foreach ($id as $key) {
	        	array_push($productOrder, Admins::getProductForSpecificID(implode(", ", $key)));
	        }
	        	// echo "<pre>";
		        // 	var_dump($orderDecode);
		        // echo "</pre>";
			require_once('views/admin/order.php');
		    return true;  		
	    }
	    public function getOrder() {
    		Admins::getOrder();
    		return true;
	    }
	    // public function getProductOrder() {
	    //     if (!empty($_POST)) {
		   //      $id = $_POST["id"];
		   //  	Admins::getProductForSpecificID($id);
		   //  	return true;
		   //  }
	    // }
	}