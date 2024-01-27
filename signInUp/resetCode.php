<?php
require_once "constroller.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Code Verification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
</head>

<body style="height:100vh" class="bg-primary d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form bg-white">
                <h2 class="text-center mt-3 font-weight-bold">Code Verification</h2>
                <form action="" method="POST" autocomplete="off" class="p-3">
                    <?php if (!empty($errors)) {
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show h3 fw-bold" role="alert">
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
                    <?php
                    if (isset($_SESSION['info'])) {
                    ?>
                    <div class="alert alert-success text-center mt-3" style="padding: 0.4rem 0.4rem">
                        <?php echo $_SESSION['info']; ?>
                    </div>
                    <?php
                    } ?>
                    <div class="form-group">
                        <input class="form-control" type="number" name="otp" placeholder="Enter code">
                    </div>
                    <div class="form-group">
                        <input class="form-control button bg-primary text-light font-weight-bold" type="submit" name="Continue" value="Continue">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>