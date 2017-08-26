<?php
	class Anime {
	    public function indexView()
	    {
	    	$anime = AnimeModel::getAnime();
	    	$genre = AnimeModel::getGenre();
			$data['title'] = 'Hello';
			if (!empty($anime) and !empty($genre)) {
		        require_once('views/anime/index.php');
		        return true;				
			} else {
				require_once "views/errors/404.php";
			}

	    }
	}
?>