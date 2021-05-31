<?php
include "connection.php";
$obj=new functions();
$obj->con();
if(isset($_POST['btn_ent']))
{
	header('Location:index.php');
}
if(isset($_POST['btn_reg']))
{
	$obj->login($_POST['txtemail'],$_POST['txtpass']);
	header('Location:dashboard.php');
}
;?> 
<!DOCTYPE html>
<html lang="en" class="body-full-height">
<head>        
        <!-- META SECTION -->
        <title>Missing Data Handler </title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
           <!--====== FAVICON ICON =======-->
           <link rel="shortcut icon" type="image/ico" href="assets/images/favicon.png" />
           
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->                                    
    </head>
    <body>
        
        <div class="login-container">
        
            <div class="login-box animated fadeInDown">
                <div class="login-logo"></div>
                <div class="login-body">
                    <div class="login-title"><strong>Welcome to Missing Data Handler</strong>, Please login</div>
                    <form class="form-horizontal" method="post">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="email" class="form-control" placeholder="Username" name="txtemail"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" class="form-control" placeholder="Password" name="txtpass"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                        <button type="submit" class="btn btn-block btn-warning text-white py-3 px-5" name="btn_ent">Back</button>
                        </div>
                        <div class="col-md-6">
						<button type="submit" class="btn btn-block btn-warning text-white py-3 px-5" name="btn_reg">Log In</button>
                       </div>
                    </div>
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy;  2020| Missing Data Handler                </div>
                </div>
            </div>
            
        </div>
        
    </body>
</html>





