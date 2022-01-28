<?php   

session_start();

if(isset($_SESSION['usuarioWorkanda'])){
    header('Location: dashboard.php');
}else
{
    header('Location: login.php');
}