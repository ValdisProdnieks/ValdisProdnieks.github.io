<?php

unset($userID);

session_start();
if($_SESSION['userID'] == '' || $_SESSION['userID'] < 1){
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
}else{

	// ieklaujam konfiguraciju (prefix, suffix u.c. specvariabli) failu:
	include('data/cfg/config.php');


    // ieklaujam DEVOS'a valodas paku - masiivu:
    	if(!file_exists($data.$lng_dir.$devos_lng.$ext)){
			die('Could not find "'.$devos_lng.'" language module in required location!');
    		exit;
		}
   		else{
			include($data.$lng_dir.$devos_lng.'_help'.$ext);
		}

    // ieklaujam "ozmax made" php funkciju failu:
    	if(!file_exists($data.$cfg.'functions'.$ext)){
			die('Could not find "functions" module in required location!');
    		exit;
		}
   		else{
			include($data.$cfg.'functions'.$ext);
		}


		$reason = strong_replace(substr($_GET['reason'],0,20));

        $td_bgc_title = ' bgcolor="#24886B"';
        $td_unicode = 'style="font-size:10px;"';
echo'
<html>
<head>
<title>DEVOS '.$help_pack['help'].' - '.$help_pack[$reason][$reason.'_help_title'].'</title>
<meta http-equiv="Content-Type" content="text/html; charset='.$web_charset.'" />
<meta name="author" content="Oskars Lasijevskis ~ http://ozmax.uninet.lv/" />
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<table cellspacing=1 cellpadding=5 style="border:1px solid #24886B" bgcolor="#F9FDFF" width=100%>
		<tr>
           <td colspan="2" background="'.$img.$des.'hlp_deco.gif" style="color:#FFFFFF; font-weight:bold; background-position:right top; background-repeat:no-repeat;" '.$td_bgc_title.'>'.$help_pack[$reason][$reason.'_help_title'].'</td>
     	</tr>
';

switch($reason){
	case'bbcode':
      echo'
      	<tr>
           <td '.$td_unicode.' class="col2"><nobr>[b] [/b]</nobr></td>
           <td '.$td_unicode.' class="col4"><font color="#2582DE">'.$help_pack[$reason]['bold_text'].' (<b>bold</b>, <b>B</b>)</font>
            <br>
            <br><nobr>'.$help_pack[$reason]['sample'].': "'.$help_pack[$reason]['here_will_be'].' [b]'.$help_pack[$reason]['in_bold'].'[/b] '.$help_pack[$reason]['word'].'"</nobr>
           	<br><nobr>'.$help_pack[$reason]['result'].': "'.$help_pack[$reason]['here_will_be'].' <b>'.$help_pack[$reason]['in_bold'].'</b> '.$help_pack[$reason]['word'].'"</nobr>
           </td>
     	</tr>
        <tr>
           <td '.$td_unicode.' class="col2"><nobr>[i] [/i]</nobr></td>
           <td '.$td_unicode.' class="col4"><font color="#2582DE">'.$help_pack[$reason]['txt_in_italic'].' (<i>italic</i>, <i>I</i>)</font>
            <br>
            <br><nobr>'.$help_pack[$reason]['sample'].': "'.$help_pack[$reason]['here_will_be'].' [i]'.$help_pack[$reason]['in_italic'].'[/i] '.$help_pack[$reason]['word'].'"</nobr>
           	<br><nobr>'.$help_pack[$reason]['result'].': "'.$help_pack[$reason]['here_will_be'].' <i>'.$help_pack[$reason]['in_italic'].'</i> '.$help_pack[$reason]['word'].'"</nobr>
           </td>
     	</tr>
        <tr>
           <td '.$td_unicode.' class="col2"><nobr>[u] [/u]</nobr></td>
           <td '.$td_unicode.' class="col4"><font color="#2582DE">'.$help_pack[$reason]['underlined_txt'].' (<u>underline</u>, <u>U</u>)</font>
            <br>
            <br><nobr>'.$help_pack[$reason]['sample'].': "'.$help_pack[$reason]['here_will_be'].' [u]'.$help_pack[$reason]['underlined'].'[/u] '.$help_pack[$reason]['word'].'"</nobr>
           	<br><nobr>'.$help_pack[$reason]['result'].': "'.$help_pack[$reason]['here_will_be'].' <u>'.$help_pack[$reason]['underlined'].'</u> '.$help_pack[$reason]['word'].'"</nobr>
           </td>
     	</tr>
        <tr>
           <td '.$td_unicode.' class="col2">[*]</td>
           <td '.$td_unicode.' class="col4"><font color="#2582DE">'.ucfirst($help_pack[$reason]['list_element']).' (list)</font>
            <br>
            <br><nobr>'.$help_pack[$reason]['sample'].': "'.$help_pack[$reason]['here_will_be'].' [*]'.$help_pack[$reason]['list_element'].'"</nobr>
           	<br>'.$help_pack[$reason]['result'].': "'.$help_pack[$reason]['here_will_be'].' <li>'.$help_pack[$reason]['list_element'].'"<br>
            <br>
            '.$help_pack[$reason]['after_li_press_enter'].'
           </td>
     	</tr>
        <tr>
           <td '.$td_unicode.' class="col2">[---]</td>
           <td '.$td_unicode.' class="col4"><font color="#2582DE">'.$help_pack[$reason]['horizontal'].' '.$help_pack[$reason]['line'].' (line)</font>
            <br>
            <br><nobr>'.$help_pack[$reason]['sample'].': "'.$help_pack[$reason]['in_txt_will_be'].' [---] '.$help_pack[$reason]['line'].'"</nobr>
           	<br>'.$help_pack[$reason]['result'].': "'.$help_pack[$reason]['in_txt_will_be'].' <hr> '.$help_pack[$reason]['line'].'"<br>
            <br>
            '.$help_pack[$reason]['each_hr_in_new_line'].'
           </td>
     	</tr>
        <tr>
           <td '.$td_unicode.' class="col2"><nobr>[url=] [/url]</nobr></td>
           <td '.$td_unicode.' class="col4"><font color="#2582DE">'.$help_pack[$reason]['hyperlink'].' (hyperlink, anchor, URL)</font>
            <br>
            <br><nobr>'.$help_pack[$reason]['sample'].': "'.$help_pack[$reason]['link_to'].' [url=http://ozmax.uninet.lv target=_blank]ozmax dev[/url]"</nobr>
           	<br><nobr>'.$help_pack[$reason]['result'].': "'.$help_pack[$reason]['link_to'].' <a href=http://ozmax.uninet.lv target=_blank>ozmax dev</a>"</nobr><br>
            <br>
            '.$help_pack[$reason]['about_blank_info'].'
            <br>
            <br>'.$help_pack[$reason]['link_in_our_site_info'].'
           </td>
     	</tr>
        <tr>
           <td '.$td_unicode.' class="col2">[img=]</td>
           <td '.$td_unicode.' class="col4"><font color="#2582DE">'.ucfirst($help_pack[$reason]['image']).' (image, IMG)</font>
            <br>
            <br><nobr>'.$help_pack[$reason]['sample'].': "'.$help_pack[$reason]['here_will_be'].' '.$help_pack[$reason]['image'].' [img=img/des/bilde.jpg]"</nobr>
           	<br><nobr>'.$help_pack[$reason]['result'].': "'.$help_pack[$reason]['here_will_be'].' '.$help_pack[$reason]['image'].' <img src=img/des/bilde.jpg style="margin-top:3px;">"</nobr><br>
            <br>
            '.$help_pack[$reason]['img_supported_types'].'
            <br>
            <br>'.$help_pack[$reason]['img_tag_vGl_hint'].'
           </td>
     	</tr>
        <tr>
           <td '.$td_unicode.' class="col2"><nobr>[font color=] [/font]</nobr></td>
           <td '.$td_unicode.' class="col4"><font color="#2582DE">'.$help_pack[$reason]['font_color'].' (font color)</font>
            <br>
            <br><nobr>'.$help_pack[$reason]['sample'].': "'.$help_pack[$reason]['word'].' '.$help_pack[$reason]['will_be'].' [font color=red]'.$help_pack[$reason]['red'].'[/font]"</nobr>
           	<br><nobr>'.$help_pack[$reason]['result'].': "'.$help_pack[$reason]['word'].' '.$help_pack[$reason]['will_be'].' <font color=red>'.$help_pack[$reason]['red'].'</font>"</nobr><br>
            <br>
            '.$help_pack[$reason]['allowed_color_info'].'
           </td>
     	</tr>
        <tr>
        	<td colspan="2"'.$td_unicode.' class="col2"><img src="'.$img.$des.'warning.gif" align="left" hspace="10">&nbsp;'.$help_pack[$reason]['footer_hint_text'].'</td>
        </tr>
      ';
    break;

}

echo'
</table>

</body>
</html>
';

}

?>