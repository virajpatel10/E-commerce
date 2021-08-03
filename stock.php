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
        <h1 id="name"><?php echo $_GET['name']; ?></h1>
        <p class="price">$<?php echo $product['rate']; ?></p>
        <label class="price">Enter Qty</label>
        <input name='demoInput' type=number min=1>
        <label class="price">Name</label>
        <input name='p_name' type=text required>
        <label class="price">phone</label>
        <input name='contact' type=text required>
        <label class="price">Address</label>
        <input name='address' type=textarea required>
        <p><button style="margin-top:10px;" onclick="clicked()">Buy</button></p>
    </div>
  </form>
  </body>
</html>
<script>
function clicked(){
  <?php 
    $val1 = $_POST['demoInput'];
    $product['stock']=$product['stock']-$val1;
    $stock=$product['stock'];?>
    <?php
    if($product['stock']<0)
    {
      header("Location: stock_error.php");
      die();
    }
    else{
        $name=$_POST['p_name'];
        $add=$_POST['address'];
        $phone=$_POST['contact'];
        $a = $conn->query("SELECT * FROM courier where phone=".$phone." and name like '%".$name."%' and address like '%".$add."%'");
        $coid=0;

        if($x = $a->fetch_assoc()){
          $coid=$x['coid'];
        }
        else{
          $o = $conn->prepare("SELECT * FROM courier");
          $o->execute();
          $result = $o->get_result();
          foreach($result as $r)
          {
              $coid=$r['coid']+1;
          }
          $result->close();
          $courier ="INSERT INTO `courier` (`coid`, `name`, `address`, `phone`) VALUES ('$coid', '$name', '$add', '$phone');";
          if($conn->query($courier)==true)
          {
              echo "Sucessful";
          }
        }
        $sql = "UPDATE product SET stock=".$product['stock']." where p_id=".$p_id;
        if ($conn->query($sql) === TRUE) {
            echo "Sucessful";
        }
        
        $a->close();

        $o_id=0;
        $o = $conn->prepare("SELECT * FROM cart");
        $o->execute();
        $result = $o->get_result();
        foreach($result as $r)
        {
            $o_id=$r['o_id']+1;
        }
        $result->close();
        
        $username=$_SESSION['username'];
        $qty=1;
        $o_s="dispatch";
        if ($val1==0){

        }
        else{
          $order ="INSERT INTO `cart` (`o_id`, `username`, `p_id`, `coid`, `qty`, `o_status`, `order_date`) VALUES ('$o_id', '$username', '$p_id', '$coid', '$val1', '$o_s', current_timestamp());";
          if($conn->query($order)==true)
          {
              echo "Sucessful";
          }
        }
    }
    
    ?>
}
</script>