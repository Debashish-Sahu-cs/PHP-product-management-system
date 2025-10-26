<?php
include 'adminconnection.php';
session_start();
$email = $_POST['email'];
$password = $_POST['password'];

if(!(isset($email) && isset($password))){
    echo "NOT A VALID LOGIN!";
}else{
    $login = new Admin();
    $login->connection();
    $admins = $login->checkAdmin($email, $password);
    if($admins){
        echo "<script> window.location.href='chooseAction.php' </script>";
    }
}

?>