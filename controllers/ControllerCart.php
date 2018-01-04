<?php
	require_once "engine/Session.php";
	require_once "engine/Cookie.php";
	require_once "engine/Cart.php";
    $params = include('engine/config.php');
	class Cart {
		public function indexView(){
			$cartItems = UserCart::getCartItems();
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
		        UserCart::addProduct($id);
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
		        UserCart::deleteProduct($id);
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
