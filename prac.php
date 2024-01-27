<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:ital,wght@0,500;0,600;0,900;1,500;1,800;1,900&family=Dancing+Script:wght@400;500;600;700&family=Fuzzy+Bubbles:wght@400;700&family=Great+Vibes&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Oswald:wght@200;300&family=Pacifico&family=Poppins:ital,wght@0,300;1,300&display=swap">
  <title>Responsive Multipage Blog Website</title>
  <style>
  </style>
</head>

<body>

  <header class="w-100 d-flex justify-content-center align-items-center mb-5 shadow bg-gradient p-5 fw-bold">
    <h1>Category Title</h1>
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
            <h3><a href="<?= ROOT_URL ?>blog.php?blogId = <?= $record['id'] ?>" class="text-decoration-none text-dark"><?= substr($record['title'], 0, 60) ?>....</a></h3>
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