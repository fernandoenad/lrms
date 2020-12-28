<?php
session_start();
require_once("../../../dbconfig.php");
require_once("../../../settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data']['0'])){	
	if($_POST['data']['0'] == "getUsers"){
		$data = array_values($_POST);
		$result = $controller->getUsers($data);
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			?>
			<tr>
				<td>
					<a href="?p=user&action=show&ID=<?php echo $row['per_id'];?>">
						<i class="fas fa-user"></i>&nbsp;&nbsp;
						<?php echo $row['per_lname'].", ".$row['per_fname'];?>
					</a>
				</td>
				<td><?php echo $row['per_uname'];?></td>
				<td><?php echo $controller->getRole($row['per_role']);?></td>
				<td><?php echo $controller->getStatus($row['per_status']);?></td>
				<td>
					<a href="?p=user&action=edit&ID=<?php echo $row['per_id'];?>">
						<i class="fas fa-edit"></i>
					</a>
				</td>
			</tr>
			<?php
		}} else { ?>
			<tr>
				<td colspan="5"><?php echo $result['1'];?></td>
			</tr>
			<?php
		 } 
		 
	} else if($_POST['data']['0'] == "getOption"){
		$data = array_values($_POST);
			
		if($data['0']['2'] == "new" && $data['0']['3'] == 0){
			?>
			<form role="form" onSubmit="return false;">			
				<div class="card-header">
					<h3 class="card-title"><?php echo ucwords($data['0']['2']." ".$data['0']['1']);?></h3>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label for="per_fname">First name</label>
						<input type="text" class="form-control" id="per_fname" placeholder="Enter first name" required>
					</div>					
					<div class="form-group">
						<label for="per_lname">Last name</label>
						<input type="text" class="form-control" id="per_lname" placeholder="Enter last name" required>
					</div>
					<div class="form-group">
						<label for="per_uname">Username</label>
						<input type="text" class="form-control" id="per_uname" placeholder="Enter username" onkeyup="checkUname();" required>
					</div>
					<div class="form-group">
						<label for="per_pword">Password</label>
						<input type="text" class="form-control" id="per_pword" placeholder="Enter password" value="<?php echo $def_pword;?>" required>
					</div>
					<div class="form-group">
						<label for="per_role">Role</label>
						<select class="form-control" id="per_role" required>
							<option value="">---select---</option>
							<option value="1"><?php echo $controller->getRole(1);?></option>
							<option value="2"><?php echo $controller->getRole(2);?></option>
						</select>
					</div>
                </div>
                <div class="card-footer">
					<button type="button" class="btn btn-default" id="cancel" onClick="return confirm('Cancel action?') ? window.location.href='?p=user' : false;">Cancel</button>
					<button type="submit" class="btn btn-primary float-right" id="submit" onClick="return confirm('Save action?') ? processForm('<?php echo $data['0']['2'];?>') : false;"><?php echo ($data['0']['2'] == "new" ? "Submit" : "Update");?></button>
				</div>
            </form>
			<?php
			
		} else if($data['0']['2'] == "edit" && $data['0']['3'] != 0){
			?>
			<form role="form" onSubmit="return false;">			
				<div class="card-header">
					<h3 class="card-title"><?php echo ucwords($data['0']['2']." ".$data['0']['1']);?></h3>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label for="per_fname">First name</label>
						<input type="text" class="form-control" id="per_fname" placeholder="Enter first name" required>
					</div>					
					<div class="form-group">
						<label for="per_lname">Last name</label>
						<input type="text" class="form-control" id="per_lname" placeholder="Enter last name" required>
					</div>
					<div class="form-group">
						<label for="per_uname">Username</label>
						<input type="text" class="form-control" id="per_uname" placeholder="Enter username" readonly>
					</div>
					<div class="form-group">
						<label for="per_role">Role</label>
						<select class="form-control" id="per_role" required>
							<option value="">---select---</option>
							<option value="1"><?php echo $controller->getRole(1);?></option>
							<option value="2"><?php echo $controller->getRole(2);?></option>
						</select>
					</div>
                </div>
                <div class="card-footer">
					<button type="button" class="btn btn-default" id="cancel" onClick="return confirm('Cancel action?') ? window.location.href='?p=user' : false;">Cancel</button>
					<button type="submit" class="btn btn-primary float-right" id="submit" onClick="return confirm('Save action?') ? processForm('<?php echo $data['0']['2'];?>') : false;"><?php echo ($data['0']['2'] == "new" ? "Submit" : "Update");?></button>
				</div>
            </form>
			<?php
			$result = $controller->getUser($data);
			
			if($result['0'] == 1){ $row = $result['2']->fetch_assoc();
				?>
				<script>
					$('#per_fname').val('<?php echo $row["per_fname"];?>');
					$('#per_lname').val('<?php echo $row["per_lname"];?>');
					$('#per_uname').val('<?php echo $row["per_uname"];?>');
					$('#per_role').val('<?php echo $row["per_role"];?>');
				</script>	
				<?php
			} else {
				?>
				<script>
					alert('<?php echo $result['1'];?> \nYou will be redirected to the main page.');
					window.location.href='?p=user';
				</script>
				<?php
			}

		} else if($data['0']['2'] == "show" && $data['0']['3'] != 0){
			?>
			<div class="card-header">
				<h3 class="card-title"><?php echo ucwords($data['0']['2']." ".$data['0']['1']);?></h3>
			</div>
			<div class="card-body">
				<table class="table">
					<tr>
						<th width="25%">Avatar</th>
						<td>
							<?php $avatar_path = (file_exists("../../../assets/avatars/".$data['0']['3'].".jpg") ? $data['0']['3'] : "avatar-0");?>
							<img src="../assets/avatars/<?php echo $avatar_path;?>.jpg" class="user-image img-circle elevation-2" width="80" alt="User Image">
						</td>
					</tr>
					<tr>
						<th>Name</th>
						<td id="u_fullname"></td>
					</tr>
					<tr>
						<th>Role</th>
						<td id="u_role"></td>
					</tr>
					<tr>
						<th>Assignment/s</th>
						<td id="u_assignments"></td>
					</tr>
				</table>
			</div>			
			<?php
			$result = $controller->getUser($data);

			if($result['0'] == 1){ $row = $result['2']->fetch_assoc();
				?>
				<script>
					$('#u_fullname').html('<?php echo $row["per_lname"];?>, <?php echo $row["per_fname"];?>');
					$('#u_role').html('<?php echo $controller->getRole($row["per_role"]);?>');
				</script>
				<?php
			} else {
				?>
				<script>
					$('#u_fullname').html('<?php echo $result['1'];?>');
					$('#u_role').html('<?php echo $result['1'];?>');
				</script>
				<?php
			}

			$result = $controller->getAssignments($data);
			$assignments = "";
			if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
				$assignments = $assignments . $row['cou_name'] . "<br>";
				}
				?>
				<script>
					$('#u_assignments').html('<?php echo $assignments;?>');
				</script>
				<?php
			} else {
				$assignments = $result['1'];
				?>
				<script>
					$('#u_assignments').html('<?php echo $assignments;?>');
				</script>
				<?php
			}
		}
	 
	} else if($_POST['data']['0'] == "getSide"){
		$data = array_values($_POST);
		$result = $controller->getUsers($data);
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			?>
			<tr>
				<td><i class="fas fa-user"></i>&nbsp;&nbsp;<?php echo $row['per_lname'].", ".$row['per_fname'];?></td>
				<td><?php echo $controller->getRole($row['per_role']);?></td>
				<td><?php echo $controller->getStatus($row['per_status']);?></td>
				<td>
					<button href="#" <?php echo ($row['per_id'] == 1 || $row['per_id'] == $logged_userID ? "disabled" : "");?> class="btn btn-xs btn-default" onClick="return confirm('Confirm action?') ? toggleStatus(<?php echo $row['per_id'];?>, <?php echo $row['per_status'];?>) : 'false';">
						<i class="fas fa-lock<?php echo($row['per_status'] == 1 ? "" : "-open");?>"></i>						
					</button>
				</td>
			</tr>
			<?php
		}} else { ?>
			<tr>
				<td colspan="5"><?php echo $result['1'];?></td>
			</tr>
			<?php
		 }
		
	} else if($_POST['data']['0'] == "saveOption"){
		$data = array_values($_POST);
		$result = $controller->saveUser($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);
		exit();
		
	} else if($_POST['data']['0'] == "editOption"){
		$data = array_values($_POST);
		$result = $controller->updateUser($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);
		exit();
		
	} else if($_POST['data']['0'] == "toggleStatus"){
		$data = array_values($_POST);
		$result = $controller->toggleStatus($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);
		exit();
		
	} else if($_POST['data']['0'] == "checkUname"){
		$data = array_values($_POST);
		$result = $controller->checkUname($data);
		
		header("Content-Type: application/json");
		echo json_encode($result);
		exit();
	}
}
?>