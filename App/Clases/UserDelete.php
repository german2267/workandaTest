<?php

require_once '../Interfaces/UserInterface.php';
require_once '../../Database/Db.php';


class UserDelete implements UserInterface {

    public function execute($data) {
        $Db = new Database();

        $Sql = "DELETE from usuarios where id = '".$data->id."'";
       
        $result = $Db->connect()->query($Sql);
        
        return true;
    }

}
