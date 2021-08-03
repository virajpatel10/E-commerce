<?php include('head.php')?>
<?php       
  $product="";
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
  $sup=$conn->query("select * from supplies where name like'".$_SESSION['username']."'");
  $sid=$sup->fetch_assoc();

  $p=$conn->query("select * from product where sid=".$sid['sid']);
  $product=$p->fetch_assoc();
  if($product==null)
  {
      header("location:stock_error.php");
      die();
  }
  else{
    $stmt=$conn->prepare("select * from product where sid=".$sid['sid']);
    $stmt->execute();
    $arrays = $stmt->get_result();
    $stmt->close();
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_GET['name']?></title>
</head>
<style>
.card{
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

.price {
  color: grey;
  font-size: 22px;
}

.card button {
  border: none;
  outline: 0;
  padding: 12px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

.card button:hover {
  opacity: 0.7;
}
</style>
  <body>
      <?php foreach($arrays as $array): ?>
        <div class="card">
            <?php $img='photos/'.$array['image']; ?>
            <img src=<?php echo $img; ?> alt="Denim Jeans" style="width:100%">
            <h1 id="name"><?php echo $array['name']; ?></h1>
            <p class="price">$<?php echo $array['rate']; ?></p>
            <p>Some text about the jeans..</p>
            <p><button onclick="window.location.href='<?php echo 'delete.php'.'?'.'p_id='.$array['p_id']?>'" style="margin-top:10px;background-color:red;" class="btn btn-primar">Delete</button></p>
        </div>
      <?php endforeach; ?>
  </body>
</html>
