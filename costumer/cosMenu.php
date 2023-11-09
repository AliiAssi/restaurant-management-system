<?php
include '../components/connection.php';
if(!isset($_SESSION["userId"]))
{
    header("login.php");
}
else{
	$userId = $_SESSION["userId"];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>yumy menu</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Open+Sans">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../menu.css">

<style>
    .input-field {
        width: 50%;
        padding: 8px;
        font-size: 16px;
      }
      
      .increment
      {
  display: inline-block;
  padding: 0.5em 0.5em;
  text-decoration: none;
  border-radius: 50px;
  cursor: pointer;
  outline: none;
  margin-top: 1em;
  text-transform: uppercase;
  font-weight: small;
      }
	  .decrement{
	display: inline-block;
  padding: 0.5em 0.6em;
  text-decoration: none;
  border-radius: 50px;
  cursor: pointer;
  outline: none;
  margin-top: 1em;
  text-transform: uppercase;
  font-weight: small;
	  } 
	
	body{
		background:#e2eaef;
	}

</style>
<?php
            $req=mysqli_query($con,"SELECT * FROM restmenu");
            while($res = mysqli_fetch_array($req)){
            ?>
        <script>
            function enableQtyField() {
            var qtyField = document.getElementById("nbb<?=$res['productId'];?>");
            qtyField.disabled = false;
            }  
            function inc<?=$res["productId"];?>()
            {
                const inputField = document.getElementById('nbb<?=$res["productId"];?>');
                inputField.value = parseInt(inputField.value) + 1;
            }
            function dec<?=$res["productId"];?>()
            {
                const inputField = document.getElementById('nbb<?=$res["productId"];?>');

                if(parseInt(inputField.value) < 2){
                    inputField.value = 1;
                }else{
                inputField.value = parseInt(inputField.value) - 1;}
            }
        </script>
        <?php } ?>
</head>
<body>
<!-- header section-->
<?php include '../components/cosHeader.php'; ?>
<!-- main dish menu --> <br><br><br><br><br><br>

<div class="container-xl" >
	<div class="row">
		<div class="col-md-12">
			<h2>Main Dish <b>Menu</b></h2>
			<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
			<!-- Carousel indicators -->
			<ol class="carousel-indicators">
			<?php
			$check_sql = "SELECT count(*) AS 'count' from restmenu where productCategory = 'main dish'";
			if(isset($_GET['favourite']))
			{
				$check_sql = "SELECT count(*) AS 'count' from restmenu,fav where productCategory = 'main dish' AND restmenu.productId = fav.productId AND userId = $userId 	";	
			}
			$select_products = mysqli_query($con,$check_sql);
			$fetch_products = mysqli_fetch_array($select_products);
			if($fetch_products['count'] > 0){
			?>
				<?php
				
				$query = "SELECT COUNT(*) AS count FROM restmenu WHERE productCategory = 'main dish'";
				if(isset($_GET['favourite']))
				{
					$query = "SELECT count(*) AS 'count' from restmenu,fav where productCategory = 'main dish' AND restmenu.productId = fav.productId AND userId = $userId 	";	
				}
				$result = mysqli_query($con, $query);
				if ($result) {
					$row = mysqli_fetch_assoc($result);
					$count = $row['count'];
				  }
				else {
					header("LOCATION:error.php");
				}
				  
 				for ($i = 0 ; $i < $count ; $i++){
				?>
				<?php
				if($i == 0){ ?>
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			  	<?php }
				elseif($i > 0 && $i % 4 == 0){ ?>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<?php } ?>
				<?php } ?>
			</ol>   
			<!-- Wrapper for carousel items -->
			<div class="carousel-inner">
				<div class="item carousel-item active">
					<?php
					$select_products_sql="SELECT * FROM restmenu WHERE productCategory = 'main dish' LIMIT 4;";
					$fav = false;
					if(isset($_GET['favourite']))
					{
						$fav = true;
						$select_products_sql = "SELECT * from restmenu,fav where productCategory = 'main dish' AND restmenu.productId = fav.productId AND userId = $userId  LIMIT 4;	";	
					}
					$select_products = mysqli_query($con,$select_products_sql);
					?>
					<div class="row">
							<?php
							while($fetch_products = mysqli_fetch_array($select_products)){
							$pid= $fetch_products['productId'];
							$select_products_sql = "SELECT * from fav where userId = $userId  AND productId = $pid";	
							$red = false;
							$index = "false";
							$heart_model = mysqli_query($con,$select_products_sql);
							if(mysqli_fetch_array($heart_model) ) {	
								$index = "true";
								$red = true;}
							?>
						<div class="col-sm-3">
							<div class="thumb-wrapper">
							
								<span style="color:green;float:left; position: absolute;top: 0;left: 0;position: absolute;background-color: #ff0000;color: #ffffff;font-weight: bold;padding: 4px 4px;border-radius: 4px;">NEW</span>
								<a id="<?=$fetch_products['productId'];?>like" style="letter-spacing:0px;padding:0px;text-decoration:none;" href="../control/favController.php?fav=<?=$index;?>&&pid=<?=$fetch_products['productId'];?> " class="none"><span class="wish-icon">
								<?php if($red==false){?><i class="fa fa-heart-o"> <?php }else if($red==true){echo "❤️";}?></i></span></a>
						
				
								<div class="img-box">
								<img src="../uploaded_img/<?=$fetch_products['productImage'];?>" class="img-fluid" alt="<?=$fetch_products['productName'];?>">
								</div>
								<div class="thumb-content">
									<h4><?=$fetch_products['productName'];?></h4>									
									<p class="item-price"> <span>$<?=$fetch_products['productPrice'];?></span></p>
									<form action="../control/add_to_cart.php" method="post">
                                    <input id="nbb<?=$fetch_products["productId"];?>" name="qty" type="text" class="input-field" value="1" readonly />
                                    <input type="button" value="+" name ="inccc" class="increment" onclick="inc<?=$fetch_products['productId'];?>()">
                                    <input type="button" value ="-" name="deccc" class="decrement" onclick="dec<?=$fetch_products['productId'];?>()">
									<input type="hidden" name="id" id="<?=$fetch_products["productId"];?>" value="<?=$fetch_products["productId"];?>">
									<input type="submit" name="add" value="Add to Cart" class="btn btn-primary">
									</form>
								</div>						
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
				<?php if($count > 4){ ?>
				<div class="item carousel-item">
					<?php
					$select_products_sql= "SELECT * FROM restmenu WHERE productCategory = 'main dish' LIMIT 18446744073709551615 OFFSET 4;";
					if(isset($_GET['favourite']))
					{
						$fav = true;
						$red = true;
						$select_products_sql = "SELECT * from restmenu,fav where productCategory = 'main dish' AND restmenu.productId = fav.productId AND userId = $userId  LIMIT 99999999999 offset 4;	";	
					}
					$select_products = mysqli_query($con,$select_products_sql);
					?>
					<div class="row">
							<?php
							while($fetch_products = mysqli_fetch_array($select_products)){
								$pid= $fetch_products['productId'];
								$select_products_sql = "SELECT * from fav where userId = $userId  AND productId = $pid";	
								$red = false;
								$index = "false";
								$heart_model = mysqli_query($con,$select_products_sql);
								if(mysqli_fetch_array($heart_model) ) {	
									$index = "true";
									$red = true;
								}
							?>
						<div class="col-sm-3" id="<?=$pid	;?>">
							<div class="thumb-wrapper">

								<span style="color:green;float:left; position: absolute;top: 0;left: 0;position: absolute;background-color: #ff0000;color: #ffffff;font-weight: bold;padding: 4px 4px;border-radius: 4px;">NEW</span>
								<a id="<?=$fetch_products['productId'];?>like" style="letter-spacing:0px;padding:0px;text-decoration:none;" href="../control/favController.php?fav=<?=$index;?>&&pid=<?=$fetch_products['productId'];?> " class="none"><span class="wish-icon">
								<?php if($red==false){?><i class="fa fa-heart-o"> <?php }else if($red==true){echo "❤️";}?></i></span></a>

								<div class="img-box">
								<img src="../uploaded_img/<?=$fetch_products['productImage'];?>" class="img-fluid" alt="<?=$fetch_products['productName'];?>">
								</div>
								<div class="thumb-content">
								<h4><?=$fetch_products['productName'];?></h4>									
									<p class="item-price"> <span>$<?=$fetch_products['productPrice'];?></span></p>
									<form action="../control/add_to_cart.php" method="post">
                                    <input id="nbb<?=$fetch_products["productId"];?>" name="qty" type="text" class="input-field" value="1" readonly />
                                    <input type="button" value="+" name ="inccc" class="increment" onclick="inc<?=$fetch_products['productId'];?>()">
                                    <input type="button" value ="-" name="deccc" class="decrement" onclick="dec<?=$fetch_products['productId'];?>()">
									<input type="hidden" name="id" value="<?=$fetch_products["productId"]?>;">
									<input type="submit" value="Add to Cart" class="btn btn-primary">
									</form>
								</div>						
							</div>
						</div>
						<?php } ?>	
					</div>
				</div>
				
				</div>
				<?php } ?>
			</div>
			<!-- Carousel controls -->
			<a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-control-next" href="#myCarousel" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
		</div>
	</div>
	<?php } else {?>
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
	<strong>YUMY:</strong> soon as possible
	</div>
	<?php } ?>
</div>
<!-- fast food menu -->

<div class="container-xl">
	<div class="row">
		<div class="col-md-12">
			<h2>Fast Food <b>Menu</b></h2>
			<div id="myCarousel1" class="carousel slide" data-ride="carousel" data-interval="0">
			<!-- Carousel indicators -->
			<ol class="carousel-indicators">
			<?php
			$check_sql = "SELECT count(*) AS 'count' from restmenu where productCategory = 'fast food'";
			if(isset($_GET['favourite']))
			{
				$check_sql = "SELECT count(*) AS 'count' from restmenu,fav where productCategory = 'fast food' AND restmenu.productId = fav.productId AND userId = $userId 	";	
			}
			$select_products = mysqli_query($con,$check_sql);
			$fetch_products = mysqli_fetch_array($select_products);
			if($fetch_products['count'] > 0){
			?>
				<?php
				
				$query = "SELECT COUNT(*) AS count FROM restmenu WHERE productCategory = 'fast food'";
				if(isset($_GET['favourite']))
				{
					$query = "SELECT count(*) AS 'count' from restmenu,fav where productCategory = 'fast food' AND restmenu.productId = fav.productId AND userId = $userId 	";	
				}
				$result = mysqli_query($con, $query);
				if ($result) {
					$row = mysqli_fetch_assoc($result);
					$count = $row['count'];
				  }
				else {
					header("LOCATION:error.php");
				}
				  
 				for ($i = 0 ; $i < $count ; $i++){
				?>
				<?php
				if($i == 0){ ?>
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			  	<?php }
				elseif($i > 0 && $i % 4 == 0){ ?>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<?php } ?>
				<?php } ?>
			</ol>   
			<!-- Wrapper for carousel items -->
			<div class="carousel-inner">
				<div class="item carousel-item active">
					<?php
					$select_products_sql="SELECT * FROM restmenu WHERE productCategory = 'fast food' LIMIT 4;";
					$fav = false;
					if(isset($_GET['favourite']))
					{
						$fav = true;
						$select_products_sql = "SELECT * from restmenu,fav where productCategory = 'fast food' AND restmenu.productId = fav.productId AND userId = $userId  LIMIT 4;	";	
					}
					$select_products = mysqli_query($con,$select_products_sql);
					?>
					<div class="row">
							<?php
							while($fetch_products = mysqli_fetch_array($select_products)){
							$pid= $fetch_products['productId'];
							$select_products_sql = "SELECT * from fav where userId = $userId  AND productId = $pid";	
							$red = false;
							$index = "false";
							$heart_model = mysqli_query($con,$select_products_sql);
							if(mysqli_fetch_array($heart_model) ) {	
								$index = "true";
								$red = true;}
							?>
						<div class="col-sm-3">
							<div class="thumb-wrapper">
							
								<span style="color:green;float:left; position: absolute;top: 0;left: 0;position: absolute;background-color: #ff0000;color: #ffffff;font-weight: bold;padding: 4px 4px;border-radius: 4px;">NEW</span>
								<a id="<?=$fetch_products['productId'];?>like" style="letter-spacing:0px;padding:0px;text-decoration:none;" href="../control/favController.php?fav=<?=$index;?>&&pid=<?=$fetch_products['productId'];?> " class="none"><span class="wish-icon">
								<?php if($red==false){?><i class="fa fa-heart-o"> <?php }else if($red==true){echo "❤️";}?></i></span></a>
						
				
								<div class="img-box">
								<img src="../uploaded_img/<?=$fetch_products['productImage'];?>" class="img-fluid" alt="<?=$fetch_products['productName'];?>">
								</div>
								<div class="thumb-content">
									<h4><?=$fetch_products['productName'];?></h4>									
									<p class="item-price"> <span>$<?=$fetch_products['productPrice'];?></span></p>
									<form action="../control/add_to_cart.php" method="post">
                                    <input id="nbb<?=$fetch_products["productId"];?>" name="qty" type="text" class="input-field" value="1" readonly />
                                    <input type="button" value="+" name ="inccc" class="increment" onclick="inc<?=$fetch_products['productId'];?>()">
                                    <input type="button" value ="-" name="deccc" class="decrement" onclick="dec<?=$fetch_products['productId'];?>()">
									<input type="hidden" name="id" id="<?=$fetch_products["productId"];?>" value="<?=$fetch_products["productId"];?>">
									<input type="submit" name="add" value="Add to Cart" class="btn btn-primary">
									</form>
								</div>						
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
				<?php if($count > 4){ ?>
				<div class="item carousel-item">
					<?php
					$select_products_sql= "SELECT * FROM restmenu WHERE productCategory = 'fast food' LIMIT 18446744073709551615 OFFSET 4;";
					if(isset($_GET['favourite']))
					{
						$fav = true;
						$red = true;
						$select_products_sql = "SELECT * from restmenu,fav where productCategory = 'fast food' AND restmenu.productId = fav.productId AND userId = $userId  LIMIT 99999999999 offset 4;	";	
					}
					$select_products = mysqli_query($con,$select_products_sql);
					?>
					<div class="row">
							<?php
							while($fetch_products = mysqli_fetch_array($select_products)){
								$pid= $fetch_products['productId'];
								$select_products_sql = "SELECT * from fav where userId = $userId  AND productId = $pid";	
								$red = false;
								$index = "false";
								$heart_model = mysqli_query($con,$select_products_sql);
								if(mysqli_fetch_array($heart_model) ) {	
									$index = "true";
									$red = true;
								}
							?>
						<div class="col-sm-3" id="<?=$pid	;?>">
							<div class="thumb-wrapper">

								<span style="color:green;float:left; position: absolute;top: 0;left: 0;position: absolute;background-color: #ff0000;color: #ffffff;font-weight: bold;padding: 4px 4px;border-radius: 4px;">NEW</span>
								<a id="<?=$fetch_products['productId'];?>like" style="letter-spacing:0px;padding:0px;text-decoration:none;" href="../control/favController.php?fav=<?=$index;?>&&pid=<?=$fetch_products['productId'];?> " class="none"><span class="wish-icon">
								<?php if($red==false){?><i class="fa fa-heart-o"> <?php }else if($red==true){echo "❤️";}?></i></span></a>

								<div class="img-box">
								<img src="../uploaded_img/<?=$fetch_products['productImage'];?>" class="img-fluid" alt="<?=$fetch_products['productName'];?>">
								</div>
								<div class="thumb-content">
								<h4><?=$fetch_products['productName'];?></h4>									
									<p class="item-price"> <span>$<?=$fetch_products['productPrice'];?></span></p>
									<form action="../control/add_to_cart.php" method="post">
                                    <input id="nbb<?=$fetch_products["productId"];?>" name="qty" type="text" class="input-field" value="1" readonly />
                                    <input type="button" value="+" name ="inccc" class="increment" onclick="inc<?=$fetch_products['productId'];?>()">
                                    <input type="button" value ="-" name="deccc" class="decrement" onclick="dec<?=$fetch_products['productId'];?>()">
									<input type="hidden" name="id" value="<?=$fetch_products["productId"]?>;">
									<input type="submit" value="Add to Cart" class="btn btn-primary">
									</form>
								</div>						
							</div>
						</div>
						<?php } ?>	
					</div>
				</div>
				
				</div>
				<?php } ?>
			</div>
			<!-- Carousel controls -->
			<a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-control-next" href="#myCarousel" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
		</div>
	</div>
	<?php } else {?>
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
	<strong>YUMY:</strong> soon as possible
	</div>
	<?php } ?>
</div>


<!-- drinks  menu -->
<?php
if(isset($_GET['drink']) && $_GET['drink'] == "cold" ){
?>
<div class="container-xl">
	<div class="row" id="drinks">
		<div class="col-md-12">
			<h2>&nbsp;Drinks <b>Menu</b>
			<div class="btn-group dropright">
			<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				category
			</button>
			<div class="dropdown-menu">
			<a class="dropdown-item" href="cosMenu.php?drink=cold#drinks"style="color:blue;">cold</a>
			<a class="dropdown-item " href="cosMenu.php?drink=hot#drinks" style="color:red;">hot</a>
			</div>
			</div>
			</h2> 
			<div id="myCarousel2" class="carousel slide" data-ride="carousel" data-interval="0">
			<!-- Carousel indicators -->
			<ol class="carousel-indicators">
			<?php
			$select_products_sql = "SELECT count(*) AS 'count' from restmenu where productCategory = 'drinks' and  productDesc = 'cold'";
			if(isset($_GET['favourite']))
			{
			$select_products_sql = "SELECT count(*) AS 'count' from restmenu,fav where restmenu.productId = fav.productId AND productCategory = 'drinks' and productDesc = 'cold' AND userId = $userId";	
			}
			$select_products = mysqli_query($con, $select_products_sql);
			$fetch_products = mysqli_fetch_array($select_products);
			if($fetch_products['count'] > 0){
			?>
				<?php
				
				$query = "SELECT count(*) AS 'count' from restmenu a where  a.productCategory = 'drinks' AND  a.productDesc = 'cold'";
				if(isset($_GET['favourite']))
				{
					$query = "SELECT count(*) AS 'count' from restmenu,fav where restmenu.productId = fav.productId AND productCategory = 'drinks' and productDesc = 'cold' AND userId = $userId" ;	
				}
				$result = mysqli_query($con, $query);
				if ($result) {
					$row = mysqli_fetch_assoc($result);
					$count = $row['count'];
				  }
				else {
					header("LOCATION:error.php");
				}
				  
 				for ($i = 0 ; $i < $count ; $i++){
				?>
				<?php
				if($i == 0){ ?>
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			  	<?php }
				elseif($i > 0 && $i % 4 == 0){ ?>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<?php } ?>
				<?php } ?>
			</ol>   
			<!-- Wrapper for carousel items -->
			<div class="carousel-inner" id="drinks">
				<div class="item carousel-item active">
					<?php
					$select_products_sql="SELECT * from restmenu   where restmenu.productCategory = 'drinks' AND  restmenu.productDesc = 'cold' LIMIT 4;";
					if(isset($_GET['favourite']))
					{
						$select_products_sql = "SELECT * from restmenu ,fav  where restmenu.productId = fav.productId AND productCategory = 'drinks' and productDesc = 'cold' AND userId = $userId LIMIT 4;";
					}
					$select_products = mysqli_query($con,$select_products_sql);
					?>
					<div class="row">
							<?php
							while($fetch_products = mysqli_fetch_array($select_products)){
							$pid= $fetch_products['productId'];
							$select_products_sql = "SELECT * from fav where userId = $userId  AND productId = $pid";	
							$red = false;
							$index = "false";
							$heart_model = mysqli_query($con,$select_products_sql);
							if(mysqli_fetch_array($heart_model) ) {	
								$index = "true";
								$red = true;}
							?>
						<div class="col-sm-3">
							<div class="thumb-wrapper">
							
								<span style="color:green;float:left; position: absolute;top: 0;left: 0;position: absolute;background-color: #ff0000;color: #ffffff;font-weight: bold;padding: 4px 4px;border-radius: 4px;">NEW</span>
								<a id="<?=$fetch_products['productId'];?>like" style="letter-spacing:0px;padding:0px;text-decoration:none;" href="../control/favController.php?drink=cold&&fav=<?=$index;?>&&pid=<?=$fetch_products['productId'];?> " class="none"><span class="wish-icon">
								<?php if($red==false){?><i class="fa fa-heart-o"> <?php }else if($red==true){echo "❤️";}?></i></span></a>
						
				
								<div class="img-box">
								<img src="../uploaded_img/<?=$fetch_products['productImage'];?>" class="img-fluid" alt="<?=$fetch_products['productName'];?>">
								</div>
								<div class="thumb-content">
									<h4><?=$fetch_products['productName'];?></h4>									
									<p class="item-price"> <span>$<?=$fetch_products['productPrice'];?></span></p>
                                    <form action="../control/add_to_cart.php" method="post">
                                    <input id="nbb<?=$fetch_products["productId"];?>" name="qty" type="text" class="input-field" value="1" readonly />
                                    <input type="button" value="+" name ="inccc" class="increment" onclick="inc<?=$fetch_products['productId'];?>()">
                                    <input type="button" value ="-" name="deccc" class="decrement" onclick="dec<?=$fetch_products['productId'];?>()">
									<input type="hidden" name="id" id="<?=$fetch_products["productId"];?>" value="<?=$fetch_products["productId"];?>">
									<input type="submit" name="add" value="Add to Cart" class="btn btn-primary">
									</form>
								</div>						
							</div>
						</div> 
						<?php } ?>
					</div>
				</div>
				<?php if($count > 4){ ?>
				<div class="item carousel-item">
					<?php
					$select_products_sql="SELECT * from restmenu a where a.productCategory = 'drinks' AND a.productDesc='cold' LIMIT 99999 offset 4;";
					if(isset($_GET['favourite']))
					{
						$select_products_sql = "SELECT * from restmenu a,fav c where a.productId = c.productId AND a.productCategory = 'drinks' AND a.productDesc='cold' LIMIT 999999 offset 4;";
					}
					$select_products = mysqli_query($con,$select_products_sql);
					?>
					<div class="row">
							<?php
							while($fetch_products = mysqli_fetch_array($select_products)){
								$pid= $fetch_products['productId'];
								$select_products_sql = "SELECT * from fav where userId = $userId  AND productId = $pid";	
								$red = false;
								$index = "false";
								$heart_model = mysqli_query($con,$select_products_sql);
								if(mysqli_fetch_array($heart_model) ) {	
									$index = "true";
									$red = true;
								}
							?>
						<div class="col-sm-3" id="<?=$pid	;?>">
							<div class="thumb-wrapper">

								<span style="color:green;float:left; position: absolute;top: 0;left: 0;position: absolute;background-color: #ff0000;color: #ffffff;font-weight: bold;padding: 4px 4px;border-radius: 4px;">NEW</span>
								<a id="<?=$fetch_products['productId'];?>like" style="letter-spacing:0px;padding:0px;text-decoration:none;" href="../control/favController.php?drink=cold&&fav=<?=$index;?>&&pid=<?=$fetch_products['productId'];?> " class="none"><span class="wish-icon">
								<?php if($red==false){?><i class="fa fa-heart-o"> <?php }else if($red==true){echo "❤️";}?></i></span></a>

								<div class="img-box">
								<img src="../uploaded_img/<?=$fetch_products['productImage'];?>" class="img-fluid" alt="<?=$fetch_products['productName'];?>">
								</div>
								<div class="thumb-content">
								<h4><?=$fetch_products['productName'];?></h4>									
									<p class="item-price"> <span>$<?=$fetch_products['productPrice'];?></span></p>
                                    <form action="../control/add_to_cart.php" method="post">
                                    <input id="nbb<?=$fetch_products["productId"];?>" name="qty" type="text" class="input-field" value="1" readonly />
                                    <input type="button" value="+" name ="inccc" class="increment" onclick="inc<?=$fetch_products['productId'];?>()">
                                    <input type="button" value ="-" name="deccc" class="decrement" onclick="dec<?=$fetch_products['productId'];?>()">
									<input type="hidden" name="id" id="<?=$fetch_products["productId"];?>" value="<?=$fetch_products["productId"];?>">
									<input type="submit" name="add" value="Add to Cart" class="btn btn-primary">
									</form>
								</div>						
							</div>
						</div>
						<?php } ?>	
					</div>
				</div>
				
				</div>
				<?php } ?>
			</div>
			<!-- Carousel controls -->
			<a class="carousel-control-prev" href="#myCarousel2" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-control-next" href="#myCarousel2" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
		</div>
	</div>
	<?php } else {?>
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
	<strong>YUMY:</strong> soon as possible
	</div>
	<?php } ?>
</div>

<?php
}
elseif(isset($_GET['drink']) && $_GET['drink'] == "hot" ){
?>
<div class="container-xl">
	<div class="row" id="drinks">
		<div class="col-md-12">
			<h2>&nbsp;Drinks <b>Menu</b>
			<div class="btn-group dropright">
			<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				category
			</button>
			<div class="dropdown-menu">
			<a class="dropdown-item" href="cosMenu.php?drink=cold#drinks"style="color:blue;">cold</a>
			<a class="dropdown-item " href="cosMenu.php?drink=hot#drinks" style="color:red;">hot</a>
			</div>
			</div>
			</h2> 
			<div id="myCarousel2" class="carousel slide" data-ride="carousel" data-interval="0">
			<!-- Carousel indicators -->
			<ol class="carousel-indicators">
			<?php
			$hot_drink_query = "SELECT count(*) AS 'count'  from restmenu a where a.productCategory = 'drinks' AND a.productDesc='hot'";
			if(isset($_GET['favourite']))
			{
			$hot_drink_query = "SELECT count(*) AS 'count' from restmenu a,fav c where a.productCategory = 'drinks' AND a.productId = c.productId AND c.userId = $userId AND a.productId = 'hot' " ;	
			}
			$select_products = mysqli_query($con,$hot_drink_query);
			$fetch_products = mysqli_fetch_array($select_products);
			if($fetch_products['count'] > 0){
			?>
				<?php
				
				$query = "SELECT count(*) AS 'count' from restmenu a where a.productCategory = 'drinks' AND a.productDesc='hot'";
				if(isset($_GET['favourite']))
				{
					$query = "SELECT count(*) AS 'count' from restmenu a,fav c where a.productCategory = 'drinks' AND a.productId = c.productId AND c.userId = $userId AND a.productId = 'hot'" ;	
				}
				$result = mysqli_query($con, $query);
				if ($result) {
					$row = mysqli_fetch_assoc($result);
					$count = $row['count'];
				  }
				else {
					header("LOCATION:error.php");
				}
				  
 				for ($i = 0 ; $i < $count ; $i++){
				?>
				<?php
				if($i == 0){ ?>
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			  	<?php }
				elseif($i > 0 && $i % 4 == 0){ ?>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<?php } ?>
				<?php } ?>
			</ol>   
			<!-- Wrapper for carousel items -->
			<div class="carousel-inner" id="drinks">
				<div class="item carousel-item active">
					<?php
					$select_products_sql="SELECT * from restmenu a where a.productCategory = 'drinks' AND a.productDesc='hot' LIMIT 4;";
					if(isset($_GET['favourite']))
					{
						$select_products_sql = "SELECT * from restmenu a,fav c where a.productCategory = 'drinks' AND a.productId = c.productId AND c.userId = $userId AND a.productId = 'hot' LIMIT 4;";
					}
					$select_products = mysqli_query($con,$select_products_sql);
					?>
					<div class="row">
							<?php
							while($fetch_products = mysqli_fetch_array($select_products))
							{
								$pid= $fetch_products['productId'];
								$select_products_sql = "SELECT * from fav where userId = $userId  AND productId = $pid";	
								$red = false;
								$index = "false";
								$heart_model = mysqli_query($con,$select_products_sql);
								if(mysqli_fetch_array($heart_model) ) {	
									$index = "true";
									$red = true;}
							?>
					<div class="col-sm-3">
							<div class="thumb-wrapper">
							
								<span style="color:green;float:left; position: absolute;top: 0;left: 0;position: absolute;background-color: #ff0000;color: #ffffff;font-weight: bold;padding: 4px 4px;border-radius: 4px;">NEW</span>
								<a id="<?=$fetch_products['productId'];?>like" style="letter-spacing:0px;padding:0px;text-decoration:none;" href="../control/favController.php?drink=cold&&fav=<?=$index;?>&&pid=<?=$fetch_products['productId'];?> " class="none"><span class="wish-icon">
								<?php if($red==false){?><i class="fa fa-heart-o"> <?php }else if($red==true){echo "❤️";}?></i></span></a>
						
				
								<div class="img-box">
								<img src="../uploaded_img/<?=$fetch_products['productImage'];?>" class="img-fluid" alt="<?=$fetch_products['productName'];?>">
								</div>
								<div class="thumb-content">
									<h4><?=$fetch_products['productName'];?></h4>									
									<p class="item-price"> <span>$<?=$fetch_products['productPrice'];?></span></p>
                                    <form action="../control/add_to_cart.php" method="post">
                                    <input id="nbb<?=$fetch_products["productId"];?>" name="qty" type="text" class="input-field" value="1" readonly />
                                    <input type="button" value="+" name ="inccc" class="increment" onclick="inc<?=$fetch_products['productId'];?>()">
                                    <input type="button" value ="-" name="deccc" class="decrement" onclick="dec<?=$fetch_products['productId'];?>()">
									<input type="hidden" name="id" id="<?=$fetch_products["productId"];?>" value="<?=$fetch_products["productId"];?>">
									<input type="submit" name="add" value="Add to Cart" class="btn btn-primary">
									</form>
								</div>						
							</div>
						</div> 
						<?php } ?>
					</div>
				</div>
				<?php if($count > 4){ ?>
				<div class="item carousel-item">
					<?php
					$select_products_sql= "SELECT * SELECT * from restmenu a where a.productCategory = 'drinks' AND a.productDesc='hot' LIMIT 18446744073709551615 OFFSET 4;";
					if(isset($_GET['favourite']))
					{
						$select_products_sql = "SELECT * from restmenu a,fav c where a.productCategory = 'drinks' AND a.productId = c.productId AND c.userId = $userId AND a.productId = 'hot' LIMIT 999999 offset 4;";
					}
					$select_products = mysqli_query($con,$select_products_sql);
					?>
					<div class="row">
					<?php
							while($fetch_products = mysqli_fetch_array($select_products)){
								$pid= $fetch_products['productId'];
								$select_products_sql = "SELECT * from fav where userId = $userId  AND productId = $pid";	
								$red = false;
								$index = "false";
								$heart_model = mysqli_query($con,$select_products_sql);
								if(mysqli_fetch_array($heart_model) ) {	
									$index = "true";
									$red = true;
								}
							?>
						<div class="col-sm-3" id="<?=$pid	;?>">
							<div class="thumb-wrapper">

								<span style="color:green;float:left; position: absolute;top: 0;left: 0;position: absolute;background-color: #ff0000;color: #ffffff;font-weight: bold;padding: 4px 4px;border-radius: 4px;">NEW</span>
								<a id="<?=$fetch_products['productId'];?>like" style="letter-spacing:0px;padding:0px;text-decoration:none;" href="../control/favController.php?drink=cold&&fav=<?=$index;?>&&pid=<?=$fetch_products['productId'];?> " class="none"><span class="wish-icon">
								<?php if($red==false){?><i class="fa fa-heart-o"> <?php }else if($red==true){echo "❤️";}?></i></span></a>

								<div class="img-box">
								<img src="../uploaded_img/<?=$fetch_products['productImage'];?>" class="img-fluid" alt="<?=$fetch_products['productName'];?>">
								</div>
								<div class="thumb-content">
								<h4><?=$fetch_products['productName'];?></h4>									
									<p class="item-price"> <span>$<?=$fetch_products['productPrice'];?></span></p>
									<form action="../control/add_to_cart.php" method="post">
                                    <input id="nbb<?=$fetch_products["productId"];?>" name="qty" type="text" class="input-field" value="1" readonly />
                                    <input type="button" value="+" name ="inccc" class="increment" onclick="inc<?=$fetch_products['productId'];?>()">
                                    <input type="button" value ="-" name="deccc" class="decrement" onclick="dec<?=$fetch_products['productId'];?>()">
									<input type="hidden" name="id" id="<?=$fetch_products["productId"];?>" value="<?=$fetch_products["productId"];?>">
									<input type="submit" name="add" value="Add to Cart" class="btn btn-primary">
									</form>
								</div>						
							</div>
						</div>
						<?php } ?>		
					</div>
				</div>
				
				</div>
				<?php } ?>
			</div>
			<!-- Carousel controls -->
			<a class="carousel-control-prev" href="#myCarousel2" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-control-next" href="#myCarousel2" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
		</div>
	</div>
	<?php } else {?>
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
	<strong>YUMY:</strong> soon as possible
	</div>
	<?php } ?>
</div>
<?php
}else{
?>
<div class="container-xl">
	<div class="row">
		<div class="col-md-12">
			<h2>&nbsp;Drinks <b>Menu</b>
			<div class="btn-group dropright">
			<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				category
			</button>
			<br>
			<div class="dropdown-menu">
			<a class="dropdown-item" href="cosMenu.php?drink=cold#drinks"style="color:blue;">cold</a>
			<a class="dropdown-item " href="cosMenu.php?drink=hot#drinks" style="color:red;">hot</a>
			</div>
			</h2> 
			<div id="myCarousel2" class="carousel slide" data-ride="carousel" data-interval="0">
			<!-- Carousel indicators -->
			<ol class="carousel-indicators">
			<?php
			$select_products_sql="SELECT count(*) AS 'count' from restmenu where productCategory = 'drinks'";
			if(isset($_GET['favourite']))
			{
			$select_products_sql = "SELECT count(*) AS 'count' from restmenu,fav where productCategory = 'drinks' AND restmenu.productId = fav.productId AND userId = $userId  ";	
			}
			$select_products = mysqli_query($con,$select_products_sql);
			$fetch_products = mysqli_fetch_array($select_products);
			if($fetch_products['count'] > 0){
			?>
				<?php
				$query = "SELECT COUNT(productId) AS count FROM restmenu WHERE productCategory = 'drinks'";
				if(isset($_GET['favourite']))
				{
				$query = "SELECT count(*) AS 'count' from restmenu,fav where productCategory = 'drinks' AND restmenu.productId = fav.productId AND userId = $userId";	
				}
				$result = mysqli_query($con, $query);
				if ($result) {
					$row = mysqli_fetch_assoc($result);
					$count = $row['count'];
				  }
				else {
					header("LOCATION:error.php");
				}
				  
 				for ($i = 0 ; $i < $count ; $i++){
				?>
				<?php
				if($i == 0){ ?>
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			  	<?php }
				elseif($i > 0 && $i % 4 == 0){ ?>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<?php } ?>
				<?php } ?>
			</ol>   
			<!-- Wrapper for carousel items -->
			<div class="carousel-inner" id="drinks">
				<div class="item carousel-item active">
					<?php
					$select_products_sql="SELECT * FROM restmenu WHERE productCategory = 'drinks' LIMIT 4;";
					if(isset($_GET['favourite']))
					{
						$select_products_sql = "SELECT * FROM restmenu,fav WHERE productCategory = 'drinks' AND restmenu.productId = fav.productId AND userId = $userId  LIMIT 4";	
					}
					$select_products = mysqli_query($con,$select_products_sql);
					?>
					<div class="row">
							<?php
							while($fetch_products = mysqli_fetch_array($select_products)){
								$pid= $fetch_products['productId'];
								$select_products_sql = "SELECT * from fav where userId = $userId  AND productId = $pid";	
								$red = false;
								$index = "false";
								$heart_model = mysqli_query($con,$select_products_sql);
								if(mysqli_fetch_array($heart_model) ) {	
									$index = "true";
									$red = true;}
							?>
					<div class="col-sm-3">
						<div class="thumb-wrapper">
							
							<span style="color:green;float:left; position: absolute;top: 0;left: 0;position: absolute;background-color: #ff0000;color: #ffffff;font-weight: bold;padding: 4px 4px;border-radius: 4px;">NEW</span>
							<a id="<?=$fetch_products['productId'];?>like" style="letter-spacing:0px;padding:0px;text-decoration:none;" href="../control/favController.php?drink=cold&&fav=<?=$index;?>&&pid=<?=$fetch_products['productId'];?> " class="none"><span class="wish-icon">
							<?php if($red==false){?><i class="fa fa-heart-o"> <?php }else if($red==true){echo "❤️";}?></i></span></a>
					
			
							<div class="img-box">
							<img src="../uploaded_img/<?=$fetch_products['productImage'];?>" class="img-fluid" alt="<?=$fetch_products['productName'];?>">
							</div>
							<div class="thumb-content">
								<h4><?=$fetch_products['productName'];?></h4>									
								<p class="item-price"> <span>$<?=$fetch_products['productPrice'];?></span></p>
								<form action="../control/add_to_cart.php" method="post">
                                    <input id="nbb<?=$fetch_products["productId"];?>" name="qty" type="text" class="input-field" value="1" readonly />
                                    <input type="button" value="+" name ="inccc" class="increment" onclick="inc<?=$fetch_products['productId'];?>()">
                                    <input type="button" value ="-" name="deccc" class="decrement" onclick="dec<?=$fetch_products['productId'];?>()">
									<input type="hidden" name="id" id="<?=$fetch_products["productId"];?>" value="<?=$fetch_products["productId"];?>">
									<input type="submit" name="add" value="Add to Cart" class="btn btn-primary">
								</form>
							</div>						
						</div>
					</div>
						<?php } ?>
					</div>
				</div>
				<?php if($count > 4){ ?>
				<div class="item carousel-item">
					<?php
					$select_products_sql= "SELECT * FROM restmenu WHERE productCategory = 'drinks' LIMIT 18446744073709551615 OFFSET 4;";
					if(isset($_GET['favourite']))
					{
						$select_products_sql = "SELECT * FROM restmenu,fav WHERE productCategory = 'drinks' AND restmenu.productId = fav.productId AND userId = $userId LIMIT 88888  offset 4";	
					}
					$select_products = mysqli_query($con,$select_products_sql);
					?>
					<div class="row">
							<?php
							while($fetch_products = mysqli_fetch_array($select_products)){
								$pid= $fetch_products['productId'];
								$select_products_sql = "SELECT * from fav where userId = $userId  AND productId = $pid";	
								$red = false;
								$index = "false";
								$heart_model = mysqli_query($con,$select_products_sql);
								if(mysqli_fetch_array($heart_model) ) {	
									$index = "true";
									$red = true;}
							?>
							<div class="col-sm-3">
						<div class="thumb-wrapper">
							
							<span style="color:green;float:left; position: absolute;top: 0;left: 0;position: absolute;background-color: #ff0000;color: #ffffff;font-weight: bold;padding: 4px 4px;border-radius: 4px;">NEW</span>
							<a id="<?=$fetch_products['productId'];?>like" style="letter-spacing:0px;padding:0px;text-decoration:none;" href="../control/favController.php?drink=cold&&fav=<?=$index;?>&&pid=<?=$fetch_products['productId'];?> " class="none"><span class="wish-icon">
							<?php if($red==false){?><i class="fa fa-heart-o"> <?php }else if($red==true){echo "❤️";}?></i></span></a>
					
			
							<div class="img-box">
							<img src="../uploaded_img/<?=$fetch_products['productImage'];?>" class="img-fluid" alt="<?=$fetch_products['productName'];?>">
							</div>
							<div class="thumb-content">
								<h4><?=$fetch_products['productName'];?></h4>									
								<p class="item-price"> <span>$<?=$fetch_products['productPrice'];?></span></p>
								<form action="../control/add_to_cart.php" method="post">
                                    <input id="nbb<?=$fetch_products["productId"];?>" name="qty" type="text" class="input-field" value="1" readonly />
                                    <input type="button" value="+" name ="inccc" class="increment" onclick="inc<?=$fetch_products['productId'];?>()">
                                    <input type="button" value ="-" name="deccc" class="decrement" onclick="dec<?=$fetch_products['productId'];?>()">
									<input type="hidden" name="id" id="<?=$fetch_products["productId"];?>" value="<?=$fetch_products["productId"];?>">
									<input type="submit" name="add" value="Add to Cart" class="btn btn-primary">
								</form>
							</div>						
						</div>
					</div>
						<?php } ?>	
					</div>
				</div>
				
				</div>
				<?php } ?>
			</div>
			<!-- Carousel controls -->
			<a class="carousel-control-prev" href="#myCarousel2" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-control-next" href="#myCarousel2" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
		</div>
	</div>
	<?php } else {?>
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
	<strong>YUMY:</strong> soon as possible
	</div>
	<?php } ?>
</div>
<?php } ?>

<!-- desserts menu -->

<div class="container-xl">
	<div class="row">
		<div class="col-md-12">
			<h2>Desserts <b>Menu</b></h2>
			<div id="myCarousel3" class="carousel slide" data-ride="carousel" data-interval="0">
			<!-- Carousel indicators -->
			<ol class="carousel-indicators">
			<?php
			$select_products_sql="SELECT count(*) AS 'count' from restmenu where productCategory = 'desserts'";
			if(isset($_GET['favourite']))
			{
			$select_products_sql = "SELECT count(*) AS 'count' from restmenu,fav where productCategory = 'desserts' AND restmenu.productId = fav.productId AND userId = $userId  ";	
			}
			$select_products = mysqli_query($con,$select_products_sql);
			$fetch_products = mysqli_fetch_array($select_products);
			if($fetch_products['count'] > 0){
			?>
				<?php
				$query = "SELECT count(*) AS 'count' FROM restmenu WHERE productCategory = 'desserts'";
				if(isset($_GET['favourite']))
				{
					$query = "SELECT count(*) AS 'count' FROM restmenu,fav WHERE productCategory = 'desserts' AND restmenu.productId = fav.productId AND userId = $userId";	
				}
				$result = mysqli_query($con, $query);
				if ($result) {
					$row = mysqli_fetch_assoc($result);
					$count = $row['count']	;
				  }
				else {
					header("LOCATION:error.php");
				}
				  
 				for ($i = 0 ; $i < $count ; $i++){
				?>
				<?php
				if($i == 0){ ?>
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			  	<?php }
				elseif($i > 0 && $i % 4 == 0){ ?>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<?php } ?>
				<?php } ?>
			</ol>   
			<!-- Wrapper for carousel items -->
			<div class="carousel-inner" id="desserts">
				<div class="item carousel-item active">
					<?php
					$select_products_sql="SELECT * FROM restmenu WHERE productCategory = 'desserts' LIMIT 4;";
					if(isset($_GET['favourite']))
					{
					$select_products_sql = "SELECT * FROM restmenu,fav WHERE productCategory = 'desserts' AND restmenu.productId = fav.productId AND userId = $userId LIMIT 4;";	
					}
					$select_products = mysqli_query($con,$select_products_sql);
					?>
					<div class="row">
					<?php
							while($fetch_products = mysqli_fetch_array($select_products)){
								$pid= $fetch_products['productId'];
								$select_products_sql = "SELECT * from fav where userId = $userId  AND productId = $pid";	
								$red = false;
								$index = "false";
								$heart_model = mysqli_query($con,$select_products_sql);
								if(mysqli_fetch_array($heart_model) ) {	
									$index = "true";
									$red = true;}
							?>
							<div class="col-sm-3">
						<div class="thumb-wrapper">
							
							<span style="color:green;float:left; position: absolute;top: 0;left: 0;position: absolute;background-color: #ff0000;color: #ffffff;font-weight: bold;padding: 4px 4px;border-radius: 4px;">NEW</span>
							<a id="<?=$fetch_products['productId'];?>like" style="letter-spacing:0px;padding:0px;text-decoration:none;" href="../control/favController.php?drink=cold&&fav=<?=$index;?>&&pid=<?=$fetch_products['productId'];?> " class="none"><span class="wish-icon">
							<?php if($red==false){?><i class="fa fa-heart-o"> <?php }else if($red==true){echo "❤️";}?></i></span></a>
					
			
							<div class="img-box">
							<img src="../uploaded_img/<?=$fetch_products['productImage'];?>" class="img-fluid" alt="<?=$fetch_products['productName'];?>">
							</div>
							<div class="thumb-content">
								<h4><?=$fetch_products['productName'];?></h4>									
								<p class="item-price"> <span>$<?=$fetch_products['productPrice'];?></span></p>
								<form action="../control/add_to_cart.php" method="post">
                                    <input id="nbb<?=$fetch_products["productId"];?>" name="qty" type="text" class="input-field" value="1" readonly />
                                    <input type="button" value="+" name ="inccc" class="increment" onclick="inc<?=$fetch_products['productId'];?>()">
                                    <input type="button" value ="-" name="deccc" class="decrement" onclick="dec<?=$fetch_products['productId'];?>()">
									<input type="hidden" name="id" id="<?=$fetch_products["productId"];?>" value="<?=$fetch_products["productId"];?>">
									<input type="submit" name="add" value="Add to Cart" class="btn btn-primary">
								</form>
							</div>						
						</div>
						</div>
						<?php } ?>
					</div>
				</div>
				<?php if($count > 4){ ?>
				<div class="item carousel-item">
					<?php
					$select_products_sql= "SELECT * FROM restmenu WHERE productCategory = 'desserts' LIMIT 18446744073709551615 OFFSET 4;";
					if(isset($_GET['favourite']))
					{
					$select_products_sql = "SELECT * FROM restmenu,fav WHERE productCategory = 'desserts' AND restmenu.productId = fav.productId AND userId = $userId LIMIT 18446744073709551615 OFFSET 4;";	
					}
					$select_products = mysqli_query($con,$select_products_sql);
					?>
					<div class="row">
					<?php
							while($fetch_products = mysqli_fetch_array($select_products)){
								$pid= $fetch_products['productId'];
								$select_products_sql = "SELECT * from fav where userId = $userId  AND productId = $pid";	
								$red = false;
								$index = "false";
								$heart_model = mysqli_query($con,$select_products_sql);
								if(mysqli_fetch_array($heart_model) ) {	
									$index = "true";
									$red = true;}
							?>
							<div class="col-sm-3">
						<div class="thumb-wrapper">
							
							<span style="color:green;float:left; position: absolute;top: 0;left: 0;position: absolute;background-color: #ff0000;color: #ffffff;font-weight: bold;padding: 4px 4px;border-radius: 4px;">NEW</span>
							<a id="<?=$fetch_products['productId'];?>like" style="letter-spacing:0px;padding:0px;text-decoration:none;" href="../control/favController.php?drink=cold&&fav=<?=$index;?>&&pid=<?=$fetch_products['productId'];?> " class="none"><span class="wish-icon">
							<?php if($red==false){?><i class="fa fa-heart-o"> <?php }else if($red==true){echo "❤️";}?></i></span></a>
					
			
							<div class="img-box">
							<img src="../uploaded_img/<?=$fetch_products['productImage'];?>" class="img-fluid" alt="<?=$fetch_products['productName'];?>">
							</div>
							<div class="thumb-content">
								<h4><?=$fetch_products['productName'];?></h4>									
								<p class="item-price"> <span>$<?=$fetch_products['productPrice'];?></span></p>
								<form action="../control/add_to_cart.php" method="post">
                                    <input id="nbb<?=$fetch_products["productId"];?>" name="qty" type="text" class="input-field" value="1" readonly />
                                    <input type="button" value="+" name ="inccc" class="increment" onclick="inc<?=$fetch_products['productId'];?>()">
                                    <input type="button" value ="-" name="deccc" class="decrement" onclick="dec<?=$fetch_products['productId'];?>()">
									<input type="hidden" name="id" id="<?=$fetch_products["productId"];?>" value="<?=$fetch_products["productId"];?>">
									<input type="submit" name="add" value="Add to Cart" class="btn btn-primary">
								</form>
							</div>						
						</div>
						</div>
						<?php } ?>	
					</div>
				</div>
				
				</div>
				<?php } ?>
			</div>
			<!-- Carousel controls -->
			<a class="carousel-control-prev" href="#myCarousel3" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-control-next" href="#myCarousel3" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
		</div>
	</div>
	<?php } else {?>
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
	<strong>YUMY:</strong> soon as possible
	</div>
	<?php } ?>
</div>

<!-- others menu -->

<div class="container-xl">
	<div class="row">
		<div class="col-md-12">
			<h2>others <b>Menu</b></h2>
			<div id="myCarousel4" class="carousel slide" data-ride="carousel" data-interval="0">
			<!-- Carousel indicators -->
			<ol class="carousel-indicators">
			<?php
			$select_products_sql = "SELECT count(*) AS 'count' from restmenu where productCategory = 'others'";
			if(isset($_GET['favourite']))
			{
			$select_products_sql = "SELECT count(*) AS 'count' from restmenu,fav  WHERE productCategory = 'others' AND restmenu.productId = fav.productId AND userId = $userId ;";	
			}
			$select_products = mysqli_query($con,$select_products_sql);
			$fetch_products = mysqli_fetch_array($select_products);
			if($fetch_products['count'] > 0){
			?>
				<?php
				$query = "SELECT count(*) AS 'count' FROM restmenu WHERE productCategory = 'others'";
				if(isset($_GET['favourite']))
				{
					$query = "SELECT count(*) AS 'count' FROM restmenu,fav WHERE productCategory = 'others' AND restmenu.productId = fav.productId AND userId = $userId";	
				}
				$result = mysqli_query($con, $query);
				if ($result) {
					$row = mysqli_fetch_assoc($result);
					$count = $row['count']	;
				  }
				else {
					header("LOCATION:error.php");
				}
				  
 				for ($i = 0 ; $i < $count ; $i++){
				?>
				<?php
				if($i == 0){ ?>
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			  	<?php }
				elseif($i > 0 && $i % 4 == 0){ ?>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<?php } ?>
				<?php } ?>
			</ol>   
			<!-- Wrapper for carousel items -->
			<div class="carousel-inner" id="others">
				<div class="item carousel-item active">
					<?php
					$select_products_sql="SELECT * FROM restmenu WHERE productCategory = 'others' LIMIT 4;";
					if(isset($_GET['favourite']))
					{
					$select_products_sql = "SELECT * FROM restmenu,fav WHERE productCategory = 'others' AND restmenu.productId = fav.productId AND userId = $userId LIMIT 4;";	
					}
					$select_products = mysqli_query($con,$select_products_sql);
					?>
					<div class="row">
					<?php
							while($fetch_products = mysqli_fetch_array($select_products)){
								$pid= $fetch_products['productId'];
								$select_products_sql = "SELECT * from fav where userId = $userId  AND productId = $pid";	
								$red = false;
								$index = "false";
								$heart_model = mysqli_query($con,$select_products_sql);
								if(mysqli_fetch_array($heart_model) ) {	
									$index = "true";
									$red = true;}
							?>
						<div class="col-sm-3">
							<div class="thumb-wrapper">
							
							<span style="color:green;float:left; position: absolute;top: 0;left: 0;position: absolute;background-color: #ff0000;color: #ffffff;font-weight: bold;padding: 4px 4px;border-radius: 4px;">NEW</span>
							<a id="<?=$fetch_products['productId'];?>like" style="letter-spacing:0px;padding:0px;text-decoration:none;" href="../control/favController.php?drink=cold&&fav=<?=$index;?>&&pid=<?=$fetch_products['productId'];?> " class="none"><span class="wish-icon">
							<?php if($red==false){?><i class="fa fa-heart-o"> <?php }else if($red==true){echo "❤️";}?></i></span></a>
					
			
							<div class="img-box">
							<img src="../uploaded_img/<?=$fetch_products['productImage'];?>" class="img-fluid" alt="<?=$fetch_products['productName'];?>">
							</div>
							<div class="thumb-content">
								<h4><?=$fetch_products['productName'];?></h4>									
								<p class="item-price"> <span>$<?=$fetch_products['productPrice'];?></span></p>
								<form action="../control/add_to_cart.php" method="post">
                                    <input id="nbb<?=$fetch_products["productId"];?>" name="qty" type="text" class="input-field" value="1" readonly />
                                    <input type="button" value="+" name ="inccc" class="increment" onclick="inc<?=$fetch_products['productId'];?>()">
                                    <input type="button" value ="-" name="deccc" class="decrement" onclick="dec<?=$fetch_products['productId'];?>()">
									<input type="hidden" name="id" id="<?=$fetch_products["productId"];?>" value="<?=$fetch_products["productId"];?>">
									<input type="submit" name="add" value="Add to Cart" class="btn btn-primary">
								</form>
							</div>						
						</div>
					</div>
						<?php } ?>
					</div>
				</div>
				<?php if($count > 4){ ?>
				<div class="item carousel-item">
					<?php
					$select_products_sql= "SELECT * FROM restmenu WHERE productCategory = 'others' LIMIT 18446744073709551615 OFFSET 4;";
					if(isset($_GET['favourite']))
					{
					$select_products_sql = "SELECT * FROM restmenu,fav WHERE productCategory = 'others' AND restmenu.productId = fav.productId AND userId = $userId LIMIT 18446744073709551615 OFFSET 4;";	
					}
					$select_products = mysqli_query($con,$select_products_sql);
					?>
					<div class="row">
					<?php
							while($fetch_products = mysqli_fetch_array($select_products)){
								$pid= $fetch_products['productId'];
								$select_products_sql = "SELECT * from fav where userId = $userId  AND productId = $pid";	
								$red = false;
								$index = "false";
								$heart_model = mysqli_query($con,$select_products_sql);
								if(mysqli_fetch_array($heart_model) ) {	
									$index = "true";
									$red = true;}
							?>
					<div class="col-sm-3">
						<div class="thumb-wrapper">		
							<span style="color:green;float:left; position: absolute;top: 0;left: 0;position: absolute;background-color: #ff0000;color: #ffffff;font-weight: bold;padding: 4px 4px;border-radius: 4px;">NEW</span>
							<a id="<?=$fetch_products['productId'];?>like" style="letter-spacing:0px;padding:0px;text-decoration:none;" href="../control/favController.php?drink=cold&&fav=<?=$index;?>&&pid=<?=$fetch_products['productId'];?> " class="none"><span class="wish-icon">
							<?php if($red==false){?><i class="fa fa-heart-o"> <?php }else if($red==true){echo "❤️";}?></i></span></a>
					
			
							<div class="img-box">
							<img src="../uploaded_img/<?=$fetch_products['productImage'];?>" class="img-fluid" alt="<?=$fetch_products['productName'];?>">
							</div>
							<div class="thumb-content">
								<h4><?=$fetch_products['productName'];?></h4>									
								<p class="item-price"> <span>$<?=$fetch_products['productPrice'];?></span></p>
								<form action="../control/add_to_cart.php" method="post">
                                    <input id="nbb<?=$fetch_products["productId"];?>" name="qty" type="text" class="input-field" value="1" readonly />
                                    <input type="button" value="+" name ="inccc" class="increment" onclick="inc<?=$fetch_products['productId'];?>()">
                                    <input type="button" value ="-" name="deccc" class="decrement" onclick="dec<?=$fetch_products['productId'];?>()">
									<input type="hidden" name="id" id="<?=$fetch_products["productId"];?>" value="<?=$fetch_products["productId"];?>">
									<input type="submit" name="add" value="Add to Cart" class="btn btn-primary">
								</form>
							</div>						
						</div>
					</div>
						<?php } ?>	
					</div>
				</div>
				
				</div>
				<?php } ?>
			</div>
			<!-- Carousel controls -->
			<a class="carousel-control-prev" href="#myCarousel4" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-control-next" href="#myCarousel4" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
		</div>
	</div>
	<?php } else {?>
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
	<strong>YUMY:</strong> soon as possible
	</div>
	<?php } ?>
</div>

</body>
</html>                                		