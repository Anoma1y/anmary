<?php

    if (empty(!$_POST)) {
        $params = include('engine/config.php');
        require_once 'engine/functions.php';
        mysql_connect($params['host'], $params['user'], $params['password']);
        mysql_select_db($params['dbname']);
            if ($_POST['username'] !== '') {
                setcookie("username_id", $data['id'], time()-60*60*24*30, '/', $params['domain']);
                setcookie("username_hash", $hash, time()-60*60*24*30, '/', $params['domain']);
                $query = mysql_query("SELECT id, username, password, status FROM users WHERE username='".mysql_real_escape_string($_POST['username'])."' LIMIT 1");
                $data = mysql_fetch_assoc($query);
                $password = $_POST['password'];
                $username = $_POST['username'];
                if (($username == $data['username']) and ($data['password'] == md5(md5($password)))) {
                    if ($data['status'] == 1) {
                        $hash = md5(generateCode(10));
                        mysql_query("UPDATE users SET last_login = NOW(), hash='".$hash."', last_login = NOW() WHERE id='".$data['id']."'");
                        setcookie("username_id", $data['id'], time()+60*60*24*30, '/', $params['domain']);
                        setcookie("username_hash", $hash, time()+60*60*24*30, '/', $params['domain']);
                        session_start();
                        $_SESSION['username'] = $username;
                        echo "Ok";
                    } else {
                        echo "Учетная запись не подтверждена";
                    }
                 }  
                 else {
                    echo "Неверный пароль";
                 }  
            }
            else {
                echo "Введите логин";
            }
        die();
    }
    else {
        header('Location: /');
    }
