<?php 
/**
* Модель для административной панели
*/
class Admins
{
	public static function getAllProducts() {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM product';
        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $i = 0;
        $data = [];
        while($row = $result->fetch()) {
        	$data[$i] = $row;
            $i++;
        }
        return $data;
	}
    public static function getOrder() {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM orderShop ORDER BY status, dateOrder DESC';
        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $i = 0;
        $data = [];
        while($row = $result->fetch()) {
            $data[$i] = $row;
            $i++;
        }
        return $data;
    }
    public static function getProductForSpecificID($idStr) {
        $db = Db::getConnection();
        $sql = 'SELECT id, name, article, sale_price FROM product WHERE id in ('.$idStr.')';
        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $i = 0;
        $data = [];
        while($row = $result->fetch()) {
            $data[$i] = $row;
            $i++;
        }
        return $data;
    }
    public static function completeOrder($code) {
        $db = Db::getConnection();
        $query = "UPDATE orderShop SET dateCompleteOrder = NOW(), status = 1 WHERE code = :code";
        $result_update = $db->prepare($query);
        $result_update->bindParam(':code', $code, PDO::PARAM_INT);
        $result_update->setFetchMode(PDO::FETCH_ASSOC);
        if ($result_update->execute()) {
            die(true);
        } else {
            die(false);
        }
    }
    public static function getBrand() {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM brand';
        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $i = 0;
        $all = array();
        while ($row = $result->fetch()) {
            $all[$i] = $row;
            $i++;
        }
        return $all;            
    }
    public static function getCategory() {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM category';
        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $i = 0;
        $all = array();
        while ($row = $result->fetch()) {
            $all[$i] = $row;
            $i++;
        }
        return $all;            
    }
    public static function getSeason() {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM season';
        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $i = 0;
        $all = array();
        while ($row = $result->fetch()) {
            $all[$i] = $row;
            $i++;
        }
        return $all;            
    }
    public static function getColor() {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM color';
        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $i = 0;
        $all = array();
        while ($row = $result->fetch()) {
            $all[$i] = $row;
            $i++;
        }
        return $all;            
    }
    public static function getNews() {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM news ORDER BY id DESC';
        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $i = 0;
        $all = array();
        while ($row = $result->fetch()) {
            $all[$i] = $row;
            $i++;
        }
        return $all;  
    }
    public static function addNews() {
        
    }
}

?>