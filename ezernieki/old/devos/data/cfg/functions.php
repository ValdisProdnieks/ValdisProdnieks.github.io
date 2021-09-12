<?php
#######################
#  created by OzMax   #
# (c)2006.-2999.      #
# ozmax_dev@inbox.lv  #
# all rights reserved #
#######################
#   f.php   		  #
#   07.02.2006 v1.1	  #
#######################
#------------------------------------------------------------#

function strong_replace($str){
		$str = preg_replace("/[^a-zA-Z0-9-_@\.]/", "", $str);
        $str = trim($str);
return $str;
}

function numeric($str){
        $str=preg_replace("/[^0-9]/","",$str);
		return $str;
}

function alphab($str){
        $str=preg_replace("/[^a-zA-Z]/","",$str);
		return $str;
}

function dataTOtextarea($str){

		$str = str_replace ("<img src=",'[img=',$str);
        $str = str_replace ('<a href=','[url=',$str);
        $str = str_replace ('</a>','[/url]',$str);
        $str = str_replace ('<b>','[b]',$str);
        $str = str_replace ('</b>','[/b]',$str);
        $str = str_replace ('<i>','[i]',$str);
        $str = str_replace ('</i>','[/i]',$str);
        $str = str_replace ('<u>','[u]',$str);
        $str = str_replace ('</u>','[/u]',$str);
        $str = str_replace ('<li>','[*]',$str);
        $str = str_replace ('<hr>','[---]',$str);
        $str = str_replace ("<br>","\n",$str);
        $str = str_replace ('<font color=','[font color=',$str);
        $str = str_replace ('</font>','[/font]',$str);

		$str = str_replace ('>',']',$str);
        $str = str_replace ('&gt;','>',$str);
        $str = str_replace ('&lt;','<',$str);
        $str = str_replace ('&#038;',"&",$str);
    	$str = str_replace ('&#034;','&quot;',$str);
        $str = str_replace ('&#039;',"'",$str);
        //$str = trim($str);

        return $str;
}

function textareaTOdata($str){

		//$str = str_replace ("&",'&#038;',$str);
        $str = str_replace ('>','&gt;',$str);
        $str = str_replace ('<','&lt;',$str);
		$str = str_replace ("[img=",'<img src=',$str);
        $str = str_replace ('[url=','<a href=',$str);
        $str = str_replace ('[/url]','</a>',$str);
        $str = str_replace ('[b]','<b>',$str);
        $str = str_replace ('[/b]','</b>',$str);
        $str = str_replace ('[u]','<u>',$str);
        $str = str_replace ('[/u]','</u>',$str);
        $str = str_replace ('[i]','<i>',$str);
        $str = str_replace ('[/i]','</i>',$str);
        $str = str_replace ('[*]','<li>',$str);
        $str = str_replace ('[---]','<hr>',$str);
        $str = str_replace ('[font color=','<font color=',$str);
        $str = str_replace ('[/font]','</font>',$str);

        $str = str_replace (']','>',$str);
        $str = str_replace ("\n",'<br>',$str);
    	$str = str_replace ('"','&quot;',$str);
        $str = str_replace ("'",'&#039;',$str);
        //$str = trim($str);

        return $str;
	  //$str = str_replace ('','',$str);
}

