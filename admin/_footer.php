	<!-- Main Footer -->
	<footer class="main-footer">
		<div class="float-right d-none d-sm-inline">
			<small><?php echo $app_fullname;?> Version <?php echo $app_version;?></small>
		</div>
		<small>Copyright &copy; <?php echo $app_copyyear;?>. <a href="mailto:<?php echo $app_authoremail;?>"><?php echo $app_author;?></a>. All rights reserved.</small>
	</footer>
</div>
<?php $conn->close();?>
<!-- REQUIRED SCRIPTS -->
<script>
function getAnnouncement(){
	alert('Page in progress...');
}

function getFeedback(){
	alert('Page in progress...');
}
</script>
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../plugins/toastr/toastr.min.js"></script>
<script src="../plugins/pace-progress/pace.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>
