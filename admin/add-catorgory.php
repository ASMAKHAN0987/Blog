<?php  include 'partials/header.php'; 
       include 'controlllerOfAdmin.php';
$titleData = $_SESSION['category-all-data']['title'] ?? null;
unset($_SESSION['category-all-data']);
?>
    <section class="form_section d-flex justify-content-center align-items-center h-75">
        <div class="form_section_container container  w-50">
            <h1 class="fw-bold text-center fs-1">Add Category</h1>
            <?php if (isset($_SESSION['categoryAddError'])) {
    ?>
      <div class="alert alert-warning alert-dismissible fade show h6 fw-bold" role="alert">
        <?php
        $categoryAddError = $_SESSION['categoryAddError'];
        echo $categoryAddError;
        unset($_SESSION['categoryAddError']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div> <?php } ?>
            <form action="" enctype="multipart/form-data" method="POST">
                <input type="text" name="title" id="" placeholder="Title" value="<?= $titleData ?>" />
                <textarea name="title_description" rows="4" placeholder="description"></textarea>
                <button type="submit" class="p-3 border-0 bg-primary fw-bold text-white mb-4" name="add-category">Add Category</button>
            </form>
        </div>
    </section>
    <?php     include 'partials/footer.php'; ?>
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