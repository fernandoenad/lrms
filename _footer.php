	<!-- Main Footer -->
	<footer class="main-footer">
		<div class="float-right d-none d-sm-inline">
			<small><?php echo $app_fullname;?> Version <?php echo $app_version;?></small>
		</div>
		<small>Copyright &copy; <?php echo $app_copyyear;?>. <a href="mailto:<?php echo $app_authoremail;?>"><?php echo $app_author;?></a>. All rights reserved.</small>
	</footer>
</div>
<?php $conn->close();?>

<div class="modal fade" role="dialog" id="myModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">About the app</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>The <?php echo $webapp_nameshort;?> is our official repository of learning resources of any media types for 
				learner consumption. Through this system, we are gearing for a paperless learning and educating in the new 
				normal. Upon closing this prompt, you may select the grade level and from there select
				the subjects you are enrolled.</p>
				<p>Once the subject is selected, you should be able to see the posted contents by your subject teacher, just click
				the attachment identified as <i class="fa fa-paperclip" title="Attachment"></i> (if any) to download the materials and work on them offline.</p>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
function getAnnouncement(){
	$('#myModal').modal('show');
}

function getFeedback(){
	alert('Page in progress...');
}
</script>
<!-- REQUIRED SCRIPTS -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/toastr/toastr.min.js"></script>
<script src="plugins/pace-progress/pace.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="mod/<?php echo $_GET['p'];?>/index.js"></script>
</body>
</html>