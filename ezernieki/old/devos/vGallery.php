<?php
##
## "DEVOS" CMS virtual gallery (vGallery.php)
## version: 1.1
## build date: 14.06.2006
## created & copyrighted 2006-2999 (c) Oskars Lasijevskis, "ozmax dev" team
## email: ozmax_dev@inbox.lv, web: http://ozmax.uninet.lv
##

unset($userID);

session_start();

if(session_is_registered('userID')==true){$userID = $_SESSION['userID'];}else{$userID='';}

if($userID > 0){

	// ieklaujam konfiguraciju (prefix, suffix u.c. specvariabli) failu:
	include('data/cfg/config.php');

    // ieklaujam DEVOS'a valodas paku - masiivu:
    	if(!file_exists($data.$lng_dir.$devos_lng.$ext)){
			die('Could not find "'.$devos_lng.'" language module in required location!');
    		exit;
		}
   		else{
			include($data.$lng_dir.$devos_lng.'_vGallery'.$ext);
		}

    // ieklaujam "ozmax made" php funkciju failu:
    	if(!file_exists($data.$cfg.'functions'.$ext)){
			die('Could not find "functions" module in required location!');
    		exit;
		}
   		else{
			include($data.$cfg.'functions'.$ext);
		}

if($_GET['folder'] != ''){$folder = numeric(substr($_GET['folder'],0,2));}else{$folder = 1;}
if($folder == 2){$dir='../img/des/';}
if($folder == 3){$dir='../img/bgimg/';}
if($folder == 1){$dir='../img/custom/';}

echo'
<html>
<head>
<title>DEVOS CMS '.$vGallery_pack['virtual_gallery_title'].'</title>
<meta http-equiv="Content-Type" content="text/html; charset='.$web_charset.'" />
<meta name="author" content="Oskars Lasijevskis ~ http://ozmax.uninet.lv/" />
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body marginwidth=5 marginheight=5 leftmargin=5 topmargin=5 bgcolor="#DDEDEA">
<form name="fname">
<img src="img/des/folder.gif" align="absmiddle">&nbsp;<b>'.substr($dir,3).'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<select name="folder" onchange="javascript: if(this.value!=\'\'){self.location=\'?folder=\'+this.value}else{return false;}">
	<option value="">&nbsp;-&nbsp;'.$vGallery_pack['available_folders'].'&nbsp;-&nbsp;</option>
    <option value="2">'.$vGallery_pack['folder'].' "des"</option>
    <option value="1">'.$vGallery_pack['folder'].' "custom"</option>
    <option value="3">'.$vGallery_pack['folder'].' "bgimg"</option>
</select>
</form>
';
    $error=0;

    // dzeesham atteelu, ja tas tika pieprasiits:
    if($_GET['delimg']!=''){$delimg = cr(substr($_GET['delimg'],0,32));}
      if($folder != 2){
    	if($delimg!=''){
        echo $folder.'|'.$dir.'|'.$delimg.'<br>';
        	if(is_file($dir.$delimg)){
            	unlink($dir.$delimg) or $error=1;
                $debug_msg = $vGallery_pack['img_deleted'];
            }
            else{
            	$debug_msg = $vGallery_pack['requested_img_not_exists'];
            }
            	if($error==1){
                	$debug_msg = $vGallery_pack['can_not_delete_img_error'];
                }
        }
      }

	if($debug_msg!=''){
	echo'
    <table cellspacing=1 cellpadding=0 border=0 width=460>
         <tr>
               <td><font color="#006699"><b><i>'.$debug_msg.'</i></b></font></td>
         </tr>
    </table>
    <br>
    ';
	}

    echo'<table cellspacing=2 cellpadding=7 border=0 bgcolor="#95CAFB" width=100%>';

    // uzraadaam visus atteelus listing formaa (katru savaa rindkopaa):
    if ($dh = opendir($dir)) {
    	$bgcolor='#F0F0F0';
        $is_something=0;
   		while (($file = readdir($dh)) !== false) {
	 		if(is_file($dir.$file)){
            	$is_something=1;
            	@$imgarr=getimagesize($dir.$file);
            	if($bgcolor=='#F9FDFF'){$bgcolor='#F0F0F0'; $subbgcolor='#F9FDFF';}else{$bgcolor='#F9FDFF'; $subbgcolor='#F0F0F0';}
            	echo'
            	<tr>
            		<td bgcolor="'.$bgcolor.'" colspan=2><img src="'.$dir.$file.'" vspace="5"><hr width=100%>
                  	  <table cellspacing=1 cellpadding=4 border=0 bgcolor="'.$bgcolor.'" width=520>
                     	<tr>
            				<td align="center"><img src="img/des/left_align.gif" alt="left"></td>
                			<td width=460><nobr>[img='.substr($dir,3).$file.' align=left vspace=4 hspace=4]</nobr></td>
            			</tr>
            			<tr>
            				<td align="center"><img src="img/des/right_align.gif" alt="right"></td>
                			<td><nobr>[img='.substr($dir,3).$file.' align=right vspace=4 hspace=4]</nobr></td>
            			</tr>
                        <tr>
            				<td align="center"><img src="img/des/free_align.gif" alt="free"></td>
                			<td><nobr>[img='.substr($dir,3).$file.' vspace=4 hspace=4]</nobr></td>
            			</tr>
                        <tr>
            				<td bgcolor="'.$bgcolor.'" colspan=2>
                                <table cellspacing=1 cellpadding=3 border=0 bgcolor="'.$bgcolor.'">
                                     <tr>
                                     	<td bgcolor="#24886B" style="color:#FFFFFF;" align="center">'.$vGallery_pack['img_type'].'</td>
                                        <td bgcolor="#24886B" style="color:#FFFFFF;" align="center">'.$vGallery_pack['img_size'].'</td>
                                        <td bgcolor="#24886B" style="color:#FFFFFF;" align="center">'.$vGallery_pack['img_dimensions'].' ('.$vGallery_pack['img_dim_width'].' X '.$vGallery_pack['img_dim_height'].')</td>
                                        <td bgcolor="#24886B" style="color:#FFFFFF;" align="center" rowspan=2>&nbsp;&nbsp;<input type="button" '; if($folder==2){echo'onclick="javascript: alert(\''.$vGallery_pack['from_folder_des_del_alert'].'\');"';}else{echo'onclick="javascript: if(confirm(\''.$vGallery_pack['confirm_img_del_question'].'\')){self.location=\'?delimg='.trim($file).'&folder='.$folder.'\';}else{return false;}"';} echo' value="&nbsp;'.$vGallery_pack['delete'].'&nbsp;" style="height:16px; width:60px; color:#FFFFFF; background-color:#8CB8CB; border:1px solid #D7D8D8; font-size:12px;">&nbsp;&nbsp;</td>
                                     </tr>
                                     <tr>
                                     	<td align="center" bgcolor="#F2F8F7" style="color:#828D99;">';
                                        switch ($imgarr[2]){
                                        	case 1: echo'<img src="img/des/gif.gif" alt="gif" title="gif">'; break;
                                            case 2: echo'<img src="img/des/jpg.gif" alt="jpg" title="jpg">'; break;
                                            case 3: echo'<img src="img/des/png.gif" alt="png" title="png">'; break;
                                        }
                                        echo'</td>
                                        <td align="center" bgcolor="#F2F8F7" style="color:#828D99;">'.round(filesize($dir.$file)/1024).' KB</td>
                                        <td align="center" bgcolor="#F2F8F7" style="color:#828D99;">'.$imgarr[0].' X '.$imgarr[1].' px</td>
                                     </tr>
                                </table>
                            </td>
            			</tr>
                  	  </table>
                	</td>
            	</tr>
            	';
            $ir = 1;
            }
   		}
    closedir($dh);

	}

    if($is_something==0){
    	echo'<br><center><b>'.$vGallery_pack['no_images_in_folder'].'</b></center><br>';
    }
echo'
</table>';
if($ir == 1){
echo'
<br><br>
<table cellspacing=1 cellpadding=4 style="border:1px solid #24886B" bgcolor="#F9FDFF" width=100%>
     <tr>
           <td bgcolor="#24886B"><font color="#FFFFFF"><b>'.$vGallery_pack['hint_title'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></font></td>
     </tr>
     <tr>
     	   <td>'.$vGallery_pack['the_extreme_hint'].'</td>
     </tr>
</table>';
}
echo'
</body>
</html>
';
}
else{
echo'
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<HTML><HEAD>
<TITLE>403 Forbidden</TITLE>
</HEAD><BODY>
<H1>Forbidden</H1>
You don\'t have permission to access devos/
on this server.<P>
<HR>
'.$_SERVER['SERVER_SIGNATURE'].'</BODY></HTML>
';
}
?>