<?php  include 'partials/header.php'; 
 include 'controlllerOfAdmin.php';
 $catData = new fetchCategoryData();
 $categoryData = $catData->fetchCatData();
 
?>
 <?php
      if (isset($_GET['post'])) {
        $id = filter_var($_GET['post'], FILTER_SANITIZE_NUMBER_INT);
           $_SESSION['post-id'] = $id;
           $postEditFetch = new DataFetcher();
           $result = $postEditFetch->fetchData('post',$id);
           $_SESSION['previousThumbnail'] = $result['thumbnail'];
        // $persistData = new persistData($id);
        // $result = $persistData->toShow();
      } else {
        echo "there is problem";
      }?>
    
    <section class="form_section d-flex justify-content-center align-items-center h-75">
        <div class="form_section_container container  w-50">
            <h1 class="fw-bold text-center fs-1">Edit Post</h1>
            <?php if (isset($_SESSION['postUpdateError'])) {
            ?>
                <div class="alert alert-danger alert-dismissible fade show h6 fw-bold" role="alert">
                    <?php
                    $postError = $_SESSION['postUpdateError'];
                    echo $postError;
                    unset($_SESSION['postUpdateError']);
                    ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div> <?php } ?>
            <form action="" enctype="multipart/form-data" method="post">
                <input type="text" name="posTitle" placeholder="post-title" value="<?= $result['title'] ?>" />
                <select name="post-cat" id="">
                    <?php foreach ($categoryData as $data) { ?>
                        <option value="<?= $data['id'] ?>" <?=$data['id'] == $result['category_id']?'selected' : '' ?>><?= $data['title'] ?></option>
                    <?php }  ?>
                </select>
                <textarea name="post" rows="10" placeholder="description"><?= $result['body'] ?></textarea>
                <?php
                if (isset($_SESSION['is_admin'])) { ?>
                    <div class="form_control inline">
                        <input type="checkbox" name="is_featured" id="" checked value="<?= $is_featured ?>">
                        <label for="is_featured" class="fw-bold">Featured</label>
                    </div>
                <?php } ?>
                <div class="form_control">
                    <label for="thumbnail" class="fw-bold">Add Thumbnail</label>
                    <input type="file" name="thumbnail" class="w-auto">
                </div>
                <button type="submit" class="p-3 border-0 bg-primary fw-bold text-white mb-4" name="edit-post">Edit Post</button>

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