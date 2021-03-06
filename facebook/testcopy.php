<?php

define('FACEBOOK_SDK_V4_SRC_DIR','facebook/php-sdk-v4/src/Facebook');


require_once("php-sdk-v4/src/Facebook/FacebookSession.php");
require_once("autoload.php");
require_once( 'php-sdk-v4/src/Facebook/HttpClients/FacebookHttpable.php' );
require_once( 'php-sdk-v4/src/Facebook/HttpClients/FacebookCurl.php' );
require_once( 'php-sdk-v4/src/Facebook/HttpClients/FacebookCurlHttpClient.php' );
require_once( 'php-sdk-v4/src/Facebook/Entities/AccessToken.php' );
require_once( 'php-sdk-v4/src/Facebook/Entities/SignedRequest.php');
require_once( 'php-sdk-v4/src/Facebook/FacebookSession.php' );
require_once( 'php-sdk-v4/src/Facebook/FacebookSignedRequestFromInputHelper.php');
require_once( 'php-sdk-v4/src/Facebook/FacebookCanvasLoginHelper.php');
require_once( 'php-sdk-v4/src/Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'php-sdk-v4/src/Facebook/FacebookRequest.php' );
require_once( 'php-sdk-v4/src/Facebook/FacebookResponse.php' );
require_once( 'php-sdk-v4/src/Facebook/FacebookSDKException.php' );
require_once( 'php-sdk-v4/src/Facebook/FacebookRequestException.php' );
require_once( 'php-sdk-v4/src/Facebook/FacebookOtherException.php' );
require_once( 'php-sdk-v4/src/Facebook/FacebookAuthorizationException.php' );
require_once( 'php-sdk-v4/src/Facebook/GraphObject.php' );
require_once( 'php-sdk-v4/src/Facebook/GraphUser.php');
require_once( 'php-sdk-v4/src/Facebook/GraphSessionInfo.php' );
require_once( 'php-sdk-v4/src/Facebook/FacebookJavaScriptLoginHelper.php' );
require_once( 'php-sdk-v4/src/Facebook/FacebookServerException.php' );

use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookCurl;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\Entities\AccessToken;
use Facebook\Entities\SignedRequest;
use Facebook\FacebookSession;
use Facebook\FacebookSignedRequestFromInputHelper;
use Facebook\FacebookCanvasLoginHelper;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookOtherException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;
use Facebook\FacebookJavaScriptLoginHelper;
use Facebook\FacebookServerException;

session_start();


FacebookSession::setDefaultApplication('1377605292563276', 'decb071577e08925990eabb4b3c9d5a5');


$helper = new FacebookRedirectLoginHelper( 'http://localhost:80/facebook/testcopy.php/' );

// try {

//   $session = $helper->getSessionFromRedirect();

  
// } catch( FacebookRequestException $ex ) {
//   // When Facebook returns an error
// } catch( Exception $ex ) {
//   // When validation fails or other local issues
// }

// // see if we have a session
// if ( isset( $session ) ) {

//   echo "hello";
//   // graph api request for user data
//   $request = new FacebookRequest( $session, 'GET', '/me' );
//   $response = $request->execute();
//   // get response
//   $graphObject = $response->getGraphObject();

//   echo $graphObject;
//   // print data
//   echo  print_r( $graphObject, 1 );
//   echo "hello";
// } else {
//   // show login url
//   echo '<a href="' . $helper->getLoginUrl() . '">Login</a>';
// }

if ( isset( $_SESSION ) && isset( $_SESSION['fb_token'] ) ) {
  // create new session from saved access_token
  $session = new FacebookSession( $_SESSION['fb_token'] );
  
  // validate the access_token to make sure it's still valid
  try {
    if ( !$session->validate() ) {
      $session = null;
    }
  } catch ( Exception $e ) {
    // catch any exceptions
    $session = null;
  }
}  

if ( !isset( $session ) || $session === null ) {
  // no session exists
  
  try {
    $session = $helper->getSessionFromRedirect();
  } catch( FacebookRequestException $ex ) {
    // When Facebook returns an error
    // handle this better in production code
    print_r( $ex );
  } catch( Exception $ex ) {
    // When validation fails or other local issues
    // handle this better in production code
    print_r( $ex );
  }
  
}

// see if we have a session
if ( isset( $session ) ) {
  
  // save the session
  $_SESSION['fb_token'] = $session->getToken();
  // create a session using saved token or the new one we generated at login
  $session = new FacebookSession( $session->getToken() );
  
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject()->asArray();
  
  // print profile data
  echo '<pre>' . print_r( $graphObject, 1 ) . '</pre>';
  
  // print logout url using session and redirect_uri (logout.php page should destroy the session)
  echo '<a href="' . $helper->getLogoutUrl( $session, 'http://yourwebsite.com/app/logout.php' ) . '">Logout</a>';
  
} else {
  // show login url
  echo '<a href="' . $helper->getLoginUrl( array( 'email', 'user_friends' ) ) . '">Login</a>';
}


?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"

        "http://www.w3.org/TR/html4/loose.dtd">



<html lang="en">



<head>



  <meta http-equiv="content-type" content="text/html; charset=utf-8">

  <title>Title Goes Here</title>



</head>



<body>


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1377605292563276&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-post" data-href="https://www.facebook.com/alex.fritzel.1/posts/10152499097110882" data-width="500"></div>
<div class="fb-post" data-href="https://www.facebook.com/alex.fritzel.1/posts/10152365769625882" data-width="500"></div>
<div class="fb-post" data-href="https://www.facebook.com/alex.fritzel.1/posts/10152067442545882" data-width="500"></div>
<div class="fb-post" data-href="https://www.facebook.com/alex.fritzel.1/posts/10151516995375882" data-width="500"></div>
<div class="fb-post" data-href="https://www.facebook.com/alex.fritzel.1/posts/10152522309005882" data-width="500"></div>
<div class="fb-post" data-href="https://www.facebook.com/alex.fritzel.1/posts/10151841132485882" data-width="500"></div>



</body>



</html>

