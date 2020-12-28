<?php
class Controller{
	function getUsers($data){
		global $conn;
		$result = null;	
			
		$sql = "SELECT * FROM person
			ORDER BY per_role ASC, per_lname ASC, per_fname ASC";
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

	
	function getRole($data){
		$code = $data;
		$role = "";
		
		switch($code){
			case 1:
				$role = "Administrator";
				break;
			case 2:
				$role = "Staff";
				break;
			default:
				$role = "Unknown role";
		}
		
		return $role;
	}
	
	
	function getStatus($data){
		$code = $data;
		$status = "";
		
		switch($code){
			case 1:
				$status = "Active";
				break;
			case 0:
				$status = "Inactive";
				break;
			default:
				$status = "Unknown status";
		}
		
		return $status;
	}
	

	function getUser($data){
		global $conn;
		$result = null;	
		
		$per_id = trim(mysqli_real_escape_string($conn, $data['0']['3']));
			
		$sql = "SELECT * FROM person
			WHERE per_id=$per_id";
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

	
	function saveUser($data){
		global $conn;
		$result = null;	

		$per_fname = trim(mysqli_real_escape_string($conn, $data['0']['4']));
		$per_lname = trim(mysqli_real_escape_string($conn, $data['0']['5']));
		$per_uname = trim(mysqli_real_escape_string($conn, $data['0']['6']));
		$per_pword = trim(mysqli_real_escape_string($conn, $data['0']['7']));
		$per_pword = MD5($per_pword);
		$per_role = $data['0']['8'];
		
		$sql = "INSERT INTO person(per_fname, per_lname, per_uname, per_pword, per_role)
			VALUES('$per_fname', '$per_lname', '$per_uname', '$per_pword', '$per_role')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}	
		
		return $result;			
	}


	function updateUser($data){
		global $conn;
		$result = null;	
		
		$per_fname = trim(mysqli_real_escape_string($conn, $data['0']['4']));
		$per_lname = trim(mysqli_real_escape_string($conn, $data['0']['5']));
		$per_uname = trim(mysqli_real_escape_string($conn, $data['0']['6']));
		$per_role = $data['0']['8'];
		$per_id = $data['0']['3'];
		
		$sql = "UPDATE person
			SET per_fname='$per_fname',
				per_lname='$per_lname',
				per_uname='$per_uname',
				per_role=$per_role
			WHERE per_id=$per_id";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	
		
		return $result;	
	}
	
	
	function toggleStatus($data){
		global $conn, $def_pword;
		$result = null;	
		
		$per_id = $data['0']['3'];
		$per_status = $data['0']['4'];	
		$per_pword = MD5($def_pword);
		
		$sql = "UPDATE person
			SET per_status=$per_status,
				per_pword='$per_pword'			
			WHERE per_id=$per_id";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	
		
		return $result;	
	}


	function checkUname($data){
		global $conn;
		$result = null;	
		
		$per_uname = $data['0']['1'];
		
		$sql = "SELECT per_uname FROM person			
			WHERE per_uname='$per_uname'";
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


	function getAssignments($data){
		global $conn;
		$result = null;	
		
		$cou_per_id = trim(mysqli_real_escape_string($conn, $data['0']['3']));
		
		$sql = "SELECT cou_name FROM course			
			WHERE cou_per_id=$cou_per_id";
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