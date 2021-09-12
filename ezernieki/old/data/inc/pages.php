<?php

$page_data = mfa(mq('SELECT content FROM pages WHERE catID="'.$catID.'" AND wwwlngID="'.$lngID.'"'));
$bg_img = mfa(mq('SELECT img_file FROM page_bgimg WHERE catID="'.$catID.'"'));

$arr = getimagesize($img.'bgimg/'.$bg_img['img_file']);
echo'
<table cellspacing=0 cellpadding=0 border=0 width="100%">
     <tr valign="top">
           <td width="'.$arr[0].'" height="'.$arr[1].'" background="'.$img.'bgimg/'.$bg_img['img_file'].'" style="background-repeat: no-repeat; background-position: top left;">&nbsp;</td>
           <td align="left" style="padding:20px; padding-top:10px;" bgcolor="#FFFEEC">
           <p align="justify">
           '.$page_data['content'].'
           </p>
           </td>
     </tr>
</table>
';

?>