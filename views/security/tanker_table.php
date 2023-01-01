<?php 
    include('../../controllers/includes/common.php'); 
    include('../../controllers/tanker_controller.php'); 
    if (!isset($_SESSION["emp_id"]))header("location:../../views/login.php");
    // check rights
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
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark f3 lh-copy fw5">
        <div class="container-fluid">
        <a class="navbar-brand" href="#">
                <img src="../../images/logo-no-name.png" height="50px" alt="Deltin Logo" class="d-inline-block align-text-top"
                    style="border-radius: 50px;">
            </a>
            <ul class="navbar-nav justify-content-end">    
                <li class="nav-item">
                    <a class="nav-link active" id="adminlogin" onmouseover="this.style.cursor='pointer'" onclick = "history.back()" >Back</a>
                </li>
            </ul>    
        </div>
    </nav>

    
    <div class="table-header">
    <h1 class="tc f1 lh-title spr">Tanker Details</h1>
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
        
        <?php $results = mysqli_query($conn, "SELECT tanker_vendors.*,t.id entry_id,t.acc_id acc_id,t.security_emp_id security_emp_id,t.quality_check quality_check,t.qty qty,t.bill_no bill_no,t.vendor_id vendor_id,t.timestamp as timestamp FROM tankers t JOIN tanker_vendors ON tanker_vendors.id = vendor_id"); ?>

        <div class="pa1 table-responsive">
            <table class="table table-bordered tc">
                <thead>
                    <tr>
                    <th scope="col">Bill Number</th>
                    <th scope="col">Quality</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Accommodation</th>
                    <!-- <th scope="col">Employee Security</th> -->
                    <th scope="col">Vendor</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($results)) {
                    ?>
                    <?php 
                    $vendor_id = $row['vendor_id'];
                    $queryvendorId = mysqli_query($conn, "SELECT * FROM tanker_vendors where id='$vendor_id'");
                    $vendor = mysqli_fetch_assoc($queryvendorId);
					?>
                    <?php
                    $accid = $row['acc_id'];
                    $queryAccId = mysqli_query($conn, "SELECT * FROM accomodation WHERE acc_id = '$accid'");
                    $acc = mysqli_fetch_assoc($queryAccId);
                    ?>
                    <tr>
                    <th scope="row"><?php echo $row['bill_no']; ?></th>
                        
                        <td>
                            <?php echo $row['quality_check']; ?>
                        </td>
                        <td>
                            <?php echo $row['qty']; ?>
                        </td>
                        <td>
                            <?php echo $acc['acc_name']; ?>
                        </td>
                        <td>
                            <?php echo $vendor['vname']; ?>
                        </td>
                        <td>
                            <?php 
                            $timestamp = strtotime($row['timestamp']);                            
                            $date = date('d-m-Y', $timestamp);
                            echo $date; ?>
                        </td>
                        <td>
                            <?php $time = date('H:i:s', $timestamp); echo $time; ?>
                        </td>
                        <td>
                            <a href="./tanker.php?edit=<?php echo '%27' ?><?php echo $row['id']; ?><?php echo '%27' ?>"
                                class="edit_btn"> <i class="bi bi-pencil-square" style="font-size: 1.2rem; color: black;"></i>
                            </a>
                            &nbsp;
                            <a href="../../controllers/tanker_controller.php?del=<?php echo '%27' ?><?php echo $row['id']; ?><?php echo '%27' ?>"
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
                <h4><a href="tanker.php">Add Tanker</a></h4>
            </button>   
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="tc f3 lh-copy mt4">Copyright &copy; 2022 Delta@STAAR. All Rights Reserved</footer>
</body>
</html>