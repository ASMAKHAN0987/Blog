<?php
require_once "constroller.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container-otp">
        <!-- <div class="col-md-4 offset-md-4 form"> -->
        <form action="" method="POST" autocomplete="off" class="otp-form">
            <h2 class="text-center fw-bold">Code Verification</h2>
            <div class="form-group">
                <?php if (isset($_SESSION['otp'])) { ?>
                    <div class="alert alert-danger alert-dismissible fade show h6 fw-bold" role="alert">
                        <?php
                        echo $_SESSION['otp'];
                        // session_unset();
                        ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php  } 
                else {
                    if (isset($_SESSION['otp-info'])) { ?> 
                        <div class="alert alert-success alert-dismissible fade show h6 fw-bold" role="alert">
                            <?php
                            echo $_SESSION['otp-info'];
                            // session_unset();
                            ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                } }?>
                <input class="form-control px-3 py-3" type="number" name="otp" placeholder="Enter verification code">
            </div>
            <div class="form-group">
                <input class="form-control button p-2 bg-primary text-white fw-bold" type="submit" name="check" value="Submit">
            </div>
        </form>
        <!-- </div> -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html> 