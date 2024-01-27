<?php
session_start();
if(!empty($_SESSION['user_id'])){
    unset($_SESSION['user_id']);
    setcookie('token','', time()-1000,'/');
}
header('location: ../index.php');
die();
?>