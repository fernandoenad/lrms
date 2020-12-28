<?php
class Controller{
	function getCourses($data){
		global $conn;
		$result = null;	
		$cou_per_id = $data['0']['1'];
			
		$sql = "SELECT * FROM course
			WHERE cou_per_id=$cou_per_id 
			ORDER BY cou_sort ASC";
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
	
	
	function countCourses($data){
		global $conn;
		$result = null;	
		$cou_id = $data;
			
		$sql = "SELECT * FROM content
			INNER JOIN course ON con_cou_id=cou_id
			WHERE cou_id=$cou_id";
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


	function getContents($data){
		global $conn;
		$result = null;	
		$cat_id = $data['0']['1'];
		$cou_id = $data['0']['2'];
		$cou_per_id = $data['0']['3'];
		
		if($cat_id != 0 && $cou_id != 0){
			$filter = " WHERE con_cou_id=$cou_id AND cou_per_id=$cou_per_id ";
		} else if ($cat_id != 0 && $cou_id  == 0){
			$filter = " WHERE cou_cat_id=$cat_id AND cou_per_id=$cou_per_id ";
		} else {
			$filter = " WHERE cou_per_id=$cou_per_id ";
		}	
		
		$sql = "SELECT * FROM content
			INNER JOIN course ON con_cou_id=cou_id
			INNER JOIN category ON cou_cat_id=cat_id
			$filter
			ORDER BY con_cou_id ASC, con_sort ASC";
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