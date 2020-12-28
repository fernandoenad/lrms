<?php
session_start();
require_once("../../../dbconfig.php");
require_once("../../../settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data']['0'])){	
    if($_POST['data']['0'] == "getOrg"){
        $data = array_values($_POST);
        $result = $controller->getOrg($data);
        $dataUnserialize = unserialize($result[2]['org_info']);
        $result = array($result[0], $result[1], $dataUnserialize, $result[3], );

        header("Content-Type: application/json");
        echo json_encode($result);
        exit();	

    } else if($_POST['data']['0'] == "updateOrg"){
        $data = array_values($_POST);
        $data2 = serialize(array(
            $data[0][1],
            $data[0][2],
            $data[0][3],
            $data[0][4],
            $data[0][5],
            $data[0][6],
            $data[0][7],
            $data[0][8],
            $data[0][9],
            $data[0][10]));

        $result = $controller->updateOrg($data2);
			
        header("Content-Type: application/json");
        echo json_encode($result);
        exit();	
    } 
}
?>