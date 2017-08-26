<?php
	class AnimeModel {
	    public static function getGenre() {
	    	$db = Db::getConnection();
	    	$sql = 'SELECT * FROM anime_genre';
	    	$result = $db->prepare($sql);
	    	$result->setFetchMode(PDO::FETCH_ASSOC);
	    	$result->execute();
	        $i = 0;
	        $genre = array();
	        while ($row = $result->fetch()) {
	            $genre[$i]['id'] = $row['id'];
	            $genre[$i]['name'] = $row['name'];
	            $i++;
	        }
	        return $genre;

		}
	    public static function getAnime() {
			$routes = explode('/', $_SERVER['REQUEST_URI']);
			$urls = explode('&', $routes[2]);
			var_dump($urls);
			$db = Db::getConnection();
 	        $sql = 'SELECT * FROM anime WHERE id = :id and url = :url';
	        $result = $db->prepare($sql);
	        $result->bindParam(':url', $urls[1], PDO::PARAM_STR);
	        $result->bindParam(':id', $urls[0], PDO::PARAM_INT);
	        $result->setFetchMode(PDO::FETCH_ASSOC);
	        $result->execute();
	        $res = $result->fetch();
			if (!empty($res)) {
				return $res;
			} else {
				require_once "views/errors/404.php";
			}
		}	
	}
?>