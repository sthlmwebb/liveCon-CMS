<?php header('Content-type: text/css'); ?>

/* HTML Elements */

body.lc-body, .ui-widget {
	font-family:"Trebuchet MS", Helvetica, sans-serif;
	font-size:13px;
	line-height:15px;
}

body.lc-body {
	background-color:#f3f3f3;
	background-image:url('images/bg.png');
	margin-bottom:20px;
	font-family:"Trebuchet MS", Helvetica, sans-serif;	
	font-size:13px;
	line-height:15px;
}

body.lc-iframe {
	background-image:none;
	overflow-x:hidden;
}

body.lc-body input {
	font-size:1em; font-family:inherit; line-height:1em;
}

body.lc-body input[type="text"],
body.lc-body input[type="password"],
body.lc-body textarea, 
.ui-dialog input[type="password"] {display:block; width:70%; padding:5px; margin: 3px 0 3px 0; min-height:18px; line-height:18px; border:solid 1px #c2c2c2; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px; background-image:url('images/input-bg.png'); background-repeat:repeat-x; background-position: top left;}

body#lc-login input[type="text"],
body#lc-login input[type="password"] {
	width:464px !important;
}

body.lc-body .ui-widget-content textarea {
	display:inline-block;
	width:100%;
	padding:0px;
	margin:0;
}

body.lc-body table tbody  input {max-width:70% !important;}

body.lc-body hr { clear:both; max-width:940px; margin-left:auto; margin-right:auto; margin-top:20px; margin-bottom:20px; border-top:solid 1px #e5e5e5; border-bottom:solid 1px #fff; border-left:none; border-right:none;}

body.lc-body  hr.clear-both {clear:both; border:none; border-color:transparent; background-color:transparent; margin:0; padding:0; height:1px;}

body.lc-body table + hr {margin-top:20px; clear:both;}

table.tbl-style-1 tbody tr td {line-height:32px;}

body#lc-plugin-iframe {
	height:100%;
	width:100%;
	padding:0;
	margin:0;
}

/* Typography */

.goback,
.lc-link,
#lc-plugin-iframe a.goback {
	color:#739b07;
	text-decoration:none;
	border-bottom:1px dotted #739b07;
	<?php echo $text_shadow1; ?>
}

body.lc-body h1.page-title {
	font-size:32px;
	line-height:32px;
	font-family:<?php echo $font_face2; ?>
	font-weight:bold;
	display:block;
	clear:both;
	margin-bottom:16px;
	<?php echo $text_shadow1; ?>	
}

body.lc-iframe h1.page-title {
	font-size:16px;
	line-height:16px;
}

body.lc-body h2 {
	font-size:26px;
	line-height:26px;
	font-family:<?php echo $font_face2; ?>	
	margin-bottom:13px;
	display:block;
	clear:both;
}

body.lc-body b,
body.lc-body strong {
	font-weight:bold;
	display:block;
}

body.lc-body em, body.lc-body i {
	font-style:italic;
}

body.lc-body fieldset em, body.lc-body fieldset i {
	font-size:0.9em;
	color:#888;
}

body.lc-body fieldset input + i,
body.lc-body fieldset input + em,
body.lc-body fieldset select + em {
	display:block;
}

body.lc-body table thead tr td{font-weight:normal;}

.ui-widget .ui-widget-header h3, 
.ui-widget-header .ui-dialog-title  {font-weight:normal;}

body#lc-login .lc-copyright {
	font-size:0.8em;
	text-align:right;
	color:#888;
	display:block;
	margin-top:5px;
}

body#lc-login .lc-copyright a {
	color:#000;
	text-decoration:none;
}

table.tbl-style-1 tbody i {
	color:gray;
}

#lc-newsfeed .ui-widget-header h3 {
	background-image:url('images/RSS.png');
	background-position:7px center;
	background-repeat:no-repeat;
	padding-left:42px;
}

/* Layout */

body.lc-body .bodywrapper {
	padding-top:100px;
}

body.lc-iframe .bodywrapper {
	padding:10px;
}

body#lc-login .bodywrapper {
	width:500px;
}

body#lc-splashscreen {margin:0; padding:0;}

body#lc-splashscreen .bodywrapper {text-align:center; padding-top:0;}

body#lc-splashscreen .bodywrapper img {width:510px;margin:0 auto;display:block;}

body.lc-body .lc-page-switch {
	display:block;
	text-align:right;
	height:auto;
	line-height:auto;
	margin-top:10px;
	padding-right:0;
}

body.lc-body .lc-page-switch .lc-numlink-current {
	border: 1px solid #779e0e; 
	background-color:#93c709;
	background-image:url('images/innershadow.png');
	background-position:top left;
	color: #fff; 
	<?php echo $text_shadow5; ?>
}

