<?php

require_once '../Interfaces/UserInterface.php';
require_once '../../Database/Db.php';

class UserLogin implements UserInterface {

    public function execute($data) {
        $Db = new Database();
        
        $userName = $Db->connect()->real_escape_string($data->nombreUsuario);

        $Sql = "SELECT * FROM usuarios 
                where nombreUsuario = '".$userName."' AND 
                password = '".md5($data->password)."'";
        
        $result = $Db->connect()->query($Sql);
        $numRows = $result->num_rows;

        if($numRows == 1)
        {
            session_start();
            $_SESSION['usuarioWorkanda'] = $data->nombreUsuario;
            return true;
        }
        
        return  false;   

    }

}