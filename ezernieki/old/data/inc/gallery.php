<?php

// settings, cik mapes radam  viena rinda (tad parcelot uz nakamo, "tr") atverot sadalu galerija:
$folders_in_row = 3;

// kontrolejam, lai netiktu atainotas tuksas mapes (query_string hakeri lai iet guleet :) :
if($folderID > 0){
	$check = mfa(mq('SELECT Count(*) FROM gl_images WHERE gl_folderID = "'.$folderID.'"'));
    if($check[0] < 1){
    	$folderID = '';
        $photoID = '';
    }
}

$gallery_settings = mfa(mq('SELECT * FROM gl_settings'));
//$page_data = mfa(mq('SELECT content FROM pages WHERE catID="'.$catID.'" AND wwwlngID="'.$lngID.'"'));

    $tr_ctrl = 0;

    echo'<a name="view"></a><table cellspacing=0 cellpadding=10 border=0 width="100%" height="'.$allowed_h.'">';

  // vispirms radam visas mapes, lai juuzeris var kau4 ko izveeleeties :)
  if($folderID == 0){

	$gallery_res = mq('SELECT * FROM gl_folders ORDER BY position DESC');

    while( $gallery_row = mfa($gallery_res) ){
    	$folder_description = mfa(mq('SELECT * FROM gl_folder_description WHERE gl_folderID = "'.$gallery_row['gl_folderID'].'" AND wwwlngID = "'.$lngID.'"'));


        if($tr_ctrl == 0){ echo'<tr>';}


            $tm_img_arr = array();
        	$img_res = mq('SELECT gl_imgID FROM gl_images WHERE gl_folderID = "'.$gallery_row['gl_folderID'].'"');
            $img_real_count = mysql_num_rows($img_res);
        	$img_count = -1;
        	while($img_row = mfa($img_res)){
        		array_push($tm_img_arr,$img_row['gl_imgID']);
            	$img_count++;
        	}

        	$rnd_img_arrNR = mt_rand(0,$img_count);
            $rnd_imgID = $tm_img_arr[$rnd_img_arrNR];
            $getIMG = @getimagesize('img/gallery/'.$rnd_imgID.'_sm.jpg');
            $no_photos = 0;
            if($img_real_count > 0){

             if($getIMG[0] < 59){
            	if($getIMG[0] < 1){
                	$imgfile = 'img/des/no_photos.jpg';
                    $getIMG = @getimagesize('img/des/no_photos.jpg');
                    $no_photos = 1;
                }else{
            		$getIMG[0] = 59;
                }
             }
             else{
            	$imgfile = 'img/gallery/'.$rnd_imgID.'_sm.jpg';
             }
            }else{
                    $imgfile = 'img/des/no_photos.jpg';
                    $getIMG = @getimagesize('img/des/no_photos.jpg');
                    $no_photos = 1;
            }
         echo'
         <td width="'.round($table_w/$folders_in_row).'" align="center">
          <table cellspacing=0 cellpadding=0 border=0>
              <tr>
                    <td background="'.$img.$des.'folder_1_1.gif" width="20" height="21" style="background-repeat:no-repeat; background-position: left top;"></td>
                    <td background="'.$img.$des.'folder_2_1_1.gif" width="25" height="21" style="background-repeat:no-repeat; background-position: left top;"></td>
                    <td background="'.$img.$des.'folder_2_1_2.gif" width="'.($getIMG[0]-25).'" height="21" style="background-repeat:repeat-x; background-position: left top;"></td>
                    <td background="'.$img.$des.'folder_3_1.gif" width="19" height="21" style="background-repeat:no-repeat; background-position: right top;"></td>
              </tr>
              <tr>
                    <td background="'.$img.$des.'folder_1_2.gif" width="20" height="58" style="background-repeat:repeat-y; background-position: left top;"></td>
                    <td colspan="2" bgcolor="#FFFFFF">';
                    if($no_photos == 0){
                    	echo'<a href="?catID='.$catID.'&lngID='.$lngID.'&folderID='.$gallery_row['gl_folderID'].'&photoID='.$rnd_imgID.'#view">';
                    }
                    echo'<img src="'.$imgfile.'" width="'.$getIMG[0].'" height="'.$getIMG[1].'">';
                    if($no_photos == 0){
                    	echo'</a>';
                    }
                    echo'</td>
                    <td background="'.$img.$des.'folder_3_2.gif" width="19" height="58" style="background-repeat:repeat-y; background-position: right top;"></td>
              </tr>
              <tr>
                    <td background="'.$img.$des.'folder_1_3.gif" width="20" height="19" style="background-repeat:no-repeat; background-position: left top;"></td>
                    <td colspan="2" background="'.$img.$des.'folder_2_3.gif" width="59" height="19" style="background-repeat:repeat-x; background-position: left top;"></td>
                    <td background="'.$img.$des.'folder_3_3.gif" width="19" height="19" style="background-repeat:no-repeat; background-position: right top;"></td>
              </tr>
          </table>';
          if($no_photos == 0){
            echo'<a style="text-decoration:none;" href="?catID='.$catID.'&lngID='.$lngID.'&folderID='.$gallery_row['gl_folderID'].'#view">';
          }
          echo'<b>'.$folder_description['title'].'</b>';

                     if($gallery_settings['show_fl_creation_date'] == 1){
                     	echo'
                     	<br><font style="font-size:8px; color:gray;">'.getTHEdate($gallery_row['created']).'</font>
                        ';
                     }

          if($no_photos == 0){
            echo'</a>';
          }
                     echo'
         </td>
         ';
         $tr_ctrl++;

         if($tr_ctrl == $folders_in_row){
         	echo'</tr>';
         	$tr_ctrl = 0;
         }

    }
    ## WHILE mapju cikls END

  }
  // mapju saraxts END



  ## ja ir izveleta kada mape, sakam skatiit taas saturu :)
  else{
  	 $folder_description = mfa(mq('SELECT * FROM gl_folder_description WHERE gl_folderID = "'.$folderID.'" AND wwwlngID = "'.$lngID.'"'));
     $gallery_row = mfa(mq('SELECT created FROM gl_folders WHERE gl_folderID = "'.$folderID.'"'));

     $img_res = mq('SELECT gl_imgID FROM gl_images WHERE gl_folderID = "'.$folderID.'" ORDER BY gl_imgID DESC');
     $img_count = mysql_num_rows($img_res);
     $img_per_page = $gallery_settings['thumbs_vert_per_page'] * $gallery_settings['thumbs_hori_per_page'];


     if($photoID == ''){
     	$first_img = mfa(mq('SELECT gl_imgID FROM gl_images WHERE gl_folderID = "'.$folderID.'" ORDER BY gl_imgID DESC LIMIT '.$from.',1'));
        $photoID = $first_img['gl_imgID'];
     }

     if($photoID != ''){
        $i = 0;
        $ctrl = 0;
        $found = 0;
     	while($img_row = mfa($img_res)){

         if($found == 1){
        	$next_imgID = $img_row['gl_imgID'];
            break;
         }

            if($ctrl == $i){
            	$i = $i + $img_per_page;
            }

        	if($img_row['gl_imgID'] == $photoID){
            	$from = $i - $img_per_page;
                $found = 1;
            //break;
            }
            elseif($found == 0){
            	$previous_imgID = $img_row['gl_imgID'];
            }

        $ctrl++;
        }
     }



     echo'<tr valign="top">
     		<td width="25%">';

     echo'<table cellspacing=0 cellpadding=10 border=0 width="100%">
               <tr>
                     <td background="'.$img.$des.'folder1_tint.gif" height="52" style="padding-left:20px; padding-top:15px; background-repeat:no-repeat; background-position: left top;">
                     <a style="text-decoration:none;" href="?catID='.$catID.'&lngID='.$lngID.'&folderID='.$folderID.'&from=0#view"><font style="font-size:13px;"><b>'.$folder_description['title'].'</b></font></a>';
                     if($gallery_settings['show_fl_creation_date'] == 1){
                     	echo'
                     	<br><font style="font-size:8px; color:gray;">'.getTHEdate($gallery_row['created']).'</font>
                        ';
                     }
                     echo'<br><br>
                     </td>
               </tr>';
               	if($folder_description['description'] != ''){
                	echo'<tr><td style="border:1px solid #CFCFCB;" bgcolor="#F4F2F0"><p align="justify">
                    '.$folder_description['description'].'
                    </p></td></tr>';
                }
               echo'
               <tr>
               	<td><br><a style="text-decoration:none;" href="?catID='.$catID.'&lngID='.$lngID.'"><img src="'.$img.$des.'back_to_folders.gif" alt=" [ ],[ ],[ ] <-- "></a></td>
               </tr>
          </table>

          </td>
          <td width="75%">

     <center>';

     $img_description = mfa(mq('SELECT description FROM img_description WHERE gl_imgID = "'.$photoID.'" AND wwwlngID = "'.$lngID.'"'));

     echo'
     <table cellspacing=2 cellpadding=2 border=0>
          <tr>
                <td align="center">';
                if($next_imgID > 0){
                  echo'<a style="text-decoration:none;" href="?catID='.$catID.'&lngID='.$lngID.'&folderID='.$folderID.'&from='.$from.'&photoID='.$next_imgID.'#view" title=" &raquo; ">';
                }else{
                  echo'<a style="text-decoration:none;" href="?catID='.$catID.'&lngID='.$lngID.'&folderID='.$folderID.'&from=0#view" title=" * ">';
                }
                echo'<img src="'.$img.'gallery/'.$photoID.'.jpg" style="border: 1px solid #CFCFCB">';
                if($next_imgID > 0){
                  echo'</a>';
                }
                echo'</td>
          </tr>';
          // '.$img_description['description'].'
          //if($img_description != ''){
          	echo'
             <tr>
                <td align="center">
                 <table cellspacing=0 cellpadding=0 border=0 width="'.$gallery_settings['def_full_width'].'">
                     <tr valign="top">
                           <td width="5%">';
                           if($previous_imgID > 0){
                           echo'
                           <a style="text-decoration:none;" href="?catID='.$catID.'&lngID='.$lngID.'&folderID='.$folderID.'&from='.$from.'&photoID='.$previous_imgID.'#view">&nbsp;<img src="'.$img.$des.'prev_a.gif" alt=" &laquo; ">&nbsp;&nbsp;</a>
                           ';
                           }else{
                           echo'<font color="#E7E8C8">&nbsp;<img src="'.$img.$des.'prev_ina.gif" alt=" &laquo; ">&nbsp;</font>';
                           }

                           echo'</td>
                           <td width="90%" align="center">';
                           if($img_description['description'] != ''){
                           	echo'
                             <table cellspacing=0 cellpadding=2 width="92%" style="border:1px solid #CBD8CB;" bgcolor="#F1F8F7">
                                <tr>
                                      <td><p style="font-size:10px; color:#808080;" align="justify">'.$img_description['description'].'</p></td>
                                </tr>
                             </table>
                            ';
                           }
                           echo'
                           </td>
                           <td width="5%" align="right">
                           ';
                           if($next_imgID > 0){
                           echo'
                           <a style="text-decoration:none;" href="?catID='.$catID.'&lngID='.$lngID.'&folderID='.$folderID.'&from='.$from.'&photoID='.$next_imgID.'#view">&nbsp;&nbsp;<img src="'.$img.$des.'next_a.gif" alt=" &raquo; ">&nbsp;</a>
                           ';
                           }else{
                           echo'<font color="#E7E8C8">&nbsp;<img src="'.$img.$des.'next_ina.gif" alt=" &raquo; ">&nbsp;</font>';
                           }
                           echo'
                           </td>
                     </tr>
                 </table>
                </td>
          	 </tr>
            ';
          //}
          echo'
     </table>

     <table cellspacing=0 cellpadding=8 border=0>
     	<tr>
        	<td align="center">';

     $i = 0;
     while($i < $img_count){

        			$i = $i + $img_per_page;
                   	if($i > $img_count){
                    	$max_to = $img_count;
                    }else{
                        $max_to = $i;
                    }

                   		echo'<a style="background-color:';
                        	if(($i -  $img_per_page) == $from){
                            	echo'#F5DBAF';
                            }else{
                        		echo'#DDEDEA';
                            }
                    echo';" href="?catID='.$catID.'&lngID='.$lngID.'&folderID='.$folderID.'&from='.($i-$img_per_page).'#view" >'.($i-$img_per_page+1).'-'.$max_to.'</a> ';


     }


     echo'</td>
     	</tr>
     </table>
     <table cellspacing=10 cellpadding=10 border=0>';

     $img_res = mq('SELECT gl_imgID FROM gl_images WHERE gl_folderID = "'.$folderID.'" ORDER BY gl_imgID DESC LIMIT '.$from.', '.$img_per_page);


     $tr_ctrl = 0;
     while($img_row = mfa($img_res)){
     	$tr_ctrl++;
     	if($tr_ctrl == 1){ echo'<tr valign="middle">'; }

        	echo'<td style="border:1px solid #CFCFCB;" bgcolor="#FFFDDD" align="center">
            <a href="?catID='.$catID.'&lngID='.$lngID.'&folderID='.$folderID.'&from='.$from.'&photoID='.$img_row['gl_imgID'].'#view"><img src="'.$img.'gallery/'.$img_row['gl_imgID'].'_sm.jpg"></a>
            </td>';

        if($tr_ctrl == $gallery_settings['thumbs_hori_per_page']){echo'</tr>'; $tr_ctrl = 0;}
     }

     echo'
     	  </table>
     </center>
     	</td>
          </tr>';
  }
  ## ja ir izveleta kada mape, sakam skatiit taas saturu :) END


    echo'</table>';


?>