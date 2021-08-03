<?php include("head.php")?>
<?php
    $conn = "";
    try {
        $servername = "localhost:3306";
        $dbname = "e-commerce";
        $username = "root";
        $password = "";
          
        $conn = mysqli_connect($servername ,$username,$password,$dbname);
    }
    catch(Exception $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    $user=$_SESSION['username'];
    $o = $conn->query("SELECT * FROM login where username like '".$user."'");
    $profile = $o->fetch_assoc();
?>
<html>
    <body>
        <div class="card text-center" style="padding:40px 10px 0px 10px;">
        <div class="card-header">
            <h1><b>Profile</b></h1>
        </div>
        <div class="card-body">
            <h3 class="card-title"><?php echo $profile["name"]; ?></h3>
            <h6>Username : <?php echo $profile['username']?></h6>
            <h6>Address : <?php echo $profile['address']?></h6>
            <h6>Contact : <?php echo $profile['phone']?></h6>
            <p></p>
            <a href="profile_update.php" class="btn btn-primary">Update</a>
        </div>
        </div>
    </body>
</html>