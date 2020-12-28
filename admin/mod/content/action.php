<?php
session_start();
require_once("../../../dbconfig.php");
require_once("../../../settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data']['0'])){	
	if($_POST['data']['0'] == "getCourses"){
		$data = array_values($_POST);
		$result = $controller->getCourses($data);
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			?>
			<li class="nav-item">
				<a href="?p=content&catID=<?php echo $row['cou_cat_id'];?>&courseID=<?php echo $row['cou_id'];?>" class="nav-link" onClick="getContents(<?php echo $data['0']['1'];?>);">
					<i class="fas fa-layer-group"></i>&nbsp;&nbsp;<?php echo $row['cou_name'];?>
					<?php $result2 = $controller->countCourses($row['cou_id']); ?>
					<span class="badge bg-primary float-right"><?php echo ($result2['0'] == 1 ? $result2['3'] : 0);?></span>
				</a>
			</li>
			<?php
		}} else { ?>
			<li class="nav-item">
				<a href="#" class="nav-link">
					<i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;<?php echo $result['1'];?>
				</a>
			</li>
			<?php
		 } 
		 
	} else if($_POST['data']['0'] == "getContents"){
		$data = array_values($_POST);
		$result = $controller->getContents($data);		
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			$countResult = $controller->countDownload($row['con_id']);
			$count = (isset($countResult['3']) ? $countResult['3'] : 0);
			?>
			<tr>
				<td><?php echo $row['con_title'];?></td>
				<td width="25%"><?php echo $row['con_description'];?></td>
				<td> 
					<strong><a href="<?php echo "../data/".($row['con_attachment'] == "" ? "#" : $row['con_attachment']);?>" target="_blank"><?php echo ($row['con_attachment'] == "" ? "N/A" : "<i class='fa fa-paperclip' title='Attachment'></i>");?></a>
					&nbsp; <i class="fas fa-download"></i> (<?php echo $count;?>)
				</td>
				<td><small><?php echo date('m/d', strtotime($row['con_datefrom']));?> - <?php echo date('m/d', strtotime($row['con_dateto']));?></small></td>
				<td>
					<button class="btn btn-xs btn-default" onClick="moveSort(<?php echo $row['con_id'];?>,-1,<?php echo $row['con_sort'];?>);">
						<i class="fas fa-arrow-up"></i>
					</button>
					<button class="btn btn-xs btn-default" onClick="moveSort(<?php echo $row['con_id'];?>,1,<?php echo $row['con_sort'];?>);">					
						<i class="fas fa-arrow-down"></i>
					</button>&nbsp;
					<a href="#" onClick="displayToggle(<?php echo $row['con_id'];?>,<?php echo $row['con_display'];?>);">
						<i class="fas fa-eye<?php echo ($row['con_display'] == 1 ? "" : "-slash");?>"></i>
					</a>&nbsp;					
					<a href="#" onClick="return confirm('Confirm delete?') ? deleteOption(<?php echo $row['con_id'];?>) : 'false';">
						<i class="fas fa-trash-alt text-danger"></i>
					</a>&nbsp;
					<a href="#" onClick="getOption('edit', <?php echo $row['cou_cat_id'];?>, <?php echo $row['con_cou_id'];?>, <?php echo $row['con_id'];?>);">
						<i class="fas fa-external-link-alt"></i>
					</a>
					
				</td>
			</tr>
			<?php
		}} else { ?>
			<tr>
				<td colspan="5"><i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;<?php echo $result['1'];?></td>
			</tr>	
			<?php
		} 	
		
	} 
}
?>