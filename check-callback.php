<?php
	if(isset($_SESSION['sn_type'])){
		/********************************** FACEBOOK ***********************************/
		if($_SESSION['sn_type'] == 'facebook'){
			// Try para obtener el token
			try {
				if(isset($_SESSION['facebook_access_token'])){
					$accessTokenFB = $_SESSION['facebook_access_token'];
				}else{
					$accessTokenFB = $helper->getAccessToken();
				}
			} catch(FacebookResponseException $e) {
				 echo 'Graph returned an error: ' . $e->getMessage();
				  exit;
			} catch(FacebookSDKException $e) {
				echo 'Facebook SDK returned an error: ' . $e->getMessage();
				  exit;
			}
			if(isset($accessTokenFB)){
				if(isset($_SESSION['facebook_access_token'])){
					$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
				}else{
					// Token de acceso de corta duración en sesión
					$_SESSION['facebook_access_token'] = (string) $accessTokenFB;
					
					  // Controlador de cliente OAuth 2.0 ayuda a administrar tokens de acceso
					$oAuth2Client = $fb->getOAuth2Client();
					
					// Intercambia una ficha de acceso de corta duración para una persona de larga vida
					$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
					$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
					
					// Establecer token de acceso predeterminado para ser utilizado en el script
					$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
					$_SESSION['user_logged_in'] = true;
					$_SESSION['logged_in_with'] = 'facebook';
				}
			}
		}
		/********************************** GITHUB ***********************************/
		if($_SESSION['sn_type'] == 'github'){
			if(isset($_GET['code'])){
				$_SESSION['user_logged_in'] = true;
				$_SESSION['logged_in_with'] = 'github';
				$_SESSION['github_code'] = $_GET['code'];
			} 
		}
		/********************************** GOOGLE ***********************************/
		if($_SESSION['sn_type'] == 'google'){
			if(isset($_GET['code'])){
				$_SESSION['user_logged_in'] = true;
				$_SESSION['logged_in_with'] = 'google';
				$_SESSION['google_code']= $_GET['code'];
			} 
		}
	} else {
		$urlBtnLoginFacebook = $helper->getLoginUrl($redirectURL, $fbPermissions);
		$urlBtnLoginGithub = 'https://github.com/login/oauth/authorize?client_id=' . $appIdGithub;
		$urlBtnLoginGoogle = $google_client->createAuthUrl();
	}
?>