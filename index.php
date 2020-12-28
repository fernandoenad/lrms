<?php 
session_start();
require_once("dbconfig.php");
require_once("settings.php");

if(!isset($_GET['p'])){
	header("Location: ?p=home");
} else {
	$title = ucwords($_GET['p']);
}

include("_header.php");
include("_navbar.php");

if($_GET['p'] == "home"){
	include("mod/home/index.php");
} else if($_GET['p'] == "browse"){
	include("mod/browse/index.php");
} else if($_GET['p'] == "view"){
	include("mod/view/index.php");
} else {
	include("_404.php");
}

include("_footer.php");
$conn->close();
?>	

