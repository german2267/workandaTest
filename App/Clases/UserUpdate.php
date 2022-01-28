<?php

require_once '../Interfaces/UserInterface.php';
require_once '../../Database/Db.php';

class UserUpdate implements UserInterface {

    public function execute($data) {
        $Db = new Database();

        if($data->password != "")
        {
            $pass =  '`password` = "'.md5($data->password).'",';
        }else
        {
            $pass = "";
        }
        
        $Sql = "UPDATE `usuarios` SET 
               `nombreUsuario`= '".$data->nombreUsuario."',
                ".$pass."
               `direccion`    = '".$data->direccion."' 
                WHERE id      = '".$data->id."'";

        $result = $Db->connect();
        $result->query($Sql);
        
        if ($result->error != "")
        {
            return false;
        }
        return true;
    }

}
