<?php

include("./lib/rpx.inc");

$signin_with_modal = "http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'];
$signin_with_embedded = $signin_with_modal."?embedded=true";

$token_url = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$auth_url = rpx_util::getAuthUrl( $token_url );
$auth_markup = rpx_util::getEmbeddedMarkUp( $token_url );

$token = $_POST["token"];
if( $token ){
  $authinfo_url = rpx_util::getAuthInfoUrl( $token );
  $authinfo = rpx_util::getAuthInfo( $authinfo_url );
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Style-Type" content="text/css">
<title>RPX Simple Demo</title>
</head>
<body>
<h1>"RPX" Simple Demo Page</h1>
<p>You can sign-in to this page using RPX.</p>
<?php
if( $authinfo->stat == "ok" ){
?>
<h2>Welcome! <?php print $authinfo->profile->preferredUsername; ?></h2>
<p><a href="<?php print $signin_with_modal; ?>">Sign Out</a></p>
<h3>Your Profile</h3>
<p>name : <?php print $authinfo->profile->name->formatted; ?></p>
<p>photo : <img src="<?php print $authinfo->profile->photo; ?>"></p>
<p>displayName : <?php print $authinfo->profile->displayName; ?></p>
<p>preferredUsername : <?php print $authinfo->profile->preferredUsername; ?></p>
<p>url : <a href="<?php print $authinfo->profile->url; ?>"><?php print $authinfo->profile->url; ?></a></p>
<p>providerName : <?php print $authinfo->profile->providerName; ?></p>
<p>identifier : <?php print $authinfo->profile->identifier; ?></p>
<?php
}else{
  if( $_GET["embedded"] == "true" ){
?>
<div>
<a href="<?php print $signin_with_modal; ?>">Sign In page(modal overlay mode)</a>
</div>
<?php
    print $auth_markup;
  }else{
?>
<!-- sign in link -->
<div>
<a href="<?php print $signin_with_embedded; ?>">Sign In page(js embedded mode)</a>
</div>
<a class="rpxnow" onclick="return false;" href="<?php print $auth_url; ?>">Sign In</a>
<!-- JS -->
<script src="./js/rpx_helper.js" type="text/javascript"></script>
<?php
  }
}
?>
<hr>
<p>Copyright &copy; 2010 ritou</p>
</body>
</html>