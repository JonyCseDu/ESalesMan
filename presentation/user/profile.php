<?php include_once './home/header.php';?>

<?php 
	$user = jsonSend('http://localhost/business/user/get_user', ["id" => $_SESSION["id"]]);
	$user = json_decode($user, true);
	//echo $user;
?>

	<div>
		<section class="custom-back1">
	    <div class="name-pic container">
	    	<?php if($user["image"] != ""){?>
	    		<div><img src="<?php echo $user["image"];?>"></div>
	    	<?php }else{?>
	    		<div><img src="http://localhost/assets/img/no_image.jpg"></div>
	    	<?php }?>
	    	
	       
	    </div>
	     	<div><p style="font-size: 22px; padding-top: 100px">
	            	<strong>Name: <?php echo $user["name"];?></strong>
	        	</p>
	        	
	      	</div>
		</section>

		<section class="custom-back1" style="padding-bottom: 100px; padding-top:50px">
		    <table align="center">
		        <tr>
		            <td><a href="#">Name</a></td>
		            <td><?php echo $user["name"];?></td>
		        </tr>
		        
		        <tr>
		            <td>E-Mail</td>
		            <td><?php echo $user["email"];?></td>
		        </tr>
		        <tr>
		            <td >Phone</td>
		            <td><?php echo $user["phone"];?></td>
		        </tr>
		        <tr>
		            <td>Credit</td>
		            <td><?php echo $user["credit"];?></td>
		        </tr>
		    </table>
		</section>
		<section class="custom-back1" style="padding-bottom: 100px; padding-top:50px">
			<form action="./user/update.php" method="post">
				Old Password: <input type="text" name="old_password"> * </br>
				Name: <input type="text" name="name"> </br>
				New Password: <input type="text" name="new_password"> </br>
				Recharge: <input type="text" name="transaction_id", placeholder="Enter transaction key"> </br>
				<button>Update</button>
			</form>
		</section>
	</div>


	<?php
	    include_once('./home/footer.php');
	?>






