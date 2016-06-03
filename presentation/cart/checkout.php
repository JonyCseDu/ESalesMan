<?php include_once('./home/header.php');?>

<?php 
	$ara = array();
	if(isset($_COOKIE["cart"])) $ara = unserialize($_COOKIE["cart"]);
	//echo "OK";
	//print_r($ara);
?>

<div class="custom-back5" style="width:100%; display: inline-block;">
	<div class="checkout">
		<span style="color: red">
		YOU'VE ENOUGH BALANCE TO BUY THESE PRODUCT. 
		ARE YOU SURE YOU WAN'T TO CHECK OUT?
		</span>
		<div style="margin-left: 50px">
        	<a type="button" class="btn btn-default pay" href="./cart/checkOutAction.php">
        		<i class="fa fa-long-arrow-right" aria-hidden="true"></i> PAY
        	</a>
        </div>
	</div>
	<div class="invoice">
		<div class="summary">
			Invoice summary
		</div>
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
	   	<div class="cart-checkout" style="width: 95%; margin-left: auto; margin-right: auto; margin: 10px">
            <div>
                <span style="float: left; padding-left: 50px">Total: </span>
                <span style="float: right; padding-right: 50px">৳<?php echo $cost;?> </span>
            </div>
            <div style="margin-left: 50px">
            	<a type="button" class="btn btn-default cancelbutton" href="./cart/checkOutAction.php">
            		<i class="fa fa-long-arrow-right" aria-hidden="true"></i> Cancel
            	</a>
            </div>
        </div>
	</div>
</div>