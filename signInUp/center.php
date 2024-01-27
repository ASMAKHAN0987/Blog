  <?php
  session_set_cookie_params(['path'=>'/','secure' => true, 'httponly' => true, 'samesite' => 'lax']);
  session_start();
  session_regenerate_id(true);
  include "../config/database.php";
  // echo $_COOKIE['token'];
  if (isset($_COOKIE['token'])) {
    // unset($_COOKIE['token']);
    echo "eelelelel";
}
  ?>
  <?php
  class signUp extends Dbh
  {
    protected function setUser($firstName, $lastName, $userName, $email, $password, $avatar, $admin)
    {
      $code = rand(999999, 111111);
      $status = "notverified";
      $stmt = $this->connect()->prepare('INSERT INTO users (firstname,lastname,username,email,password,avatar,is_admin,status,code) VALUES(?,?,?,?,?,?,?,?,?)');
      $hashedPwd = password_hash($password, PASSWORD_BCRYPT);
      if (!$stmt->execute(array($firstName, $lastName, $userName, $email, $hashedPwd, $avatar, $admin, $status, $code))) {
        $stmt = null;
        $_SESSION['signup'] = "Some error to proceed";
        // exit();
      } else {
        if (self::mail($email, $code) == false) {
          $_SESSION['signup'] = "Sorry, failed while sending mail!";
        } else {
          $_SESSION['otp-info'] = "We have sent you OTP verification code at $email";
          $_SESSION['email2'] = $email;
          header('location: otp-verification.php');
        }
      }
      $stmt = null;
    }
    public static function mail($email, $code)
    {
      $receiver = $email;
      $subject = "verification code";
      $body = "Your verification code is: $code";
      $sender = "From:sender email address here";
      if (mail($receiver, $subject, $body, $sender)) {
        return true;
      } else {
        return false;
      }
    }
    protected function checkUser($email)
    {
      $stmt = $this->connect()->prepare('SELECT COUNT(*) FROM users WHERE email = ?');
      if (!$stmt->execute(array($email))) {
        $stmt = null;
        header("location: ../index.php?error=stmtfailed");
        exit();
      }
      $resultCheck = false;
      if ($stmt->fetchColumn() > 0) {
        $resultCheck = false;
      } else {
        $resultCheck = true;
      }
      return $resultCheck;
    }
  }
  class signupContr extends signUp
  {
    private $firstName;
    private $lastName;
    private $userName;
    private $email;
    private $password;
    private $cPassword;
    private $avatar;
    public function __construct($firstName, $lastName, $userName, $email, $password, $cPassword, array $avatar)
    {
      $this->firstName = $firstName;
      $this->lastName = $lastName;
      $this->userName = $userName;
      $this->email = $email;
      $this->password = $password;
      $this->cPassword = $cPassword;
      $this->avatar = $avatar;
    }
    public function showDATA()
    {
      echo "All data are: {$this->userName} {$this->email} {$this->password} {$this->cPassword} {$this->firstName} {$this->lastName}";
      // echo var_dump($this->avatar);
    }
    public function signUpUser()
    {
      // $_SESSION['email']= $this->email;
      if ($this->emptyInput() == false) {
        $_SESSION['signup'] = "Fields are empty";
        // header('location: ./sign-up.php');
      } elseif ($this->invalidUserId() == false) {
        // echo invalid user name
        $_SESSION['signup'] = "Invalid user name";
        // exit();
      } elseif ($this->invalidEmail() == false) {
        // echo empty input
        $_SESSION['signup'] = "Invalid email";
        // session_destroy();
        // exit();
      } elseif ($this->pwdMatch() == false) {
        // echo password mismatch
        $_SESSION['signup'] = "Password mismatched";
        // exit();
      } elseif ($this->userTakenCheck() == false) {
        $_SESSION['signup'] = "Registration already made!";
        // exit();
      }
      // elseif {
      else {
        $avatar_name = $this->avatarValidation();
        if ($avatar_name) {
          echo "hello successfullly";
          $this->setUser($this->firstName, $this->lastName, $this->userName, $this->email, $this->password, $avatar_name, 1);
        }
      }
    }
    private function emptyInput()
    {
      $result = '';
      if (empty($this->firstName) || empty($this->lastName) || empty($this->userName) || empty($this->email) || empty($this->password) || empty($this->cPassword) || empty($this->avatar['name'])) {
        $result = false;
      } else {
        $result = true;
      }
      return $result;
    }

    private function invalidUserId()
    {
      $result = '';
      if (!preg_match("/^[a-zA-Z0-9]*$/", $this->userName)) {
        $result = false;
      } else {
        $result = true;
      }
      return $result;
    }
    private function invalidEmail()
    {
      $result = '';
      if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
        $result = false;
      } else {
        $result = true;
      }
      return $result;
    }
    private function pwdMatch()
    {
      $result = '';
      if ($this->password == $this->cPassword) {
        $result = true;
      } else {
        $result = false;
      }
      return $result;
    }
    private function userTakenCheck()
    {
      $result = false;
      if (!$this->checkUser($this->email)) {
        $result = false;
      } else {
        $result = true;
      }

      return $result;
    }
    private function avatarValidation()
    {
      // work on avatar
      $time = time(); //make each image unique using current timestamp
      $avatar_name = $time . $this->avatar['name'];
      $avatar_tmp_name = $this->avatar['tmp_name'];
      // $folder_save = './images/';
      $folder_save = '../images/';
      $avatar_destination_path = $folder_save . $avatar_name;
      // make sure file is in image
      $allowed_files = ['png', 'jpg', 'jpeg'];
      $extension = explode('.', $avatar_name);
      $extension = end($extension);
      if (in_array($extension, $allowed_files)) {
        // make sure image is not too large (1mb+)
        if ($this->avatar['size'] < 1000000) {
          move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
          return $avatar_name;
        } else {
          $_SESSION['signup'] = 'File size is too big. Should be less than 1mb';
        }
      } else {
        $_SESSION['signup'] = 'File should be png, jpg or jpeg';
        return false;
      }
    }
  }
  ?>
  <!-- ===============================login======================= -->
  <?php
  class login extends Dbh
  {
    protected function toCheck($email, $password)
    {
      $stmt = $this->connect()->prepare('SELECT * FROM users WHERE email = ?');
      $_SESSION['pass1'] = $password;
      if (!$stmt->execute(array($email))) {
        // header("location:../loginOfMine/index2.php?error=QueryIsWrong");
        $_SESSION['login'] = "Inernal Error!";
      } else {
        if ($stmt->rowCount() > 0) {
          $fetchRecord = $stmt->fetchAll();
          // echo var_dump($fetchRecord);
          $passCheck = password_verify($password, $fetchRecord[0]['password']);
          if ($passCheck == true) {
            if ($this->notVerifiedYet($fetchRecord) == true) {
              $_SESSION['user_id'] =  $fetchRecord[0]['id'];
              if ($fetchRecord[0]['is_admin'] == 1) {
                $_SESSION['is_admin'] = true;
              }
              return true;
              // else{
              //   $_SESSION['is_admin']= false;
              // }
            }
          } else {
            $_SESSION['login'] = "Incorret Password!";
          }
        } else {
          $_SESSION['login'] = "Doesn't Exist this Email!";
        }
      }
    }
    // not verified yet
    private function notVerifiedYet($fetch)
    {
      if (
        $fetch[0]['code'] != 0 && $fetch[0]['status']
        == "notverified"
      ) {
        $_SESSION['otp-info'] = "It's  look like that you haven't still verify your email- $fetch[0]['email']!";
        header('location:otp-verification.php');
      } elseif ($fetch[0]['code'] != 0 && $fetch[0]['status'] == "verified") {
        $_SESSION['info'] = "We Have Sent a password reset otp to your email- $fetch[0]['email']!";
        header('location:resetCode.php');
      } else {
        return true;
      }
    }
  }
  class loginContr extends login
  {
    private $email;
    private $password;
    private $rememberMe;
    public function __construct($email, $password, $rememberMe)
    {
      $this->email = $email;
      $this->password = $password;
      $this->rememberMe = $rememberMe;
    }
    public function showDATA()
    {
      echo "All data are: {$this->email} {$this->password} {$this->rememberMe}";
    }
    public function loginUser()
    {
      if ($this->emptyInput() == false) {
        $_SESSION['login'] = "Fields are empty!";
      } else {
        if ($this->toCheck($this->email, $this->password) == true) {
          $expires = time() + (60*60*24);
          if ($this->rememberMe) {
          $expires = time() + ((60*60*24)*7);
            $_SESSION['expires'] = $expires;
            $salt = 'mysaltlll';
            $code = rand(999999, 111111);
            $token_key = hash('sha256', time() . $salt);
            $token_value = hash('sha256', $code . $salt);
            setcookie('token', $token_key . ":" . $token_value, $expires,'/');
            $sql = "INSERT INTO usertoken (tokenKey, tokenValue)
          VALUES (:tokenKey, :tokenValue)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindValue(":tokenKey", $token_key, PDO::PARAM_STR);
            $stmt->bindValue(":tokenValue", $token_value, PDO::PARAM_STR);
            $stmt->execute();
            echo $_COOKIE['token'];
          }     else{
            $_SESSION['expires'] = $expires;
          }
          header('location: ../index.php');
        }
      }
    }
    private function emptyInput()
    {
      $result = false;
      if (empty($this->email) || empty($this->password)) {
        $result = false;
      } else {
        $result = true;
      }
      return $result;
    }
  }
  ?>
  <!-- ===============================otp verification=========================== -->
  <?php
  class otpVerification extends Dbh
  {
    private $code;
    private $tempcode;
    private $status;
    function __construct($code, $tempcode, $status)
    {
      $this->code = $code;
      $this->tempcode = $tempcode;
      $this->status = $status;
    }
    public function showData()
    {
      if (isset($_SESSION['email2'])) {
        $email = $_SESSION['email2'];
        echo " it is all code  $email {$this->code} {$this->tempcode} {$this->status}";
      }
    }
    public function checkToAll()
    {
      $email = $_SESSION['email2'];
      $conn = $this->connect();
      if ($this->toEmpty() == false) {
        $_SESSION['otp'] = "Field is empty";
      } elseif ($this->verifyCode() == false) {
        $_SESSION['otp'] = "Invalid otp code";
      } elseif (self::changeCodeStatus($email, $this->tempcode, $this->status, $this->code) == false) {
        $_SESSION['otp'] = "Internal error occurred";
      } else {
        $_SESSION['signup-success'] = "Successfully registered now you can login!";
        header('location: sign-in.php');
      }
    }
    //  to verify code
    private function toEmpty()
    {
      if (empty($this->code)) {
        return false;
      } else {
        return true;
      }
    }
    private function verifyCode()
    {
      $stmt = $this->connect()->prepare('select * from users where code = ?');
      if ($stmt->execute(array($this->code))) {
        if ($stmt->fetchColumn() > 0) {
          return true;
        } else {
          return false;
        }
      } else {
        $_SESSION['otp'] = "Internal error occured";
      }
    }
    //  to change code and status
    public static function changeCodeStatus($email, $tempcode, $status, $code)
    {
      // var_dump($code,$email,$status,$tempcode);
      // die();
      $db = new Dbh;
      $stmt = $db->connect()->prepare('UPDATE users SET code = ? , status = ? WHERE code =? AND email = ?');
      if ($stmt->execute(array($tempcode, $status, $code, $email))) {
        return true;
      } else {
        return false;
      }
    }
  }
  ?>
  <?php
  // =============================forget password====================================
  // for forget password
  class forget extends Dbh
  {
    private $email;
    public function __construct($email)
    {
      $this->email = $email;
    }
    public function forgetPassword()
    {
      $_SESSION['email'] = $this->email;
      global $errors;
      $errors = array();
      if ($this->toEmpty($this->email) == false) {
        $errors[] = "input is empty:";
      } elseif ($this->isEmailExist() == false) {
        $errors[] = "$this->email not exist!";
      } elseif ($this->invalidEmail() == false) {
        $errors[] = "Invalid email address!";
      } else {
        $code = rand(999999, 111111);
        $_SESSION['code'] = $code;

        if (signUp::mail($this->email, $code) == false) {
          $errors[] = "Sorry! failed while sending mail...";
        } else {
          $tempcode = 0;
          $status = "verified";
          if (otpVerification::changeCodeStatus($this->email, $code, $status, $tempcode) == false) {
            $errors[] = "Sorry! someting went wrong";
          } else {
            $_SESSION['info'] = "We Have Sent a password reset otp to your email- $this->email";
            header('location:resetCode.php');
          }
        }
      }
    }
    public function toEmpty($element)
    {
      $res = false;
      if (empty($element)) {
        $res = false;
      } else {
        $res = true;
      }
      return $res;
    }
    public function isEmailExist()
    {
      $res = false;
      $stmt = $this->connect()->prepare('SELECT * FROM users WHERE email = ?');
      if ($stmt->execute(array($this->email))) {
        if ($stmt->rowCount() > 0) {
          $res = true;
          $stmt = null;
        } else {
          $res = false;
        }
      } else {
        $errors[] = "There is some database connection error!";
        // exit();
      }
      return $res;
    }
    public function invalidEmail()
    {
      $result = '';
      if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
        $result = false;
      } else {
        $result = true;
      }
      return $result;
    }
  }
  ?>
  <?php
  class resetCode extends forget
  {
    private $sendCode;
    private $inputCode;
    public function __construct($sCode, $iCode)
    {
      $this->sendCode = $sCode;
      $this->inputCode = $iCode;
    }
    public function toCheck()
    {
      $conn = $this->connect();
      global $errors;
      $errors = array();
      if ($this->toEmpty($this->inputCode) == false) {
        $errors[] = "Field is Empty!";
      } elseif ($this->passCheck($this->sendCode, $this->inputCode) == false) {
        $errors[] = "Incorrect code!";
      } else {
        $tempcode = 0;
        $status = "verified";
        $email = $_SESSION['email'];
        if (otpVerification::changeCodeStatus($email, $tempcode, $status, $this->sendCode) == false) {
          $_errors[] = "Something went wrong";
        } else {
          header("location:newPassword.php");
        }
      }
    }
    protected function passCheck($arg1, $arg2)
    {
      $res = false;
      if ($arg1 == $arg2) {
        $res = true;
      } else {
        $res = false;
      }
      return $res;
    }
  }
  ?>
  <?php
  class newPass extends resetCode
  {
    private $pass;
    private $cpass;
    function __construct($pass, $cpass)
    {
      $this->pass = $pass;
      $this->cpass = $cpass;
    }
    public function newPasswordGen()
    {
      if ($this->toEmpty($this->pass) == false) {
        $_SESSION['newPass'] = "Field is Empty!";
      } elseif ($this->toEmpty($this->cpass) == false) {
        $_SESSION['newPass'] = "Field is Empty!";
      } elseif ($this->passCheck($this->pass, $this->cpass) == false) {
        $_SESSION['newPass'] = "password Mismatch with confirm password!";
      } else {
        if ($this->updateQuery() == false) {
          $_SESSION['newPass'] = "Error in Updating password";
        } else {
          $_SESSION['signup-success'] = "your password has been updated successfully you can login now!";
          header("location:sign-in.php");
        }
      }
    }
    private function updateQuery()
    {
      $email = $_SESSION['email'];
      $stmt = $this->connect()->prepare('UPDATE users SET password = ? WHERE email = ?');
      $res = false;
      $hashedPwd = password_hash($this->pass, PASSWORD_BCRYPT);
      if (!$stmt->execute(array($hashedPwd, $email))) {
        $res = false;
      } else {
        $res = true;
      }
      return $res;
    }
  }
  ?>