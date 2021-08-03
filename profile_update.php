<?php include("head.php")?>
<?php
$confirm=0;
if(isset($_POST['name']))
{
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
    $username=$_SESSION['username'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    $phone=$_POST['phone'];
    $name=$_POST['name'];
    $address=$_POST['address'];
    $stmt = $conn->prepare("SELECT * FROM login");
    $stmt->execute();
    $users = $stmt->get_result();
    if($password != $cpassword){
         $msg = "passwords doesn't match";
         $confirm=1;
    }
    else if($confirm==0){
        $sql = "update login set name='".$name."',password='".$password."',phone='".$phone."',address='".$address."' where username like '".$username."'";
        if($conn->query($sql)==true)
        {
            $sup="update supplies set address='".$address."',phone='".$phone."' where name like '".$username."'";
            if($conn->query($sup)==true)
            {
                echo "successful update";
                header("location:profile.php");
            }
        }
    }
    
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="login">
	  <h1>Update Profile</h1>
	    <form method="post">
            <input type="text" name="name" placeholder="name" required="required" />
	        <input type="password" name="password" placeholder="Password" required="required" />
            <input type="password" name="cpassword" placeholder="Confirm Password" required="required" />
            <input type="number" name="phone" placeholder="contact" required="required" />
            <?php
                if($confirm){
                    echo "<p> password is not same";
                }
            ?>
            <input type="textarea" name="address" placeholder="address" required="required" /> 
	        <button type="submit" name="login" class="btn btn-primary btn-block btn-large">Update</button>
	    </form>
	</div>
</div>
</body>
</html>

