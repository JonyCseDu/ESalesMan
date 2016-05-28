
<?php
    // $data = ["option"=>["option1", "option2", "option3"], "category"=>["Top Categories", "Electornics", "Mobile", "Daily deals", "Fashion", "Collectibles & Art", "Home Utilities", "Sporting Goods"], "name"=>["Towhid"], "items"=>["item", "item", "item", "item"]];
?>


<?php include_once('./home/header.php');?>



<section  class="custom-back4" style="width: 100%; display: inline-block; padding-top: 20px;">
	<?php  include_once('./home/left_panel.php');  ?>

    <div class="jumbotron billboard custom-back1">
      	<div style="display:flex; font-size: 12px; padding: 0px 20px 0px 20px">
            <div class="buy option box bottom center">
            <h4>Why buy on e-Salesmen?</h4>
                Vast array of cell phones and smartphones
                Easy to compare multiple phones side-by-side
                Money back guarantee
            </div> 

            <div class="buy option box bottom center">
            <h4>Why buy a cell phone or smartphone?</h4>
                Cell phones make it easy to stay in contact with friends and family
                They offer useful features like built-in calendars and alarm clocks
                They provide a way to call for help in emergency situations
            </div> 

            <div class="buy option box bottom center">
            <h4>Cell phones vs. Smartphones</h4>
                Cell phones are typically much simpler to operate than smartphones
                Smartphones offer access to the Internet and useful apps
                Both provide basic calling and text messaging services
            </div> 
        </div> 
        
        <hr>

        <div style="border: padding: 5px; height: 40px">
            <ul class="nav navbar-nav nav-pills"">
                <li class="active" data-toggle="tab"><a href="#">All Listings</a></li>
                <li role="presentation"><a href="#">Auction</a></li>
                <li role="presentation"><a href="#">Buy it now</a></li>
            </ul>

            <div class="nav" style="float: right; padding-right: 20px;">
                <span>Sort:</span>
                <div class="dropdown" >
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"        aria-expanded="true">
                        Best Match
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="#">Time: ending soonest</a></li>
                        <li><a href="#">Time: added last</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Price: Highest</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <hr style="clear: both">
	<?php 
	$url = 'http://localhost/business/product/get_thumbnail';
	//print_r($tmp);
	$ret = jsonSend($url, $tmp);
	//echo $ret;
	$ret = json_decode($ret, true);
	?>
        <div style="width: 100%">
        <?php if(!isset($ret["fail"])) {?>
            <?php foreach ($ret as $num) : ?>
                <div class="product-style hvr-float">
                    <a href="<?php echo $base;?>/item?id=<?php echo $num['id'];?>"> 
                    	<?php if($num["image"] == ""){?>
                    		<img src="http://localhost/assets/img/no_image.jpg" height="200" width="300">
                    	<?php }else{?>
                    		<img src="<?php echo $num["image"];?>" height="200" width="300">
                    	<?php }?> 
                    </a>
                    <div class="product-name"> <?= htmlspecialchars($num["name"]) ?> </div>
                    <div class="product-name"> <?= htmlspecialchars("BDT " . $num["buyit_price"]) ?> </div>
                </div>
            <?php endforeach ?>
          <?php } else {?>
          		<h2 align="center"> NO PRODUCT FOUND</h2>
          <?php }?>
        </div>
    </div>
<section>

<?php include_once('./home/footer.php');?>




