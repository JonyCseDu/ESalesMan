<?php include_once 'top_nav.php';?>

<?php 

$cat = jsonSend("http://localhost/business/category/get_all_category");
$cat = json_decode($cat, true);

?>


<nav class="navbar" style="margin: 0px; width:100%;">
    <div class="container-fluid custom-back1" style="display: flex;">
        <!-- Brand and toggle get grouped for better mobile display -->
        
        <div style="width: 20%" align = "center">
          <a href="<?php echo $base;?>"> <img src="http://localhost/assets/img/ebay.png"/> </a>
        </div>
        
    
        <div class="searchbar" style="width: 80%; display: flex; flex: 1;">
            <div style="display: flex; flex: 2">
                <li class="dropdown" style="width: 100%; font-size: 15px; background-color: #E6E6E6";>
                    <a href="#"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" >Shop by Category<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        
                        <?php 
                        	foreach ($cat as $val){
                        		$id = $val['id'];
                        		$name = $val['name'];;
                        		//echo "<option  value='$id'> $name </option>";
                        		echo "<li><a href='#'> $name </a></li>";
                        	}
                        ?>
                    </ul>
                </li>
            </div>
            
            <div style="width: 70%; flex: 7">
                <form class="navbar-form navbar-left" role="search" style="display:flex;width: 100%;padding:0px 0px 0px 5px; height:50px">
                    <div class="form-group-lg" style="flex:3; margin-top: 3px;">
                        <input type="text" class="form-control" placeholder="What are you looking for?" id = "search-box" name="name">
                    </div>
                    <div id="mainselection" style="flex:1;">
                        <select>
                        
                        	<?php 
                        	foreach ($cat as $val){
                        		$id = $val['id'];
                        		$name = $val['name'];;
                        		echo "<option  value='$id'> $name </option>";
                        	}
                        	?>
                            
                        </select>

                    </div>
                    <input type="button" value="Search" class="btn" id = "search" style="flex: 1 onclick="redirect()"> 
                </form>
            </div>
            
            <div id="advanced" align="center">
              <a href="#">Advanced</a>
            </div>
        </div>
  </div>
</nav>

<script>
	function redirect(){
		console.log(5 + 6);
	    var sItem = document.getElementById("search-box").value;
// 	    var optItem = document.getElementById("selectOption").value;
	    var url = "/presentation/products?";
	    var flag = false;
	    if(sItem.length > 0){
	        url += "name=" + '"' + sItem + '"';
	        flag = true;
	    }
	
	    console.log(url);
	    //window.location=url;
	}
</script>