
<?php include_once './home/top_nav.php';?>

<nav class="navbar" style="margin-top: 0px; margin-bottom: 0px; border: 1px solid white; padding-bottom:0px;width:100%">
  	<div class="container-fluid custom-back1">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header" style="width: 20%; float: left; padding-left: 20px; padding-right: 20px">
    	<img style="padding-top: 10px;height: 60px; width: 70%" src="http://localhost/assets/img/draw.png"/>
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
        <p>Tell Us what you're selling : </p>
    </div>
    <div class="help">
        <a href="help.html" style="float: left"><i class="fa fa-question-circle" aria-hidden="true"></i>  HELP  </a>
        <a href="contact.html" style="float: left"><i class="fa fa-phone" aria-hidden="true"></i> Contact Us</a>
    </div>
</div>

<hr style="margin-top: 0px; margin-left: 20px; border-color: black">

	<section class="listing">
    <form role="form" method="post" action="./product/sellAction.php" enctype="multipart/form-data">
    <div class="listing1">
        <h3>Choose Category : </h3>
        <select name="category_id" id="category_id">
        	<?php 
        		$cat = jsonSend("http://localhost/business/category/get_all_category");
				$cat = json_decode($cat, true);
				//print_r($cat);
// 				echo htmlspecialchars("<option  value='$cat'>$cat</option>");
				$flag = false;
				foreach ($cat as $val){
					$id = $val['id'];
					$name = $val['name'];;
					if($flag) echo "<option  value='$id'> $name </option>";
					else echo "<option  value='$id' selected> $name </option>";
					$flag = true;
				}
        	?>

        </select>
        
<script>
$(document).ready(function(){
	$(".additional_info").hide();
	$("#category_id").change(function(){
		$(".additional_info").show();
		$.getJSON("http://localhost/business/category/get_additional_info/" + $(this).val(), function(result){
	         $.each(result, function(i, field){
	           		//alert(getHtml(field));
	               	$(".additional_info").html(getHtml(field));
	         });
	    });
	});
	
	$(".auction").hide();
    $("#type").change(function(){
       if($("#type").val() == "auction")$(".auction").show();
       else $(".auction").hide();	
    });
});

function getHtml(val) {
	var arr = jQuery.parseJSON(val);
	ret = "";
	for(var i=0; i<arr.length; i++){
        var obj = arr[i];
        
        ret += "<div class='form-group'> <label for='"+ obj +"'> "+ obj + ":</label>" +
        " <input type='text' class='form-control' " +
         " name='_"+ obj +"'> </div>";
    }
    return ret;
}

</script>

    </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter product name" name="name" required>
        </div>
        
        <div class="form-group">
        	<label for="type">Type:</label>
             <select name="type"  class="form-control" id="type">
             	<option value="fixed" selected>Fixed Price</option>
			  	<option value="auction">Auction</option>
			</select> 
        </div>
        
       
    <!-- auction date starts -->
        <div id="start_price" class='auction form-group'> 
        	<label for='start_price'>Start Price:</label> 
    	    <input placeholder='Min price' name='start_price' type='number' class='form-control'> 
    	</div>
    	    
	    <div id="last_date" class="auction form-group" > 
	    	  <label for="last_date">Auction Date:</label> 
	    	  <input placeholder='DD-MM-YY (Auction will close at 12.00pm)' type="text" name="last_date" class="form-control"> 
	    </div>
	<!-- auction date ends -->
        
        <div class="form-group">
            <label for="buyit_price">Last Price:</label>
            <input type="number" class="form-control" id="buyit_price" placeholder="Enter buyit_price" name="buyit_price" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" class="form-control" id="quantity" placeholder="Enter quantity" name="quantity">
        </div>
        
	<!-- additional info starts -->
        <div class="additional_info">
            
        </div>
    <!-- additional info ends -->   
    
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


