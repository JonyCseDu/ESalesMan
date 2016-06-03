<?php include_once('./home/header.php');?>

<?php 
        $id = $_GET["id"];
        $product = jsonSend('http://localhost/business/product/get_product', ["id" => $id]);
        //echo "product info: ". $product ."</br>";
        $product = json_decode($product, true);
        /*print_r($product);
        */
        $auction_info = jsonSend('http://localhost/business/product/get_auction', ["id" => $id]);
        //echo "auction info: ". $auction_info ."</br>";
        $auction_info = json_decode($auction_info, true);
        
        $mn = max($auction_info["start_price"], $auction_info["last_bid_price"]) + 1;
        $mx = $product["buyit_price"] - 1;
        //echo $mn . " => " . $mx;
        
        $cat = jsonSend("http://localhost/business/category/get_category", ["id"=>$product["category_id"]]);
        //echo $cat . "</br>";
        $cat = json_decode($cat, true);
        
        
        $date =  date("Y-m-d");
        if($product["type"] == "auction" && $product["quantity"] > 0 && $date > $auction_info["last_date"]){
        	
        	//echo $date;
        	$ret = jsonSend("http://localhost/business/product/get_last_bid_user", ["product_id"=> $product["id"], "last_bid_price" => $auction_info["last_bid_price"]]); 
        	//echo $ret;
        		
        	$ret = json_decode($ret, true);
        	
        	if(isset($ret["user_id"])){
        		$data = ["id" => $product["id"], "name" => $product["name"], "buyit_price" => $auction_info["last_bid_price"], 
        				"image" => $product["image"], "quantity" => "1"];
        		
        		$tmp = ["product_id"=> $product["id"], "user_id" => $ret["user_id"]];
        		$tmp["data"] = json_encode($data);
        	
        		$ret = jsonSend("http://localhost/business/other/send_notification", $tmp);
        		//echo $ret;
        	}
//         	echo "you won it </br>";

//         	$ara = [];
//         	if(isset($_SESSION["id"])){
//         		$ara = jsonSend("http://localhost/business/other/get_notification", ["user_id" => $_SESSION["id"]]);
//         		$ara = json_decode($ara, true);
//         		if(isset($ara["fail"])) $ara = [];
//         	}
//         	// print_r($ara);
//         	if(count($ara)>0){
//         		if(isset($ara["user_id"])) $ara = [$ara];
        		
//         		foreach ($ara as $data){
//         			print_r($data);
//         			$tmp = $data["data"];
//         			if($data["product_id"] > 0) $tmp = json_decode($data["data"], true);
//         		}
//         	}
        	header("Refresh:0");
        }
        
        
?>


<section>
    <p class="product-listing-category"> All Category > <?php echo $cat["name"];?> </p>
</section>