function dataTOhtml($str){
# principa tas pats, kas dataTOtextarea, iznemot pedejo rindinu, kas ir deaktivizeta
        //$str = str_replace ('<img src=','&',$str);
        //$str = str_replace ('>',']',$str);
        //$str = str_replace ('@','<img src="img/des/pie.gif">',$str);
        $str = trim($str);
		//$str = str_replace("<br>","\n",$str);
        return $str;
}
#-----------------------------------------------------------#


	function cr($str){
    	//$str = str_replace ("&",'&amp;',$str);
    	$str = str_replace ('"','&quot;',$str);
        $str = str_replace ("'",'&#039;',$str);
        $str = str_replace ('=','&#061;',$str);
        $str = str_replace ('>','&gt;',$str);
        $str = str_replace ('<','&lt;',$str);
		$str = preg_replace("/[\"\'}{\]\[*^%$><\/~`\\|]/", "", $str);
		$str = str_replace ('\\','',$str);
        $str = str_replace ("\n",' ',$str);
        $str = str_replace ("\t",' ',$str);
        $str = str_replace ("\a",' ',$str);
        $str = str_replace ("\r",' ',$str);
        $str = str_replace ('    ',' ',$str);
        $str = str_replace ('   ',' ',$str);
        $str = str_replace ('  ',' ',$str);
        $str = trim($str);
		return $str;

	}

	function sql($not_from_CMS_dir){
    	global $devos, $data, $cfg, $ext;
    	if($not_from_CMS_dir == 1){$prefx = $devos;}
        else{$prefx = '';}
		#----------------------------#
		#  mysql uzstaadiijumi       #
		include($prefx.$data.$cfg.'hupn'.$ext);
		@$srvr = mysql_connect($h_sql,$u_sql,$p_sql) or die("Serverim piesl&#275;gties neizdev&#257;s [1]");
		@$db = mysql_select_db($n_sql, $srvr) or die("Neizdev&#257;s atv&#275;rt datub&#257;zi [2]");
		#----------------------------#
        return $srvr;
    }


    function mq($q){
    	@$res = mysql_query($q);
        return $res;
    }

    function mfa($res){
    	@$row = mysql_fetch_array($res);
        return $row;
    }

    function free_flname($dir,$ext){
        $tm = time();
        $file = $dir.$tm.$ext;
        	while(file_exists($file)){
                $tm--;
                $file = $dir.$tm.$ext;
            }
        return $tm;
    }

    function mail_protect($str,$lngid){
		if($lngid==1){
        	$str = str_replace('.','<img src="contents/images/icons/punkts.gif" alt="[punkts]"> ',$str);
        	$str = str_replace('@','<img src="contents/images/icons/pie.gif" alt="[pie]"> ',$str);
        }
        else{
        	$str = str_replace('.','<img src="contents/images/icons/punkts.gif" alt="[dot]"> ',$str);
        	$str = str_replace('@','<img src="contents/images/icons/pie.gif" alt="[at]"> ',$str);
        }
        return $str;
    }

    function debug_msg($content,$type,$notfromCMS_dir){
    	global $devos;
        if($notfromCMS_dir == 1){$prefx = $devos;}
        else{$prefx = '';}

    	$result = '<img src="'.$prefx.'img/des/'.$type.'.gif" align="absmiddle" alt="'.$type.'">&nbsp;<font class="'.$type.'">'.$content.'</font>';
        return $result;
    }

    function lv_month($month){
    	switch($month){
         case 1:  $month = 'janvâris'; break;
         case 2:  $month = 'februâris'; break;
         case 3:  $month = 'marts'; break;
         case 4:  $month = 'aprîlis'; break;
         case 5:  $month = 'maijs'; break;
         case 6:  $month = 'jûnijs'; break;
         case 7:  $month = 'jûlijs'; break;
         case 8:  $month = 'augusts'; break;
         case 9:  $month = 'septembris'; break;
         case 10: $month = 'oktobris'; break;
         case 11: $month = 'novembris'; break;
         case 12: $month = 'decembris'; break;
        }
      return $month;
    }


    function locator($name, $value, $expires, $path, $domain, $secure, $confirm_question, $event){
      if(trim($event) == ''){
      	$event = 'onclick';
      }
      $str = ' '.$event.'=\'';

      if($confirm_question != ''){
      	$str .= 'javascript: if(confirm("'.$confirm_question.'")){';
	  }

      	$str .= 'locator("'.$name.'", "'.$value.'", "'.$expires.'", "'.$path.'", "'.$domain.'", "'.$secure.'"); ';

      if($confirm_question != ''){
      	$str .= ' return true;}else{return false;}';
      }

      $str .= '\' ';

      return $str;
    }




    function sublocator($name, $value, $expires, $path, $domain, $secure, $confirm_question, $event){
      if($event == ''){
      	$event = 'onclick';
      }
      $str = ' '.$event.'=\'';

      if(isset($confirm_question) && $confirm_question != ''){
      	$str .= 'javascript: if(confirm("'.$confirm_question.'")){';
	  }

      	$str .= 'sublocator("'.$name.'", "'.$value.'", "'.$expires.'", "'.$path.'", "'.$domain.'", "'.$secure.'"); ';

      if(isset($confirm_question) && $confirm_question != ''){
      	$str .= ' return true;}else{return false;}';
      }

      $str .= '\' ';

      return $str;
    }



    // mainam bg tonus:
    function bg_changer($color){
     	if($color == '#F0F1F6'){
      		$color = '#FCFCFC';
     	}else{
      		$color = '#F0F1F6';
        }
     	return $color;
    }


    // no laika spieduma izveidojam daudzmaz
    // saprotamu datuma formatu :)
    function getTHEdate($timestamp){
    	global $lng_pack;
    	if($timestamp > 0){
            $date_arr = getdate($timestamp);

            $date .= $date_arr['year'];
            $date .= '.';
            if(strlen($date_arr['mon'])==1){
            	$date .= '0'.$date_arr['mon'];
            }else{
            	$date .= $date_arr['mon'];
            }
            $date .= '.';
            if(strlen($date_arr['mday'])==1){
            	$date .= '0'.$date_arr['mday'];
            }else{
            	$date .= $date_arr['mday'];
            }

        }else{
            $date = '<font color="gray"><&nbsp;<i>'.$lng_pack['cms_special_items']['never_used'].'</i>&nbsp;></font>';
        }
        return $date;
    }


?>