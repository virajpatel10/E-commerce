<?php include('head.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="login">
	  <h1>Login</h1>
	    <form action="login.php" method="post">
	        <input type="text" name="admin" placeholder="Username" required="required" />
	        <input type="password" name="pass" placeholder="Password" required="required" />
	        <button type="submit" name="login" class="btn btn-primary btn-block btn-large">Login</button>
	    </form>
	</div>
</div>
</body>
</html>
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
    function test_input($data) {
     
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if ($_SERVER["REQUEST_METHOD"]== "POST") {
        $adminname = test_input($_POST["admin"]);
        $password = test_input($_POST["pass"]);
        $stmt = $conn->prepare("SELECT * FROM login");
        $stmt->execute();
        $users = $stmt->get_result();
        $stmt->close();
         
        foreach($users as $user) {
            if(($user['username'] == $adminname) &&
                ($user['password'] == $password)) {
                    $_SESSION['username']=$adminname;
                    
                    $q=$conn->query("SELECT * FROM supplies where name like '".$adminname."'");
                    $x=$q->fetch_assoc();
                    $_SESSION['sid']=$x['sid'];
                    header("Location: base.php");
            }
            else {
                echo "<script language='javascript'>";
                echo "alert('WRONG INFORMATION')";
                echo "</script>";
            }
        }
    }
?>