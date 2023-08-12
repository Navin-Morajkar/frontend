    <?php include('../../controllers/includes/common.php'); ?>
    <?php include('../../controllers/role_controller.php'); ?>
    <?php

    if (!isset($_SESSION["emp_id"]))
    header("location:../../index.php");
    if ($_SESSION['is_superadmin'] == 0)
    die('<script>alert("You dont have access to this page, Please contact admin");window.location = history.back();</script>');

    // if (isset($_GET['edit'])) {
    //     $role_id = $_GET['edit'];
    //     $update = true;
    //     $record = mysqli_query($conn, "SELECT * FROM roles WHERE role_id=$role_id");

    //     // if (count($record) == 1 ) {
    //     $n = mysqli_fetch_array($record);

    //     $role_id = $n['role_id'];
    //     $role_name = $n['role_name'];
    //     $rights = $n['rights'];
    //     // }
    // }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Favicon link-->
    <link rel="icon" type="image/x-icon" href="../../images/logo-no-name-circle.png">
    <title>Delta@STAAR | Assign Role</title>

    <link rel="stylesheet" href="../../css/form.css">
    <link rel="stylesheet" href="../../css/style1.css">
    <link rel="stylesheet" href="../../css/autocompleteCSS.css">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/table.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/tachyons@4.12.0/css/tachyons.min.css" />
    </head>

    <body class="b ma2">
    <!-- Sidebar and Navbar-->
    <?php
    include '../../controllers/includes/sidebar.php';
    include '../../controllers/includes/navbar.php';
    ?>

    <div class="form-body">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h1 class="f2 lh-copy tc" style="color: white;">Assign Role</h1>
                        <form class=" f3 lh-copy" novalidate action="../../controllers/role_assign_controller.php" method="post">
                        <?php $results = mysqli_query($conn, "SELECT * FROM employee JOIN employee_designation ON employee_designation.id = employee.designation and employee.role is null"); 
                        $req_id = '';
                        ?>
                        <div class="pa1 table-responsive">
                            <!-- <div class="col-md-12 pa2">
                                <select id="emp-code-dropdown" name="emp_code" oninput="">
                                    <option name="emp_code" selected disabled value="">Select employee </option>
                                    <?php // $employees = mysqli_query($conn, "SELECT * FROM employee where role is null");
                                    //foreach ($employees as $row) {
                                    //    $name = $row['fname'] . " " . $row['lname'];
                                        ?>
                                        <option name="emp_code" value="<?= $row["emp_id"] ?>" title="<?= $name ?>">
                                            <?php //echo("".$name." - ".$row["emp_code"]); ?>
                                        </option>
                                    <?php //} ?>
                                </select>
                                <div class="valid-feedback">field is valid!</div>
                                <div class="invalid-feedback">field cannot be blank!</div>
                            </div> -->

                            <?php
                                $empdet = "select emp_code,concat(fname,' - ',emp_code) as name from employee";
                                $detresult = mysqli_query($conn, $empdet);
                                $detdata = array();
                                while ($detrow = mysqli_fetch_assoc($detresult)) {
                                    $detdata[] = $detrow['name'];
                                }
                                $employees = json_encode($detdata);
                                ?>
                                 <div class="autocomplete form-control col-md-12 pa2">
                                        <input class="autocompleteinp form-control" id="empcode" type="text" name="emp_code" placeholder="Employee name" required>
                                    </div>

                                    <datalist id="options_list">
                                        <?php foreach ($detdata as $option) : ?>
                                            <option value="<?= $option; ?>">
                                            <?php endforeach; ?>
                                    </datalist>
                                    <div class="valid-feedback">field is valid!</div>
                                    <div class="invalid-feedback">field cannot be blank!</div>

							<input type="hidden" name="acc_id" value="<?php echo $acc_id; ?>">
                            <div class="col-md-12 pa2">
								<select name="role_id">
                                    <option name="role_id" selected disabled value="">Assign Role </option>
                                    <?php
                                    $roles = mysqli_query($conn, "SELECT * FROM roles");

                                    foreach ($roles as $row) {
                                        // $sql = mysqli_query($conn, "SELECT rights.* FROM rights join roles on rights.id=roles.rights and roles.role_id='{$row['role_id']}'");
                                        // $rights = mysqli_fetch_array($sql);

                                    ?>
                                        <option name="role_id" value="<?= $row["role_id"] ?>" title="">
                                            <?= $row["role_name"]; ?>
                                        </option>
                                    <?php
                                    }

                                    ?>
                                </select>
                                <div class="valid-feedback">field is valid!</div>
                                <div class="invalid-feedback">field cannot be blank!</div>
                            </div>
                            

                            <div class="form-button mt-3 tc">
                                <?php if ($update == true): ?>
                                <button id="submit" class="btn btn-warning f3 lh-copy" style="color: white;"
                                    type="submit" name="update" value="update"
                                    style="background: #556B2F;">update</button>
                                <?php else: ?>
                                <button id="submit" class="btn btn-warning f3 lh-copy" style="color: white;"
                                    type="submit" name="submit" value="submit">Submit</button>
                                <?php endif ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="tc f3 lh-copy mt4">Copyright &copy; 2022 Delta@STAAR. All Rights Reserved</footer>

    <script src="../../js/form.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- For dropdown function in User Profile / Config button -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous">
    </script>    
    <script>
        function autocomplete(inp, arr) {
            var currentFocus;
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                closeAllLists();
                if (!val) return false;
                currentFocus = -1;
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                this.parentNode.appendChild(a);
                for (i = 0; i < arr.length; i++) {
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        b = document.createElement("DIV");
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                        b.addEventListener("click", function(e) {
                            inp.value = this.getElementsByTagName("input")[0].value;
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });
            inp.addEventListener("keydown", function(e) {
                if (e.keyCode === 13) {
                    // insert the value for the autocomplete text field:
                    var selectedOption = document.querySelector(".autocomplete-active");
                    if (selectedOption) {
                        inp.value = selectedOption.getElementsByTagName("input")[0].value;
                    }
                    // close the list of autocompleted values
                    closeAllLists();
                }
            });
            inp.addEventListener("keydown", function(e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    currentFocus++;
                    addActive(x);
                } else if (e.keyCode == 38) {
                    currentFocus--;
                    addActive(x);
                } else if (e.keyCode == 13) {
                    e.preventDefault();
                    if (currentFocus > -1) {
                        if (x) x[currentFocus].click();
                    }
                }
            });

            function addActive(x) {
                if (!x) return false;
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                x[currentFocus].classList.add("autocomplete-active");
            }

            function removeActive(x) {
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }

            function closeAllLists(elmnt) {
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            document.addEventListener("click", function(e) {
                closeAllLists(e.target);
            });
        }
        var employees = <?php echo $employees; ?>;
        autocomplete(document.getElementById("empcode"), employees);
    </script>                        
</body>

    </html>