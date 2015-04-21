
<?php>

{
  "require" : {
    "php-sdk-v4" : "4.0.*"
  }
}

FacebookSession::setDefaultApplication('1377605292563276', '●●●●●●●●');

$helper = new FacebookJavaScriptLoginHelper();
try {
  $session = $helper->getSession();
} catch(FacebookRequestException $ex) {
  // When Facebook returns an error
} catch(\Exception $ex) {
  // When validation fails or other local issues
}
if ($session) {
  // Logged in
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

<p>This is my web page</p>



</body>



</html>

