<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <div class="container-fluid">
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <a class="navbar-brand" href="#">Shopping Site</a>
	    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
	      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
	        <li class="nav-item">
	          <a class="nav-link active" aria-current="page" style="margin-left: 30px;" href="base.php">Home</a>
	        </li>
			<?php 
            if(!isset($_SESSION['username'])) : ?>
				<li class="nav-item">
				<a class="nav-link" style="margin-left: 30px;" href="login.php">Login</a>
				</li>
				<li class="nav-item">
				<a class="nav-link disabled" href="signup.php" style="margin-left: 30px;" tabindex="-1" aria-disabled="true">Sign-Up</a>
				</li>
			<?php endif ?> 
			<?php if(isset($_SESSION['username'])) : ?>
			<li class="nav-item">
				<a class="nav-link active" aria-current="page" style="margin-left: 30px;" href="profile.php"><?php echo $_SESSION['username']?></a>
			</li>
			<li class="nav-item">
	          <a class="nav-link active" aria-current="page" style="margin-left: 30px;" href="logout.php">logout
			  </a>
	        </li>
			<li class="nav-item">
	          <a class="nav-link active" aria-current="page" style="margin-left: 30px;" href="product.php">Product
			  </a>
	        </li>
			<li class="nav-item">
	          <a class="nav-link active" aria-current="page" style="margin-left: 30px;" href="order.php">Order
			  </a>
	        </li>
			<li class="nav-item">
	          <a class="nav-link active" aria-current="page" style="margin-left: 30px;" href="add_product.php">Add product
			  </a>
	        </li>
			<li class="nav-item">
	          <a class="nav-link active" aria-current="page" style="margin-left: 30px;" href="delete_product.php">Added product
			  </a>
	        </li>
		  	<?php endif ?> 
	      </ul>
		  <form class="form-inline my-2 my-lg-0" style="margin-left:200px;" method="POST">
			<input class="form-control mr-sm-2" type="search" placeholder="Search" name="search">
			<button class="btn btn-outline-success my-2 my-sm-0" onclick="find()">Search</button>
    		</form>
	    </div>  
	  </div>
	</nav>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
<script>
	function find(){
	<?php
		if(isset($_POST['search']))
		{
			$_SESSION['category']=$_POST['search'];
			header("Location: search.php");
		}
	?>
}
</script>