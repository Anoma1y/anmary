<?php 
    if (isset($_COOKIE['username_hash'])){
        $hash = $_COOKIE['username_hash'];
        $db = Db::getConnection();
        $get_hash = 'SELECT * FROM users WHERE hash = :hash';
        $result_get_hash = $db->prepare($get_hash);
        $result_get_hash->bindParam(':hash', $hash, PDO::PARAM_STR);
        $result_get_hash->setFetchMode(PDO::FETCH_ASSOC);
        $result_get_hash->execute();
        $result_get_hash = $result_get_hash->fetch();
        $_SESSION['username'] = $result_get_hash['username'];
        $session = session_id();
        $user_name = $_SESSION["username"];
        $time = time();
        $time_check = $time-100;    
        $sql = 'SELECT * FROM online_users WHERE session = :session';
        $result = $db->prepare($sql);
        $result->bindParam(':session', $session, PDO::PARAM_STR);
        $result->execute(); 
        $count = $result->rowCount();
        if($count == 0){ 
            if (!empty($_SESSION['username'])) {
                $sql1 = 'INSERT INTO online_users(session, time, username) VALUES(:session, :time, :username)';
                $result1 = $db->prepare($sql1);
                $result1->bindParam(':session', $session, PDO::PARAM_STR);
                $result1->bindParam(':time', $time, PDO::PARAM_STR);
                $result1->bindParam(':username', $user_name, PDO::PARAM_STR);
                $result1->execute();
            } else {
                $sql1_1 = 'INSERT INTO online_users(session, time) VALUES(:session, :time)';
                $result1_1 = $db->prepare($sql1_1);
                $result1_1->bindParam(':session', $session, PDO::PARAM_STR);
                $result1_1->bindParam(':time', $time, PDO::PARAM_STR);
                $result1_1->execute();
            }
        } else {
            if (!empty($_SESSION['username'])) {
                $sql2 =  "UPDATE online_users SET time = :time, username = :username WHERE session = :session";                 
                $result2 = $db->prepare($sql2);
                $result2->bindParam(':username', $user_name, PDO::PARAM_STR);
                $result2->bindParam(':time', $time, PDO::PARAM_STR);
                $result2->bindParam(':session', $session, PDO::PARAM_STR);
                $result2->execute();
            } else {
                $sql2_1 =  "UPDATE online_users SET time = :time WHERE session = :session";                 
                $result2_1 = $db->prepare($sql2_1);
                $result2_1->bindParam(':time', $time, PDO::PARAM_STR);
                $result2_1->bindParam(':session', $session, PDO::PARAM_STR);
                $result2_1->execute();
            }
        }
                $sql_delete =  "DELETE FROM online_users WHERE time < $time_check";                 
                $result_4 = $db->prepare($sql_delete);
                $result_4->execute();
        die();
    }
    else {
        die();
    }  
 ?>

