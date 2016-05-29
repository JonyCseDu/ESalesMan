<?php include_once('./home/header.php');?>

<?php 
    	$data = jsonSend($url, $tmp);
    	$data = json_decode($data, true);
    	$isAuction = ($data["min_price"] != $data["min_price"]);
    	
    	$cat = jsonSend("http://localhost/business/category/get_category_name", ["id"=>$data["category_id"]]);
    	$cat = json_decode($cat, true);
?>


<section>
    <p class="product-listing-category"> All Category > <?php echo $cat["name"];?> </p>
</section>

<section class="custom-back1" style="width: 100%; display: inline-block; padding-top: 20px; height:700px">
    <div class="product-img">
        <img src="<?php echo $data["image"];?>" height="600" width="400"/>
    </div>

    <div class="product-sidebar">
        <h4 class="product-name"><?php echo $data["name"];?></h4>
        <hr>
        <ul>
            <li>Item Condition : <strong>
            	<?php if(!$isAuction) echo "New";
            		else echo "Old";
            	?>
            </strong></li>
        </ul>
        <div class="buy option box" style="width: 100%; display: inline-block">
            <div style="padding: 20px; width:50%; float:left; border: 0.5px solid white; border-radius: 4px">
                <p>Min Price : BDT <strong><?php echo $data["min_price"];?></strong></p>
                <p>Buy it Price : BDT <strong><?php echo $data["buyit_price"];?></strong></p>
                <p> 222 watching</p>
                <br>
                <button class="button">
                    Add To Watchlist
                </button>
            </div>
            <div style="padding: 20px; width: 40%; float:left; margin-left: 20px">
            
            <form action="./product/cartAction.php" method="post">
            
           	 <input type="hidden" name="id" value=<?php echo $data["id"];?>>
           	 <input type="hidden" name="name" value=<?php echo $data["name"];?>>
           	 <input type="hidden" name="buyit_price" value=<?php echo $data["buyit_price"];?>>
           	 <input type="hidden" name="image" value=<?php echo $data["image"];?>>
                 <label>Quantity : </label>
                 <input type="number" name="quantity" value="0" min="0" max="<?php echo $data["quantity"];?>" placeholder="max <?php echo $data["quantity"];?>">
                <br>
                <br>
                <button class="button" name="url" value="http://localhost/presentation/item?id=<?php echo $data["id"];?>">
                    Buy It now
                </button>
                <br>
                <br>
       
                <button class="button" style="background-color: #58ACFA;" name="url" value="http://localhost/presentation/item?id=<?php echo $data["id"];?>">
                    Add to cart
                </button>
            </form>
                
            </div>
        </div>
        <div style="width: 100%; display: inline-block">
            <div class="buy option box bottom">
                286<br>sold
            </div>
            
            <div class="buy option box bottom">
                Experienced<br>Seller
            </div>
            
            <div class="buy option box bottom">
                30 day money back guarantee
            </div>
        </div>
        <ul>
            <li>Num Of bits: <strong> <?php echo $data["num_of_bids"];?> </strong> </li>
            <li>Guarantee: <strong> 3 years </strong></li>
        </ul>
        
    </div>
</section>

<ul class="nav nav-tabs" style="margin-left: 120px">
  <li role="presentation" class="active"><a href="#">Item Specifications</a></li>

</ul>

<?php 
	//$cat = get_additional_info();
?>

<section class="custom-back1" style="padding-bottom: 100px">
    <table align="center">
    	<?php 
    	$data = jsonSend($url, $tmp);
    	$data = json_decode($data, true);
    	foreach ($data as $key => $value){
    		echo "<tr>
		            <td>$key</td>
		            <td>$value</td>
		        </tr>";
    	}
    	?>
    </table>
</section>

<?php include_once('./home/footer.php'); ?>

