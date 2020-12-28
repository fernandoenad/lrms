<?php
session_start();
require_once("../../dbconfig.php");
require_once("../../settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data']['0'])){	
	if($_POST['data']['0'] == "getCourses"){
		$data = array_values($_POST);
		$result = $controller->getCourses($data);
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			?>
			<li class="nav-item">
				<a href="?p=view&catID=<?php echo $row['cou_cat_id'];?>&courseID=<?php echo $row['cou_id'];?>" class="nav-link">
					<i class="fas fa-book"></i>&nbsp;&nbsp;<?php echo $row['cou_name'];?>
					<?php $result2 = $controller->countContents($row['cou_id']); ?>
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
				
	} else if($_POST['data']['0'] == "getCategoryName") {
		$data = array_values($_POST);
		$result = $controller->getCategoryName($data);

		header("Content-Type: application/json");
		echo json_encode($result);
		exit();
	}
}
?>