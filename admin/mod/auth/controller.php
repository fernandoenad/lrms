<?php 
/*
 * Controller Class
 * This class is used for Student-Logon operations
 * @author    	Fernando B. Enad
 * @url        	n/a
 * @license    	n/a
 */

class Controller{
	
	function authenticate($data){
		global $conn;
		$result = null;		
		$per_uname = mysqli_real_escape_string($conn, $data['0']['1']);
		$per_pword = mysqli_real_escape_string($conn, $data['0']['2']);
		$per_pword = MD5($per_pword);
		
		$sql = "SELECT * FROM person 
			WHERE (per_uname = '$per_uname' 
				AND per_pword = '$per_pword'
				AND per_status = '1')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else if($rs->num_rows == 0){
			$result = array(0, "Invalid credential(s).");
		} else {
			$result = array(1, $rs->num_rows . " record(s) found.", $rs->fetch_assoc(), $rs->num_rows);
		}
		
		return $result;		
	}	
}
?>