<?php
session_start();
require_once("../dbconfig.php");
require_once("../settings.php");

if(!isset($_GET['p'])){
	header("Location: ?p=my");
} else {
	$title = ucwords($_GET['p']);
}

include("_header.php");
$logged_userStatus == 1 ? include("_navbar_my.php") : include("_navbar_auth.php");

if(isset($_GET['p'])){
	if($logged_userStatus == 0){
		include("mod/auth/index.php");
	} else {
		if ($_GET['p'] == "auth"){
			include("mod/auth/index.php");	
		} else if ($_GET['p'] == "logout"){
			session_destroy();
			echo "<script>window.location.href = '?p=auth'</script>";	
		} else if ($_GET['p'] == "my"){
			include("mod/my/index.php");		
		} else if ($_GET['p'] == "profile"){
			include("mod/profile/index.php");		
		} else if ($_GET['p'] == "content"){
			include("mod/content/index.php");						
		} else if ($_GET['p'] == "tool"){
			include("mod/tool/index.php");		
		} else if ($_GET['p'] == "user"){
			if(isset($_GET['action']) && isset($_GET['ID'])){
				if($_GET['action'] == "new" || $_GET['action'] == "edit" || $_GET['action'] == "show" || $_GET['action'] =="delete") {
					include("mod/user/option.php");	 
				} else {
					include("mod/user/index.php");
				} 
			} else {
				include("mod/user/index.php");		
			}		
		} else if ($_GET['p'] == "configuration"){
			if(isset($_GET['action']) && isset($_GET['ID'])){
				if(($_GET['option'] == "category" || $_GET['option'] == "course" || $_GET['option'] =="content")
				&& ($_GET['action'] == "new" || $_GET['action'] == "edit" || $_GET['action'] =="delete")) {
					include("mod/configuration/option.php");	
				} else {
					include("mod/configuration/index.php");	
				}
			} else {
				include("mod/configuration/index.php");		
			}
		} else if ($_GET['p'] == "setting"){
			include("mod/setting/index.php");						
		} else {	
			echo "<script>document.title = ' Error 404';</script>";
			require_once("_404.php");		
		}
	}
} else {
	echo '<script>window.location = "?p=auth";</script>';
}
?>

<a id="back-to-top" href="#" class="btn btn-secondary back-to-top" role="button" aria-label="Scroll to top">
	<i class="fas fa-chevron-up"></i>
</a>

<?php 
include("_footer.php"); 
?>
