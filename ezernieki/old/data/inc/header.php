<?php

$homepage_settings = mfa(mq('SELECT * FROM homepage_settings WHERE wwwlngID="'.$lngID.'"'));
echo'
<html>
<head>
<title>';
if(strlen($homepage_settings['hp_title']) < 3){
  echo $our_site_url;
}else{
  echo $homepage_settings['hp_title'];
}
echo'</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="'.$homepage_settings['hp_description'].'" />
<meta name="keywords" content="'.$homepage_settings['hp_keywords'].'" />
<meta name="author" content="Ozmax Development ~ http://www.ozmax.lv" />
<meta name="robots" content="all" />
<meta name="distribution" content="global" />
<script language="javascript" src="js/popup_conf.js"></script>
</head>
';

?>