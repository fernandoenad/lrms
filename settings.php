<?php
if(!isset($_SESSION)){ session_start(); }

// Organization
$sql = "SELECT * FROM organization";
$rs = $conn->query($sql);
if($rs->num_rows > 0){
  $row = $rs->fetch_assoc();
  $org_info = unserialize($row['org_info']);
  $org_fullname = $org_info['0'];
  $org_shortname = $org_info['1'];
  $org_email = $org_info['2'];
  $org_web = $org_info['3'];
  $org_address1 = $org_info['4'];
  $org_address2 = $org_info['5'];
  $org_district = $org_info['6'];
  $org_citymun = $org_info['7'];
  $org_province = $org_info['8'];
  $org_region = $org_info['9'];
} else {}

// Application
$app_fullname = "Learning Resources Management System";
$app_shortname = "LRMS";
$app_desc = "learning resources management system of ".$org_fullname;
$app_author = "By Fernando B. Enad";
$app_authoremail = "fernando.enad@deped.gov.ph";
$app_devtdate = "2020-09-08";
$app_copyyear = "2020";
$app_version = "1.0";

$webapp_namefull = $org_fullname." ".$app_fullname;
$webapp_nameshort = $org_shortname." ".$app_shortname;

// User config
$logged_userStatus = (isset($_SESSION['logged_userStatus']) ? $_SESSION['logged_userStatus'] : 0);
$logged_userID = (isset($_SESSION['logged_userID']) ? $_SESSION['logged_userID'] : 0);
$logged_userRole = (isset($_SESSION['logged_userRole']) ? $_SESSION['logged_userRole'] : 0);
$logged_userFullname = (isset($_SESSION['logged_userFullname']) ? $_SESSION['logged_userFullname'] : 0);

// Default
$def_pword = "Password1%";
?>