<div class="courses_card">
        <div class="course_img">
          <div class="img"><img src="images/<?= $record['thumbnail'] ?>" alt=""></div>
        </div>
        <div class="course-description">
          <h3><a href="<?= ROOT_URL?>blog.php?blogId = <?= $record['id']?>" class="text-decoration-none text-dark"><?= substr($record['title'],0,60) ?>....</a></h3>
          <div class="post__author">
            <div class="post__author__avatar">
              <img src="images/<?= $authorData['avatar']  ?>" alt="" class="rounded-5">
            </div>
            <div class="post__author_info">
              <h5 class="">By:  <?= $authorData['firstname'] . ' ' .$authorData['lastname']?></h5>
              <small><?= $record['date_time'] ?></small>
            </div>
          </div>
          <button class="btn btn-primary fw-bold"><a href="<?= ROOT_URL?>categoryposts.php?cat = <?= $catOfData['id']?>" class="text-light text-decoration-none"><?= $catOfData['title'] ?></a></button>
        </div>
        <!-- <a href="<?= ROOT_URL?>categoryposts.php?catId = <?= $catOfData['id']?>"><?= $catOfData['title'] ?></a> -->
      </div>