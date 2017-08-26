<?
    if (empty(!$_POST)) {
        if (isset($_POST['option'])) {
            $state = $_POST['option'];
            $db = Db::getConnection();
            $sql = "SELECT cities.name, cities.id FROM states, cities WHERE cities.state_id = states.id and states.id = :state";
            $result = $db->prepare($sql);
            $result->bindParam(':state', $state, PDO::PARAM_STR);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();
            $i = 0;
            $data = array();
            while ($row = $result->fetch()) {
                $data[$i]['id'] = $row['id'];
                $data[$i]['name'] = $row['name'];
                $i++;
            }
            die(json_encode($data));
        } 
    }
?>