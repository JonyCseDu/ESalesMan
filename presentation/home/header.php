<?php include_once 'top_nav.php';?>

<?php 

$cat = jsonSend("http://localhost/business/category/get_all_category");
$cat = json_decode($cat, true);

?>

<script>
function showHint(str) {
    
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var arr = JSON.parse(xmlhttp.responseText);
                var hint = "";
                for(var i=0;i<arr.length;i++){
                    var obj = arr[i];
                    
                    hint += "<li onClick=\"selectlocation('" + obj + "')\">" + obj + "</li>";
                    
                }
                document.getElementById("txtHint").innerHTML = hint;
            }
        };
        xmlhttp.open("GET", "http://localhost/business/other/search_name?table=Product&name=" + str, true);
        xmlhttp.send();
    }
    $("#suggesstion").show();
}

function selectlocation(val) {
    $("#search-box").val(val);
    $("#suggesstion").hide();
}
</script>


<nav class="navbar" style="margin: 0px; width:100%;">
    <div class="container-fluid custom-back1" style="display: flex;">
        <!-- Brand and toggle get grouped for better mobile display -->
        
        <div style="width: 20%" align = "center">
          <a href="<?php echo $base;?>"> <img style="padding-top: 10px;height: 60px; width: 70%" src="http://localhost/assets/img/draw.png"/> </a>
        </div>
        
            
            <div style="width: 70%; flex: 7">
                <form class="navbar-form navbar-left" role="search" style="display:flex;width: 100%;padding:0px 0px 0px 5px; height:50px" action = "<?php echo $base?>/products" method="get">
                    <div class="form-group-lg" style="flex:3; margin-top: 3px;">
                        <input type="text" class="form-control" placeholder="What are you looking for?" id = "search-box" name="name" onkeyup="showHint(this.value)">
                         
                         <!-- ADD SUGGESTION STYLE -->
                         <div id="suggesstion" class="hid">
                            <ul id="txtHint" class="search-results">
                            
                            </ul>
                         </div>
                         
                         
                         
                    </div>
                   
                    <div id="mainselection" style="flex:1;">
                        <select name="category_id">
                        
                            <?php 
                            foreach ($cat as $val){
                                $id = $val['id'];
                                $name = $val['name'];;
                                echo "<option  value='$id'> $name </option>";
                            }
                            ?>
                            
                        </select>

                    </div>
                    <button class="btn" id = "search" style="flex: 1"> Search </button>
                    
                </form>
            </div>
            
            <div id="advanced" align="center">
              <a href="#">Advanced</a>
            </div>
        </div>
  </div>
</nav>




