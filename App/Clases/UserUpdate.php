<?php

require_once '../Interfaces/UserInterface.php';
require_once '../../Database/Db.php';

class UserUpdate implements UserInterface {

    public function execute($data) {
        $Db = new Database();
        
        $Sql = "UPDATE `usuarios` SET 
               `nombreUsuario`= '".$data->nombreUsuario."',
               `password`     = '".md5($data->password)."', 
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
