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
	
	function countCategories($data){
		global $conn;
		$result = null;	
		$cat_id = $data;
			
		$sql = "SELECT * FROM content
			INNER JOIN course ON cou_id=con_cou_id
			INNER JOIN category ON cou_cat_id = cat_id
			WHERE cat_id=$cat_id";
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
	
	
	function getCourses($data){
		global $conn;
		$result = null;	
		$cat_id = $data['0']['3'];
		$filter = ($cat_id == 0 ? "" : " WHERE cou_cat_id=$cat_id ");
		//$filter = " WHERE cou_cat_id=$cat_id ";
			
		$sql = "SELECT * FROM course
			$filter
			ORDER BY cou_cat_id ASC, cou_sort ASC";
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
		$cat_id = $data['0']['3'];
		$cou_id = $data['0']['4'];
		
		if($cat_id != 0 && $cou_id != 0){
			$filter = " WHERE cou_cat_id=$cat_id AND con_cou_id=$cou_id ";
		} else if ($cat_id != 0 && $cou_id  == 0){
			$filter = " WHERE cou_cat_id=$cat_id ";
		} else if ($cat_id == 0 && $cou_id  != 0){
			$filter = " WHERE con_cou_id=$cou_id ";
		} else {
			$filter = " ";
		}
	
		//$filter = " WHERE con_cou_id=$cou_id ";
			
		$sql = "SELECT * FROM content
			INNER JOIN course ON con_cou_id=cou_id
			INNER JOIN category ON cou_cat_id=cat_id
			$filter
			ORDER BY con_cou_id ASC, con_sort ASC
			LIMIT 50";
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


	function getPersons($data){
		global $conn;
		$result = null;	
			
		$sql = "SELECT per_id, CONCAT(per_fname,' ',per_lname) AS per_fullname FROM person	
			WHERE per_status=1
			ORDER BY per_fullname ASC";
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
	
	
	function saveCategory($data){
		global $conn;
		$result = null;	
		$cat_name = trim(mysqli_real_escape_string($conn, $data['0']['4']));
		
		$sql = "SELECT * FROM category
			ORDER BY cat_sort DESC
			LIMIT 1";
		$rs = $conn->query($sql);
		if($rs->num_rows > 0){
			$row = $rs->fetch_assoc();
			$sortCount = $row['cat_sort']+1;
		} else {
			$sortCount = 1;
		}
		
		$sql = "INSERT INTO category(cat_name, cat_sort)
			VALUES('$cat_name', $sortCount)";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}	
		
		return $result;	
	}
	
	
	function getCategory($data){
		global $conn;
		$result = null;	
		$cat_id = $data['0']['5'];
		
		$sql = "SELECT * FROM category
			WHERE cat_id=$cat_id
			LIMIT 1";
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
	
	
	function updateCategory($data){
		global $conn;
		$result = null;	
		$cat_name = trim(mysqli_real_escape_string($conn, $data['0']['4']));
		$cat_id = $data['0']['3'];
		
		$sql = "UPDATE category
			SET cat_name='$cat_name'
			WHERE cat_id=$cat_id";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	
		
		return $result;	
	}
	
	
	function deleteCategory($data){
		global $conn;
		$result = null;	
		$cat_id = $data['0']['3'];
		
		$sql = "DELETE FROM category
			WHERE cat_id=$cat_id";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) deleted.");
		}	
		
		return $result;	
	}
	
	
	function saveCourse($data){
		global $conn;
		$result = null;	
		$cou_cat_id = $data['0']['4'];
		$cou_name = trim(mysqli_real_escape_string($conn, $data['0']['5']));
		$cou_per_id = $data['0']['6'];
		
		$sql = "SELECT * FROM course
			WHERE cou_cat_id=$cou_cat_id
			ORDER BY cou_sort DESC
			LIMIT 1";
		$rs = $conn->query($sql);
		if($rs->num_rows > 0){
			$row = $rs->fetch_assoc();
			$sortCount = $row['cou_sort']+1;
		} else {
			$sortCount = 1;
		}
		
		
		$sql = "INSERT INTO course(cou_cat_id, cou_name, cou_per_id, cou_sort)
			VALUES($cou_cat_id, '$cou_name', $cou_per_id, $sortCount)";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}	
		
		return $result;	
	}
	

	function getCourse($data){
		global $conn;
		$result = null;	
		$cou_id = $data['0']['5'];
		
		$sql = "SELECT * FROM course
			WHERE cou_id=$cou_id
			LIMIT 1";
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


	function updateCourse($data){
		global $conn;
		$result = null;	
		$cou_cat_id = $data['0']['4'];
		$cou_name = trim(mysqli_real_escape_string($conn, $data['0']['5']));
		$cou_per_id = $data['0']['6'];
		$cou_id = $data['0']['3'];
		
		$sql = "UPDATE course
			SET cou_cat_id=$cou_cat_id,
				cou_name='$cou_name',
				cou_per_id=$cou_per_id
			WHERE cou_id=$cou_id";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	
		
		return $result;	
	}	
	
	
	function deleteCourse($data){
		global $conn;
		$result = null;	
		$cou_id = $data['0']['3'];
		
		$sql = "DELETE FROM course
			WHERE cou_id=$cou_id";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) deleted.");
		}	
		
		return $result;	
	}
	

	function getContent($data){
		global $conn;
		$result = null;	
		$con_id = $data['0']['5'];
			
		$sql = "SELECT * FROM content
			WHERE con_id=$con_id
			LIMIT 1";
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


	function saveContent($data){
		global $conn;
		$result = null;	
		$con_cou_id = $data['0']['4'];
		$con_title = trim(mysqli_real_escape_string($conn, $data['0']['5']));
		$con_description = trim(mysqli_real_escape_string($conn, $data['0']['6']));
		$con_attachment = trim(mysqli_real_escape_string($conn, $data['0']['7']));
		$con_datefrom = $data['0']['8'];
		$con_dateto = $data['0']['9'];
		$con_per_id = $data['0']['10'];
		$con_display = $data['0']['11'];
		$con_id = $data['0']['3'];
		
		$sql = "SELECT * FROM content
			WHERE con_cou_id=$con_cou_id
			ORDER BY con_sort DESC
			LIMIT 1";
		$rs = $conn->query($sql);
		if($rs->num_rows > 0){
			$row = $rs->fetch_assoc();
			$sortCount = $row['con_sort']+1;
		} else {
			$sortCount = 1;
		}

		$sql = "INSERT INTO content(con_cou_id, 
			con_title, 
			con_description, 
			con_attachment, 
			con_datefrom,
			con_dateto, 
			con_sort,
			con_per_id, 
			con_display)
			VALUES('$con_cou_id',
				'$con_title',
				'$con_description',
				'$con_attachment',
				'$con_datefrom',
				'$con_dateto',
				'$sortCount',
				'$con_per_id',
				'$con_display')";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) added.", $conn->insert_id);
		}	
		
		return $result;	
	}


	function updateContent($data){
		global $conn;
		$result = null;	
		$con_cou_id = $data['0']['4'];
		$con_title = trim(mysqli_real_escape_string($conn, $data['0']['5']));
		$con_description = trim(mysqli_real_escape_string($conn, $data['0']['6']));
		$con_attachment = trim(mysqli_real_escape_string($conn, $data['0']['7']));
		$con_datefrom = $data['0']['9'];
		$con_dateto = $data['0']['9'];
		$con_per_id = $data['0']['10'];
		$con_display = $data['0']['11'];
		$con_id = $data['0']['3'];
		
		$sql = "UPDATE content
			SET con_cou_id='$con_cou_id',
				con_title='$con_title',
				con_description='$con_description',
				con_attachment='$con_attachment',
				con_datefrom='$con_datefrom',
				con_dateto='$con_dateto',
				con_per_id='$con_per_id',
				con_display='$con_display'
			WHERE con_id=$con_id";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	
		
		return $result;	
	}	

	
	function deleteContent($data){
		global $conn;
		$result = null;	
		$con_id = $data['0']['3'];
		
		$sql = "DELETE FROM content
			WHERE con_id=$con_id";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) deleted.");
		}	
		
		return $result;	
	}
	
	
	function moveSortCategory($data){
		global $conn;
		$result = null;	
		$cat_id = $data['0']['3'];
		$direction = $data['0']['4'];
		$cat_sort = $data['0']['5'];
		$new_sort = $cat_sort + $direction;
		
		$sql = "UPDATE category
			SET cat_sort=$new_sort
			WHERE cat_id=$cat_id";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	
		
		return $result;	
	}
	
	
	function moveSortCourse($data){
		global $conn;
		$result = null;	
		$cou_id = $data['0']['3'];
		$direction = $data['0']['4'];
		$cou_sort = $data['0']['5'];
		$new_sort = $cou_sort + $direction;
	
		$sql = "UPDATE course
			SET cou_sort=$new_sort
			WHERE cou_id=$cou_id";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	
		
		return $result;	
	}
	
	
	function moveSortContent($data){
		global $conn;
		$result = null;	
		$con_id = $data['0']['3'];
		$direction = $data['0']['4'];
		$con_sort = $data['0']['5'];
		$new_sort = $con_sort + $direction;
		
		$sql = "UPDATE content
			SET con_sort=$new_sort
			WHERE con_id=$con_id";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
		}	
		
		return $result;	
	}
	
	
	function displayToggle($data){
		global $conn;
		$result = null;	
		$con_id = $data['0']['3'];
		$con_display = $data['0']['4'];
		$new_display = ($con_display == 1 ? 0 : 1);
		
		$sql = "UPDATE content
			SET con_display=$new_display
			WHERE con_id=$con_id";
		$rs = $conn->query($sql);
		
		if(!$rs){
			$result = array(-1, $conn->error);
		} else {
			$result = array(1, "Record(s) updated.");
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