<?php
include "center.php";
if (isset($_POST['sign-up'])) {
  $_SESSION['sign-up-data'] = $_POST;
  $FirstName = $_POST['FirstName'];
  $LastName = $_POST['LastName'];
  $Username = $_POST['Username'];
  $Email = $_POST['Email'];
  $Password = $_POST['Password'];
  $cPassword = $_POST['cPassword'];
  $avatar = $_FILES['avatar'];
  // var_dump($FirstName,$LastName,$Username,$Email,$Password,$cPassword,$avatar);
  // if(!$avatar){
  //   echo "it is empty";
  // }
  // else{
  //   echo "empty not";
  // }
  $signUp = new signupContr($FirstName, $LastName, $Username, $Email, $Password, $cPassword, $avatar);
  // $signUp->showDATA();

  $signUp->signUpUser();
  // var_dump($avatar);

} ?>
<!-- ==============================signin========================== -->
<?php
if (isset($_POST["sign-in"])) {
   $_SESSION['sign-in-data'] = $_POST['email'];
  $email =   filter_var($_POST['email'], 
  FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $rememberMe = $_POST['rememberMe'] ?? null;
  $rememberMe = $rememberMe==1?:0;
  var_dump($rememberMe);
  $password =   filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $login = new loginContr($email, $password,$rememberMe);
  // $login->showDATA();
  // Running errors handlers and user signup
  $login->loginUser();
}
?>
<!-- =============================otp verificaiton =============================-->
<?php
if (isset($_POST['check'])) {
  $code = $_POST['otp'];
//  echo "this is email: " . var_dump($_SESSION['email2']);
  $otp = new otpVerification($code,0,"verified");
  // $otp->showData();
  $otp->checkToAll();
} ?>
<!--  ===================forget password====================  -->
<?php
if (isset($_POST['forgot-pass'])) {
  $email = $_POST['email'];
  $forgetPass = new forget($email);
  $forgetPass->forgetPassword();
} ?>
<!-- =======================New password========================== -->
<?php
if (isset($_POST['Continue'])) {
  $iCode = $_POST['otp'];
  $sCode = $_SESSION['code'];
  $resCode = new resetCode($sCode, $iCode);
  $resCode->toCheck();
}
if (isset($_POST['submit'])) {
  $pass = $_POST['password'];
  $cpass = $_POST['cPassword'];
  $newPass = new newPass($pass, $cpass);
  $newPass->newPasswordGen();
}
?>