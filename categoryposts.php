<?php
include 'partials/header.php';
include 'admin/centerOfAdmin.php';
if (isset($_GET['catId'])) {
  $category_id = $_GET['catId'];
  // $recordPost = new fetchAllPost();
  // $recordPost = $recordPost->fetchAllPosts();
  $fCatPosts = new fetchPostCat($category_id);
  $fetchCatPosts = $fCatPosts->fetchCatPost();

  $authorOfPost = new DataFetcher();
  $catOfPost = new DataFetcher();
  $catOfPostForHeader = new DataFetcher();
  $catOfPostForHeader = $catOfPostForHeader->fetchData('category',$category_id);
  // echo "All data are:" . var_dump($fetchCatPosts);
  // foreach($fetchCatPosts as $record){
  //   echo 'data is: ' . $record['id'];
  //   echo 'title is: ' . $record['title'];
  //   echo 'body is:  ' . $record['body'];
  // }
}else{
  echo "Id is not set that't why there is so much problem";
}
?>
  <header class="w-100 d-flex justify-content-center align-items-center mb-5 shadow bg-gradient p-5 fw-bold">
    <h2 class="fw-bold catHeader"><?= $catOfPostForHeader['title'] ?></h2>
  </header>
  <div class="container mt-4 mb-5 shadow">
    <!-- card container -->
    <div class="container_blog py-4 bg-light">
      <!-- card 1 -->
      <?php foreach ($fetchCatPosts as $record) {
        $authorId =  $record['author_id'];
        $catId = $record['category_id'];
        $authorData = $authorOfPost->fetchData('users', $authorId);
        $catOfData = $catOfPost->fetchData('category', $catId); ?>
        <div class="courses_card">
          <div class="course_img">
            <div class="img"><img src="images/<?= $record['thumbnail'] ?>" alt=""></div>
          </div>
          <div class="course-description">
            <h3><a href="<?= ROOT_URL ?>blog.php?blogId=<?=$record['id'] ?>" class="text-decoration-none text-dark"><?= substr($record['title'], 0, 60) ?>....</a></h3>
            <div class="post__author">
              <div class="post__author__avatar">
                <img src="images/<?= $authorData['avatar']  ?>" alt="" class="rounded-5">
              </div>
              <div class="post__author_info">
                <h5 class="">By: <?= $authorData['firstname'] . ' ' . $authorData['lastname'] ?></h5>
                <small><?= $record['date_time'] ?></small>
              </div>
            </div>

          </div>
        </div>
      <?php } ?>
    </div>
  </div>
  <!-- <button class="btn btn-primary">Explore More</button> -->
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