body.lc-body .ui-widget-content .ui-state-error {
	margin:10px 0;
}

/* 
	Layout: Accordion menu
*/

.submenu_list_container {
	display:block;
	clear:both;
	overflow:hidden;
	margin-bottom:5px;
	padding:5px;
	background:#E5E5E5;

}

.submenu_list_options-1 {
	display:inline-block;
	float:left;
}

.submenu_list_options-1 li {
	clear:both;
}

.submenu_list_options-1 .submenu_file {
	margin-top:5px;
}

.submenu_list_options-2 {
	display:inline-block;
	float:right;
}

.main-nav-settings {
	margin-top:10px;
}

.main-nav-settings ul li {
	display:inline-block;
	float:left;
	vertical-align:top;
}

.main-nav-settings ul  {
	display:inline-block;
	float:right;
	vertical-align:top;
}

.submenu_list_options-2 li {
	display:inline-block;
	float:left;
	vertical-align:top;
	margin:15px 0;
}

.submenu_name b, .submenu_name span, .submenu_link b, .submenu_link span {
	display:inline-block;
	float:left;
	margin-right:5px;
}

/* 
	Filetree 
*/

#lc-filetree {
	height:400px;
	width:250px;
	overflow:scroll;
	display:inline-block;
	float:left;
}

#lc-code-container {
	width:660px;
	height:400px;
	display:inline-block;
	float:right;
	background:#fff;
	border:1px solid #c2c2c2;
	overflow:hidden;
}
#lc-code-container textarea {
	width:673px;
	height:400px;
	border:0;
	padding:0;
	margin:0;
}

#lc-code-container img{
	display:inline-block;
	max-width:640px;
	max-height:380px;
}

.CodeMirror-line-numbers {
	width: 2.2em;
	color: #aaa;
	background-color: #eee;
	text-align: right;
	padding-right: .3em;
	font-size: 10pt;
	font-family: monospace;
	padding-top: .4em;
	line-height: normal;
}

/*
	Dialog toolbar layout
*/

.ui-widget .lc-toolbar {
	height:40px;
	background-image:url('<?php echo $bg_8; ?>');
	background-repeat:repeat-x;
	background-position:left top;
}

.ui-widget .lc-toolbar .ui-state-default {
	margin-top:6px;
	font-size:12px;
	line-height:12px;
}

.ui-widget .lc-toolbar .ui-state-default:first-child {
	margin-left:10px;
}

.ui-widget .lc-toolbar .ui-state-default {
	margin-right:0px;
}

span.lc-toolbar-split {
    background-image: url("images/adminpanel_hr.png");
    background-position: center center;
    background-repeat: no-repeat;
	text-indent:-9999px;
	width:5px;
	height:40px;
	display:inline-block;
	vertical-align:top;
	margin:0 3px;
}

/*
	IFrame layout
*/

body#lc-plugin-iframe {
	background-image:none;
	padding:0;
	margin:0;
}

/* 
	Form elements layout 
*/

body.lc-body fieldset {
	margin:10px 0;
}

/* 
	Tabels 
*/

.tbl-style-1 {width:100%;}

.widget table.tbl-style-1 {
	margin-bottom:10px;
}

table.tbl-style-1 tr td {vertical-align:middle;}

table.ui-widget-content {margin:0;}

table.tbl-style-1 tbody tr td {
	padding:5px;
	background-image:url('jquery-ui/images/table-body-td-bg.png');
	background-position:top left;
	background-repeat:repeat-x;
    border-bottom: 1px solid #DBDBDB;
    border-top: 1px solid #F5F5F5;
	background-color:#f2f2f2;
	padding-left:10px;
	vertical-align:middle;
}

table.tbl-style-1 tbody tr td:first-child  {
    border-left:1px solid #fff;	
}

table.tbl-style-1 tbody tr td:last-child  {
    border-right:1px solid #fff;	
}

table.tbl-style-1 tbody tr:first-child td  {
    border-top:1px solid #fff;	
}

thead tr td.ui-widget-header {border-left:none; border-right:none}

thead tr td.first-cell {border-left:solid 1px #c2c2c2;}

thead tr td.last-cell {	border-right:solid 1px #c2c2c2;}

body#liveconintra_users td.first-cell {width:200px;}

table.tbl-style-1 a.lc-editItem,
table.tbl-style-1 a.lc-deleteItem {
	display:block;
	width:32px;
	height:32px;
	text-indent:-9999px;
	background-position:center center;
	background-repeat:no-repeat;
}

table.tbl-style-1 a.lc-editItem {
	background-image:url('images/edit.png');
}

table.tbl-style-1 a.lc-deleteItem {
	background-image:url('images/delete.png');
}

.lc-body .ui-widget table.tbl-style-1 thead tr td,
body.lc-iframe table.tbl-style-1 thead tr td {
	padding:12px 10px;
	background-image:url('images/dialog_toolbar_bg.png');
	background-repeat:repeat-x;
	background-position:left top;
    border-bottom: 1px solid #DBDBDB;
    border-top: 1px solid #000;
	border-left:none;
	border-right:none;
	color:#fff;
	vertical-align:middle;
	<?php echo $text_shadow6; ?>
	font-weight:bold;
	cursor:default;
}

#tbl-profil-registerUser td.first-cell{
	width:130px;
}

#tbl-profil-registerUser label {
	margin-bottom:10px;
}

