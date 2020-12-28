<?php
class Controller{
	
	function getContents($data){
		global $conn;
		$result = null;	
		$cou_id = $data['0']['1'];
			
		$sql = "SELECT * FROM content
			INNER JOIN course ON con_cou_id=cou_id
			INNER JOIN person ON cou_per_id=per_id
			WHERE con_cou_id=$cou_id AND con_display=1
			ORDER BY con_sort ASC";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}	
		
		return $result;		
	}	
	
	function getCourseName($data){
		global $conn;
		$result = null;	
		$cou_id = $data['0']['1'];
			
		$sql = "SELECT * FROM course
			WHERE cou_id=$cou_id";
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
	
	
	function downloadCount($data){
		global $conn;
		$result = null;	
		$dow_con_id = $data['0']['1'];
			
		$sql = "INSERT INTO download(dow_con_id, dow_datetime)
			VALUES($dow_con_id, NOW())";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else{
			$result = array(1, "Downloading file.");
		} 	
		
		return $result;		
	}
	
	
	function countDownload($data){
		global $conn;
		$result = null;	
		$dow_con_id = $data;
			
		$sql = "SELECT * FROM download
			WHERE dow_con_id=$dow_con_id";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "0 record(s) found.");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs, $rs->num_rows);
		}	
		
		return $result;			
	}		
}
?>