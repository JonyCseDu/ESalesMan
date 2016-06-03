<?php include_once('header.php');?>

<div class="custom-back5">
	<div class="cartheader2">
		YOUR CART (<?php echo count($ara); ?>)
	</div>
	<div class="cartdiv">
	<?php if(count($ara)>0){ 
		$cost = 0 ?>
		
		<?php foreach ($ara as $id => $cart){
			$cost += $cart["buyit_price"] * $cart["quantity"];
			?>
			<div class="cartitem2">
	            <?php if($cart["image"] == ""){?>
	                <img src="http://localhost/assets/img/no_image.jpg">
	            <?php }else{?>
	                <img src="<?php echo $cart["image"];?>">
	            <?php }?> 
	            
	            <div class="cartitem2div">
		            <div><?php echo $cart["name"];?>
		                <strong style="text-transform: lowercase">x</strong> 
		                <strong style="font-size: 14px"><?php echo $cart["quantity"];?></strong>
		            </div>
		            <div> <span style="font-weight: normal">Quantity: </span>
		            	<span class="black"><?php echo $cart["quantity"]; ?> </span> 
		            	<a type="button" href="" class="iconplus">
		        	 		<i class="fa fa-plus" aria-hidden="true"></i>
		        	 	</a>
		        	 	<a type="button" href="" class="iconminus">
		        	 		<i class="fa fa-minus" aria-hidden="true"></i>
		        	 	</a>

					</div>
		            <div> <span style="font-weight: normal">Price: </span> 
		            	<span class="black">
		            		৳<?php echo $cart["buyit_price"] * $cart["quantity"] ;?>
		            	</span>
		            </div>
	            </div>
	        	 <div class="removeproduct">
	        	 	<a type="button" href="">
	        	 		<i class="fa fa-times" aria-hidden="true"></i>
	        	 	</a>
		        	
		        </div>
	        </div>
	       
		   <?php }?>

	        <hr>
		   <div class="cart-checkout2">
	            <div style="height: 60px; padding-top: 20px">
	                <span style="float: left; padding-left: 50px">Estimated Total: </span>
	                <span style="float: right; padding-right: 150px">৳<?php echo $cost;?> </span>
	            </div>
	            <div style="margin-left: 50px">
	            	<a type="button" class="btn btn-default cart-checkout-button2" href="./cart/checkOutAction.php">
	            		<i class="fa fa-long-arrow-right" aria-hidden="true"></i> Proceed To Checkout
	            	</a>
	            </div>
	        </div>
	<?php }else{?>
	    <div class="cartitem">
		   <h3 style="padding: 30px"> <?php echo "No Item in cart"; ?> </h3>
	    </div>
	<?php }?>
	</div>

</div>

<?php include_once('footer.php'); ?>