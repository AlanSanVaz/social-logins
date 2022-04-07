<?php
session_start();
unset($_SESSION['sn_type']);
unset($_SESSION['userData']);
unset($_SESSION['facebook_access_token']);
unset($_SESSION['github_access_token']);
unset($_SESSION['google_access_token']);
unset($_SESSION['user_logged_in']);
unset($_SESSION['logged_in_with']);
unset($_SESSION['github_code']);
unset($_SESSION['google_code']);

//Destroy entire session data.
session_destroy();

// Redireccionar a página de inicio
header("Location:index.php");
exit;
?>