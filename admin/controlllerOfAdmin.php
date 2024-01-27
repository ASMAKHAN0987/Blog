<?php
   include 'centerOfAdmin.php';
  if(isset($_POST['add-user'])){
    $_SESSION['adding-all-data'] = $_POST;
    $FirstName = filter_var($_POST['FirstName'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $LastName = filter_var($_POST['LastName'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $Username = filter_var($_POST['Username'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $Email = filter_var($_POST['Email'],FILTER_VALIDATE_EMAIL);
    $Password = filter_var($_POST['Password'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cPassword = filter_var($_POST['cPassword'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES['avatar'];
    $is_admin = filter_var($_POST['user-role'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // making object of add user
    $addUser = new addUserControll($FirstName, $LastName, $Username, $Email, $Password, $cPassword, $avatar , $is_admin);
  $addUser->showDATA();

  $addUser->addingUser();
  }
?>

<!-- fetch user data -->
<?php
  if(isset($_POST['update-user'])){
    // echo "Hello asma khan";
    $firstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $is_admin = $_POST['is_admin'];
    $user_id = $_SESSION['delUser'];
    $updateRecord = new edit( $firstName,$LastName,$is_admin,$user_id);
    $updateRecord->updation();
  }else{
  }

?>
<!--  add category -->
<?php
  if(isset($_POST['add-category'])){
    $_SESSION['category-all-data'] = $_POST;
     $title = $_POST['title'];
     $description = $_POST['title_description'];
     $categoryAdding = new addCategory($title,$description);
     $categoryAdding->Insertcategory();
  }
?>
<?php
   if(isset($_POST['edit-category'])){
    $editId = $_SESSION['edit-cat-id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $updateCategoryData = new updateCat($title,$description);
    $updateCategoryData->updationInCategory($editId);
   }
?>
<?php
  if(isset($_POST['add-post'])){
    echo "data is in controller";
    $_SESSION['post-all-data'] = $_POST; 
    $authorId = $_SESSION['user_id'];
    $posTitle = $_POST['posTitle'];
    $postCat = $_POST['post-cat'];
    $post = $_POST['post'];
    $thumbnail = $_FILES['thumbnail'];
    $isFeatured = $_POST['is_featured'];
    // set isFeatured to 0 if unchecked
    $isFeatured = $isFeatured==1?:0;
    $addingPost = new post($authorId,$posTitle,$postCat,$post,$isFeatured,$thumbnail);
    $addingPost->postDataIntoDatabase();
    if(isset($_SESSION['postSesstionError'])){
    echo "error is :" . $_SESSION['postSesstionError'];
  }
  }
?>
<?php
   if(isset($_POST['edit-post'])){
    echo "data is in controller";
    $postId = $_SESSION['post-id'];
    $_SESSION['post-Edit-data'] = $_POST; 
    $authorId = $_SESSION['user_id'];
    $posTitle = $_POST['posTitle'];
    $postCat = $_POST['post-cat'];
    $post = $_POST['post'];
    $isFeatured = $_POST['is_featured'];
    $thumbnail = $_FILES['thumbnail'];
    $isFeatured = $isFeatured==1?:0;
    $editPost = new postEdit($postId,$authorId,$posTitle,$postCat,$post,$isFeatured,$thumbnail);
    $editPost->postDataEdit();
   }
?>
