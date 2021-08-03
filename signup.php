<?php include('head.php') ?>
<?php
$confirm=0;
$u=0;
if(isset($_POST['username']))
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
    $username=$_POST['username'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    $phone=$_POST['phone'];
    $name=$_POST['name'];
    $address=$_POST['address'];
    $stmt = $conn->prepare("SELECT * FROM login");
    $stmt->execute();
    $users = $stmt->get_result();
    foreach($users as $user){
        if($user['username']==$username){
            $u=1;
        }
    }
    echo $username;
    if($password != $cpassword){
         $msg = "passwords doesn't match";
         $confirm=1;
    }
    else if($u==0 && $confirm==0){
        $sql = "INSERT INTO `login` (`username`, `name`, `password`, `phone`, `address`, `dt`) VALUES ('$username','$name', '$password', '$phone', '$address', current_timestamp());";
        if($conn->query($sql)==true)
        {
            echo "Sucessful";
            $o = $conn->prepare("SELECT * FROM supplies");
            $o->execute();
            $result = $o->get_result();
            foreach($result as $r)
            {
                $sid=$r['sid']+1;
            }
            echo $sid;
            $q = "INSERT INTO `supplies` (`sid`, `name`, `address`, `phone`) VALUES ('$sid', '$username', '$address', '$phone');";
            if($conn->query($q)==true)
            {
                echo "Sucessful";
                header("Location: base.php");
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
	  <h1>Sign Up</h1>
	    <form method="post">
	        <input type="text" name="username" placeholder="Username" required="required" />
            <?php
                if($u){
                    echo "<p> Already Exists";
                }
            ?> 
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
	        <button type="submit" name="login" class="btn btn-primary btn-block btn-large">Sign-Up</button>
	    </form>
	</div>
</div>
</body>
</html>

