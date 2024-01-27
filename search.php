<?php
include 'partials/header.php';
include 'admin/controlllerOfAdmin.php';
if (isset($_GET['search']) && isset($_GET['submit'])) {
  $search = $_GET['search'];
  $recordPost = new search($search);
  $recordPosted = $recordPost->getSearch();
  // $recordPosting = $recordPost->getShow();
  $authorOfPost = new DataFetcher();
  $catOfPost = new DataFetcher();
  // var_dump($recordPost);
  // header('location: search.php');
}

?>
<section class="searchSec d-flex justify-content-center align-items-center container">
  <!-- <div class="d-flex justify-content-center align-items-center mb-5 container_blog container p-5"> -->
  <!-- card container -->
  <div class="container_blog py-4 bg-light">
    <!-- card 1 -->

    <?php if (!empty($recordPosted)) {
      foreach ($recordPosted as $record) {
        $authorId =  $record['author_id'];
        $catId = $record['category_id'];
        $authorData = $authorOfPost->fetchData('users', $authorId);
        $catOfData = $catOfPost->fetchData('category', $catId);
        //  echo 'category id is: ' . $catOfData['id'];
        //  echo "category id through record: " .$record['category_id'];
    ?>
        <div class="courses_card">
          <div class="course_img">
            <div class="img"><img src="images/<?= $record['thumbnail'] ?>" alt=""></div>
          </div>
          <div class="course-description">
            <h3><a href="<?= ROOT_URL ?>blog.php?blogId=<?= $record['id'] ?>" class="text-decoration-none text-dark"><?= substr($record['title'], 0, 60) ?>....</a></h3>
            <div class="post__author">
              <div class="post__author__avatar">
                <img src="images/<?= $authorData['avatar']  ?>" alt="" class="rounded-5">
              </div>
              <div class="post__author_info">
                <h5 class="">By: <?= $authorData['firstname'] . ' ' . $authorData['lastname'] ?></h5>
                <small><?= $record['date_time'] ?></small>
              </div>
            </div>
            <button class="btn btn-primary fw-bold"><a href="<?= ROOT_URL ?>categoryposts.php?catId=<?= $record['category_id'] ?>" class="text-light text-decoration-none"><?= $catOfData['title'] ?></a></button>
          </div>
        </div>
      <?php     }
    } else { ?>
       <div class="errorSearch">
      <h4 class="text-danger fw-bold bg-danger text-light p-2">No search result found!</h4> </div> <?php  } ?>
  </div>
  </div>
</section>
<!-- <button class="btn btn-primary">Explore More</button> -->
<?php include 'partials/footer.php'; ?>