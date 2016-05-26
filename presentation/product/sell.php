
<?php
    $data = ["option"=>["option1", "option2", "option3"], "Categories"=>["Top Categories", "c1", "Mobile", "Daily deals", "Fashion", "Collectibles & Art", "Home Utilities", "Sporting Goods"], "name"=>["Towhid"]];
?>

<?php include_once './home/top_nav.php';?>

<nav class="navbar" style="margin-top: 0px; margin-bottom: 0px; border: 1px solid white; padding-bottom:0px;width:100%">
  	<div class="container-fluid custom-back1">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header" style="width: 20%; float: left; padding-left: 20px; padding-right: 20px">
    	<img src="http://localhost/assets/img/ebay.png"/>
    </div>

    <div style="width:75%; float: left; padding-top: 25px; padding-left: 5px;">
        <ol class="sell step">
            <li>Tell Us What You Are Selling</li>
            <li>Create Your Listing</li>
            <li>Review Your Listing</li>
        </ol>
    </div>
    </div>
</nav>



<div class="sell step step" style="display: flex">
    <div style="width: 75%; float: left;">
        <p>Tell Us what you're selling : Select Category</p>
    </div>
    <div class="help">
        <a href="help.html" style="float: left"><i class="fa fa-question-circle" aria-hidden="true"></i>  HELP  </a>
        <a href="contact.html" style="float: left"><i class="fa fa-phone" aria-hidden="true"></i> Contact Us</a>
    </div>
</div>

<hr style="margin-top: 0px; margin-left: 20px; border-color: black">

	<section class="listing">
    

    <form role="form" method="post" action="post.php" enctype="multipart/form-data">
    <div class="listing1">
        <h3>Choose Category : </h3>
        <select name="category_name">
            <option  value="none">choose one</option>
            <option value="c1">c1</option>
            <option>Smartphones</option>
            <option>Fashion</optgroup>
            <option>Home Utilities</option>
            <option>Sports Goods</option>
            <option>Gardening</option>
            <option>abcd</option>
            <option>efgh</option>
        </select>
        <p align="right">(Must Choose)</p>
    </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="name" class="form-control" id="name" placeholder="Enter product name" name="name">
        </div>
        <div class="form-group">
            <label for="min_price">min_price:</label>
            <input type="number" class="form-control" id="min_price" placeholder="Enter min_price (required for auction)" name="min_price">
        </div>
        <div class="form-group">
            <label for="buyit_price">buyit_price:</label>
            <input type="number" class="form-control" id="buyit_price" placeholder="Enter buyit_price" name="buyit_price">
        </div>
        <div class="form-group">
            <label for="quantity">quantity:</label>
            <input type="number" class="form-control" id="quantity" placeholder="Enter quantity" name="quantity">
        </div>

        <div class="form-group">
            <label for="">additional_info:</label>
            <input type="additional_info" class="form-control" id="additional_info" placeholder="Enter additional_info" name="additional_info">
        </div>
        <!-- <form method="POST" action="example.cgi" enctype="multipart/form-data"> -->
        <div class="form-group">
            <label for="file">Add image:</label>
            <input type="file" name="image" style="margin-left: 20px">
        </div>
        
    
        <!-- </form>  -->

        <button type="submit" name="url" value="http://localhost/business/product/add_product" class="btn btn-default btn10">Submit</button>
    </form>
    
</section>

<?php
    include_once('./home/footer.php');
?>


