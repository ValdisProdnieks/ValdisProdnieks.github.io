<?php

## DEVOS CMS core file (core.php)
## author: "ozmax dev", lv
## contact info:
##             email: ozmax_dev@inbox.lv
##             web: http://ozmax.uninet.lv/dev/
##                  or
##                  http://www.ozmax.lv/dev/
## last update: 05.07.2006
## (c) 2006-2999 all rights reserved.
## unauthorized use of this product - CMS system (script) is illegal!

$table_bgc = '#ffffff';
$table_w = 500;
$table_cellspa = 1;
$table_cellpad = 5;


if($var_1 == 'welcome' || $var_1 == ''){
 	echo'
    <br><br>
    <center>
    <table cellspacing=0 cellpadding=5 border=0 width="95%">
         <tr>
               <td><font style="font-size:16px; font-weight:bold; color:#A3CDD6">Esiet sveicin&#257;ti maj&#257;slapas mened&#382;menta sist&#275;m&#257; DEVOS</font>
               <br><br><br><br>
               <img src="'.$img.$des.'check_b.gif" alt="V">&nbsp;&nbsp;<i>Dom&#275;ns, kuram DEVOS CMS ir piesaist&#299;ts/re&#291;istr&#275;ts:</i>
               <br><br>
               <a href="'.$our_site_url.'" target="_blank">'.$our_site_url.'</a><br>
               <br>
               <hr width="100%"><br>
               Izstr&#257;d&#257;t&#257;js: Ozmax Development<br>
               Izstr&#257;d&#257;t&#257;ja kontaktinform&#257;cija:<br><br>
               &nbsp;<b>epasts:</b><br>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="mailto:info@ozmax.lv">info@ozmax.lv</a><br>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="mailto:support@ozmax.lv">support@ozmax.lv</a><br><br>
               &nbsp;<b>web:</b><br>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.ozmax.lv" target="_blank">http://www.ozmax.lv</a>

               </td>
         </tr>
    </table>
    </center>
    ';
}


