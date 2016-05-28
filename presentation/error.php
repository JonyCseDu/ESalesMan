<?php
	session_start();
    //$data = ["option"=>["--select category--", "option2", "option3"], "Categories"=>["Top Categories", "Electornics", "Mobile", "Daily deals", "Fashion", "Collectibles & Art", "Home Utilities", "Sporting Goods"], "name"=>["Towhid"]];
?>

<?php include_once './home/header.php';?>

<section class="error">
    <h1>
        <i class="fa fa-times-circle-o" aria-hidden = "true"></i>
        <?php echo $_SESSION["fail"]?>
    </h1>
    <br>
    <span><a href="<?php echo $base;?>"> Click me for returning to home page</a></span>
</section>



