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

include("core/include/dbConn.php");
include("core/liveconcms_systemcore.php");
include("core/liveconcms_systemheader.php");
$languagePath = $_SESSION['sess_language'];
include("core/language/$languagePath/language.php");
liveConCMS_SystemPageID('.','..','0','1','0','index.php','system');

function DisplayVersion()
{
	$sqlVersion = "SELECT * FROM `lc_tblversion` WHERE ID ='1'";
	$resultVersion = mysql_query($sqlVersion) or die('Query failed: ' . mysql_error());
	while ($rowVersion = mysql_fetch_array($resultVersion, MYSQL_ASSOC))
	{					
	$CMSTitle = $rowVersion["Title"];
	$CMSVersion = $rowVersion["Version"];								
	}
	return print "$CMSVersion\n";
}

function DisplayActivated($text1, $text2)
{
	$sqlActivated = "SELECT * FROM `lc_tbllicens` WHERE ID ='1'";
	$resultActivated = mysql_query($sqlActivated) or die('Query failed: ' . mysql_error());
	while ($rowActivated = mysql_fetch_array($resultActivated, MYSQL_ASSOC))
	{					
	$CMSActivated = $rowActivated["Activated"];								
	}
	
	if($CMSActivated == 1)
	{
	$active = $text1;
	}
	else
	{
	$active = $text2;
	}
	
	return print "$active\n";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LiveCon CMS - <?PHP echo "$liveConCMS_HtmlTitle_12";?></title>

<!-- Load javascripts for CMS backend -->
<?PHP include("liveconcms_editonpageheader.php");?>

<!-- Load the stylesheets used by the CMS -->
<link rel="stylesheet" type="text/css" href="skins/reset.css">
<link rel="stylesheet" type="text/css" href="skins/styles.php">

</head>

<body id="lc-about" class="lc-body container_12">
<?PHP
include("liveconcms_panel.php");
?>

<div class="bodywrapper">
			
				
		<div class="container_wrapper">
		
			<h1 class="page-title"><?PHP echo "$liveConCMS_PageTitle_11";?></h1>
			<p>
			liveCon CMS 2.0, cms made easy <br/>
			Copyright (C) 2012  STHLM Webbproduktion AB, www.sthlmwebb.se<br/>
			<br/>
			This program is free software: you can redistribute it and/or modify<br/>
			it under the terms of the GNU General Public License as published by<br/>
			the Free Software Foundation, either version 3 of the License, or<br/>
			(at your option) any later version.<br/>
			<br/>
			This program is distributed in the hope that it will be useful,<br/>
			but WITHOUT ANY WARRANTY; without even the implied warranty of<br/>
			MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the<br/>
			GNU General Public License for more details.<br/>
			<br/>
			You should have received a copy of the GNU General Public License<br/>
			along with this program.  If not, see <a href="http://www.gnu.org/licenses/" target="_blank">http://www.gnu.org/licenses/</a>.<br/>
		</p>
			
			<hr>

			
			<h2><?PHP echo "$liveConCMS_menuText10_2";?></h2>	
		
			
			<ul class="licenses_list">
				<li><a class="lc-link" href="#license_01">Tiny MCE</a></li>
				<li><a class="lc-link" href="#license_02">jQuery</a></li>
				<li><a class="lc-link" href="#license_jqueryui">jQuery UI</a></li>
				<li><a class="lc-link" href="#license_03">jQuery Tools</a></li>
				<li><a class="lc-link" href="#license_05">Another In Place Editor</a></li>
				<li><a class="lc-link" href="#license_06">Codemirror</a></li>
			</ul>
				<br>	
				<hr>	
	

			<div class="licenses_container" id="license_01">
				<h3>Tiny MCE</h3>
				<p><?PHP echo "$liveConCMS_menuText10_3";?> <a class="lc-link" href="http://tinymce.moxiecode.com/license.php" target="_blank">GNU Library Public License</a></p>
				<p><?PHP echo "$liveConCMS_menuText10_4";?> <a class="lc-link" href="http://tinymce.moxiecode.com/" target="_blank">Moxiecode Systems AB</a></p>
			</div>
			
				<hr />
			
			<div class="licenses_container" id="license_02">
				<h3>jQuery</h3>
				<p><?PHP echo "$liveConCMS_menuText10_3";?> <a class="lc-link" href="http://jquery.org/license" target="_blank">MIT / GPL License</a></p>
				<p><?PHP echo "$liveConCMS_menuText10_4";?> <a class="lc-link" href="http://jquery.org/" target="_blank">jQuery Projekt</a></p>
			</div>
			
			<hr />

			<div class="licenses_container" id="license_jqueryui">
				<h3>jQuery UI</h3>
				<p><?PHP echo "$liveConCMS_menuText10_3";?> <a class="lc-link" href="http://jquery.org/license" target="_blank">MIT / GPL License</a></p>
				<p><?PHP echo "$liveConCMS_menuText10_4";?> <a class="lc-link" href="http://jqueryui.com/" target="_blank">jQuery UI Projekt</a></p>
			</div>
			
			<hr />
			
			<div class="licenses_container" id="license_03">
				<h3>jQuery Tools</h3>
				<p><?PHP echo "$liveConCMS_menuText10_3";?> N/A</p>
				<p><?PHP echo "$liveConCMS_menuText10_4";?> <a class="lc-link" href="http://flowplayer.org/tools/index.html" target="_blank">jQuery Tools Hemsida</a></p>
				<p>Author: <a class="lc-link" href="http://cloudpanic.com/about.html" target="_blank">Tero Piirainen</a></p>
			</div>

			<hr />

			<div class="licenses_container" id="license_05">
				<h3>Another In Place Editor</h3>
				<p><?PHP echo "$liveConCMS_menuText10_3";?> <a class="lc-link" href="http://www.opensource.org/licenses/bsd-license.php" target="_blank">BSD License</a></p>
				<p><?PHP echo "$liveConCMS_menuText10_4";?> <a class="lc-link" href="http://code.google.com/p/jquery-in-place-editor/" target="_blank">Dave Hauenstein</a></p>
			</div>
			
			<hr />
			
			<div class="licenses_container" id="license_06">
				<h3>Codemirror</h3>
				<p><?PHP echo "$liveConCMS_menuText10_3";?> <a class="lc-link" href="http://codemirror.net/LICENSE" target="_blank">License</a></p>
				<p><?PHP echo "$liveConCMS_menuText10_4";?> <a class="lc-link" href="http://codemirror.net/" target="_blank">Codemirror</a></p>
			</div>

			<hr />
			
			


		</div>		


		
	<a class="goback" href="javascript:history.back()"><?PHP echo "$liveConCMS_links1";?></a>
	
	
	
	<hr />
	
	
	
	</div>
	
	
	
	<?PHP include("liveconcms_footer.php");?>

</body>

</html>
