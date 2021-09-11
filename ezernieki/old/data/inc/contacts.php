<?php

$page_data = mfa(mq('SELECT content FROM pages WHERE catID="'.$catID.'" AND wwwlngID="'.$lngID.'"'));
$maps = mfa(mq('SELECT data FROM maps_img'));
$email_settings = mfa(mq('SELECT * FROM email_page_settings'));
$email_row = mfa(mq('SELECT * FROM email_page WHERE wwwlngID="'.$lngID.'"'));

echo'
<table cellspacing=0 cellpadding=0 border=0 width="100%">
     <tr valign="top">
           <td background="'.$img.$des.'map_deco.jpg" style="padding:20px; padding-top:10px; background-repeat:no-repeat; background-position:bottom left;" width="'.$allowed_w.'" height="'.$allowed_h.'">'.$maps['data'].'</td>
           <td align="left" style="padding:20px; padding-top:10px;" bgcolor="#FFFEEC">
           <p align="justify" style="font-size:11px;">
           '.$page_data['content'].'
           </p>';



//////////////////////////////////////////////////// VESTULES SUTISANAS SKRIPTS ///////////////////////
           if($_POST['sub'] == 1 && ($email_settings['show_form'] == 1 || $_SESSION['userID'] != '')){
           	## sakas sutisanas skripts:
            $is_sent = 0;

	function mail_cr($str){
    	$str = str_replace ('"','&quot;',$str);
        $str = str_replace ("'",'&#039;',$str);
        $str = str_replace ('=','&#061;',$str);
        $str = str_replace ('>','&gt;',$str);
        $str = str_replace ('<','&lt;',$str);
		$str = preg_replace("/[\"\'}{\]\[*^%$><\/~`\\|]/", "", $str);
		$str = str_replace ('\\','',$str);
        $str = str_replace ("\n",'<br>',$str);
        $str = str_replace ("\t",' ',$str);
        $str = str_replace ("\a",' ',$str);
        $str = str_replace ("\r",' ',$str);
        $str = str_replace ('    ',' ',$str);
        $str = str_replace ('   ',' ',$str);
        $str = str_replace ('  ',' ',$str);
        $str = trim($str);
		return $str;

	}

// ienaakosho (post) datu kontrole:
if($_POST['content']!= ''){$content = mail_cr(substr($_POST['content'],0,5000));}else{$is_sent = 2;}
if($_POST['email']!= ''){
	$email = strong_replace(substr($_POST['email'],0,80));
    if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
    	$is_sent = 2; // errors (ta nummurs :), kas noradiis, ka epasta adrese nav korekta
        $email = '';
    }
}



if($is_sent != 2){
$to      = $email_settings['send_to_email'];
$subject = $email_settings['msg_subject'];
$message = 'Epasta anketa no '.$our_site_url.':<br>
<br>
'.$content.'<br>
<br>
- - - - - -<br>
Sutitajs: '.$email.'<br>
<br>
';



$message = wordwrap($message,69);

if(trim($email_settings['email_from']) == ''){
	$from = $email;
}else{
	$from = $email_settings['email_from'];
}

$charset = 'windows-1257';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=' . $charset . "\r\n";      // "text/html" vai "text/plain"
$headers .= 'From: ' . $from . "\r\n";
$headers .= 'Reply-To: ' . $from . "\r\n";
$headers .=   'X-Mailer: PHP/' . phpversion();


  if($_SESSION['antispam'] == 0 || $_SESSION['antispam'] == ''){
 	if( @mail($to,$subject,$message,$headers) == true ){
    	$is_sent = 1;
        $_SESSION['antispam'] = 1;
	}
	else{
		$is_sent = 3;
	}
  }else{
	$is_sent = 2;
    $_SESSION['antispam'] = 1;
  }

}
///////////////////////////////////////////////// END /////////////////////////////////////////

           }

           if($email_settings['show_form'] == 1 || $_SESSION['userID'] != ''){
           	echo'
            '.$email_row['before_form_txt'].'
            <table cellspacing=0 cellpadding=3 border="0" style="border-top:1px solid gray; border-bottom:1px solid gray;">
            ';
            if($_POST['sub'] == 1){
             echo'
			  <tr valign="middle">
               <td colspan="2" style="font-weight: bold;">';
               switch($is_sent){
               		case 3: echo'<font color="red">Message has not been sent! Server error.<br>Please try again!'; break;
               		case 2: echo'<font color="red">'.$email_row['email_not_sent']; break;
               		case 1: echo'<font color="green">'.$email_row['email_is_sent']; break;
               }
               echo'</font>
               </td>
             </tr>
             ';
            }
            echo'

            <form action="?catID='.$catID.'&lngID='.$lngID.'" method="post">
            <input type="hidden" name="sub" value="1">
                 <tr>
                       <td><nobr>'.$email_row['em_address_title'].'</nobr></td>
                       <td align="right"><input type="text" name="email" maxlength="50" style="width:120px;"></td>
                 </tr>
                 <tr>
                 	<td colspan="2">'.$email_row['em_content_title'].'<br>
                    <textarea name="content" style="width:'.$email_settings['textarea_width'].'; height:'.$email_settings['textarea_height'].';"></textarea>
                    ';
                    if($email_row['hint'] != ''){
                    	echo'
                        <table cellspacing=0 cellpadding=4 style="border:1px solid #C7E2DE; margin-top:10px; margin-bottom:5px;" bgcolor="#F1F8F7">
                             <tr>
                                   <td><font color="gray" style="font-size:10px;">'.$email_row['hint'].'</font></td>
                             </tr>
                        </table>
                        ';
                    }
                    echo'
                    </td>
                 </tr>
                 <tr>
                 	<td colspan="2" align="'.$email_settings['button_position'].'">
                    	<input type="submit" value="&nbsp;'.$email_row['button_title'].'&nbsp;">
                    </td>
                 </tr>
            </form>
            </table>
            '.$email_row['after_form_txt'].'
            ';
           }

           echo'
           </td>
     </tr>
</table>
';

?>