<?php include("head.php")?>
<!DOCTYPE html>
<html>
  
<head>
    <title>Image Upload</title>
    <link rel="stylesheet" 
          type="text/css"
          href="style.css" />
</head>
  
<body>
    <div class="login">
        <h1>ADD PRODUCT</h1>
            <form method="post" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Product Name" required="required" />
                <input type="text" name="cat" placeholder="Product Category" required="required" />
                <input type="number" name="price" placeholder="Product price" required="required" />
                <input type="number" name="stock" placeholder="Number Of Items" required="required" />
                <input type="file" name="uploadfile" value="" />
                <button type="submit" name="add" class="btn btn-primary btn-block btn-large">ADD PRODUCT</button>
            </form>
    </div>
</body>
  
</html>
<?php
  $msg = "";
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
  // If upload button is clicked ...
if (isset($_POST['add'])){
  
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"]; 
       
    $o = $conn->prepare("SELECT * FROM product");
    $o->execute();
    $result = $o->get_result();
    foreach($result as $r)
    {
        $p_id=$r['p_id']+1;
    }
    $result->close();
    $category=$_POST['cat'];

    $c = $conn->query("SELECT * FROM category where category like '%".$category."%'");
    if($x = $c->fetch_assoc())
    {
        $c_id=$x['c_id'];
    }
    else{
        $o = $conn->prepare("SELECT * FROM category");
        $o->execute();
        $result = $o->get_result();
        foreach($result as $r)
        {
            $c_id=$r['c_id']+1;
        }
        $result->close();
        $order ="INSERT INTO `category` (`c_id`, `category`) VALUES ('$c_id','$category');";
        if($conn->query($order)==true)
        {
            echo "Sucessful";
        }
    }
    $name=$_POST['name'];
    $price=$_POST['price'];
    $stock=$_POST['stock'];
    $sid=$_SESSION['sid'];
    echo $_SESSION['sid'];
    $folder = "photos/".$filename;
    $order ="INSERT INTO `product` (`p_id`, `c_id`, `sid`, `name`, `rate`, `stock`, `image`) VALUES ('$p_id', '$c_id', '$sid', '$name', '$price', '$stock', '$filename');";
    if($conn->query($order)==true)
    {
        echo "Sucessful";
    }
          
        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
      }
  }
  echo $msg;
?>