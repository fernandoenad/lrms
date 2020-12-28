<?php
class Controller{
	function countElement($data){
        global $conn;
        $result = null;
        $table = $data['0']['1'];

        $sql = "SELECT * FROM $table";
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


    function getContentsRecent($data){
        global $conn;
        $result = null;
        $limit = $data['0']['1'];

        $sql = "SELECT * FROM content
            INNER JOIN course ON con_cou_id=cou_id
            INNER JOIN category ON cou_cat_id=cat_id
            ORDER BY con_id DESC
            LIMIT $limit";
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