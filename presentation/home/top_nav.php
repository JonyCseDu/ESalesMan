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
    <script src="http://localhost/assets/js/script.js"></script>
    <script src="http://localhost/assets/js/jquery-1.12.4.min.js"></script>


    
    <script src="http://localhost/assets/sss.min.js"></script>
    <link rel="stylesheet" href="http://localhost/assets/sss.css" type="text/css" media="all">

    <script>
    jQuery(function($) {
    $('.slider').sss();
    });
    </script>
</head>
<body>

<nav class="navbar navbar-top">
  <div class="container-fluid"  style="text-align:center">
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-custom-nav1" style="display:flex; width: 40%; font-weight: bold">
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
      
      <ul class="nav navbar-nav navbar-custom-nav1 navbar-right custom-font1" style="width: 40%; display: flex; font-weight: bold">
        
<?php if (isset($_SESSION["id"])) { ?>

		<li class="dropdown" style="flex:1;" align = "center">
          	<button class="dropbtn" style="display: block; height: 100%;font-size: 14px;">My Account</button>
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

<?php 
	$ara = [];
	if(isset($_SESSION["id"])){
		$ara = jsonSend("http://localhost/business/other/get_notification", ["user_id" => $_SESSION["id"]]);
		$ara = json_decode($ara, true);
		if(isset($ara["fail"])) $ara = [];
		if(isset($ara["user_id"])) $ara = [$ara];
	}
	//echo "OK";
	//print_r($ara);
?>
        

        
        <li class="dropdown" align = "center">
            <button class="dropbtn" style="display: block; height: 100%;font-size: 14px;">
                <span class="fa fa-bell" aria-hidden="true"></span> Notifications
                <?php if(count($ara)>0) { ?>
                    <span style="background-color: #d8613b; padding: 7px 8px; border-radius:10px"><?php echo count($ara); ?><span>
                <?php }  ?>
            </button>
            <div class="cart" align="center">
                
                
            <?php if(count($ara)>0){ 
            	foreach ($ara as $data){ 
            		if($data["product_id"] == 0){ ?>
            			<h3> <?php echo $data["data"]; ?> </h3>
            		<?php }else{ 
            			$tmpProduct = json_decode($data["data"], true);
            		?>
            		<form action="./product/itemAction.php" method="post">
            			<input type="hidden" name="user_id" value="<?php echo $_SESSION["id"];?>">
             			<input type="hidden" name="id" value="<?php echo $tmpProduct["id"];?>">
			             <input type="hidden" name="name" value="<?php echo $tmpProduct["name"];?>">
			             <input type="hidden" name="buyit_price" value="<?php echo $tmpProduct["buyit_price"];?>">
			             <input type="hidden" name="image" value="<?php echo $tmpProduct["image"];?>">
			             <input type="hidden" name="quantity" value="<?php echo $tmpProduct["quantity"];?>">
			             <p3> Congrats You won The Bid For <?php echo $tmpProduct["name"]; ?> </p3>
			             <button class="button" name="action" value="notify" style="width: 100px; height: 35px; font-size: 10px">
	                        Buy It now
	                    </button>
			         </form>
            		<?php }?>
				<?php }
			}else {?>
				<h3> <?php echo "No Notification"; ?> </h3>
			<?php }?>
				
        </li>
        
<?php 
	$ara = array();
	if(isset($_COOKIE["cart"])) $ara = unserialize($_COOKIE["cart"]);
	//echo "OK";
	//print_r($ara);
?>


        <li class="dropdown" align = "center">
            <button class="dropbtn" style="display: block; height: 100%;font-size: 14px;">
                <span class="fa fa-shopping-cart" aria-hidden="true"></span> Cart
                <?php if(count($ara)>0) { ?>
                    <span style="background-color: #d8613b; padding: 7px 8px; border-radius:10px"><?php echo count($ara); ?><span>
                <?php }  ?>
            </button>
            <div class="cart" align="center">
                <div class="cartheader">
                    <span style="float: left">Cart (<?php echo count($ara); ?>)</span>
                    <span style="float: right">
                        <a href="http://localhost/presentation/cart">View Cart</a>
                    </span>
                </div>
            <?php if(count($ara)>0){ 
            	$cost = 0 ?>
            	
            	<?php foreach ($ara as $id => $cart){
            		$cost += $cart["buyit_price"] * $cart["quantity"];
            		?>
            		<div class="cartitem">
                        <div style="width: 80px; height: 100px; float: left">
                            <?php if($cart["image"] == ""){?>
                                <img src="http://localhost/assets/img/no_image.jpg">
                            <?php }else{?>
                                <img src="<?php echo $cart["image"];?>">
                             <?php }?> 
                        </div>
                        
                        <div style="width: 70%" class="cartitemd"><?php echo $cart["name"];?>
                            <strong style="text-transform: lowercase">x</strong> 
                            <strong style="font-size: 14px"><?php echo $cart["quantity"];?></strong>
                        </div>
                        <div class="cartitemd">৳<?php echo $cart["buyit_price"] * $cart["quantity"] ;?></div>
                    </div>
                    
            	   <?php }?>

                    <hr>
            	   <div class="cart-checkout">
                        <div>
                            <span style="float: left; padding-left: 50px">Estimated Total: </span>
                            <span style="float: right; padding-right: 50px">৳<?php echo $cost;?> </span>
                        </div>
                        <a type="button" class="btn btn-default cart-checkout-button2" href="./cart/checkOutAction.php">
                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i> Proceed To Checkout
                        </a>
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

