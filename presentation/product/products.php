
<?php
    // $data = ["option"=>["option1", "option2", "option3"], "category"=>["Top Categories", "Electornics", "Mobile", "Daily deals", "Fashion", "Collectibles & Art", "Home Utilities", "Sporting Goods"], "name"=>["Towhid"], "items"=>["item", "item", "item", "item"]];
?>


<?php include_once('./home/header.php');?>



<section  class="custom-back4" style="width: 100%; display: inline-block; padding-top: 20px; padding-bottom: 30px">
	<?php  include_once('./home/left_panel.php');  ?>

    <div class="jumbotron ballboard custom-back1">
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
    </div>
</section>

<script>
$(document).ready(function(){
	$(".auction").show();
	$(".fixed").show();
	
	$("#all_listing").click(function(){
		//alert("all_listing");
		$(".auction").show();
		$(".fixed").show();
	});
	
	$("#fixed").click(function(){
		//alert("fixed");
		$(".auction").hide();
		$(".fixed").show();
	});

	$("#auction").click(function(){
		$(".auction").show();
		$(".fixed").hide();
	});
});
</script>

<div class="custom-back5" style="margin-top: 0px">
    <div class="product-container custom-back5">    
        <div style="padding: 15px; height: 40px; margin-top: -8px">
            <ul class="nav navbar-nav nav-pills">
                <li class="active" data-toggle="tab"><a href="#" id="all_listing">All Listings</a></li>
                <li role="presentation"><a href="#" id="auction">Auction</a></li>
                <li role="presentation"><a href="#" id="fixed">Fixed</a></li>
            </ul>

            <div class="nav" style="float: right; padding-right: 20px; z-index: 4">
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
        <div style="width: 100%; display: inline-block;" class="custom-back5">
            <?php if(!isset($ret["fail"])) {?>
                <?php foreach ($ret as $num) : ?>
                    <div class="product-style hvr-float" class = "<?php echo $num['type'];?>">
                        <a href="<?php echo $base;?>/item?id=<?php echo $num['id'];?>" > 
                            <?php if($num["image"] == ""){?>
                                <img style='' src="http://localhost/assets/img/no_image.jpg">
                            <?php }else{?>
                                <img style='' src="<?php echo $num["image"];?>">
                            <?php }?> 
                        </a>
                        <div class="product-name">  <?php echo ucfirst($num["name"]);?> </div>
                        <div class="product-name">  <?php echo ucfirst($num["type"]);?> </div>
                        <div class="price">  
                            
                            <?php if($num["quantity"] == 0) {?>
                            <span style="padding: 5px; color: red; font-size: 20px">
                            	SOLD
                            </span>
                            
                            <?php } else {?>
                            <span style="padding: 5px; color: #151B54; font-size: 20px">
                            <?php echo "৳ " . $num["buyit_price"];?> 
                            </span>
                            <?php }?>
                        </div>
                        
                        
                    </div>
                <?php endforeach ?>
              <?php } else {?>
                    <h2 align="center"> NO PRODUCT FOUND</h2>
              <?php }?>
            </div>
        </div>
    </div>

</div>

<?php include_once('./home/footer.php');?>




