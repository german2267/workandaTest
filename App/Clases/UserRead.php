<?php

require_once '../Interfaces/UserInterface.php';
require_once '../../Database/Db.php';

class UserRead implements UserInterface {

    public function execute($data = null) {
        $Db = new Database();
        
        $Sql = "SELECT * FROM usuarios";
        
        $result = $Db->connect()->query($Sql);
        
        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $rows[] = $row;
        }

        return $rows;
    }

}
