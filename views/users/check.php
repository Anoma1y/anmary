<?php
    $params = include('config.php');
    mysql_connect($params['host'], $params['user'], $params['password']);
    mysql_select_db($params['dbname']);
    if (isset($_COOKIE['user_id']) and isset($_COOKIE['hash'])) {   
        $query = mysql_query("SELECT *,INET_NTOA(user_ip) FROM users WHERE user_id = '".intval($_COOKIE['user_id'])."' LIMIT 1");
        $userdata = mysql_fetch_assoc($query);
        if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['user_id']) or (($userdata['user_ip'] !== $_SERVER['REMOTE_ADDR'])  and ($userdata['user_ip'] !== "0"))) {
            //Обнуление куков
            setcookie("user_id", "", time() - 3600*24*30*12, "/");
            setcookie("hash", "", time() - 3600*24*30*12, "/");
            print "Все еще ошибка";
        }
        else {
            print "Добрый день , ".$userdata['user_login'];
        }
    }
    else {
        print "Включите куки";
    }
