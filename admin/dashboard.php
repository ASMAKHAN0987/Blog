<?php
include 'partials/header.php';
include 'controlllerOfAdmin.php';
$user_id = $_SESSION['user_id'];
$postData = new postDataFetch($user_id);
$postDataRes = $postData->postFetching();
// $postData->userId();
// if($postDataRes){
//     echo "there is no data ok" . var_dump($postDataRes);
// }
// else{
//     echo "data is not coming";
// }
// foreach($postDataRes as $fet){
//     echo $fet;
// }

?>
<?php if (isset($_SESSION['postInsertSuccess'])) {  ?>
    <div class="alert alert-success alert-dismissible fade show h6 fw-bold" role="alert">
        <?php
        $manageCategoryError = $_SESSION['postInsertSuccess'];
        echo $manageCategoryError;
        unset($_SESSION['postInsertSuccess']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>
<?php
if (isset($_SESSION['postUpdateSuccess'])) {  ?>
    <div class="alert alert-success alert-dismissible fade show h6 fw-bold" role="alert">
        <?php
        $manageCategoryError = $_SESSION['postUpdateSuccess'];
        echo $manageCategoryError;
        unset($_SESSION['postUpdateSuccess']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } elseif (isset($_SESSION['postUpdateError'])) {  ?>
    <div class="alert alert-danger alert-dismissible fade show h6 fw-bold" role="alert">
        <?php
        $manageCategoryError = $_SESSION['postUpdateError'];
        echo $manageCategoryError;
        unset($_SESSION['postUpdateError']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>
<?php if (isset($_SESSION['deletePostSuccess'])) {  ?>
    <div class="alert alert-success alert-dismissible fade show h6 fw-bold" role="alert">
        <?php
        $manageCategoryError = $_SESSION['deletePostSuccess'];
        echo $manageCategoryError;
        unset($_SESSION['deletePostSuccess']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php } else {
    if (isset($_SESSION['deletePostError'])) {  ?>
        <div class="alert alert-success alert-dismissible fade show h6 fw-bold" role="alert">
            <?php
            $manageCategoryError = $_SESSION['deletePostError'];
            echo $manageCategoryError;
            unset($_SESSION['deletePostError']);
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php }
} ?>
<div class="main_con_hide">
    <section class="dashboard bg-white w-100 container">
        <div class="dashboard_container d-flex  align-items-start p-5 justify-content-start">
            <aside class="">
                <ul class="dashboard_list float-none">
                    <li>
                        <a href="add-post.php"><i class="fa-solid fa-pen"></i>
                            <h5>Add Post</h5>
                        </a>
                    </li>
                    <li>
                        <a href="dashboard.php"><i class="fa-regular fa-address-card"></i>
                            <h5>Manage Posts</h5>
                        </a>
                    </li>
                    <?php if (isset($_SESSION['is_admin'])) { ?>
                        <li>
                            <a href="add-user.php"><i class="fa-solid fa-pen-to-square"></i>
                                <h5>Add User</h5>
                            </a>
                        </li>
                        <li>
                            <a href="manage-users.php"><i class="fa-solid fa-user-plus"></i>
                                <h5>Manage Users</h5>
                            </a>
                        </li>
                        <li>
                            <a href="manage-categories.php"><i class="fa-solid fa-list"></i>
                                <h5>Manage Categories</h5>
                            </a>
                        </li>
                    <?php }
                    ?>
                </ul>
            </aside>
            <main class="text-start">
                
                <h2 class="mt-2 mb-5 fw-bold text-center">Manage Posts</h2>
                <?php   if(!empty($postDataRes)){ ?>
                <div id="table_div">
                    
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- 1 row -->
                            <tr>
                                <?php
                                foreach ($postDataRes as $record) {   ?>
                                    <td><?= $record['ptitle'] ?></td>
                                    <td><?= $record['ctitle'] ?></td>
                                    <td><a href="edit-post.php?post=<?= $record['id'] ?>" class="btn btn-primary">Edit</a></td>
                                    <td><a href="delete-category.php?post=<?= $record['id'] ?>" class="btn btn-danger">Delete</a></td>
                            </tr>
                        <?php } ?>
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
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>