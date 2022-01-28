<?php

require_once '../Factory/UserFactory.php';

$json = file_get_contents('php://input');
$vars = json_decode($json);

$type = $vars->type;
$data = $vars->data;


$factory = new UserFactory($type);
$user = $factory->resolveClass();


if($user){
    echo json_encode($user->execute($data));
}else
{
    echo json_encode (false);
}





