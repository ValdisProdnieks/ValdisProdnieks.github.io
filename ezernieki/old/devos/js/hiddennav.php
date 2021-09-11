<?php

// ieklaujam konfiguraciju (prefix, suffix u.c.) failu:
include('../data/cfg/config.php');

error_reporting(0);
// sho lapu atlaujam apskatiit (ieladet) tikai juuzeriem, kas naak (referojas) no "muusu lapas".
// ja naak no kaadas citas vai "tukshas" jeb pa taisno lauzhaas caur adreses rindu - paraadaam citu
// javascript kodu :)) ar tadu jauku alertinu :)))

$referer_from = $_SERVER['HTTP_REFERER'];

// sintakse: eregi(ko meklejam,kur meklejam);
//if(eregi($our_site_url,$referer_from) && $referer_from!=''){
if(1==1){
echo'
function locator(name, value, expires, path, domain, secure){
	if(navigator.cookieEnabled){

		document.cookie = name + "=" + escape(value) +
        ((expires) ? "; expires=" + expires : "") +
        ((path) ? "; path=" + path : "") +
        ((domain) ? "; domain=" + domain : "") +
        ((secure) ? "; secure" : "");
		parent.location=\'./\';




    }else{
    	alert(\'Cookies is DISABLED!\nPlease enable cookies to continue session!\');
    }
}

function sublocator(name, value, expires, path, domain, secure){
	if(navigator.cookieEnabled){

		document.cookie = name + "=" + escape(value) +
        ((expires) ? "; expires=" + expires : "") +
        ((path) ? "; path=" + path : "") +
        ((domain) ? "; domain=" + domain : "") +
        ((secure) ? "; secure" : "");
		return true;




    }else{
    	alert(\'Cookies is DISABLED!\nPlease enable cookies to continue session!\');
        return false;
    }
}
';
}
// ja nav "muuseejais" referalis - pasakam par to, arii navigacija muusu lapaa liidz ar to nav iespeejama..
else{
echo'
function locator(){

}
';
}

?>