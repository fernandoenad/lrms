<?php
class Controller{
	function getUser($data){
        global $conn;
		$result = null;	
		$per_id = $data['0']['1'];
			
		$sql = "SELECT * FROM person
			WHERE per_id=$per_id
			LIMIT 1";
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


    function updateUser($data){
        global $conn;
		$result = null;	
        $per_fname =  mysqli_real_escape_string($conn, $data['0']['1']);
        $per_lname =  mysqli_real_escape_string($conn, $data['0']['2']);
        $per_id = $data['0']['3'];
			
		$sql = "UPDATE person
			SET per_fname='$per_fname',
                per_lname='$per_lname' 
            WHERE per_id=$per_id";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else{
			$result = array(1, "Record(s) updated.");
		} 
		
		return $result;	      
    }


    function updatePassword($data){
        global $conn;
		$result = null;	
        $per_pword =  mysqli_real_escape_string($conn, $data['0']['1']);
        $per_pword = MD5($per_pword);
        $per_id = $data['0']['2'];
			
		$sql = "UPDATE person
			SET per_pword='$per_pword' 
            WHERE per_id=$per_id";
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