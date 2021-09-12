<?php


	// ieklaujam konfiguraciju (prefix, suffix u.c.) failu:
	include('devos/data/cfg/config.php');

$forbidden = 0;
if(!eregi($our_site_url,$_SERVER['HTTP_REFERER'])){$forbidden = 1;}
if($forbidden == 1){
echo'
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<HTML><HEAD>
<TITLE>403 Forbidden</TITLE>
</HEAD><BODY>
<H1>Forbidden</H1>
You don\'t have permission to access /
on this server.<P>
<HR>
'.$_SERVER['SERVER_SIGNATURE'].'</BODY></HTML>
';
exit;
}


    // ieklaujam "ozmax made" php funkciju failu:
    include($devos.$data.$cfg.'functions'.$ext);


function dl_file($file){

    // ienaakosho mainiigo kontrole:
	if($_GET['f']!=''){
    	$file = numeric(substr($_GET['f'],0,10));
    }





	$dir='files/mealmenu/';


   //ie4akojam vai fails existee
   if (!is_file($dir.$file.'.file')) { die("<b>Requested file can not be found!</b>"); }

   // sledzamies klat pie MySQL servera, 1 - jo neesam devos mapee:
   $srvr = sql(1);
   $file_row = mfa(mq('SELECT real_filename, file_ext FROM mealmenu_files WHERE fileID="'.$file.'"'));

   //ieguustam galveno infu (izmeeru :) par failu
   $len = filesize($dir.$file.'.file');

   switch($file_row['file_ext']){
     case "doc": $ctype="application/msword"; break;
     case "xls": $ctype="application/vnd.ms-excel"; break;
   }

   //saakaam raxtiit galveni
   header("Pragma: public");
   header("Expires: 0");
   header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
   header("Cache-Control: public");
   header("Content-Description: File Transfer");
   header("Content-Type: $ctype");

   //speekojam lejuplaadi
   $header="Content-Disposition: attachment; filename=".$file_row['real_filename'].".".$file_row['file_ext'].";";
   header($header );
   header("Content-Transfer-Encoding: binary");
   header("Content-Length: ".$len);
   @readfile($dir.$file.'.file');

   mysql_close($srvr);
   exit;
}


dl_file($file);



?>