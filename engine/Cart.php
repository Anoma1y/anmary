<?php
	require_once 'Session.php';
	require_once 'Db.php';
	/**
	 * Класс Cart - корзина
	 */
	class UserCart {
		/**
		 * Получение списка товаров в корзине (сессии)
		 * @return bool (false) or arr массив, содержащий список товаров которые хранятся в корзине (сессии)
		 */
		public static function getCartItems() {
			Session::init();
	        if (isset($_SESSION['products'])) {
				$keys = array_keys($_SESSION['products']);
				$str = implode(", ", $keys);
				$db = Db::getConnection();
				$sql = 'SELECT product.id, product.name, product.article, product.image, product.is_sale, product.price, product.sale_price, product.is_availability, brand.brand_name, category.category_name FROM product, brand, category WHERE product.id in ('.$str.') AND product.brand_id = brand.id AND product.category_id = category.id';
				$result = $db->prepare($sql);
				$result->setFetchMode(PDO::FETCH_ASSOC);
				$result->execute();
				$i = 1;
				$all = array();
				while ($row = $result->fetch()) {
					$all[$i] = $row;
					$i++;
				}
				return $all;	
	        }
	        return false;
		}
		/**
		* Добавление товара в корзину (сессию)
		* @param int $id товара
		* @return bool true
		*/
	    public static function addProduct($id, $size) {
	        $id = intval($id);
	        $cart_items = array();
	        Session::init();
	        // если в корзине уже есть товары (они хранятся в сессии), добавить их в массив
	        if (isset($_SESSION['products'])) {
	            $cart_items = $_SESSION['products'];
	        }
	        // Проверка на наличия товара в корзине 
	        if (!array_key_exists($id, $cart_items)) {
	           $cart_items[$id] = $size;
	        }
	        // Записывает массив с товарами в сессию
	        Session::set('products', $cart_items);
	        return true;
	    }
	    /**
	     * Подсчет количество товаров в корзине
	     * @return int количество товаров в корзине
	     */
	    public static function countItems()
	    {
	        if (isset($_SESSION['products'])) {
	            $count = 0;
	            foreach ($_SESSION['products'] as $id => $quantity) {
	                $count += 1;
	            }
	            return $count;
	        } else {
	            return 0;
	        }
	    }

	    /**
	    * Возвращает массив с идентификаторами и количеством товаров в корзине
	    * Если товаров нет, возвращает false;
	    * @return mixed: bool or arr
	    */
	    public static function getProducts()
	    {
	    	Session::init();
	        if (isset($_SESSION['products'])) {
	            return $_SESSION['products'];
	        }
	        return false;
	    }

	    public static function getProductsById($id) {
	    	$id = intval($id);
	    	Session::init();
	    	if (isset($_SESSION['products'])) {
		    	if (array_key_exists($id, Session::get('products'))) {
		    		return true;
		    	}
		    }
	    	return false; 
	    }
	    /**
	     * Получает общую стоимость товаров
	     * @param array $products массив с информацией о товарах (список товаров)
	     * @return int общая стоимость
	     */
	    public static function getTotalPrice($products)
	    {
	        $productsInCart = self::getProducts();
	        $total = 0;
	        if ($productsInCart) {
	            foreach ($products as $item) {
	                $total += $item['price'];
	            }
	        }
	        return $total;
	    }

	    /**
	     * Удаляет товар с указанным id из корзины
	     * @param int $id товара
	    */
	    public static function deleteProduct($id)
	    {
	        $productsInCart = self::getProducts();
	        $id = intval($id);
	        unset($productsInCart[$id]);
	        $_SESSION['products'] = $productsInCart;
	    }

	}