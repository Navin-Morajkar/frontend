<?php 
    include('../../controllers/includes/common.php'); 
    include('../../controllers/tanker_vendor_controller.php'); 
    if (!isset($_SESSION["emp_id"]))
    header("location:../../index.php");
if ($_SESSION['is_superadmin'] == 0)
    die('<script>alert("You dont have access to this page, Please contact admin");window.location = history.back();</script>');

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Favicon link-->
    <link rel="icon" type="image/x-icon" href="../../images/logo-no-name-circle.png">
    <title>DELTA@STAAR | Tankers</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- Tachyons -->
    <link rel="stylesheet" href="https://unpkg.com/tachyons@4.12.0/css/tachyons.min.css"/>
    <!-- CSS files -->
    <link rel="stylesheet" href="../../css/table.css">
    <!-- Live Search -->
    <script type="text/javascript">
		function search() {
		    // Declare variables
		    var input, filter, listing, i, txtValue;
		    input = document.getElementById("form1");
		    filter = input.value.toUpperCase();
		    listing = document.getElementsByTagName("tr");
		    // Loop through all 
		    for (i = 0; i < listing.length; i++) {
		      if (listing[i]) {
		        txtValue = listing[i].textContent || listing[i].innerText;
		        if (txtValue.toUpperCase().indexOf(filter) > -1) {
		          listing[i].style.display = "";
		        } else {
		          listing[i].style.display = "none";
                //   document.getElementById("demo").innerHTML = "No Results Found";
		        }
		      }
		    }
		 }
	</script>
</head>
<body class="bg">
    <!-- Sidebar and Navbar-->
   <?php
    include '../../controllers/includes/sidebar.php';
    include '../../controllers/includes/navbar.php';
    ?>

    
    <div class="table-header">
    <h1 class="tc f1 lh-title spr">Tanker Vendor Details</h1>
    <div class="fl w-75 form-outline srch">
        <input type="search" id="form1" class="form-control" placeholder="Search" aria-label="Search" oninput="search()" />
        <h4 id="demo"></h4>
    </div>
    <div class="fl w-25 tr">
        <button class="btn btn-dark">
            <h5><i class="bi bi-filter-circle"> Sort By</i></h5>
        </button>
    </div>
    </div>

    <!-- Displaying Database Table -->

    <div class="table-div">
        <?php if (isset($_SESSION['message'])): ?>
                <div class="msg">
                    <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    ?>
                </div>
        <?php endif ?>
        
        <?php $results = mysqli_query($conn, "SELECT id,vname,company_name,number,address,price,DATE(time_stamp) AS dt FROM tanker_vendors"); ?>

        <div class="pa1 table-responsive">
            <table class="table table-bordered tc">
                <thead>
                    <tr>
                    <th scope="col">Vendor Name</th>
                    <th scope="col">Comapny Name</th>
                    <th scope="col">Vendor Adress</th>
                    <th scope="col">Number</th>
                    <th scope="col">Date Added</th>
                    <th scope="col" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($results)) {
                    ?>
                    <tr>
                    <th scope="row"><?php echo $row['vname']; ?></th>
                        
                        <td>
                            <?php echo $row['company_name']; ?>
                        </td>
                        <td>
                            <?php echo $row['address']; ?>
                        </td>
                        <td>
                            <?php echo $row['number']; ?>
                        </td>
                        <td>
                            <?php echo $row['dt']; ?>
                        </td>
                        <td>
                            <a href="./tanker_vendor.php?edit=<?php echo '%27' ?><?php echo $row['id']; ?><?php echo '%27' ?>"
                                class="edit_btn"> <i class="bi bi-pencil-square" style="font-size: 1.2rem; color: black;"></i>
                            </a>
                            &nbsp;
                            <a href="../../controllers/tanker_vendor_controller.php?del=<?php echo '%27' ?><?php echo $row['id']; ?><?php echo '%27' ?>"
                                class="del_btn"><i class="bi bi-trash" style="font-size: 1.2rem; color: black;"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="table-footer pa4">
        <div class="fl w-75 tl">
            <button class="btn btn-warning">
                <h4><i class="bi bi-file-earmark-pdf"> Export</i></h4>
            </button>
        </div>
        <div class="fl w-25 tr">
            <button class="btn btn-light">
                <h4><a href="tanker_vendor.php">Add Tanker Vendor</a></h4>
            </button>   
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="tc f3 lh-copy mt4">Copyright &copy; 2022 Delta@STAAR. All Rights Reserved</footer>
    <!-- For dropdown function in User Profile / Config button -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous">
    </script>
</body>
</html>