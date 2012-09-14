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
checkRole($_SESSION['sess_role'], 'liveconcms_languages');	

$error_list[0] = "Du måste fylla i ett namn på språket!";
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

<script>
$(document).ready(function(){
	$(".lc-deleteItem").lcDeleteItem();	
	$('form').submit(function(){		
		var newLanguage = $("input[name=newLanguage]").val();
		var newPrefix = $("input[name=newPrefix]").val();
		if ( newLanguage.length === 0 ) { lcErrorPopup('languages-1'); return false }
		if ( newPrefix.length === 0) { lcErrorPopup('languages-2'); return false }
	});
	
});
</script>

<?PHP
if (isset($display_noticemessage))
{	
	echo "<script type='text/javascript'>
		$(document).ready(function(){
			$('body').append('<div id=\"freeow\"></div>');
			$('#freeow').freeow('$liveconcms_noticepopuptext1', '$liveconcms_noticepopuptext2', {
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



	<h1 class="page-title"><?PHP echo "$liveconcms_languagetext1"; ?></h1>
		<p><?PHP echo "$liveconcms_languagetext2"; ?></p>
			
	
	<hr>
	
	<form method="post">
		<div class="ui-widget ui-widget-content ui-corner-all" id="licens-box">
			<span class="ui-widget-header ui-corner-top ui-helper-clearfix"><h3><?PHP echo "$liveconcms_languagetext3"; ?></h3></span>
				
	
						<table class="ui-widget ui-corner-all tbl-style-1">
							<thead>
								<tr>
									<td class="first-cell"><strong>ID#</strong></td>
									<td><strong><?PHP echo "$liveconcms_languagetext4"; ?></strong></td>
									<td><strong><?PHP echo "$liveconcms_languagetext5"; ?></strong></td>
									<td  class="last-cell"><strong><?PHP echo "$liveconcms_languagetext6"; ?></strong></td>
								</tr>
							</thead>
							<tbody>
								<?PHP	
										$sql = 'SELECT * FROM `lc_tbllanguage` ORDER BY LanguageID ASC';
										$result = mysql_query_exequter_with_return($sql);
										while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
										{
											for($i = 0; $i < 1; $i++) 
											{
											$LanguageID[$i] = $row["LanguageID"];	
											$LanguageDesc[$i] = $row["LanguageDesc"];	
											$LanguagePrefix[$i] = $row["LanguagePrefix"];
											
											if($LanguageID[$i] == 1)
											{
											}
											else
											{
											echo "<tr>";
											echo	"<td class='first-cell'>$LanguageID[$i]</td>";
											echo	"<td>$LanguageDesc[$i]</td>";
											echo	"<td>$LanguagePrefix[$i]</td>";
											echo	"<td class='last-cell'><a class='lc-deleteItem' title='$liveconcms_languagetext6 \"$LanguageDesc[$i]\"' href='?del_lang=$LanguageID[$i]'>$liveconcms_languagetext6 \"$LanguageDesc[$i]\"?</a></td>";
											echo "</tr>";
											}
										}
									}
									
								?>
							</tbody>	
						</table>
				</div>
			
		<hr />
			
		<div class="ui-widget ui-widget-content ui-corner-all" id="licens-box">
			<span class="ui-widget-header ui-corner-top ui-helper-clearfix"><h3><?PHP echo "$liveconcms_languagetext7"; ?></h3></span>				
					<div class="ui-widget-content">
							<fieldset>
							<strong><?PHP echo "$liveconcms_languagetext8"; ?></strong> 
									<input type="text" value="" name="newLanguage"/>
										<em><?PHP echo "$liveconcms_languagetext9"; ?></em>
							</fieldset>
							
							<fieldset>
								<strong><?PHP echo "$liveconcms_languagetext10"; ?></strong> 
										<input type="text" value="" name="newPrefix"/>
											<em><?PHP echo "$liveconcms_languagetext11"; ?></em>
							</fieldset>
							
							<fieldset>
								<input name="Submit_sitelanguage" type="submit" value="<?PHP echo "$liveConCMS_regularbutton_2"; ?>" />
									<input name="Reset1" type="reset" value="<?PHP echo "$liveConCMS_regularbutton_4"; ?>" />
							</fieldset>
								
					</div>
		</div>
			
				
				
		</form>			
		<hr />
		
		
	
	</div><!-- .body-wrapper -->

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
	


</body>

</html>
