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
				$id = implode(", ", $keys);
				$db = Db::getConnection();
				$sql = 'SELECT product.id, product.name, product.article, product.composition, product.image, product.is_sale, product.price, product.sale_price, product.is_availability, brand.brand_name, category.category_name FROM product, brand, category WHERE product.id in ('.$id.') AND product.brand_id = brand.id AND product.category_id = category.id';
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
	        $cart_items = [];
	        Session::init();
	        // если в корзине уже есть товары (они хранятся в сессии), добавить их в массив
	        
	        if (isset($_SESSION['products'])) {
	            $cart_items = $_SESSION['products'];
	        }
			// Проверка на наличия товара в корзине
			// Если товара нет в корзине, то создается новый массив "size" для ID товара
			// Затем добавляется размер в массив
			// Иначе происходит проверка на наличии переданного размера в массиве "size"
			// Если вернет false - то происходит добавление нового размера для ID товара
	        if (!array_key_exists($id, $cart_items)) {
	        	$cart_items[$id]["size"] = [];
	        	array_push($cart_items[$id]["size"], $size);
	        } else {
        		if (!in_array($size, $cart_items[$id]["size"])) {
        			array_push($cart_items[$id]["size"], $size);
        		}
	        }
	        // Записывает массив с товарами в сессию
	        Session::set('products', $cart_items);
	        return true;
	    }
	    /**
	     * Удаляет товар с указанным id из корзины
	     * @param int $id товара
	    */
	    public static function deleteProduct($id, $size) {
	    	$id = intval($id);
	        $productsInCart = self::getProducts();
	        //Проверка: если количество размеров у товара с ID = $id больше 1
	        //то создается новый массив, в него добавляются все элементы которые не равны $size
	        //и он заменяется массив в сессии
	        //Иначе происходит удаление ID продукта из сессии
	        if (count($productsInCart[$id]["size"]) > 1) {
	        	$newArr = [];
	        	foreach ($productsInCart[$id]["size"] as $key) {
	        		if ($key != $size) {
	        			array_push($newArr, $key);
	        		}
	        	}
	        	$_SESSION['products'][$id]["size"] = $newArr;
	        } else {
	        	unset($productsInCart[$id]);
	        	$_SESSION['products'] = $productsInCart;
	        }
	    }
	    /**
	     * Подсчет количество товаров в корзине
	     * Количество товаров считается по количество добавленных размеров
	     * @return int количество товаров в корзине
	     */
	    public static function countItems() {
	        if (isset($_SESSION['products'])) {
	            $count = 0;
	            foreach ($_SESSION['products'] as $id) {
	                $count += count($id["size"]);
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
	    public static function getProducts() {
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
	    public static function getProductsByIdSize($id) {
	    	$id = intval($id);
	    	$sizeArr = [];
	    	$i = 0;
	    	Session::init();
	    	if (isset($_SESSION['products'])) {
	    		$sizeArr = $_SESSION['products'][$id]["size"];
	    		if (!empty($sizeArr)) {
		    		asort($sizeArr);
		    		return $sizeArr;
				}
				else {
	    			return [];
	    		}	 
		    }
	    	return []; 
	    }
	    /**
	     * Подсчет общей стоимость товаров
	     * Стоимость каждого товара с определенным id умножается на количество добавленных размеров
	     * @param array $products массив с информацией о товарах (список товаров)
	     * @return int общая стоимость
	     */
	    public static function getTotalPrice($products) {
	        $productsInCart = self::getProducts();
	        $total = 0;
	        if ($productsInCart) {
	            foreach ($products as $i => $item) {

	                $total += $item['sale_price'] * count($productsInCart[$item["id"]]["size"]);
	            }
	        }
	        return $total;
	    }

	    public static function addOrder($data) {
	    	die(json_encode($data));
	    }
	}