<?php include 'partials/header.php';
// include 'centerOfAdmin.php';
include 'controlllerOfAdmin.php';
if (isset($_GET['dCId'])) {
    $id = filter_var($_GET['dCId'], FILTER_SANITIZE_NUMBER_INT);
    $_SESSION['edit-cat-id'] = $id;
    $table = 'category';
    $persistData = new DataFetcher();
    $result = $persistData->fetchData($table, $id);
} else {
    echo "there is problem";
}
?>
<section class="form_section d-flex justify-content-center align-items-center h-75">
    <div class="form_section_container container  w-50">
        <h1 class="fw-bold text-center fs-1 mb-3">Edit Category</h1>
        <?php if (isset($_SESSION['updateCatError'])) {
        ?>
            <div class="alert alert-warning alert-dismissible fade show h6 fw-bold" role="alert">
                <?php
                $updationCatError = $_SESSION['updateCatError'];
                echo $updationCatError;
                unset($_SESSION['updateCatError']);
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div> <?php } ?>
        <form action="" enctype="multipart/form-data" method="post">
            <input type="text" name="title" id="" placeholder="Title" value="<?= $result['title'] ?>" />
            <textarea name="description" rows="4" placeholder="description"><?= $result['description'] ?></textarea>
            <button type="submit" class="p-3 border-0 bg-primary fw-bold text-white mb-5" name="edit-category">Edit Category</button>
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
        //  fa_times.style.right = "-200px";
    }

    function showMenu() {
        navlinks.style.right = "0";
        fa_times.style.display = "block"
        //  fa_times.style.right = "70px";
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>