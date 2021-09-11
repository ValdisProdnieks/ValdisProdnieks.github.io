<?php

echo'
<font style="font-size:10px;">
<img src="img/des/ozmax_dev_logo_footer_rs.jpg" alt="" align="left"> CMS "DEVOS" | '.$lng_pack['cms_special_items']['cms_version'].': '.$cms_version.' | '.$lng_pack['cms_special_items']['cms_build_date'].': '.$cms_build_date.' | 2005-'.date('Y').'
&copy; "<a href="http://www.ozmax.lv" target="_blank">Ozmax Development</a>"
<br>
'.$lng_pack['cms_special_items']['cms_all_rights_reserv'].'
<br>
<br>
<img src="'.$img.$des.'calendar.gif" alt="" align="absmiddle"> '.$lng_pack['cms_special_items']['today_date'].' - '.getTHEdate(time()).'
</font>
';

?>