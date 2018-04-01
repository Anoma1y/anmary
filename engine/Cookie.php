<?php 
	$params = include("engine/config.php");
	class Cookie {
	    public static function set($key, $val) {
			setcookie($key, $val, time()+60*60*24*30, '/', $params['domain']);
	    }
	    public static function get($key) {
	        if (isset($_COOKIE[$key])) {
	            return $_COOKIE[$key];
	        } else {
	            return false;
	        }
	    }
	    public static function destroy() {
		    setcookie('user_hash', null, -1, '/', $params['domain']);
		    setcookie('user_email', null, -1, '/', $params['domain']);
		    setcookie('user_id', null, -1, '/', $params['domain']);
		    setcookie('user_username', null, -1, '/', $params['domain']);
		    return true;
	    }
	}