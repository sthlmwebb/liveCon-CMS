<?php header('Content-type: text/css'); ?>

/* Admin Panelen */

.lc-min {
	top:-60px;
}
.lc-min {
	top:-60px;
}
#lccms-adminpanel_wrapper {
	font-family: Corbel, "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Verdana, "Verdana Ref", sans-serif;
	display:block;
	background-image:url('images/main-nav_bg.png');
	background-repeat:repeat-x;
	background-position: top left;
	background-color:transparent;
	position:fixed;
	left:0;
	font-size:10px;
	line-height:10px;
	height:85px;
	width:100%;	
	border:0;
	margin:0;
	padding:0;
	z-index:999; /*This places the adminpanel on top of the expose*/
}

#lccms-adminpanel_wrapper #lccms-panel-logo {
	float:left;
	margin:13px 0 0 0;
	padding:0;
	border:none;
}

#lccms-adminpanel_wrapper .adminpanel {
	display:block;
	width:940px;
	height:60px;
	margin:0;
	margin-left:auto;
	margin-right:auto;
	padding:0;
}

#lccms-adminpanel_wrapper .adminpanel ul {
	list-style:none;
	width:940px;
	height:60px;
	margin:0;
	margin-left:auto;
	margin-right:auto;
	padding:0;
}

#lccms-adminpanel_wrapper .adminpanel li {
	list-style:none;
	float:left;
	width:auto;
	height:60px;
	margin:0;
	padding:0 10px ;
	background-image:url('images/adminpanel_hr.png');
	background-repeat:no-repeat;
	background-position:right top;
}

#lccms-adminpanel_wrapper .adminpanel ul li a {
	background-position:center center;
	background-repeat:no-repeat;
	display:inline-block;
	float:left;
	height:60px;	
	margin:0;
	padding:0;
}

#lccms-adminpanel_wrapper .adminpanel ul li a.lc-menu-default {
	position:relative;
}

#lccms-adminpanel_wrapper .lc-menu-hover {
}

#lccms-adminpanel_wrapper .lc-menu-default b,
#lccms-adminpanel_wrapper .lc-menu-hover b{
	display:none;
}

#lccms-adminpanel_wrapper li.adminpanel_navigation {padding-left:0px}
#lccms-adminpanel_wrapper li.adminpanel_editsite {padding-left:0px}
#lccms-adminpanel_wrapper li.adminpanel_help {padding-right:0px}

#lccms-adminpanel_wrapper .adminpanel_navigation a.lc-menu-default {
	background-image:url('images/main-nav_icon-nav_normal.png');
	width:67px;	
}

#lccms-adminpanel_wrapper .adminpanel_navigation a.lc-menu-hover {
	background-image:url('images/main-nav_icon-nav_hover.png');
	width:67px;
}

#lccms-adminpanel_wrapper .adminpanel_editsite a{
	background-image:url('images/main-nav_icon-edit_normal.png');
	width:67px;
}

#lccms-adminpanel_wrapper .adminpanel_pages a.lc-menu-default {
	background-image:url('images/main-nav_icon-pages.png');
	width:72px;
}

#lccms-adminpanel_wrapper .adminpanel_pages a.lc-menu-hover {
	background-image:url('images/main-nav_icon-pages_hover.png');
	width:72px;
}

#lccms-adminpanel_wrapper .adminpanel_system a.lc-menu-default  {
	background-image:url('images/main-nav_icon-system_normal.png');
	width:122px;
}

#lccms-adminpanel_wrapper .adminpanel_system a.lc-menu-hover {
	background-image:url('images/main-nav_icon-system_hover.png');
	width:122px;
}

#lccms-adminpanel_wrapper .adminpanel_help a.lc-menu-default  {
	background-image:url('images/main-nav_icon-info_normal.png');
	width:87px;
}

#lccms-adminpanel_wrapper .adminpanel_help a.lc-menu-hover {
	background-image:url('images/main-nav_icon-info_hover.png');
	width:87px;
}

#lccms-adminpanel_wrapper .adminpanel_intrahome a.lc-menu-default  {
	background-image:url('images/main-nav_icon-intranet_normal.png');
	width:62px;
}

#lccms-adminpanel_wrapper .adminpanel_intrahome a.lc-menu-hover {
	background-image:url('images/main-nav_icon-intranet_hover.png');
	width:62px;
}

#lccms-adminpanel_wrapper .adminpanel_plugin a.lc-menu-default  {
	background-image:url('images/main-nav_icon-modules_normal.png');
	width:62px;
}

#lccms-adminpanel_wrapper .adminpanel_plugin a.lc-menu-hover {
	background-image:url('images/main-nav_icon-modules_hover.png');
	width:62px;
}

#lccms-adminpanel_wrapper .adminpanel_filemanager a.lc-menu-default {
	background-image:url('images/main-nav_icon-filebrowser.png');
	width:67px;
}

#lccms-adminpanel_wrapper .adminpanel_filemanager a.lc-menu-hover {
	background-image:url('images/main-nav_icon-filebrowser_hover.png');
	width:67px;
}

