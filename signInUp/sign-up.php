<?php
   require_once('constroller.php'); 
   $firstName = $_SESSION['sign-up-data']['FirstName'] ?? null;
   $lastName = $_SESSION['sign-up-data']['LastName'] ?? null;
   $userName = $_SESSION['sign-up-data']['Username'] ?? null;
   $email = $_SESSION['sign-up-data']['Email'] ?? null;
   unset($_SESSION['sign-in-data']);?>
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
<div class="bg-black">
</div>
  <section class="form_section d-flex justify-content-center align-items-center mb-5">
    <div class="form_section_container container  w-50 mt-5">
      <h1 class="fw-bold text-center fs-1 mt-5 mb-5">Sign up</h1>
      <?php if (isset($_SESSION['signup'])) {
      ?>
        <div class="alert alert-warning alert-dismissible fade show h6 fw-bold" role="alert">
          <?php
          $signupError = $_SESSION['signup'];
          echo $signupError;
          unset($_SESSION['signup']);
          ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> <?php } ?>
      <form action="" enctype="multipart/form-data" method="POST">
        <input type="text" name="FirstName" id="" placeholder="First Name" value="<?php echo $firstName ?>"/>
        <input type="text" name="LastName" id="" placeholder="Last Name" class="" value="<?php echo $lastName ?>"/>
        <input type="text" name="Username" id="" placeholder="Username" value="<?php echo $userName ?>"/>
        <input type="Email" name="Email" id="" placeholder="Email" value="<?php echo $email ?>"/>
        <input type="password" name="Password" id="" placeholder="Password" />
        <input type="password" name="cPassword" id="" placeholder="Confirm Password" />
        <div class="form_control">
          <label for="avatar" class="mb-1 fw-bolder">User Avater *</label>
          <input type="file" name="avatar" class="fw-bold" />
        </div>
        <button type="submit" class="p-3 border-0 bg-primary fw-bold text-white" name="sign-up">Sign Up</button>
        <small class="fw-bolder fs-5 mb-5">Already have an account <a href="sign-in.php">Sign In</a></small>
      </form>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>