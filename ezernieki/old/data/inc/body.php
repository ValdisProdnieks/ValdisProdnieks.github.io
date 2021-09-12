<?php

$table_w = 820;

$folderID = numeric(substr($_GET['folderID'],0,5));
$photoID  = numeric(substr($_GET['photoID'],0,5));
$from  = numeric(substr($_GET['from'],0,5));
if($from == ''){$from = 0;}

echo'
<body bgcolor="#D1D3BE">
<center>';
if($_SESSION['userID']!=''){
	echo'<font color="orange"><b>ADMINISTRATION MODE&nbsp;&nbsp;&nbsp;<font color="gray">For you all elements is visible and active. Logout from DEVOS CMS to leave this mode</font></b></font><br>';
}

echo'
<table cellspacing=0 cellpadding=0 border="0" width="'.$table_w.'">
          <tr valign="middle">
                <td align="right"><img src="'.$img.$des.'x.gif" width="1" height="15" alt=""><br>
';
## lng menu
if($no_active_language != 1){
$lng_res = mq('SELECT * FROM www_languages ORDER BY short_name ASC');
echo'
<table cellspacing=0 cellpadding=2 border=0 style="margin-right:0px;">
     <tr>';
     while($lng_row = mfa($lng_res)){
     	if($lng_row['is_active'] == 1 || $_SESSION['userID']!='' ){
          echo'
          <td bgcolor="';
          	if($lngID == $lng_row['wwwlngID']){echo'#FFFFFF';}

          echo'" ><a href="?catID='.$catID.'&lngID='.$lng_row['wwwlngID'];

          	if($folderID != ''){echo'&folderID='.$folderID;}
            if($from != ''){echo'&from='.$from;}
            if($photoID != ''){echo'&photoID='.$photoID;}

          echo'" ';

           if($lngID != $lng_row['wwwlngID']){echo'style="color:#8E7F6A;"';}
          echo' class="lng_menu" title="'.$lng_row['full_name'].'">'.$lng_row['short_name'].'</font></td>
          ';
        }
     }
     echo'
     </tr>
</table>
<img src="'.$img.$des.'x.gif" width="1" height="3" alt=" "><br>
';
}else{
	echo'<font color="#FFFFFF">No languages available to choose! Site administration in progress</font>';
}

echo'</td>
	</tr>
</table>

<table cellspacing=0 cellpadding=0 style="border:1px solid #FFFFFF" width="'.$table_w.'">
          <tr>
                <td>
';





## 1. menu un ari viss lapas saturs
if($no_category != 1 && $no_active_language != 1){

 ## 1.1 menu:
 echo'
 <table cellspacing=0 cellpadding=4 border=0 bgcolor="#FFFCDD" width="'.$table_w.'">
     <tr>';
     // ja esam CMS'aa, ta shitais netiks nemts veeraa :)) t.i. adminis debug noluukos redz visu, arii neaktiivos menu elementus
     $whereCOND = '';
     if($_SESSION['userID'] == ''){$whereCOND = 'WHERE is_active="1"'; }
     $menu_res = mq('SELECT * FROM menu_categorys '.$whereCOND.' ORDER BY position ASC');
     $cmi = mysql_num_rows($menu_res);

     //aprekinam viena td elementa platumu ;)
     $menu_td_w = round($table_w/$cmi);

     while($menu_row = mfa($menu_res)){
      	$menu_data = mfa(mq('SELECT * FROM menu_categorys_values WHERE catID="'.$menu_row['catID'].'" AND wwwlngID="'.$lngID.'"'));
     	echo'
           <td width="'.$menu_td_w.'" align="center" ';
            if($catID == $menu_row['catID']){
            	echo' bgcolor="#E2E9E2" ';
            }else{
            	echo' onmouseover="bgColor=\'#FFFDEC\'" onmouseout="bgColor=\'#FFFCDD\'"
                 background="'.$img.$des.'flax_3.jpg" style="background-repeat:no-repeat; background-position:left top;"
                ';
            }
           echo'><a class="menu" href="?catID='.$menu_row['catID'].'&lngID='.$lngID.'"><nobr>'.$menu_data['menu_item_title'].'</nobr></a></td>
     	';
     }

     echo'
     </tr>
 </table>
 ';



echo'</td>
	</tr>
    <tr>
     <td>
		<table cellspacing=0 cellpadding=0 border=0 width="100%">
     	  <tr valign="top">
           <td align="center" width="100%" bgcolor="#FFFEEC">';



 ## 1.2 lapas saturs:
 $menu_firstpg = mfa(mq('SELECT catID FROM menu_categorys '.$whereCOND.' ORDER BY position ASC LIMIT 0,1'));
 $menu_row = mfa(mq('SELECT * FROM menu_categorys WHERE catID="'.$catID.'"'));

 if($catID == $menu_firstpg['catID']){
 		include ($data.$inc.'first_page'.$ext);
 }else{
   switch($menu_row['type']){

 	case 'page':
    	include ($data.$inc.'pages'.$ext);
    break;

    case 'contacts':
    	include ($data.$inc.'contacts'.$ext);
    break;

    case 'gallery':
    	include ($data.$inc.'gallery'.$ext);
    break;

    case 'whatsnew':
    	include ($data.$inc.'whatsnew'.$ext);
    break;

    case 'mealmenu':
    	include ($data.$inc.'mealmenu'.$ext);
    break;

   }
 }


if($_SESSION['userID']==''){
   // devos autorizacijas logs
   if($catID == 0){
	echo'<br><br><center>';
	include($devos.$data.$inc.'authorize_form'.$ext);
    echo'<br><br></center>';
   }
}



}else{
	echo'<br>We are sorry! No category\'s available. Site administration in progress.<br><br>';
	if($_SESSION['userID']==''){
     // devos autorizacijas logs
     if($catID == 0){
	  echo'<br><br><center>';
	  include($devos.$data.$inc.'authorize_form'.$ext);
      echo'<br><br></center>';
     }
    }
}


echo'   </td>
       </tr>
      </table>
	 </td>
	</tr>
</table>
<table cellspacing=0 cellpadding=0 style="border:0px solid #FFFFFF; margin-top:4px;" width="'.$table_w.'">
          <tr>
                <td>
';

// DEVOS login linku ieliku footerii (footer.php)

include($data.$inc.'footer'.$ext);

echo'
	</td>
   </tr>
</table>';

// DEVOS login linku ieliku footerii (footer.php)

echo'
</center>

</body>
</html>
';

?>