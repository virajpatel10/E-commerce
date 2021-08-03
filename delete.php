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
  $p_id=$_GET['p_id'];
  $stmt = $conn->prepare("SELECT * FROM product");
  $stmt->execute();
  $arrays = $stmt->get_result();
  $stmt->close();

  foreach($arrays as $array)
  {
      if($array['p_id']==$p_id)
      {
          $product=$array;
          break;
      }
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
  <form method="post">
    <div class="card">
        <?php $img='photos/'.$product['image'] ?>
        <img src=<?php echo $img; ?> alt="Denim Jeans" style="width:100%">
        <h1 id="name"><?php echo $product['name']; ?></h1>
        <p class="price">$<?php echo $product['rate']; ?></p>
        <p class="price">Stock : <?php echo $product['stock']; ?></p>
        <p><button style="margin-top:10px;" onclick="clicked()">Delete</button></p>
    </div>
  </form>
  </body>
</html>
<script>
function clicked(){
    <?php 
        $sql = "DELETE FROM product WHERE p_id=".$_GET['p_id'];

        if ($conn->query($sql) === TRUE) {
          echo "Record deleted successfully";
          header("location:delete_product.php");
        }
    ?>
}
</script>

