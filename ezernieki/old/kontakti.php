<?php
$error = false;
$success = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email_to = "info@ezernieki.lv";
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $subject = "Ezernieki.lv kontaktu forma: '".$_POST['subject']."'";
    $message = "No: ".$name.",\r\nTelefons: ".$phone.",\r\nE-pasts: ".$email.",\r\n\r\n".$_POST['message'];

    if ($name !=null || $phone !=null || $email !=null || $subject !=null || $message !=null) {
        $headers = "From: info@ezernieki.lv\r\n".
        "Reply-To: ".$email."\r\n'" .
        "X-Mailer: PHP/" . phpversion();
        mail($email_to, $subject, $message, $headers);  
        $error = false;
        $success = true;
    } else {
        $success = false;
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <!-- Title Tag
    ========================================================================= -->
    <title>Ezernieki.lv</title>

    <!-- Browser Specical Files
    ========================================================================= -->
    <!--[if lt IE 9]><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    
    <!-- Site Favicon
    ========================================================================= -->
    <link rel="shortcut icon" href="#" title="Favicon" />

    <!-- WP HEAD
    ========================================================================= -->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,400italic,500,500italic,700,700italic,900,900italic,300italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>    
    <link rel="stylesheet" href="assets/css/layerslider.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/skins/brown.css">

    <!-- Browser Specical File-->
    <!--[if IE 8]><link href="assets/css/ie8.css" rel="stylesheet" type="text/css" /><![endif]-->
    
    <!-- JavaScript -->
    <script src="assets/js/jquery-1.9.1.min.js"></script>
    <link rel="stylesheet" href="assets/js/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
    <script type="text/javascript" src="assets/js/fancybox/jquery.fancybox.pack.js"></script>

    <script>
    $(document).ready(function() {
        $('.fancybox').fancybox();

    });
    </script>

</head>
<body>

<div class="body-outer-wrapper">
    <div id="body-wrapper" class="body-wrapper full-width-mode">
        
        <header id="header" class="header-container-wrapper">

            <div class="top-bar-outer-wrapper">
                <div class="top-bar-wrapper container">
                    <div class="row">
                        <div class="top-bar-left left">
                            <nav id="top-nav-id" class="top-nav slideMenu">
                                <!--<ul>
                                    
                                    <li><a href="#"><img class="iclflag" src="assets/images/flags/lv.png" alt=""> Latvian</a>
                                        <ul>
                                            <li><a href="#"><img class="iclflag" src="assets/images/flags/uk_.png" alt=""> English</a></li>
                                            <li><a href="#"><img class="iclflag" src="assets/images/flags/ru.png" alt=""> Russian</a></li>
                                            <li><a href="#"><img class="iclflag" src="assets/images/flags/de.png" alt=""> German</a></li>
                                        </ul>
                                    </li>
                                </ul>-->
                            </nav>
                        </div>
                        <div class="top-bar-right right">
                            <ul class="top-bar-contact">
                                <li class="top-bar-address">Viesu nams "Ezernieki" atrodas C??su rajon??, Aug??l??gatn?? -  <a href="kontakti.html">Skat??t karti</a></li>
                                <li class="top-bar-phone">Telefons: <span>+371 26592550 </span></li>
                            </ul>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div><!-- END .top-bar-wrapper -->
            </div> <!-- END .top-bar-outer-wrapper -->
            <div class="header-outer-wrapper">
                <div class="header-wrapper container">
                    <div class="row">
                        <div class="twelve columns b0">
                            <div class="header-left left">
                                <div class="logo-wrapper">
                                    <h1><a href="index.html"><img src="assets/images/logo.png" alt="Hotec Hotel Template"></a></h1>
                                </div>
                            </div>
                            <div class="header-right right">
                                <nav id="primary-nav-id" class="primary-nav slideMenu">
                                    <ul>
                                        <li><a href="index.html">S??kums</a></li>
                                        <li><a href="viesu-nams.html">Lielais viesu nams</a></li>
                                        <li><a href="pakalpojumi.html">Pakalpojumi</a></li>
                                        <li><a href="galerija.html">Galerija</a></li>
                                        <li class="current-menu-item"><a href="kontakti.php">Kontakti</a></li>
                                    </ul>
                                </nav>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div><!-- END .header-wrapper -->
            </div><!-- END .header-outer-wrapper -->
        </header> <!-- END .header-container-wrapper -->

        <div class="titlebar-outer-wrapper titlebar-map">
        <style>
                  #map_canvas {
                    width: 100%;
                    height: 100%;
                  }
                </style>
        <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
                <script>
                function initialize() {
                  var myLatlng = new google.maps.LatLng(57.197460, 25.009996);
                  var mapOptions = {
                    zoom: 12,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                  }
                  var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

                  var marker = new google.maps.Marker({
                      position: myLatlng,
                      map: map,
                      title: 'Ezernieki'
                  });
                }

                google.maps.event.addDomListener(window, 'load', initialize);

                </script>
                <div id="map_canvas">         
            </div>
            <div class="shadow-box"></div>
        </div>

         <div class="main-outer-wrapper has-titlebar">
            <div class="main-wrapper container">
                <div class="row row-wrapper">
                    <div class="page-outer-wrapper">
                        <div class="page-wrapper twelve columns no-sidebar b0">
                            
                            <div class="row">
                                <div class="twelve columns b0">
                                    <div class="page-title-wrapper">
                                        <h1 class="page-title left">Sazinieties ar mums!</h1>
                                        <div class="page-title-alt right">
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="content-wrapper eight columns">
                                    
                                    <div class="text-content">
                                        
                                        <form id="contact_form" name="contact_form" method="post" action="">
                                            <div class="row">
                                                <div class="six columns b0">
                                                    <div class="form-row field_text">
                                                        <label for="contact_name">J??su v??rds </label><em>*</em><br>
                                                        <input id="contact_name" class="input_text required" type="text" value="" name="name">
                                                    </div>
                                                    <div class="form-row field_text">
                                                        <label for="contact_phone">J??su telefons </label><em>*</em><br>
                                                        <input id="contact_phone" class="input_text" type="text" value="" name="phone">
                                                    </div>
                                                </div>
                                                <div class="six columns b0">
                                                    <div class="form-row field_text">
                                                        <label for="contact_email">J??su ??-pasts </label><em>*</em><br>
                                                        <input id="contact_email" class="input_text required" type="text" value="" name="email">
                                                    </div>
                                                    <div class="form-row field_text">
                                                        <label for="contact_subject">T??ma </label><em>*</em><br>
                                                        <input id="contact_subject" class="input_text required" type="text" value="" name="subject">
                                                    </div>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="form-row field_textarea">
                                                <label for="contact_message">Zi??a: </label><br>
                                                <textarea id="contact_message" class="input_textarea required" type="text" value="" name="message"></textarea>
                                            </div>
                                            <div class="form-row field_submit">
                                                <input type="submit" value="S??t??t zi??u" id="contact_submit" class="btn btn_orange">
                                                <span class="loading hide"><img src="assets/images/loader.gif"></span>
                                            </div>
                                            <div class="form-row notice_bar">
                                                <p class="notice notice_ok <?php if(!$success) echo "hide";?>">J??su zi??a nos??t??ta. M??s ar jums sazin??simies tuv??kaj?? laik??.</p>
                                                <p class="notice notice_error <?php if(!$error) echo "hide";?>">P??rliecinies, ka visi lauki ir aizpild??ti, un m????ini velreiz.</p>
                                            </div>
                                        </form> <!-- END #contact_form -->



                                    </div> <!-- END .text-content -->
                                </div>
                                 
                                <div class="sidebar right-sidebar-wrapper four columns">
                                    
                                    <div class="widget-container widget-text" id="widget-ID-name">
                                        <h3 class="widgettitle">Kontaktinform??cija</h3>
                                        <div class="widget-content">
                                            <div class="contact-text">
                                                <ul>
                                                    <li>
                                                        <h5>Adrese:</h5>
                                                        <span>
                                                            Ezernieki, Aug??l??gatne,
                                                            <br>
                                                            L??gatnes novads, Latvija, LV-4108
                                                            <br><a title="Map &amp; Directions" href="#">Kordin??tes kart??</a><br><br>
                                                            <a class="fancybox" href="assets/images/map.jpg"><img src="assets/images/map-small.jpg"></a>
                                                        </span>
                                                        <div class="clear"></div>
                                                    </li>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="widget-container widget-text" id="widget-ID-name">
                                        <h3 class="widgettitle">Rezerv??cija</h3>
                                        <div class="widget-content">
                                            <div class="contact-text">
                                                <ul>
                                                    
                                                    <li>
                                                        <h5>Telefons:</h5>
                                                        <span>+371 26592550 </span>
                                                        <div class="clear"></div>
                                                    </li>
                                                    <li>
                                                        <h5>??-pasts:</h5>
                                                        <span>info@ezernieki.lv </span>
                                                        <div class="clear"></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    

                                    
                                </div>
                                <div class="clear"></div>
                            </div> <!-- END .row -->

                        </div> <!-- END .page-wrapper -->
                        <div class="clear"></div>

                    </div> <!-- END .page-outer-wrapper -->
                </div>
            </div> <!-- END .main-wrapper -->

            
           
            

        </div> <!-- END .main-outer-wrapper -->

        <footer id="footer" class="footer-outer-wrapper">
            <div class="footer-wrapper container">
                <div class="footer-copyright-wrapper row">
                    <div class="twelve columns">
                        <div class="footer-copyright">
                            <div class="copy-left left">
                                Visas ties??bas aiz??emtas @ 2014
                            </div>
                            <div class="copy-social right">
                                Atp??tas komplekss "Ezernieki" - www.ezernieki.lv
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div> <!-- END .footer-wrapper -->
        </footer> <!-- END .footer-outer-wrapper -->


    </div><!-- END .body-wrapper -->
