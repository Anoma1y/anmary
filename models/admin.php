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
}

?>