<?php session_start(); ?> 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Salesman</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/assets/style.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/assets/bootstrap/font-awesome/css/font-awesome.min.css">
    <script type="text/javascript" src="http://localhost/assets/js/script.js"></script>
</head>
<body>

<nav class="navbar navbar-top">
  <div class="container-fluid"  style="text-align:center">
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-custom-nav1" style="display:flex; width: 40%;">
        <li align="center"> <a href="<?php echo $base;?>">Hello
                <strong>
                <?php 
                	if(isset($_SESSION["id"])) echo $_SESSION["name"];
                	else echo "guest";
                ?>
                </strong>
          </a>
        </li>
        <li class="active divider-vertical"><a href="<?php echo $base;?>/sell">Sell</a></li>
        <li class="divider-vertical"><a href="#">Help & Support</a></li>
        
      </ul>
      
      <ul class="nav navbar-nav navbar-custom-nav1 navbar-right custom-font1" style="width: 40%; display: flex">
        
<?php if (isset($_SESSION["id"])) { ?>

		<li class="dropdown" style="flex:2;" align = "center">
          	<button class="dropbtn" style="display: block; height: 100%;font-size: 14px; font-weight: normal">My Account</button>
	        <ul class="dropdown-content container-fluid" style="padding: 0px">
	          <a href="<?php echo $base;?>/profile">View Profile</a>
	          <a href="./user/logoutAction.php">Log Out</a>
	        </ul>
        </li>
    
<?php } else { ?>
    	<li class="dropdown" style="flex:1;" align = "center">
          	<button class="dropbtn" style="display: block; height: 100%;font-size: 14px; font-weight: normal">Guest</button>
	        <ul class="dropdown-content container-fluid" style="padding: 0px">
	          <a href="<?php echo $base;?>/login">Log In</a>
	          <a href="<?php echo $base;?>/signup">Register</a>
	        </ul>
        </li>
<?php } ?>
        

        
        <li align = "center">
            <button class="dropbtn" style="display: block; height: 100%;font-size: 14px;">
                <span class="fa fa-bell" aria-hidden="true"></span> Notification
            </button>
        </li>
        
<?php 
	$ara = array();
	if(isset($_COOKIE["cart"])) $ara = unserialize($_COOKIE["cart"]);
	//echo "OK";
	//print_r($ara);
?>


        <li class="dropdown" align = "center">
            <button class="dropbtn" style="display: block; height: 100%;font-size: 14px;font-weight: normal">
                <span class="fa fa-shopping-cart" aria-hidden="true"></span> Cart
            </button>
            <div class="cart" align="center">
            
<?php if(count($ara)>0){ 
	$cost = 0 ?>
	
	<?php foreach ($ara as $id => $cart){
		$cost += $cart["buyit_price"] * $cart["quantity"];
		?>
		<div class="cartitem">
               <img src="<?php echo $cart["image"];?>">
               <strong><?php echo $cart["name"];?></strong>
               <strong>Price: <?php echo $cart["buyit_price"] * $cart["quantity"] ;?></strong>
        </div>
        <hr class="nomargin">
	<?php }?>
	<div class="cart-checkout">
                    <div style="text-align:center;">Estimated Total: BDT <?php echo $cost;?></div>
                    <a type="button" class="btn btn-default" href="./product/checkOut.php">Proceed To Checkout</a>
     </div>
<?php }else{?>
<div class="cartitem">
	<h3> <?php echo "No Item in cart"; ?> </h3>
</div>
<?php }?>



            </div>

        </li>
    
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
