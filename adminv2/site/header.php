<!DOCTYPE html>
<html>
<head>
	<title>ATS Development</title>
	<link rel="stylesheet" type="text/css" href="<?=ROOT.'/vendor/bootstrap/css/bootstrap.min.css'?>">
	
	<script type="text/javascript" src="<?=ROOT.'/vendor/jquery/js/jquery-2.1.4.min.js'?>"></script>
	<script type="text/javascript" src="<?=ROOT.'/vendor/bootstrap/js/bootstrap.min.js'?>"></script>
</head>
<body>
<?php
session_start();

if(!defined("ROOT")){
	define("ROOT", "../");
}

if(!(array_key_exists("USER_ID", $_SESSION) && $_SESSION['USER_ID'] != 0)){
	header("Location: ".ROOT."/site/login/login.php");
}else{
	define("LOGGED_USER", $_SESSION['USER_ID']);
}
?>