<?php
require_once "constroller.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Code Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body style="height:100vh" class="bg-primary d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form 
            bg-white">
                <h2 class="text-center mt-3  font-weight-bold">New Password</h2>
                <div class="alert alert-success text-center mt-3 font-weight-bold">
                    please create a new password that you don't use on any other site!
                </div>
                <form action="" method="POST" autocomplete="on">
                    <?php if (isset($_SESSION['newPass'])) { ?> 
                    <div class="alert alert-danger alert-dismissible fade show h6 fw-bold" role="alert">
                        <?php
                            echo $_SESSION['newPass'];
                            session_unset();
                        ?>
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php  } ?>
        <div class="col-md-12">
        <input type="password" class="form-control mb-2" id="inputPassword4" name="password" placeholder="Create new password">
                    </div>
        <div class="col-md-12">
            <input type="password" class="form-control mb-2" id="inputConfirmPassword4" name="cPassword" placeholder="Confirm password">
        </div>
        <div class="col-md-12">
            <input class="form-control button bg-primary text-light font-weight-bold mt-3 mb-4" type="submit" name="submit" value="Submit">
        </div>
        </form>
    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>