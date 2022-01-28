<?php


require_once '../Clases/UserRead.php';
require_once '../Clases/UserDelete.php';
require_once '../Clases/UserCreate.php';
require_once '../Clases/UserUpdate.php';
require_once '../Clases/UserLogin.php';

class UserFactory {

    const CREATE = "CREATE";
    const READ   = "READ";
    const UPDATE = "UPDATE";
    const DELETE = "DELETE";
    const LOGIN  = "LOGIN";


    private $type ;     

    public function __construct( $type ){
        $this->type = $type;
    }

    public function resolveClass(){

        switch($this->type){

            case self::READ :
                return new UserRead();
                break;
            
            case self::DELETE :
                return new UserDelete();
                break;
            
            case self::CREATE :
                return new UserCreate();
                break;

            case self::UPDATE :
                return new UserUpdate();
                break;

            case self::LOGIN :
                return new UserLogin();
                break;
            
            default :
                return false;
                break;
        }
    }
}