if($var_1 == 'cms_menu'){

	// virsraksts lieliem, zilganpelekiem burtiem :)
    // atainojas pilnigi visas cms sadalas!!!
	echo'
	<font class="core_item_heading">'.$lng_pack[$var_2.$core]['cms_core_title'].'</font>
	<br>';

  switch($var_2){
    // ---------------------------------------------------- //
    // [1] maajaslapas valodu kontrole
    // ---------------------------------------------------- //
    case 'site_languages':

       if($var_3 == 'save_values'){
       		$data_1 = cr(substr($_POST['data_1'],0,60));
            $data_2 = cr(substr($_POST['data_2'],0,15));
            $data_3 = numeric(substr($_POST['data_3'],0,1));

            if($data_1 == '' || $data_2 == ''){
            	$msg = $lng_pack[$var_2.$core]['msg_dont_leave_empty'].'&nbsp;'.$lng_pack['cms_special_items']['changes_not_saved'];
                $msg_type = 'error';
            }
            else{
				mq('UPDATE www_languages SET short_name="'.$data_2.'", full_name="'.$data_1.'", is_active="'.$data_3.'" WHERE wwwlngID="'.$var_4.'"');
                $msg = $lng_pack['cms_special_items']['data_saved'];
                $msg_type = 'ok';
            }

       }
       if($var_3 == 'delete_language'){
       		if($var_4 != ''){
            	$row = mfa(mq('SELECT Count(*) FROM www_languages'));
                if(trim($row[0]) > 1){

                	// parbaudam vai dzeshamaa valoda nav defaultaa:
                    $do_update = 0;
                    $check = mfa(mq('SELECT is_default FROM www_languages WHERE wwwlngID="'.$var_4.'"'));
                    if(trim($check['is_default']) == 1){$do_update = 1;}
                    unset($check);

                	mq('DELETE FROM menu_categorys_values WHERE wwwlngID="'.$var_4.'"');
            		mq('DELETE FROM www_languages WHERE wwwlngID="'.$var_4.'"');
                    mq('DELETE FROM pages WHERE wwwlngID="'.$var_4.'"');
                    mq('DELETE FROM gallery_folder_description WHERE wwwlngID="'.$var_4.'"');
                    mq('DELETE FROM image_description WHERE wwwlngID="'.$var_4.'"');
                    mq('DELETE FROM homepage_settings WHERE wwwlngID="'.$var_4.'"');
                    mq('DELETE FROM email_page WHERE wwwlngID="'.$var_4.'"');


                    $mealfiles = mq('SELECT fileID FROM mealmenu_files WHERE wwwlngID="'.$var_4.'"');
                    while($filerow = mfa($mealfiles)){
                    	unlink('../files/mealmenu/'.$filerow['fileID']);
                    }
                    mq('DELETE FROM mealmenu_files WHERE wwwlngID="'.$var_4.'"');


                    //uzliekam default'u nakamajai pec sava ID valodai, ja nupat dzeestaa bija taada :) :
                    if($do_update == 1){
                    	$check = mfa(mq('SELECT MIN(wwwlngID) FROM www_languages'));
                    	mq('UPDATE www_languages SET is_default="1", is_active="1" WHERE wwwlngID="'.$check[0].'"');
                    	unset($check);
                    }

                	$msg = $lng_pack['cms_special_items']['all_op_success'];
                	$msg_type = 'ok';
                }else{
                    $msg = $lng_pack[$var_2.$core]['one_lng_ remaining'];
                	$msg_type = 'error';
                }
            }else{
                $msg = $lng_pack['cms_special_items']['error'];
                $msg_type = 'error';
            }
       }



       if($var_3 == 'set_default'){
       	$data_1 = numeric(substr($_POST['data_1'],0,3));
        if($data_1 >= 1){
        	$check = mfa(mq('SELECT Count(*) FROM www_languages WHERE wwwlngID="'.$data_1.'"'));
            if($check[0] >= 1){

            	mq('UPDATE www_languages SET is_default="0"');
                mq('UPDATE www_languages SET is_default="1", is_active="1" WHERE wwwlngID="'.$data_1.'"');

                $msg = $lng_pack[$var_2.$core]['def_lng_updated'];
                $msg_type = 'ok';


            }else{
            	$msg = $lng_pack[$var_2.$core]['lng_dont_exists'];
                $msg_type = 'error';
            }

        }else{
        	$msg = $lng_pack[$var_2.$core]['no_lng_is_choosed'];
            $msg_type = 'error';
        }
       }





       if($var_3 == 'add_new_language'){
       		$data_1 = cr(substr($_POST['new_data_1'],0,60));
            $data_2 = cr(substr($_POST['new_data_2'],0,12));
            $data_3 = numeric(substr($_POST['new_data_3'],0,1));

            if($data_1 == '' || $data_2 == ''){
            	$msg = $lng_pack[$var_2.$core]['msg_dont_leave_empty'].'&nbsp;'.$lng_pack[$var_2.$core]['language_not_added'];
                $msg_type = 'error';
            }
            else{
            	$row = mfa(mq('SELECT Count(*) FROM www_languages WHERE short_name="'.$data_2.'"'));
                if($row[0] == 0){
					mq('INSERT INTO www_languages SET short_name="'.$data_2.'", full_name="'.$data_1.'", is_active="'.$data_3.'"');
                	$msg = $lng_pack[$var_2.$core]['language_added'];
                	$msg_type = 'ok';
                }else{
                    $msg = $lng_pack[$var_2.$core]['this_lng_alr_exists'].'&nbsp;'.$lng_pack[$var_2.$core]['language_not_added'];
                	$msg_type = 'error';
                }
            }
       }


       if($msg!=''){
       		echo '<br>'.debug_msg($msg,$msg_type,0).'<br>';
       }
       echo'
       <br>
       <table bgcolor="'.$table_bgc.'" cellspacing='.$table_cellspa.' cellpadding='.$table_cellpad.' border=0 width="'.$table_w.'">
       <form action="'.$SELF.'" method="post">
       <input type="hidden" name="data_3" value="0">
       		<tr>
            	<td colspan="5" class="col_mtitle">'.$lng_pack[$var_2.$core]['site_lang_control'].'</td>
            </tr>
            <tr>
                  <td class="col2" width="20">'.$lng_pack[$var_2.$core]['td_lng_ID'].'</td>
                  <td class="col2">'.$lng_pack[$var_2.$core]['td_lng_long_name'].'</td>
                  <td class="col2" width="100">'.$lng_pack[$var_2.$core]['td_lng_short_name'].'</td>
                  <td class="col2" width="60">'.$lng_pack[$var_2.$core]['td_lng_is_active'].'</td>
                  <td class="col2" width="100" align="center"><b>'.$lng_pack[$var_2.$core]['td_lng_options'].'</b></td>
            </tr>
       ';
       $res = mq('SELECT * FROM www_languages');
       while($row = mfa($res)){
       		echo'
            <tr>
                  <td class="col3" align="center">'.$row['wwwlngID'].'</td>

                  <td class="col4">';
				  if($var_3 == 'edit_values' && $var_4 == $row['wwwlngID']){
                  	echo'<input type="text" name="data_1" value="'.$row['full_name'].'" size="24" maxlength="20">';
                  }else{
                    echo $row['full_name'];
                  }
                  echo'
                  </td>

                  <td class="col3">';
				  if($var_3 == 'edit_values' && $var_4 == $row['wwwlngID']){
                  	echo'<input type="text" name="data_2" value="'.$row['short_name'].'" size="5" maxlength="3">';
                  }else{
                    echo $row['short_name'];
                  }
                  echo'</td>

                  <td class="col4" align="center">';
				  if($var_3 == 'edit_values' && $var_4 == $row['wwwlngID']){
                  	echo'<input type="checkbox" name="data_3" value="1" ';
                    if($row['is_active']==1){
                  		echo'checked';
                    }
                    echo' >';
                  }
                  else{
                  	if($row['is_active']==1){
                  		echo '<font color="green"><b>'.$lng_pack['cms_special_items']['yes'].'</b></font>';
                  	}else{
                        echo '<font color="red"><b>'.$lng_pack['cms_special_items']['no'].'</b></font>';
                    }
                  }
                  echo'</td>

                  <td class="col3">';
                  if($var_3 == 'edit_values' && $var_4 == $row['wwwlngID']){
                  	echo'<input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/save_values/'.$row['wwwlngID'],$expires,"/","","","").' src="img/btn/save.gif" alt="'.$lng_pack[$var_2.$core]['save'].'" title="'.$lng_pack[$var_2.$core]['save'].'">';
                  }else{
                    echo'<a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/edit_values/'.$row['wwwlngID'],$expires,"/").' title="'.$lng_pack[$var_2.$core]['edit'].'"><img src="img/btn/edit.gif" alt="'.$lng_pack[$var_2.$core]['edit'].'"></a>&nbsp;&nbsp;&nbsp;<a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/delete_language/'.$row['wwwlngID'],$expires,"/","","",$lng_pack[$var_2.$core]['confirm_delete_quest']).' title="'.$lng_pack[$var_2.$core]['delete'].'"><img src="img/btn/delete.gif" alt="'.$lng_pack[$var_2.$core]['delete'].'"></a>';
                  }
                  echo'</td>

            </tr>
            ';
       }
       echo'
       </form>
       <form action="'.$SELF.'" method="post">
       <input type="hidden" name="new_data_3" value="0">
       		<tr>
            	  <td class="col3" background="img/des/td_deco1.gif">&nbsp;</td>
                  <td class="col4"><input type="text" name="new_data_1" size="24" maxlength="20"></td>
                  <td class="col3"><input type="text" name="new_data_2" size="5" maxlength="3"></td>
                  <td class="col4" align="center"><input type="checkbox" name="new_data_3" value="1"></td>
                  <td class="col3"><input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/add_new_language',$expires,"/","","","").' src="img/btn/add.gif" alt="'.$lng_pack[$var_2.$core]['add_this_language'].'" title="'.$lng_pack[$var_2.$core]['add_this_language'].'"></td>
            </tr>
       </form>
       </table>
       <br><br>
       <form action="'.$SELF.'" method="post">
       <table cellspacing=0 cellpadding=3 border=0>
       		<tr>
            	<td colspan="2" class="col_mtitle">&nbsp;</td>
            </tr>
            <tr>
                  <td class="col4">'.$lng_pack[$var_2.$core]['default_language'].'</td>
                  <td class="col4">&nbsp;&nbsp;&nbsp;&nbsp;
                  	<select name="data_1">
                    ';
                    $lng_res = mq('SELECT * FROM www_languages ORDER BY short_name ASC');
                    while($lng_row = mfa($lng_res)){
                    	echo'<option value="'.$lng_row['wwwlngID'].'"';
                        	if($lng_row['is_default'] == 1){echo' selected ';}
                        echo'>'.$lng_row['full_name'].' ('.$lng_row['short_name'].')</option>';
                    }
                    echo'
                    </select>&nbsp;&nbsp;&nbsp;&nbsp;
                  </td>
            </tr>
            <tr>
            	<td colspan="2" class="col2"><input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/set_default',$expires,"/","","","").' src="img/btn/save.gif" alt="'.$lng_pack['cms_special_items']['save'].'" title="'.$lng_pack['cms_special_items']['save'].'"></td>
            </tr>
       </table>
       </form>
       ';

    break;




    // ---------------------------------------------------- //
    // [2] maajaslapas menu (izveelnes) kontrole
    // ---------------------------------------------------- //
    case 'menu_management':

    	$lng_res = mq('SELECT * FROM www_languages ORDER BY short_name DESC');
        $lng_count = mysql_num_rows($lng_res);


         // paarvietojam uz aughsu / uz leju menu elementus :) :
		 if($var_3 == 'move_up' || $var_3 == 'move_down'){

                                	// uzzinam izveleta ieraksta position_nr un atceramies to:
                                	$row = mfa(mq('SELECT position FROM menu_categorys WHERE catID="'.$var_4.'"'));
                                    $this_pos_nr = $row['position'];
                                    $other_pos_nr = 0;

                                    // listingojam visus ierakstus, meklejot par vienu poziciju augstako
                                	$res = mq('SELECT catID, position FROM menu_categorys ORDER BY position ASC');
                                    $found = 0;
                                    // uz augshu
                                    if($var_3 == 'move_up'){
                                		while($row = mfa($res)){
                                    		if($row['catID'] == $var_4){

                                            	$found = 1;
                                        		break;
                                                break;
                                        	}
                                    		else{
                                              if($found == 0){
                                    			$other_pos_nr = $row['position'];
                                    			$other_itemID = $row['catID'];
                                              }
                                        	}
                                    	}
                                    }

                                	// uz leju
                                	if($var_3 == 'move_down'){
                                    $while_itemID = '';
                                		while($row = mfa($res)){
                                    		if($while_itemID == $var_4){
                                            	$other_itemID = $row['catID'];
                                            	$other_pos_nr = $row['position'];

                                                $found = 1;
                                        		break;
                                                break;
                                        	}
                                    		else{
                                              if($found == 0){
                                    			$while_itemID = $row['catID'];
                                              }
                                        	}
                                    	}
                                	}

                                    // pirms saglabat parvietosanas datus, parliecinamies, vai tie ir korekti
                                    if($this_pos_nr>0 && $other_pos_nr>0){
                                    	$q='UPDATE menu_categorys SET position="'.$other_pos_nr.'" WHERE catID="'.$var_4.'"';
                                    	mq($q);
                    					$q='UPDATE menu_categorys SET position="'.$this_pos_nr.'" WHERE catID="'.$other_itemID.'"';
                                    	mq($q);

                                        $msg = $lng_pack['cms_special_items']['all_op_success'];
                                        $msg_type = 'ok';
                                    }
                                    else{
                                    	$msg = $lng_pack[$var_2.$core]['error_changing_pos'];
                                        $msg_type = 'error';
                                    }
        }


        // saglabaajam datus, kas attiecas uz konkreeto menu sadalu
        if($var_3 == 'save_value'){
        	$empty_value = $lng_count;
         	while($lng_row = mfa($lng_res)){
            	$temp_var_name = 'data_1_'.$lng_row['wwwlngID'];
         		$$temp_var_name = cr(substr($_POST[$temp_var_name],0,150));
                if(strlen($$temp_var_name) < 1){$empty_value--;}
            }
            $data_2 = numeric(substr($_POST['data_2'],0,1));
            $data_3 = alphab(substr($_POST['data_3'],0,10));
            $data_4 = strong_replace(substr($_POST['data_4'],0,10));

            // ja ir vismaz viens aizpildiits laukums - izpildaamu updeitu,
            // citaadi - pazinojam par visiem tukshajiem laukumiem:
            if($empty_value >= 1){


				//mq('INSERT INTO menu_categorys SET is_active="'.$new_data_2.'", position="'.$new_max_pos_nr.'", added_by_userID="'.$_SESSION['userID'].'"');
                //$just_inserted_catID = mfa(mq('SELECT MAX(catID) FROM menu_categorys WHERE added_by_userID="'.$_SESSION['userID'].'"'));

                $lng_res = mq('SELECT * FROM www_languages ORDER BY short_name ASC');

                // vispirms veicam darbiibas, kas kopiigas visaam valodaam
                if(mysql_num_rows($lng_res) > 0){
                	    ## darbiibas ar tabulu 'page_bgimg'
                          $check = mfa(mq('SELECT Count(*) FROM page_bgimg WHERE catID="'.$var_4.'"'));
                          if($check[0] >= 1){
                        	mq('UPDATE page_bgimg SET img_file="'.$data_4.'" WHERE catID="'.$var_4.'"');
                          }else{
                            mq('INSERT INTO page_bgimg SET img_file="'.$data_4.'", catID="'.$var_4.'"');
                          }

                        ## darbiibas ar tabulu 'menu_categorys'
                        mq('UPDATE menu_categorys SET is_active="'.$data_2.'", type="'.$data_3.'" WHERE catID="'.$var_4.'"');
                }

                while($lng_row = mfa($lng_res)){
                	$temp_var_name = 'data_1_'.$lng_row['wwwlngID'];
                    if(strlen($$temp_var_name) > 0){

                        ## darbiibas ar tabulu 'menu_categorys_values'
                    	$check = mfa(mq('SELECT Count(*) FROM menu_categorys_values WHERE wwwlngID="'.$lng_row['wwwlngID'].'" AND catID="'.$var_4.'"'));
                        if($check[0] >= 1){
                            mq('UPDATE menu_categorys_values SET menu_item_title="'.$$temp_var_name.'" WHERE wwwlngID="'.$lng_row['wwwlngID'].'" AND catID="'.$var_4.'"');
                        }else{
                        	mq('INSERT INTO menu_categorys_values SET catID="'.$var_4.'", menu_item_title="'.$$temp_var_name.'", wwwlngID="'.$lng_row['wwwlngID'].'"');
                        }
                    }
                }
                $msg = $lng_pack['cms_special_items']['all_op_success'];
                $msg_type = 'ok';


            }else{
            	$msg = $lng_pack[$var_2.$core]['atl_one_value_needed'];
                $msg_type = 'error';
            }
        }


        // dzeesham sadalu un visus datus, kas uz to attiecas:
        if($var_3 == 'delete_menu_item'){
            if($var_4 > 0){
        		mq('DELETE FROM menu_categorys WHERE catID="'.$var_4.'"');
            	mq('DELETE FROM menu_categorys_values WHERE catID="'.$var_4.'"');
                mq('DELETE FROM pages WHERE catID="'.$var_4.'"');
                $msg = $lng_pack['cms_special_items']['all_op_success'];
                $msg_type = 'ok';
            }else{
                $msg = $lng_pack['cms_special_items']['error'];
                $msg_type = 'error';
            }

        }



       	if($msg!=''){
       		echo '<br>'.debug_msg($msg,$msg_type,0).'<br>';
       	}
       	echo'<br>
    	<table bgcolor="'.$table_bgc.'" cellspacing='.$table_cellspa.' cellpadding='.$table_cellpad.' border=0>
        	<tr>
            	<td colspan="8" class="col_mtitle">'.$lng_pack[$var_2.$core]['registred_menu_items'].'</td>
            </tr>
            <tr>
               	<td class="col2">'.$lng_pack[$var_2.$core]['language_name'].'</td>
                <td class="col2" width="170"><nobr>'.$lng_pack[$var_2.$core]['menu_item_txt'].'</nobr></td>
                <td class="col2" width="50">'.$lng_pack[$var_2.$core]['type'].'</td>
                <td class="col2" width="50">'.$lng_pack[$var_2.$core]['bgimg'].'</td>
                <td class="col2" width="40">'.$lng_pack[$var_2.$core]['is_active'].'</td>
                <td class="col2" width="65">'.$lng_pack['cms_special_items']['options'].'</td>
                <td class="col2" width="60">'.$lng_pack[$var_2.$core]['change_pos_nr'].'</td>
         	</tr>
        ';

        $res = mq('SELECT * FROM menu_categorys ORDER BY position ASC');
        $pos_nr = 0;
        $already_rowspaned = 0;
        if($lng_count > 1){
        	$rowspan_data = ' rowspan="'.$lng_count.'"';
        }else{
        	$rowspan_data = '';
        }

        while($row = mfa($res)){
        	$pos_nr++;
        	echo'
            <form action="'.$SELF.'" method="post">
            ';
			$lng_res = mq('SELECT * FROM www_languages ORDER BY short_name ASC');
            while($lng_row = mfa($lng_res)){
              $m_c_values = mfa(mq('SELECT * FROM menu_categorys_values WHERE catID="'.$row['catID'].'" AND wwwlngID="'.$lng_row['wwwlngID'].'"'));
              echo'
              <tr>';
                echo'
                <td class="col3"><a class="cms_menu" href="'.$SELF.'" '.@locator($cookieID,$var_1.'/site_languages',$expires,"/").'>';
                	if($lng_row['is_active'] == 0){
						echo'<font color="#C0C0C0">'.$lng_row['full_name'].'&nbsp;('.$lng_row['short_name'].')</font>';
                    }else{
                        echo $lng_row['full_name'].'&nbsp;('.$lng_row['short_name'].')';
                    }
                echo'</a></td>
                <td class="col4">';
                        if($var_3 == 'edit_value' && $var_4 == $row['catID']){
                        	echo'<input type="text" name="data_1_'.$lng_row['wwwlngID'].'" value="'.$m_c_values['menu_item_title'].'" size="25" maxlength="150">';
                        }else{
                        	if($lng_row['is_active'] == 0){
								echo'<font color="#C0C0C0">'.$m_c_values['menu_item_title'].'</font>';
                    		}else{
                        		echo'<font color="#5A5AB5">'.$m_c_values['menu_item_title'].'</font>';
                    		}
                        }
                echo'
                </td>
				';

              if($already_rowspaned == 0){

              if($pos_nr == 1){
               echo'
               <td class="col4" background="img/des/td_deco1.gif"'.$rowspan_data.'>&nbsp;</td>
               ';
              }else{
               ## lapas tips
                echo'
                <td class="col4" align="center" '.$rowspan_data.'>';
                if($var_3 == 'edit_value' && $var_4 == $row['catID']){
                    echo'<select name="data_3">';
                    foreach($menu_content_type as $type => $title){
                    	echo'<option value="'.$type.'" ';
                        	if($type == $row['type']){echo'selected';}
                        echo'>'.$title.'</option>';
                    }
                    echo'</select>';
                }else{
                	echo $menu_content_type[$row['type']];
                }
              }


              if($pos_nr == 1){
               echo'
               <td class="col4" background="img/des/td_deco1.gif" '.$rowspan_data.'>&nbsp;</td>
               ';
              }else{
               $bgimg_row = mfa(mq('SELECT * FROM page_bgimg WHERE catID="'.$row['catID'].'"'));
               ## lapas bgimg
                echo'</td>
                <td class="col4" align="center" '.$rowspan_data.'>';
                if($var_3 == 'edit_value' && $var_4 == $row['catID']){
                    echo'<select name="data_4">
                    <option value="">&nbsp;</option>';

                    ## ie4akojam kas mums mapee :)
        			$dir = '../img/bgimg/';
        			if ($dh = opendir($dir)){
                        while (($file = readdir($dh)) == true){
                         	if(is_file($dir.$file)){
                                echo'<option value="'.trim($file).'" ';
                        		if(trim($file) == trim($bgimg_row['img_file'])){echo'selected';}
                        		echo'>'.str_replace('.jpg','',$file).'</option>';
                            }
                        }
                    closedir($dh);
               		}

                    echo'</select>';
                }else{
                	if($bgimg_row['img_file'] == ''){
                        echo '-';
                    }else{
                		echo '<a href="../img/bgimg/'.$bgimg_row['img_file'].'" target="_blank">'.$bgimg_row['img_file'].'</a>';
                    }
                }
              }


                echo'
                </td>
                <td class="col3" align="center" '.$rowspan_data.'>';
				  if($var_3 == 'edit_value' && $var_4 == $row['catID']){
                  	echo'<input type="hidden" name="data_2" value="0">
                    <input type="checkbox" name="data_2" value="1" ';
                    if($row['is_active']==1){
                  		echo'checked';
                    }
                    echo' >';
                  }
                  else{
                  	if($row['is_active']==1){
                  		echo '<font color="green"><b>'.$lng_pack['cms_special_items']['yes'].'</b></font>';
                  	}else{
                        echo '<font color="red"><b>'.$lng_pack['cms_special_items']['no'].'</b></font>';
                    }
                  }
                echo'
                </td>
                <td class="col3" '.$rowspan_data.' align="center">
                        ';
                        if($var_3 == 'edit_value' && $var_4 == $row['catID']){
                        	echo'<input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/save_value/'.$row['catID'],$expires,"/","","","").' src="img/btn/save.gif" alt="'.$lng_pack[$var_2.$core]['save'].'" title="'.$lng_pack[$var_2.$core]['save'].'">';
                        }else{
                        	echo'<a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/edit_value/'.$row['catID'],$expires,"/").' title="'.$lng_pack[$var_2.$core]['edit'].'"><img src="img/btn/edit.gif"  width="26" height="20" alt="'.$lng_pack[$var_2.$core]['edit'].'"></a>&nbsp;&nbsp;<a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/delete_menu_item/'.$row['catID'],$expires,"/","","",$lng_pack[$var_2.$core]['confirm_delete_quest']).' title="'.$lng_pack['cms_special_items']['delete'].'"><img src="img/btn/delete.gif"  width="26" height="20" alt="'.$lng_pack['cms_special_items']['delete'].'"></a>';
                        }
                        echo'
                </td>';

                $min_pos_nr = mfa(mq('SELECT MIN(position) FROM menu_categorys'));
                $max_pos_nr = mfa(mq('SELECT MAX(position) FROM menu_categorys'));

                echo'
                <td class="col3" align="center" '.$rowspan_data.'>';
                if($row['position']<$max_pos_nr[0]){
                	echo'<a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/move_down/'.$row['catID'],$expires,"/").'><img src="img/btn/down_arrow.gif" width="23" height="20" alt="'.$lng_pack[$var_2.$core]['move_down'].'" title="'.$lng_pack[$var_2.$core]['move_down'].'"></a>&nbsp;';
                }
                if($row['position']>$min_pos_nr[0]){
                	echo'<a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/move_up/'.$row['catID'],$expires,"/").'><img src="img/btn/up_arrow.gif"  width="23" height="20" alt="'.$lng_pack[$var_2.$core]['move_up'].'" title="'.$lng_pack[$var_2.$core]['move_up'].'"></a>';
                }
                echo'</td>';
              }
            echo'</tr>';
            if($already_rowspaned == 0){$already_rowspaned = 1;}
        }
        	echo'
            </form>
            ';
        $already_rowspaned = 0;
        }

        if($pos_nr == 0){
        	echo'
            <td colspan="8" class="col3" align="center"><br><i>'.$lng_pack['cms_special_items']['no_data_registred'].'</i><br><br></td>
            ';
        }


        echo'
        	</table>
            <br><br>
        	<table bgcolor="'.$table_bgc.'" cellspacing='.$table_cellspa.' cellpadding='.$table_cellpad.' border=0 width="374">
            	<tr>
            		<td colspan="2" class="col4"><br><img src="img/des/warning.gif" alt="'.$lng_pack['cms_special_items']['attention'].'" title="'.$lng_pack['cms_special_items']['attention'].'" align="left" style="margin-right:10px;"><font color="gray">'.$lng_pack[$var_2.$core]['1st_item_shows_1st'].'</font></td>
            	</tr>
        	</table>
    	';

    break;




    // ---------------------------------------------------- //
    // [3] maajaslapas izveelne - pievienojam jaunu sadalu
    // ---------------------------------------------------- //
    case 'add_new_category':
    	$lng_res = mq('SELECT * FROM www_languages ORDER BY short_name DESC');
        $lng_count = mysql_num_rows($lng_res);


         // izveidojam jaunu izveelnes sadalu:
         if($var_3 == 'add_menu_item'){
         	$empty_value = $lng_count;
         	while($lng_row = mfa($lng_res)){
            	$temp_var_name = 'new_data_1_'.$lng_row['wwwlngID'];
         		$$temp_var_name = cr(substr($_POST[$temp_var_name],0,150));
                if(strlen($$temp_var_name) < 1){$empty_value--;}
            }
            $new_data_2 = numeric(substr($_POST['new_data_2'],0,1));

            if($empty_value >= 1){

            	// uzzinaam maximaalo poziicijas skaitli, un jaunajam elementam ieliekam par
                // 1 vieniibu lielaaku. Lidz ar to tas automatiski noklust izvelnes "pasas beigas":
            	$max_pos_nr = mfa(mq('SELECT MAX(position) FROM menu_categorys'));
                if($max_pos_nr[0] >= 1){
                  $new_max_pos_nr = $max_pos_nr[0] + 1;
                }else{
                  $new_max_pos_nr = 1;
                }

                mq('INSERT INTO menu_categorys SET is_active="'.$new_data_2.'", position="'.$new_max_pos_nr.'", added_by_userID="'.$_SESSION['userID'].'"');
                $just_inserted_catID = mfa(mq('SELECT MAX(catID) FROM menu_categorys WHERE added_by_userID="'.$_SESSION['userID'].'"'));

                $lng_res = mq('SELECT * FROM www_languages ORDER BY short_name ASC');
                while($lng_row = mfa($lng_res)){
                	$temp_var_name = 'new_data_1_'.$lng_row['wwwlngID'];
                    if(strlen($$temp_var_name) > 0){
                    	mq('INSERT INTO menu_categorys_values SET catID="'.$just_inserted_catID[0].'", menu_item_title="'.$$temp_var_name.'", wwwlngID="'.$lng_row['wwwlngID'].'"');
                    }
                }
                $msg = $lng_pack['cms_special_items']['all_op_success'];
                $msg_type = 'ok';
            }else{
            	$msg = $lng_pack[$var_2.$core]['atl_one_value_needed'];
                $msg_type = 'error';
            }

         }



       	if($msg!=''){
       		echo '<br>'.debug_msg($msg,$msg_type,0).'<br>';
       	}
       	echo'<br>
            <table bgcolor="'.$table_bgc.'" cellspacing='.$table_cellspa.' cellpadding='.$table_cellpad.' border=0>
            <tr>
            	<td colspan="4" class="col_mtitle">'.$lng_pack[$var_2.$core]['new_menu_item'].'</td>
            </tr>
            <tr>
               	<td class="col2" width="150">'.$lng_pack[$var_2.$core]['language_name'].'</td>
                <td class="col2" width="180">'.$lng_pack[$var_2.$core]['menu_item_txt'].'</td>
                <td class="col2" width="70">'.$lng_pack[$var_2.$core]['is_active'].'</td>
                <td class="col2" width="40">'.$lng_pack['cms_special_items']['options'].'</td>
         	</tr>
            <form action="'.$SELF.'" method="post">';
            $already_rowspaned = 0;
            $lng_res = mq('SELECT * FROM www_languages ORDER BY short_name ASC');
            while($lng_row = mfa($lng_res)){
            echo'
            <tr>
                <td class="col3"><a class="cms_menu" href="'.$SELF.'" '.@locator($cookieID,$var_1.'/site_languages',$expires,"/").'>&nbsp;<img src="img/des/publ_';

                        if($lng_row['is_active']==1){echo'yes'; $lng_is_active = ': '.$lng_pack['cms_special_items']['yes'];}
                        else{echo'no'; $lng_is_active = ': '.$lng_pack['cms_special_items']['no'];}

                echo'.gif" align="absmiddle" alt="'.$lng_pack['site_languages_core']['td_lng_is_active'].$lng_is_active.'" title="'.$lng_pack['site_languages_core']['td_lng_is_active'].$lng_is_active.'">&nbsp;&nbsp;'.$lng_row['full_name'].'</a></td>
                <td class="col4"><input type="text" name="new_data_1_'.$lng_row['wwwlngID'].'" size=25></td>';
                if($already_rowspaned != 1){
                	echo'
                	<td align="center" class="col3" ';
                    if($lng_count > 1){echo'rowspan="'.$lng_count.'"';}
                    echo'><input type="hidden" name="new_data_2" value="0"><input type="checkbox" name="new_data_2" value="1"></td>
                	<td align="center" class="col4" ';
                    if($lng_count > 1){echo'rowspan="'.$lng_count.'"'; $already_rowspaned = 1;}
                    echo'><input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/add_menu_item',$expires,"/","","","").' src="img/btn/add.gif" alt="'.$lng_pack[$var_2.$core]['add_menu_item'].'" title="'.$lng_pack[$var_2.$core]['add_menu_item'].'"></td>
                    ';
                }
            echo'
            </tr>';
            }
            echo'
            </form>
    	</table>
        <br><br>
        <table bgcolor="'.$table_bgc.'" cellspacing='.$table_cellspa.' cellpadding='.$table_cellpad.' border=0 width="374">
            <tr>
            	<td colspan="2" class="col4"><br><img src="img/des/warning.gif" alt="'.$lng_pack['cms_special_items']['attention'].'" title="'.$lng_pack['cms_special_items']['attention'].'" align="left" style="margin-right:10px;">
                	<font color="gray">'.$lng_pack[$var_2.$core]['info_about_pages'].'</font>
                </td>
            </tr>
        </table>
       ';

    break;


    // ---------------------------------------------------- //
    // [4] veidojam jaunu administratora akauntu
    // ---------------------------------------------------- //
    case 'add_new_admin':
     if($_SESSION['full_control'] == 0){
     	echo'<br><br><br><br><center><img src="'.$img.$des.'stop.gif" alt=""><br><b><font color="red" style="font-size:14px">'.$lng_pack['cms_special_items']['access_denied'].'</font></b></center>';
     }else{

    	if($var_3 == 'create_account'){

       		$data_1 = $_POST['data_1'];
            $data_2 = $_POST['data_2'];
            $data_3 = $_POST['data_3'];
            $data_4 = round(numeric(substr($_POST['data_4'],0,1)));


            if(strlen($data_1) < $login_min_ln){
               $msg = $lng_pack[$var_2.$core]['login_too_short'];
               $msg_type = 'error';
            }else{
             if(strlen($data_1) > $login_max_ln){
                $msg = $lng_pack[$var_2.$core]['login_too_long'];
                $msg_type = 'error';
             }else{
              if(eregi("[^a-zA-Z0-9_]", $data_1)){
                 $msg = $lng_pack[$var_2.$core]['login_cnt_illeg_symb'];
                 $msg_type = 'error';
              }else{
              	$row = mfa(mq('SELECT Count(*) FROM adm_user WHERE adm_login="'.$data_1.'"'));
                if($row[0]>=1){
              		$msg = '"'.$data_1.'" - '.$lng_pack[$var_2.$core]['login_already_taken'];
                	$msg_type = 'error';
              	}else{
               		if(strlen($data_2) < $login_min_ln){
               			$msg = $lng_pack[$var_2.$core]['pass_too_short'];
               			$msg_type = 'error';
            		}else{
             			if(strlen($data_2) > $login_max_ln){
                			$msg = $lng_pack[$var_2.$core]['pass_too_long'];
                			$msg_type = 'error';
             			}else{
              				if(eregi("[^a-zA-Z0-9_]", $data_2)){
                 				$msg = $lng_pack[$var_2.$core]['pass_cnt_illeg_symb'];
                 				$msg_type = 'error';
              				}else{
                        		if($data_2 != $data_3){
                              		$msg = $lng_pack[$var_2.$core]['passwords_not_match'];
                 					$msg_type = 'error';
                            	}else{
                                  if($data_4 > 1 || $data_4 < 0){
                                  		$data_4 = 0;
                                  }
                                  mq('INSERT INTO adm_user SET adm_login="'.$data_1.'", adm_password="'.md5($data_2).'",  full_control="'.$data_4.'", ts_created="'.time().'"');
                                  $msg = $lng_pack[$var_2.$core]['admin_account_created'];
                 				  $msg_type = 'ok';
                            	}
              				}
            			}
            		}
              	}
              }
             }
            }
        }


       	if($msg!=''){
       		echo '<br>'.debug_msg($msg,$msg_type,0).'<br>';
       	}
       	echo'<br>
        <table bgcolor="'.$table_bgc.'" cellspacing='.$table_cellspa.' cellpadding='.$table_cellpad.' border=0 width="374">
        <form action="'.$SELF.'" method="post">
        	<tr>
            	<td colspan=2 class="col_mtitle">'.$lng_pack[$var_2.$core]['add_new_admin_title'].'</td>
            </tr>
            <tr>
            	<td>'.$lng_pack[$var_2.$core]['login'].'</td>
                <td><input type="text" name="data_1" size="20" maxlength="20"></td>
            </tr>
            <tr>
            	<td>'.$lng_pack[$var_2.$core]['starting_password'].'</td>
                <td><input type="password" name="data_2" size="20" maxlength="20"></td>
            </tr>
            <tr>
            	<td>'.$lng_pack[$var_2.$core]['password_once_more'].'</td>
                <td><input type="password" name="data_3" size="20" maxlength="20"></td>
            </tr>
            <tr>
            	<td>'.$lng_pack[$var_2.$core]['grant_fl_control_optn'].'</td>
                <td><input type="hidden" name="data_4" value="0">
                <input type="checkbox" name="data_4" value="1"></td>
            </tr>
            <tr>
            	<td></td>
                <td><input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/create_account',$expires,"/","","","").' src="img/btn/'.$devos_lng.'/add_admin.gif" alt="'.$lng_pack[$var_2.$core]['create_account'].'" title="'.$lng_pack[$var_2.$core]['create_account'].'"><br><br></td>
            </tr>
        </form>
        </table>
        <br><br>
        <table bgcolor="'.$table_bgc.'" cellspacing='.$table_cellspa.' cellpadding='.$table_cellpad.' border=0 width="374">
            <tr>
            	<td colspan="2" class="col4"><br><img src="img/des/warning.gif" alt="'.$lng_pack['cms_special_items']['attention'].'" title="'.$lng_pack['cms_special_items']['attention'].'" align="left" style="margin-right:10px;"><font color="gray">'.$lng_pack[$var_2.$core]['allowed_chars_warn'].'</font></td>
            </tr>
        </table>
        ';
     }
    break;


    // ---------------------------------------------------- //
    // [5] MAINAM SAVU PIEEJAS PAROLI
    // ---------------------------------------------------- //
    case 'change_password':


    	if($var_3 == 'change_the_password'){

       		$data_1 = $_POST['data_1'];
            $data_2 = $_POST['data_2'];
            $data_3 = $_POST['data_3'];

           if(md5($data_1) != $_SESSION['adm_pass']){
              $msg = $lng_pack[$var_2.$core]['now_pass_incorrect'];
              $msg_type = 'error';
           }else{

            if(strlen($data_2) < $login_min_ln){
               $msg = $lng_pack[$var_2.$core]['pass_too_short'];
               $msg_type = 'error';
            }else{
             if(strlen($data_2) > $login_max_ln){
                $msg = $lng_pack[$var_2.$core]['pass_too_long'];
                $msg_type = 'error';
             }else{
              if(eregi("[^a-zA-Z0-9_]", $data_2)){
                 $msg = $lng_pack[$var_2.$core]['pass_cnt_illeg_symb'];
                 $msg_type = 'error';
              }else{
                        		if($data_2 != $data_3){
                              		$msg = $lng_pack[$var_2.$core]['passwords_not_match'];
                 					$msg_type = 'error';
                            	}else{
                                  mq('UPDATE adm_user SET adm_password="'.md5($data_2).'" WHERE userID="'.$_SESSION['userID'].'"');
                                  $msg = $lng_pack[$var_2.$core]['password_changed'];
                 				  $msg_type = 'ok';
                            	}
              }
             }
            }
           }
        }


       	if($msg!=''){
       		echo '<br>'.debug_msg($msg,$msg_type,0).'<br>';
       	}
       	echo'<br>
        <table bgcolor="'.$table_bgc.'" cellspacing='.$table_cellspa.' cellpadding='.$table_cellpad.' border=0 width="374">
        <form action="'.$SELF.'" method="post">
        	<tr>
            	<td colspan=2 class="col_mtitle">'.$lng_pack[$var_2.$core]['chg_my_pass_title'].'</td>
            </tr>
            <tr>
            	<td>'.$lng_pack[$var_2.$core]['password_now'].'</td>
                <td><input type="password" name="data_1" size="20" maxlength="20"></td>
            </tr>
            <tr>
            	<td>'.$lng_pack[$var_2.$core]['new_pass'].'</td>
                <td><input type="password" name="data_2" size="20" maxlength="20"></td>
            </tr>
            <tr>
            	<td>'.$lng_pack[$var_2.$core]['new_pass_once_more'].'</td>
                <td><input type="password" name="data_3" size="20" maxlength="20"></td>
            </tr>
            <tr>
            	<td></td>
                <td><input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/change_the_password',$expires,"/","","","").' src="img/btn/'.$devos_lng.'/chg_admin_pass.gif" alt="'.$lng_pack[$var_2.$core]['change_password'].'" title="'.$lng_pack[$var_2.$core]['change_password'].'"><br><br></td>
            </tr>
        </form>
        </table>
        <br><br>
        <table bgcolor="'.$table_bgc.'" cellspacing='.$table_cellspa.' cellpadding='.$table_cellpad.' border=0 width="374">
            <tr>
            	<td colspan="2" class="col4"><br><img src="img/des/warning.gif" alt="'.$lng_pack['cms_special_items']['attention'].'" title="'.$lng_pack['cms_special_items']['attention'].'" align="left" style="margin-right:10px;"><font color="gray">'.$lng_pack[$var_2.$core]['allowed_chars_warn'].'</font></td>
            </tr>
        </table>
        ';
    break;



    // ---------------------------------------------------- //
    // [6] ADMINU AKAUNTU PARAMETRU LABOSANA VAI ARI DZESANA
    // ---------------------------------------------------- //
    case'remove_or_edit_admin':
     if($_SESSION['full_control'] == 0){
     	echo'<br><br><br><br><center><img src="'.$img.$des.'stop.gif" alt=""><br><b><font color="red" style="font-size:14px">'.$lng_pack['cms_special_items']['access_denied'].'</font></b></center>';
     }else{


     	// saglabaajam jaunos akaunta "parametrus"
      if($var_4 == 1){
          $msg = $lng_pack[$var_2.$core]['1st_user_not_editable'];
          $msg_type = 'error';
      }else{
        if($var_3 == 'save_access'){
            if($_SESSION['full_control'] == 0){
            	 $msg = $lng_pack['cms_special_items']['error'].' '.$lng_pack[$var_2.$core]['dont_have_premission'];
                 $msg_type = 'error';
            }else{
        	  if($var_4 == $_SESSION['userID']){
            	 $msg = $lng_pack['cms_special_items']['error'].' '.$lng_pack[$var_2.$core]['cant_edit_yourself'];
                 $msg_type = 'error';
              }else{
            	 $data_1 = round(numeric(substr($_POST['data_1'],0,1)));
                 if($data_1 > 1){$data_1 = 1;}
                 if($data_1 < 0){$data_1 = 0;}
            	 mq('UPDATE adm_user SET full_control="'.$data_1.'" WHERE userID="'.$var_4.'"');
            	 $msg = $lng_pack['cms_special_items']['all_op_success'];
                 $msg_type = 'ok';
              }
            }
        }

        // dzeesham akauntu
        if($var_3 == 'delete_account'){
        	if($_SESSION['full_control'] == 0){
                 $msg = $lng_pack['cms_special_items']['error'].' '.$lng_pack[$var_2.$core]['dont_have_premission'];
                 $msg_type = 'error';
            }else{
                if($var_4 == $_SESSION['userID']){
            	 $msg = $lng_pack['cms_special_items']['error'].' '.$lng_pack[$var_2.$core]['cant_delete_yourself'];
                 $msg_type = 'error';
              	}else{
                	$var_4 = round($var_4);
                	if($var_4 > 0){
                    	mq('DELETE FROM adm_user WHERE userID="'.$var_4.'"');
                        $msg = $lng_pack['cms_special_items']['all_op_success'];
                 		$msg_type = 'ok';
                    }
                }
            }
        }
      }


       	if($msg!=''){
       		echo '<br>'.debug_msg($msg,$msg_type,0).'<br>';
       	}
       	echo'<br>
    	<table cellspacing=1 cellpadding=3 border=0>
        <form action="'.$SELF.'" method="post">
        <input type="hidden" name="data_1" value="0">
         	<tr>
               		<td class="col2" align="center">'.$lng_pack[$var_2.$core]['ID'].'</td>
               		<td class="col2">'.$lng_pack[$var_2.$core]['login'].'</td>
                    <td class="col2">'.$lng_pack[$var_2.$core]['registration_date'].'</td>
                    <td class="col2">'.$lng_pack[$var_2.$core]['access_date'].'</td>
                    <td class="col2">'.$lng_pack[$var_2.$core]['full_control'].'</td>
                    <td class="col2" width="70" align="center">'.$lng_pack['cms_special_items']['options'].'</td>
         	</tr>';
            $res = mq('SELECT * FROM adm_user');
            while($row = mfa($res)){
            	$color = @bg_changer($color);
            	echo'
                <tr>
               		<td bgcolor="'.$color.'" align="center">'.$row['userID'].'</td>
               		<td bgcolor="'.$color.'"><b>'.$row['adm_login'].'</b></td>
                    <td bgcolor="'.$color.'">'.getTHEdate($row['ts_created']).'</td>
                    <td bgcolor="'.$color.'">'.getTHEdate($row['ts_accessed']).'</td>
                    <td bgcolor="'.$color.'" align="center"><font style="font-weight:bold;" color="';
                    if($row['full_control'] == 1){
                    	if($var_3 == 'edit_access' && $var_4 == $row['userID']){
                            echo'"><input type="checkbox" name="data_1" value="1" checked onchange="javascript: if(this.checked == true){  if(confirm(\''.$lng_pack[$var_2.$core]['js_confirm_access_chg'].'\')){this.checked = true}else{this.checked = false}  }">';
                        }else{
                    		echo 'red">'.$lng_pack['cms_special_items']['yes'];
                        }
                    }else{
                        if($var_3 == 'edit_access' && $var_4 == $row['userID']){
                            echo'"><input type="checkbox" name="data_1" value="1" onchange="javascript: if(this.checked == true){  if(confirm(\''.$lng_pack[$var_2.$core]['js_confirm_access_chg'].'\')){this.checked = true}else{this.checked = false}  }">';
                        }else{
                        	echo 'green">'.$lng_pack['cms_special_items']['no'];
                        }
                    }
                    echo'</font></td>
                    <td  align="center" bgcolor="'.$color.'" ';
                    if($row['userID'] == $_SESSION['userID']){
                    	echo'background="'.$img.$des.'td_deco1.gif"';
                    }
                    echo'>';
                     // varam labot/dzest tikai citus loginus, ne savu:
                     if($row['userID'] != $_SESSION['userID']){
                        if($var_3 == 'edit_access' && $var_4 == $row['userID']){
                        	echo'<input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/save_access/'.$row['userID'],$expires,"/","","","").' src="img/btn/save.gif" alt="'.$lng_pack['cms_special_items']['save'].'" title="'.$lng_pack['cms_special_items']['save'].'">';
                        }else{
                        	echo'<a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/edit_access/'.$row['userID'],$expires,"/").' title="'.$lng_pack['cms_special_items']['edit'].'"><img src="img/btn/edit.gif"  width="26" height="20" alt="'.$lng_pack['cms_special_items']['edit'].'"></a>&nbsp;&nbsp;
                            <a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/delete_account/'.$row['userID'],$expires,"/","","",$lng_pack[$var_2.$core]['confirm_delete_quest']).' title="'.$lng_pack['cms_special_items']['delete'].'"><img src="img/btn/delete.gif"  width="26" height="20" alt="'.$lng_pack['cms_special_items']['delete'].'"></a>';
                        }
                     }
                        echo'</td>
         		</tr>
                ';
            }

        echo'
        </form>
    	</table>
    	';
     }
    break;

    // ----------------------------------------------------------- //
    // [7] REDAKTOROJAM MAJASLAPAS LAPPUSES DATU LAPAS
    // ----------------------------------------------------------- //
    case'edit_pg_content':
        $lng_res = mq('SELECT * FROM www_languages ORDER BY short_name DESC');
        $lng_count = mysql_num_rows($lng_res);

       	if($msg!=''){
       		echo '<br>'.debug_msg($msg,$msg_type,0).'<br>';
       	}
       	echo'<br>';

    	if($var_3 == ''){
    	echo'
        <table cellspacing=0 cellpadding=0 border=0 width="100%">
             <tr>
                   <td><img src="'.$img.$des.'lpp_virtual_folder.gif">&nbsp;<font style="font-size:13px; font-weight:bold;">'.$lng_pack[$var_2.$core]['page_listing'].'</font></td>
             </tr>
             <tr>
                   <td><hr width="90%" align="left"></td>
             </tr>
        </table>
        <table cellspacing=2 cellpadding=3 border=0>
        	<tr>
            	<td class="col2">'.$lng_pack[$var_2.$core]['pos_nr'].'</td>
                <td class="col2">'.$lng_pack[$var_2.$core]['short_language_name'].'</td>
                <td class="col2">'.$lng_pack[$var_2.$core]['menu_element_title'].'</td>
                <td class="col2">'.$lng_pack[$var_2.$core]['type'].'</td>
                <td class="col2">'.$lng_pack['cms_special_items']['options'].'</td>
            </tr>
        ';
        if($lng_count > 1){
        	$rowspan_data = ' rowspan="'.$lng_count.'"';
        }else{
        	$rowspan_data = '';
        }
        $res = mq('SELECT * FROM menu_categorys ORDER BY position ASC');
        $i = 0;
        	while($row = mfa($res)){
            $color = bg_changer($color);
            $i++;
            $rowspaned = 0;
            	$lng_values = mq('SELECT * FROM www_languages');
                while($lng_row = mfa($lng_values)){
                	$menu_title = mfa(mq('SELECT * FROM menu_categorys_values WHERE wwwlngID="'.$lng_row['wwwlngID'].'" AND catID="'.$row['catID'].'"'));
            		echo'
                     <tr>
                    ';

                    if($rowspaned == 0){
                       echo'
                           <td '.$rowspan_data.' bgcolor="'.$color.'"><font color="gray">'.$i.'</font></td>
                       ';
                    $rowspaned = 1;
                    }

                    echo'
                           <td bgcolor="'.$color.'"><a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/site_languages',$expires,"/").'>'.$lng_row['short_name'].'</a></td>
                     	   <td bgcolor="'.$color.'"><a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/menu_management',$expires,"/").'>'.$menu_title['menu_item_title'].'</a></td>
                           <td bgcolor="'.$color.'"><font color="gray">'.$menu_content_type[$row['type']].'</font></td>
                           <td bgcolor="'.$color.'">';
                           if($row['type'] == 'page' || $row['type'] == 'contacts' || $row['type'] == 'whatsnew' || $row['type'] == 'mealmenu'){
                           	echo'
                           		<a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$row['catID'].'/'.$lng_row['wwwlngID'].'/'.$row['type'],$expires,"/").' title="'.$lng_pack[$var_2.$core]['edit_page'].'"><img src="img/btn/edit.gif"  width="26" height="20" alt="'.$lng_pack[$var_2.$core]['edit_page'].'"></a>
                           	';
                           }
                           echo'</td>
                     </tr>
                	';
            	}
            }
            if($i == 0){
            	echo'
                	<tr>
                    	<td colspan="4" class="col3" align="center"><br><i>'.$lng_pack['cms_special_items']['no_data_registred'].'</i><br><br></td>
                    </tr>
                ';
            }
        echo'</table>';
        // ja var_3 nav tukshs:
        }else{


          // ja lapas saturs ir lapa, kontakti vai edienkarte
          if($var_5 == 'page' || $var_5 == 'contacts' || $var_5 == 'mealmenu'){
          ###############################
          $dir = '../files/mealmenu/';  #
          ###############################

        	if($var_6 == 'save_page'){
            	$data_1 = textareaTOdata(substr($_POST['data_1'],0,50000));

                $alr_exist = mfa(mq('SELECT Count(*) FROM pages WHERE catID="'.$var_3.'" AND wwwlngID="'.$var_4.'"'));

                if($alr_exist[0] == 1){
                    mq('UPDATE pages SET content="'.$data_1.'", by_userID="'.$_SESSION['userID'].'", edited="'.time().'" WHERE catID="'.$var_3.'" AND wwwlngID="'.$var_4.'"');
                }else{
                    mq('INSERT INTO pages SET content="'.$data_1.'", by_userID="'.$_SESSION['userID'].'", edited="'.time().'", catID="'.$var_3.'", wwwlngID="'.$var_4.'"');
                }

                $msg = $lng_pack['cms_special_items']['all_op_success'];
                $msg_type = 'ok';

            }



            if($var_6 == 'upload_file' && $var_5 == 'mealmenu'){
                $postarr = $HTTP_POST_FILES['newfile'];
        		$file = $postarr['tmp_name'];
                $original_filename = $postarr['name'];

                if( $file != ''){



                     $getEXT = substr($postarr['name'],-3,3);
                     if($getEXT == 'doc' || $getEXT == 'DOC' || $getEXT == 'xls' || $getEXT == 'XLS'){

                         $data_1_0 = textareaTOdata(substr($_POST['data_1_0'],0,255));
                         $data_2_0 = strong_replace(substr($_POST['data_2_0'],0,255));

                         if($data_1_0 != '' && $data_2_0 != ''){

                            	mq('INSERT INTO mealmenu_files SET wwwlngID="'.$var_4.'", link_title="'.$data_1_0.'", real_filename="'.$data_2_0.'", timestamp="'.time().'", file_ext="'.$getEXT.'"');
                                $lid = mfa(mq('SELECT MAX(fileID) FROM mealmenu_files'));

                            copy($file,$dir.$lid[0].'.file') or $copyerror = 1;
                            if($copyerror != 1){
                                 $msg = $lng_pack[$var_2.$core]['new_file_added'];
                    			 $msg_type = 'ok';
                            }else{
                            	 mq('DELETE FROM mealmenu_files WHERE fileID="'.$lid[0].'"');
                                 $msg = $lng_pack[$var_2.$core]['file_copy_error'];
                    			 $msg_type = 'error';
                            }

                         }else{
                            $msg = $lng_pack[$var_2.$core]['empty_two_txt_fields'];
                    		$msg_type = 'error';
                         }





                     }else{
                        $msg = $lng_pack[$var_2.$core]['only_doc_or_xls_allow'];
                    	$msg_type = 'error';
                     }

                }else{
                	$msg = $lng_pack[$var_2.$core]['no_file_uploaded'];
                    $msg_type = 'error';
                }

            }



            if(($var_6 == 'save_filedata' && $var_7 > 0) && $var_5 == 'mealmenu'){
                         $data_1 = textareaTOdata(substr($_POST['data_1'],0,255));
                         $data_2 = strong_replace(substr($_POST['data_2'],0,255));

                         if($data_1 != '' && $data_2 != ''){

                         	mq('UPDATE mealmenu_files SET link_title = "'.$data_1.'", real_filename = "'.$data_2.'" WHERE fileID = "'.$var_7.'"');
                            $msg = $lng_pack['cms_special_items']['data_saved'];
                            $msg_type = 'ok';

                         }
            }



            if(($var_6 == 'readd_upload' && $var_7 > 0) && $var_5 == 'mealmenu'){

                 $postarr = $HTTP_POST_FILES['newfile'];
        		$file = $postarr['tmp_name'];
                $original_filename = $postarr['name'];

                if( $file != ''){



                     $getEXT = substr($postarr['name'],-3,3);
                     if($getEXT == 'doc' || $getEXT == 'DOC' || $getEXT == 'xls' || $getEXT == 'XLS'){

                            copy($file,$dir.$var_7.'.file') or $copyerror = 1;
                            if($copyerror != 1){
                            	 mq('UPDATE mealmenu_files SET file_ext = "'.$getEXT.'", timestamp="'.time().'" WHERE fileID = "'.$var_7.'"');
                                 $msg = $lng_pack[$var_2.$core]['file_update_success'];
                    			 $msg_type = 'ok';
                            }else{
                                 $msg = $lng_pack[$var_2.$core]['file_copy_error'];
                    			 $msg_type = 'error';
                            }

                     }else{
                        $msg = $lng_pack[$var_2.$core]['only_doc_or_xls_allow'];
                    	$msg_type = 'error';
                     }

                }else{
                	$msg = $lng_pack[$var_2.$core]['no_file_uploaded'];
                    $msg_type = 'error';
                }


            }


            if(($var_6 == 'delete_file' && $var_7 > 0) && $var_5 == 'mealmenu'){

            		@unlink($dir.$var_7.'.file');
                    mq('DELETE FROM mealmenu_files WHERE fileID = "'.$var_7.'"');
                    $msg = $lng_pack[$var_2.$core]['file_deleted'];
                    $msg_type = 'ok';

            }



            $menu_title = mfa(mq('SELECT menu_item_title FROM menu_categorys_values WHERE catID="'.$var_3.'" AND wwwlngID="'.$var_4.'"'));
            $row = mfa(mq('SELECT * FROM pages WHERE catID="'.$var_3.'" AND wwwlngID="'.$var_4.'"'));
            $adm_user = mfa(mq('SELECT adm_login FROM adm_user WHERE userID="'.$row['by_userID'].'"'));
            if($msg!=''){
       			echo debug_msg($msg,$msg_type,0).'<br>';
       		}
       		echo'
            <table cellspacing=0 cellpadding=4 border=0 width="100%">
                 <tr>
                 	<td colspan="2"><a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2,$expires,"/","","").' title="'.$lng_pack['cms_special_items']['back'].'">&laquo;&nbsp;'.$lng_pack[$var_2.$core]['back_to_full_listing'].'</a></td>
                 </tr>
                 <tr>
                    <td width="100"><img src="'.$img.$des.'lpp_virtual_folder_edit.gif" align="absmiddle"></td>
                    <td>
                    	<b>'.$menu_title['menu_item_title'].'</b>
                        <br><br>
                        '.$lng_pack[$var_2.$core]['modified'].': '.getTHEdate($row['edited']).'
                        <br>
                        '.$lng_pack[$var_2.$core]['modified_by'].': ';
                        	if($adm_user['adm_login']!=''){
                                echo $adm_user['adm_login'];
                            }else{
                            	echo ' - ';
                            }
                        echo'
                    </td>
                 </tr>
                 <tr>
                    <td colspan="2">
                    	<hr width="100%">
                        ';
                        include('data/inc/js_bbcode_btns.php');
                        echo'
                        <form action="'.$SELF.'" method="post" name="cnt_form">
                            <table cellpadding="2" cellspacing="1">
      							<tr>
                                    <td><input style="font-weight: bold;" type="button" name="bold" value="B " onclick="javascript: BBTag(\'[b]\',\'bold\',\'data_1\',\'cnt_form\')" /></td>
       								<td><input style="font-style: italic;" type="button" name="italic" value="I " onclick="javascript: BBTag(\'[i]\',\'italic\',\'data_1\',\'cnt_form\')" /></td>
       								<td><input style="text-decoration: underline;" type="button" name="underline" value="U " onclick="javascript: BBTag(\'[u]\',\'underline\',\'data_1\',\'cnt_form\')" /></td>
       								<td><input type="button" name="li" value="List " onclick="javascript: BBTag(\'[*]\',\'li\',\'data_1\',\'cnt_form\')" /></td>
                                    <td><input type="button" name="line" value="Line " onclick="javascript: BBTag(\'[---]\',\'line\',\'data_1\',\'cnt_form\')" /></td>
       								<td><input type="button" name="url" value="URL " onclick="javascript: BBTag(\'[url]\',\'url\',\'data_1\',\'cnt_form\')" /></td>
       								<td><input type="button" name="img" value="IMG " onclick="javascript: BBTag(\'[img]\',\'img\',\'data_1\',\'cnt_form\')" /></td>
       								<td>&nbsp;&nbsp;&nbsp;<a href="javascript: ShowHelp(\'bbcode\')"><img src="'.$img.$des.'info.gif" alt="" align="absmiddle">&nbsp;'.$lng_pack[$var_2.$core]['bbcode_help_page'].'</a></td>
      							</tr>
     						</table>
                    </td>
                 </tr>
            </table>
            <br>
            <table cellspacing=0 cellpadding=4 border=0 width="100%">
            	<tr>
                	<td><textarea name="data_1" style="width:540px; height:';
                    if($var_5 == 'mealmenu'){
                        echo'130';
                    }else{
                    	echo'240';
                    }
                    echo'px;">'.dataTOtextarea($row['content']).'</textarea></td>
                </tr>
                <tr>
                	<td><input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/'.$var_4.'/'.$var_5.'/save_page',$expires,"/","","","").' src="img/btn/save.gif" alt="'.$lng_pack[$var_2.$core]['save_content'].'" title="'.$lng_pack[$var_2.$core]['save_content'].'">
                    <hr width="100%">
                    </td>
                </tr>

            </table>

            </form>';

            if($var_5 == 'mealmenu'){
            echo'


            <form action="'.$SELF.'" method="post" enctype="multipart/form-data">
            <table cellspacing=1 cellpadding=4 border=0 width="100%">
                 <tr>
                       <td colspan="6" class="col_mtitle">'.$lng_pack[$var_2.$core]['mealmenu_files'].'</td>
                 </tr>
                 <tr>
                       <td class="col2">'.$lng_pack[$var_2.$core]['link_title'].'</td>
                       <td class="col2">'.$lng_pack[$var_2.$core]['filename'].'</td>
                       <td class="col2">'.$lng_pack[$var_2.$core]['filesize'].'</td>
                       <td class="col2">'.$lng_pack[$var_2.$core]['filetype'].'</td>
                       <td class="col2">'.$lng_pack[$var_2.$core]['modification_date'].'</td>
                       <td class="col2">'.$lng_pack[$var_2.$core]['options'].'</td>
                 </tr>
            ';




            $file_res = mq('SELECT * FROM mealmenu_files WHERE wwwlngID = "'.$var_4.'" ORDER BY fileID ASC');
            $ir = 0;
            while($file_row = mfa($file_res)){
            $color = bg_changer($color);

                // faila infas redigjeeshana
            	if($var_6 == 'edit_file' && $var_7 == $file_row['fileID']){

                echo'
                <tr>
                <td colspan="5">
                <table cellspacing=1 cellpadding=4 border=0 width="100%">
                 <tr>
                       <td class="col3">'.$lng_pack[$var_2.$core]['link_title'].'</td>
                       <td class="col4"><input type="text" value="'.$file_row['link_title'].'" name="data_1" maxlength="255" size="30"></td>
                 </tr>
                 <tr>
                       <td class="col3">'.$lng_pack[$var_2.$core]['filename'].'</td>
                       <td class="col4"><input type="text" value="'.$file_row['real_filename'].'" name="data_2" maxlength="255" size="30"></td>
                 </tr>
            	</table>
                </td>
                <td bgcolor="'.$color.'">
                       <input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/'.$var_4.'/'.$var_5.'/save_filedata/'.$file_row['fileID'],$expires,"/","","","").' src="img/btn/save.gif" alt="'.$lng_pack['cms_special_items']['save'].'" title="'.$lng_pack['cms_special_items']['save'].'">
                </td>
                </tr>
                ';

                }
                // faila nomainja
                elseif($var_6 == 'readd_file' && $var_7 == $file_row['fileID']){

                echo'
                <tr>
                <td colspan="5">
                <table cellspacing=1 cellpadding=4 border=0 width="100%">
                 <tr>
                       <td class="col3">'.$lng_pack[$var_2.$core]['allowed_filetyps'].'</td>
                       <td class="col4"><input type="file" name="newfile" size="25"></td>
                 </tr>
            	</table>
                </td>
                <td bgcolor="'.$color.'">
                       <input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/'.$var_4.'/'.$var_5.'/readd_upload/'.$file_row['fileID'],$expires,"/","","","").' src="img/btn/change.gif" alt="'.$lng_pack[$var_2.$core]['change_to_new_one'].'" title="'.$lng_pack[$var_2.$core]['change_to_new_one'].'">
                </td>
                </tr>
                ';

                // paradam visu infu par failu parastajaa skataa :))
                }else{

                echo'
                 <tr>
                       <td bgcolor="'.$color.'">'.$file_row['link_title'].'</td>
                       <td bgcolor="'.$color.'"><a href="../download.php?f='.$file_row['fileID'].'">'.$file_row['real_filename'].'.'.$file_row['file_ext'].'</a></td>
                       <td bgcolor="'.$color.'">'.round(filesize('../files/mealmenu/'.$file_row['fileID'].'.file')/1024).' KB</td>
                       <td bgcolor="'.$color.'"><a href="../download.php?f='.$file_row['fileID'].'">';
                       switch($file_row['file_ext']){
                       	case 'doc': echo'<img src="'.$img.$des.'word.gif" alt="doc">'; break;
                        case 'xls': echo'<img src="'.$img.$des.'excel.gif" alt="xls">'; break;
                       }
                       echo'</a></td>
                       <td bgcolor="'.$color.'">'.getTHEdate($file_row['timestamp']).'</td>
                       <td bgcolor="'.$color.'"><nobr>
                       <a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/'.$var_4.'/'.$var_5.'/edit_file/'.$file_row['fileID'],$expires,"/","","").' title="'.$lng_pack['cms_special_items']['edit'].'"><img src="'.$img.'btn/edit.gif" alt="'.$lng_pack['cms_special_items']['edit'].'"></a>

                       <a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/'.$var_4.'/'.$var_5.'/readd_file/'.$file_row['fileID'],$expires,"/","","").' title="'.$lng_pack[$var_2.$core]['readd_file'].'"><img src="'.$img.'btn/change.gif" alt="'.$lng_pack[$var_2.$core]['readd_file'].'"></a>

                       <a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/'.$var_4.'/'.$var_5.'/delete_file/'.$file_row['fileID'],$expires,"/","","",$lng_pack[$var_2.$core]['confirm_delete']).' title="'.$lng_pack['cms_special_items']['delete'].'"><img src="'.$img.'btn/delete.gif" alt="'.$lng_pack['cms_special_items']['delete'].'"></a>
                       </nobr></td>
                 </tr>
                ';
                }



               $ir = 1;
            }
            if($ir == 0){
            	echo'
                 <tr>
                 	<td colspan="6" class="col3" align="center"><font color="gray"><i>< '.$lng_pack[$var_2.$core]['no_files_registred'].' ></i></font></td>
                 </tr>
                ';
            }
            echo'
            </form>
            </table>
            <br><br>
            <table cellspacing=1 cellpadding=4 border=0 width="70%">
            <form action="'.$SELF.'" method="post" enctype="multipart/form-data">
                 <tr>
                       <td colspan="6" class="col_mtitle">'.$lng_pack[$var_2.$core]['add_new_file'].'</td>
                 </tr>
                 <tr>
                       <td class="col3">'.$lng_pack[$var_2.$core]['allowed_filetyps'].'</td>
                       <td class="col4"><input type="file" name="newfile" size="25"></td>
                 </tr>
                 <tr>
                       <td class="col3">'.$lng_pack[$var_2.$core]['link_title'].'</td>
                       <td class="col4"><input type="text" name="data_1_0" maxlength="255" size="30"></td>
                 </tr>
                 <tr>
                       <td class="col3">'.$lng_pack[$var_2.$core]['filename'].'</td>
                       <td class="col4"><input type="text" name="data_2_0" maxlength="255" size="30"></td>
                 </tr>
                 <tr>
                       <td class="col2" colspan="2"><input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/'.$var_4.'/'.$var_5.'/upload_file',$expires,"/","","","").' src="img/btn/add.gif" alt="'.$lng_pack[$var_2.$core]['upload_file'].'" title="'.$lng_pack[$var_2.$core]['upload_file'].'"></td>
                 </tr>
            </form>
            </table>
            <br><br>
            ';
            }// $var_5 == 'mealmenu' END
          }
          // ja lapas saturs ir lapa, kontakti vai edienkarte END

          // ja lapas saturs ir "jaunumi":
          if($var_5 == 'whatsnew'){



            // labojam vai veidojam jaunu jaunumu
            if(($var_6 == 'edit' && $var_7 > 0) || $var_6 == 'create_new'){

            	// posteejamo datu kontroole:
                if($_POST['save'] == 1 || $_POST['add'] == 1){
                    $data_1 = cr(substr($_POST['data_1'],0,255));
                    $data_2 = textareaTOdata(substr($_POST['data_2'],0,5000));
                    $data_3 = textareaTOdata(substr($_POST['data_3'],0,10));
                }


                 if($_POST['save'] == 1){
                    if($data_1 != '' && $data_2 != '' && $data_3 != ''){
                        $error = 0;
                        mq('UPDATE whatsnew SET title = "'.$data_1.'", content = "'.$data_2.'", date = "'.$data_3.'", wwwlngID = "'.$var_4.'" WHERE whatsnewID = "'.$var_7.'"') or $error = 1;

                        if($error == 1){
                            $msg = $lng_pack[$var_2.$core]['wn_modify_error'];
                            $msg_type = 'error';
                        }else{
                        	$msg = $lng_pack[$var_2.$core]['wn_modification_saved'];
                            $msg_type = 'ok';
                        }
                    }else{
                        $msg = $lng_pack[$var_2.$core]['wn_no_required_data'];
                        $msg_type = 'error';
                    }
                 }

                 if($_POST['add'] == 1){
                 	if($data_1 != '' && $data_2 != '' && $data_3 != ''){
                        $error = 0;
                        mq('INSERT INTO whatsnew SET title = "'.$data_1.'", content = "'.$data_2.'", date = "'.$data_3.'", wwwlngID = "'.$var_4.'"') or $error = 1;

                        if($error == 1){
                            $msg = $lng_pack[$var_2.$core]['wn_new_create_error'];
                            $msg_type = 'error';
                        }else{
                        	$msg = $lng_pack[$var_2.$core]['wn_new_created'];
                            $msg_type = 'ok';
                            $var_6 = '';
                        }

                    }else{
                    	$msg = $lng_pack[$var_2.$core]['wn_no_required_data'];
                        $msg_type = 'error';
                    }
                 }

              if($var_6 != ''){

                if($msg!=''){
       				echo debug_msg($msg,$msg_type,0).'<br>';
       			}

                echo'<a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2,$expires,"/").'>&laquo;&nbsp;</a>&nbsp;<a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/'.$var_4.'/'.$var_5,$expires,"/").'>&laquo;&nbsp;'.$lng_pack['cms_special_items']['back'].'</a><br><br>';

                 $lng_row = mfa(mq('SELECT * FROM www_languages WHERE wwwlngID = "'.$var_4.'"'));
                 if($var_6 == 'edit'){
                 	$wn_row = mfa(mq('SELECT * FROM whatsnew WHERE whatsnewID = "'.$var_7.'"'));
                 }
                 else{
                    $wn_row['date'] = date('Y.m.d');
                 }
                echo'
                <table cellspacing=2 cellpadding=4 border=0 width="100%">
                <form action="'.$SELF.'" method="post" name="cnt_form">';
                           if($var_6 == 'create_new'){
                           		echo'<input type="hidden" name="add" value="1">';
                           }else{
                           		echo'<input type="hidden" name="save" value="1">';
                           }
                           echo'
                     <tr>
                           <td  colspan="2" class="col_mtitle">';
                           if($var_6 == 'create_new'){
                           		echo $lng_pack[$var_2.$core]['wn_new_record'];
                           }else{
                           		echo $lng_pack[$var_2.$core]['wn_record_edit'];
                           }
                           echo'&nbsp;&nbsp;|&nbsp;&nbsp;'.$lng_pack[$var_2.$core]['language'].': '.$lng_row['full_name'].' ('.$lng_row['short_name'].')</td>
                     </tr>
                     <tr>
                     	<td width="100" class="col3">'.$lng_pack[$var_2.$core]['title'].':</td>
                        <td class="col4"><input type="text" name="data_1" value="'.dataTOtextarea($wn_row['title']).'" size="58" maxlength="255"></td>
                     </tr>
                     <tr>
                     	<td width="100" class="col3">'.$lng_pack[$var_2.$core]['text'].':</td>
                        <td class="col4">
                        ';
                        include('data/inc/js_bbcode_btns.php');
                        echo'
                            <table cellpadding="2" cellspacing="1">
      							<tr>
                                    <td><input style="font-weight: bold;" type="button" name="bold" value="B " onclick="javascript: BBTag(\'[b]\',\'bold\',\'data_2\',\'cnt_form\')" /></td>
       								<td><input style="font-style: italic;" type="button" name="italic" value="I " onclick="javascript: BBTag(\'[i]\',\'italic\',\'data_2\',\'cnt_form\')" /></td>
       								<td><input style="text-decoration: underline;" type="button" name="underline" value="U " onclick="javascript: BBTag(\'[u]\',\'underline\',\'data_2\',\'cnt_form\')" /></td>
       								<td><input type="button" name="li" value="List " onclick="javascript: BBTag(\'[*]\',\'li\',\'data_2\',\'cnt_form\')" /></td>
                                    <td><input type="button" name="line" value="Line " onclick="javascript: BBTag(\'[---]\',\'line\',\'data_2\',\'cnt_form\')" /></td>
       								<td><input type="button" name="url" value="URL " onclick="javascript: BBTag(\'[url]\',\'url\',\'data_2\',\'cnt_form\')" /></td>
       								<td><input type="button" name="img" value="IMG " onclick="javascript: BBTag(\'[img]\',\'img\',\'data_2\',\'cnt_form\')" /></td>
       								<td>&nbsp;&nbsp;&nbsp;<a href="javascript: ShowHelp(\'bbcode\')"><img src="'.$img.$des.'info.gif" alt="" align="absmiddle">&nbsp;'.$lng_pack[$var_2.$core]['bbcode_help_page'].'</a></td>
      							</tr>
     						</table>
                        <br><textarea name="data_2" cols="55" rows="8">'.dataTOtextarea($wn_row['content']).'</textarea></td>
                     </tr>
                     <tr>
                        <td width="100"  class="col3">'.$lng_pack[$var_2.$core]['date'].':</td>
                        <td class="col4"><input type="text" name="data_3" value="'.dataTOtextarea($wn_row['date']).'" size="12" maxlength="10"></td>
                     </tr>
                     <tr>
                     	<td colspan="2" class="col2">';
                         if($var_6 == 'create_new'){
                         	echo'<input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/'.$var_4.'/'.$var_5.'/'.$var_6,$expires,"/","","","").' src="img/btn/add.gif" alt="'.$lng_pack['cms_special_items']['add'].'" title="'.$lng_pack['cms_special_items']['add'].'">';
                         }else{
                            echo'<input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/'.$var_4.'/'.$var_5.'/'.$var_6.'/'.$var_7,$expires,"/","","","").' src="img/btn/save.gif" alt="'.$lng_pack['cms_special_items']['save'].'" title="'.$lng_pack['cms_special_items']['save'].'">';
                         }
                        echo'</td>
                     </tr>
                </form>
                </table>
                ';
              }

            }
            // dzesham jaunuma ieraxtu
            if($var_6 == 'delete' && $var_7 > 0){
            	mq('DELETE FROM whatsnew WHERE whatsnewID = "'.$var_7.'"');
                $msg = $lng_pack[$var_2.$core]['whatnew_deleted'];
                $msg_type = 'ok';
                $var_6 = '';
            }

            if($var_6 == ''){

            if($msg!=''){
       			echo debug_msg($msg,$msg_type,0).'<br><br>';
       		}

                echo'<a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2,$expires,"/").'>&laquo;&nbsp;'.$lng_pack['cms_special_items']['back'].'</a><br><br>';

            	echo'<a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/'.$var_4.'/'.$var_5.'/create_new',$expires,"/").'><img src="'.$img.'btn/add.gif"> '.$lng_pack[$var_2.$core]['add_whatsnew'].'...</a>';

                $lng_row = mfa(mq('SELECT * FROM www_languages WHERE wwwlngID = "'.$var_4.'"'));

                echo'
                <table cellspacing=2 cellpadding=4 border=0 bgcolor="" width="100%">
                     <tr>
                           <td class="col_mtitle" colspan="4">'.$lng_pack[$var_2.$core]['whatnews'].' '.$lng_pack[$var_2.$core]['choosed_language'].': '.$lng_row['full_name'].' ('.$lng_row['short_name'].')</td>
                     </tr>
                     <tr>
                           <td class="col2" width="30">'.$lng_pack[$var_2.$core]['nr'].'</td>
                           <td class="col2">'.$lng_pack[$var_2.$core]['title'].'</td>
                           <td class="col2" width="100">'.$lng_pack[$var_2.$core]['date'].'</td>
                           <td class="col2" width="60">'.$lng_pack['cms_special_items']['options'].'</td>
                     </tr>';
               $res = mq('SELECT title, whatsnewID, date FROM whatsnew WHERE wwwlngID = "'.$var_4.'" ORDER BY whatsnewID DESC');
                $i = 0;
                while($row = mfa($res)){
                $color = bg_changer($color);
                $i++;
                	echo'
                    <tr>
                           <td bgcolor="'.$color.'">'.$i.'</td>
                           <td bgcolor="'.$color.'"><a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/'.$var_4.'/'.$var_5.'/edit/'.$row['whatsnewID'],$expires,"/").' title="'.$lng_pack['cms_special_items']['edit'].'">'.$row['title'].'</a></td>
                           <td bgcolor="'.$color.'"><a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/'.$var_4.'/'.$var_5.'/edit/'.$row['whatsnewID'],$expires,"/").' title="'.$lng_pack['cms_special_items']['edit'].'">'.$row['date'].'</a></td>
                           <td bgcolor="'.$color.'">
                            <a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/'.$var_4.'/'.$var_5.'/edit/'.$row['whatsnewID'],$expires,"/").' title="'.$lng_pack['cms_special_items']['edit'].'"><img src="img/btn/edit.gif"  width="26" height="20" alt="'.$lng_pack['cms_special_items']['edit'].'"></a>&nbsp;&nbsp;
                            <a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/'.$var_4.'/'.$var_5.'/delete/'.$row['whatsnewID'],$expires,"/","","",$lng_pack[$var_2.$core]['wn_delete_confirm']).' title="'.$lng_pack['cms_special_items']['delete'].'"><img src="img/btn/delete.gif"  width="26" height="20" alt="'.$lng_pack['cms_special_items']['delete'].'"></a>
                           </td>
                     </tr>
                    ';
                }

                if($i == 0){
                	echo'
                    	<tr>
                        	<td colspan="4" class="col4" align="center"><i>'.$lng_pack['cms_special_items']['no_data_registred'].'</i></td>
                        </tr>
                    ';
                }

                echo'
                </table>
                ';
            }




          }
          // ja lapas saturs ir "jaunumi" END


        }


    break;



    // ----------------------------------------------------------- //
    // [8] MAJASLAPAS SPECINFA
    // ----------------------------------------------------------- //
    case 'site_settings':

	 if($var_3 == '' || $var_3 < 1){

       echo'
       <br>
       <table cellspacing=0 cellpadding=5 border=0>
       	<tr valign="bottom">
        	<td><img src="'.$img.$des.'homepage_settings.gif">
        	<td>'.$lng_pack[$var_2.$core]['choose_language'].'<br>
			';
            $res = mq('SELECT * FROM www_languages');
            while($row = mfa($res)){
            	echo'
					<br>&nbsp;&nbsp;&nbsp;<a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$row['wwwlngID'],$expires,"/","","").'>'.$row['full_name'].'&nbsp;('.$row['short_name'].')&nbsp;&raquo;</a><br><img src="'.$img.$des.'x.gif" alt="" width="1" height="3">
                ';
			}
            echo'
			</td>
        </tr>
       </table>
       ';


     }else{

      	if($var_4 == 'save'){

        $data_1 = cr(substr($_POST['data_1'],0,255));
        $data_2 = cr(substr($_POST['data_2'],0,10000));
        $data_3 = cr(substr($_POST['data_3'],0,255));
        $data_4 = cr(substr($_POST['data_4'],0,255));

        	$test = mfa(mq('SELECT Count(*) FROM homepage_settings WHERE wwwlngID="'.$var_3.'"'));
            if($test[0] == 1){
                mq('UPDATE homepage_settings SET hp_title="'.$data_1.'", hp_keywords="'.$data_2.'", hp_description="'.$data_3.'", hp_copyright="'.$data_4.'" WHERE wwwlngID="'.$var_3.'"');
                $msg = $lng_pack['cms_special_items']['data_saved'].' '.$lng_pack['cms_special_items']['all_op_success'];
                $msg_type = 'ok';
            }else{
                mq('INSERT INTO homepage_settings SET hp_title="'.$data_1.'", hp_keywords="'.$data_2.'", hp_description="'.$data_3.'", hp_copyright="'.$data_4.'", wwwlngID="'.$var_3.'"');
                $msg = $lng_pack['cms_special_items']['data_saved'].' '.$lng_pack['cms_special_items']['all_op_success'];
                $msg_type = 'ok';
            }
        }


        $row_lng = mfa(mq('SELECT * FROM www_languages WHERE wwwlngID="'.$var_3.'"'));
        $settings = mfa(mq('SELECT * FROM homepage_settings WHERE wwwlngID="'.$var_3.'"'));

       	if($msg!=''){
       		echo '<br>'.debug_msg($msg,$msg_type,0).'<br>';
       	}
       	echo'<br>
            <table cellspacing=0 cellpadding=4 border=0 width="100%">
                 <tr>
                 	<td colspan="2">
                    	<a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2,$expires,"/","","").' title="'.$lng_pack['cms_special_items']['back'].'">&laquo;&nbsp;'.$lng_pack[$var_2.$core]['back_to_lng_choose'].'</a>
                    </td>
                 </tr>
            </table>
            <br>
            <table cellspacing=2 cellpadding=4 border=0 width="100%">
            <form action="'.$SELF.'" method="post">
            	 <tr>
                 	  <td colspan="2" class="col_mtitle">
                      	'.$lng_pack[$var_2.$core]['choosed_language'].': '.$row_lng['full_name'].'&nbsp;('.$row_lng['short_name'].')
                      </td>
                 </tr>
                 <tr>
                       <td class="col3">
                        <b>'.$lng_pack[$var_2.$core]['hpage_title'].'</b>
                       	<br><br><font class="info_about">'.$lng_pack[$var_2.$core]['hpage_title_about'].'</font>
                       </td>
                       <td class="col4">
                       	<textarea name="data_1" cols="32" rows="5">'.$settings['hp_title'].'</textarea>
                       </td>
                 </tr>
                 <tr>
                       <td class="col3">
                        <b>'.$lng_pack[$var_2.$core]['hpage_keywords'].'</b>
                       	<br><br><font class="info_about">'.$lng_pack[$var_2.$core]['hpage_keywords_about'].'</font>
                       </td>
                       <td class="col4">
                       	<textarea name="data_2" cols="32" rows="5">'.$settings['hp_keywords'].'</textarea>
                       </td>
                 </tr>
                 <tr>
                       <td class="col3">
                        <b>'.$lng_pack[$var_2.$core]['hpage_description'].'</b>
                       	<br><br><font class="info_about">'.$lng_pack[$var_2.$core]['hpage_description_abt'].'</font>
                       </td>
                       <td class="col4">
                       	<textarea name="data_3" cols="32" rows="5">'.$settings['hp_description'].'</textarea>
                       </td>
                 </tr>
                 <tr>
                       <td class="col3">
                        <b>'.$lng_pack[$var_2.$core]['hpage_copyR_info'].'</b>
                       	<br><br><font class="info_about">'.$lng_pack[$var_2.$core]['hpage_copyR_info_abt'].'</font>
                       </td>
                       <td class="col4">
                       	<textarea name="data_4" cols="32" rows="5">'.$settings['hp_copyright'].'</textarea>
                       </td>
                 </tr>
                 <tr>
                 		<td colspan="2" class="col2">
                        	<input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/save',$expires,"/","","","").' src="img/btn/save.gif" alt="'.$lng_pack['cms_special_items']['save'].'" title="'.$lng_pack['cms_special_items']['save'].'">
                        </td>
                 </tr>
            </form>
            </table>
            <br><br>
        ';
     }

    break;



    // ----------------------------------------------------------- //
    // [9] GALERIJAS UZSTADIJUMI
    // ----------------------------------------------------------- //
    case'gallery_settings':


        if($var_3 == 'defaults'){
        	mq('DELETE FROM gl_settings');
            mq('INSERT INTO gl_settings SET preview_type="1"');
            $msg = $lng_pack['cms_special_items']['all_op_success'];
            $msg_type = 'ok';
        }

        if($var_3 == 'save'){
        	for($i=1; $i<=8; $i++){
            	$tmp_name = 'data_'.$i;
                $$tmp_name = numeric(substr($_POST[$tmp_name],0,3));
            }

            $all_ok = 1;
           	$q = 'UPDATE gl_settings SET ';
            $q2 = '';
            if($data_1 > 49){
            	$q2 .= ',def_thumb_height="'.$data_1.'" ';
            }else{$all_ok = 0;}

            if($data_2 > 49){
            	$q2 .= ',def_thumb_width="'.$data_2.'" ';
            }else{$all_ok = 0;}

            if($data_3 > 99){
            	$q2 .= ',def_full_height="'.$data_3.'" ';
            }else{$all_ok = 0;}

            if($data_4 > 99){
            	$q2 .= ',def_full_width="'.$data_4.'" ';
            }else{$all_ok = 0;}
            /*
            if($data_5 > 0){
            	$q2 .= ',preview_type="'.$data_5.'" ';
            }else{$all_ok = 0;}
            */
            if($data_6 >= 0){
            	$q2 .= ',show_fl_creation_date="'.$data_6.'" ';
            }else{$all_ok = 0;}

            if($data_7 > 0){
            	$q2 .= ',thumbs_vert_per_page="'.$data_7.'" ';
            }else{$all_ok = 0;}

            if($data_8 > 1){
            	$q2 .= ',thumbs_hori_per_page="'.$data_8.'" ';
            }else{$all_ok = 0;}

            $q2 = substr($q2,1);
            $q .= $q2;
            unset($q2);
			mq($q);

            if($all_ok == 1){
            	$msg = $lng_pack['cms_special_items']['data_saved'];
            	$msg_type = 'ok';
            }else{
                $msg = $lng_pack['cms_special_items']['data_saved'].' '.$lng_pack[$var_2.$core]['not_all_data_ok'];
            	$msg_type = 'ok';
            }

        }



       	if($msg!=''){
       		echo '<br>'.debug_msg($msg,$msg_type,0).'<br>';
       	}

        $settings = mfa(mq('SELECT * FROM gl_settings'));

       	echo'<br>
        <img src="'.$img.$des.'gallery_settings.gif">
        <br><br>
        <table cellspacing=2 cellpadding=3 border=0 width="90%">
        <form action="'.$SELF.'" method="post">
             <tr>
                   <td class="col3">'.$lng_pack[$var_2.$core]['thumb_max_height'].'</td>
                   <td class="col4"><input type="text" name="data_1" value="'.$settings['def_thumb_height'].'" maxlength="3" size="5"></td>
             </tr>
             <tr>
                   <td class="col3">'.$lng_pack[$var_2.$core]['thumb_max_width'].'</td>
                   <td class="col4"><input type="text" name="data_2" value="'.$settings['def_thumb_width'].'" maxlength="3" size="5"></td>
             </tr>
             <tr>
                   <td class="col3">'.$lng_pack[$var_2.$core]['full_max_height'].'</td>
                   <td class="col4"><input type="text" name="data_3" value="'.$settings['def_full_height'].'" maxlength="3" size="5"></td>
             </tr>
             <tr>
                   <td class="col3">'.$lng_pack[$var_2.$core]['full_max_width'].'</td>
                   <td class="col4"><input type="text" name="data_4" value="'.$settings['def_full_width'].'" maxlength="3" size="5"></td>
             </tr>';
             /*
             <tr>
                   <td class="col3">'.$lng_pack[$var_2.$core]['folder_preview_type'].'</td>
                   <td class="col4">
                   	<select name="data_5">
                    	<option value="1" '; if($settings['preview_type']==1){echo'selected';} echo'>'.$lng_pack[$var_2.$core]['folder_style_usual'].'</option>
                        <option value="2" '; if($settings['preview_type']==2){echo'selected';} echo'>'.$lng_pack[$var_2.$core]['folder_style_special'].'</option>
                    </select>
                   </td>
             </tr>
             */
             echo'
             <tr>
                   <td class="col3">'.$lng_pack[$var_2.$core]['show_folder_cr_date'].'</td>
                   <td class="col4">
                   	<input type="hidden" name="data_6" value="0">
                   	<input type="checkbox" name="data_6" '; if($settings['show_fl_creation_date']==1){echo'checked';} echo' value="1">
                   </td>
             </tr>
             <tr>
                   <td class="col3">'.$lng_pack[$var_2.$core]['thumb_count_vert'].'</td>
                   <td class="col4">
                    <select name="data_7">';
                     	for($i=1; $i<10; $i++){
                        	echo'<option value="'.$i.'" ';
                            if($settings['thumbs_vert_per_page'] == $i){echo'selected';}
                            echo' >'.$i.'</option>';
                        }
                    echo'
                    </select>
                   </td>
             </tr>
             <tr>
                   <td class="col3">'.$lng_pack[$var_2.$core]['thumb_count_hori'].'</td>
                   <td class="col4">
                   	<select name="data_8">';
                     	for($i=2; $i<6; $i++){
                        	echo'<option value="'.$i.'" ';
                            if($settings['thumbs_hori_per_page'] == $i){echo'selected';}
                            echo' >'.$i.'</option>';
                        }
                    echo'
                    </select>
                   </td>
             </tr>
             <tr valign="top">
             	<td class="col2"><input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/save',$expires,"/","","","").' src="img/btn/save.gif" alt="'.$lng_pack['cms_special_items']['save'].'" title="'.$lng_pack['cms_special_items']['save'].'"></td>
                <td class="col2"><a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/defaults',$expires,"/","","",$lng_pack[$var_2.$core]['restore_default_quest']).'>'.$lng_pack[$var_2.$core]['default_settings'].'</a></td>
             </tr>
        </form>
        </table>
        ';


    break;



    // ----------------------------------------------------------- //
    // [10] JAUNAS GALERIJAS MAPES IZVEIDE
    // ----------------------------------------------------------- //
    case'gallery_add_folder':


     if($var_3 == 'create'){
        $lng_res = mq('SELECT * FROM www_languages');
        $data_empty = 0;
        while($lng_row = mfa($lng_res)){
        	$tmp_name = 'data_'.$lng_row['wwwlngID'];
            $$tmp_name = cr(substr($_POST[$tmp_name],0,255));
            if($$tmp_name == ''){$data_empty = 1;}
        }

        if($data_empty == 1){

        	$msg = $lng_pack['cms_special_items']['error'].' '.$lng_pack[$var_2.$core]['not_all_fields_full'];
            $msg_type = 'error';

        }else{
        	$max_pos_nr = mfa(mq('SELECT MAX(position) FROM gl_folders'));
            $new_max_pos_nr = $max_pos_nr[0] + 1;
            mq('INSERT INTO gl_folders SET position="'.$new_max_pos_nr.'", created="'.time().'"');

            $inserted_glID = mfa(mq('SELECT MAX(gl_folderID) FROM gl_folders'));

            $lng_res = mq('SELECT * FROM www_languages');
            while($lng_row = mfa($lng_res)){
        		$tmp_name = 'data_'.$lng_row['wwwlngID'];
            	mysql_query('INSERT INTO gl_folder_description SET gl_folderID="'.$inserted_glID[0].'", wwwlngID="'.$lng_row['wwwlngID'].'", title="'.$$tmp_name.'"') or die(mysql_error());
        	}

             	$msg = $lng_pack[$var_2.$core]['new_folder_created'];
             	$msg_type = 'ok';

        }

     }

     	if($msg!=''){
       		echo '<br>'.debug_msg($msg,$msg_type,0).'<br>';
       	}
    	echo'
        <br><img src="'.$img.$des.'gl_fld_add.gif"><br><br>
        <table cellspacing=2 cellpadding=4 border=0>
        <form action="'.$SELF.'" method="post">
        	<tr>
            	<td class="col2">'.$lng_pack[$var_2.$core]['language'].'</td>
                <td class="col2">'.$lng_pack[$var_2.$core]['folder_title'].'</td>
            </tr>
        ';

        $lng_res = mq('SELECT * FROM www_languages');
        while($lng_row = mfa($lng_res)){
        $color = bg_changer($color);
        	echo'
             <tr>
                   <td bgcolor="'.$color.'">'.$lng_row['full_name'].'&nbsp;('.$lng_row['short_name'].')</td>
                   <td bgcolor="'.$color.'"><input type="text" name="data_'.$lng_row['wwwlngID'].'" maxlength="255" size="45"></td>
             </tr>
            ';
        }
        echo'
            <tr>
                <td colspan="2" class="col2"><input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/create',$expires,"/","","","").' src="img/btn/add.gif" alt="'.$lng_pack['cms_special_items']['add'].'" title="'.$lng_pack['cms_special_items']['add'].'"></td>
            </tr>
        </form>
        </table>
        ';
    break;



    // ----------------------------------------------------------- //
    // [11] GALERIJAS MAPJU SARAKSTS UN ADMINISTRESANAS IESPEJAS (ahuuuuuunais skripts!!!! :)
    // ----------------------------------------------------------- //
    case'gallery_folders':

     ## dodam iespeeju izveleeties ar kaadu maajaslapas valodu veelas straadaat "mapju redaktoraa"
     if($var_3 == '' || $var_3 < 1){
     	echo'<br><img src="'.$img.$des.'gl_folder_large.gif"><br><br>
        '.$lng_pack[$var_2.$core]['choose_language'].':<br><br>';
        	$lng_res = mq('SELECT * FROM www_languages');
        	while($lng_row = mfa($lng_res)){
            	echo '<a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$lng_row['wwwlngID'],$expires,"/","","").'>'.$lng_row['full_name'].'&nbsp;('.$lng_row['short_name'].')</a><br><img src="'.$img.$des.'x.gif" alt="" width="1" height="4"><br>';
        	}
        echo'';
     }else{



        // pardevejam mapi (skripta dala)
     	if($var_4 == 'dorename' && $var_5 != ''){

          $lng_res = mq('SELECT * FROM www_languages');
          while($lng_row = mfa($lng_res)){
        	$tmp_name = 'data_'.$lng_row['wwwlngID'];
            $$tmp_name = cr(substr($_POST[$tmp_name],0,255));
            $c = mfa(mq('SELECT COUNT(*) FROM gl_folder_description WHERE gl_folderID="'.$var_5.'" AND wwwlngID="'.$lng_row['wwwlngID'].'"'));
            if($c[0] == 0){
                mq('INSERT INTO gl_folder_description SET title="'.$$tmp_name.'", gl_folderID="'.$var_5.'", wwwlngID="'.$lng_row['wwwlngID'].'"');
            }else{
            	mq('UPDATE gl_folder_description SET title="'.$$tmp_name.'" WHERE gl_folderID="'.$var_5.'" AND wwwlngID="'.$lng_row['wwwlngID'].'"');
            }
          }
             	$msg = $lng_pack[$var_2.$core]['folder_ren_success'];
             	$msg_type = 'ok';
        }




        // atteela pievienoshana, skripta dalja BEGIN
        if($var_4 == 'addimg' && $var_5 > 0 && $_POST['data_0'] == 1){

    	$error = 0;
    	$postarr = $HTTP_POST_FILES['file'];
        $file = $postarr['tmp_name'];
        $dir = '../img/gallery/';
        if($file != ''){

        	// mainiigo kontrole:
        	$data_2 = numeric(substr($_POST['data_2'],0,3));
            $data_3 = numeric(substr($_POST['data_3'],0,3));
            $data_4 = numeric(substr($_POST['data_4'],0,3));
            $data_5 = numeric(substr($_POST['data_5'],0,3));

            // uzzinaam datus par uzlaadeeto atteelu:
			$arr = getImageSize($file);

            // ja ir jpg, daraam sekojosho:
			if($arr[2] == 2){
              $this_img_w = $arr[0];
              $this_img_h = $arr[1];

              // aprekinam maza attela dimensijas, izmantojot ievadiito parametru "max augstums":
			  if($data_2 > 49){
              	$ratio = round(($data_2/$this_img_h),5);
                $iw_sm = round($this_img_w*$ratio);
                $ih_sm = round($this_img_h*$ratio);
              }else{
              	$error = 2;
              }

              // aprekinam maza attela dimensijas, izmantojot ievadiito parametru "max platums":
              if($data_3 > 49 && $iw_sm > $data_3){
              	$ratio = round(($data_3/$this_img_w),5);
                $iw_sm = round($this_img_w*$ratio);
                $ih_sm = round($this_img_h*$ratio);
              }

              // aprekinam lielaa attela dimensijas, izmantojot ievadiito parametru "max augstums":
              if($data_4 > 99){
              	$ratio = round(($data_4/$this_img_h),5);
                $iw_bg = round($this_img_w*$ratio);
                $ih_bg = round($this_img_h*$ratio);
              }else{
              	$error = 2;
              }

              // aprekinam lielaa attela dimensijas, izmantojot ievadiito parametru "max platums":
              if($data_5 > 99 && $iw_bg > $data_5){
              	$ratio = round(($data_5/$this_img_w),5);
                $iw_bg = round($this_img_w*$ratio);
                $ih_bg = round($this_img_h*$ratio);
			  }


			  if($iw_bg != '' && $ih_bg != '' && $iw_sm != '' && $ih_sm != '' && $error == 0){

                function create_img($new_width,$new_height,$img_suffix,$filenameID){
                	global $arr, $file, $dir;
					$src_img = ImageCreateFromJPEG($file);
					$thumb = ImageCreateTrueColor($new_width,$new_height);
					ImageCopyResampled($thumb, $src_img, 0,0,0,0,($new_width),($new_height),$arr[0],$arr[1]);
                	$new_name = $dir.$filenameID.$img_suffix.'.jpg';
					ImageJPEG($thumb,$new_name);
					ImageDestroy($src_img);
					ImageDestroy($thumb);
                }

                mq('INSERT INTO gl_images SET added="'.time().'", by_userID="'.$_SESSION['userID'].'", gl_folderID="'.$var_5.'"'); //or die(mysql_error());

                $insertedID = mfa(mq('SELECT MAX(gl_imgID) FROM gl_images WHERE by_userID="'.$_SESSION['userID'].'"'));
                if($insertedID[0] > 0){


                    ## veidojam mazo attelu:
                	if($this_img_h > $data_2 || $this_img_w > $data_3){
                		@create_img($iw_sm,$ih_sm,'_sm',$insertedID[0]);
                        $msg .= $lng_pack[$var_2.$core]['small_img_created'].'<br>';
                		$msg_type = 'ok';
                    }else{
                    	$new_name = $dir.$insertedID[0].'_sm.jpg';
                        copy($file,$new_name) or $error = 1;
                        $msg .= $lng_pack[$var_2.$core]['small_img_created'].'<br>';
                		$msg_type = 'ok';
                    }


                    ## veidojam lielo attelu:
                    if($this_img_h > $data_4 || $this_img_w > $data_5){
                    	@create_img($iw_bg,$ih_bg,'',$insertedID[0]);
                    	$msg .= $lng_pack[$var_2.$core]['large_img_created'].'<br>';
                		$msg_type = 'ok';
                    }else{
                        $new_name = $dir.$insertedID[0].'.jpg';
                        copy($file,$new_name) or $error = 1;
                        $msg .= $lng_pack[$var_2.$core]['large_img_created'].'<br>';
                		$msg_type = 'ok';
                    }

                }else{
                 $error = 3;
                }


              }
            }else{
               	$msg = $lng_pack[$var_2.$core]['illegal_img_type'];
            	$msg_type = 'error';
            }
        }
        // ja nav uzlaadeets nekaads fails:
        else{
        	$msg = $lng_pack[$var_2.$core]['no_file_uploaded'];
            $msg_type = 'error';
        }


        // ja kopeeshanas laikaa izleca errors - taatad fails nav saglabaats veixmiigi, pazinojam par to:
        if($error == 1){
            $msg = $lng_pack[$var_2.$core]['file_copy_error'];
            $msg_type = 'error';
        }
        if($error == 2){
            $msg = $lng_pack[$var_2.$core]['resize_dat_incorrect'];
            $msg_type = 'error';
        }
        if($error == 3){
            $msg = $lng_pack[$var_2.$core]['img_db_reg_error'];
            $msg_type = 'error';
        }

        $var_4 = '';
        }
        // atteela pievienoshana, skripta dalja END




		// paarvietojam uz aughsu / uz leju mapes :) :
		 if(($var_4 == 'moveup' || $var_4 == 'movedown') && $var_5 !=''){

                                	// uzzinam izveleta ieraksta position_nr un atceramies to:
                                	$row = mfa(mq('SELECT position FROM gl_folders WHERE gl_folderID="'.$var_5.'"'));
                                    $this_pos_nr = $row['position'];

                                    // listingojam visus ierakstus, meklejot par vienu poziciju augstako
                                	$res = mq('SELECT gl_folderID, position FROM gl_folders ORDER BY position DESC');

                                    // uz augshu
                                    if($var_4 == 'moveup'){
                                		while($row = mfa($res)){
                                    		if($row['gl_folderID'] == $var_5){
                                        		break;
                                        	}
                                    		else{
                                    			$other_pos_nr = $row['position'];
                                    			$other_itemID = $row['gl_folderID'];
                                        	}
                                    	}
                                    }

                                	// uz leju
                                	if($var_4 == 'movedown'){
                                		while($row = mfa($res)){
                                    		if($while_itemID == $var_5){
                                            	$other_itemID = $row['gl_folderID'];
                                            	$other_pos_nr = $row['position'];
                                        		break;
                                        	}
                                    		else{
                                    			$while_itemID = $row['gl_folderID'];
                                        	}
                                    	}
                                	}

                                    // pirms saglabat parvietosanas datus, parliecinamies, vai tie ir korekti
                                    if($this_pos_nr > 0 && $other_pos_nr > 0 || $this_pos_nr == $other_pos_nr){
                                    	$q='UPDATE gl_folders SET position="'.$other_pos_nr.'" WHERE gl_folderID="'.$var_5.'"';
                                    	mq($q);
                    					$q='UPDATE gl_folders SET position="'.$this_pos_nr.'" WHERE gl_folderID="'.$other_itemID.'"';
                                    	mq($q);

                                        $msg = $lng_pack[$var_2.$core]['position_changed'];
                                        $msg_type = 'ok';
                                    }
                                    else{
                                    	$msg = $lng_pack['cms_special_items']['error'].' '.$lng_pack[$var_2.$core]['error_changing_pos'];
                                        $msg_type = 'error';
                                    }
        }
        // paarvietojam uz aughsu / uz leju mapes :) END



		//if($msg!=''){
       	//	echo '<br>'.debug_msg($msg,$msg_type,0).'<br>';
       	//}


      // paardeeveejam mapi  (user prompt dala)
      if($var_4 == 'rename' && $var_5!= ''){

    	echo'
        <br><img src="'.$img.$des.'gl_folder_large.gif"><br><br>
        <table cellspacing=2 cellpadding=4 border=0>
        <form action="'.$SELF.'" method="post">
        	<tr>
            	<td class="col2">'.$lng_pack[$var_2.$core]['language'].'</td>
                <td class="col2">'.$lng_pack[$var_2.$core]['folder_title'].'</td>
            </tr>
        ';

        $lng_res = mq('SELECT * FROM www_languages');
        while($lng_row = mfa($lng_res)){
        $color = bg_changer($color);
        $fld_desc = mfa(mq('SELECT title FROM gl_folder_description WHERE gl_folderID="'.$var_5.'" AND wwwlngID="'.$lng_row['wwwlngID'].'"'));
        	echo'
             <tr>
                   <td bgcolor="'.$color.'">'.$lng_row['full_name'].'&nbsp;('.$lng_row['short_name'].')</td>
                   <td bgcolor="'.$color.'"><input type="text" name="data_'.$lng_row['wwwlngID'].'" maxlength="255" size="45" value="'.$fld_desc['title'].'"></td>
             </tr>
            ';
        }
        echo'
            <tr>
                <td colspan="2" class="col2"><input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/dorename/'.$var_5,$expires,"/","","","").' src="img/btn/save.gif" alt="'.$lng_pack['cms_special_items']['save'].'" title="'.$lng_pack['cms_special_items']['save'].'"></td>
            </tr>
        </form>
        </table>
        <br>
        <a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$var_3,$expires,"/","","").'>&laquo;&nbsp;'.$lng_pack['cms_special_items']['back'].'</a>
        ';


      }
      // paardeeveejam mapi  (user prompt dala) END






      // mapes attelu parluks un redaktors..
      elseif($var_4 == 'explore' && $var_5 != ''){

       ## ateela apraxts - skataam, labojam un saglabaajam vajadziibas gadiijumaa :)
       if($var_7 != '' && $var_7 > 0){
       $max_symb = 5000;

       	if($_POST['save'] == 1){
           $lng_res = mq('SELECT * FROM www_languages');
        	while($lng_row = mfa($lng_res)){
            	$tmp_name = 'data_'.$lng_row['wwwlngID'];
                $$tmp_name = cr(substr($_POST[$tmp_name],0,$max_symb));
                $check_db = mfa(mq('SELECT Count(*) FROM img_description WHERE gl_imgID="'.$var_7.'" AND wwwlngID="'.$lng_row['wwwlngID'].'"'));

                if($check_db[0] == 1){
                	mq('UPDATE img_description SET description="'.$$tmp_name.'" WHERE gl_imgID="'.$var_7.'" AND wwwlngID="'.$lng_row['wwwlngID'].'"') or die(mysql_error());
                }else{
                    mq('INSERT INTO img_description SET description="'.$$tmp_name.'", gl_imgID="'.$var_7.'", wwwlngID="'.$lng_row['wwwlngID'].'"') or die(mysql_error());
                }
            }
            $msg = $lng_pack[$var_2.$core]['img_description_saved'];
            $msg_type = 'ok';
        }


        if($msg!=''){
       		echo '<br>'.debug_msg($msg,$msg_type,0).'<br>';
       	}
        echo'
        <br>
        <table cellspacing=0 cellpadding=10 border=0>
             <tr>
                   <td align="center" style="border: 1px solid #C6E1DC;" bgcolor="#F0F1F6">';
                   $img_path = '../img/gallery/'.$var_7.'.jpg';
                   $img_arr = getimagesize($img_path);
                   echo'
                   <a href="'.$SELF.'" onclick="NewWin(\''.$img_path.'\',\'name\',\''.($img_arr[0]+40).'\',\''.($img_arr[1]+40).'\',\'yes\');return false;"><img src="../img/gallery/'.$var_7.'_sm.jpg"></a>
                   </td>
             </tr>
        </table>
        <br>
        <table cellspacing=2 cellpadding=4 border=0>
        <form action="'.$SELF.'" method="post">
        <input type="hidden" name="save" value="1">
        	<tr>
            	<td class="col2">'.$lng_pack[$var_2.$core]['language'].'</td>
                <td class="col2">'.$lng_pack[$var_2.$core]['img_description'].' <font color="gray">('.$lng_pack[$var_2.$core]['max_symbols'].': '.$max_symb.')</font></td>
            </tr>
        ';

        $lng_res = mq('SELECT * FROM www_languages');
        while($lng_row = mfa($lng_res)){
        $color = bg_changer($color);
        $img_desc = mfa(mq('SELECT description FROM img_description WHERE gl_imgID="'.$var_7.'" AND wwwlngID="'.$lng_row['wwwlngID'].'"'));
        	echo'
             <tr>
                   <td bgcolor="'.$color.'">'.$lng_row['full_name'].'&nbsp;('.$lng_row['short_name'].')</td>
                   <td bgcolor="'.$color.'"><textarea name="data_'.$lng_row['wwwlngID'].'" cols="45" rows="3">'.$img_desc['description'].'</textarea></td>
             </tr>
            ';
        }
        echo'
            <tr>
                <td colspan="2" class="col2"><input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/'.$var_4.'/'.$var_5.'/'.$var_6.'/'.$var_7,$expires,"/","","","").' src="img/btn/save.gif" alt="'.$lng_pack['cms_special_items']['save'].'" title="'.$lng_pack['cms_special_items']['save'].'"></td>
            </tr>
        </form>
        </table>
        <br><a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/'.$var_4.'/'.$var_5.'/'.$var_6,$expires,"/","","").' title="'.$lng_pack['cms_special_items']['back'].'">&laquo;&nbsp;'.$lng_pack['cms_special_items']['back'].'</a>
        ';



       ## ateela apraxts END
       }else{
        ## lasaam galerijas uzstaadiijumus:
        $gl_settings = mfa(mq('SELECT * FROM gl_settings'));
        $img_per_page = $gl_settings['thumbs_vert_per_page'] * $gl_settings['thumbs_hori_per_page'];

        $from_img = numeric(substr($_POST['from_img'],0,8));
        if($from_img == '' || $from_img < 0){$from_img = 0;}

        ## dzesham vai parvietojam attelus, ja jau tas tika pieprasiits:
        if($_POST['delete'] == 1 || $_POST['move_to'] != ''){

          ## dzesham
          if($_POST['delete'] == 1){
       	   $tmp_res = mq('SELECT gl_imgID FROM gl_images WHERE gl_folderID="'.$var_5.'" ORDER BY gl_imgID DESC LIMIT '.$from_img.','.$img_per_page.'') or die(mysql_error());
           $tmp_count = mysql_num_rows($tmp_res);
           $del_img_count = 0;
           while($tmp_row = mfa($tmp_res)){
           	$tmp_img_name = 'img_'.$tmp_row['gl_imgID'];
            if($_POST[$tmp_img_name] == 1){
            	$del_img_count++;


                $DEL_error = 0;
                unlink('../img/gallery/'.$tmp_row['gl_imgID'].'.jpg') or $DEL_error = 1;
                if($DEL_error != 1){
                	unlink('../img/gallery/'.$tmp_row['gl_imgID'].'_sm.jpg') or $DEL_error = 1;
                }

                if($DEL_error != 1){
            		mq('DELETE FROM gl_images WHERE gl_imgID="'.$tmp_row['gl_imgID'].'"');
                	mq('DELETE FROM img_description WHERE gl_imgID="'.$tmp_row['gl_imgID'].'"');
                }
            }
           }

           if($DEL_error != 1){
           	if($del_img_count > 0){
           		$msg = $lng_pack[$var_2.$core]['selected_img_deleted'];
           		$msg_type = 'ok';
           	}else{
           		$msg = $lng_pack[$var_2.$core]['no_img_selected_t_del'];
           		$msg_type = 'error';
           	}
           }else{
           		$msg = $lng_pack[$var_2.$core]['not_all_img_deleted'];
           		$msg_type = 'error';
           }


           ## lapaspuses kontrole, lai nebutu ta, ka pec dzesanas atveras ta dala, kuraa vairs nav atteelu :)
           if(($tmp_count - $del_img_count) > 0){
           	$var_6 = $from_img;
           }else{
           	$var_6 = $from_img - $img_per_page;
            if($var_6 < 0){
            	$var_6 = 0;
            }
           }



          }
          ## dzesham END

          ## parbaudam, vai mape, uz kuru velamies parvietot, vispar existee ;)
          ## shito daraam tikai tad, ja neko neesam dzeesushi
          if($_POST['move_to'] != '' && $_POST['delete'] == 0){
          	$move_to = numeric(substr($_POST['move_to'],0,8));
          	$chck = mfa(mq('SELECT Count(*) FROM gl_folders WHERE gl_folderID="'.$move_to.'"'));
            if($chck[0] == 1){

             	$tmp_res = mq('SELECT gl_imgID FROM gl_images WHERE gl_folderID="'.$var_5.'" ORDER BY gl_imgID DESC LIMIT '.$from_img.','.$img_per_page.'') or die(mysql_error());
                $tmp_count = mysql_num_rows($tmp_res);
                $move_img_count = 0;
           		while($tmp_row = mfa($tmp_res)){
           			$tmp_img_name = 'img_'.$tmp_row['gl_imgID'];
            			if($_POST[$tmp_img_name] == 1){
            				$move_img_count++;
            				mq('UPDATE gl_images SET gl_folderID="'.$move_to.'" WHERE gl_imgID="'.$tmp_row['gl_imgID'].'"');
            			}
           		}

                if($move_img_count > 0){
                	$msg = $lng_pack[$var_2.$core]['all_img_moved_success'];
                	$msg_type = 'ok';
                }else{
                    $msg = $lng_pack[$var_2.$core]['no_img_choosed_t_move'];
                	$msg_type = 'error';
                }
            }else{
            	$msg = $lng_pack[$var_2.$core]['no_folder_to_move_to'];
                $msg_type = 'error';
            }

           ## lapaspuses kontrole, lai nebutu ta, ka pec paarvietoshanas atveras ta dala, kuraa vairs nav atteelu :)
           if(($tmp_count - $move_img_count) > 0){
           	$var_6 = $from_img;
           }else{
           	$var_6 = $from_img - $img_per_page;
            if($var_6 < 0){
            	$var_6 = 0;
            }
           }

          }
          ## parvietoshana END

        }

        $img_count = mfa(mq('SELECT Count(*) FROM gl_images WHERE gl_folderID="'.$var_5.'"'));
        $gl_title = mfa(mq('SELECT title FROM gl_folder_description WHERE gl_folderID="'.$var_5.'" AND wwwlngID="'.$var_3.'"'));

        // sakot ar kuru attelu sakam radit, ja tiko atveram sadalu, logiski, ka ar 0-to :)))
        if($var_6 == '' || $var_6 < 1){
        	$var_6 = 0;
        }

        $gl_img_res = mq('SELECT * FROM gl_images WHERE gl_folderID="'.$var_5.'" ORDER BY gl_imgID DESC LIMIT '.$var_6.','.$img_per_page.'') or die(mysql_error());

        $tr_ctrl = 0;
        if($msg!=''){
       		echo '<br>'.debug_msg($msg,$msg_type,0).'<br>';
       	}
        echo'<form action="'.$SELF.'" method="post">
        <a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$var_3,$expires,"/","","").' title="'.$lng_pack['cms_special_items']['back'].'">&laquo;&nbsp;'.$lng_pack['cms_special_items']['back'].'</a>
        <br><img src="'.$img.$des.'x.gif" width="1" height="9" alt=""><br>
        <img src="'.$img.$des.'gl_folder_small.gif" alt="" align="absmiddle">&nbsp;<b><font style="font-size:13px;">&bdquo;'.$gl_title['title'].'&ldquo;</font></b>&nbsp;&nbsp;&nbsp;<img src="'.$img.$des.'img_ico.gif" alt="'.$lng_pack[$var_2.$core]['img_count_in_folder'].':" align="absmiddle" title="'.$lng_pack[$var_2.$core]['img_count_in_folder'].': '.$img_count[0].'">&nbsp;'.$img_count[0].'<br>

        <table cellspacing=0 cellpadding=0 border=0>
             <tr>
                   <td>';
                   $i = 0;
                   while($i < $img_count[0]){
                   $i = $i + $img_per_page;
                   	if($i > $img_count[0]){
                    	$max_to = $img_count[0];
                    }else{
                        $max_to = $i;
                    }
                   		echo'<a style="background-color:';
                        	if(($i -  $img_per_page) == $var_6){
                            	echo'#F5DBAF';
                            }else{
                        		echo'#DDEDEA';
                            }
                        echo';" href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/explore/'.$var_5.'/'.($i-$img_per_page),$expires,"/","","").'>'.($i-$img_per_page+1).'-'.$max_to.'</a> ';
                   }

                   echo'</td>
             </tr>
        </table>
        <input type="hidden" name="from_img" value="'.$var_6.'">
        <table border=0 cellspacing=5 cellpadding=10>';
        while($img_row = mfa($gl_img_res)){
          if($tr_ctrl == 0){echo'<tr valign="middle">';}
          $tr_ctrl++;
          $user_row = mfa(mq('SELECT adm_login FROM adm_user WHERE userID="'.$img_row['by_userID'].'"'));
        	echo'<td align="center" style="border: 1px solid #C6E1DC;" bgcolor="#F0F1F6">';
            $img_path = '../img/gallery/'.$img_row['gl_imgID'].'.jpg';
            $img_arr = getimagesize($img_path);
            echo'
            <a href="'.$SELF.'" onclick="NewWin(\''.$img_path.'\',\'name\',\''.($img_arr[0]+40).'\',\''.($img_arr[1]+40).'\',\'yes\');return false;"><img src="../img/gallery/'.$img_row['gl_imgID'].'_sm.jpg"></a>
            <table cellspacing=0 cellpadding=1 border=0 width="100%">
                 <tr>
                 	<td><font style="font-size:8px; color:gray;">'.$lng_pack[$var_2.$core]['img_added'].': '.getTHEdate($img_row['added']).',<br>'.$user_row['adm_login'].'</font>
                    <br><a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/'.$var_4.'/'.$var_5.'/'.$var_6.'/'.$img_row['gl_imgID'],$expires,"/","","").'><font style="font-size:9px;">'.$lng_pack[$var_2.$core]['description'].'</font></a>
                    </td>
                    <td><input type="hidden" name="img_'.$img_row['gl_imgID'].'" value="0"><input type="checkbox" name="img_'.$img_row['gl_imgID'].'" value="1"></td>
                 </tr>
            </table>
            </td>';
          if($tr_ctrl == $gl_settings['thumbs_hori_per_page']){echo'</tr>'; $tr_ctrl=0;}
        }
        echo'
        </table>';


        // atziimeeto atteelu opcijas :)
        if($img_count[0] > 0){
        echo'<br>
        <table cellspacing=0 cellpadding=3 border=0 width="300">
             <tr>
                   <td colspan="2" class="col_mtitle">'.$lng_pack[$var_2.$core]['selected_images'].' '.strtolower($lng_pack['cms_special_items']['options']).'&nbsp;&nbsp;&nbsp;</td>
             </tr>
             <tr>
                   <td>'.$lng_pack[$var_2.$core]['move_to'].'</td>
                   <td style="border-left:1px solid orange;" align="center">&nbsp;&nbsp;&nbsp;'.$lng_pack[$var_2.$core]['delete_selected_img'].'&nbsp;&nbsp;&nbsp;</td>
             </tr>
             <tr>
             	<td>
                	<select name="move_to">
                    <option value="">-  '.$lng_pack['cms_special_items']['choose'].' -</option>';
                    $tmp_title_res = mq('SELECT title, gl_folderID FROM gl_folder_description WHERE gl_folderID!="'.$var_5.'" AND wwwlngID="'.$var_3.'" ORDER BY title DESC');
                    $ir = 0;
                    while($tmtitle = mfa($tmp_title_res)){
                    	echo'<option value="'.$tmtitle['gl_folderID'].'">';
                        	if(strlen($tmtitle['title']) > 50){
                            	echo substr($tmtitle['title'],0,50).'..';
                            }else{
                                echo $tmtitle['title'];
                            }
                        echo'</option>';
                        $ir = 1;
                    }
                    if($ir == 0){
                    	echo'<option value="">'.$lng_pack[$var_2.$core]['no_other_folders'].'</option>';
                    }
                    echo'</select>
                </td>
                <td align="center" style="border-left:1px solid orange;">
                	<input type="hidden" name="delete" value="0">
                	<input type="checkbox" name="delete" value="1" onchange="javascript: if(this.checked == true){  if(confirm(\''.$lng_pack[$var_2.$core]['js_confirm_delete'].'\')){this.checked = true}else{this.checked = false}  }">
                </td>
             </tr>
             <tr>
             	<td class="col3" colspan="2">
                	<input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/explore/'.$var_5,$expires,"/","","","").' src="img/btn/'.$devos_lng.'/ok.gif" alt="'.$lng_pack['cms_special_items']['ok'].'" title="'.$lng_pack['cms_special_items']['ok'].'">
                </td>
             </tr>
        </table>';
        }


        echo'
        </form>
        <br>';
       }
      }
      // mapes attelu parluks un redaktors..  END








      // mapes apraksta apskate, redigjeeshana..
      elseif($var_4 == 'description' && $var_5 != ''){

        // mainaam mapes aprakstu (skripta dala)
     	if($_POST['data_0'] == 1){

          $lng_res = mq('SELECT * FROM www_languages');
          while($lng_row = mfa($lng_res)){
        	$tmp_name = 'data_'.$lng_row['wwwlngID'];
            $$tmp_name = textareaTOdata(substr($_POST[$tmp_name],0,5000));
            mq('UPDATE gl_folder_description SET description="'.$$tmp_name.'" WHERE gl_folderID="'.$var_5.'" AND wwwlngID="'.$lng_row['wwwlngID'].'"');
          }
             	$msg = $lng_pack[$var_2.$core]['fld_descr_chg_success'];
             	$msg_type = 'ok';
        }


      	$fld_title = mfa(mq('SELECT title FROM gl_folder_description WHERE gl_folderID="'.$var_5.'" AND wwwlngID="'.$var_3.'"'));
        if($msg!=''){
       		echo '<br>'.debug_msg($msg,$msg_type,0).'<br>';
       	}
        echo'
        <br><img src="'.$img.$des.'gl_folder_large.gif"><br><br>
        <table cellspacing=2 cellpadding=4 border=0>
        <form action="'.$SELF.'" method="post">
        <input type="hidden" name="data_0" value="1">
        	<tr>
            	<td colspan="2" class="col_mtitle">'.$lng_pack[$var_2.$core]['folder_title'].':&nbsp;&bdquo;'.$fld_title['title'].'&ldquo;</td>
            </tr>
        	<tr>
            	<td class="col2">'.$lng_pack[$var_2.$core]['language'].'</td>
                <td class="col2">'.$lng_pack[$var_2.$core]['folder_description'].'</td>
            </tr>
        ';

        $lng_res = mq('SELECT * FROM www_languages');
        while($lng_row = mfa($lng_res)){
        $color = bg_changer($color);
        $fld_desc = mfa(mq('SELECT description FROM gl_folder_description WHERE gl_folderID="'.$var_5.'" AND wwwlngID="'.$lng_row['wwwlngID'].'"'));
        	echo'
             <tr>
                   <td bgcolor="'.$color.'">'.$lng_row['full_name'].'&nbsp;('.$lng_row['short_name'].')</td>
                   <td bgcolor="'.$color.'"><textarea name="data_'.$lng_row['wwwlngID'].'" cols="57" rows="4">'.dataTOtextarea($fld_desc['description']).'</textarea></td>
             </tr>
            ';
        }
        echo'
            <tr>
                <td colspan="2" class="col2"><input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/description/'.$var_5,$expires,"/","","","").' src="img/btn/save.gif" alt="'.$lng_pack['cms_special_items']['save'].'" title="'.$lng_pack['cms_special_items']['save'].'"></td>
            </tr>
        </form>
        </table>
        <br>
        <a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$var_3,$expires,"/","","").'>&laquo;&nbsp;'.$lng_pack['cms_special_items']['back'].'</a>
        ';
      }
      // mapes apraksta apskate, redigjeeshana..  END


      // radam mapju saraxtu
      // ar iespeju atvert to, regigjeet mapes nosaukumu, aprakstu un arii dzeest, paarvietot mapes saturu..
      else{


      	if($_POST['delete_fld'] == 1){
        	$error = 0;
            $kaut_ko_dzesam = 0;
        	$fld_res = mq('SELECT * FROM gl_folders');
            while($folders = mfa($fld_res)){
            	$tmp_name = 'folder_'.$folders['gl_folderID'];
                if($_POST[$tmp_name] == 1){
                	$img_res = mq('SELECT gl_imgID FROM gl_images WHERE gl_folderID="'.$folders['gl_folderID'].'"');
                    while($img_row = mfa($img_res)){
                    	unlink('../img/gallery/'.$img_row['gl_imgID'].'.jpg') or $error = 1;
                        if(!file_exists('../img/gallery/'.$img_row['gl_imgID'].'.jpg')){$error = 0;}

                        if($error == 0){
                          unlink('../img/gallery/'.$img_row['gl_imgID'].'_sm.jpg') or $error = 1;
                          if(!file_exists('../img/gallery/'.$img_row['gl_imgID'].'_sm.jpg')){$error = 0;}
                        }
                        if($error == 0){
                        	mq('DELETE FROM img_description WHERE gl_imgID="'.$img_row['gl_imgID'].'"') or $error = 1;
                        }
                        if($error == 0){
                        	mq('DELETE FROM gl_images WHERE gl_imgID="'.$img_row['gl_imgID'].'"') or $error = 1;
                        }
                    }

                  if($error == 0){
                     mq('DELETE FROM gl_folder_description WHERE gl_folderID="'.$folders['gl_folderID'].'"') or $error = 1;
                  }
                  if($error == 0){
                     mq('DELETE FROM gl_folders WHERE gl_folderID="'.$folders['gl_folderID'].'"') or $error = 1;
                  }
                  $kaut_ko_dzesam = 1;
                }
            }

           		$msg = $lng_pack[$var_2.$core]['all_sel_fld_deleted'];
                $msg_type = 'ok';

            if($error == 1){
            	$msg = $lng_pack[$var_2.$core]['not_all_fld_deleted'];
                $msg_type = 'error';
            }
            elseif($kaut_ko_dzesam == 0){
                $msg = $lng_pack[$var_2.$core]['no_folders_selected'];
                $msg_type = 'error';
            }
        }
        elseif($_POST['move_to_fld'] != '' && $_POST['move_to_fld'] > 0){
            $error = 0;
            $kaut_ko_parvietojam = 0;

            ## parbaudam vai merkjmape vispaa existee:
            $move_to_fld = numeric(substr($_POST['move_to_fld'],0,8));
            $check = mfa(mq('SELECT Count(*) FROM gl_folders WHERE gl_folderID="'.$move_to_fld.'"'));
            if($check[0] == 1){
        		$fld_res = mq('SELECT * FROM gl_folders');
            	while($folders = mfa($fld_res)){
                	if($folders['gl_folderID'] != $move_to_fld){
                		$tmp_name = 'folder_'.$folders['gl_folderID'];
                		if($_POST[$tmp_name] == 1){
                        	mq('UPDATE gl_images SET gl_folderID="'.$move_to_fld.'" WHERE gl_folderID="'.$folders['gl_folderID'].'"');
                		}
                    }
            	}

                $msg = $lng_pack[$var_2.$core]['all_img_move_success'];
                $msg_type = 'ok';

            }else{
            	$msg = $lng_pack[$var_2.$core]['move_to_fld_not_found'];
                $msg_type = 'error';
            }
        }


        if($var_4 != 'addimg') {echo'<form action="'.$SELF.'" method="post">';}

        if($msg!=''){
       			echo debug_msg($msg,$msg_type,0).'<br><br>';
       	}

        $gl_folders = mq('SELECT * FROM gl_folders ORDER BY position DESC');
    	while($folder_row = mfa($gl_folders)){
        $color = bg_changer($color);
        	$fld_description = mfa(mq('SELECT * FROM gl_folder_description WHERE gl_folderID="'.$folder_row['gl_folderID'].'" AND wwwlngID="'.$var_3.'"'));
            $img_count = mfa(mq('SELECT Count(*) FROM gl_images WHERE gl_folderID="'.$folder_row['gl_folderID'].'"'));
        	echo'
            <a name="'.$folder_row['gl_folderID'].'"></a>
        	<table cellspacing=0 cellpadding=5 style="border:0; border-left: 5px solid #FFFFFF">
               <tr valign="top">
                   <td bgcolor="'.$color.'" align="left" width="50">
                      <a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/explore/'.$folder_row['gl_folderID'],$expires,"/","","").' title="'.$fld_description['title'].'"><img src="'.$img.$des.'gl_folder_small.gif" alt="'.$fld_description['title'].'"></a><br><img src="'.$img.$des.'x.gif" width="1" height="3" alt=""><br>
                      ';
                      if($var_4 != 'addimg'){
                      	echo'
                      		<input type="hidden" name="folder_'.$folder_row['gl_folderID'].'" value="0">
                      		<input type="checkbox" name="folder_'.$folder_row['gl_folderID'].'" value="1">
                   		';
                      }
                   echo'
                   </td>
                   <td bgcolor="'.$color.'" align="left" width="420">
                   	<b><a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/explore/'.$folder_row['gl_folderID'],$expires,"/","","").' title="'.$fld_description['title'].'">&bdquo;'.$fld_description['title'].'&ldquo;</a></b>
                    <br><i><font color="gray" style="font-size:8px;">'.$lng_pack[$var_2.$core]['created'].' '.getTHEdate($folder_row['created']).'</font></i>
                    <br><img src="'.$img.$des.'x.gif" width="1" height="5" alt=""><br>
                    <a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/explore/'.$folder_row['gl_folderID'],$expires,"/","","").' title="'.$fld_description['title'].'"><font color="gray">'.$lng_pack[$var_2.$core]['img_count_in_gallery'].': '.$img_count[0].'</font></a>&nbsp;&nbsp;&nbsp;';
                    if($var_4 == 'addimg' && $var_5 !=  $folder_row['gl_folderID'] || $var_4 != 'addimg' || $_POST['data_0'] == 1){
                    	echo'<a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/addimg/'.$folder_row['gl_folderID'],$expires,"/","","").'><img src="'.$img.$des.'add_img.gif" alt="'.$lng_pack[$var_2.$core]['add_image'].'" title="'.$lng_pack[$var_2.$core]['add_image'].' &quot;'.$fld_description['title'].'&quot;" align="absmiddle"></a>
                   		';
                    }
                   	if(($var_4 == 'addimg' && $var_5 ==  $folder_row['gl_folderID']) && $_POST['data_0'] != 1){
                    	$gl_settings = mfa(mq('SELECT * FROM gl_settings'));
                    	echo'
                        <br><img src="'.$img.$des.'x.gif" width="1" height="5" alt=""><br>
                        <table cellspacing=0 cellpadding=3 border=0 bgcolor="#F2F8F7">
                        <form action="'.$SELF.'" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="data_0" value="1">
                        	 <tr>
                             	   <td colspan="2" class="col_mtitle">'.$lng_pack[$var_2.$core]['image_adding'].'</td>
                             </tr>
                             <tr>
                                   <td>'.$lng_pack[$var_2.$core]['choose_img_file'].':</td>
                                   <td><input type="file" size="18" name="file" /></td>
                             </tr>
                             <tr>
                                   <td>'.$lng_pack['gallery_settings_core']['thumb_max_height'].':</td>
                                   <td><input type="text" size="5" name="data_2" value="'.$gl_settings['def_thumb_height'].'"></td>
                             </tr>
                             <tr>
                                   <td>'.$lng_pack['gallery_settings_core']['thumb_max_width'].':</td>
                                   <td><input type="text" size="5" name="data_3" value="'.$gl_settings['def_thumb_width'].'"></td>
                             </tr>
                             <tr>
                                   <td>'.$lng_pack['gallery_settings_core']['full_max_height'].':</td>
                                   <td><input type="text" size="5" name="data_4" value="'.$gl_settings['def_full_height'].'"></td>
                             </tr>
                             <tr>
                                   <td>'.$lng_pack['gallery_settings_core']['full_max_width'].':</td>
                                   <td><input type="text" size="5" name="data_5" value="'.$gl_settings['def_full_width'].'"></td>
                             </tr>
                             <tr>
                                   <td colspan="2">
                                   	<input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/addimg/'.$folder_row['gl_folderID'],$expires,"/","","","").' src="img/btn/add.gif" alt="'.$lng_pack['cms_special_items']['add'].'" title="'.$lng_pack['cms_special_items']['add'].'">
                                    &nbsp;&nbsp;&nbsp;<a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$var_3,$expires,"/").'>['.$lng_pack['cms_special_items']['cancel'].']</a>
                                   </td>
                             </tr>
                        </form>
                        </table>
                        <img src="'.$img.$des.'x.gif" width="1" height="5" alt="">
                        ';
                    }
                   echo'
                   </td>
                   <td width="20" bgcolor="'.$color.'">';

                   	$min_pos_nr = mfa(mq('SELECT MIN(position) FROM gl_folders'));
                	$max_pos_nr = mfa(mq('SELECT MAX(position) FROM gl_folders'));

                	if($folder_row['position'] < $max_pos_nr[0]){
                		echo'<a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/moveup/'.$folder_row['gl_folderID'],$expires,"/").'  title="'.$lng_pack[$var_2.$core]['move_up'].'"><img src="'.$img.'btn/up.gif" alt="'.$lng_pack[$var_2.$core]['move_up'].'"></a>';
                	}

                    echo'
                   </td>
               </tr>
               <tr>
                   <td colspan="2" bgcolor="'.$color.'">
                    <a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/rename/'.$folder_row['gl_folderID'],$expires,"/","","").'><font style="font-size:9px;">'.$lng_pack['cms_special_items']['rename'].'</font></a>
                    <font style="font-size:9px;">&nbsp;|&nbsp;</font>
                    <a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/description/'.$folder_row['gl_folderID'],$expires,"/","","").'><font style="font-size:9px;">'.$lng_pack[$var_2.$core]['description'].'</font></a>
                   </td>
                   <td width="20" bgcolor="'.$color.'">';

                   if($folder_row['position'] > $min_pos_nr[0]){
                		echo'<a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/movedown/'.$folder_row['gl_folderID'],$expires,"/").'><img src="'.$img.'btn/down.gif" alt="'.$lng_pack[$var_2.$core]['move_down'].'" title="'.$lng_pack[$var_2.$core]['move_down'].'"></a>&nbsp;';
                   }

                   echo'
                   </td>
               </tr>
        	</table>
            <img src="'.$img.$des.'x.gif" width="1" height="5" alt=""><br>
        	';
            $ir = 1;
    	}
        if($ir != 1){
        	echo'
            <table cellspacing=0 cellpadding=0 border=0 width="100%">
                 <tr>
                       <td align="center"><br><br><br><br><i>'.$lng_pack[$var_2.$core]['no_folders_registred'].'</i></td>
                 </tr>
            </table>
            ';
        }
        if($var_4 != 'addimg') {

          // atziimeeto mapju opcijas :)
          if($ir == 1){
          echo'<br>
          <table cellspacing=0 cellpadding=3 border=0 width="300">
             <tr>
                   <td colspan="2" class="col_mtitle">'.$lng_pack[$var_2.$core]['selected_folders'].' '.strtolower($lng_pack['cms_special_items']['options']).'&nbsp;&nbsp;&nbsp;</td>
             </tr>
             <tr>
                   <td>'.$lng_pack[$var_2.$core]['fld_cnt_move_to'].'</td>
                   <td style="border-left:1px solid orange;" align="center">&nbsp;&nbsp;&nbsp;'.$lng_pack[$var_2.$core]['delete_selected_img'].'&nbsp;&nbsp;&nbsp;</td>
             </tr>
             <tr>
             	<td>
                	<select name="move_to_fld">
                    <option value="">-  '.$lng_pack['cms_special_items']['choose'].' -</option>';
                    $tmp_title_res = mq('SELECT title, gl_folderID FROM gl_folder_description WHERE wwwlngID="'.$var_3.'" ORDER BY title DESC');
                    $ir = 0;
                    while($tmtitle = mfa($tmp_title_res)){
                    	echo'<option value="'.$tmtitle['gl_folderID'].'">';
                        	if(strlen($tmtitle['title']) > 50){
                            	echo substr($tmtitle['title'],0,50).'..';
                            }else{
                                echo $tmtitle['title'];
                            }
                        echo'</option>';
                        $ir = 1;
                    }
                    if($ir == 0){
                    	echo'<option value="">'.$lng_pack[$var_2.$core]['no_other_folders'].'</option>';
                    }
                    echo'</select>
                </td>
                <td align="center" style="border-left:1px solid orange;">
                	<input type="hidden" name="delete_fld" value="0">
                	<input type="checkbox" name="delete_fld" value="1" onclick="javascript: if(this.checked == true){  if(confirm(\''.$lng_pack[$var_2.$core]['js_confirm_delete_fld'].'\')){this.checked = true}else{this.checked = false}  }">
                </td>
             </tr>
             <tr>
             	<td class="col3" colspan="2">
                	<input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/'.$var_3,$expires,"/","","","").' src="img/btn/'.$devos_lng.'/ok.gif" alt="'.$lng_pack['cms_special_items']['ok'].'" title="'.$lng_pack['cms_special_items']['ok'].'">
                </td>
             </tr>
          </table>';
          }

        echo'</form>';
        }
       }



     }

    break;
    ## [11] END



    // ----------------------------------------------------------- //
    // [12] EPASTA ANKETAS LAPAS DATI
    // ----------------------------------------------------------- //
    case 'email_form_page':


     if($var_3 < 1){
       if($msg!=''){
       		echo '<br>'.debug_msg($msg,$msg_type,0).'<br>';
       }
       echo'
       <br>
       <table cellspacing=0 cellpadding=5 border=0>
       	<tr valign="bottom">
        	<td><img src="'.$img.$des.'em_quest.gif">
        	<td>'.$lng_pack[$var_2.$core]['choose_language'].'<br>
			';
            $res = mq('SELECT * FROM www_languages');
            while($row = mfa($res)){
            	echo'
					<br>&nbsp;&nbsp;&nbsp;<a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/'.$row['wwwlngID'],$expires,"/","","").'>'.$row['full_name'].'&nbsp;('.$row['short_name'].')&nbsp;&raquo;</a><br><img src="'.$img.$des.'x.gif" alt="" width="1" height="3">
                ';
			}
            echo'
			</td>
        </tr>
       </table>
       ';


     }else{

     	if($var_4 == 'save'){

            $data_1 = textareaTOdata(substr($_POST['data_1'],0,5000));
            $data_2 = cr(substr($_POST['data_2'],0,255));
            $data_3 = cr(substr($_POST['data_3'],0,255));
            $data_4 = cr(substr($_POST['data_4'],0,150));
            $data_5 = textareaTOdata(substr($_POST['data_5'],0,2000));
            $data_6 = textareaTOdata(substr($_POST['data_6'],0,5000));
            $data_7 = cr(substr($_POST['data_7'],0,500));
            $data_8 = cr(substr($_POST['data_8'],0,500));

            $check = mfa(mq('SELECT Count(*) FROM email_page WHERE wwwlngID="'.$var_3.'"'));
            if($check[0] == 1){
            	mq('UPDATE email_page SET
                	before_form_txt="'.$data_1.'",
                    after_form_txt="'.$data_6.'",
                    em_address_title="'.$data_2.'",
                    em_content_title="'.$data_3.'",
                    hint="'.$data_5.'",
                    email_is_sent="'.$data_7.'",
                    email_not_sent="'.$data_8.'",
                    button_title="'.$data_4.'"
                WHERE wwwlngID="'.$var_3.'"');
            }else{
                mq('INSERT INTO email_page SET
                	before_form_txt="'.$data_1.'",
                    after_form_txt="'.$data_6.'",
                    em_address_title="'.$data_2.'",
                    em_content_title="'.$data_3.'",
                    email_is_sent="'.$data_7.'",
                    email_not_sent="'.$data_8.'",
                    hint="'.$data_5.'",
                    button_title="'.$data_4.'",
                    wwwlngID="'.$var_3.'"');
            }

            $msg = $lng_pack['cms_special_items']['data_saved'];
            $msg_type = 'ok';

        }

      $lng_row = mfa(mq('SELECT * FROM www_languages WHERE wwwlngID="'.$var_3.'"'));
      $email_row = mfa(mq('SELECT * FROM email_page WHERE wwwlngID="'.$var_3.'"'));
      if($msg!=''){
       		echo '<br>'.debug_msg($msg,$msg_type,0).'<br>';
      }
      echo'
      <br>
      <a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2,$expires,"/","","").'>&laquo;&nbsp;'.$lng_pack['cms_special_items']['back'].'</a>
      <br><img src="'.$img.$des.'x.gif" alt="" width="1" height="7">
      <table cellspacing=2 cellpadding=4 border=0>
      <form action="'.$SELF.'" method="post">
           <tr>
                 <td colspan="2" class="col_mtitle">'.$lng_pack[$var_2.$core]['choosed_lng'].': '.$lng_row['full_name'].' ('.$lng_row['short_name'].')&nbsp;&nbsp;&nbsp;</td>
           </tr>
           <tr>
                 <td class="col3">'.$lng_pack[$var_2.$core]['txt_before_form'].'<br>
                 <font color="gray" style="font-size:9px">'.$lng_pack[$var_2.$core]['not_important'].'</font></td>
                 <td class="col4"><textarea name="data_1" cols="43" rows="8">'.dataTOtextarea($email_row['before_form_txt']).'</textarea></td>
           </tr>
           <tr>
                 <td class="col3">'.$lng_pack[$var_2.$core]['email_field_title'].'</td>
                 <td class="col4"><input type="text" name="data_2" value="'.dataTOtextarea($email_row['em_address_title']).'" size="37" maxlength="255"></td>
           </tr>
           <tr>
                 <td class="col3">'.$lng_pack[$var_2.$core]['email_cnt_fld_title'].'</td>
                 <td class="col4"><input type="text" name="data_3" value="'.dataTOtextarea($email_row['em_content_title']).'" size="37" maxlength="255"></td>
           </tr>
           <tr>
                 <td class="col3">'.$lng_pack[$var_2.$core]['email_is_sent'].'</td>
                 <td class="col4"><input type="text" name="data_7" value="'.dataTOtextarea($email_row['email_is_sent']).'" size="37" maxlength="500"></td>
           </tr>
           <tr>
                 <td class="col3">'.$lng_pack[$var_2.$core]['email_not_sent'].'</td>
                 <td class="col4"><input type="text" name="data_8" value="'.dataTOtextarea($email_row['email_not_sent']).'" size="37" maxlength="500"></td>
           </tr>
           <tr>
                 <td class="col3">'.$lng_pack[$var_2.$core]['send_button_text'].'</td>
                 <td class="col4"><input type="text" name="data_4" value="'.dataTOtextarea($email_row['button_title']).'" size="20" maxlength="150"></td>
           </tr>
           <tr>
                 <td class="col3">'.$lng_pack[$var_2.$core]['hint_field'].'<br>
                 <font color="gray" style="font-size:9px">'.$lng_pack[$var_2.$core]['not_important'].'</font></td>
                 <td class="col4"><textarea name="data_5" cols="43" rows="5">'.dataTOtextarea($email_row['hint']).'</textarea></td>
           </tr>
           <tr>
                 <td class="col3">'.$lng_pack[$var_2.$core]['txt_after_form'].'<br>
                 <font color="gray" style="font-size:9px">'.$lng_pack[$var_2.$core]['not_important'].'</font></td>
                 <td class="col4"><textarea name="data_6" cols="43" rows="8">'.dataTOtextarea($email_row['after_form_txt']).'</textarea></td>
           </tr>
           <tr>
           	<td colspan="2" class="col2"><input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/save',$expires,"/","","","").' src="img/btn/save.gif" alt="'.$lng_pack['cms_special_items']['save'].'" title="'.$lng_pack['cms_special_items']['save'].'"></td>
           </tr>
      </form>
      </table>
      ';


     }


    break;



    // ----------------------------------------------------------- //
    // [13] EPASTA ANKETAS LAPAS UZSTADIJUMI
    // ----------------------------------------------------------- //
    case'email_pg_config':

     if($var_3 == 'save'){

     	$data_1 = strong_replace(substr($_POST['data_1'],0,150));
        $data_2 = cr(substr($_POST['data_2'],0,255));
        $data_3 = strong_replace(substr($_POST['data_3'],0,150));
        $data_4 = alphab(substr($_POST['data_4'],0,6));
        $data_5 = numeric(substr($_POST['data_5'],0,3));
        if($data_5 < 100){$data_5 = 100;}
        $data_6 = numeric(substr($_POST['data_6'],0,3));
        if($data_6 < 50){$data_6 = 50;}
        $data_7 = numeric(substr($_POST['data_7'],0,1));

        $check = mfa(mq('SELECT Count(*) FROM email_page_settings'));
        if($check[0] == 1){
        	mq('UPDATE email_page_settings SET
            send_to_email="'.$data_1.'",
            msg_subject="'.$data_2.'",
            email_from="'.$data_3.'",
            button_position="'.$data_4.'",
            textarea_width="'.$data_5.'",
            textarea_height="'.$data_6.'",
            show_form="'.$data_7.'"
            ');
        }else{
            mq('INSERT INTO email_page_settings SET
            send_to_email="'.$data_1.'",
            msg_subject="'.$data_2.'",
            email_from="'.$data_3.'",
            button_position="'.$data_4.'",
            textarea_width="'.$data_5.'",
            textarea_height="'.$data_6.'",
            show_form="'.$data_7.'"
            ');
        }

        $msg = $lng_pack['cms_special_items']['data_saved'];
        $msg_type = 'ok';

     }


     if($msg!=''){
       		echo '<br>'.debug_msg($msg,$msg_type,0);
       }
     $settings = mfa(mq('SELECT * FROM email_page_settings'));
       echo'
       <br>
       <table cellspacing=0 cellpadding=5 border=0>
       	<tr valign="bottom">
        	<td><img src="'.$img.$des.'em_config.gif"></td>
        </tr>
        <tr><td>

        <table cellspacing=2 cellpadding=3 border=0 width="90%">
        <form action="'.$SELF.'" method="post">
             <tr>
                   <td class="col3">'.$lng_pack[$var_2.$core]['show_form'].'</td>
                   <td class="col4">
                    <input type="hidden" name="data_7" value="0">
                    <input type="checkbox" name="data_7" value="1" ';
                    if ($settings['show_form'] == 1){echo'checked';} echo'>
                   </td>
             </tr>
             <tr>
                   <td class="col3">'.$lng_pack[$var_2.$core]['send_to_email'].'</td>
                   <td class="col4"><input type="text" name="data_1" value="'.$settings['send_to_email'].'" maxlength="150" size="27"></td>
             </tr>
             <tr>
                   <td class="col3">'.$lng_pack[$var_2.$core]['email_subject'].'</td>
                   <td class="col4"><input type="text" name="data_2" value="'.$settings['msg_subject'].'" maxlength="255" size="27"></td>
             </tr>
             <tr>
                   <td class="col3">'.$lng_pack[$var_2.$core]['from_email'].'<br>
                   <font style="font-size:9px; color:gray;">'.$lng_pack[$var_2.$core]['from_email_hint'].'</font></td>
                   <td class="col4"><input type="text" name="data_3" value="'.$settings['email_from'].'" maxlength="150" size="27"></td>
             </tr>
             <tr>
                   <td class="col3">'.$lng_pack[$var_2.$core]['send_btn_position'].'</td>
                   <td class="col4">
                   	<select name="data_4">
                    	<option value="">- '.$lng_pack[$var_2.$core]['choose'].' -</option>
                    	<option value="left" '; if($settings['button_position']=='left'){echo'selected';} echo'>'.$lng_pack[$var_2.$core]['left'].'</option>
                        <option value="center" '; if($settings['button_position']=='center'){echo'selected';} echo'>'.$lng_pack[$var_2.$core]['center'].'</option>
                        <option value="right" '; if($settings['button_position']=='right'){echo'selected';} echo'>'.$lng_pack[$var_2.$core]['right'].'</option>
                    </select>
                   </td>
             </tr>
             <tr>
                   <td class="col3">'.$lng_pack[$var_2.$core]['txt_field_width'].'</td>
                   <td class="col4">
                   <input type="text" name="data_5" value="'.$settings['textarea_width'].'" maxlength="3" size="5">
                   </td>
             </tr>
             <tr>
                   <td class="col3">'.$lng_pack[$var_2.$core]['txt_field_height'].'</td>
                   <td class="col4">
                   <input type="text" name="data_6" value="'.$settings['textarea_height'].'" maxlength="3" size="5">
                   </td>
             </tr>
             <tr valign="top">
             	<td class="col2" colspan="2"><input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/save',$expires,"/","","","").' src="img/btn/save.gif" alt="'.$lng_pack['cms_special_items']['save'].'" title="'.$lng_pack['cms_special_items']['save'].'"></td>
             </tr>
        </form>
        </table>

			</td></tr>
       </table>
       ';

    break;



    // ----------------------------------------------------------- //
    // [14] ATTELA PIEVIENOSANA CMS virtualajai galerija
    // ----------------------------------------------------------- //
    case'add_image_to_cms_vg':

	if($var_3=='add'){
    	$error = 0;
    	$postarr = $HTTP_POST_FILES['file'];
        $file = $postarr['tmp_name'];
        $dir = '../img/custom/';
        if($file!=''){

        	// mainiigo kontrole:
        	if($_POST['img_def_size']!=''){$img_def_size=numeric(substr($_POST['img_def_size'],0,3));}
            if($_POST['img_w']!=''){$img_w=numeric(substr($_POST['img_w'],0,4));}
            if($_POST['img_h']!=''){$img_h=numeric(substr($_POST['img_h'],0,4));}
            if($_POST['img_percent']!=''){$img_percent=numeric(substr($_POST['img_percent'],0,3));}

            // uzzinaam datus par uzlaadeeto atteelu:
			$arr=getImageSize($file);

            // ja ir jpg, daraam sekojosho:
			if($arr[2]==2){
              $this_img_w = $arr[0];
              $this_img_h = $arr[1];
              // uzzinaam kurus skaitlus un vai vispaa jaaresaizo atteels:
              if($img_def_size!=''){
              	$ratio = $img_def_size/100;
              	$iw_bg = round($this_img_w*$ratio);
                $ih_bg = round($this_img_h*$ratio);
              }
              elseif($img_h!=''){
              	$ratio = round(($img_h/$this_img_h),5);
                $iw_bg = round($this_img_w*$ratio);
                $ih_bg = round($this_img_h*$ratio);
              }
              elseif($img_w!=''){
              	$ratio = round(($img_w/$this_img_w),5);
                $iw_bg = round($this_img_w*$ratio);
                $ih_bg = round($this_img_h*$ratio);
              }
              elseif($img_percent!=''){
                $ratio = $img_percent/100;
              	$iw_bg = round($this_img_w*$ratio);
                $ih_bg = round($this_img_h*$ratio);
              }
              // citaadi ja nekas nav noraadiits, pazinojam ka taa nevar un neko vairaak ar failu nedaraam!
              // ja atteelu izmainiit nevajag (atstat 100%) to arii vajag noraadiit opcijaa
              // "Izmeeru mainja: piedaavaatie izmeeri", un te var tak izveeleeties 100% jeb pilnizmeera :)
              else{
              	$error = 2;
              }



			  if($iw_bg!='' && $ih_bg!='' && $error==0){

				$max_width    = $iw_bg;
				$max_height   = $ih_bg;
				$size=GetImageSize($file);
				if($max_width!=''){$ratio  = ($size[0] / $max_width);}
                elseif($max_height!=''){$ratio  = ($size[1] / $max_height);}

				$new_width    = ($size[0] / $ratio);
				$new_height   = ($size[1] / $ratio);

				$src_img = ImageCreateFromJPEG($file);
				$thumb = ImageCreateTrueColor($new_width,$new_height);
				ImageCopyResampled($thumb, $src_img, 0,0,0,0,($new_width),($new_height),$size[0],$size[1]);
                $free_fl_name = free_flname($dir,'.jpg'); // funkcijas kas atrod briivo faila nosaukumu, atrodama functions.php failaa
                $new_name = $dir.$free_fl_name.'.jpg';
				ImageJPEG($thumb,$new_name);
				ImageDestroy($src_img);
				ImageDestroy($thumb);

                $msg = $lng_pack[$var_2.$core]['img_add_success'].' <a href="'.$SELF.'" onclick="NewWin(\''.$new_name.'\',\'name\',\''.($new_width+30).'\',\''.($new_height+30).'\',\'yes\');return false;">['.$lng_pack[$var_2.$core]['preview_img'].']</a>';
                $msg_type = 'ok';
			  }
			  //else{
              //  $free_fl_name = free_flname($dir,'.jpg');
              //  $new_name = $dir.$free_fl_name.'.jpg';
              //	copy($file,$new_name) or $error=1;
              //}
            // ja ir gif vai png:
            }
            elseif($arr[2]==1 || $arr[2]==3){
            		if($arr[2]==1){
                	  $ext='.gif';
                	}else{
                	  $ext='.png';
                	}
                $free_fl_name = free_flname($dir,$ext);
                $new_name = $dir.$free_fl_name.$ext;
            	copy($file,$new_name) or $error=1;

                $msg = $lng_pack[$var_2.$core]['img_add_success'].' <a href="'.$SELF.'" onclick="NewWin(\''.$new_name.'\',\'name\',\''.($arr[0]+30).'\',\''.($arr[1]+30).'\',\'yes\');return false;">['.$lng_pack[$var_2.$core]['preview_img'].']</a>';
                $msg_type = 'ok';
            }
            // citaadi tas nav atteels un par to pazinojam:
            else{
            	$msg = $lng_pack[$var_2.$core]['unsupported_img_file'];
                $msg_type = 'error';
            }
        }
        // ja nav uzlaadeets nekaads fails:
        else{
        	$msg = $lng_pack[$var_2.$core]['no_file_uploaded'];
            $msg_type = 'error';
        }
        // ja kopeeshanas laikaa izleca errors - taatad fails nav saglabaats veixmiigi, pazinojam par to:
        if($error==1){
            $msg = $lng_pack[$var_2.$core]['img_file_copy_error'];
            $msg_type = 'error';
        }
        if($error==2){
            $msg = $lng_pack[$var_2.$core]['no_resize_data_given'];
            $msg_type = 'error';
        }
    }






    if($msg!=''){
       		echo '<br>'.debug_msg($msg,$msg_type,0).'<br>';
    }
	echo'
      <br>
      <table cellspacing=2 cellpadding=7 width=500>
      <form action="'.$SELF.'" method="post" enctype="multipart/form-data">
             <tr>
             	<td colspan=2 class="col_mtitle">'.$lng_pack[$var_2.$core]['img_adding_pretitle'].'</td>
             </tr>
			 <tr>
             	<td class="col3">'.$lng_pack[$var_2.$core]['img_file'].'
                	<br><br><font color="gray">
                    '.$lng_pack[$var_2.$core]['img_file_hint'].'
                    <br><br>'.$lng_pack[$var_2.$core]['allowed_img_types'].': jpg, gif, png
                    </font>
                </td>
             	<td class="col4" align="right"><input type="file" name="file" size=16 />&nbsp;&nbsp;&nbsp;&nbsp;</td>
             </tr>
             <tr>
             	<td class="col3">'.$lng_pack[$var_2.$core]['dimension_change'].': '.$lng_pack[$var_2.$core]['given_resize_values'].'
                	<br><br><font color="gray">
                    '.$lng_pack[$var_2.$core]['given_resize_v_hint'].'
                    <br><br>'.$lng_pack[$var_2.$core]['accept_type_warning'].'
                    </font>
                </td>
             	<td class="col4" align="right">
                    <select name="img_def_size">
                    	<option value="">&nbsp;- '.$lng_pack[$var_2.$core]['given_resize_values'].' -&nbsp;</option>
                    	<option value="10">'.$lng_pack[$var_2.$core]['micro'].', 10% '.$lng_pack[$var_2.$core]['from_original_size'].'&nbsp;</option>
                        <option value="15">'.$lng_pack[$var_2.$core]['small'].', 15% '.$lng_pack[$var_2.$core]['from_original_size'].'&nbsp;</option>
                        <option value="20">'.$lng_pack[$var_2.$core]['mediumsmall'].', 20% '.$lng_pack[$var_2.$core]['from_original_size'].'&nbsp;</option>
                        <option value="50">'.$lng_pack[$var_2.$core]['medium'].', 50% '.$lng_pack[$var_2.$core]['from_original_size'].'&nbsp;</option>
                        <option value="80">'.$lng_pack[$var_2.$core]['large'].', 80% '.$lng_pack[$var_2.$core]['from_original_size'].'&nbsp;</option>
                        <option value="100">'.$lng_pack[$var_2.$core]['fullsize'].', 100% '.$lng_pack[$var_2.$core]['from_original_size'].'&nbsp;</option>
                    </select>&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
             </tr>
             <tr>
             	<td class="col3">'.$lng_pack[$var_2.$core]['dimension_change'].': '.$lng_pack[$var_2.$core]['resize_user_values'].'
                	<br><br><font color="gray">
                    '.$lng_pack[$var_2.$core]['resize_user_val_hint'].'
                    <br><br>'.$lng_pack[$var_2.$core]['accept_type_warning'].'
                    </font>
                </td>
             	<td class="col4" align="right">
                	MAX '.$lng_pack[$var_2.$core]['width'].', px: <input type="text" name="img_w" size=4 style="padding:2px; margin:2px;" />&nbsp;&nbsp;&nbsp;&nbsp;<br>
                    MAX '.$lng_pack[$var_2.$core]['height'].', px: <input type="text" name="img_h" size=4 style="padding:2px; margin:2px;" />&nbsp;&nbsp;&nbsp;&nbsp;<br>
                    '.$lng_pack[$var_2.$core]['size_in_percents'].'&nbsp;<b>%</b>: <input type="text" name="img_percent" size=4 style="padding:2px; margin:2px;" />&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
             </tr>
             <tr>
             	<td class="col2" colspan=2>
                	<input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/add',$expires,"/","","","").' src="img/btn/add.gif" alt="'.$lng_pack['cms_special_items']['add'].'" title="'.$lng_pack['cms_special_items']['add'].'">
                </td>
             </tr>
      </form>
      </table>
      <br>
	';
    break;



    // ----------------------------------------------------------- //
    // [15] KONTAKTINFORMACIJAS LAPA, KARTES
    // ----------------------------------------------------------- //
    case'maps':



       if($var_3 == 'save'){
       	$data_1 = textareaTOdata(substr($_POST['data_1'],0,1000));
        $check = mfa(mq('SELECT Count(*) FROM maps_img'));
        if($check[0] > 0){
        	mq('UPDATE maps_img SET data="'.$data_1.'"');
        }else{
            mq('INSERT INTO maps_img SET data="'.$data_1.'"');
        }
        $msg = $lng_pack['cms_special_items']['data_saved'];
        $msg_type = 'ok';

       }



    	if($msg!=''){
       		echo '<br>'.debug_msg($msg,$msg_type,0).'<br>';
    	}
        	$row = mfa(mq('SELECT * FROM maps_img'));
       echo'
       		<form action="'.$SELF.'" method="post">
            <b>'.$lng_pack[$var_2.$core]['copy'].':</b><br>
            <br>
            <font style="font-size:9px; color:gray;">'.$lng_pack[$var_2.$core]['copy_info'].'</font>
            <br>
            <br>
            <table cellspacing=0 cellpadding=4 border=0>
            	<tr>
                	<td><textarea name="data_1" style="width:540px; height:100px;">'.dataTOtextarea($row['data']).'</textarea></td>
                </tr>
                <tr>
                	<td><input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/save',$expires,"/","","","").' src="img/btn/save.gif" alt="'.$lng_pack[$var_2.$core]['save'].'" title="'.$lng_pack[$var_2.$core]['save'].'"></td>
                </tr>

            </table>

            </form>
       ';



    break;

    // ----------------------------------------------------------- //
    // [16] FONA ATTELA PIEVIENOSANA
    // ----------------------------------------------------------- //
    case'bg_image':
    if($var_3 == '' || $var_3 < 1){
    	echo'
        <br><br>
        <b>'.ucfirst($lng_pack['cms_special_items']['choose']).':</b>
        <br><br>
        <a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/1',$expires,"/","","").'>&nbsp;&nbsp;&nbsp;Pirm&#257;s jeb s&#257;kumlapas lapa fonatt&#275;ls &raquo;</a>
        <br>
        <br>
        <a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2.'/2',$expires,"/","","").'>&nbsp;&nbsp;&nbsp;P&#257;r&#275;jo lapu fona att&#275;li &raquo;</a>
        ';
    }
    elseif($var_3 == 2){

    if($var_4 == 'add'){
		$postarr = $HTTP_POST_FILES['file'];
        $file = $postarr['tmp_name'];
        $dir = '../img/bgimg/';
        if($file!=''){

            // uzzinaam datus par uzlaadeeto atteelu:
			$arr=getImageSize($file);

            // ja ir jpg, daraam sekojosho:
			if($arr[2]==2){
              $this_img_w = $arr[0];
              $this_img_h = $arr[1];



              if($this_img_w == $allowed_w && $this_img_h == $allowed_h){
              ## $allowed_w un $allowed_h definejumi mekleejami failaa config.php!

              	## meklejam briivo faila nosaukumu..
                $tm = 1;
        		$newfile = $dir.'B'.$tm.'.jpg';
        		while(file_exists($newfile)){
                		$tm++;
                		$newfile = $dir.'B'.$tm.'.jpg';
            	}

                if( copy($file,$newfile) ){
                    $msg = $lng_pack[$var_2.$core]['file_add_success'];
            		$msg_type = 'ok';
                }else{
                    $msg = $lng_pack[$var_2.$core]['cant_copy_file'];
            		$msg_type = 'error';
                }

              }else{
                  $msg = $lng_pack[$var_2.$core]['wrong_dimensions'];
                  $msg_type = 'error';
              }

            }else{
                $msg = $lng_pack[$var_2.$core]['not_jpg_file'];
            	$msg_type = 'error';
            }

        }else{
        	$msg = $lng_pack[$var_2.$core]['no_file_submitted'];
            $msg_type = 'error';
        }
    }


    if($msg!=''){
       		echo '<br>'.debug_msg($msg,$msg_type,0).'<br>';
    }
	echo'
      <br>
      <a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2,$expires,"/","","").'>&laquo;&nbsp;'.$lng_pack['cms_special_items']['back'].'</a>
      <br><br>
      <table cellspacing=2 cellpadding=7 width=500>
      <form action="'.$SELF.'" method="post" enctype="multipart/form-data">
             <tr>
             	<td colspan=2 class="col_mtitle">'.$lng_pack[$var_2.$core]['img_adding'].'</td>
             </tr>
			 <tr>
             	<td class="col3">'.$lng_pack[$var_2.$core]['img_file'].'
                	<br><br><font color="gray">
                    '.$lng_pack[$var_2.$core]['img_file_hint'].'
                    <br>
                    <br>'.$lng_pack[$var_2.$core]['width'].': <b>'.$allowed_w.'</b> px
                    <br>'.$lng_pack[$var_2.$core]['height'].': <b>'.$allowed_h.'</b> px
                    <br>
                    <br>'.$lng_pack[$var_2.$core]['allowed_img_types'].': <b>jpg</b>
                    </font>
                </td>
             	<td class="col4" align="right"><input type="file" name="file" size=16 />&nbsp;&nbsp;&nbsp;&nbsp;</td>
             </tr>
             <tr>
             	<td class="col2" colspan=2>
                	<input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/add',$expires,"/","","","").' src="img/btn/add.gif" alt="'.$lng_pack['cms_special_items']['add'].'" title="'.$lng_pack['cms_special_items']['add'].'">
                </td>
             </tr>
      </form>
      </table>
      <br>
	';
    }
    ## elseif var_3 == 2 END


    elseif($var_3 == 1){

    $newfilename = 'first_page_bg.jpg';
    $dir = '../img/des/';
    $newfile = $dir.$newfilename;

        if($var_4 == 'add'){
		$postarr = $HTTP_POST_FILES['file'];
        $file = $postarr['tmp_name'];
        $dir = '../img/des/';
        if($file!=''){

            // uzzinaam datus par uzlaadeeto atteelu:
			$arr=getImageSize($file);

            // ja ir jpg, daraam sekojosho:
			if($arr[2]==2){
              $this_img_w = $arr[0];
              $this_img_h = $arr[1];



              if($this_img_w == $allowed_1st_w && $this_img_h == $allowed_1st_h){
              ## $allowed_w un $allowed_h definejumi mekleejami failaa config.php!

                if( copy($file,$newfile) ){
                    $msg = $lng_pack[$var_2.$core]['file_add_success'];
            		$msg_type = 'ok';
                }else{
                    $msg = $lng_pack[$var_2.$core]['cant_copy_file'];
            		$msg_type = 'error';
                }

              }else{
                  $msg = $lng_pack[$var_2.$core]['wrong_dimensions'];
                  $msg_type = 'error';
              }

            }else{
                $msg = $lng_pack[$var_2.$core]['not_jpg_file'];
            	$msg_type = 'error';
            }

        }else{
        	$msg = $lng_pack[$var_2.$core]['no_file_submitted'];
            $msg_type = 'error';
        }
    }


    if($msg!=''){
       		echo '<br>'.debug_msg($msg,$msg_type,0).'<br>';
    }
	echo'
      <br>
      <a href="'.$SELF.'" '.@locator($cookieID,$var_1.'/'.$var_2,$expires,"/","","").'>&laquo;&nbsp;'.$lng_pack['cms_special_items']['back'].'</a>
      <br><br>
      <table cellspacing=2 cellpadding=7 width=500>
      <form action="'.$SELF.'" method="post" enctype="multipart/form-data">
             <tr>
             	<td colspan=2 class="col_mtitle">'.$lng_pack[$var_2.$core]['img_adding_1stpgbg'].'</td>
             </tr>
			 <tr>
             	<td class="col3">'.$lng_pack[$var_2.$core]['img_file'].'
                	<br><br><font color="gray">
                    '.$lng_pack[$var_2.$core]['img_file_1stpgbg_hint'].$newfilename.'
                    <br>
                    <br>'.$lng_pack[$var_2.$core]['width'].': <b>'.$allowed_1st_w.'</b> px
                    <br>'.$lng_pack[$var_2.$core]['height'].': <b>'.$allowed_1st_h.'</b> px
                    <br>
                    <br>'.$lng_pack[$var_2.$core]['allowed_img_types'].': <b>jpg</b>
                    </font>
                </td>
             	<td class="col4" align="right"><input type="file" name="file" size=16 />&nbsp;&nbsp;&nbsp;&nbsp;</td>
             </tr>
             <tr>
             	<td class="col2" colspan=2>
                	<input type="image" '.@sublocator($cookieID,$var_1.'/'.$var_2.'/'.$var_3.'/add',$expires,"/","","","").' src="img/btn/add.gif" alt="'.$lng_pack['cms_special_items']['add'].'" title="'.$lng_pack['cms_special_items']['add'].'">
                </td>
             </tr>
      </form>
      </table>
      <br>
      <br>
      <a href="'.$newfile.'" target="_blank"><img src="'.$img.$des.'img_ico.gif" align="absmiddle">&nbsp;'.$lng_pack[$var_2.$core]['view_actual_img'].'</a>
	';
    }

    break;

  }


}

?>