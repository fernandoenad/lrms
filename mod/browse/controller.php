<?php
class Controller{
	
	function getCourses($data){
		global $conn;
		$result = null;	
		$cat_id = $data['0']['1'];
			
		$sql = "SELECT * FROM course
			WHERE cou_cat_id=$cat_id 
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
	
	function countContents($data){
		global $conn;
		$result = null;	
		$cou_id = $data;
			
		$sql = "SELECT * FROM content
			INNER JOIN course ON con_cou_id=cou_id
			WHERE cou_id=$cou_id AND con_display=1";
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
	
	function getCategoryName($data){
		global $conn;
		$result = null;	
		$cat_id = $data['0']['1'];
			
		$sql = "SELECT * FROM category
			WHERE cat_id=$cat_id";
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
}
?>