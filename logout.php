<?php

	session_start();
    unset($_SESSION["user_id"]);
	include('inc/config.php');
header('location:index.php');
   
?>