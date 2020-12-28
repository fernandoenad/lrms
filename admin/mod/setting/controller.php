<?php
class Controller{
	function getOrg($data){
    global $conn;
		$result = null;	
			
		$sql = "SELECT * FROM organization";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs->fetch_assoc(), $rs->num_rows);
		}	
		
		return $result;	
    }


  function updateOrg($data){
		global $conn;
		$result = null;	
		$org_info =  mysqli_real_escape_string($conn, $data);
			
		$sql = "UPDATE organization
			SET org_info='$org_info'";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else{
			$result = array(1, "Record(s) updated.");
		} 
		
		return $result;	      
    }
}
?>