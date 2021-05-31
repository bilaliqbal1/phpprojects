<?php 
$conn=mysqli_connect("localhost","root","","datamining");
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
$email=$_SESSION['email'];
$sel=mysqli_query($conn,"select * from login where Email='".$email."'");
$fetch=mysqli_fetch_array($sel);
?>
<nav id="sidebar" class="active text-warning" >
            <div class="sidebar-header">
                <img src="assets/img/logo.png" alt="bootraper logo" class="app-logo">
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
                </li>
                <li>
                    <a href="charts.php"><i class="fas fa-chart-bar"></i> Visuallization</a>
                </li>
                <li>
                    <a href="showdata.php"><i class="fas fa-user-shield"></i>Actuall Data</a>
                </li>
                <li>
                    <a href="missingdata.php"><i class="fas fa-user-shield"></i>Missing Data</a>
                </li>
                <li>
                    <a href="showdata.php"><i class="fas fa-user-shield"></i>Handler Data</a>
                </li>
            </ul>
        </nav>

        <div id="body" class="active">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
                <button type="button" id="sidebarCollapse" class="btn btn-outline-warning default-warning-menu"><i class="fas fa-bars"></i><span></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <div class="nav-dropdown">
                                <a href="" class="nav-item nav-link dropdown-toggle" data-toggle="dropdown"><i class="fas fa-user"></i> <span></span> <i style="font-size: .8em;" class="fas fa-caret-down"></i></a>
                                <div class="dropdown-menu dropdown-menu-right nav-link-menu">
                                    <ul class="nav-list">
                                        <li><a href="logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>