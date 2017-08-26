<?php 
    $countr = $_POST['option'];
    $db = Db::getConnection();
    $sql = "SELECT countries.* FROM countries";
    $result = $db->prepare($sql);
    $result->bindParam(':countr', $countr, PDO::PARAM_STR);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();
    $i = 0;
    $data = array();
    while ($row = $result->fetch()) {
        $data[$i]['name'] = $row['name'];
        $data[$i]['id'] = $row['id'];
        $i++;
    }
    die(json_encode($data));


?>