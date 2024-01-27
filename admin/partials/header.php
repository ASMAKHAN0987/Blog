<?php 
include "../config/constants.php";
include "../config/database.php";
session_start();
if (isset($_SESSION['user_id'])){
    $id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
    $db = new Dbh();
    $db->connect();
    $stmt = $db->connect()->prepare('SELECT avatar FROM users WHERE id = ?');
    if($stmt->execute(array($id))){
        $record =  $stmt->fetchAll();
        $img = $record[0]['avatar'];
        $setImg = "../images/".$img;
        // echo $setImg;   
        // echo $img;
    }
}else{
    if(!isset($_SESSION['user_id'])){
        header('location:../signInUp/sign-in.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <link rel="stylesheet" href="../css/style.css" />
  <!-- <link rel="stylesheet" href="../Blog/css/style.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:ital,wght@0,500;0,600;0,900;1,500;1,800;1,900&family=Dancing+Script:wght@400;500;600;700&family=Fuzzy+Bubbles:wght@400;700&family=Great+Vibes&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Oswald:wght@200;300&family=Pacifico&family=Poppins:ital,wght@0,300;1,300&display=swap">
  <title>Responsive Multipage Blog Website</title>
  <style>
  </style>
<nav>
<h1 id="logo">!Nt9rior</h1>
<ul id="navlinks">
    <i class="fa fa-times hide" onclick="hideMenu()"></i>
    <li id="li_two"><a href="<?= ROOT_URL?>index.php">Home</a><span class="line"></span></li>
    <li><a href="<?= ROOT_URL?>explorer.php">Explorer</a><span class="line"></span></li>
    <li><a href="<?= ROOT_URL?>contact.php">Contact Us</a><span class="line"></span></li>
    <li><a href="<?= ROOT_URL?>services.php">Services</a><span class="line"></span></li>
    <?php
    if(isset($_SESSION['user_id'])){ ?>
    <li class="nav-profile">
        <div class="avatar"><img src="<?=  $setImg ?>" alt="" class="rounded-5"></div>
        <ul class="avater-part-con hide">
            <li><a href="dashboard.php" class="text-black fw-bold">Dashboard</a></li>
            <li><a href="../signInUp/logout.php" class="fw-bold">logout</a></li>
        </ul>
    </li>
   <?php }else {?>
    <li><a href="signInUp/sign-in.php" class="btn btn-warning text-white px-3 py-2 fw-bold">login</a></li>
    <?php } ?>
</ul>
<i class="fa fa-bars hide" onclick="showMenu()"></i>
</nav>
</head>
<body>