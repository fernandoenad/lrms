	<div class="content-wrapper">
		<div class="content">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<ol class="breadcrumb float-sm-left bg-transparent">
							<li class="breadcrumb-item" id="bc-link-1"><a href="?p=my">Home</a></li>
							<li class="breadcrumb-item active" id="bc-link-2">User Management</li>
						</ol>
					</div>					
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">List</h3>
								<a href="?p=user&action=new&ID=0" title="New content" class="btn btn-primary btn-xs float-right">
									<i class="fas fa-plus"></i> New User
								</a>								
							</div>
							<div class="card-body p-0">
								<div class="table-responsive">
									<table class="table m-0">
										<thead>
											<tr>
												<th>Person</th>
												<th>Username</th>
												<th>Role</th>
												<th>Status</th>
												<th></th>
											</tr>
										</thead>									
										<tbody id="user-list">
											<tr>
												<td>#</td>
												<td>#</td>
												<td>#</td>
												<td>#</td>
												<td>#</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<!-- /.card-body -->
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
	getUsers();
	
	var returnCode = '<?php echo (isset($_GET['ok']) ? $_GET['ok'] : '');?>';
	if (returnCode == 'new'){ 
		toastr.success('Record(s) added.');
		//setTimeout(function(){window.location.href='?p=configuration';}, 1000);
		
	} else if (returnCode == 'edit'){ 
		toastr.success('Record(s) updated.');
		//setTimeout(function(){window.location.href='?p=configuration';}, 1000);
	}	
}

function getUsers(){
	var action = 'getUsers';
	var data = [action];
	
	$.ajax({
		type: 'POST',
		url: 'mod/user/action.php',
		data: {data:data},	
		success: function(result){
			$('#user-list').html(result);
		}
	});
}

</script>	
