<?php
session_start();
require_once("../../../dbconfig.php");
require_once("../../../settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data']['0'])){	
    if($_POST['data']['0'] == "getUser"){
        $data = array_values($_POST);
        $result = $controller->getUser($data);
			
        header("Content-Type: application/json");
        echo json_encode($result);
        exit();	

    } else if($_POST['data']['0'] == "updateUser"){
        $data = array_values($_POST);
        $result = $controller->updateUser($data);
			
        header("Content-Type: application/json");
        echo json_encode($result);
        exit();	

    } else if($_POST['data']['0'] == "updatePassword"){
        $data = array_values($_POST);
        $result = $controller->updatePassword($data);
			
        header("Content-Type: application/json");
        echo json_encode($result);
        exit();	

    }
}
?>