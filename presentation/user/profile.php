<?php include_once './home/header.php';?>

<?php 
	$user = jsonSend('http://localhost/business/user/get_user', ["id" => $_SESSION["id"]]);
	$user = json_decode($user, true);
	//echo $user;
?>


	<div class="custom-back1" style="height: 200px;">
	    <div class="name-pic" style="float: left">
	    	<?php if($user["image"] != ""){?>
	    		<div><img src="<?php echo $user["image"];?>"></div>
	    	<?php }else{?>
	    		<div style="height: 200px"><img src="http://localhost/assets/img/laptop.png"></div>
	    	<?php }?>
	    </div>

     	<div style="float: left; width: 20%">
	     	<p style="font-size: 22px; padding-top: 100px; padding-left: 30px">
	            <strong>Name: <?php echo $user["name"];?></strong>
	        </p>
      	</div>
	</div>

	<div class="custom-back1" style="padding-bottom: 100px; padding-top:50px;">
	    <table align="center">
	        <tr>
	            <td>Name</td>
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
	</div>
	<div class="custom-back1" style="padding-bottom: 100px;">
		<form action="./user/update.php" method="post">
			<table align="center">
	        	<tr>
		            <td>Old Password: </td>
		            <td><input type="text" name="old_password"> * </td>
		        </tr>
		        
		        <tr>
		            <td>Name: </td>
		            <td><input type="text" name="name"> </td>
		        </tr>
		        <tr>
		            <td>New Password: </td>
		            <td><input type="text" name="new_password"> </td>
		        </tr>
		        <tr>
		            <td>Recharge: </td>
		            <td><input type="text" name="transaction_id", placeholder="Enter transaction key"></td>
		        </tr>
		    </table>
			<div class="updatebutton">
				<button class="btn-lg">Update</button>	
			</div>
		</form>
	</div>
	


	<?php
	    include_once('./home/footer.php');
	?>






