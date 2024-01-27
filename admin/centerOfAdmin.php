<?php
class usersAdd extends Dbh
{
    protected function setUser($firstName, $lastName, $userName, $email, $password, $avatar, $admin)
    {
        $code = 0;
        $status = "verified";
        $stmt = $this->connect()->prepare('INSERT INTO users (firstname,lastname,username,email,password,avatar,is_admin,status,code) VALUES(?,?,?,?,?,?,?,?,?)');
        $hashedPwd = password_hash($password, PASSWORD_BCRYPT);
        if (!$stmt->execute(array($firstName, $lastName, $userName, $email, $hashedPwd, $avatar, $admin, $status, $code))) {
            $stmt = null;
            $_SESSION['add-user'] = "Some error to proceed";
            // exit();
        } else {
            unset($_SESSION['adding-all-data']);
            $_SESSION['add-user-success'] = "Successfully added";
            echo $_SESSION['add-user-success'];
            header('location: manage-users.php');
        }
        $stmt = null;
    }
    protected function checkUser($email)
    {
        $stmt = $this->connect()->prepare('SELECT COUNT(*) FROM users WHERE email = ?');
        if (!$stmt->execute(array($email))) {
            $stmt = null;
        }
        $resultCheck = false;
        if ($stmt->fetchColumn() > 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }
        return $resultCheck;
    }
}
class addUserControll extends usersAdd
{
    private $firstName;
    private $lastName;
    private $userName;
    private $email;
    private $password;
    private $cPassword;
    private $avatar;
    private $is_admin;
    public function __construct($firstName, $lastName, $userName, $email, $password, $cPassword, array $avatar, $is_admin)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->userName = $userName;
        $this->email = $email;
        $this->password = $password;
        $this->cPassword = $cPassword;
        $this->avatar = $avatar;
        $this->is_admin = $is_admin;
    }
    public function showDATA()
    {
        echo "All data are: {$this->userName} {$this->email} {$this->password} {$this->cPassword} {$this->firstName} {$this->lastName} and now is admin {$this->is_admin} and avatar is {$this->avatar['name']}";
        // echo var_dump($this->avatar);
    }
    public function addingUser()
    {
        $res = $this->emptyInput();
        if (!$res == false) {
            $_SESSION['add-user'] = $res;
        } elseif ($this->invalidUserId() == false) {
            $_SESSION['add-user'] = "Invalid user name";
        } elseif ($this->invalidEmail() == false) {
            // echo empty input
            $_SESSION['add-user'] = "Invalid email";
            // session_destroy();
            // exit();
        } elseif ($this->pwdMatch() == false) {
            // echo password mismatch
            $_SESSION['add-user'] = "Password mismatched";
            // exit();
        } elseif ($this->userTakenCheck() == false) {
            $_SESSION['add-user'] = "already added";
            // exit();
        }
        // elseif {
        else {
            $avatar_name = $this->avatarValidation();
            if ($avatar_name) {
                echo "hello successfullly";
                $this->setUser($this->firstName, $this->lastName, $this->userName, $this->email, $this->password, $avatar_name, $this->is_admin);
            }
        }
    }
    private function emptyInput()
    {
        $result = '';
        if (empty($this->firstName)) {
            $result = "first name is required";
        } elseif (empty($this->lastName)) {
            $result = "last name is required";
        } elseif (empty($this->userName)) {
            $result = "username is required";
        } elseif (empty($this->email)) {
            $result = "email is required";
        } elseif (empty($this->password)) {
            $result = "password is required";
        } elseif (empty($this->cPassword)) {
            $result = "confirm password is required";
        } elseif (empty($this->avatar['name'])) {
            $result = "avatar is required";
        } else {
            $result = false;
        }
        return $result;
    }

    private function invalidUserId()
    {
        $result = '';
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->userName)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    private function invalidEmail()
    {
        $result = '';
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    private function pwdMatch()
    {
        $result = '';
        if ($this->password == $this->cPassword) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function userTakenCheck()
    {
        $result = false;
        if (!$this->checkUser($this->email)) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }
    private function avatarValidation()
    {
        // work on avatar
        $time = time(); //make each image unique using current timestamp
        $avatar_name = $time . $this->avatar['name'];
        $avatar_tmp_name = $this->avatar['tmp_name'];
        // $folder_save = './images/';
        $folder_save = '../images/';
        $avatar_destination_path = $folder_save . $avatar_name;
        // make sure file is in image
        $allowed_files = ['png', 'jpg', 'jpeg'];
        $extension = explode('.', $avatar_name);
        $extension = end($extension);
        if (in_array($extension, $allowed_files)) {
            // make sure image is not too large (1mb+)
            if ($this->avatar['size'] < 1000000) {
                move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                return $avatar_name;
            } else {
                $_SESSION['add-user'] = 'File size is too big. Should be less than 1mb';
            }
        } else {
            $_SESSION['add-user'] = 'File should be png, jpg or jpeg';
            return false;
        }
    }
}


?>
<?php
// if(isset($_SESSION['user_id'])){

// } 
class fetchAddUserData extends Dbh
{
    public function fetchUserData()
    {
        $current_admin_id = $_SESSION['user_id'];
        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE NOT  id = ?");
        $stmt->execute(array($current_admin_id));
        if ($stmt) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return "asma";
        }
    }
}
?>
<!-- editting user -->
<?php
class DataFetcher extends Dbh
{
    public function fetchData($table, $userId)
    {
        $query = "SELECT * FROM $table WHERE id = :userId";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
}

?>
<?php
class persistData extends Dbh
{
    private $user_id;
    function __construct($user_id)
    {
        $this->user_id = $user_id;
    }
    function toShowId()
    {
        echo $this->user_id;
    }
    function toShow()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute(array($this->user_id));
        if ($stmt) {
            $record = $stmt->fetch(PDO::FETCH_ASSOC);
            return $record;
            //   echo $record['firstname'];
            //   echo $record['lastname'];
        } else {
            $_SESSION['persistDataError'] = "Something went wrong";
        }
    }
}
class edit extends Dbh
{
    private $firstName;
    private $lastName;
    private $is_admin;
    private $user_id;
    function __construct($firstName, $lastName, $is_admin, $user_id)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->is_admin = $is_admin;
        $this->user_id = $user_id;
    }
    function updation()
    {
        if ($this->emptyInput() == false) {
            $_SESSION['updateError'] = "Invalid Form Input";
        } elseif ($this->invalidInput() == false) {
            $_SESSION['updateError'] = "only characters allow";
        } elseif ($this->updateData() == false) {
            $_SESSION['updateError'] = "There is an error to update the data!";
        } else {
            $_SESSION['add-user-success'] = "Data is updated successfullly!";
            header('location: manage-users.php');
        }
    }
    function emptyInput()
    {
        if (!$this->firstName || !$this->lastName) {
            // $_SESSION['updateError'] = "Invalid Form Input!";
            return false;
        } else {
            return true;
        }
    }
    function invalidInput()
    {
        $pattern = '/^[A-Za-z]+$/';
        if (preg_match($pattern, $this->firstName) and preg_match($pattern, $this->lastName)) {
            return true;
        } else {
            return false;
        }
    }
    function updateData()
    {
        $stmt = $this->connect()->prepare('UPDATE users SET firstName = ?, lastName = ?, is_admin = ? WHERE id = ? LIMIT 1');
        $stmt->execute(array($this->firstName, $this->lastName, $this->is_admin, $this->user_id));
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }
}
?>
<!-- deleting user -->
<?php
class userDelete extends Dbh
{
    private $user_id;
    function __construct($user_id)
    {
        $this->user_id = $user_id;
    }
    function deleteAvatar()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute(array($this->user_id));
        if ($stmt) {
            $record = $stmt->fetch(PDO::FETCH_ASSOC);
            $avatar = $record['avatar'];
            $avatar_path = '../images/' . $avatar;
            // delete image if available
            if ($avatar_path) {
                unlink($avatar_path);
            }
        } else {
            echo "something went wrong";
        }
    }
    function deleteUser()
    {
        $stmt = $this->connect()->prepare('DELETE FROM users WHERE id = ?');
        $stmt->execute(array($this->user_id));
        if ($stmt) {
            $_SESSION['deleteSuccess'] = "Successfully deleted";
        } else {
            $_SESSION['deleteError'] = "Couldn't delete user";
        }
    }
}
// adding category in database
class addCategory extends Dbh
{
    protected $title;
    protected $description;
    function __construct($title, $description)
    {
        $this->title = $title;
        $this->description = $description;
    }
    function Insertcategory()
    {
        $res = $this->isEmpty();
        if ($res) {
            $_SESSION['categoryAddError'] = $res;
        } elseif ($this->invalidInput() == false) {
            $_SESSION['categoryAddError'] = "Invalid input";
        } elseif ($this->catAlreadyInDb() == true) {
            $_SESSION['categoryAddError'] = "Category already exists!";
        } elseif ($this->categoryIntoDatabase() == false) {
            $_SESSION['categoryAddError'] = "Category couldn't add";
        } else {
            $_SESSION['categoryAdd'] = "category added successfully";
            header('location: manage-categories.php');
        }
    }
    function isEmpty()
    {
        if (empty($this->title)) {
            $result = "title is required";
        } elseif (empty($this->description)) {
            $result = "description is required";
        } else {
            $result = false;
        }
        return $result;
    }
    function invalidInput()
    {
        // $pattern = '/^[A-Za-z]+$/';
        // $pattern = '/^[a-zA-Z0-9+]+$/';
        $pattern = '/^[a-zA-Z0-9+\s]+$/';
        if (preg_match($pattern, $this->title) && preg_match($pattern, $this->description)) {
            return true;
        } else {
            return false;
        }
    }
    function catAlreadyInDb()
    {
        $stmt = $this->connect()->prepare('SELECT EXISTS(SELECT * FROM category WHERE title = ?) AS `exists`');
        // $stmt->bindParam(':title', $title);
        $stmt->execute(array($this->title));

        if ($stmt) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['exists'] == 1; // Return true if exists is 1, indicating record exists
        } else {
            // return false;
            echo "some problem";
        }
    }

    function categoryIntoDatabase()
    {
        $stmt = $this->connect()->prepare('INSERT INTO category (title,description) VALUES (?,?)');
        $stmt->execute(array($this->title, $this->description));
        if ($stmt) {
            return true;
        } else {
            echo "some problem";
        }
    }
}
?>
<!-- data is fetching -->
<?php
class fetchCategoryData extends Dbh
{
    public function fetchCatData()
    {
        $stmt = $this->connect()->prepare("SELECT * FROM category");
        $stmt->execute();
        if ($stmt) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
}
?>
<!-- edit category -->
<?php
class updateCat extends addCategory
{
    public function updationInCategory($catId)
    {
        $res = $this->isEmpty();
        if ($res) {
            $_SESSION['updateCatError'] = $res;
        } elseif ($this->invalidInput() == false) {
            $_SESSION['updateCatError'] = "Invalid input";
        } elseif ($this->catAlreadyInDb() == true) {
            $_SESSION['updateCatError'] = "Category already exists!";
        } elseif ($this->updateCatData($catId) == false) {
            $_SESSION['updateCatError'] = "Category couldn't update";
        } else {
            $_SESSION['categoryUpdated'] = "category updated successfully!";
            header('location: manage-categories.php');
        }
    }
    function updateCatData($catId)
    {
        $stmt = $this->connect()->prepare('UPDATE category SET title = ?,description = ? WHERE id = ? LIMIT 1');
        $stmt->execute(array($this->title, $this->description, $catId));
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }
    function catAlreadyInDb()
    {
        $id = $_SESSION['edit-cat-id'];
        $stmt = $this->connect()->prepare('SELECT EXISTS(SELECT * FROM category WHERE title = ? AND id <> ?) AS `exists`');
        // $stmt->bindParam(':title', $title);
        $stmt->execute(array($this->title, $id));

        if ($stmt) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['exists'] == 1; // Return true if exists is 1, indicating record exists
        } else {
            // return false;
            echo "some problem";
        }
    }
}
// delete category
class catDelete extends Dbh
{
    private $cat_id;
    function __construct($cat_id)
    {
        $this->cat_id = $cat_id;
    }
    function deleteCat()
    {
        $stmt = $this->connect()->prepare("UPDATE post SET category_id = 23 WHERE category_id = ?");
        $stmt->execute(array($this->cat_id));
        if ($stmt) {
            $stmt = null;
            $stmt = $this->connect()->prepare('DELETE FROM category WHERE id = ?');
            $stmt->execute(array($this->cat_id));
            if ($stmt) {
                $_SESSION['deleteCat'] = "Successfully deleted";
            } else {
                $_SESSION['deleteCatError'] = "Couldn't delete cat";
            }
        } else {
            echo "there is some problem in processing or may be in query";
        }
    }
}
?>
<!-- Add Post -->
<?php
class post extends Dbh
{
    protected $authorId;
    protected $posTitle;
    protected $postCat;
    protected $post;
    protected $isFeatured;
    protected $thumbnail;
    public function __construct($authorId, $postTitle, $postCat, $post, $isFeatured, array $thumbnail)
    {
        $this->authorId = $authorId;
        $this->posTitle = $postTitle;
        $this->postCat = $postCat;
        $this->post = $post;
        $this->isFeatured = $isFeatured;
        $this->thumbnail =  $thumbnail;
    }
    function postDataIntoDatabase()
    {
        $res = $this->toEmpty();
        echo "result is " . $res;
        if ($res) {
            $_SESSION['postSesstionError'] = $res;
        } elseif ($this->validateInput() == false) {
            $_SESSION['postSesstionError'] = "Invalid Input!";
        }
        //    elseif($this->isPostExists()==true){
        //     $_SESSION['postSesstionError'] = "Post already exists!";
        //    }
        else {
            $returnRes = $this->validThumbnail();
            if ($returnRes == 1) {
                $_SESSION['postSesstionError'] = "File size is too big. Should be less than 1mb";
            } elseif ($returnRes == 2) {
                $_SESSION['postSesstionError'] = "File should be png, jpg or jpe";
            } else {
                $this->thumbnail = $returnRes;
                if ($this->postInsertInDb() == true) {
                    $_SESSION['postInsertSuccess'] = "post is inserted successfully!";
                    header('location: dashboard.php');
                } else {
                    $_SESSION['postSesstionError'] = "unsuccessful post creation!";
                }
            }
        }
    }
    protected function toEmpty()
    {
        $res = false;
        if (!$this->posTitle) {
            $res = 'Title is required';
        } elseif (!$this->post) {
            $res = 'Post is required';
        } elseif (empty($this->thumbnail['name'])) {
            $res = 'thumbnail is required';
        }
        return $res;
    }
    protected function validateInput()
    {
        // Regular expression pattern to match characters alone or a combination of numbers and characters
        $pattern = '/^(?=.*[a-zA-Z])[a-zA-Z\s\d\W]+$/';

        if (preg_match($pattern, $this->posTitle) && preg_match($pattern, $this->post)) {
            // Input is valid, it contains characters alone or a combination of numbers and characters
            return true;
        } else {
            // Input is invalid, it doesn't meet the required pattern
            return false;
        }
    }
    protected function isPostExists()
    {
        $query = "SELECT COUNT(*) FROM post WHERE title = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($this->posTitle));
        $count = $stmt->fetchColumn();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }
    protected function validThumbnail()
    {
        $error = false;
        // work on avatar
        $time = time(); //make each image unique using current timestamp
        $thumbnailName = $time . $this->thumbnail['name'];
        $thumbnail_tmp_name = $this->thumbnail['tmp_name'];
        $folder_save = '../images/';
        $thumbnail_destination_path = $folder_save . $thumbnailName;
        // make sure file is in image
        $allowed_files = ['png', 'jpg', 'jpeg'];
        $extension = explode('.', $thumbnailName);
        $extension = end($extension);
        if (in_array($extension, $allowed_files)) {
            // make sure image is not too large (1mb+)
            if ($this->thumbnail['size'] < 2_000_000) {
                move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
            } else {
                $error = 1;
            }
        } else {
            $error = 2;
        }
        if ($error) {
            return $error;
        } else {
            return $thumbnailName;
        }
    }
    function postInsertInDb()
    {
        if ($this->isFeatured == 1) {
            $zeroAllFeaturedQuery = $this->connect()->prepare('UPDATE post SET is_featured = ?');
            $zeroAllFeaturedQuery->execute(array(0));
            if (!$zeroAllFeaturedQuery) {
                echo "some problem to update post isFeatured";
            }
        }
        $stmt = $this->connect()->prepare('INSERT INTO post (title,body,thumbnail,category_id,author_id,is_featured) VALUES(?,?,?,?,?,?)');
        $stmt->execute(array($this->posTitle, $this->post, $this->thumbnail, $this->postCat, $this->authorId, $this->isFeatured));
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }
}
?>
<!-- fetching data from post table -->
<?php
class postDataFetch extends Dbh
{
    private  $current_user_id;
    function __construct($current_user_id)
    {
        $this->current_user_id = $current_user_id;
    }
    // function userId(){
    //     echo "user id is: " . $this->current_user_id;
    // }
    function postFetching()
    {
        $stmt = $this->connect()->prepare('SELECT post.title AS ptitle, category.title AS ctitle,post.id FROM post
        JOIN category ON post.category_id = category.id WHERE post.author_id = ?');
        $stmt->execute(array($this->current_user_id));
        if ($stmt) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
            //  return true;
        } else {
            echo "HELLO BUDDIES";
            return array();
            // exit;
        }
    }
}
class postEdit extends post
{
    private $postId;
    public function __construct($postId, $authorId, $postTitle, $postCat, $post, $isFeatured, array $thumbnail)
    {
        parent::__construct($authorId, $postTitle, $postCat, $post, $isFeatured, $thumbnail);
        $this->postId = $postId;
    }
    //    public function toShow(){
    //         echo $this->authorId;;
    //         echo $this->posTitle;
    //         echo $this->postCat;
    //         echo $this->post;
    //         echo $this->isFeatured;
    //         echo $this->thumbnail['name'];
    //         echo $this->postId;
    //     }
    public function postDataEdit()
    {
        $res = $this->toEmpty();
        echo "result is " . $res;
        if ($res) {
            $_SESSION['postUpdateError'] = $res;
        } elseif ($this->validateInput() == false) {
            $_SESSION['postUpdateError'] = "Invalid Input!";
        } else {
            $returnRes = $this->validThumbnail();
            if ($returnRes == 1) {
                $_SESSION['postUpdateError'] = "File size is too big. Should be less than 1mb";
            } elseif ($returnRes == 2) {
                $_SESSION['postUpdateError'] = "File should be png, jpg or jpe";
            } else {
                $this->thumbnail = $returnRes;
                if ($this->updatePostData() == true) {
                    $_SESSION['postUpdateSuccess'] = "post is updated successfully!";
                    header('location: dashboard.php');
                } else {
                    $_SESSION['postUpdateError'] = "unsuccessful post updation!";
                }
            }
        }
    }
    private function  updatePostData()
    { {
            if ($this->isFeatured == 1) {
                $zeroAllFeaturedQuery = $this->connect()->prepare('UPDATE post SET isFeatured = ?');
                $zeroAllFeaturedQuery->execute(array(0));
                if (!$zeroAllFeaturedQuery) {
                    echo "some problem to update post isFeatured";
                }
                die();
            }
            if ($this->thumbnail) {
                $folder_save = '../images/';
                $prevThumb = $_SESSION['previousThumbnail'];
                $preThumbPath = $folder_save . $prevThumb;
                if ($preThumbPath) {
                    unlink($preThumbPath);
                }
            }
            // UPDATE `post` SET `title` = 'java is super amazing language ever love you', `body` = 'jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj llll', `category_id` = '20', `is_featured` = '1' WHERE `post`.`id` = 5;
            $stmt = $this->connect()->prepare('UPDATE post SET title = ?, body = ?, category_id=?, thumbnail  = ?, is_featured = ? WHERE id = ?   LIMIT 1');
            $stmt->execute(array($this->posTitle, $this->post, $this->postCat, $this->thumbnail, $this->isFeatured, $this->postId));
            if ($stmt) {
                return true;
            } else {
                return false;
            }
        }
    }
}
class deletePost extends Dbh
{
    private $id;
    function __construct($idDel)
    {
        $this->id = $idDel;
    }
    function deleteThumbnail()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM post WHERE id = ?');
        $stmt->execute(array($this->id));
        if ($stmt) {
            $record = $stmt->fetch(PDO::FETCH_ASSOC);
            $thumb = $record['thumbnail'];
            $thumb_path = '../images/' . $thumb;
            // delete image if available
            if ($thumb_path) {
                unlink($thumb_path);
            }
        } else {
            echo "something went wrong";
        }
    }
    function delpost()
    {
        $stmt = $this->connect()->prepare('DELETE FROM post WHERE id = ?');
        $stmt->execute(array($this->id));
        if ($stmt) {
            $_SESSION['deletePostSuccess'] = "Successfully deleted";
        } else {
            $_SESSION['deletePostError'] = "Couldn't delete post!";
        }
    }
}
class thumDELUserDel extends Dbh
{
    private $author_id;
    function __construct($authorId)
    {
        $this->author_id = $authorId;
    }
    function delThumb()
    {
        $stmt = $this->connect()->prepare('SELECT thumbnail from post where author_id = ?');
        $stmt->execute(array($this->author_id));
        if ($stmt) {
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($row as $result) {
                $thumb =  $result['thumbnail'];
                $thumb_path = '../images/' . $thumb;
                // delete image if available
                if ($thumb_path) {
                    unlink($thumb_path);
                }
            }
        }
    }
}
class fetchPost extends Dbh
{
    private $col;
    private $particulaValue;
    function __construct($column, $particulaValue)
    {
        $this->col = $column;
        $this->particulaValue = $particulaValue;
    }
    function fetchingPost()
    {
        $stmt = $this->connect()->prepare("SELECT * from post where {$this->col} = ?");
        $stmt->execute(array($this->particulaValue));
        if ($stmt) {
            $row =  $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        } else {
            echo "ERROR :to execute it";
            die();
        }
    }
}
class fetchAllPost extends Dbh
{
    function fetchAllPosts()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM post');
        $stmt->execute();
        if ($stmt) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "Error executing";
        }
    }
}
class fetchPostCat extends Dbh
{
    private $catId;
    function __construct($catId)
    {
        $this->catId = $catId;
    }
    public function fetchCatPost()
    {
        try {
            $stmt = $this->connect()->prepare('SELECT * FROM post WHERE category_id = ?');
            $stmt->execute([$this->catId]);

            if ($stmt->rowCount() > 0) {
                return  $stmt->fetchAll(PDO::FETCH_ASSOC);
                // echo $ret['title'];
            } else {
                echo "No records found.";
                return [];
            }
        } catch (PDOException $e) {
            echo "Error executing query: " . $e->getMessage();
            return [];
        }
    }
}
?>
<?php
class search extends Dbh
{
    private $keyword;
    function __construct($keyword)
    {
        $this->keyword = $keyword;
    }
    function getShow(){
        echo "show the data " . $this->keyword;
    }
    function getSearch()
    {
        $ser = $this->keyword;
        $stmt = $this->connect()->prepare("SELECT * FROM post WHERE title LIKE :keyword ORDER BY date_time DESC");
        $stmt->bindValue(':keyword', '%' . $ser . '%', PDO::PARAM_STR);
        $stmt->execute();

        // $stmt = $this->connect()->prepare("SELECT * FROM post where title LIKE '%$ser%' ORDER BY date_time DESC");
        // $stmt->execute();
        if ($stmt) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}
?>