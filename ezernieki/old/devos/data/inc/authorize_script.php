<?php

//
// ielogojamies DEVOS'aa:
//
if(isset($_POST['submit_authorize'])){
	$empty_post = 0;
	if($_POST['login']!=''){$login = strong_replace(substr($_POST['login'],0,20));}else{$empty_post = 1;}
	if($_POST['passw']!=''){$passw = strong_replace(substr($_POST['passw'],0,25));}else{$empty_post = 1;}

	if($empty_post == 0){
	$res = mq("SELECT * FROM adm_user WHERE adm_login = '".$login."'");
	$row = mfa($res);
		if($row['adm_password'] == md5($passw)){
           // registrejam nepieciesamos datus no datubazes -> SESSIJAA:
 		   $_SESSION['adm_login'] = $row['adm_login'];
           $_SESSION['adm_pass'] = $row['adm_password'];
           $_SESSION['userID'] = $row['userID'];
           $_SESSION['full_control'] = $row['full_control'];
           // atzimejamies, ka sodien esam ielogojusies, tas taa - statistikai :) :
           mq('UPDATE adm_user SET ts_accessed="'.time().'" WHERE userID="'.$row['userID'].'"');
           // relookeitojamies uz cms root mapi, ja viss bus ok (HTTP_REFERER satures musu majaslapas http://...
           // lablabla prefixu) - ta redzesim cms'ku:
           header("location: devos/");
           exit;
    	}
    	else{
    		$msg = $lng_pack['authorize_script']['incorrect_p_or_l'];
        }
	}
	else{
		$msg = $lng_pack['authorize_script']['empty_p_or_l'];
    }
}


?>