<?php
include 'partials/header.php';
include 'admin/controlllerOfAdmin.php';
    $recordPost = new fetchAllPost();
    $recordPost = $recordPost->fetchAllPosts();
    $authorOfPost = new DataFetcher();
    $catOfPost = new DataFetcher();
    $fetCat = new fetchCategoryData();
    $records = $fetCat->fetchCatData();
?>
  <div id="container">
    <div id="container2">
      <div id="section1">
        <h1 id="title" class="text-warning">Read Your Favourite Blogs</h1>
        <p id="para">
          consequuntur quaerat unde quis in a doloribus sequi libero dicta.
          Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab tenetur
          dignissimos quibusdam dicta aperiam obcaecati fugiat eligendi,
          quisquam est distinctio!
        </p>
      </div>
      <div>
        <button class="btn-main"><span></span>Start Reading</button>
      </div>
    </div>
  </div>
  <div class="container mt-4">
    <div>
      <h1 class="fw-bold mt-5 text-center">BLOGS</h1>
    </div>
    <div class="d-flex justify-content-evenly mt-5">
      <?php  foreach($records as $record){ ?>
      <!-- <button type="button" class="btn btn-orange  px-4 py-2 rounded-2 fw-bold"><?= $record['title']?></button> -->
      <button class="btn btn-dark  px-4 py-2 rounded-2 fw-bold"><a href="<?= ROOT_URL?>categoryposts.php?catId=<?=$record['id'] ?>" class="text-light text-decoration-none"><?= $record['title'] ?></a></button>
      <?php } ?>
    </div>
    <!-- card container -->
    <div class="container_blog py-4">
    <?php  foreach($recordPost as $record){ 
         $authorId =  $record['author_id'];
         $catId = $record['category_id'];
         $authorData = $authorOfPost->fetchData('users',$authorId);
         $catOfData = $catOfPost->fetchData('category',$catId);
        //  $catData = new fetchCategoryData();
        //  $categoryData = $catData->fetchCatData();
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
              <small><?= date("M d, Y - H:i", strtotime($record['date_time'])) ?></small>
            </div>
          </div>
          <!-- <button class="btn btn-dark  px-4 py-2 rounded-2 fw-bold"><a href="<?= ROOT_URL?>categoryposts.php?catId=<?=$record['id'] ?>" class="text-light text-decoration-none"><?= $record['title'] ?></a></button> -->
          <button class="btn btn-primary fw-bold"><a href="<?= ROOT_URL?>categoryposts.php?catId=<?=$record['category_id'] ?>" class="text-light text-decoration-none"><?= $catOfData['title'] ?></a></button>


          
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
  <section class="contact mt-5 mb-5 bg-primary">
    <div class="contact_text">
      <div class="contact_items">
        <h2 class="text-light">Contact Us</h2>
        <input type="text" placeholder="Your Name...">
        <input type="text" placeholder="Your Email...">
        <textarea cols="20" rows="20" placeholder="Your message here..."></textarea>
        <a href="#">Submit</a>
      </div>
    </div>
  </section>
  <!-- <button class="btn btn-primary">Explore More</button> -->
  </div>
  <section id="About_me_sec">
    <div id="About_me">
      <div id="About_me_div1">
        <img src="../../pics/udemy29.jpg" alt="" class="About_me_img" />
        <div id="frame_div"></div>
      </div>
      <div id="About_me_div2">
        <h1 id="About_me_heading">About <span>Us</span></h1>
        <h5>Front End Developer</h5>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero,
          delectus? Aliquid odit hic provident impedit, voluptates iure! Illo
          quod itaque iste soluta saepe quisquam eos cumque harum provident,
          perspiciatis labore fugiat sequi sint quas, at odio adipisci
          sapiente officia temporibus.
        </p>
        <button id="About_me_btn">Download Resume</button>
      </div>
      <!-- </div> -->
  </section>
  <?php
  include 'partials/footer.php';
  ?>
  <script>
    const avatar = document.querySelector('.avatar');
    // const avater_part_con = document.querySelector('ul.avatar-part-con');
    // console.log(avater_part_con);
    document.addEventListener("DOMContentLoaded", function () {
    const avater_part_con = document.querySelector('ul.avatar-part-con');
    console.log(avater_part_con);
    // avater_part_con.classList.add("authenticated");
    avatar.addEventListener('click', () => {
      console.log("hello");
      avater_part_con.classList.toggle('hide');
    });
  // Your JavaScript code here
     });

    console.log(document.querySelector('#logo'));
    console.log(document.querySelector('.nav-profile'));
    const fa_times = document.querySelector('nav .fa-times');
    
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
<!-- </body>

</html> -->