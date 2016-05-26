<?php
    //$data = ["option"=>["option1", "option2", "option3"], "Categories"=>["Top Categories", "Electornics", "Mobile", "Daily deals", "Fashion", "Collectibles & Art", "Home Utilities", "Sporting Goods"], "name"=>["Towhid"]];
?>


<?php include_once('./home/header.php');?>


<section>
    <p class="product-listing-category">Product listed in category > electronics</p>
</section>

<section class="custom-back1" style="width: 100%; display: inline-block; padding-top: 20px; height:700px">
    <div class="product-img">
        <img src="http://localhost/assets/img/iphone.jpg"/>
    </div>

    <div class="product-sidebar">
        <h4 class="product-name">Iphone-6S</h4>
        <hr>
        <ul>
            <li>Item Condition : <strong>new</strong></li>
            <li>                
                <form>
                    <label>Quantity : </label>
                    <input type="text">
                </form>
            </li>
        </ul>
        <div class="buy option box" style="width: 100%; display: inline-block">
            <div style="padding: 20px; width:50%; float:left; border: 0.5px solid white; border-radius: 4px">
                <p>Price : US $<strong>200</strong></p>
                <p> 222 watching</p>
                <br>
                <button class="button">
                    Add To Watchlist
                </button>
            </div>
            <div style="padding: 20px; width: 40%; float:left; margin-left: 20px">
                <button class="button">
                    Buy It now
                </button>
                <br>
                <br>
                <br>
                <button class="button" style="background-color: #58ACFA;">
                    Add to cart
                </button>
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
            <li>Shipping : <strong>new</strong></li>
            <li>                
                Delivery :
            </li>
            <li>Payments: </li>
            <li>Return: </li>
            <li>Guarantee:</li>
        </ul>
        
    </div>
</section>

<ul class="nav nav-tabs" style="margin-left: 120px">
  <li role="presentation" class="active"><a href="#">Item Specifications</a></li>

</ul>

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

