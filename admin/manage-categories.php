<?php include 'partials/header.php';
include 'centerOfAdmin.php';
$fetchCat = new fetchCategoryData();
$records = $fetchCat->fetchCatData();
?>
  <?php if (isset($_SESSION['categoryAdd'])) {  ?>
    <div class="alert alert-success alert-dismissible fade show h6 fw-bold" role="alert">
      <?php
      $manageCategoryError = $_SESSION['categoryAdd'];
      echo $manageCategoryError;
      unset($_SESSION['categoryAdd']);
      ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php } ?>
  <?php
     if(isset($_SESSION['categoryUpdated'])){ ?>
        <div class="alert alert-success alert-dismissible fade show h6 fw-bold" role="alert">
      <?php
      $updatedCategoryError = $_SESSION['categoryUpdated'];
      echo $updatedCategoryError;
      unset($_SESSION['categoryUpdated']);
      ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php  }
    if(isset($_SESSION['deleteCat'])){ ?>
      <div class="alert alert-success alert-dismissible fade show h6 fw-bold" role="alert">
    <?php
    $updatedCategoryError = $_SESSION['deleteCat'];
    echo $updatedCategoryError;
    unset($_SESSION['deleteCat']);
    ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php  }
  elseif(isset($_SESSION['deleteCatError'])){ ?>
    <div class="alert alert-success alert-dismissible fade show h6 fw-bold" role="alert">
  <?php
  $updatedCategoryError = $_SESSION['deleteCatError'];
  echo $updatedCategoryError;
  unset($_SESSION['deleteCatError']);
  ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php  }
  ?>
  <div class="main_con_hide">
    <section class="dashboard bg-white w-100 container">
      <div class="dashboard_container d-flex  align-items-start p-5">
        <aside class="">
          <ul class="dashboard_list float-none">
            <li>
              <a href="<?= ROOT_URL ?>admin/add-post.php"><i class="fa-solid fa-pen"></i>
                <h5>Add Post</h5>
              </a>
            </li>
            <li>
              <a href="dashboard.php"><i class="fa-regular fa-address-card"></i>
                <h5>Manage Posts</h5>
              </a>
            </li>
            <li>
              <a href="<?= ROOT_URL ?>admin/add-user.php"><i class="fa-solid fa-pen-to-square"></i>
                <h5>Add User</h5>
              </a>
            </li>
            <li>
              <a href="<?= ROOT_URL ?>admin/manage-users.php"><i class="fa-solid fa-user-plus"></i>
                <h5>Manage Users</h5>
              </a>
            </li>
            <li>
              <a href="<?= ROOT_URL ?>admin/add-catorgory.php"><i class="fa-solid fa-pen"></i>
                <h5>Add Categories</h5>
              </a>
            </li>
            <li>
              <a href="<?= ROOT_URL ?>admin/manage-categories.php"><i class="fa-solid fa-list"></i>
                <h5>Manage Categories</h5>
              </a>
            </li>
          </ul>
        </aside>
        <main> 
          <?php          if(!empty($records)){               ?>
          <h1 class="mt-2 mb-4">Manage Categories</h1>
          <div id="table_div">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Title</th>
                  <th scope="col">Edit</th>
                  <th scope="col">Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($records as $record) { ?>
                  <tr>
                    <td><?= $record['title'] ?></td>
                    <td> <a href="<?= ROOT_URL ?>admin/edit-category.php?dCId=<?= $record['id'] ?>" class="btn btn-primary" name="editCat">Edit</a> </td>
                    <td><a href="<?= ROOT_URL ?>admin/delete-category.php?dCId=<?= $record['id'] ?>" class="btn btn-danger deleter-user" name="delCat">Delete</a></td>
                  </tr> <?php } ?>

              </tbody>
            </table>
          </div>
          <?php } else { ?> <h4 class="text-danger fw-bold bg-danger text-light p-2">No post found!</h4> <?php  } ?>
        </main>
      </div>
    </section>
    <?php include '../partials/footer.php'; ?>
  </div>
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
    deleteUser = document.querySelectorAll('.deleter-user'); 
    Array.from(deleteUser).forEach((element) => {
      element.addEventListener("click", (e) => {
        if (confirm("Are You Sure You want to delete this note?")) {
          window.location = `<?= ROOT_URL ?>/admin/delete-category.php`;
        } else{
          e.preventDefault();
        }
      })
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>