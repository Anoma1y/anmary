<?php
	require_once "engine/Session.php";
	require_once "engine/Cookie.php";
	require_once "engine/Cart.php";
    $params = include('engine/config.php');
	class Cart {
		public function indexView(){
			$cartItems = UserCart::getCartItems();
			if (!empty($cartItems)) {
				foreach ($cartItems as $key => $value) {
					$cartItems[$key]["size"] = $_SESSION['products'][$value['id']];;
				}				
			}
			$countItems = UserCart::countItems();
			$totalPrice = UserCart::getTotalPrice($cartItems);
	        require_once('views/cart/index.php');
	        return true;
		}
	    /**
	     * Добавления товара в корзину
	    */
	    public function addProduct() {
	        // Добавляем товар в корзину и печатаем результат: количество товаров в корзине
	        if (!empty($_POST)) {
		        $id = $_POST["id"];
		        $size = $_POST["size"];		      
		        UserCart::addProduct($id, $size);
	        	return true;	
	        }
	        return false;
	    }
	    /**
	     * Удаление товара с корзины
	     * @return bool - true если ок, false если не ок
	     */
	    public function deleteProductInCart() {
	        if (!empty($_POST)) {
		        $id = $_POST["id"];
		        $size = $_POST["size"];		      
		        UserCart::deleteProduct($id, $size);
		        header("Location: /cart");
	        	return true;	
	        }
	        return false;
	    }
	    /**
	     * Удаление товара из каталога
	     * @return bool
	     */
	    public function deleteProductInCatalog() {
	        // UserCart::deleteProduct($id);
	    }  
	}
