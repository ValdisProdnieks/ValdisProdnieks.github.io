<?php

if($_GET['from'] > 0){
 $from = numeric(substr($_GET['from'],0,10));
}else{
 $from = 0;
}

// limitators - shito droshi var mainiit. Raada cik jaunumi var buut vienaa lapaa, tad tos attieciigi sasplitojot pa lapaspuseem
$items_per_page = 4;

$items_count = mfa(mq('SELECT Count(*) FROM whatsnew WHERE wwwlngID="'.$lngID.'"'));

//$arr = getimagesize($img.'bgimg/'.$bg_img['img_file']);
echo'<br>
<table cellspacing=0 cellpadding=0 border=0 width="100%" height="528">
     <tr valign="top">
           <td align="center" background="'.$img.$des.'whatsnew_deco.jpg" style="background-repeat:no-repeat; background-position:bottom left;">

<table cellspacing=0 cellpadding=2 border=0>
     <tr><td>
';

  if($items_count[0] > $items_per_page){
     $i = 0;
     while($i < $items_count[0]){

        			$i = $i + $items_per_page;
                   	if($i > $items_count[0]){
                    	$max_to = $items_count[0];
                    }else{
                        $max_to = $i;
                    }

                   		echo'<a style="text-decoration:none; background-color:';
                        	if(($i -  $items_per_page) == $from){
                            	echo'#F5DBAF';
                            }else{
                        		echo'#DDEDEA';
                            }
                    echo';" href="?catID='.$catID.'&lngID='.$lngID.'&from='.($i-$items_per_page).'" >'.($i-$items_per_page+1).'-'.$max_to.'</a> ';


     }
  }



echo'
     </td></tr>
</table>';
$page_data_res = mq('SELECT * FROM whatsnew WHERE wwwlngID="'.$lngID.'" ORDER BY whatsnewID DESC LIMIT '.$from.','.$items_per_page);

$item_NR = $from;

while($data_row = mfa($page_data_res)){
$item_NR++;
echo'
<table cellspacing=0 cellpadding=0 border=0 width="50%" bgcolor="#FFFEEC">
     <tr valign="top">
           <td width="78%" align="left" style="padding:5px; padding-top:10px;">
            <font color="#C0C0C0" style="font-size:13px;">#'.$item_NR.'</font>&nbsp;&nbsp;<font style="font-size:13px; font-weight:bold;">'.$data_row['title'].'</font>
           </td>
           <td width="22%" align="center" style="padding:5px; padding-top:10px;">
           <font color="gray"><i>'.$data_row['date'].'</i></font>
           </td>
     </tr>
     <tr>
            <td colspan="2" align="left" style="padding:5px;">
             <p align="justify">'.$data_row['content'].'</p>
            </td>
     </tr>
</table>
<hr width="50%">
';
}
  if($items_count[0] > $items_per_page){
     $i = 0;
     while($i < $items_count[0]){

        			$i = $i + $items_per_page;
                   	if($i > $items_count[0]){
                    	$max_to = $items_count[0];
                    }else{
                        $max_to = $i;
                    }

                   		echo'<a style="text-decoration:none; background-color:';
                        	if(($i -  $items_per_page) == $from){
                            	echo'#F5DBAF';
                            }else{
                        		echo'#DDEDEA';
                            }
                    echo';" href="?catID='.$catID.'&lngID='.$lngID.'&from='.($i-$items_per_page).'" >'.($i-$items_per_page+1).'-'.$max_to.'</a> ';


     }
  }

echo'

           </td>
     </tr>
</table>
';
?>