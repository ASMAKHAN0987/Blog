<?php
function isLoggedIn(){
    $db = new Dbh();
    $conn = $db->connect();
    // echo $_SESSION['token'];
    // return true;
    // if(!empty($_SESSION['token'])){
    //   echo "hello";
    // }
    // check for a cookie
    $COOKIE = $_COOKIE['token'] ?? null;
    if($COOKIE && strstr($COOKIE,":")){
      $parts = explode(':',$COOKIE);
      $token_key = $parts[0];
      $token_value = $parts[1];
      $query = "SELECT * FROM usertoken WHERE tokenKey = :tokenKey LIMIT 1";
          $stmt = $conn->prepare($query);
          $stmt->bindValue(":tokenKey", $token_key, PDO::PARAM_STR);
          $stmt->execute();
          $data = $stmt->fetch(PDO::FETCH_ASSOC);
          if($data){ 
            // var_dump($data);
            // die();
            // $data = $data[''];
          $data['tokenValue'];  
          if($token_value == $data['tokenValue']){
            $_SESSION['token'] = $data['tokenValue'];
            return true;
          }
        }
    }
      else{
          return false;
      }

  }
  ?>