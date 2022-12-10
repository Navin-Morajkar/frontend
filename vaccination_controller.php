<?php include('../controllers/includes/common.php'); ?>
<?php

if (!isset($_SESSION)) {
    session_start();
}


// initialize variables
$emp_id="";
$category="";
$dateofadministration="";
$nextdose="";
$location="";

$update = false;

if (isset($_POST['save'])) {
    $emp_id= $_POST['emp_id'];
    $category=$_POST['cat_id'];
    $dateofadministration=date('Y-m-d',strtotime($_POST['doa']));
    $nextdose=date('Y-m-d',strtotime($_POST['dond']));
    $location=$_POST['loc'];


    mysqli_query($conn, "INSERT INTO vaccination(emp_id,category_id,date_of_administration,location,date_of_next_dose) VALUES ('$emp_id','$category','$dateofadministration','$location','$nextdose')");
    $_SESSION['message'] = "vaccination details saved";
    header('location: ../views/vaccination.php');
}

if (isset($_POST['update'])) {

    $emp_id= $_POST['emp_id'];
    $category=$_POST['cat_id'];
    $dateofadministration=date('Y-m-d',strtotime($_POST['doa']));
    $nextdose=date('Y-m-d',strtotime($_POST['dond']));
    $location=$_POST['loc'];

    mysqli_query($conn, "UPDATE vaccination SET emp_id='$emp_id', category_id='$category',date_of_administration='$dateofadministration',location='$location',date_of_next_dose='$nextdose' WHERE emp_id='$emp_id'");
    $_SESSION['message'] = "Vaccnation Info updated!";
    header('location: ../views/vaccination.php');
}

if (isset($_GET['del'])) {
    $emp_code = $_GET['del'];
    mysqli_query($conn, "DELETE FROM vaccination WHERE emp_id=$em_id");
    $_SESSION['message'] = "Vaccination deleted!";
    header('location: ../views/vaccination.php');
}