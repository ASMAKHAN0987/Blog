  <?php
   class Dbh{
      public function connect(){
        try{
            $username = "root";
            $password = ""; 
            $dbh = new PDO('mysql:host=localhost:3307;dbname=blog',$username,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbh;
        }
        catch(PDOException $e){
             print "Error: connection failed " .$e->getMessage() . "<br/>";
             die();
        }
      }
   }
?>