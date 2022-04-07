<?php
	session_start();
	if($_SESSION['user_logged_in'] == false){
		if(isset($_POST['sn_type']) && $_POST['sn_type'] != ""){
			if($_POST['sn_type'] == 'facebook' || $_POST['sn_type'] == 'github' || $_POST['sn_type'] == 'google'){
				$_SESSION['sn_type'] = $_POST['sn_type'];
				$success = "ok";
				$message = 'sesion with ' . $_SESSION['sn_type'];
			} else {
				$_SESSION['sn_type'] = '';
				$success = "error";
				$message = "session type invalid";
			}
		} else {
			$success = "error";
			$message = "dont exit sn_type or is empty";
		} 
	} else {
		$success = "error";
		$message = "you already have an active session";
	}
	
	$response = array();
	$response['status'] = $success;	
	$response['message'] = $message;
	exit(json_encode($response));
?>