<?php
session_start();
require_once("../../dbconfig.php");
require_once("../../settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data']['0'])){	
	if($_POST['data']['0'] == "getCategories"){
		$data = array_values($_POST);
		$result = $controller->getCategories($data);
		
		if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
			?>
			<li class="nav-item">
				<a href="?p=browse&catID=<?php echo $row['cat_id'];?>" class="nav-link">
					<i class="fas fa-layer-group"></i>&nbsp;&nbsp;<?php echo $row['cat_name'];?>
					<?php $result2 = $controller->countContents($row['cat_id']); ?>
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
		
	}
}

?>