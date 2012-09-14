<?PHP 
session_start();

/**************************************************************************
    <liveCon CMS 2.0, cms made easy>
    Copyright (C) 2012  STHLM Webbproduktion AB, www.sthlmwebb.se

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
***************************************************************************/

	header('Content-Type: text/html; charset=iso-8859-1'); 
	$languagePath = $_SESSION['sess_language'];
	include("core/language/$languagePath/language.php");
	
	$icon_0001 = "skins/images/dialog-error.png";
	$icon_0002 = "skins/images/dialog-info.png";
	
?>

<div id="lc-error-msg-manager-1">
<span class="lc-dialog-title"><b><?PHP echo "$liveconcms_errorpopupmsg1"; ?></b></span>
	<img class="lc-dialog-icon" src="<?php echo $icon_0001; ?>" />
	<span class="lc-dialog-text">
		<p><?php echo "$liveconcms_errorpopupmsg2"; ?></p>
		<p><?php echo "$liveconcms_errorpopupmsg3"; ?></p>
	</span>
</div>

<div id="lc-error-msg-manager-2">
<span class="lc-dialog-title"><b><?PHP echo "$liveconcms_errorpopupmsg1"; ?></b></span>
	<img class="lc-dialog-icon" src="<?php echo $icon_0001; ?>" />
	<span class="lc-dialog-text">
		<p><?php echo "$liveconcms_errorpopupmsg4"; ?></p>
	</span>
</div>

<div id="lc-error-msg-addmenu-1">
<span class="lc-dialog-title"><b><?PHP echo "$liveconcms_errorpopupmsg1"; ?></b></span>
	<img class="lc-dialog-icon" src="<?php echo $icon_0001; ?>" />
	<span class="lc-dialog-text">
		<p><?php echo "$liveconcms_errorpopupmsg5"; ?></p>
	</span>
</div>

<div id="lc-error-msg-addmenu-2">
<span class="lc-dialog-title"><b><?PHP echo "$liveconcms_errorpopupmsg1"; ?></b></span>
	<img class="lc-dialog-icon" src="<?php echo $icon_0001; ?>" />
	<span class="lc-dialog-text">
		<p><?php echo "$liveconcms_errorpopupmsg6"; ?></p>
	</span>
</div>

<div id="lc-error-msg-addtemplate-1">
<span class="lc-dialog-title"><b><?PHP echo "$liveconcms_errorpopupmsg1"; ?></b></span>
	<img class="lc-dialog-icon" src="<?php echo $icon_0001; ?>" />
	<span class="lc-dialog-text">
		<p><?php echo "$liveconcms_errorpopupmsg7"; ?></p>
	</span>
</div>

<div id="lc-error-msg-addtemplate-2">
<span class="lc-dialog-title"><b><?PHP echo "$liveconcms_errorpopupmsg1"; ?></b></span>
	<img class="lc-dialog-icon" src="<?php echo $icon_0001; ?>" />
	<span class="lc-dialog-text">
		<p><?php echo "$liveconcms_errorpopupmsg8"; ?></p>
	</span>
</div>

<div id="lc-error-msg-languages-1">
<span class="lc-dialog-title"><b><?PHP echo "$liveconcms_errorpopupmsg1"; ?></b></span>
	<img class="lc-dialog-icon" src="<?php echo $icon_0001; ?>" />
	<span class="lc-dialog-text">
		<p><?php echo "$liveconcms_errorpopupmsg9"; ?></p>
	</span>
</div>

<div id="lc-error-msg-languages-2">
<span class="lc-dialog-title"><b><?PHP echo "$liveconcms_errorpopupmsg1"; ?></b></span>
	<img class="lc-dialog-icon" src="<?php echo $icon_0001; ?>" />
	<span class="lc-dialog-text">
		<p><?php echo "$liveconcms_errorpopupmsg10"; ?></p>
	</span>
</div>

<div id="lc-error-msg-addsubmenu-1">
<span class="lc-dialog-title"><b><?PHP echo "$liveconcms_errorpopupmsg1"; ?></b></span>
	<img class="lc-dialog-icon" src="<?php echo $icon_0001; ?>" />
	<span class="lc-dialog-text">
		<p><?php echo "$liveconcms_errorpopupmsg11"; ?></p>
	</span>
</div>

<div id="lc-error-msg-addsubmenu-2">
<span class="lc-dialog-title"><b><?PHP echo "$liveconcms_errorpopupmsg1"; ?></b></span>
	<img class="lc-dialog-icon" src="<?php echo $icon_0001; ?>" />
	<span class="lc-dialog-text">
		<p><?php echo "$liveconcms_errorpopupmsg12"; ?></p>
	</span>
</div>

<div id="lc-error-msg-writenews-1">
<span class="lc-dialog-title"><b><?PHP echo "$liveconcms_errorpopupmsg1"; ?></b></span>
	<img class="lc-dialog-icon" src="<?php echo $icon_0001; ?>" />
	<span class="lc-dialog-text">
		<p><?php echo "$liveconcms_errorpopupmsg13"; ?></p>
	</span>
</div>

<div id="lc-error-msg-writenews-2">
<span class="lc-dialog-title"><b><?PHP echo "$liveconcms_errorpopupmsg1"; ?></b></span>
	<img class="lc-dialog-icon" src="<?php echo $icon_0001; ?>" />
	<span class="lc-dialog-text">
		<p><?php echo "$liveconcms_errorpopupmsg14"; ?></p>
	</span>
</div>