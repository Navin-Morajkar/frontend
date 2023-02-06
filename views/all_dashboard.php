<?php
require "../controllers/includes/common.php";
if (!isset($_SESSION["emp_id"]))
    header("location:login.php");
$emp = mysqli_query($conn, "select * from employee where emp_id='{$_SESSION['emp_id']}'");
$emp_details = mysqli_fetch_array($emp);
$check_technician=mysqli_query($conn,"select * from employee join technician using(emp_id) where emp_id='{$_SESSION['emp_id']}' and employee.role is not null");
$check_security=mysqli_query($conn,"select * from employee join security using(emp_id) where emp_id='{$_SESSION['emp_id']}' and role is not null");
$isSecurity = 0;
$isSuperadmin = 0;
$isTechnician = 0;
if($_SESSION['is_superadmin']){
    $isSuperadmin = 1;
}
else{
    if(mysqli_num_rows($check_technician)>0 && mysqli_num_rows($check_security)>0){
        //security is also techinician
    }
    else if(mysqli_num_rows($check_technician)>0){
        $isTechnician=1;
    }
    else if(mysqli_num_rows($check_security)>0){
        $isSecurity=1;
    }
}
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <link href="../css/sidebar.css" rel="stylesheet">
    <script src="../js/Sidebar/sidebar.js"></script>

    <link rel="stylesheet" href="../css/style1.css">
    <link rel="stylesheet" href="../css/technician.css">
    <!-- Tachyons -->
    <link rel="stylesheet" href="https://unpkg.com/tachyons@4.12.0/css/tachyons.min.css" />

    <!--Favicon link-->
    <link rel="icon" type="image/x-icon" href="../images/logo-no-name-circle.png">

    <title>Dashboard</title>

</head>

<body class="bgcolor">
    <!-- Sidebar-->
    <?php
    include '../controllers/includes/sidebar.html';
    ?>


    <!--Start of Main content-->

    <div id="main">

        <!-- Navigation Bar -->
        <?php
        include '../controllers/includes/navbar.html';
        ?>

        <div class="welcome-message">Welcome back, <span style="color:#ceaa6d">
                <?php echo $emp_details['fname']; ?>
            </span></div>

           <?php 
           if($isSuperadmin)
           include '../controllers/includes/superadmin.php'; 
           else if($isTechnician)
           include '../controllers/includes/technician.php'; 
           else if($isSecurity)
           include '../controllers/includes/security.php'; 
           else
           include '../controllers/includes/employee.php'; 
           ?>


        <!-- Footer -->
        <footer class="tc f3 lh-copy mt6">Copyright &copy; 2022 Delta@STAAR. All Rights Reserved</footer>


    </div>

    <!--End of Main content-->



    <!--Scripts for Navbar (as in dashboard.php)-->
    <script src="https://kit.fontawesome.com/319379cac6.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

    <!--Scripts required for Bootstrap and Sidebar-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>
</body>

</html>