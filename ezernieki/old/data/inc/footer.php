<?php

echo'
<table cellspacing=0 cellpadding=0 border=0 width="'.$table_w.'">
     <tr>
           <td width="'.($table_w-100).'" class="copyright" style="padding-top:2px;"><a href="'.$our_site_url.'" style="text-decoration:none;" class="copyright">';
           	if(date('Y') == 2006){
            	echo'2006';
            }else{
                echo '2006-'.date('Y');
            }
           echo' &copy; '.$homepage_settings['hp_copyright'].'</a>
           ';

			if($_SESSION['userID']==''){
   				if($catID != 0){
        			echo'
        			<br><a class="copyright" style="text-decoration:none;" href="?catID=0&lngID='.$lngID.'">DEVOS&nbsp;login&nbsp;&raquo;</a>
        			';
   				}
			}

           echo'</td>
           <td  class="copyright" width="100" align="right"><a href="http://www.ozmax.lv/" target="_blank" title="Dizains un izstr&#257;de: &quot;ozmax dev&quot;"><img src="'.$img.$des.'ozmax_dev.gif" alt="&quot;ozmax dev&quot;" vspace="2" width="47" height="16"></a></td>
     </tr>
</table>
';

?>