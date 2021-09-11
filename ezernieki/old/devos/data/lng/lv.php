<?php
##
## "DEVOS" CMS language pack -> "lv" (latvian)
## version: 1.0
## build date: 27.05.2006
## created & copyrighted 2006-2999 (c) Oskars Lasijevskis, "ozmax dev" team
## email: ozmax_dev@inbox.lv, web: http://ozmax.uninet.lv
##

// charseta kontrole:
$web_charset 	= 'utf-8';


// menu sadalas tipi
$menu_content_type = array(
	"page" 		=> "lapa",
	"gallery"   => "galerija",
    "contacts"	=> "kontakti",
    "whatsnew"	=> "jaunumi",
    "mealmenu"	=> "&#275;dienkarte"
);


// visa lielaa valodas paka:
$lng_pack = array(
    "authorize_form" 			=>	array(
    	"form_title"     		=>	"\"DEVOS\" CMS autoriz&#257;cijas logs",
        "login"			    	=>  "Logins",
        "password"				=>  "Parole",
        "login_btn"				=>  "IEIET"
    ),
    "authorize_script" 			=>	array(
        "incorrect_p_or_l"  	=>	"Nepareizs logins vai parole",
        "empty_p_or_l"			=>  "Nav nor&#257;d&#299;ts logins vai parole"
    ),
    "cms_menu"			    	=>  array(

    	"menu_control"      	=>  "Izv&#275;lne",
        "menu_management"		=>  "Mened&#382;ments",
        "add_new_category"		=>  "Izveidot jaunu sada&#316;u",

        "pg_content_control"	=>	"M&#257;jaslapas saturs",
        "edit_pg_content"		=>  "Lapu redaktors",
        "site_languages"        =>  "Valodas",
        "site_settings"         =>  "Specifiskie dati",
        "email_form_page"		=>	"Kontaktinform&#257;cijas lapa",
        "email_pg_config"		=>	"Kont. lapas uzst&#257;d&#299;jumi",
        "maps"					=>	"Kartes",
        "bg_image"				=>	"Fona att&#275;la pievieno&#353;ana",
        "open_homepage"			=>	"Atv&#275;rt m&#257;jaslapu",

        "gallery_control"		=>  "Galerija",
        "gallery_folders"		=>  "Mened&#382;ments",
        "gallery_add_folder"	=>	"Jaunas mapes izveide",
        "gallery_settings"		=>  "Uzst&#257;d&#299;jumi",

        "admin_control"			=>  "Administratoru akaunti",
        "add_new_admin"			=>  "Izveidot jaunu",
        "remove_or_edit_admin"	=>	"Akauntu kontrolpanelis",
        "change_password"		=>  "Main&#299;t savu pieejas paroli",

        "cms_virt_gl_control"	=>	"CMS virtu&#257;l&#257; galerija",
        "open_cms_virtual_gl"	=>	"Atv&#275;rt",
        "add_image_to_cms_vg"   =>	"Pievienot att&#275;lu",


    ),
    "cms_special_items"			=>  array(
    	"logout"				=>  "BEIGT DARBU",
        "changes_not_saved"		=>  "Izmai&#326;as nav saglab&#257;tas!",
        "data_saved"			=>  "Dati saglab&#257;ti!",
        "yes"					=>  "j&#257;",
        "no"					=>  "n&#275;",
        "all_op_success"		=>  "Visas oper&#257;cijas veiksm&#299;gas!",
        "error"					=>  "K&#316;&#363;da!",
        "options"				=>	"Iesp&#275;jas",
        "no_data_registred"  	=>  "Nav neviena ieraksta",
        "delete"				=>  "izdz&#275;st",
        "attention"				=>	"uzman&#299;bu!",
        "access_denied"			=>	"Piek&#316;uve liegta!",
        "edit"					=>  "labot",
        "save"					=>	"saglab&#257;t",
        "never_used"			=>  "v&#275;l ne reizi",
        "create"				=>  "izveidot",
        "back"					=>	"atgriezties",
        "add"					=>	"pievienot",
        "rename"				=>	"p&#257;rd&#275;v&#275;t",
        "today_date"			=>	"&#352;odien",
        "cms_version"			=>	"versija",
        "cms_build_date"		=>	"kompil&#275;ts",
        "cms_all_rights_reserv"	=>	"Visas ties&#299;bas rezerv&#275;tas",
        "cancel"				=>	"atcelt",
        "ok"					=>	"labi",
        "choose"				=>	"izv&#275;lieties",
        "choose_language"		=>	"L&#363;dzu izv&#275;lieties valodu, atbilsto&#353;i kurai v&#275;laties labot/skat&#299;t datus",
    ),
    "site_languages_core"		=>  array(
    	"cms_core_title"        =>  "M&#257;jaslapas valodas",
    	"td_lng_ID"				=>  "ID",
        "td_lng_short_name"		=>  "Sa&#299;sin&#257;jums",
        "td_lng_long_name"		=>  "Pilnais valodas nosaukums",
        "td_lng_is_active"		=>  "Valoda publiski pieejama?",
        "td_lng_options"		=>	"Opcijas",
        "edit"					=>	"labot",
        "save"					=>  "saglab&#257;t",
        "delete"				=>  "dz&#275;st",
        "confirm_delete_quest"  =>  "Vai tie&#353;&#257;m v&#275;laties dz&#275;st &#353;o valodu un visus datus (!),\\nkas m&#257;jaslap&#257; saist&#299;ti ar to?",
        "msg_dont_leave_empty" 	=>  "Neaizpild&#299;tu pirmo vai otro laukumu atst&#257;t nedr&#299;kst.",
        "one_lng_ remaining"    =>  "Atlikusi tikai viena m&#257;jaslapas valoda, t&#257;p&#275;c to dz&#275;st nedr&#299;kst!",
        "add_this_language"		=>  "Re&#291;istr&#275;t un pievienot &#353;o valodu",
        "language_not_added"	=>  "Valoda nav pievienota.",
        "this_lng_alr_exists"	=>  "&#352;ada valoda jau eksist&#275;!",
        "language_added"		=>  "Jauna valoda ir re&#291;istr&#275;ta un pievienota.",
        "site_lang_control"		=>	"M&#257;jaslapas valodu kontrolpanelis",
        "default_language"		=>	"M&#257;jaslapas valoda p&#275;c noklus&#275;juma",
        "def_lng_updated"		=>	"Noklus&#275;juma valoda ir nomain&#299;ta",
        "lng_dont_exists"		=>	"Nor&#257;d&#299;t&#257; valoda n&#275;ksist&#275;",
        "no_lng_is_choosed"		=>	"Nav izv&#275;l&#275;ta neviena valoda",
    ),
    "menu_management_core"		=>  array(
    	"cms_core_title" 		=>  "Navig&#257;cijas izv&#275;lnes mened&#382;ments",
        "ID"					=>  "ID",
        "language_name"			=>  "Valoda",
        "menu_item_txt"			=>  "Izv&#275;lnes sada&#316;as nosaukums",
        "save"					=>  "saglab&#257;t izmai&#326;as",
        "edit"					=>  "labot datus",
        "position_nr"			=>	"Poz&#299;cijas nr.",
        "change_pos_nr"			=>  "Poz&#299;cijas<br>mai&#326;a",
        "is_active"				=>	"Publ.?",
        "move_up"				=>	"p&#257;rvietot uz aug&#353;u",
        "move_down"				=>	"p&#257;rvietot uz leju",
        "registred_menu_items"  =>  "Re&#291;istr&#275;to, akt&#299;vo izv&#275;lnes elementu saraksts",
        "confirm_delete_quest"  =>	"Vai esat p&#257;rliecin&#257;ti, ka v&#275;laties dz&#275;st &#353;o izv&#275;lnes\\nsada&#316;u un visus datus, kuri saist&#299;ti ar to?",
        "error_changing_pos"	=>  "Ieraksta poz&#299;ciju izmain&#299;t neizdev&#257;s",
        "type"					=>	"Tips",
        "1st_item_shows_1st"	=>	"Atverot m&#257;jaslapu, k&#257; pirm&#257; lapa (jeb s&#257;kumlapa, sveiciena lapa) tiks uzr&#257;d&#299;ta pirm&#257; p&#275;c savas poz&#299;cijas (no saraksta aug&#353;puses skaitot) akt&#299;v&#257; elementa lapa.",
        "bgimg"					=>	"Fona<br>att&#275;ls"
    ),
    "add_new_category_core"		=>  array(
    	"atl_one_value_needed" 	=>	"J&#257;ievada jaun&#257;s sada&#316;as nosaukums vismaz vienai valodai.",
        "new_menu_item"			=>	"Jaunas izv&#275;lnes sada&#316;as (elementa) izveide",
        "is_active"				=>	"Publiski pieejams?",
        "language_name"			=>  "Elementa valoda",
        "menu_item_txt"			=>  "Izv&#275;lnes sada&#316;as nosaukums",
        "cms_core_title"		=>	"Jauna izv&#275;lnes elementa izveide",
        "add_menu_item"			=>	"pievienot un izveidot izv&#275;lnes elementu",
        "info_about_pages"		=>	"L&#299;dz ar katru jaunu izv&#275;lnes elementa izveidi un p&#275;c&#257;ku t&#257; tipa defin&#275;&#353;anu k&#257; <i>\"lapa\"</i> autom&#257;tiksi tiks izveidotas attiec&#299;gas redi&#291;&#275;jamas lapas CMS sada&#316;&#257; \"Lapu redaktors\", katrai m&#257;jaslapas valodai.<br><br>Ja izv&#275;lnes elementa tips tiks nomain&#299;ts no <i>\"lapa\"</i> uz k&#257;du citu, t&#257; attiec&#299;g&#257;s lapas un viss to saturs <u>netiks</u> dz&#275;sts."

    ),
    "add_new_admin_core"		=>  array(
    	"cms_core_title"		=>	"Administratoru akaunti - profila izveide",
    	"add_new_admin_title" 	=> 	"Jauna administratora lietot&#257;ja profila izveide",
        "login"					=>  "Lietot&#257;jv&#257;rds jeb \"logins\"",
        "starting_password"		=>  "S&#257;kotn&#275;j&#257; parole",
        "password_once_more"	=>  "Atk&#257;rtojiet paroli (verifik&#257;cijai)",
        "create_account"		=>  "izveidot profilu",
        "allowed_chars_warn"	=>  "Loginam un parolei at&#316;auts izmantot <u>tikai</u> sekojo&#353;os simbolus: mazos un lielos lat&#299;&#326;u burtus, ciparus un pasv&#299;trojuma z&#299;mi _<br><br>Paroles un logina minim&#257;lais garums ir ".$login_min_ln.", maksim&#257;lais - ".$login_max_ln." simboli!",
        "login_cnt_illeg_symb"  =>  "Logins satur aizliegtos simbolus!",
        "login_too_short"		=>  "Logins ir p&#257;r&#257;k &#299;ss! Minimums ir ".$login_min_ln." simboli",
        "login_too_long"		=>  "Logins ir p&#257;r&#257;k gar&#353;s! Maks. ir ".$login_max_ln." simboli",
        "pass_cnt_illeg_symb"  	=>  "Parole satur aizliegtos simbolus!",
        "pass_too_short"		=>  "Parole ir p&#257;r&#257;k &#299;sa! Minimums ir ".$login_min_ln." simboli",
        "pass_too_long"			=>  "Parole ir p&#257;r&#257;k gara! Maks. ir ".$login_max_ln." simboli",
        "passwords_not_match"	=>	"Paroles nav identiskas!",
        "login_already_taken"	=>  "lietot&#257;jv&#257;rds jau ir aiz&#326;emts! L&#363;dzu izv&#275;lieties citu.",
        "admin_account_created"	=>	"Administratora akaunts veiksm&#299;gi izveidots!",
        "grant_fl_control_optn"	=>	"Pies&#311;irt ties&#299;bas dz&#275;st un veidot jaunus administratora akauntus"

    ),
    "change_password_core"		=>	array(
    	"cms_core_title"		=>  "Administratoru akaunti - paroles mai&#326;a",
        "allowed_chars_warn"	=>  "At&#316;auts izmantot <u>tikai</u> sekojo&#353;os simbolus: mazos un lielos lat&#299;&#326;u burtus, ciparus un pasv&#299;trojuma z&#299;mi _<br><br>Minim&#257;lais garums ir ".$login_min_ln.", maksim&#257;lais - ".$login_max_ln." simboli!",
        "password_now"			=>	"Patreiz&#275;j&#257; parole",
        "new_pass"				=>	"Jaun&#257; parole",
        "new_pass_once_more"    =>	"Atk&#257;rtojiet jauno paroli (verifik&#257;cijai)",
        "chg_my_pass_title"		=>	"Paroles mai&#326;a administratora akauntam \"".$_SESSION['adm_login']."\"",
        "change_password"		=>	"nomain&#299;t paroli",
        "now_pass_incorrect"	=>  "Ievad&#299;t&#257; \"patreiz&#275;j&#257; parole\" nav pareiza!",
        "pass_too_short"		=>  "Jaun&#257; parole ir p&#257;r&#257;k &#299;sa! Minimums ir ".$login_min_ln." simboli",
        "pass_too_long"			=>  "Jaun&#257; parole ir p&#257;r&#257;k gara! Maks. ir ".$login_max_ln." simboli",
        "pass_cnt_illeg_symb"	=>  "Jaun&#257; parole satur aizliegtos simbolus!",
        "passwords_not_match"	=>  "Jaun&#257;s paroles nav identiskas!",
        "password_changed"		=>  "Parole veiksm&#299;gi nomain&#299;ta!"
    ),
    "remove_or_edit_admin_core"	=>	array(
    	"cms_core_title"		=>	"Administratoru akaunti - kontrolpanelis",
        "ID"					=>	"ID",
        "login"					=>	"Lietot&#257;jv&#257;rds",
        "registration_date"		=>	"Akaunta re&#291;istr&#257;cijas datums",
        "access_date"			=>  "Datums, kad akaunts ped&#275;jo reizi izmantots",
        "full_control"			=>	"Piln&#257; kontrole - veidot/labot/dz&#275;st akauntus?",
        "js_confirm_access_chg"	=>  "Vai esat p&#257;rliecin&#257;ti, ka v&#275;laties &#353;im administratoram dot at&#316;auju veidot, modific&#275;t, dz&#275;st administratoru akauntus, tai skait&#257; ar&#299; J&#363;s&#275;jo?",
    	"cant_edit_yourself"	=>  "Pa&#353;am savu akauntu modific&#275;t nedr&#299;kst!",
        "confirm_delete_quest"	=>	"Apstipriniet administratora akaunta dz&#275;&#353;anu",
        "dont_have_premission"	=>	"Jums ir liegts veidot, dz&#275;st un modific&#275;t administratoru akauntus!",
        "cant_delete_yourself"	=>  "Pats savu akauntu izdz&#275;st nevar!",
    	"1st_user_not_editable"	=>	"Dro&#353;&#299;bas nol&#363;kos pirmo administratora akautnu dz&#275;st vai modific&#275;t ir aizliegts!"
    ),
    "edit_pg_content_core"		=>	array(
        "cms_core_title"		=>	"M&#257;jaslapas saturs - lapu redaktors",
        "page_listing"			=>	"Pieejamo lapu saraksts",
        "all_languages"			=>	"Lapas vis&#257;s valod&#257;s",
        "virtual_title"			=>	"Lapaspuses nosaukums",
        "link_given"			=>	"Lapaspuse piesaist&#299;ta izv&#275;lnes elementam",
        "back_to_full_listing"	=>	"Atgriezties pie lapu saraksta",
        "given_link"			=>	"Piesaist&#299;ts izv&#275;lnes elementam",
        "menu_element_title"	=>	"Izv&#275;lnes elementa nosaukums, kam piesaist&#299;ta lapa",
        "pos_nr"				=>	"Npk",
        "short_language_name"	=>	"Valodas<br>sa&#299;sin&#257;jums",
        "edit_page"				=>	"Labot attiec&#299;g&#257;s lapas saturu",
        "save_content"			=>	"saglab&#257;t veikt&#257;s modifik&#257;cijas",
        "modified"				=>	"p&#275;d&#275;jo reizi modific&#275;ts",
        "modified_by"			=>	"redi&#291;&#275;t&#257;js",
        "bbcode_help_page"		=>	"pal&#299;gs",
        "type"					=>	"Lapas tips",
        "add_whatsnew"   		=>	"Pievienot jaunumu",
        "whatnews"				=>	"\"Jaunumu\" saraksts",
        "choosed_language"		=>	"atbilsto&#353;i valodai",
        "nr"					=>	"NPK",
        "title"					=>	"Nosaukums",
        "date"					=>	"Datums",
        "whatnew_deleted"		=>	"Ieraksts dz&#275;sts",
        "language"				=>	"valoda",
        "wn_modify_error"		=>	"Ieraksta modifik&#257;ciju saglab&#257;&#353;anas servera &#311;&#363;da.",
        "wn_modification_saved"	=>	"Ieraksta modifik&#257;cijas saglab&#257;tas",
        "wn_no_required_data"	=>	"Nav ievad&#299;ti dati visos tr&#299;s laukumos! Ieraksts netika izveidots.",
        "wn_new_create_error"	=>	"Ieraksta izveides servera &#311;&#363;da. Ieraksts netika izveidots.",
        "wn_new_created"		=>	"Jauns ieraksts izveidots",
        "wn_new_record"			=>	"Jauna sada&#316;as \"jaunumi\" ieraksta izveide",
        "wn_record_edit"		=>	"Sada&#316;as \"jaunumi\" ieraksta labo&#353;ana",
        "wn_delete_confirm"		=>	"Dz&#275;st &#353;o ierakstu?",
        "mealmenu_files"        =>	"&#274;dienkartes faili (doc, xls)",
        "no_files"				=>	"failu nav",
        "readd_file"			=>	"nomain&#299;t failu uz jaun&#257;ku",
        "add_new_file"			=>	"Jauna faila pievieno&#353;ana",
        "link_title"			=>	"Saites teksts",
        "filename"				=>	"Faila nosaukums",
        "filesize"				=>	"Apjoms",
        "filetype"				=>	"Tips",
        "modification_date"		=>	"Modifik&#257;cijas datums",
        "options"				=>	"Opcijas",
        "allowed_filetyps"		=>	"&#274;dienkartes fails (tikai doc vai xls)",
        "upload_file"			=>	"pievienot failu",
        "no_files_registred"	=>	"failu nav",
        "confirm_delete"		=>	"Dz&#275;st nor&#257;d&#299;to &#275;dienkartes failu?",
        "change_to_new_one"		=>	"veikt faila nomai&#326;u",
        "file_copy_error"		=>	"Faila kop&#275;&#353;anas servera k&#316;&#363;da.",
        "empty_two_txt_fields"	=>	"Nav aizpild&#299;ti abi teksta laukumi",
        "only_doc_or_xls_allow"	=>	"At&#316;auts pievienot tikai .doc vai .xls tipa failus",
        "no_file_uploaded"		=>	"Nav nor&#257;d&#299;ts neviens fails",
        "new_file_added"		=>	"Fails pievienots",
        "file_update_success"	=>	"Fails veiksm&#299;gi atjaunin&#257;ts!",
        "mmenu_file_deleted"	=>	"&#274;dienkartes fails veiksm&#299;gi dz&#275;sts",
        "mmenu_file_notdeleted"	=>	"&#274;dienkartes failu dz&#275;st neizdev&#257;s. Servera k&#316;&#363;da.",
        "file_deleted"			=>	"&#274;dienkartes fails veiksm&#299;gi dz&#275;sts",

    ),
    "site_settings_core"		=>	array(
    	"cms_core_title"		=>	"M&#257;jaslapas specifiskie dati",
        "choose_language"		=>	"L&#363;dzu izv&#275;lieties valodu, atbilsto&#353;i kurai v&#275;laties labot/skat&#299;t datus",
        "hpage_title" 			=>	"Virsraksts",
        "hpage_title_about"		=>	"Uzr&#257;d&#257;s internetp&#257;rl&#363;ka nosaukuma rind&#257;, k&#257; ar&#299; ir pirmais, kas tiek uzr&#257;d&#299;ts, atrodot m&#257;jaslapu interneta resursu mekl&#275;t&#257;j&#257;, piem. Google, Siets, Yahoo, Rambler, Yandex u.c.<br>Rekomend&#275;jamais garums - l&#299;dz 150 simboliem",
        "back_to_lng_choose"	=>	"Atgriezties pie valodu izv&#275;les",
        "choosed_language"		=>	"Izv&#275;l&#275;t&#257; valoda",
        "hpage_keywords"		=>	"Atsl&#275;gas v&#257;rdi",
        "hpage_keywords_about"	=>	"Rakst&#257;mi pa vienam v&#257;rdam(!), aiz katra liekot komatu. V&#257;rdu skaits nav ierobe&#382;ots - jo vair&#257;k un visaptvero&#353;&#257;ki tie b&#363;s, jo liel&#257;ka iesp&#275;jam&#299;ba, ka J&#363;su m&#257;jaslapu atrad&#299;s internetresursu mekl&#275;t&#257;ji, piem. Google, Rambler, Siets, Yahoo u.c. un l&#299;dz ar to tiks piesaistita lielaka auditorijas uzman&#299;ba.",
        "hpage_description"		=>	"Apraksts",
        "hpage_description_abt"	=>	"T&#257;pat k&#257; atsl&#275;gas v&#257;rdus, &#353;o inform&#257;ciju pamat&#257; izmanto interneta resursu mekl&#275;t&#257;ji. Reiz&#275;m aprakstu liek t&#257;du pa&#353;u k&#257; m&#257;jaslapas nosaukumu (pirmais lauci&#326;&#353; no aug&#353;as &#353;aj&#257; lap&#257;). Max 255 simboli.",
        "hpage_copyR_info"		=>	"Autorties&#299;bu inform&#257;cija",
        "hpage_copyR_info_abt"	=>	"Atainojas m&#257;jaslapas apak&#353;&#275;j&#257; da&#316;&#257;. Inform&#275; lapas apmekl&#275;t&#257;jus, ka apskat&#257;mo saturu bez m&#257;jaslapas &#299;pa&#353;nieka at&#316;aujas izmantot (kop&#275;t, p&#257;rrakst&#299;t u.t.t) nedr&#299;kst. Max 255 simboli."
    ),
    "gallery_settings_core"		=>	array(
    	"cms_core_title"		=>	"Galerijas uzst&#257;d&#299;jumi",
        "thumb_max_height"		=>	"S&#299;katt&#275;la max augstums, px",
        "thumb_max_width"		=>	"S&#299;katt&#275;la max platums, px",
        "full_max_height"		=>	"Pilnizm&#275;ra att&#275;la max augstums, px",
        "full_max_width"		=>	"Pilnizm&#275;ra att&#275;la max platums, px",
        "show_folder_cr_date"	=>	"R&#257;d&#299;t galerijas mapes izveides datumu<br><font color=\"gray\" style=\"font-size:9px;\">neattiecas uz CMS</font>",
        "thumb_count_vert"		=>	"S&#299;katt&#275;lu atainojuma skaits, vertik&#257;li",
        "thumb_count_hori"		=>	"S&#299;katt&#275;lu atainojuma skaits, horizont&#257;li",
        "folder_preview_type"	=>	"Mapju saraksta atainojuma tips<br><font color=\"gray\" style=\"font-size:9px;\">neattiecas uz CMS</font>",
        "folder_style_usual"	=>	"ierastais",
        "folder_style_special"	=>	"stiliz&#275;tais",
        "default_settings"		=>	"standartparametri",
        "restore_default_quest" =>	"Vai esat p&#257;rliecin&#257;ti, ka v&#275;laties atgriezt standarta uzst&#257;d&#299;jumus? &#352;&#299;s izmai&#326;as neskars att&#275;lus, kas jau eksist&#275; galerijas map&#275;s, bet gan tikai tos, kuri turpm&#257;k tiks pievienoti.",
        "not_all_data_ok"		=>	"Da&#316;a tom&#275;r neatbilda normas pras&#299;b&#257;m, t&#257;p&#275;c da&#382;i dati netika atjaunoti"
    ),
    "gallery_folders_core"		=>	array(
    	"cms_core_title"        =>  "Galerijas mened&#382;ments",
        "choose_language"		=>	"L&#363;dzu izv&#275;lieties m&#257;jaslapas valodu, kur&#257; v&#275;laties, lai tiktu atainoti galerijas dati",
        "language"				=>	"Valoda",
        "folder_title"			=>	"Mapes nosaukums",
        "folder_ren_success"	=>	"Mapes nosaukums veiksm&#299;gi izmain&#299;ts!",
        "img_count_in_gallery"	=>	"att&#275;li",
        "description"			=>	"apraksts",
        "add_image"				=>	"pievienot att&#275;lu map&#275;",
        "position_changed"		=>	"Mapes poz&#299;cija nomain&#299;ta",
        "error_changing_pos"	=>	"Mapes poz&#299;ciju nomain&#299;t neizdev&#257;s!",
        "created"				=>	"izveidota",
        "folder_description"	=>	"Mapes apraksts",
        "fld_descr_chg_success"	=>  "Apraksts veiksm&#299;gi izmain&#299;ts un saglab&#257;ts!",
        "move_up"				=>	"uz aug&#353;u",
        "move_down"				=>	"uz leju",
        "choose_img_file"		=>	"nor&#257;diet att&#275;la failu (jpg, jpeg)",
        "image_adding"			=>	"Att&#275;la pievieno&#353;ana",
        "illegal_img_type"		=>	"Neat&#316;auts faila form&#257;ts! At&#316;auts pievienot tikai jpg vai jpeg att&#275;lus.",
        "no_file_uploaded"		=>	"Nav nor&#257;d&#299;ts neviens fails!",
        "file_copy_error"		=>	"Faila kop&#275;&#353;anas k&#316;&#363;da! Att&#275;ls netika pievienots.",
        "resize_dat_incorrect"	=>	"Nav nor&#257;d&#299;ti korekti att&#275;la samazin&#257;&#353;anas (dimensiju) dati.",
        "img_db_reg_error"		=>	"Re&#291;istr&#275;t att&#275;lu galerij&#257; neizdev&#257;s! Servera k&#316;&#363;da.",
        "large_img_created"		=>  "Lielais att&#275;ls veiksm&#299;gi izveidots!",
        "small_img_created"		=>	"Mazais att&#275;ls veiksm&#299;gi izveidots!",
        "img_added"				=>	"pievienots",
        "no_folders_registred"	=>	"nav nevienas mapes",
        "img_count_in_folder"	=>	"att&#275;lu skaits map&#275;",
        "no_other_folders"		=>	"nav citu mapju",
        "selected_images"		=>	"Atz&#299;m&#275;to att&#275;lu",
        "js_confirm_delete"		=>	"Dz&#275;st visus atz&#299;m&#275;tos att&#275;lus?",
        "move_to"				=>	"P&#257;rvietot uz mapi",
        "delete_selected_img"	=>	"Dz&#275;st",
        "language"				=>	"Valoda",
        "img_description"		=>	"Att&#275;la apraksts",
        "max_symbols"			=>	"maks. simbolu skaits",
        "all_img_moved_success"	=>  "Visi izv&#275;l&#275;tie att&#275;li p&#257;rvietoti uz nor&#257;d&#299;to mapi",
        "no_img_choosed_t_move" =>  "Nav izv&#275;l&#275;ts neviens att&#275;ls, kuru p&#257;rvietot uz izv&#275;l&#275;to m&#275;r&#311;mapi",
        "no_folder_to_move_to"	=>	"Att&#275;lu(s) p&#257;rvietot neizdev&#257;s! M&#275;r&#311;mape n&#275;ksist&#275;",
        "selected_img_deleted"  =>	"Visi izv&#275;l&#275;tie att&#275;li dz&#275;sti!",
        "no_img_selected_t_del"	=>	"Nav izv&#275;l&#275;ts neviens att&#275;ls, kuru paredzams dz&#275;st",
        "not_all_img_deleted"   =>	"Ne visus atz&#299;m&#275;tos att&#275;la failus no servera izdev&#257;s dz&#275;st!",
        "img_description_saved"	=>	"Att&#275;la apraksts veiksm&#299;gi saglab&#257;ts!",
        "selected_folders"		=>  "Izv&#275;l&#275;to mapju",
        "js_confirm_delete_fld" =>	"Dz&#275;st visas atz&#299;m&#275;t&#257;s mapes?\\nL&#299;dz ar map&#275;m tiks dz&#275;sti visi att&#275;li, kas atrodas taj&#257;s un attiec&#299;go att&#275;lu apraksti.",
        "fld_cnt_move_to"		=>	"P&#257;rvietot visus att&#275;lus uz mapi",
        "all_sel_fld_deleted"	=>	"Visas atz&#299;m&#275;t&#257;s mapes un to atteli ir dz&#275;sti",
        "not_all_fld_deleted"	=>	"Ne visas atz&#299;m&#275;t&#257;s mapes un to att&#275;lus izdev&#257;s veiksm&#299;gi izdz&#275;st",
        "no_folders_selected" 	=>	"Nav izv&#275;l&#275;ta neviena mape",
        "all_img_move_success"	=>	"Att&#275;li p&#257;rvietoti veiksm&#299;gi!",
        "move_to_fld_not_found"	=>	"M&#275;r&#311;mape n&#275;ksist&#275;!"

    ),
    "gallery_add_folder_core"	=>	array(
    	"cms_core_title"        =>  "Galerija - jaunas mapes izveide",
        "language"				=>	"Valoda",
        "folder_title"			=>	"Mapes nosaukums",
        "not_all_fields_full"	=>	"Nav nor&#257;d&#299;ti mapes nosaukumi vis&#257;s valod&#257;s!",
        "new_folder_created"	=>	"Jauna mape veiksm&#299;gi izveidota!"
    ),
    "email_form_page_core"		=>	array(
    	"cms_core_title"        =>	"Kontaktinform&#257;cijas lapa",
        "choose_language"		=>	"L&#363;dzu izv&#275;lieties valodu, atbilsto&#353;i kurai v&#275;laties labot/skat&#299;t datus",
        "choosed_lng"			=>	"Izv&#275;l&#275;t&#257; valoda",
        "txt_before_form"		=>	"Teksts virs anketas",
        "email_field_title"		=>	"Epasta adreses laukuma nosaukums",
        "email_cnt_fld_title"	=>	"V&#275;stules teksta laukuma nosaukums",
        "send_button_text"      =>	"Uzraksts uz pogas \"Nos&#363;t&#299;t\"",
        "hint_field"			=>	"Padoms, piez&#299;mes",
        "txt_after_form"		=>	"Teksts zem anketas",
        "not_important"			=>	"neoblig&#257;ti",
        "email_not_sent"		=>	"Teksts, kas atainosies, ja v&#275;stule netiks nos&#363;t&#299;ta<br><br>Piem. ja tiks atst&#257;ts tuk&#353;s vai nepareizi aizpild&#299;ts epasta lauci&#326;&#353; vai ar&#299; neb&#363;s pa&#353;as v&#275;stules teksta.",
        "email_is_sent"			=>	"Teksts, kas atainosies, ja v&#275;stule tiks nos&#363;t&#299;ta"
    ),
    "email_pg_config_core"		=>	array(
     	"cms_core_title"        =>	"Kontaktinform&#257;cijas lapas uzst&#257;d&#299;jumi",
        "send_to_email"			=>	"Epasta adrese, uz kuru tiks s&#363;t&#299;tas v&#275;stules (<i>to</i>)",
        "email_subject"			=>	"V&#275;stules t&#275;ma (<i>subject</i>)",
        "from_email"            =>	"S&#363;t&#299;t&#257;ja epasta adrese (<i>from</i>)",
        "from_email_hint"		=>	"gad&#299;juma, ja laukums tiks atst&#257;ts tuk&#353;s, k&#257; \"s&#363;t&#299;t&#257;ja\" epasts tiks uzr&#257;d&#299;ts tas, kuru ievad&#299;s v&#275;stules autors",
        "send_btn_position"		=>	"Pogas \"Nos&#363;t&#299;t\" poz&#299;cija",
        "txt_field_width"		=>	"Teksta laukuma platums, px",
        "txt_field_height"		=>	"Teksta laukuma augstums, px",
        "left"					=>  "&equiv;-- | pa kreisi",
        "center"				=>	"-&equiv;- | centr&#275;ta",
        "right"					=>	"--&equiv; | pa labi",
        "choose"				=>	"izv&#275;lieties",
        "show_form"				=>	"Epasta anketa pieejama m&#257;jaslapas apmekl&#275;t&#257;jiem"
    ),
    "add_image_to_cms_vg_core"	=>	array(
    	"cms_core_title"		=>	"CMS virtu&#257;l&#257; galerija - att&#275;la pievieno&#353;ana",
        "img_add_success" 		=>	"Att&#275;ls veiksm&#299;gi ievietots CMS virtu&#257;laj&#257; galerij&#257;!",
        "preview_img"			=>	"Apskat&#299;t",
        "unsupported_img_file"	=>	"Nor&#257;d&#299;tais fails nav ne \"jpg\", ne \"gif\", ne ar&#299; \"png\" tipa att&#275;ls!",
        "no_file_uploaded"		=>	"Nav nor&#257;d&#299;ts neviens fails",
        "img_file_copy_error"	=>	"Faila kop&#275;&#353;anas k&#316;&#363;da! Att&#275;ls nav saglab&#257;ts.",
        "no_resize_data_given"	=>	"Nav nor&#257;d&#299;ti att&#275;la samazin&#257;&#353;anas dati. Gad&#299;jum&#257; ja to nevajag main&#299;t, j&#257;nor&#257;da \"Pilnizm&#275;ra, 100%\" opcij&#257; \"Pied&#257;v&#257;tie izm&#275;ri\"!",
        "img_adding_pretitle"	=>	"Att&#275;la pievieno&#353;ana CMS virtu&#257;laj&#257; galerij&#257;, map&#275; \"custom\"",
        "img_file"				=>	"Att&#275;la fails",
        "img_file_hint"			=>	"Nor&#257;diet attela failu J&#363;su dator&#257;, kuru v&#275;laties ievietot CMS virtu&#257;laj&#257; galerij&#257;, lai to v&#275;l&#257;k var&#275;tu izmantot m&#257;jaslapas dizain&#257;.",
        "allowed_img_types"		=>	"At&#316;autie form&#257;ti",
        "dimension_change"		=>	"Izm&#275;ru mai&#326;a",
        "given_resize_values"	=>	"pied&#257;v&#257;tie izm&#275;ri",
        "given_resize_v_hint"	=>	"Izv&#275;lieties att&#275;la samazin&#257;juma pak&#257;pi. Ja att&#275;ls ir t&#257;pat mazs, tad &#326;emiet \"pilnizm&#275;ra\" vai ar&#299; zem&#257;k atrodamajos laukumos nor&#257;diet sevis izv&#275;l&#275;tus skait&#316;us.",
        "accept_type_warning"   =>	"Var veikt TIKAI \"jpg\" form&#257;ta att&#275;liem. P&#257;r&#275;jie formati, t.i. \"png\" un \"gif\" tiks saglab&#257;ti t&#257;d&#257; izm&#275;r&#257;, k&#257;di ir uz datora uzl&#257;des br&#299;d&#299;!",
        "micro"					=>	"mikro",
        "from_original_size"	=>	"no ori&#291;in&#257;la",
        "small"					=>	"mazs",
        "mediumsmall"			=>	"vid&#275;ji mazs",
        "medium"				=>	"vid&#275;js",
        "large"					=>	"liels",
        "fullsize"				=>	"pilnizm&#275;ra",
        "resize_user_values"	=>	"savi izm&#275;ri",
        "resize_user_val_hint" 	=>	"Gad&#299;jum&#257; ja augst&#257;k atrodamaj&#257; izv&#275;ln&#275; neatrodat piem&#275;rotu att&#275;la samazin&#257;juma pak&#257;pi, &#353;eit varat nor&#257;d&#299;t patva&#316;&#299;gi izv&#275;l&#275;tus skait&#316;us. Aizpildiet <b>TIKAI vienu laukumu</b> no redzamajiem trim,
                     				 p&#257;r&#275;jos apr&#275;&#311;inus veiks serveris. &#352;eit ar&#299; var palielin&#257;t att&#275;lu, nor&#257;dot procentus vair&#257;k par 100% vai ar&#299; izm&#275;rus (px) nor&#257;dot liel&#257;kus nek&#257; ir uzl&#257;d&#275;jamajam att&#275;lam.",
        "width"					=>	"platums",
        "height"				=>	"augstums",
        "size_in_percents"		=>	"Izm&#275;rs, procentos"
    	),
    "maps_core"					=>	array(
        "cms_core_title"		=>	"Kartes",
        "copy"					=>	"Kartes att&#275;li",
        "copy_info"				=>	"Izmantojot CMS virtu&#257;lo galeriju, izv&#275;lieties att&#275;lu un iekop&#275;jiet t&#257; adresi<br>&#353;aj&#257; laukum&#257;, s&#257;kot ar simbolu [ l&#299;dz simbolam ].<br>
        							 <br>Savuk&#257;rt lapas teksta da&#316;u iesp&#275;jams apskat&#299;t un redi&#291;&#275;t CMS sada&#316;&#257; \"Kontaktinform&#257;cijas lapa\".",
    	),
    "bg_image_core"				=>	array(
        "cms_core_title"		=>	"Fona att&#275;la pievieno&#353;ana",
        "img_adding"			=>	"Att&#275;la pievieno&#353;ana, map&#275; \"bgimg\"",
        "allowed_img_types"		=>	"At&#316;autie form&#257;ti",
        "img_file"				=>	"Att&#275;la fails",
        "img_file_hint"			=>	"Nor&#257;diet J&#363;su dator&#257; att&#275;lu, kur&#353; atbilst zem&#257;k noteiktajiem platuma un augstuma parametriem. Cita izm&#275;ra att&#275;li netiks pie&#326;emti!<br><br>
                                     Fona att&#275;ls tiks ievietots CMS virtu&#257;l&#257;s galerijas map&#275; \"bgimg\". Katrai m&#257;jaslapas sada&#316;as lapai iesp&#275;jams pie&#353;&#311;irt savu fona att&#275;la elementu CMS izv&#275;lnes
                                     sada&#316;&#257; Izv&#275;lne -> Mened&#382;ments",
        "width"					=>	"Platums",
        "height"				=>	"Augstums",
        "file_add_success"		=>	"Att&#275;ls veiksm&#299;gi pievienots",
        "cant_copy_file"		=>	"Neizdev&#257;s nokop&#275;t failu. Servera &#311;&#363;da",
        "wrong_dimensions"		=>	"Nepareizi att&#275;la izm&#275;ri! L&#363;dzu lasiet tekstu pel&#275;kiem burtiem uzman&#299;g&#257;k!",
        "not_jpg_file"			=>	"At&#316;auts pievienot tikai jpg tipa attt&#275;lus",
        "no_file_submitted"		=>	"Nav nor&#257;d&#299;ts neviens fails",
        "img_adding_1stpgbg"	=>	"Pirm&#257;s lapas fonatt&#275;la nomai&#326;a, mape \"des\"",
        "img_file_1stpgbg_hint"	=>	"Nor&#257;diet J&#363;su dator&#257; att&#275;lu, kur&#353; atbilst zem&#257;k noteiktajiem platuma un augstuma parametriem. Cita izm&#275;ra att&#275;li netiks pie&#326;emti!<br><br>
                                     Fona att&#275;ls tiks ievietots CMS virtu&#257;l&#257;s galerijas map&#275; \"des\" ar faila nosaukumu ",
        "view_actual_img"		=>	"Apskat&#299;t patreiz&#275;jo fonatt&#275;lu"
    	)

);




?>