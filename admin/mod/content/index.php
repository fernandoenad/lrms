	<div class="content-wrapper">
		<div class="content">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<ol class="breadcrumb float-sm-left bg-transparent">
							<li class="breadcrumb-item" id="bc-link-1"><a href="?p=my">Home</a></li>
							<li class="breadcrumb-item active" id="bc-link-2">Contents</li>
						</ol>
					</div>					
				</div>
				<div class="row">
					<div class="col-sm-4">
						<a href="#" class="btn btn-primary btn-block mb-3" onClick="getOption('new', 0, 0, 0);">New Content</a>
						
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">My Courses</h3>
							</div>
							<div class="card-body p-0">
								<ul class="nav nav-pills flex-column" id="course-list">
									<li class="nav-item">
										<a href="#" class="nav-link">
											#
										</a>
									</li>
								</ul>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
					<div class="col-sm-8">
						<div class="card card-primary card-outline" id="content-body">
							<div class="card-header">
								<h3 class="card-title">My Contents</h3>
								<div class="card-tools">
									<!--
									<div class="input-group input-group-sm">
										<input type="text" class="form-control" placeholder="Search">
										<div class="input-group-append">
											<div class="btn btn-primary">
												<i class="fas fa-search"></i>
											</div>
										</div>
									</div>	
									-->								
								</div>
								<!-- /.card-tools -->
							</div>
							<!-- /.card-header -->
							<div class="card-body p-0">
								<div class="table-responsive mailbox-messages">
									<table class="table table-hover table-striped">
										<thead>
											<tr>
												<td>Title</td>
												<td>Description</td>
												<td>Attachment</td>
												<td>Coverage</td>
												<td></td>
											</tr>
										</thead>
										<tbody id="content-list">
											<tr>
												<td>#</td>
												<td>#</td>
												<td>#</td>
												<td>#</td>
												<td></td>
											</tr>
										</tbody>
									</table>
										<!-- /.table -->
								</div>
								<!-- /.mail-box-messages -->
								<div class="card-footer p-0">
									<div class="mailbox-controls">
									</div>
								</div>
							</div>
							<!-- /.card -->
						</div>
						<!-- /.card -->
					</div>
				</div>				
			</div>
		</div>
	</div>
	
<script type="text/javascript">	
setTimeout(function(){preLoad();}, 0);

function preLoad(){
	getCourses();
	getContents();

	var returnCode = '<?php echo (isset($_GET['ok']) ? $_GET['ok'] : '');?>';
	if (returnCode == 'new'){ 
		toastr.success('Record(s) added.');
		setTimeout(function(){window.location.href='?p=content';}, 1000);
		
	} else if (returnCode == 'edit'){ 
		toastr.success('Record(s) updated.');
		setTimeout(function(){window.location.href='?p=content';}, 1000);
	}	
}

function getCourses(){
	var action = 'getCourses';
	var userID = <?php echo $logged_userID;?>;
	var data = [action, userID];
	
	$.ajax({
		type: 'POST',
		url: 'mod/content/action.php',
		data: {data:data},	
		success: function(result){
			$('#course-list').html(result);
		}
	});
}

function getContents(){
	var action = 'getContents';
	var catID = <?php echo (isset($_GET['catID']) ? $_GET['catID'] : 0) ;?>;
	var courseID = <?php echo (isset($_GET['courseID']) ? $_GET['courseID'] : 0) ;?>;
	var userID = <?php echo $logged_userID;?>;
	var data = [action, catID, courseID, userID];
			
	$.ajax({
		type: 'POST',
		url: 'mod/content/action.php',
		data: {data:data},	
		success: function(result){
			$('#content-list').html(result);
		}
	});
}


function getOption(act, cat_id, cou_id, id){
	var action = 'getOption';
	var option = 'content';
	var data = [action, option, act, cat_id, cou_id, id];
	$.ajax({
		type: 'POST',
		url: 'mod/configuration/action.php',
		data: {data:data},	
		success: function(result){
			$('#content-body').html(result);
		}
	});
}


function processForm(request){
	var action = request == 'new' ? 'saveOption' : 'editOption';
	var option = 'content';
	var act = request;
	var id = $('#con_id').val();
	var data = [action, option, act, id];
	
	$('#submit').attr('disabled', 'disabled');
	$('#cancel').attr('disabled', 'disabled');
	
	var response = validateForm(data);
	if(response[0] == true && data[1] == 'content'){
		data = data.concat(response[1]);
		$.ajax({
			type: 'POST',
			url: 'mod/configuration/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					window.location.href='?p=content&ok='+act;
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
	
	if(data[1] == 'content'){
		var con_cou_id = $('#con_cou_id').val();
		var con_title = $('#con_title').val();
		var con_description = $('#con_description').val();
		var con_attachment = 	$('#con_attachment_old').val();
		var con_datefrom = $('#con_datefrom').val();
		var con_dateto = $('#con_dateto').val();
		var con_per_id = $('#con_per_id').val();
		var con_display = $('#con_display').is(':checked') == true ? 1 : 0;

		if(con_cou_id == ''){
			result = false;
			//toastr.error('Error');
		} else if(con_title == ''){
			result = false;
			//toastr.error('Error');
		} else if(con_description == ''){
			result = false;
			//toastr.error('Error');
		} else if(con_attachment == ''){
			result = false;
			//toastr.error('Error');
		} else if(con_per_id == ''){
			result = false;
			//toastr.error('Error');
		} 
		
		fields.push(con_cou_id, con_title, con_description, con_attachment, con_datefrom, con_dateto, con_per_id, con_display);
		
	} 
	
	return [result, fields];
}


function uploadAttachment(){
	var fd = new FormData(); 
	var files = $('#con_attachment')[0].files[0]; 
	fd.append('file', files); 
	$('#submit').attr('disabled', 'disabled');

	$.ajax({ 
		url: 'mod/configuration/upload.php', 
		type: 'post', 
		data: fd, 
		contentType: false, 
		processData: false, 
		success: function(result){ 
			if(result[0] == 1){
				$('#con_attachment_old').val(result[1]);
				toastr.success('Upload success for the attachment.');
				$('#submit').removeAttr('disabled');
			} else {
				$('#con_attachment').val('');
				toastr.error(result[1]);
				$('#submit').attr('disabled', 'disabled');
			}
		}, 
	}); 
}


function deleteOption(id){
	var action = 'deleteOption';
	var option = 'content';
	var act = 'delete';
	var data = [action, option, act, id];
	
	if(data[1] == 'content'){
		$.ajax({
			type: 'POST',
			url: 'mod/configuration/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					toastr.success(result[1]);
					getContents();
				} else {
					toastr.error(result[1]);
				}
			}
		});
		
	}
	
}


function moveSort(id, direction, sort){
	var action = 'moveSort';
	var option = 'content';
	var act = 'edit';
	var data = [action, option, act, id, direction, sort];

	if(data[1] == 'content'){
		$.ajax({
			type: 'POST',
			url: 'mod/configuration/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					getContents();
					toastr.success(result[1]);
				} else {
					toastr.error(result[1]);
				}
			}
		});
	}	
	
}


function displayToggle(contentID, contentDisplay){
	var action = 'displayToggle';
	var option = 'content';
	var act = 'edit';
	var data = [action, option, act, contentID, contentDisplay];	
	
	$.ajax({
		type: 'POST',
		url: 'mod/configuration/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				getContents();
				toastr.success(result[1]);
			} else {
				toastr.error(result[1]);
			}
		}
	});	
}
</script>	
