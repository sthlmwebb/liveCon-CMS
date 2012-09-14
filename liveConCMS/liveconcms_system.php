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
include("core/liveconcms_systemactions.php");
$languagePath = $_SESSION['sess_language'];
include("core/language/$languagePath/language.php");
liveConCMS_SystemPageID('.','..','0','1','0','index.php','system');
checkRole($_SESSION['sess_role'], 'liveconcms_system');
				
	$sql = "SELECT metaKeywords, metaDescription, SiteTitle, htmlEditor, googleanalytics, manualupload FROM `lc_tblconfig` WHERE ID ='1'";
	$result = mysql_query_exequter_with_return($sql); 
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
					
		$siteTitle = $row["SiteTitle"];
		$metaKeywords = $row["metaKeywords"];
		$metaDescription = $row["metaDescription"];
		$htmlEditor = $row["htmlEditor"];
		$googleAnalyticsText = $row["googleanalytics"];		
		$manualupload = $row["manualupload"];			
	}
	
	

$error_list[2] = "$liveConCMS_error_message_13";
$error_list[3] = "$liveConCMS_error_message_24 ";
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LiveCon CMS - <?PHP echo "$liveConCMS_HtmlTitle_11";?></title>


<!-- Load javascripts for CMS backend -->
<?PHP include("liveconcms_editonpageheader.php");?>

<!-- Load the stylesheets used by the CMS -->
<link rel="stylesheet" type="text/css" href="skins/reset.css">
<link rel="stylesheet" type="text/css" href="skins/styles.php">

<?PHP
if (isset($display_noticemessage))
{
	echo "<script type='text/javascript'>
		$(document).ready(function(){
			$('body').append('<div id=\"freeow\"></div>');
			$('#freeow').freeow('Sparad', 'Inställningen är sparad.', {
				classes: ['lc-notice ui-widget-content ui-state-highlight ui-corner-all ui-box-shadow'],
				autoHide: true
			});
		});
	</script>";
}
?>

</head>

<body class="lc-body">

<?PHP
include("liveconcms_panel.php");
?>

