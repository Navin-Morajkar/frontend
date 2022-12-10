<?php include('../controllers/includes/common.php'); ?>
<?php include('../controllers/accomodation_controller.php'); ?>
<?php
if (isset($_GET['edit'])) {
	$emp_code = $_GET['edit'];
	$update = true;
	$record = mysqli_query($conn, "SELECT * FROM accomodation WHERE acc_code=$acc_code");

	// if (count($record) == 1 ) {
	$n = mysqli_fetch_array($record);

	  $acc_code =  $n['acc_code'];
    $acc_name = $n['acc_name'];
    $bldg_status = $n['bldg_status'];
    $location =  $n['location'];
    $gender = $n['gender'];
    $tot_capacity = $n['tot_capacity'];
    $no_of_rooms = $n['no_of_rooms'];
    $occupied_rooms = $n['occupied_rooms'];
    $available_rooms = $n['available_rooms'];
    $owner = $n['owner'];
    $remark = $n['remark'];

	
	// }
}
?>
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Delta@STAAR | Accomodation</title>
	<meta name="description" content="Employee Addition portal for deltin employees">
	<link rel="stylesheet" href="../css/forms.css">
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="https://unpkg.com/tachyons@4.12.0/css/tachyons.min.css" />
</head>

<body>
	<div class="container">
		<h1 class="tc f1 lh-title">Add New Accomodation</h1>
		<div class="row mx-0 justify-content-center">
			<div class="col-md-7 col-lg-5 px-lg-2 col-xl-4 px-xl-0 bg f4 lh-copy">
				<?php if (isset($_SESSION['message'])): ?>
				<div class="msg">
					<?php
	                echo $_SESSION['message'];
	                unset($_SESSION['message']);
                    ?>
				</div>
				<?php endif ?>

				<?php $results = mysqli_query($conn, "SELECT * FROM accomodation"); ?>

				<!-- <table>
	<thead>
		<tr>
		<th>emp_code </th>
		<th>fname </th>
		<th>mname </th>
		<th>lname </th>
		<th>designation </th>
		<th>dob </th>
		<th>address </th>
		<th>state </th>
		<th>country </th>
		<th>pincode </th>
		<th>email </th>
		<th>blood_group </th>
		<th>department </th>
		<th>joining_date </th>
		<th>aadhaar_number </th>
		<th>salary </th>
		<th>acc_id </th>
		
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['acc_code']; ?></td>
			<td><?php echo $row['acc_name']; ?></td>
			<td><?php echo $row['bldg_status']; ?></td>
			<td><?php echo $row['location']; ?></td>
			<td><?php echo $row['gender']; ?></td>
			<td><?php echo $row['tot_capacity']; ?></td>
			<td><?php echo $row['no_of_rooms']; ?></td>
			<td><?php echo $row['occupied_rooms']; ?></td>
			<td><?php echo $row['available_rooms']; ?></td>
			<td><?php echo $row['owner']; ?></td>
			<td><?php echo $row['remark']; ?></td>
			<td>
				<a href="accomodation.php?edit=<?php echo '%27' ?><?php echo $row['acc_code']; ?><?php echo '%27' ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="../controllers/accomodation_controller.php?del=<?php echo '%27' ?><?php echo $row['acc_code']; ?><?php echo '%27' ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table> -->

				<form method="post" class="w-100 rounded p-4 border bg-white"
					action="../controllers/accomodation_controller.php">
					<input type="hidden" name="acc_code" value="<?php echo $acc_code; ?>">
					<div class="input-group">
						<label class="d-block mb-4"> <span class="d-block mb-2">Accomodation Code
						<?php if ($update == true): ?>
						<input class="form-control" disabled type="text" name="acc_code" value="<?php echo $acc_code; ?>">
						<?php else: ?>
						<input class="form-control" type="text" name="acc_code" value="<?php echo $acc_code; ?>">
						<?php endif ?>
					</div>
					</label>
					<div class="input-group">
						<label class="d-block mb-4"> <span class="d-block mb-2">Accomodation Name <span>
						<input class="form-control" type="text" name="acc_name" value="<?php echo $acc_name; ?>">
					</div>
						</label>
					<div class="input-group">
          <label class="d-block mb-4" for="inputbstatus"> <span class="d-block mb-2">Building Status <span>
          <br><select class="form-control" id="bldg-status" name="bldg_status">
          <option>Select Building Status</option>
          <option value="Active">Active</option>
          <option value="Permanently Closed">Permanently Closed</option>
          <option value="Temporarily Closed">Temporarily Closed</option>
           </select>
           </label>
          </div>
					<div class="input-group">
						<label class="d-block mb-4"> <span class="d-block mb-2">Location <span>
						<input class="form-control" type="text" name="location" value="<?php echo $location; ?>">
					</div>
						</label>
            </div>
						</label>
					<div class="input-group">
          <label class="d-block mb-4" for="inputbstatus"> <span class="d-block mb-2">Gender <span>
          <br><select class="form-control" id="gender" name="gender">
          <option>Select Gender</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
          <option value="Other">Other</option>
           </select>
           </label>
          </div>
					<div class="input-group">
						<label class="d-block mb-4"> <span class="d-block mb-2">Total Capacity <span>
						<input class="form-control" type="number" name="tot_capacity" value="<?php echo $tot_capacity; ?>">
					</div>
						</label>
					<div class="input-group">
						<label class="d-block mb-4"> <span class="d-block mb-2">Number of Rooms <span>
						<input class="form-control" type="number" name="no_of_rooms" value="<?php echo $no_of_rooms; ?>">
					</div>
						</label>
					<div class="input-group">
						<label class="d-block mb-4"> <span class="d-block mb-2">Occupied Number of Rooms <span>
						<input class="form-control" type="number" name="occupied_rooms" value="<?php echo $occupied_rooms; ?>">
					</div>
						</label>
					<div class="input-group">
						<label class="d-block mb-4"> <span class="d-block mb-2">Available Number of Rooms<span>
						<input class="form-control" type="number" name="available_rooms" value="<?php echo $available_rooms; ?>">
					</div>
						</label>
					<div class="input-group">
						<label class="d-block mb-4"> <span class="d-block mb-2">Owner<span>
						<input class="form-control" type="text" name="owner" value="<?php echo $owner; ?>">
					</div>
						</label>
					
					<div class="input-group">
						<label class="d-block mb-4"> <span class="d-block mb-2">Remark <span>
						<input class="form-control" type="text" name="remark" value="<?php echo $remark; ?>">
					</div>
						</label>
					
						</label>
					<div class="mb-3 tc">
						<?php if ($update == true): ?>
						<button class="btnn" type="submit" name="update" value="update"
							style="background: #556B2F;">update</button>
						<?php else: ?>
						<button class="btn btn-dark px-3" class="btnn" type="submit" name="save" value="save">Save</button>
						<?php endif ?>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
		crossorigin="anonymous"></script>
</body>

</html>