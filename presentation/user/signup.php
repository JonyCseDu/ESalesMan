<?php
    $data = ["option"=>["option1", "option2", "option3"], "Categories"=>["Top Categories", "Electornics", "Mobile", "Daily deals", "Fashion", "Collectibles & Art", "Home Utilities", "Sporting Goods"], "name"=>["Towhid"]];
?>

<?php include_once('./home/header.php');?>

<script>
function myfunc(val){
	if(val.trim().length == 0) alert("empty"); 
}
</script>



<hr style="border-color: black">
<div class="container" style="padding-bottom: 200px">    
    <div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Sign Up</div>
                <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="<?php echo $base;?>/login">Sign In</a></div>
            </div>  
            <div class="panel-body" >
                <form id="signupform" class="form-horizontal" role="form" method="post" action="./user/signupAction.php" enctype="multipart/form-data">
                    <div id="signupalert" style="display:none" class="alert alert-danger">
                        <p>Error:</p>
                        <span></span>
                    </div>
                      
                    <div class="form-group">
                        <label for="email" class="col-md-3 control-label">Email</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="email" placeholder="Email Address" required>
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label for="firstname" class="col-md-3 control-label">Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="name" placeholder="First Name" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password" class="col-md-3 control-label">Password</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Phone" class="col-md-3 control-label">Phone</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="phone" placeholder="Phone">
                        </div>
                    </div>
                    
                    <div class="form-group">
			            <label for="file">Add Profile Picture:</label>
			            <input type="file" name="image" style="margin-left: 20px">
			        </div>
                

                    <div class="form-group">
                        <!-- Button -->                                        
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" name="url" value="http://localhost/business/user/signup" class="signup" id="signup">
                                <i class="fa fa-user-plus" aria-hidden="true"></i> Sign Up
                            </button>
                            <div class="alert alert-success alert-dismissable sign-up-success" style="display: none">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" id ="hideme">&times;</button>
                                Success! An verification email has been sent to your account. Check your email to verify.
                            </div>

                        </div>
                    </div>
                    
                    <div>
                        <?php if($_SESSION["error"]){
                        	echo $_SESSION["error"];
                        }?>
                                                                  
                            
                    </div>  
                </form>
            </div>
        </div>
    </div> 
</div>

<?php include_once('./home/footer.php');?>


<script>
$(document).ready(function(){
    var bad = 0;
    $('#signupform :input').each(function (){
        if ($.trim(this.value) == "") bad++;
    });  

    $('#signup').click(function(){
        if(bad < 1) $('.sign-up-success').show()
    }) 
});

</script>

<script>
$(document).ready(function(){  
    $('#hideme').click(function () {
        $('.sign-up-success').hide()
    }); 
});
</script>