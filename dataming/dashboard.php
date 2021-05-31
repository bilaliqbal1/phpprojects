<?php 
include "connection.php";
$obj=new functions();
$obj->con();

isset($_SESSION['email']) or die(header("location:login.php"));

?>
<!doctype html>
<html lang="en">
<?php include "include/head.php";?>

<body>
    <div class="wrapper">
    <?php include "include/sidebar.php";?>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
       
        </div>         
       </div>
      </div>
   </div>

   <?php include "include/footer.php";?>