<div class="bodywrapper container_12">



	<h1 class="page-title"><?PHP echo "$liveConCMS_PageTitle_10";?></h1>
		<p><?PHP echo "$liveConCMS_pageText9_1";?></p>
		<p><?PHP echo "$liveConCMS_pageText9_2";?></p>
			
	
	<hr>

	<div class="ui-widget ui-widget-content ui-corner-all" id="site-title">
		<span class="ui-widget-header ui-corner-top ui-helper-clearfix"><h3><?PHP echo "$liveConCMS_WindowTitle_17";?></h3></span>
			<div class="ui-widget-content">
				<p><?PHP echo "$liveConCMS_pageText9_3";?></p>
		
				<form method="post">
				<fieldset>
					<strong><?PHP echo "$liveConCMS_menuText9_1";?></strong> 
					<input class="form_metaKeywords" type="text" value="<?PHP echo "$siteTitle"; ?>" name="titelText"/>
					<em><?PHP echo "$liveConCMS_menuText9_2";?></em>
				</fieldset>
				
				<fieldset>
					<input name="Submit_title" type="submit" value="<?PHP echo "$liveConCMS_regularbutton_2"; ?>" />
					<input name="Reset2" type="reset" value="<?PHP echo "$liveConCMS_regularbutton_4"; ?>" />
				</fieldset>
				</form>	
			</div>		
	</div>



	<hr />
		
		
		
	<div class="ui-widget ui-widget-content ui-corner-all" id="metataggar">
		<span class="ui-widget-header ui-corner-top ui-helper-clearfix"><h3><?PHP echo "$liveConCMS_WindowTitle_18";?></h3></span>
			<div class="ui-widget-content">
				<p><?PHP echo "$liveConCMS_pageText9_4";?></p>
				<p><?PHP echo "$liveConCMS_pageText9_5";?></p>
			
					<form method="post">
					<fieldset>
						<strong><?PHP echo "$liveConCMS_menuText9_3";?></strong> 
						<input class="form_metaKeywords" type="text" value="<?PHP echo "$metaKeywords"; ?> " name="metaKeywords"/>
						<em><?PHP echo "$liveConCMS_menuText9_4";?></em>
					</fieldset>
					
					<fieldset>
						<strong><?PHP echo "$liveConCMS_menuText9_5";?></strong> 
						<input class="form_metaDescription" type="text" value="<?PHP echo "$metaDescription"; ?> " name="metaDescription"/> 
						<em><?PHP echo "$liveConCMS_menuText9_6";?></em>
					</fieldset>
					
					<fieldset>
						<input name="Submit_meta" type="submit" value="<?PHP echo "$liveConCMS_regularbutton_2"; ?>" />
						<input name="Reset1" type="reset" value="<?PHP echo "$liveConCMS_regularbutton_4"; ?>" />
					</fieldset>
					</form>	
				
			</div>				
	</div>
		
		
		
		<hr />
		
		
		
		<div class="ui-widget ui-widget-content ui-corner-all" id="mce-select">
			<span class="ui-widget-header ui-corner-top ui-helper-clearfix"><h3><?PHP echo "$liveConCMS_WindowTitle_19";?></h3></span>
				<div class="ui-widget-content">
					<p><?PHP echo "$liveConCMS_pageText9_6";?></p>
			
						<form method="post">
						<fieldset>
							<?PHP
							if($htmlEditor == 0)
							{
							echo "<input id='mce-select-simple' type='radio' name='htmleditor' value='0' checked='checked'/><label for='mce-select-simple'>Simpel <em>(Aktiverad)</em></label>";
							echo "<input id='mce-select-advanced' type='radio' name='htmleditor' value='1'/><label for='mce-select-advanced'>Avancerad</label>";
							}
							else
							{
							echo "<input id='mce-select-simple' type='radio' name='htmleditor' value='0' /><label for='mce-select-simple'>Simpel</label>";
							echo "<input id='mce-select-advanced' type='radio' name='htmleditor' value='1' checked='checked'/><label for='mce-select-advanced'>Avancerad <em>(Aktiverad)</em></label>";
							}
							?>
						</fieldset>	
						
						<fieldset>
							<input name="Submit_editor" type="submit" value="<?PHP echo "$liveConCMS_regularbutton_2"; ?>" />
							<input name="Reseteditor" type="reset" value="<?PHP echo "$liveConCMS_regularbutton_4"; ?>" />
						</fieldset>
						</form>					
				</div>			
		</div>
			
			
			
		<hr />	
		
		
		
		<div class="ui-widget ui-widget-content ui-corner-all" id="mce-select">
			<span class="ui-widget-header ui-corner-top ui-helper-clearfix"><h3><?PHP echo "$liveconcms_serverrightstitle"; ?></h3></span>
				<div class="ui-widget-content">
					<p><?PHP echo "$liveconcms_serverrightstext"; ?></p>
			
						<form method="post">
						<fieldset>
							<?PHP
							if($manualupload == 0)
							{
							echo "<input id='mce-select-simple1' type='radio' name='manualupload' value='0' checked='checked'/><label for='mce-select-simple1'>$liveconcms_serverrightsbutton1</label>";
							echo "<input id='mce-select-advanced1' type='radio' name='manualupload' value='1'/><label for='mce-select-advanced1'>$liveconcms_serverrightsbutton2</label>";
							}
							else
							{
							echo "<input id='mce-select-simple1' type='radio' name='manualupload' value='0' /><label for='mce-select-simple1'>$liveconcms_serverrightsbutton3</label>";
							echo "<input id='mce-select-advanced1' type='radio' name='manualupload' value='1' checked='checked'/><label for='mce-select-advanced1'>$liveconcms_serverrightsbutton4</label>";
							}
							?>
						</fieldset>	
						
						<fieldset>
							<input name="Submit_uploadtype" type="submit" value="<?PHP echo "$liveConCMS_regularbutton_2"; ?>" />
							<input name="Reseteditor" type="reset" value="<?PHP echo "$liveConCMS_regularbutton_4"; ?>" />
						</fieldset>
						</form>					
				</div>			
		</div>
		
		
			
		<hr />	
		
		
			
		<div class="ui-widget ui-widget-content ui-corner-all" id="licens-box">
			<span class="ui-widget-header ui-corner-top ui-helper-clearfix"><h3><?PHP echo "$liveConCMS_WindowTitle_30"; ?></h3></span>
				<div class="ui-widget-content">
					<p><?PHP echo "$liveConCMS_pageText9_9"; ?></p>
					<p><i><?PHP echo "$liveConCMS_pageText9_10"; ?></i></p>
			
						<form method="post">
							<fieldset>
								<strong><?PHP echo "$liveConCMS_menuText9_11";?></strong> 
								<textarea name="googleText" cols="10" rows="4" class="input"><?PHP echo "$googleAnalyticsText"; ?></textarea>
										<em><?PHP echo "$liveConCMS_menuText9_12";?></em>
							</fieldset>
							
							<fieldset>
								<input name="Submit_google" type="submit" value="<?PHP echo "$liveConCMS_regularbutton_2"; ?>" />
									<input name="Reset1" type="reset" value="<?PHP echo "$liveConCMS_regularbutton_4"; ?>" />
							</fieldset>
						</form>			
				</div>	
		</div>
		
		
		
		<hr />
		
		
		
		<div class="ui-widget ui-widget-content ui-corner-all" id="licens-box">
			<span class="ui-widget-header ui-corner-top ui-helper-clearfix"><h3><?PHP echo "$liveConCMS_WindowTitle_21";?></h3></span>
				<div class="ui-widget-content">
					<p><?PHP echo "$liveConCMS_pageText9_8";?></p>
			
						<form method="post">
						<fieldset>
						<?PHP
				
								function listreaderSkin($dir) { 
									if (is_dir($dir)) { 
										$dh = opendir($dir); 
											while (false !== ($file = readdir($dh))) { 
												if ($file != "." && $file != "..") { 
													if (is_dir($dir."/".$file)) { 
													
														$sql = 'SELECT languagepath FROM `lc_tblconfig`';
														$result = mysql_query_exequter_with_return($sql); 
														while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
														{
														$Template = $row["languagepath"];
														}
												
														IF ($Template == $file)
														{
														echo "<option value=\"$file\" selected>$file</option>\n"; 
														}
														else
														{
														echo "<option value=\"$file\">$file</option>\n"; 
														}
													   
													} 
												} 
											} 
										closedir($dh); 
									} 
								}

					echo "<select name='Template' class=dropdown>";
					echo listreaderSkin("core/language"); 
					echo "</select>";

				?>
				</fieldset>
						<fieldset>
								<input name="Submit_language" type="submit" value="<?PHP echo "$liveConCMS_regularbutton_2"; ?>" />
							</fieldset>
							
						</form>			
				</div>	
		</div>
		
		<hr />
		
		<!--<div class="ui-widget ui-widget-content ui-corner-all" id="licens-box">
			<span class="ui-widget-header ui-corner-all ui-helper-clearfix"><h3><?PHP echo "$liveConCMS_WindowTitle_20";?></h3></span>
				<div>
					<p><?PHP echo "$liveConCMS_pageText9_7";?></p>
			
						<form method="post">
							<fieldset>
								<strong><?PHP echo "$liveConCMS_menuText9_7";?></strong> 
									<input class="form_metaKeywords" type="text" value="" name="licenskey"/>
										<em><?PHP echo "$liveConCMS_menuText9_8";?></em>
							</fieldset>
							
							<fieldset>
								<input name="Submit_licens" type="submit" value="<?PHP echo "$liveConCMS_regularbutton_2"; ?>" />
									<input name="Reset1" type="reset" value="<?PHP echo "$liveConCMS_regularbutton_4"; ?>" />
							</fieldset>
						</form>			
				</div>	
		</div>-->
		
	
		
		
	
	</div><!-- .body-wrapper -->



<!-- POP Fönstret för fel --->	
<?PHP
if (isset($reg_error))
{
	echo	"<div id='popup' title='Error'>";
	echo			"<div>";
	echo				"<b>$liveConCMS_error_Topic_1<br /><br /></b>";

							for ($i=0; $i < sizeof($reg_error); $i++) 
							{
								echo "<em>{$error_list[$reg_error[$i]]}</em><br>\n";
							}	
							
	echo			"</div>";
	echo	"</div>";
		
}
?>	
		

		
<?PHP include("liveconcms_footer.php");?>
		


<!-- SLUT -->



</body>

</html>