</div><!-- END .body-outer-wrapper -->
	

    <!-- Javascript -->
    
    <script src="assets/js/ddsmoothmenu.js"></script>
    <script src="assets/js/purl.js"></script>
    <script src="assets/js/jquery.prettyPhoto.js"></script>
    <script src="assets/js/jquery.fitvids.js"></script>
    <script src="assets/js/jquery.imagesloaded.min.js"></script>
    <script src="assets/js/jquery.isotope.min.js"></script>

    <!-- Included LayerSlider -->
    <script src="assets/js/jquery-easing-1.3.js"></script>
    <script src="assets/js/jquery-transit-modified.js"></script>
    <script src="assets/js/layerslider.transitions.js"></script>
    <script src="assets/js/layerslider.kreaturamedia.jquery.js"></script>
    
    <script type='text/javascript'>
    /* <![CDATA[ */
    var FS = {"animation":"slide","pauseOnHover":"true","controlNav":"true","directionNav":"false","animationDuration":"500","slideshowSpeed":"5000","pauseOnAction":"false"};
    /* ]]> */
    </script>

    <script src="assets/js/jquery.flexslider.js"></script>
    <script src="assets/js/jquery-ui.datepicker.js"></script>
    <script src="assets/js/shortcodes.js"></script>
    <script src="assets/js/custom.js"></script>

</body>
</html>