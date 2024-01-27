<?php
include 'partials/header.php';
include 'admin/controlllerOfAdmin.php';
// fetching data for featured post
  $isFeath = 'is_featured';
  $fetchPost = new fetchPost($isFeath,1);
  $featuredRecord = $fetchPost->fetchingPost();
  $author_id = $featuredRecord['author_id'];
  $cat_id = $featuredRecord['category_id'];
  $fetchAuthor = new DataFetcher();
   $fetchAuthor =  $fetchAuthor->fetchData('users', $author_id);
   $fetchCater = new DataFetcher();
   $fetchCat = $fetchCater->fetchData('category',$cat_id);
// fetching data for All posts
    $recordPost = new fetchAllPost();
    $recordPost = $recordPost->fetchAllPosts();
    $authorOfPost = new DataFetcher();
    $catOfPost = new DataFetcher();
    ?>

  <div class="bg-black">
  </div>
  <!-- featured Blog-->
  <div class="container_feature d-flex justify-content-center container">
    <div class="featured_img">
      <img src="images/<?= $featuredRecord['thumbnail']?>" alt="">
    </div>
    <div class="featured-description text-start mt-3">
    <h3><a href="<?= ROOT_URL?>blog.php?blogId=<?=$featuredRecord['id']?>" class="text-decoration-none text-dark"><?= substr($featuredRecord['title'],0,60) ?>....</a></h3>
      <p class="fs-6 featured_post"><?= substr($featuredRecord['body'],0,300) ?>....</p>
      <div class="post__author">
        <div class="post__author__avatar">
          <img src="images/<?= $fetchAuthor['avatar'] ?>" alt="" class="rounded-5">
        </div>
        <div class="post__author_info">
          <h5 class="mb-1 fw-bold">By: <?= $fetchAuthor['firstname'] . ' ' .$fetchAuthor['lastname']?><h5>
          <small><?= $featuredRecord['date_time'] ?></small>
        </div>
      </div>
      <button class="btn btn-primary fw-bold mb-5"><a href="<?= ROOT_URL?>categoryposts.php?catId=<?= $fetchCat['id']?>" class="text-light text-decoration-none"><?= $fetchCat['title'] ?></a></button>
      <button class="btn btn-primary fw-bold mb-5 mx-3"><a href="<?= ROOT_URL?>/blog.php?blogId=<?=$featuredRecord['id'] ?>" class="text-light text-decoration-none">Read More</a></button>
    </div>
  </div>
  <!-- <div class="blogs_con d-flex justify-content-center align-items-center mb-5 flex-column">
    <div id="searchbar">
      <input type="text" id="text" class="active p-4 rounded-4 shadow-none" placeholder="Search" />
      <i class="fa fa-search" aria-hidden="true"></i>
    </div>
  </div> -->
    <section class="mb-5 mt-5">
      <form action="<?= ROOT_URL?>search.php" method="GET" class="blogs_con d-flex justify-content-center align-items-center mb-5 flex-column">
        <div id="searchbar">
          <input type="search" id="text" class="active p-4 rounded-5 shadow-none" placeholder="Search" name="search" />
          <button type="submit" class="btn" name="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
      </form>
    </section>
    <!-- <div class="all_blogs"> -->
    <div class="d-flex justify-content-center align-items-center mb-5 container_blog container p-5">
      <!-- card 1 -->
      <!-- card 1 -->
       <?php  foreach($recordPost as $record){ 
         $authorId =  $record['author_id'];
         $catId = $record['category_id'];
         $authorData = $authorOfPost->fetchData('users',$authorId);
         $catOfData = $catOfPost->fetchData('category',$catId);
        //  echo 'category id is: ' . $catOfData['id'];
        //  echo "category id through record: " .$record['category_id'];
        ?>
         <div class="courses_card">
        <div class="course_img">
          <div class="img"><img src="images/<?= $record['thumbnail'] ?>" alt=""></div>
        </div>
        <div class="course-description">
          <h3><a href="<?= ROOT_URL?>blog.php?blogId=<?=$record['id']?>" class="text-decoration-none text-dark"><?= substr($record['title'],0,60) ?>....</a></h3>
          <div class="post__author">
            <div class="post__author__avatar">
              <img src="images/<?= $authorData['avatar']  ?>" alt="" class="rounded-5">
            </div>
            <div class="post__author_info">
              <h5 class="">By:  <?= $authorData['firstname'] . ' ' .$authorData['lastname']?></h5>
              <small><?= $record['date_time'] ?></small>
            </div>
          </div>
          <button class="btn btn-primary fw-bold"><a href="<?= ROOT_URL?>categoryposts.php?catId=<?=$record['category_id'] ?>" class="text-light text-decoration-none"><?= $catOfData['title'] ?></a></button>
        </div>
      </div>
      <?php     } ?>
      </div>
    </div>
  </div>
  <?php
  include 'partials/footer.php'; ?>
  <script src="main.js"></script>
</body>

</html>