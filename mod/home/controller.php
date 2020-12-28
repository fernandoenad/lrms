<?php
class Controller{
	
	function getCategories($data){
		global $conn;
		$result = null;	
			
		$sql = "SELECT * FROM category 
			ORDER BY cat_sort ASC";
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
		$cat_id = $data;
			
		$sql = "SELECT * FROM content
			INNER JOIN course ON con_cou_id=cou_id
			INNER JOIN category ON cou_cat_id = cat_id
			WHERE cat_id=$cat_id AND con_display=1";
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