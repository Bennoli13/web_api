<?php
	include_once 'src/Google_Client.php';
	include_once 'src/contrib/Google_Oauth2Service.php';
	
	// Edit Following 3 Lines
	$clientId = '823170553115-t8jnpi7g849m2uj8qfssq1jqpc5u0ksm.apps.googleusercontent.com'; //Application client ID
	$clientSecret = '5YbmjDuI7OCyp5upEDh3V41_'; //Application client secret
	$redirectURL = 'http://140.118.102.44/demo.html'; //Application Callback URL
	
	$gClient = new Google_Client();
	$gClient->setApplicationName('Your Application Name');
	$gClient->setClientId($clientId);
	$gClient->setClientSecret($clientSecret);
	$gClient->setRedirectUri($redirectURL);
	$google_oauthV2 = new Google_Oauth2Service($gClient);
?>