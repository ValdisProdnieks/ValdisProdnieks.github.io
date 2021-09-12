<?php

include($devos.$data.$lng_dir.$devos_lng.$ext);

echo'
<form action="./?'.$_SERVER['QUERY_STRING'].'" method="post">
<table bgcolor="#F2F8F7" cellspacing=2 cellpadding=5 style="border: 2px solid #95CAFB;">
     <tr valign="top">
           <td colspan=2 bgcolor="#DDEDEA" style="border-bottom: 1px solid #95CAFB"><font color="#24886b" class="devos"><b>'.$lng_pack['authorize_form']['form_title'].'</b></font></td>
     </tr>
	 <tr>
     	   <td class="devos" colspan=2>';
           if($msg != ''){
           		echo '&nbsp;&nbsp;'.debug_msg($msg,'error',1);
           }else{
           		echo '&nbsp;';
           }
           echo'</td>
     </tr>
     <tr valign="middle">
           <td class="devos">&nbsp;&nbsp;<b>'.$lng_pack['authorize_form']['login'].'</b></td>
           <td class="devos">&nbsp;&nbsp;<input type="text" size="20" maxlength="20" name="login" class="devos" />&nbsp;&nbsp;&nbsp;&nbsp;</td>
     </tr>
     <tr valign="middle">
           <td class="devos">&nbsp;&nbsp;<b>'.$lng_pack['authorize_form']['password'].'</b></td>
           <td class="devos">&nbsp;&nbsp;<input type="password" size="20" maxlength="20" name="passw" class="devos" />&nbsp;&nbsp;&nbsp;&nbsp;</td>
     </tr>
	 <tr>
     	   <td class="devos" colspan=2>&nbsp;</td>
     </tr>
     <tr valign="middle">
     	   <input type="hidden" name="submit_authorize" value="1" />
           <td colspan=2 bgcolor="#DDEDEA" style="border-top: 1px solid #95CAFB; background-repeat:no-repeat; background-position:right top;" background="'.$devos.'img/des/ozmax_dev_logo_footer_rs.jpg"><input type="image" src="'.$devos.'img/btn/'.$devos_lng.'/enter.gif" alt="&nbsp;'.$lng_pack['authorize_form']['login_btn'].'&nbsp;>>" style="border:0px;" class="devos"/></td>
     </tr>
</table>
</form>
';


?>