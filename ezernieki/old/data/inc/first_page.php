<?php

$arr = getimagesize($img.$des.'first_page_bg.jpg');
$page_data = mfa(mq('SELECT content FROM pages WHERE catID="'.$catID.'" AND wwwlngID="'.$lngID.'"'));
echo'
<table cellspacing=0 cellpadding=0 border=0 width="100%">
     <tr valign="bottom">
           <td align="right" width="'.$arr[0].'" height="'.$arr[1].'" background="'.$img.$des.'first_page_bg.jpg" style="background-repeat: no-repeat; background-position: top left;">
           <font style="font-size: 18px; font-weight: bold; margin: 40px; color: #ffffff;">'.$page_data['content'].'</font>
           <br><br><br>
           </td>
     </tr>
</table>
';

?>