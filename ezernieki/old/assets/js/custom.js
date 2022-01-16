jQuery(document).ready(function(){
    "use strict";
    

    //ddsmoothmenu for top-bar navigation
    ddsmoothmenu.init({
        mainmenuid: "top-nav-id", //menu DIV id
        orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
        classname: 'top-nav slideMenu', //class added to menu's outer DIV
        contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
    });

    //ddsmoothmenu for primary navigation
    ddsmoothmenu.init({
        mainmenuid: "primary-nav-id", //menu DIV id
        orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
        classname: 'primary-nav slideMenu', //class added to menu's outer DIV
        contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
});
    // Call LayerSlider
    
    jQuery('#layerslider').layerSlider({
        skinsPath : 'assets/ls_skins/',
        skin : 'fullwidth',
        thumbnailNavigation : 'disabled',
        hoverPrevNext : false,
        responsive : true,
        responsiveUnder : 1366,
        sublayerContainer : 978,
        navStartStop:false,
        imgPreload:true
    });
    
}); // END Document Ready //
