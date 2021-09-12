<?php
# AUTHOR ##################
#  Created by "ozmax dev" #
# (c)2006.-2999.          #
# ozmax_dev@inbox.lv      #
# http://ozmax.uninet.lv  #
# all rights reserved     #
###########################

# ABOUT FILE ####################################
#   File name:                                  #
#   	index.php                               #
#	Version and build date:                     #
#       v1.2, 30.06.2006	                    #
#################################################
## !!! PLEASE DO NOT DELETE NOTHING ABOVE !!!  ##
#################################################

session_start();
unset($msg);

	// ieklaujam konfiguraciju (prefix, suffix u.c.) failu:
	include('devos/data/cfg/config.php');


    // ieklaujam "ozmax made" php funkciju failu:
    include($devos.$data.$cfg.'functions'.$ext);




    // ienaakosho mainiigo kontrole:
	if($_GET['action']!=''){
    	$action = strong_replace(substr($_GET['action'],0,20));
    }



	// sledzamies klat pie MySQL servera, 1 - jo neesam devos mapee:
    $srvr = sql(1);


    // paarbaudaam vai pieprasiitaa kategorija existee, ja ir kau4 kas zinaams, ja esam CMS'aa, shito nepaarbaudaam :)
    if($_GET['catID']!=''){
    	$catID = numeric(substr($_GET['catID'],0,5));
    }

    if($_SESSION['userID'] == ''){
      // 0 = devos autorizacijas lapa
      if($catID != '' && $catID != 0){
    	$check = mfa(mq('SELECT Count(*) FROM menu_categorys WHERE catID="'.$catID.'" AND is_active="1"'));
        if($check[0] < 1){$catID = '';}
      }
    }
    // ja kategorija neexistee vai arii tikko atnaacaam uz muusu lapu, paraadaam pirmo peec savas poziicijas lapu (position)
    if($catID == ''){
        $whereCOND = '';
        if($_SESSION['userID'] == ''){$whereCOND = 'WHERE is_active="1"'; }

    	$first_item = mfa(mq('SELECT MIN(position) FROM menu_categorys '.$whereCOND));
        $found_catID = mfa(mq('SELECT catID FROM menu_categorys WHERE position="'.$first_item[0].'"'));
        if($found_catID['catID'] >= 1){
			header("location: ".$our_site_url."/?catID=".$found_catID['catID']);
    		exit;
        }else{
        	$no_category = 1;
        }
	}


    // valodu kontrole, atkal jau ja esam CMS'aa varam izveeleeties arii valodu, kas "nav publiski pieejama" :)))
    if($_GET['lngID']!=''){
    	$lngID = numeric(substr($_GET['lngID'],0,3));
    }

    if($_SESSION['userID'] == ''){
      if($lngID != ''){
        $check = mfa(mq('SELECT Count(*) FROM www_languages WHERE is_active = "1" AND wwwlngID="'.$lngID.'"'));
        if($check[0] < 1){$lngID = '';}
      }
    }
    // ja valoda neeksistee vai arii tikko atnaacaam uz muusu lapu, kaa valodu izmantojam pirmo pec alfabeta valodu
    if($lngID == ''){
        $found_lngID = mfa(mq('SELECT wwwlngID FROM www_languages WHERE is_active = "1" AND is_default = "1"'));
        $lngID = $found_lngID['wwwlngID'];

        if($lngID < 1){
          $found_lngID = mfa(mq('SELECT wwwlngID FROM www_languages WHERE is_active = "1" ORDER BY wwwlngID ASC LIMIT 0,1'));
          $lngID = $found_lngID['wwwlngID'];
        }

        if($lngID < 1){
        	$no_active_language = 1;
        }

    }





    // ieklaujam DEVOS'a valodas paku - masiivu (tikai, ja tiek raadiits "login" logs!!):
    if($catID == 0 && $_SESSION['userID']==''){

    	if(!file_exists($devos.$data.$lng_dir.$devos_lng.$ext)){
			die('Could not find "'.$devos_lng.'" language module in required location!');
    		exit;
		}
   		else{
			include($devos.$data.$lng_dir.$devos_lng.$ext);
		}



    	// ja postojaam autorizacijas datus no formas, tad ieklaujams attiecigi autorizacijas skriptu:
		if(isset($_POST['submit_authorize'])){
    		include($devos.$data.$inc.'authorize_script'.$ext);
    	}

    }





	include($data.$inc.'header'.$ext);


	include($data.$inc.'body'.$ext);



    // atvadamies no MySQL servera:
    mysql_close($srvr);



?>