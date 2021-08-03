<?php include('head.php')?>
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
        $stmt = $conn->prepare("SELECT * FROM product");
        $stmt->execute();
        $arrays = $stmt->get_result();
        $stmt->close();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Product</title>
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
            <p><button onclick="window.location.href='<?php echo 'stock.php'.'?'.'p_id='.$array['p_id'].'&'.'name='.$array['name']?>'">Buy</button></p>
        </div>
      <?php endforeach; ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>