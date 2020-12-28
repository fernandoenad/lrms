<?php
session_start();
require_once("../../../dbconfig.php");
require_once("../../../settings.php");
require_once("controller.php");

$controller = new Controller();

if(isset($_POST['data']['0'])){	
    if($_POST['data']['0'] == "countElement"){
        $data = array_values($_POST);
        $result = $controller->countElement($data);
			
        header("Content-Type: application/json");
        echo json_encode($result);
        exit();

    } else if($_POST['data']['0'] == "getContentsRecent"){
        $data = array_values($_POST);
        $result = $controller->getContentsRecent($data);
        
        if($result['0'] == 1){ while($row = $result['2']->fetch_assoc()){
            $countResult = $controller->countDownload($row['con_id']);
            $count = (isset($countResult['3']) ? $countResult['3'] : 0);
            ?>
            <tr>
                <td><?php echo $row['con_title'];?></td>
                <td><?php echo $row['cat_name'];?></td>
                <td><?php echo $row['cou_name'];?></td>
                <td><?php echo date('m/d', strtotime($row['con_datefrom']))." to ".date('m/d', strtotime($row['con_dateto']));?></td>
                <td><?php echo $count;?> downloads</td>
            </tr>
            <?php
        }} else {
            ?>
            <tr>
                <td colspan="5"><?php echo $result['1'];?></td>
            </tr>
            <?php
        }
    }
}
?>