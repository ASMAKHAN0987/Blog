<?php
   require_once('constroller.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forgetPassword</title>
    <link rel="stylesheet" href="../Login and Signup Form with Email Verification - PHP/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .forget{
            border:1px solid black;
            /* height: 300px; */
            width: 400px;
            background: white;
        }
        .body{
            width: 100%;
            height: 100vh;
            background-color: blue;
        }
    </style>
</head>
<body class="d-flex align-items-center body">
    <div class="container forget p-3">
                <form action="" method="POST" autocomplete="off">
                    <h2 class="text-center fw-bold mb-3 fs-1">Forget Password</h2>
                    <h6 class="text-center fs-5">Enter your email address</h6>
                    <?php if (!empty($errors)) {
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show h6 fw-bold" role="alert">
                          <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                } 
                ?>
                    <div class="form-group px-4">
                        <input type="email" class="form-control mb-3 mt-4 p-2" id="inputEmail4" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group px-4">
                        <input class="form-control button bg-primary text-light p-2" type="submit" name="forgot-pass" value="Continue">
                    </div>
                </form>
            </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</html>