<?php 
  
/* Getting file name */
$filename = $_FILES['file']['name'];
$extname = explode(".", $filename);
$filename = "logo.png";
  
/* Location */
$location = "../../../assets/images/".$filename; 
$uploadOk = 1; 
  
if($uploadOk == 0){ 
  $result = array(0, "Error was encountered."); 
}else{ 
  /* Upload file */
  if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){ 
    $result = array(1, $filename);
  }else{ 
    $result = array(0, "Error was encountered."); 
  } 
} 

header("Content-Type: application/json");
echo json_encode($result);
exit();
?> 

			
      