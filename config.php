<?php
	require_once __DIR__ . '/../../../libraries/facebook-php-sdk/autoload.php';
	require_once __DIR__ . '/../../../libraries/composer/vendor/autoload.php';
	
	// Include required libraries to login facebook
	use Facebook\Facebook;
	use Facebook\Exceptions\FacebookResponseException;
	use Facebook\Exceptions\FacebookSDKException;

	//start session on web page
	session_start();
	
	$appIdGithub = '';
	$appSecretGithub = '';
	$urlAPIGithub  = '';
	
	$appIdFacebook = '';
	$appSecretFacebook = '';
	
	$appIdGoogle = '';
	$appSecretGoogle = '';

	$redirectURL = 'LINK DE REDIRECCION PARA GOOGLE Y FACEBOOK';

	/********************************** GOOGLE ***********************************/
	//Make object of Google API Client for call Google API
	$google_client = new Google_Client();
	//Set the OAuth 2.0 Client ID | Copiar "ID DE CLIENTE"
	$google_client->setClientId($appIdGoogle);
	//Set the OAuth 2.0 Client Secret key
	$google_client->setClientSecret($appSecretGoogle);
	//Set the OAuth 2.0 Redirect URI | URL AUTORIZADO
	$google_client->setRedirectUri($redirectURL);
	// to get the email and profile 
	$google_client->addScope('email');
	$google_client->addScope('profile');

	/********************************** FACEBOOK ***********************************/
	$fbPermissions = array('email');  //Permisos opcionales

	$fb = new Facebook(array(
		'app_id' => $appIdFacebook,
		'app_secret' => $appSecretFacebook,
		'default_graph_version' => 'v2.9',
	));
	
	// Obtener el apoyo de logueo
	$helper = $fb->getRedirectLoginHelper();
?>