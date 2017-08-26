<?
    if (empty(!$_POST)) {
        if (isset($_POST['option'])) {
            $countr = $_POST['option'];
            $db = Db::getConnection();
            $sql = "SELECT states.* FROM states, countries WHERE states.country_id = countries.id and countries.id = :countr";
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
        } 
        else if (isset($_POST['getOption'])){
            $countr = $_POST['getOption'];
            $db = Db::getConnection();
            $sql = "SELECT states.* FROM states, countries WHERE states.country_id = countries.id and countries.id = :countr";
            $result = $db->prepare($sql);
            $result->bindParam(':countr', $countr, PDO::PARAM_STR);
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