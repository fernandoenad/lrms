	<div class="content-wrapper">
		<div class="content">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<ol class="breadcrumb float-sm-left bg-transparent">
							<li class="breadcrumb-item" id="bc-link-1"><a href="?p=my">Home</a></li>
							<li class="breadcrumb-item active" id="bc-link-2">Content Management</li>
						</ol>
					</div>					
				</div>
				<div class="row">
					<div class="col-sm-3">
						<div class="card">
							<div class="card-header border-transparent">
								<h3 class="card-title">Categories</h3>
								<a href="?p=configuration&option=category&action=new&catID=0&couID=0&ID=0" title="New category" class="btn btn-primary btn-xs float-right">
									<i class="fas fa-plus"></i> New Category
								</a>
							</div>
							<div class="card-body p-0">
								<div class="table-responsive">
									<table class="table m-0">
										<tbody id="category-list">
											<tr>
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
					<div class="col-sm-5">
						<div class="card">
							<div class="card-header border-transparent">
								<h3 class="card-title">Courses</h3>
								<a href="?p=configuration&option=course&action=new&catID=0&couID=0&ID=0" title="New course" class="btn btn-primary btn-xs float-right">
									<i class="fas fa-plus"></i> New Course
								</a>
							</div>
							<div class="card-body p-0">
								<div class="table-responsive">
									<table class="table m-0">
										<tbody id="course-list">
											<tr>
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
					<div class="col-sm-4">
						<div class="card">
							<div class="card-header border-transparent">
								<h3 class="card-title">Contents</h3>
								<a href="?p=configuration&option=content&action=new&catID=0&couID=0&ID=0" title="New content" class="btn btn-primary btn-xs float-right">
									<i class="fas fa-plus"></i> New Content
								</a>
							</div>
							<div class="card-body p-0">
								<div class="table-responsive">
									<table class="table m-0">
										<tbody id="content-list">
											<tr>
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
	getCategories();
	getCourses();
	getContents();
	
	var returnCode = '<?php echo (isset($_GET['ok']) ? $_GET['ok'] : '');?>';
	if (returnCode == 'new'){ 
		toastr.success('Record(s) added.');
		setTimeout(function(){window.location.href='?p=configuration';}, 1000);
		
	} else if (returnCode == 'edit'){ 
		toastr.success('Record(s) updated.');
		setTimeout(function(){window.location.href='?p=configuration';}, 1000);
	}		
}

function getCategories(){
	var action = 'getCategories';
	var data = [action, '', '', 0, 0];
	
	$.ajax({
		type: 'POST',
		url: 'mod/configuration/action.php',
		data: {data:data},	
		success: function(result){
			$('#category-list').html(result);
		}
	});
}

function getCourses(){
	var action = 'getCourses';
	var catID = <?php echo (isset($_GET['catID']) ? $_GET['catID'] : 0) ;?>;
	var data = [action, '', '', catID, 0];
	
	$.ajax({
		type: 'POST',
		url: 'mod/configuration/action.php',
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
	var id = <?php echo (isset($_GET['ID']) ? $_GET['ID'] : 0) ;?>;
	var data = [action, '', '', catID, courseID, id];
			
	$.ajax({
		type: 'POST',
		url: 'mod/configuration/action.php',
		data: {data:data},	
		success: function(result){
			$('#content-list').html(result);
		}
	});
}
</script>	
