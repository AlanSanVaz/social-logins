<?php
	$userData = array();
	if(isset($_SESSION['sn_type'])){
		/********************************** FACEBOOK ***********************************/
		if($_SESSION['sn_type'] == 'facebook'){
			// Obtener información sobre el perfil de usuario facebook
			try {
				$profileRequest = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,locale,picture');
				$fbUserProfile = $profileRequest->getGraphNode()->asArray();
			} catch(FacebookResponseException $e) {
				echo 'Graph returned an error: ' . $e->getMessage();
				session_destroy();
				// Redirigir usuario a la página de inicio de sesión de la aplicación
				header("Location: ./");
				exit;
			} catch(FacebookSDKException $e) {
				echo 'Facebook SDK returned an error: ' . $e->getMessage();
				exit;
			}
			
			// datos de usuario
			$userData = array(
				'oauth_provider'=> $_SESSION['sn_type'],
				'oauth_uid'     => $fbUserProfile['id'],
				'username'    	=> $fbUserProfile['name'],
				'names'    		=> $fbUserProfile['first_name'],
				'last_names'    => $fbUserProfile['last_name'],
				'email'         => $fbUserProfile['email'],
				'picture'       => $fbUserProfile['picture']['url']
			);
			// Poner datos de usuario en variables de Session
			$_SESSION['userData'] = $userData;
		}
		/********************************** GITHUB ***********************************/
		if($_SESSION['sn_type'] == 'github'){
			/*if(isset( $_SESSION['github_code'] == true)){
				header('Location: index.php');
				exit;
			}*/
			if(isset($_SESSION['userData']) == false || empty($_SESSION['userData']) == true){
				$postParams = [
					'client_id' => $appIdGithub,
					'client_secret' => $appSecretGithub,
					'code' => $_SESSION['github_code']
				];
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $urlAPIGithub);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postParams);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
				$response = curl_exec($ch);
				curl_close($ch);
				$data = json_decode($response);
				
				if($data->access_token != ""){
					$_SESSION['github_access_token'] = $data->access_token;
				} else {
					header('Location: index.php');
					exit;
				}
				$accessToken = $_SESSION['github_access_token'];
				$URL = "https://api.github.com/user";
				$authHeader = "Authorization: token " . $accessToken;
				$userAgentHeader = "User-Agent: social-logins";
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $URL);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_FAILONERROR, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json',$authHeader, $userAgentHeader));
				curl_exec($ch);
				
				if (curl_errno($ch)) {
					$error_msg = curl_error($ch);
				}else {
					$response = curl_exec($ch);
					$data = json_decode($response);
					
					$userData = array(
						'oauth_provider'=> $_SESSION['sn_type'],
						'oauth_uid'     => $data->id,
						'username'    	=> $data->login,
						'names'    		=> $data->name,
						'last_names'    => '',
						'email'         => $data->email,
						'picture'       => $data->avatar_url
					);
					
					$_SESSION['userData'] = $userData;
				}
				curl_close($ch);

				if (isset($error_msg)) {
					// TODO - Handle cURL error accordingly
				}
			}
		}
		/********************************** GOOGLE ***********************************/
		if($_SESSION['sn_type'] == 'google'){
			if(isset($_SESSION['userData']) == false || empty($_SESSION['userData']) == true){
				$token = $google_client->fetchAccessTokenWithAuthCode($_SESSION['google_code']);
				if (!isset($token['error'])) {
					$google_client->setAccessToken($token['access_token']);
					$_SESSION['google_access_token'] = $token['access_token'];
					$google_service = new Google_Service_Oauth2($google_client);
					$data = $google_service->userinfo->get();
					//var_dump($data);
					$mail = explode('@',$data['email']);
					
					$userData = array(
						'oauth_provider'=> $_SESSION['sn_type'],
						'oauth_uid'     => $data['id'],
						'username'    	=> $mail[0],
						'names'    		=> $data['given_name'],
						'last_names'    => $data['familyName'],
						'email'         => $data['email'],
						'picture'       => $data['picture']
					);
					
					$_SESSION['userData'] = $userData;
				}
			}			
		}
	}
?>