<section class="custom-back1" style="width: 100%; display: inline-block; padding-top: 20px; height:700px">
    <div class="product-img">
        <?php if($product["image"] != ""){?>
                <div><img style='height: 100%; width: 100%; object-fit: contain' src="<?php echo $product["image"];?>"></div>
            <?php }else{?>
                <div><img src="http://localhost/assets/img/no_image.jpg" style='height: 100%; width: 100%; object-fit: contain'/></div>
            <?php }?>
    </div>

    <div class="product-sidebar">
        <h4 class="product-name"><?php echo ucfirst($product["name"]);?></h4>
        <hr>
        <!-- <ul>
            <li>Item Condition : <strong>
                <?php if($product["type"] != "auction") echo "New";
                    else echo "Old";
                ?>
            </strong></li>
        </ul> -->
        <div class="buy option box" style="width: 100%; display: inline-block">
            <div style="padding: 20px; width:40%; float:left; border: 0.5px solid white; border-radius: 4px">
            <p>Item Condition : 
                <strong>
                <?php if($product["type"] != "auction") echo "New";
                    else echo "Old";
                ?> 
                </strong>
            </p>
                <p>Buy it Price : <strong><?php echo $product["buyit_price"];?> ৳</strong></p>
              <?php if($product["type"] == "auction"){ ?>
                <p>Starting Bid : <strong><?php echo $auction_info["start_price"];?> ৳</strong></p>
                <p>Last bid Price : <strong><?php echo $auction_info["last_bid_price"];?> ৳</strong></p>
                <p>Number of Bids : <strong><?php echo $auction_info["num_of_bids"];?></strong></p>
                <p id = "baal">Remaining : <strong id="remaining-time"><?php echo $auction_info["last_date"];?></strong></p>
             <?php }?>
            </div>
            <div style="padding: 20px; width: 55%; float:left; margin-left: 20px">
      <?php if($product["quantity"] > 0){ ?>
           <form action="./product/itemAction.php" method="post">
             <input type="hidden" name="id" value="<?php echo $product["id"];?>">
             <input type="hidden" name="name" value="<?php echo $product["name"];?>">
             <input type="hidden" name="buyit_price" value="<?php echo $product["buyit_price"];?>">
             <input type="hidden" name="image" value="<?php echo $product["image"];?>">
             
             <?php if($product["type"] == "auction"){ ?>
                <div style="">
                     <input style="width: 50%; padding: 5px 0px"type="number" name="bid" value="<?php echo $mn;?>" min="<?php echo $mn;?>" max="<?php echo $mx;?>">
                     <button class="button" name="action" value="bid" style="padding: 10px 35px">
                           Bid
                     </button>
                </div>
             <?php }?>
             
                <label style="padding: 10px">Quantity :  <?php echo $product["quantity"];?> </label>
                <?php if($product["type"] != "auction"){ ?>
                    <input style="padding: 5px; margin-bottom: 10px" type="number" name="quantity" value="1" min="1" max="<?php echo $product["quantity"];?>" placeholder="max <?php echo $product["quantity"];?>">
                <?php }else{?>
                  <input style="padding: 5px; margin-bottom: 10px" type="hidden" name="quantity" value="1" min="1" max="<?php echo $product["quantity"];?>" placeholder="max <?php echo $product["quantity"];?>">
                	
                <?php }?>
                
                
                <div style="width: 100%; position: relative">
                    <button class="button" name="action" value="buy_it" style="width: 40%">
                        Buy It now
                    </button>
       				<?php if($product[type] != "auction") {?>
                    <button id="addcart" class="button" style="background-color: #58ACFA;" name="action" value="add_to_cart">
                        Add to cart
                    </button>
                    
                	<?php } ?>
                </div>
            </form>
         <?php }else{?>
            <h1>SOLD</h1>
         <?php }?>
                
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
    </div>
</section>






<section class="custom-back1" style="padding-bottom: 100px">
    <table align="center">
        <?php 
        $additional_info = $product["additional_info"];
        if($additional_info != ""){ ?>
            <ul class="nav nav-tabs" style="margin-left: 120px">
              <li role="presentation" class="active"><a href="#">Item Specifications</a></li>
            </ul>
        <?php
       	    $additional_info = json_decode($additional_info, true);
            foreach ($additional_info as $key => $value){
                echo "<tr>
                <td>$key</td>
                <td>$value</td>
                </tr>";
            }
        }
        
        ?>
    </table>
</section>

<?php include_once('./home/footer.php'); ?>


<script>
$(document).ready(function(){
    $('#addcart').click(function(){
        $('.curt-success').show()
    }) 
});

</script>

<script>
$(document).ready(function(){  
    $('.curt-success').click(function () {
        $('.curt-success').hide()
    }); 
});
</script>

<script>
    function stringToDate(_date,_format,_delimiter){
        var formatLowerCase=_format.toLowerCase();
        var formatItems=formatLowerCase.split(_delimiter);
        var dateItems=_date.split(_delimiter);
        var monthIndex=formatItems.indexOf("mm");
        var dayIndex=formatItems.indexOf("dd");
        var yearIndex=formatItems.indexOf("yyyy");
        var month=parseInt(dateItems[monthIndex]);
        month-=1;
        var formatedDate = new Date(dateItems[yearIndex],month,dateItems[dayIndex]);
        return formatedDate;
    }
    var data = <?php echo json_encode($auction_info["last_date"]); ?>;
    console.log(data);
    var dt = stringToDate(data,"dd-mm-yyyy","-");
    console.log(dt);

    $(function() {

        // Initialize the table values
       


        function countdown()
        {
            var now = new Date();
            console.log('updating time');

            
                var left = dt - now;
                var days = Math.floor( left / (1000 * 60 * 60 * 24) );
                var hours = Math.floor( (left % (1000 * 60 * 60 * 24) ) / (1000 * 60 * 60) ) + 24;
                var minutes = Math.floor( (left % (1000 * 60 * 60)) / (1000 * 60) );
                var seconds = Math.floor( (left % (1000 * 60)) / 1000 );

                displayTime = '';
                if (days > 0) {
                    displayTime = "Days: " + days;
                }
                displayTime = displayTime + hours + " : " + minutes + " : " + seconds;
				if(hours < 0 || minutes < 0 || seconds < 0) displayTime = "Time over";
                $('#remaining-time').text(displayTime);

        }
        timer = setInterval(countdown, 1000);        

    });
</script>

