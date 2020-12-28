	<div class="content-wrapper">
		<div class="content">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<ol class="breadcrumb float-sm-left bg-transparent">
							<li class="breadcrumb-item" id="bc-link-1"><a href="?p=my">Home</a></li>
							<li class="breadcrumb-item active" id="bc-link-2">My Profile</li>
						</ol>
					</div>				
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">My Profile</h3>
							</div>
							<div class="card-body">
								<form id="form1" role="form" onSubmit="return false;">			
								<div class="form-group">
									<label for="per_fname">First name</label>
									<input type="text" class="form-control" id="per_fname" placeholder="Enter first name" required>
								</div>					
								<div class="form-group">
									<label for="per_lname">Last name</label>
									<input type="text" class="form-control" id="per_lname" placeholder="Enter last name" required>
								</div>
                			</div>
							<div class="card-footer">
								<button  class="btn btn-default" id="edit" onClick="enableEdit();">Modify</button>
								<button type="submit" class="btn btn-primary float-right" id="submit1">Update</button>
								</form>
							</div>           						
						</div>
					</div>	
					<div class="col-sm-1"></div>
					<div class="col-sm-5">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Tools</h3>
							</div>
							<div class="card-body">
								<form id="form2"  role="form" onSubmit="return false;">						
								<div class="form-group">
									<label for="per_lname">New password</label>
									<input type="password" class="form-control" id="new_pass" placeholder="Enter new password" required>
								</div>
								<div class="form-group">
									<label for="per_role">Confirm new password</label>
									<input type="password" class="form-control" id="new_pass2" placeholder="Confirm new password" required>
								</div>
                			</div>
							<div class="card-footer">
								<button type="submit" class="btn btn-primary float-right" id="submit2">Update</button>
								</form>
							</div> 
						</div>
					</div>			
				</div>
			</div>
		</div>
	</div>
	
<script type="text/javascript">	
setTimeout(function(){preLoad();}, 0);


function preLoad(){
	getUser(<?php echo $logged_userID;?>);
	disabledEdit();
	$('#submit1').click(function(){
		updateUser(<?php echo $logged_userID;?>);		
	});

	$('#submit2').click(function(){
		updatePassword(<?php echo $logged_userID;?>);		
	});
}


function getUser(perID){
	var action = 'getUser';
	var data = [action, perID];
	
	$.ajax({
		type: 'POST',
		url: 'mod/profile/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				$('#per_fname').val(result[2].per_fname);
				$('#per_lname').val(result[2].per_lname);
			} else {
				$('#per_fname').val(result[1]);
				$('#per_lname').val(result[1]);
			}
		}
	});
}


function updateUser(perID){
	var action = 'updateUser';
	var per_fname = $('#per_fname').val();
	var per_lname = $('#per_lname').val();
	var data = [action, per_fname, per_lname, perID];

	if(per_fname != "" && per_lname != ""){
		if(confirm('Are you sure you wish to update your profile?')){
			disabledEdit();
			$.ajax({
				type: 'POST',
				url: 'mod/profile/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						toastr.success(result[1]);
						getUser(perID);
					} else {
						toastr.error(result[1]);
						enableEdit();
					}			
				}
			});
		} else {
			return false;
		}

	} else {
		toastr.error('Fill out the required fields.');
		enableEdit();
	}
}


function updatePassword(perID){
	var action = 'updatePassword';
	var new_pass = $('#new_pass').val();
	var new_pass2 = $('#new_pass2').val();

	var data = [action, new_pass, perID];

	if(new_pass != "" && new_pass2 != ""){
		if(new_pass.localeCompare(new_pass2) == 0){
			if(confirm('Are you sure you wish to update your password?')){
				$.ajax({
					type: 'POST',
					url: 'mod/profile/action.php',
					data: {data:data},	
					success: function(result){
						if(result[0] == 1){
							toastr.success(result[1]);
							$('#new_pass').val('');
							$('#new_pass2').val('');
						} else {
							toastr.error(result[1]);
						}			
					}
				});
			} else {
				return false;
			}
		} else {
			toastr.error('New passwords did not match!');
		}

	} else {
		toastr.error('Fill out the required fields.');
		enableEdit();
	}
}


function enableEdit(){
	$('#edit').attr('disabled', 'disabled');
	$('#submit1').removeAttr('disabled');
	$('#per_fname').removeAttr('readonly');
	$('#per_lname').removeAttr('readonly');
}


function disabledEdit(){
	$('#edit').removeAttr('disabled');
	$('#submit1').attr('disabled', 'disabled');
	$('#per_fname').attr('readonly', 'readonly');
	$('#per_lname').attr('readonly', 'readonly');
}
</script>	
