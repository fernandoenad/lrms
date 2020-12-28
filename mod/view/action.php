<?php
session_start();
require_once("../../dbconfig.php");
require_once("../../settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data']['0'])){	
	if($_POST['data']['0'] == "getContents"){
		$data = array_values($_POST);
		$result = $controller->getContents($data);		
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
				$countResult = $controller->countDownload($row['con_id']);
				$count = (isset($countResult['3']) ? $countResult['3'] : 0);
			?>
			<div class="callout callout-info">
				<h5><i class="fas fa-book-open"></i> <?php echo $row['con_title'];?></h5>
				<p>
					<?php echo $row['con_description'];?><br>
					<small>
						<i class="fa fa-paperclip" title="Attachment"></i> 
						<strong>
								<em><a href="<?php echo "./data/".($row['con_attachment'] == "" ? "#" : $row['con_attachment']);?>" download onClick="downloadCount(<?php echo $row['con_id'];?>);">
									<?php echo ($row['con_attachment'] == "" ? "N/A" : $row['con_attachment']);?>
								</a>&nbsp;</em>
								(<?php echo $count;?> downloads)
						</strong>
					</small><br>
					<small><em>Period Covered: <strong><?php echo date('F d, Y', strtotime($row['con_datefrom']));?> - <?php echo date('F d, Y', strtotime($row['con_dateto']));?></strong></em></small>
					<hr>
					<small><em>Posted by <strong><?php echo $row['per_fname']." ".$row['per_lname'];?></strong> on <strong><?php echo date('F d, Y @ h:i a', strtotime($row['con_datetime']));?></strong></em></small>
				</p>
			</div>
			<?php
		}} else { ?>
			<div class="callout callout-warning">
				<h5><?php echo $result['1'];?></h5>
			</div>
			<?php
		} 

	} else if($_POST['data']['0'] == "getCourseName"){
		$data = array_values($_POST);
		$result = $controller->getCourseName($data);

		header("Content-Type: application/json");
		echo json_encode($result);
		exit();

	} else if($_POST['data']['0'] == "downloadCount"){
		$data = array_values($_POST);
		$result = $controller->downloadCount($data);

		header("Content-Type: application/json");
		echo json_encode($result);
		exit();
	}
}
?>