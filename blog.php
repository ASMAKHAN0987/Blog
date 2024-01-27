<?php  include 'partials/header.php'; 
       include 'admin/centerOfAdmin.php';
       if (isset($_GET['blogId'])) {
         $category_id = $_GET['blogId'];
         $singleBlog = new DataFetcher();
         $singleBlog = $singleBlog->fetchData('post',$category_id);
        //  echo $singleBlog['body'];
        //  echo var_dump($singleBlog);
        $authorId = $singleBlog['author_id'];
         $authorOfPost = new DataFetcher();
         $authorOfPosted = $authorOfPost->fetchData('users',$authorId);
        //  echo var_dump($authorOfPosted);
       }else{
        echo "it is not set now";
       }


?>

    <!-- individual Blog-->
    <div class="ind_feature container">
        <div class="featured-description">
            <h2><?= $singleBlog['title'] ?></h2>
            <div class="post__author">
                <div class="post__author__avatar">
                    <img src="images/<?= $authorOfPosted['avatar'] ?>" alt="" class="rounded-5">
                </div>
                <div class="post__author_info">
                    <h5 class="">By: <?= $authorOfPosted['firstname'] . ' ' . $authorOfPosted['lastname'] ?></h5>
                    <small><?= date("M d, Y - H:i", strtotime($singleBlog['date_time'])) ?></small>
                </div>
            </div>
            <div class="ind_img">
            <img src="images/<?= $singleBlog['thumbnail'] ?>" alt="">
        </div>
            <p class="fs-4 mt-5"><?= $singleBlog['body'] ?></p>
        </div>
    </div>
    <?php   include 'partials/footer.php';  ?>
    <script>
      const avatar = document.querySelector('.avatar');
      const avater_part_con = document.querySelector('ul.avater-part-con');
      const fa_times = document.querySelector('nav .fa-times');
        avatar.addEventListener('click',()=>{
            console.log("hello");
            avater_part_con.classList.toggle('hide');
        });
        var navlinks = document.getElementById("navlinks");
        function hideMenu(){
         navlinks.style.right = "-200px";
         fa_times.style.display = "none"
        //  fa_times.style.right = "-200px";
        } 
        function showMenu(){
         navlinks.style.right = "0";
         fa_times.style.display = "block"
        //  fa_times.style.right = "70px";
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>