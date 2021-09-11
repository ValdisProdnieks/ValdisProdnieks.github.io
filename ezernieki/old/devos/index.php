<?php

session_start();
	//$cookieID = $_REQUEST['PHPSESSID']; //$_REQUEST['PHPSESSID'];
    $cookieID = 'slaso523a'; //$_REQUEST['PHPSESSID'];
	if($cookieID == ''){ header("location: ".$our_site_url."/".$devos); }

$msg = '';
unset($msg);

	// ieklaujam konfiguraciju (prefix, suffix u.c. specvariabli) failu:
	include('data/cfg/config.php');


$forbidden = 0;
//if(!eregi($our_site_url,$_SERVER['HTTP_REFERER'])){$forbidden = 1;}
if(!isset($_SESSION['adm_login']) || !isset($_SESSION['adm_pass']) || !isset($_SESSION['userID'])){$forbidden = 1;}
if($_SESSION['adm_login']=='' || $_SESSION['adm_pass']=='' || $_SESSION['userID']==''){$forbidden = 1;}

if($forbidden == 1){
//$revoked_cookieID = strong_replace(substr($_SERVER['QUERY_STRING'],0,32));
setcookie($cookieID,"welcome",$expires,"/");
header("location: ../");
exit;
}
else{

    // ieklaujam DEVOS'a valodas paku - masiivu:
    	if(!file_exists($data.$lng_dir.$devos_lng.$ext)){
			die('Could not find "'.$devos_lng.'" language module in required location!');
    		exit;
		}
   		else{
			include($data.$lng_dir.$devos_lng.$ext);
		}

    // ieklaujam "ozmax made" php funkciju failu:
    	if(!file_exists($data.$cfg.'functions'.$ext)){
			die('Could not find "functions" module in required location!');
    		exit;
		}
   		else{
			include($data.$cfg.'functions'.$ext);
		}


    // kuukiju lasiisana un paarbaude uz datu esamiibu tajaa. ja kas ne taa, refreshojam,
    // ja viss ok - lasaam kuukiju un explodeejam tajaa atrodamos datus, izmantojot "/" delimiteru:


	if ((isset($_HTTP_COOKIE_VARS[$cookieID]) || isset($_COOKIE[$cookieID])) && $_SERVER['HTTP_REFERER'] != $our_site_url ) {

    	if(isset($_HTTP_COOKIE_VARS[$cookieID])){
        	$cookie_content = substr($_HTTP_COOKIE_VARS[$cookieID],0,100);
        }else{
            $cookie_content = substr($_COOKIE[$cookieID],0,100);
        }

        $e = explode("/",$cookie_content);

        if($e[0] == true){
        	$var_1 = strong_replace(substr($e[0],0,20));
        }
        if($e[1] == true){
        	$var_2 = strong_replace(substr($e[1],0,20));
        }
        if($e[2] == true){
        	$var_3 = strong_replace(substr($e[2],0,20));
        }
        if($e[3] == true){
        	$var_4 = strong_replace(substr($e[3],0,20));
        }
        if($e[4] == true){
        	$var_5 = strong_replace(substr($e[4],0,20));
        }
        if($e[5] == true){
        	$var_6 = strong_replace(substr($e[5],0,20));
        }
        if($e[6] == true){
        	$var_7 = strong_replace(substr($e[6],0,20));
        }


	}


    if($var_1 == 'logmeout'){
	       $_SESSION['adm_login'] = '';
           unset($_SESSION['adm_login']);
           $_SESSION['adm_pass'] = '';
           unset($_SESSION['adm_pass']);
           $_SESSION['userID'] = '';
           unset($_SESSION['userID']);
           $_SESSION['full_control'] = '';
           unset($_SESSION['full_control']);
           // dzesam visus datus no kuukas:
           setcookie($cookieID,"welcome",$expires,"/");
           // metamies aaraa no cms direktorijas:
           header("location: ../?catID=0");
    }



	// sledzamies klat pie MySQL servera, (0) noziimee, ka nevajag likt hupn'am "devos/" direktorijas
    // prefiksu, jo mes jau atrodamies "devos" mapee ;) :
    $srvr = sql(0);


echo'
<html>
<head>
<title>Content Management System "DEVOS" @ '.$our_site_url.'</title>
<link rel="stylesheet" type="text/css" href="style.css">
<meta http-equiv="Content-Type" content="text/html; charset='.$web_charset.'">
<script language="JavaScript" src="js/hiddennav.php"></script>
<script language="JavaScript" src="js/showhelp.js"></script>
<script language="JavaScript" src="js/popup_conf.js"></script>
</head>
<body>
<table cellspacing=2 cellpadding=5 style="border: 2px solid #95CAFB;" width="835">
     <tr valign="top">
           <td width="200" style="border-right: 1px solid #95CAFB;" class="col1">';
                	include($data.$inc.'cms_menu'.$ext);
           echo'</td>
           <td width="570" class="col1" style="padding-left:20px; padding-right:15px;">';
           		include($data.$inc.'core'.$ext);
           echo'</td>
     </tr>
     <tr>
     	   <td colspan=2 style="border-top: 1px solid #95CAFB;" class="col2" align="right">';
                include($data.$inc.'cms_footer'.$ext);
           echo'</td>
     </tr>
</table>
</body>
</html>
';

// sakaam "chau!" muskulim :) :
mysql_close($srvr);

}


?>