table.tbl-style-1 + input {
	margin-top:20px;
}

/*
	Startpage
*/

.lc-startpage-quicklinks {
	background-color:#212121;
	overflow:hidden;
	padding:10px;
}

.lc-startpage-quicklinks h3 {
	color:#9bc821;
	font-weight:bold;
	font-size:18px;
	margin-top:10px;
}

.lc-startpage-quicklinks p {
	color:#fff;
	font-weight:normal;
}

.lc-startpage-quicklinks a {
	display:inline-block;
	overflow:hidden;
	text-decoration:none;
	width:100%;
}

.lc-startpage-quicklinks img {
	display:inline-block;
	float:left;
	margin-right:10px;
}

.rssContainer {
	clear:both;
}

.rsslink {
	font-weight:bold;
	font-size:1.1em;
	text-decoration:none;
}

.rssdate {
	font-weight:normal;
	font-style:italic;
	font-size:0.9em;
	color:gray;
	margin-bottom:5px;
}

.rssdesc {
	display:block;
	clear:both;
	margin-bottom:15px;
}

/* 
	liveCon footer 
*/

#lc-footer {
	display:block;
	text-align:right;
	font-size:10px;
	text-shadow:1px 1px 0px #fff;
}

#lc-footer a {
	color:#555;
	text-decoration:none;
}

#lc-footer p {
	color:#888;
}

/* Install pages */

body#lc-install textarea {
	min-height:500px;
}

/*File browser*/

ul.lc-browser-list {
	display:block;

}

li ul.lc-browser-list {
	padding-left:25px;
}

.lc-folder-title,
.lc-folder-title-open,
.lc-browser-file-link {
	background-repeat:no-repeat;
	background-position:5px center;
	padding:3px 3px 3px 25px;
	background-color:#f2f2f2;
	display:inline-block;
	width:100%;
	overflow:hidden;
}

.lc-folder-title {
	background-image:url('icons/folder.png');
}

.lc-browser-file-link,
.lc-folder-title {
	font-size:12px;
	line-height:12px;
	color:black;
	text-decoration:none;
	border:1px solid #c2c2c2;
	margin-bottom:3px;
	display:block;
	width:auto;
	margin-right:2px;
}

.lc-browser-file-link:hover,
.lc-folder-title:hover {
	background-color:#fff;
}

.lc-folder-title-open {
	background-image:url('icons/folder_go.png');
	background-color:#c2c2c2;
}

ul.lc-browser-list a.jpgFile,
ul.lc-browser-list a.gifFile,
ul.lc-browser-list a.pngFile {
	background-image:url('icons/image.png');
}

ul.lc-browser-list a.phpFile {
	background-image:url('icons/page_white_php.png');
}

ul.lc-browser-list a.cssFile,
ul.lc-browser-list a.jsFile {
	background-image:url('icons/page_code.png');
}

ul.lc-browser-list a.otherFile {
	background-image:url('icons/page_white.png');
}

/*Popup windows*/

.ui-dialog .lc-dialog-icon {
	display:inline-block;
	float:left;
	margin-right:13px;
	max-height:50px;
}

.ui-dialog .lc-dialog-title {
	font-size:14px;
	line-height:14px;
	margin-bottom:5px;
}

/*
	Tooltip
*/

.lc-tooltip {
	z-index:9999;
	box-shadow:2px 2px 5px rgba(0, 0, 0, 0.2);
	-moz-box-shadow:2px 2px 5px rgba(0, 0, 0, 0.2);
	-webkit-box-shadow:2px 2px 5px rgba(0, 0, 0, 0.2);
}

/*
	lcLoader
*/
#lcLoader span {
	color:#fff;
}

/*
	Freeow
*/

.lc-notice {
	position:fixed;
	z-index:99999;
	top:70px;
	left:70px;
	padding:5px;
}

#freeow h2 {
	font-size:18px;
	line-height:18px;
	margin:0;
}

.lc-notice .icon {
	display:inline-block;
	float:left;
	width:32px;
	height:37px;
	background-image:url('images/dialog-info_32px.png');
	margin-right:5px;
}

.lc-notice .background {
	display:inline-block;
	float:right;
}

/*
	Change image
*/

.lc-img-form {
	padding:10px;
}