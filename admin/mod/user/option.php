	<div class="content-wrapper">
		<div class="content">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<ol class="breadcrumb float-sm-left bg-transparent">
							<li class="breadcrumb-item" id="bc-link-1"><a href="?p=my">Home</a></li>
							<li class="breadcrumb-item" id="bc-link-1"><a href="?p=user">User Management</a></li>
							<li class="breadcrumb-item active" id="bc-link-2"><?php echo ucwords($_GET['action']." ".$_GET['p']);?></li>
						</ol>
					</div>					
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="card" id="option-body">
							<div class="card-header">
								#
							</div>
							<div class="card-body">
								<div class="form-group">
									#
								</div>
							</div>
							<div class="card-footer">
								#
							</div>	
						</div>
						<!-- /.card -->
					</div>
					<div class="col-lg-6">
						<div class="card" >
							<div class="card-header border-transparent">
								<h3 class="card-title"><?php echo ucwords($_GET['p']);?> List</h3>
							</div>
							<div class="card-body p-0">
								<div class="table-responsive">
									<table class="table m-0">
										<tbody id="option-side">
											<tr>
												<td>#</td>
												<td width="10%">#</td>
											</tr>
										</tbody>
									</table>
								</div>
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
	getOption();
	getSide();
}


function getOption(){
	var action = 'getOption';
	var option = 'user';
	var act = '<?php echo $_GET['action'];?>';
	var id = <?php echo $_GET['ID'];?>;
	var data = [action, option, act, id];
	
	$.ajax({
		type: 'POST',
		url: 'mod/user/action.php',
		data: {data:data},	
		success: function(result){
			$('#option-body').html(result);
		}
	});
}


function getSide(){
	var action = 'getSide';
	var option = 'user';
	var act = '<?php echo $_GET['action'];?>';
	var id = <?php echo $_GET['ID'];?>;
	var data = [action, option, act, id];
	
	$.ajax({
		type: 'POST',
		url: 'mod/user/action.php',
		data: {data:data},	
		success: function(result){
			$('#option-side').html(result);
		}
	});	
}


function processForm(request){
	var action = request == 'new' ? 'saveOption' : 'editOption';
	var option = 'user';
	var act = '<?php echo $_GET['action'];?>';
	var id = <?php echo $_GET['ID'];?>;
	var data = [action, option, act, id];
	
	$('#submit').attr('disabled', 'disabled');
	$('#cancel').attr('disabled', 'disabled');
	
	if(validateForm(data)[0] == true ){
		data = data.concat(validateForm(data)[1]);
		$.ajax({
			type: 'POST',
			url: 'mod/user/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					window.location.href='?p=user&ok='+act;
				} else {
					toastr.error(result[1]);
				}
			}
		});
		
	} 
	
	$('#submit').removeAttr('disabled');
	$('#cancel').removeAttr('disabled');
}


function validateForm(data){
	var result = true;
	var fields = [];
	
	var per_fname = $('#per_fname').val();
	var per_lname = $('#per_lname').val();
	var per_uname = $('#per_uname').val();
	var per_pword = $('#per_pword').val();
	var per_role = $('#per_role').val();

	if(per_fname == ''){
		result = false;
		//toastr.error('Error');
	} else if(per_lname == ''){
		result = false;
		//toastr.error('Error');
	} else if(per_uname == ''){
		result = false;
		//toastr.error('Error');
	} else if(per_pword == ''){
		result = false;
		//toastr.error('Error');
	} else if(per_role == ''){
		result = false;
		//toastr.error('Error');
	}
	
	fields.push(per_fname, per_lname, per_uname, per_pword, per_role);
		
	return [result, fields];
}


function toggleStatus(id, status){
	var action = 'toggleStatus';
	var option = 'user';
	var act = '<?php echo $_GET['action'];?>';
	var new_status = status == 1 ? 0 : 1;
	var data = [action, option, act, id, new_status];
	
	$.ajax({
		type: 'POST',
		url: 'mod/user/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				getSide();
				toastr.success(result[1]);
			} else {
				toastr.error(result[1]);
			}
		}
	});
}


function checkUname(){
	var action = 'checkUname';
	var per_uname = $('#per_uname').val();
	var data = [action, per_uname];
	$('#per_uname').val($('#per_uname').val().replace(/[^a-z0-9.]/gi, ''));
	
	if(per_uname.length >= 6){
		$.ajax({
			type: 'POST',
			url: 'mod/user/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					$('#per_uname').removeClass('is-valid');
					$('#per_uname').addClass('is-invalid');
					$('#submit').attr('disabled', 'disabled');
				} else{
					$('#per_uname').removeClass('is-invalid');
					$('#per_uname').addClass('is-valid');
					$('#submit').removeAttr('disabled');
				}
			}
		});
	}
}
</script>	
