<?php
    //$data = ["category"=>["Top category", "Electornics", "Mobile", "Daily deals", "Fashion", "Collectibles & Art", "Home Utilities", "Sporting Goods"], "name"=>["Towhid"]];
   $data["category"] = ["Top category", "Electornics", "Mobile", "Daily deals", "Fashion", "Collectibles & Art", "Home Utilities", "Sporting Goods"];
//    print_r($_SESSION);
//    print_r($data);
   //$data["name"] = ["Towhid"];
?>

<?php include_once('header.php'); ?>

<section  class="custom-back4" style="width: 100%; display: inline-block; padding-top: 20px;  height: 700px">
    <?php include_once('left_panel.php'); ?>

    <div class="jumbotron billboard">
      	<img src="http://localhost/assets/img/laptop.png"/>
      	<ul>
      	<li><h1>Shop Smart</h1></li>
      	<li><p>Get ahead with the best tech around</p></li>
      	<li><a class="btn btn-primary btn-lg" href="#" role="button">Shop Now</a></li>
      	</ul>
    </div>
</section>

<?php include_once('footer.php'); ?>
