<?php
include 'partials/header.php';
include 'controlllerOfAdmin.php';
if (isset($_GET['delUser'])) {
  $id = filter_var($_GET['delUser'], FILTER_SANITIZE_NUMBER_INT);
     $_SESSION['delUser'] = $id;
  $persistData = new persistData($id);
  $result = $persistData->toShow()
  ;
} else {
  echo "there is problem";
}
?>
<!-- all php is above -->
<section class="form_section mt-0 w-100">
  <div class="form_section_container container  w-50">
    <h1 class="fw-bold text-center fs-1">Edit User</h1>
    <?php if (isset($_SESSION['updateError'])) {
    ?>
      <div class="alert alert-warning alert-dismissible fade show h6 fw-bold" role="alert">
        <?php
        $updationError = $_SESSION['updateError'];
        echo $updationError;
        unset($_SESSION['updateError']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div> <?php } ?>
    <form action="" method="POST" enctype="multipart/form-data">
      <input type="text" name="FirstName" placeholder=" First Name" value="<?= $result['firstname'] ?>" />
      <!-- value="<?php echo $lastName ?>" -->
      <input type="text" name="LastName" id="" placeholder="Last Name" class="" value="<?= $result['lastname'] ?>" />
      <select name=" is_admin" id="">
        <option value="0" class="">Author</option>
        <option value="1">Admin</option>
      </select>
      <button type="submit" class="p-3 border-0 bg-primary fw-bold text-white mb-5" name="update-user">Update User</button>
    </form>
  </div>
</section>
<?php include 'partials/footer.php'; ?>
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