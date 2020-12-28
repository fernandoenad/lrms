	<div class="content-wrapper">
		<div class="content">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<ol class="breadcrumb float-sm-left bg-transparent">
							<li class="breadcrumb-item active" id="bc-link-1"><a href="?p=my">Home</a></li>
							<li class="breadcrumb-item active" id="bc-link-2">Dashboard</li>
						</ol>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-3">
						<div class="info-box">
							<span class="info-box-icon bg-info elevation-1"><i class="fas fa-layer-group"></i></span>

							<div class="info-box-content">
								<span class="info-box-text">Categories</span>
								<span class="info-box-number" id="countCat">#</span>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="info-box mb-3">
							<span class="info-box-icon bg-danger elevation-1"><i class="fas fa-book"></i></span>

							<div class="info-box-content">
								<span class="info-box-text">Courses</span>
								<span class="info-box-number" id="countCou">#</span>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="info-box mb-3">
							<span class="info-box-icon bg-success elevation-1"><i class="fas fa-book-open"></i></span>

							<div class="info-box-content">
								<span class="info-box-text">Contents</span>
								<span class="info-box-number" id="countCon">#</span>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="info-box mb-3">
							<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

							<div class="info-box-content">
								<span class="info-box-text">Users</span>
								<span class="info-box-number" id="countPer">#</span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header border-transparent">
                				<h3 class="card-title">Latest Contents</h3>
							</div>
							<div class="card-body p-0">
								<div class="table-responsive">
									<table class="table m-0">
										<thead>
											<tr>
												<th>Title</th>
												<th>Course</th>
												<th>Category</th>
												<th>Coverage</th>
												<th><i class="fas fa-download"></i></th>
											</tr>
										</thead>
										<tbody id="list-contents-recent">
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
	countCat();
	countCou();
	countCon();
	countPer();
	getContentsRecent();
}


function countCat(){
	var action = 'countElement';
	var table = 'category';
	var data = [action, table];

	$.ajax({
		type: 'POST',
		url: 'mod/my/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				$('#countCat').html(result[3]);
			} else {
				$('#countPer').html('#');
			}
		}
	});
}


function countCou(){
	var action = 'countElement';
	var table = 'course';
	var data = [action, table];

	$.ajax({
		type: 'POST',
		url: 'mod/my/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				$('#countCou').html(result[3]);
			} else {
				$('#countPer').html('#');
			}
		}
	});
}


function countCon(){
	var action = 'countElement';
	var table = 'content';
	var data = [action, table];

	$.ajax({
		type: 'POST',
		url: 'mod/my/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				$('#countCon').html(result[3]);
			} else {
				$('#countPer').html('#');
			}
		}
	});
}


function countPer(){
	var action = 'countElement';
	var table = 'person';
	var data = [action, table];

	$.ajax({
		type: 'POST',
		url: 'mod/my/action.php',
		data: {data:data},	
		success: function(result){
			if(result[0] == 1){
				$('#countPer').html(result[3]);
			} else {
				$('#countPer').html('#');
			}
		}
	});
}


function getContentsRecent(){
	var action = 'getContentsRecent';
	var limit = 10;
	var data = [action, limit];

	$.ajax({
		type: 'POST',
		url: 'mod/my/action.php',
		data: {data:data},	
		success: function(result){
			$('#list-contents-recent').html(result);
		}
	});	
}
</script>	
