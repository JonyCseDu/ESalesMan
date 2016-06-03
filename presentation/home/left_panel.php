

<?php 
session_start();
//echo "OK : " . $_SESSION["left_panel"];
$cat = jsonSend("http://localhost/business/category/get_child_category", ["id" => $_SESSION["left_panel"]]);
//echo $cat;
$cat = json_decode($cat, true);
//print_r($cat);

?>

<div class="nav-container custom-back1 remove-margin">
	  <ul class="nav">
	  <?php 
            foreach ($cat as $val){
            	//print_r($val);
            	$id = $val['id'];
            	$name = $val['name'];
            	 if($val["id"] == $_SESSION["left_panel"]) { ?>
            	 		<li class="active">
            		<?php } else { ?>
            	     	<li>
            	    <?php } ?>
            	       	<a href="<?php echo $base;?>/products?category_id=<?php echo $id;?>">
            	              <span class="text"><?php echo $name; ?></span>
            	       	</a>
            	    </li>

        <?php } ?>
      </ul>
</div>