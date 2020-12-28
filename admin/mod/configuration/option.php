	<div class="content-wrapper">
		<div class="content">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<ol class="breadcrumb float-sm-left bg-transparent">
							<li class="breadcrumb-item" id="bc-link-1"><a href="?p=my">Home</a></li>
							<li class="breadcrumb-item" id="bc-link-1"><a href="?p=configuration">Content Management</a></li>
							<li class="breadcrumb-item active" id="bc-link-2"><?php echo ucwords($_GET['action']." ".$_GET['option']);?></li>
						</ol>
					</div>					
				</div>
				<div class="row">
					<div class="col-lg-7">
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
					<div class="col-lg-5">
						<div class="card" >
							<div class="card-header border-transparent">
								<h3 class="card-title"><?php echo ucwords($_GET['option']);?> List</h3>
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
	var option = '<?php echo $_GET['option'];?>';
	var act = '<?php echo $_GET['action'];?>';
	var cat_id = <?php echo $_GET['catID'];?>;
	var cou_id = <?php echo $_GET['couID'];?>;
	var id = <?php echo $_GET['ID'];?>;
	var data = [action, option, act, cat_id, cou_id, id];
	
	$.ajax({
		type: 'POST',
		url: 'mod/configuration/action.php',
		data: {data:data},	
		success: function(result){
			$('#option-body').html(result);
		}
	});
}


function getSide(){
	var action = 'getSide';
	var option = '<?php echo $_GET['option'];?>';
	var act = '<?php echo $_GET['action'];?>';
	var cat_id = <?php echo $_GET['catID'];?>;
	var cou_id = <?php echo $_GET['couID'];?>;
	var id = <?php echo $_GET['ID'];?>;
	var data = [action, option, act, cat_id, cou_id, id];
	
	$.ajax({
		type: 'POST',
		url: 'mod/configuration/action.php',
		data: {data:data},	
		success: function(result){
			$('#option-side').html(result);
		}
	});	
}

function processForm(request){
	var action = request == 'new' ? 'saveOption' : 'editOption';
	var option = '<?php echo $_GET['option'];?>';
	var act = '<?php echo $_GET['action'];?>';
	var id = <?php echo $_GET['ID'];?>;
	var data = [action, option, act, id];
	
	$('#submit').attr('disabled', 'disabled');
	$('#cancel').attr('disabled', 'disabled');
	
	var response = validateForm(data);
	if(response[0] == true && data[1] == 'category' ){
		data = data.concat(response[1]);
		$.ajax({
			type: 'POST',
			url: 'mod/configuration/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					window.location.href='?p=configuration&ok='+act;
				} else {
					toastr.error(result[1]);
				}
			}
		});
		
	} else if(response[0] == true && data[1] == 'course'){
		data = data.concat(response[1]);
		$.ajax({
			type: 'POST',
			url: 'mod/configuration/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					window.location.href='?p=configuration&ok='+act;
				} else {
					toastr.error(result[1]);
				}
			}
		});
		
	} else if(response[0] == true && data[1] == 'content'){
		data = data.concat(response[1]);
		$.ajax({
			type: 'POST',
			url: 'mod/configuration/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					window.location.href='?p=configuration&ok='+act;
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
	
	if(data[1] == 'category'){
		var cat_name = $('#cat_name').val();

		if(cat_name == ''){
			result = false;
			//toastr.error('Error');
		} 
		
		fields.push(cat_name);
		
	} else if(data[1] == 'course'){
		var cou_cat_id = $('#cou_cat_id').val();
		var cou_name = $('#cou_name').val();
		var cou_per_id = $('#cou_per_id').val();

		if(cou_cat_id == ''){
			result = false;
			//toastr.error('Error');
		} else if(cou_name == ''){
			result = false;
			//toastr.error('Error');
		} else if(cou_per_id == ''){
			result = false;
			//toastr.error('Error');
		}
		
		fields.push(cou_cat_id, cou_name, cou_per_id);
		
	} else if(data[1] == 'content'){
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


function deleteOption(id){
	var action = 'deleteOption';
	var option = '<?php echo $_GET['option'];?>';
	var act = '<?php echo $_GET['action'];?>';
	var data = [action, option, act, id];
	
	if(data[1] == 'category' ){
		$.ajax({
			type: 'POST',
			url: 'mod/configuration/action.php',
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
		
	} else if(data[1] == 'course'){
		$.ajax({
			type: 'POST',
			url: 'mod/configuration/action.php',
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
		
	} else if(data[1] == 'content'){
		$.ajax({
			type: 'POST',
			url: 'mod/configuration/action.php',
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
	
}


function moveSort(id, direction, sort){
	var action = 'moveSort';
	var option = '<?php echo $_GET['option'];?>';
	var act = '<?php echo $_GET['action'];?>';
	var data = [action, option, act, id, direction, sort];
	
	if(data[1] == 'category' ){
		$.ajax({
			type: 'POST',
			url: 'mod/configuration/action.php',
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
		
	} else if(data[1] == 'course'){
		$.ajax({
			type: 'POST',
			url: 'mod/configuration/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					getSide();
					toastr.success(result[1]);
				} else {
					toastr.error(result);
					toastr.error(result[1]);
				}
			}
		});
		
	} else if(data[1] == 'content'){
		$.ajax({
			type: 'POST',
			url: 'mod/configuration/action.php',
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
	
}


function displayToggle(contentID, contentDisplay){
	var action = 'displayToggle';
	var option = '<?php echo $_GET['option'];?>';
	var act = '<?php echo $_GET['action'];?>';
	var data = [action, option, act, contentID, contentDisplay];	
	
	$.ajax({
		type: 'POST',
		url: 'mod/configuration/action.php',
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
</script>	
