<?php
session_start();
include '../config/database.php';
include 'centerOfAdmin.php';
if(isset($_GET['delUser'])){
    echo "hello";
     $id = filter_var($_GET['delUser'],FILTER_SANITIZE_NUMBER_INT);
     echo "id is {$id}";
    //delete thumbnail first
    $delThumbIntoPc = new thumDELUserDel($id);
     $delThumbIntoPc->delThumb(); 
      $dUser = new userDelete($id);   
      $dUser->deleteAvatar();
      $dUser->deleteUser(); 
      $_SESSION['deleteInfo'] = "User has been deleted successfully!";
      header('location: manage-users.php'); 
}else{
    echo "not set";
}
// delete category 
if(isset($_GET['dCId'])){
    $id = filter_var($_GET['dCId'],FILTER_SANITIZE_NUMBER_INT);
    echo "love is love";
    $dCat = new catDelete($id);
    $dCat->deleteCat();
    header('location: manage-categories.php'); 
}
if(isset($_GET['post'])){
    $id = filter_var($_GET['post'],FILTER_SANITIZE_NUMBER_INT);
    echo "welcome dear" . $id;
    $dPost = new deletePost($id);
    $dPost->deleteThumbnail();
    $dPost->delpost();
    header('location: dashboard.php'); 
}
?>