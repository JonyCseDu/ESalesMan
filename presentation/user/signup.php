<?php
    $data = ["option"=>["option1", "option2", "option3"], "Categories"=>["Top Categories", "Electornics", "Mobile", "Daily deals", "Fashion", "Collectibles & Art", "Home Utilities", "Sporting Goods"], "name"=>["Towhid"]];
?>

<?php include_once('./home/header.php');?>



<hr style="border-color: black">
<div class="container" style="padding-bottom: 200px">    
    <div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Sign Up</div>
                <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="<?php echo $base;?>/login">Sign In</a></div>
            </div>  
            <div class="panel-body" >
                <form id="signupform" class="form-horizontal" role="form" method="post" action="./user/signupAction.php">
                    <div id="signupalert" style="display:none" class="alert alert-danger">
                        <p>Error:</p>
                        <span></span>
                    </div>
                      
                    <div class="form-group">
                        <label for="email" class="col-md-3 control-label">Email</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="email" placeholder="Email Address">
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label for="firstname" class="col-md-3 control-label">Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="name" placeholder="First Name">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password" class="col-md-3 control-label">Password</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lastname" class="col-md-3 control-label">Phone</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="phone" placeholder="Last Name">
                        </div>
                    </div>
                

                    <div class="form-group">
                        <!-- Button -->                                        
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" name="url" value="http://localhost/business/user/signup" class="signup">
                                <i class="fa fa-user-plus" aria-hidden="true"></i> Sign Up
                            </button>
                            <span style="margin-left:8px;">or</span>  
                        </div>
                    </div>
                    
                    <div style="border-top: 1px solid #999; padding-top:20px"  class="form-group">
                        
                        <div class="col-md-offset-3 col-md-9">
                            <button id="btn-fbsignup" type="button" class="btn btn-primary"><i class="fa fa-facebook" aria-hidden="true"></i> Sign Up with Facebook</button>
                        </div>                                           
                            
                    </div>  
                </form>
            </div>
        </div>
    </div> 
</div>

<?php include_once('./home/footer.php');?>
