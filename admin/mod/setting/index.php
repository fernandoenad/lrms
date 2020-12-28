	<div class="content-wrapper">
		<div class="content">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<ol class="breadcrumb float-sm-left bg-transparent">
							<li class="breadcrumb-item" id="bc-link-1"><a href="?p=my">Home</a></li>
							<li class="breadcrumb-item active" id="bc-link-2">Setting</li>
						</ol>
					</div>				
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Organization Information</h3>
							</div>
							<div class="card-body">
								<form id="form1" role="form" onSubmit="return false;">			
								<div class="form-group">
									<label for="org_fullname">Organization name</label> <small><em>(e.g. San Agustin NHS)</em></small>
									<input type="text" class="form-control" id="org_fullname" required>
								</div>
								<div class="form-group">
									<label for="org_shortname">Short name</label> <small><em>(e.g. SANHS)</em></small>
									<input type="text" class="form-control" id="org_shortname" required>
								</div>
								<div class="form-group">
									<label for="org_email">Email</label>
									<input type="text" class="form-control" id="org_email" >
								</div>	
								<div class="form-group">
									<label for="org_web ">Web address</label>
									<input type="text" class="form-control" id="org_web" >
								</div>	
								<div class="form-group">
									<label for="org_address1">Address 1</label>
									<input type="text" class="form-control" id="org_address1" required>
								</div>	
								<div class="form-group">
									<label for="org_address2">Address 2</label>
									<input type="text" class="form-control" id="org_address2" >
								</div>	
								<div class="form-group">
									<label for="org_district">District</label>
									<input type="text" class="form-control" id="org_district" required>
								</div>	
								<div class="form-group">
									<label for="org_citymun">City/Municipality</label>
									<input type="text" class="form-control" id="org_citymun" required>
								</div>	
								<div class="form-group">
									<label for="org_province">Province/State</label>
									<input type="text" class="form-control" id="org_province" required>
								</div>	
								<div class="form-group">
									<label for="org_region">Region</label> <small><em>(e.g. Region VII, Central Visayas)</em></small>
									<input type="text" class="form-control" id="org_region" required>
								</div>					
              </div>
							<div class="card-footer">
								<button  class="btn btn-default" id="edit" onClick="enableEdit();">Modify</button>
								<button type="submit" class="btn btn-primary float-right" id="submit" disabled>Update</button>
								</form>
							</div>           						
						</div>
					</div>	
					<div class="col-sm-1"></div>
					<div class="col-sm-5">
						<div class="card">
							<div class="card-body">
								<form onSubmit="return false;" enctype="multipart/form-data">			
								<div class="form-group">
									<label for="app_background">App Background</label> 									
									<div class="custom-file">								
										<input type="file" class="form-control-file border" id="app_background">								
									</div>
									<img src="../assets/images/background.jpg" width="50%">
								</div>
              </div>
							<div class="card-footer">
								<button type="submit" class="btn btn-primary float-right" id="submit1" onClick="return confirm('Save action?') ? processForm1() : false;">Upload</button>
							</div>
							</form>
						</div>	

						<div class="card">
							<div class="card-body">
								<form onSubmit="return false;" enctype="multipart/form-data">			
								<div class="form-group">
									<label for="app_logo">App Logo</label>									
									<div class="custom-file">								
										<input type="file" class="form-control-file border" id="app_logo">								
									</div>
									<img src="../assets/images/logo.png" width="50%">
								</div>
              </div>
							<div class="card-footer">
								<button type="submit" class="btn btn-primary float-right" id="submit2" onClick="return confirm('Save action?') ? processForm2() : false;">Upload</button>
							</div>
							</form>
						</div>				
					</div>			
				</div>
			</div>
		</div>
	</div>
	
<script type="text/javascript">	
setTimeout(function(){preLoad();}, 0);


function preLoad(){
	disabledEdit();
	getOrg();		

	$('#submit').click(function(){
		updateOrg();
	});
}


