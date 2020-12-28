<?php
session_start();
require_once("../../../dbconfig.php");
require_once("../../../settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data']['0'])){	

	if($_POST['data']['0'] == "authenticate"){
		$data = array_values($_POST);

		$result = $controller->authenticate($data);
		
		if($result['0'] == 1){ $row = $result['2'];
			$_SESSION['logged_userStatus'] = 1;
			$_SESSION['logged_userID'] = $row['per_id'];		
			$_SESSION['logged_userRole'] = $row['per_role'];
			$_SESSION['logged_userFullname'] = ucwords($row['per_fname']." ".$row['per_lname']);	
		}
		
		header("Content-Type: application/json");
		echo json_encode($result);

		exit();
	
	} 
} 
?>