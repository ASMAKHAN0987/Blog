<?php
   require_once('constroller.php'); 
     $email = $_SESSION['sign-in-data'] ?? null;
     unset($_SESSION['sign-in-data']);
   ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:ital,wght@0,500;0,600;0,900;1,500;1,800;1,900&family=Dancing+Script:wght@400;500;600;700&family=Fuzzy+Bubbles:wght@400;700&family=Great+Vibes&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Oswald:wght@200;300&family=Pacifico&family=Poppins:ital,wght@0,300;1,300&display=swap" />
  <title>Document</title>
</head>

<body>
  <section class="form_section d-flex justify-content-center align-items-center mt-0">
    <div class="form_section_container container  w-50">
      <h1 class="fw-bold text-center fs-1">Sign In</h1>
      <?php if (isset($_SESSION['signup-success'])) { ?>
        <div class="alert alert-success alert-dismissible fade show h6 fw-bold" role="alert">
          <?php
          echo $_SESSION['signup-success'];
          unset($_SESSION['signup-success']);
          ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php  } else{
      if (isset($_SESSION['login'])) { ?>
        <div class="alert alert-danger alert-dismissible fade show h6 fw-bold" role="alert">
          <?php
          echo $_SESSION['login'];
          unset($_SESSION['login']);
          ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php  } }
      ?>
      <form action="" method="POST">
        <input type="Email" name="email" placeholder="Email" value="<?php echo $email ?>"/>
        <input type="password" name="password" placeholder="Password"/>
        <div class="form_control inline">
                        <input type="checkbox" name="rememberMe" id="remember" checked value="1" class="">
                        <label for="rememberMe" class="fw-bold">Remember me</label>
                    </div>
        <a href="forgetpassword.php" class="fw-bold">forgot password?</a>
        <button type="submit" class="p-3 border-0 bg-primary fw-bold text-white" name="sign-in">Sign In</button>
        <small class="fw-bolder fs-5">Not a memeber <a href="sign-up.php">Sign up now</a></small>
        <!-- <div class="mt-5 text-center signUp">Not a memeber? <a href="#">Sign Up now</a></div> -->
      </form>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>