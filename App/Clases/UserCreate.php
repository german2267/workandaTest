<?php

require_once '../Interfaces/UserInterface.php';
require_once '../../Database/Db.php';

class UserCreate implements UserInterface {

    public function execute($data) {
        $Db = new Database();
        
        $Sql = "INSERT INTO `usuarios`(`nombreUsuario`, `password`, `direccion`) 
        VALUES ('".$data->nombreUsuario."', 
                '".md5($data->password)."',
                '".$data->direccion."')";

        $result = $Db->connect();
        $result->query($Sql);
        
        if ($result->error != "")
        {
            return false;
        }
        return true;
    }

}
