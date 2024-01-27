<?php include 'partials/header.php';
include 'controlllerOfAdmin.php';
$firstName = $_SESSION['post-all-data']['FirstName'] ?? null;
$lastName = $_SESSION['post-all-data']['LastName'] ?? null;
$userName = $_SESSION['post-all-data']['Username'] ?? null;
$email = $_SESSION['post-all-data']['Email'] ?? null;
unset($_SESSION['post-all-data']); ?>

<section class="form_section d-flex justify-content-center align-items-center">
  <div class="form_section_container container  w-50">
    <h1 class="fw-bold text-center fs-1 mt-5">Add User</h1>
    <?php if (isset($_SESSION['add-user'])) {
    ?>
      <div class="alert alert-warning alert-dismissible fade show h6 fw-bold" role="alert">
        <?php
        $addUserError = $_SESSION['add-user'];
        echo $addUserError;
        unset($_SESSION['add-user']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div> <?php } ?>
    <form action="" enctype="multipart/form-data" method="POST">
      <!-- <div> -->
      <input type="text" name="FirstName" id="" placeholder="First Name" value="<?php echo $firstName ?>" />
      <!-- </div> -->
      <input type="text" name="LastName" id="" placeholder="Last Name" class="" value="<?php echo $lastName ?>"/>
      <input type="text" name="Username" id="" placeholder="Username" value="<?php echo $userName ?>" />
      <input type="Email" name="Email" id="" placeholder="Email" value="<?php echo $email ?>" />
      <select name="user-role" id="">
        <option value="0" class="">Author</option>
        <option value="1">Admin</option>
      </select>
      <input type="password" name="Password" id="" placeholder="Password" />
      <input type="password" name="cPassword" id="" placeholder="Confirm Password" />
      <div class="form_control">
        <label for="avatar" class="mb-1 fw-bolder">User Avater *</label>
        <input type="file" name="avatar" class="fw-bold" />
      </div>
      <button type="submit" class="p-3 border-0 bg-primary fw-bold text-white mb-5" name="add-user">Add User</button>
    </form>
  </div>
</section>
<!-- <?php include '../partials/footer.php'; ?> -->
<script>
  const avatar = document.querySelector('.avatar');
  const avater_part_con = document.querySelector('ul.avater-part-con');
  const fa_times = document.querySelector('nav .fa-times');
  avatar.addEventListener('click', () => {
    console.log("hello");
    avater_part_con.classList.toggle('hide');
  });
  var navlinks = document.getElementById("navlinks");

  function hideMenu() {
    navlinks.style.right = "-200px";
    fa_times.style.display = "none"
  }

  function showMenu() {
    navlinks.style.right = "0";
    fa_times.style.display = "block"
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>