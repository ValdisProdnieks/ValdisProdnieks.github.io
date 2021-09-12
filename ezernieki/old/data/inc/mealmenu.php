<?php

$page_data = mfa(mq('SELECT content FROM pages WHERE catID="'.$catID.'" AND wwwlngID="'.$lngID.'"'));
$bg_img = mfa(mq('SELECT img_file FROM page_bgimg WHERE catID="'.$catID.'"'));

$arr = @getimagesize($img.'bgimg/'.$bg_img['img_file']);
if($arr[0] == ''){$arr[0] = $allowed_w; $arr[1] = $allowed_h;}

echo'
<table cellspacing=0 cellpadding=0 border=0 width="100%">
     <tr valign="top">
           <td width="'.$arr[0].'" height="'.$arr[1].'" background="'.$img.'bgimg/'.$bg_img['img_file'].'" style="background-repeat: no-repeat; background-position: top left;">&nbsp;</td>
           <td align="left" style="padding:20px; padding-top:10px;" bgcolor="#FFFEEC">
           <p align="justify">
           '.$page_data['content'].'




           <table cellspacing=0 cellpadding=3 border=0>
                ';
                $res = mq('SELECT * FROM mealmenu_files WHERE wwwlngID = "'.$lngID.'" ORDER BY link_title ASC');
                while($row = mfa($res)){
                	echo'
                    <tr valign="middle">
                    	<td rowspan="2"><nobr><a href="download.php?f='.$row['fileID'].'" style="text-decoration:none;"><img src="'.$img.$des.$row['file_ext'].'.gif" alt="&nbsp;" align="absmiddle"></a></td>
                    	<td><nobr><a href="download.php?f='.$row['fileID'].'">'.$row['link_title'].'</a>&nbsp;&nbsp;&nbsp;<a href="download.php?f='.$row['fileID'].'"><img src="'.$img.$des.'download.gif" alt="'.$row['real_filename'].'.'.$row['file_ext'].'"></a></nobr></td>
                    </tr>
                    <tr>
                    	<td><nobr><font color="#B8BAC9" style="font-size:9px">'.getTHEdate($row['timestamp']).' // '.round(filesize('files/mealmenu/'.$row['fileID'])/1024).' KB</font></nobr></td>
                    </tr>
                    ';
                }
                echo'
           </table>
           ';



           echo'
           </p>
           </td>
     </tr>
</table>
';

?>