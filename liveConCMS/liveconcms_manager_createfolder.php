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

    if($SearchPath == "")
	{
	$SearchPath = "../";
	}
	elseif($SearchPath == "../")
	{
	$SearchPath = "../";
	}
	
	if (!mkdir("$SearchPath/$Path", 0700))
	{
	header("Refresh: 0;URL=liveconcms_error.php?error_id=8");
	exit; 
	}
	
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
</style>
 
<form name="lc-manager-createfolder-form" action="liveconcms_manager_createfolder.php" method="post">
 
	<div id="lc-tabs-createfolder" class="lc-tabs">
		<ul>
			<li><a href="#tabs-1"><?PHP echo "$liveconcms_addfoldertext1"; ?></a></li>
			<li><a href="#tabs-2"><?PHP echo "$liveconcms_addfoldertext2"; ?></a></li>
		</ul>		
		<div id="tabs-1">
			<strong><?PHP echo "$liveconcms_addfoldertext3"; ?></strong>
				<input type="text" name="lc_manager_createfolder_name" value=""/>
		</div>		
		<div id="tabs-2">
			<strong><?PHP echo "$liveconcms_addfoldertext4"; ?></strong>		
				<div class="lc-createfolder-filetree"><?php include ('liveconcms_filetree.php'); ?></div>
				<input type="text" name="lc_manager_createfolder_location" readonly="readonly" value="../"/>
				<input type="submit" name="submit_mapp" value="Skapa mapp"  style="display:none;" />
		</div>		
	</div>
</form>

<script>
	$(document).ready(function(){
		$(".lc-createfolder-filetree ul").lcfileTree();
	});
</script>