#lccms-adminpanel_wrapper .adminpanel_statistics a.lc-menu-default {
	background-image:url('images/main-nav_icon-stats_normal.png');
	width:62px;
}

#lccms-adminpanel_wrapper .adminpanel_statistics a.lc-menu-hover {
	background-image:url('images/main-nav_icon-stats_hover.png');
	width:62px;
}

/* Sub menu */

#lccms-adminpanel_wrapper .adminpanel div.adminpanel_submenu_wrapper {
	position:absolute;
	display:none;
	width:auto;
	height:auto;
	top:60px;
	z-index:9998 !important;
	background-image:url('images/1px1px_transparent.png');
	background-repeat:repeat;
}

#lccms-adminpanel_wrapper .adminpanel li:hover .adminpanel_submenu_wrapper,
#lccms-adminpanel_wrapper .adminpanel li:hover .adminpanel_submenu_wrapper ul {
	display:inline-block;
}

#lccms-adminpanel_wrapper .adminpanel div.adminpanel_submenu_wrapper ul {
	padding-top:5px;
	margin-top:2px;
	height:100%;
	display:inline-block;
	background-image:url('images/sub-menu_ul_bg.png');
	background-repeat:no-repeat;
	background-position:20px 0px;
	width:auto;
}

/*Reset children*/
#lccms-adminpanel_wrapper .adminpanel div.adminpanel_submenu_wrapper ul li,
#lccms-adminpanel_wrapper .adminpanel div.adminpanel_submenu_wrapper ul li a,
#lccms-adminpanel_wrapper .adminpanel div.adminpanel_submenu_wrapper ul li b{
	background:none;
	display:inline-block;
	position:relative;
	margin:0;
	padding:0;
	height:auto;
	border:none;
	font-size:12px;
	line-height:12px;
	text-decoration:none;
	z-index:9999 !important;	
}

#lccms-adminpanel_wrapper .adminpanel div.adminpanel_submenu_wrapper ul li {
	clear:both;
	display:inline-block;
	list-style:none;
	margin-left:10px;
}

#lccms-adminpanel_wrapper .adminpanel div.adminpanel_submenu_wrapper ul li b {
	background-image:url('images/sub-menu_bg.png');
	background-repeat:repeat;
	padding:5px;
	margin-bottom:5px;
	border:1px solid #2f2f2f;
	width:188px;
	border-radius:3px;
	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	color:#acacac;
	text-shadow:1px 1px 0px #000;
	-moz-text-shadow:1px 1px 0px #000;
	-webkit-text-shadow:1px 1px 0px #000;
}

#lccms-adminpanel_wrapper .adminpanel div.adminpanel_submenu_wrapper ul li b:hover {
	color:white;
}



/*Profil info*/

#lc-profilinfo,
#lc-profilinfo a,
#lc-profilinfo span,
#lc-profilinfo:hover,
#lc-profilinfo a:hover,
#lc-profilinfo span:hover,
#lc-profilinfo b,
#lc-profilinfo b:hover,
#lc-profilinfo em,
#lc-profilinfo em:hover {
	margin:0px;
	padding:0;
	border:0;
	text-decoration:none;
	font-size:12px;
	line-height:12px;
	font-weight:normal;
	color:#c8c8c8;
	text-shadow:1px 1px 0px #000;
	-moz-text-shadow:1px 1px 0px #000;
	-webkit-text-shadow:1px 1px 0px #000;
}

#lc-profilinfo {
	width:80px;
	height:60px;
	display:block;
	float:right;
	position:relative;
	top:-60px;
	overflow:hidden;
}

#lc-profilinfo .lc-profile-name,
#lc-profilinfo .lc-profile-name:hover {
	height:60px;
	display:none;
	vertical-align:middle;
	padding-left:10px;
}

#lc-profilinfo .lc-profile-name b {font-weight:bold}

#lc-profilinfo a,
#lc-profilinfo a:hover {
	display:inline-block;
	float:left;
	width:40px;
	height:40px;
	background-color:transparent;
	text-indent:-9999px;
	margin-top:10px;
	background-position:center center;
	background-repeat:no-repeat;
}

#lc-profilinfo .lc-profile-user-normal {background-image:url('images/panel_profil_normal.png');}

#lc-profilinfo .lc-profile-user-normal:hover {background-image:url('images/panel_profil_hover.png');}

#lc-profilinfo .lc-profile-logout-normal {background-image:url('images/panel_logout_normal.png');}

#lc-profilinfo .lc-profile-logout-normal:hover {background-image:url('images/panel_logout_hover.png');}

#lc-minimize-panel {
	display:inline-block;
	width:100px;
	height:25px;
	background:#1a1a1a;
	color:#9ecd21;
	text-align:center;
	cursor:pointer;
	position:absolute;
}

#lc-minimize-panel {
	line-height:25px;
	vertical-align:middle;
	font-size:12px;
}

