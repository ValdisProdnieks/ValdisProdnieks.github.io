<?php
$m_over_bgcolor = '#f5dbaf';
$m_out_bgcolor  = '#D9EAE7';

echo'
<table cellspacing=1 cellpadding=2 border=0>
 <tr>
   <td><a href="'.$SELF.'" class="cms_menu" '.@locator($cookieID,"logmeout",$expires,"/").'><img src="img/des/end_work.gif" alt="" align="absmiddle">&nbsp;'.$lng_pack['cms_special_items']['logout'].' <font color="#9A99B1">['.$_SESSION['adm_login'].']</font></a></td>
 </tr>
</table>
<br>
<table cellspacing=1 cellpadding=2 border=0>
';

// uzzinaam kaadu internetpaarluuku izmanto juuzeris,
// jo ar IE ir probleemas noteikt HTTP_REFERER izmantojot tikai
// javascript "self.location" funkciju, nevis enkuru (<a>), tapec tads chakars:
if(eregi("Opera",$_SERVER['HTTP_USER_AGENT']) || eregi("Firefox",$_SERVER['HTTP_USER_AGENT'])){
	$user_agent_class = 'opera';
}else{
	$user_agent_class = 'ie';
}



foreach($lng_pack['cms_menu'] as $action => $action_title){

	if(eregi("_control",$action)){

     	echo'
     	<tr>
           <td class="col_mtitle" width="185">'.$lng_pack['cms_menu'][$action].'</td>
     	</tr>
     	';

    }else{

    	if($user_agent_class == 'opera'){

     		echo'
     		<tr>
     	   		<td class="col_mcnt';
           		if($var_1 == 'cms_menu' && $var_2 == $action){echo '_active';}
           		echo'" bgcolor="'.$m_out_bgcolor.'" onmouseover="bgColor=\''.$m_over_bgcolor.'\'" onmouseout="bgColor=\''.$m_out_bgcolor.'\'" ';
                	if($action == 'open_cms_virtual_gl'){
                        echo'onclick="javascript: NewWin(\'vGallery.php\',\'vGallery\',\'620\',\'400\',\'yes\')"';
                    }else{
                    	if($action != 'open_homepage'){
                    		echo @locator($cookieID,'cms_menu/'.$action,$expires,"/");
                        }
                    }
                echo'>';

                if($action == 'open_homepage'){
                echo'<a class="cms_menu" href="../" target="_blank">';
                }

                echo $lng_pack['cms_menu'][$action];

                if($action == 'open_homepage'){
                echo'</a>';
                }

                echo'</td>
     		</tr>
     		';

        }else{

     		echo'
     		<tr>
     	   		<td class="col_mcnt';
           		if($var_1 == 'cms_menu' && $var_2 == $action){echo '_active';}
           		echo'" style="cursor: default;" bgcolor="'.$m_out_bgcolor.'" onmouseover="bgColor=\''.$m_over_bgcolor.'\'" onmouseout="bgColor=\''.$m_out_bgcolor.'\'"><a ';

                if($action == 'open_homepage'){
                	echo'href="../" target="_blank"';
                }else{
                	echo'href="./"';
                }

                echo' class="cms_menu" ';
                	if($action == 'open_cms_virtual_gl'){
                        echo'onclick="javascript: NewWin(\'vGallery.php\',\'vGallery\',\'620\',\'400\',\'yes\')"';
                    }else{
                    	if($action != 'open_homepage'){
                    		echo @locator($cookieID,'cms_menu/'.$action,$expires,"/");
                        }
                    }
                echo'>'.$lng_pack['cms_menu'][$action].'</a></td>
     		</tr>
     		';

        }

    }
}

echo'
</table>
<br>
';

?>