

<?php 

$cat = jsonSend("http://localhost/business/category/get_all_category");
$cat = json_decode($cat, true);

?>

<div class="nav-container custom-back1 remove-margin">
	  <ul class="nav">
	  <?php 
            foreach ($cat as $val){
            	$id = $val['id'];
            	$name = $val['name'];
            	 if($val["id"] == "1") { ?>
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