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
	Header('Cache-Control: no-cache');
	Header('Pragma: no-cache');
	$languagePath = $_SESSION['sess_language'];
	include("core/language/$languagePath/language.php");

if (isset($_POST['submit_mapp']))
{

	foreach($_POST as $key => $val)
	{
	   $_POST[$key] = trim($val);
	}
	  
	$SearchPath = $_POST['lc_manager_createfolder_location'];
	$Path = $_POST['lc_manager_createfolder_name'];

	
	header("Refresh: 0;URL=liveconcms_manager.php");
	exit;
 }
?>

<style>
	#lc-tabs-createfolder {
		min-height:200px;
	}
	.lc-createfolder-filetree {
		height:200px;
		overflow:scroll;
		margin-top:10px;
	}
	
	#fsUploadProgress {
		height:300px;
		overflow:auto;
		margin:0;
		padding-top:5px;
	}
	
	.progressWrapper {
		width:49%;
		margin-right:1%;
		display:inline-block;
		float:left;
		background-color:#2e2e2e;
		border-radius:3px;
		-moz-border-radius:3px;
		-webkit-border-radius:3px;
		margin-bottom:5px;
		background-image:url('skins/icons/page_white.png');
		background-repeat:no-repeat;
		background-position: 5px 50%;
	}
	
	.progressName {
		font-size:12px;
		line-height:12px;
		font-family:inherit;
	}	
	.progressBarStatus {
		font-size:10px;
		line-height:10px;
		font-style:italic;
		font-family:inherit;
	}
	
	.progressContainer {
		padding:5px 5px 5px 25px;
		color:#fff;
		text-shadow:1px 1px 0px #000;
		-moz-text-shadow:1px 1px 0px #000;
		-webkit-text-shadow:1px 1px 0px #000;
	}
	
	.progressWrapper .blue {
		background-color:#a3c74c;
		background-image:url('skins/icons/document-save.png');
		background-repeat:no-repeat;
		background-position: 5px 50%;
		border-radius:3px;
		border:1px solid #678e0c;
		-moz-border-radius:3px;
		-webkit-border-radius:3px;
		color:#fff;
		text-shadow:1px 1px 0px #6e921a;		
		-moz-text-shadow:1px 1px 0px #6e921a;		
		-webkit-text-shadow:1px 1px 0px #6e921a;		
	}
</style>

<form name="form1" method="post" enctype="multipart/form-data">
 
	<div id="lc-tabs-createfolder" class="lc-tabs">
		<ul>
			<li><a href="#tabs-1"><?PHP echo "$liveconcms_uploadfilestext1"; ?></a></li>
			<li><a href="#tabs-2"><?PHP echo "$liveconcms_uploadfilestext2"; ?></a></li>
		</ul>			
		<div id="tabs-1">
			<strong><?PHP echo "$liveconcms_uploadfilestext3"; ?></strong>		
				<div class="lc-createfolder-filetree"><?php include ('liveconcms_filetree.php'); ?></div>
				<input type="text" name="lc_manager_uploadfile_location" readonly="readonly" value=""/>
				
		</div>	
		<div id="tabs-2">
			<strong><?PHP echo "$liveconcms_uploadfilestext4"; ?></strong>						
				<div id="fsUploadProgress"></div>
				<div id="divStatus"><?PHP echo "$liveconcms_uploadfilestext5"; ?></div>
				<div><span id="upl-placeholderbutton"></span></div>		
		</div>			
	</div>
</form>

<script>
	$(document).ready(function(){
		$(".lc-createfolder-filetree ul").lcfileTree();
	});
</script>