function getOrg(){
	var action = 'getOrg';
	var data = [action];
	
	$.ajax({
		type: 'POST',
		url: 'mod/setting/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				$('#org_fullname').val(result[2][0]);
				$('#org_shortname').val(result[2][1]);
				$('#org_email').val(result[2][2]);
				$('#org_web').val(result[2][3]);
				$('#org_address1').val(result[2][4]);
				$('#org_address2').val(result[2][5]);
				$('#org_district').val(result[2][6]);
				$('#org_citymun').val(result[2][7]);
				$('#org_province').val(result[2][8]);
				$('#org_region').val(result[2][9]);
			} else {
				toastr.error('Organization info is not found!');
			}
		}
	});
}


function updateOrg(){
	var action = 'updateOrg';
	var result = validate();
	var data = [action];
	
	if(result[0] == true){
		if(confirm('Are you sure you wish to update this entry?')){
			disabledEdit();
			data = data.concat(result[1]);
			$.ajax({
				type: 'POST',
				url: 'mod/setting/action.php',
				data: {data:data},	
				success: function(result){
					if(result[0] == 1){
						toastr.success(result[1]);
						getOrg();
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
		enableEdit();
	}
}


function validate(){
	var result = true;
	var fields = [];
	var org_fullname = $('#org_fullname').val();
	var org_shortname = $('#org_shortname').val();
	var org_email = $('#org_email').val();
	var org_web = $('#org_web').val();
	var org_address1 = $('#org_address1').val();
	var org_address2 = 	$('#org_address2').val();
	var org_district = $('#org_district').val();
	var org_citymun = $('#org_citymun').val();
	var org_province = $('#org_province').val();
	var org_region = $('#org_region').val();

	if(org_fullname == ''){
		result = false;
	} else if(org_shortname == ''){
		result = false;
	} else if (org_fullname == ''){
		result = false;
	} else if (org_address1 == ''){
		result = false;
	} else if (org_district == ''){
		result = false;
	} else if (org_citymun == ''){
		result = false;
	} else if (org_province == ''){
		result = false;
	} else if (org_region == ''){
		result = false;
	}

	fields.push(org_fullname, org_shortname, org_email, 
		org_web, org_address1, org_address2, org_district, 
		org_citymun, org_province, org_region);

	return [result, fields];
}


function enableEdit(){
	$('#form1 :input').prop('disabled', false);
	$('#submit').removeAttr('disabled');
}


function disabledEdit(){	
	$('#form1 :input').prop('disabled', true);
	$('#submit').attr('disabled', 'disabled');
}


function processForm1(){
	var fd = new FormData(); 
	var files = $('#app_background')[0].files[0]; 
	fd.append('file', files); 
	$('#submit1').attr('disabled', 'disabled');

	$.ajax({ 
		url: 'mod/setting/upload1.php', 
		type: 'post', 
		data: fd, 
		contentType: false, 
		processData: false, 
		success: function(result){ 
			if(result[0] == 1){
				toastr.success('Upload success for the attachment.');
				$('#submit1').removeAttr('disabled');
				window.location.href = '?p=setting';
			} else {
				toastr.error(result[1]);
				$('#submit1').attr('disabled', 'disabled');
			}
		}, 
	}); 
}

function processForm2(){
	var fd = new FormData(); 
	var files = $('#app_logo')[0].files[0]; 
	fd.append('file', files); 
	$('#submit2').attr('disabled', 'disabled');

	$.ajax({ 
		url: 'mod/setting/upload2.php', 
		type: 'post', 
		data: fd, 
		contentType: false, 
		processData: false, 
		success: function(result){ 
			if(result[0] == 1){
				toastr.success('Upload success for the attachment.');
				$('#submit1').removeAttr('disabled');
				window.location.href = '?p=setting';
			} else {
				toastr.error(result[1]);
				$('#submit2').attr('disabled', 'disabled');
			}
		}, 
	}); 
}
</script>	
