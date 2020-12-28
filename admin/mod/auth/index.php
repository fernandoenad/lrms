	<div class="content-wrapper">
		<div class="content">
			<div class="container">
				<div class="row">
					<div class="col-lg-4"></div>
					<div class="col-lg-4">
						<br>
						<div class="card">
							<div class="card-body login-card-body">
								<p class="login-box-msg">
									<img src="../assets/images/lock.png" style="width: 80px;"><br>
									Sign in to start your session
									<div id="demo"></div>
								</p>
								<form role="form" id="form" method="post" onSubmit="return false;">
									<div class="input-group mb-3">
										<input type="text" class="form-control" placeholder="Username" name="username" id="username" autofocus>
										<div class="input-group-append">
											<div class="input-group-text">
												<span class="fas fa-user"></span>
											</div>
										</div>
									</div>
									<div class="input-group mb-3">
										<input type="password" class="form-control" placeholder="Password" name="password" id="password">
										<div class="input-group-append">
											<div class="input-group-text">
												<span class="fas fa-lock"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-4">
										</div>
										<div class="col-2">
										</div>
										<div class="col-6">
											<button type="submit" class="btn btn-info btn-block" name="submit" id="submit" onClick="authenticate();">Sign In</button>
										</div>
									</div>
								</form>
								<hr>
								<h5>Forgot password?</h5>
								<p class="mb-1">
									<small>Request the designated system administrator to reset your password.</small>
								</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4"></div>	
				</div>
			</div>
		</div>
	</div>
	
<script type="text/javascript">	
function authenticate(){
	var action = 'authenticate';
	var result = sanitizeForm();
	
	if(result[0] == true){
		var data = [action, result[1][0], result[1][1]];
		
		$('#submit').attr('disabled', 'disabled');

		$.ajax({
			type: 'POST',
			url: 'mod/auth/action.php',
			data: {data:data},	
			success: function(result){
				if(result[0] == 1){
					toastr.success('Signing in...');
					setTimeout(function(){
						window.location.href = '?p=my';
					}, 1500);
				} else {
					toastr.error(result[1]);	
					$('#password').val('');
					$('#submit').removeAttr('disabled');
				}
			}
		});
	} 
}

function sanitizeForm(){
	var result = true;
	var fields = [];
	var username = $('#username').val();
	var password = $('#password').val();
	
	if(username == ''){
		result = false;
	} else if(password == ''){
		result = false;
	}
	
	fields.push(username, password);
	return [result, fields];
}
</script>	
