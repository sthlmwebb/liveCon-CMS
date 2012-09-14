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
checkRole($_SESSION['sess_role'], 'liveconcms_writenews');


if (isset($_GET['dsp_language']) == "")
{
 $displaylangId =1;
}
else
{
 $displaylangId = (int) isset($_GET['dsp_language']) ? $_GET['dsp_language'] : dsp_language('n');
}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LiveCon CMS - <?PHP echo "$liveConCMS_HtmlTitle_5";?></title>

<!-- Load javascripts for CMS backend -->
<?PHP 
include("liveconcms_editonpageheader.php");?>

<script type="text/javascript" src="js/mce-advanced-setup.php"></script>

<!-- Load the stylesheets used by the CMS -->
<link rel="stylesheet" type="text/css" href="skins/reset.css">
<link rel="stylesheet" type="text/css" href="skins/styles.php">

<?PHP
if (isset($display_noticemessage))
{
	echo "<script type='text/javascript'>
		$(document).ready(function(){
			$('body').append('<div id=\"freeow\"></div>');
			$('#freeow').freeow('$liveconcms_noticepopuptext1', '$liveconcms_noticepopuptext8', {
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
			
			<h1 class="page-title"><?PHP echo "$liveConCMS_PageTitle_5";?></h1>
			
			<p><?PHP echo "$liveConCMS_pageText4_1";?></p>
			<p><?PHP echo "$liveConCMS_pageText4_2";?></p>
	
			<hr />

			<!-- Droppis -->
			<?PHP
			if($AntalSprak > 1)
			{
				echo "<p>Visa nyheter postade på:</p>";
				echo "<select name='Language' class=dropdown>";
						$sql = 'SELECT * FROM `lc_tbllanguage` ORDER BY LanguageID ASC';
						$result = mysql_query_exequter_with_return($sql); 
						while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
							{
								for($i = 0; $i < 1; $i++) 
								{
								$LanguageID[$i] = $row["LanguageID"];	
								$LanguageDesc[$i] = $row["LanguageDesc"];	
								
									if($displaylangId == $LanguageID[$i])
									{
									echo "<option value=\"$LanguageID[$i]\" selected>$LanguageDesc[$i]</option>\n"; 
									}
									else
									{
									echo "<option value=\"$LanguageID[$i]\">$LanguageDesc[$i]</option>\n"; 
									}
								}
							}
				echo "</select>";
				echo "<hr/>";
			}
			?>
			<!-- Droppis -->
			
			<table class="ui-widget ui-widget-content ui-corner-all tbl-style-1" id="tbl-news-list">
				<thead>
					<tr>
						<td class="ui-widget-header ui-corner-tl first-cell"><?PHP echo "$liveConCMS_WindowTitle_23";?></td>
						<td class="ui-widget-header"><?PHP echo "$liveConCMS_WindowTitle_24";?></td>
						<td class="ui-widget-header tbl-edit-item-cell"><?PHP echo "$liveConCMS_WindowTitle_25";?></td>
						<td class="ui-widget-header tbl-delete-item-cell ui-corner-tr last-cell"><?PHP echo "$liveConCMS_WindowTitle_26";?></td>
					</tr>
				</thead>

				
			<tbody>	
				<?PHP
				
				$sql = "SELECT * FROM `lc_tblnews` WHERE LanguageID = '$displaylangId' ORDER BY Date DESC LIMIT 0,5";
				$result = mysql_query_exequter_with_return($sql); 
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
				for($i = 0; $i < 1; $i++) 
				{
				$NewsID[$i] = $row["ID"];	
				$NewsTitle[$i] = $row["Title"];
				$NewsText[$i] = nl2br($row["News"]);
				$NewsDate[$i] = $row["Date"];
				
				echo "	<tr>";
				echo "		<td class='first-cell'>$NewsDate[$i]</td>";
				echo "		<td>$NewsTitle[$i]</td>";
				echo "		<td class='tbl-edit-item-cell'><a class='lc-editItem' href='?red_news_id=$NewsID[$i]' title='$OnPageToolTip_8 &quot;$NewsTitle[$i]&quot;'>Editera nyheten</a></td>";
				echo "		<td class='tbl-delete-item-cell last-cell'><a class='lc-deleteItem' href='?del_news_id=$NewsID[$i]' title='$OnPageToolTip_9 &quot;$NewsTitle[$i]&quot;'>Ta bort nyheten</a></td>";
				echo "	</tr>";				
				}
				}
				
			IF($red_id != "0")
			{

				$sql = "SELECT * FROM `lc_tblnews` WHERE ID = '$red_id'";
				$result = mysql_query_exequter_with_return($sql);
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
				$newsLanguageId = $row["LanguageID"];
				$newsTitle = $row["Title"];
				$newsText = $row["News"];
				}

			}
			else
			{
			$newsLanguageId = 0;
			$newsTitle = "";
			$newsText = "";
			}



			?>
			</tbody>			
			
				
			</table>
			
			
			
			<hr />
			
			
			
			<a class="ui-button" href="liveconcms_newsarchive.php"><?PHP echo "$liveConCMS_regularbutton_7"; ?></a>
			
			
			
			<hr />
			
			
			
			<div class="ui-widget ui-widget-content ui-corner-all">
				<span class="ui-widget-header ui-corner-top ui-helper-clearfix"><h3><?PHP echo "$liveConCMS_WindowTitle_4"; ?></h3></span>
					<div class="ui-widget-content">
						<form method="post" name="submitnews">
							<fieldset>
								<b><?PHP echo "$liveConCMS_menuText4_1"; ?></b>
								<input name="newsTitle" type="text" value="<?PHP echo $newsTitle ;?>" />
								<em><?PHP echo "$liveConCMS_menuText4_2"; ?></em>
							</fieldset>
							
							<!-- Droppis -->
							<?PHP
							if($AntalSprak > 1)
							{
								echo "<fieldset>
									<b>Spara nyheten i språk:</b>";
									
										echo "<select name='SaveLanguage' class=dropdown>";
										echo "<option value=\"0\" selected>$liveconcms_NewsDropdown</option>\n";
										
										$sql = 'SELECT * FROM `lc_tbllanguage` ORDER BY LanguageID ASC';
										$result = mysql_query_exequter_with_return($sql); 
										while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
											{
												for($i = 0; $i < 1; $i++) 
												{
												$LanguageID[$i] = $row["LanguageID"];	
												$LanguageDesc[$i] = $row["LanguageDesc"];
												$LanguageNewsID[$i] = $row["LanguageID"];

													if($LanguageNewsID[$i]== $newsLanguageId)
													{
													echo "<option value=\"$LanguageID[$i]\" selected>$LanguageDesc[$i]</option>\n"; 
													}
													else	
													{		
													echo "<option value=\"$LanguageID[$i]\">$LanguageDesc[$i]</option>\n"; 
													}

												}
											}
										echo "</select>";
									
								echo "<em>beskrivning</em>
									</fieldset>";
							}
							?>
							<!-- Droppis -->
							
							<fieldset>
								<b><?PHP echo "$liveConCMS_menuText4_3"; ?></b>
								<textarea name="newsText" cols="80" rows="15" class="input" id="intra_mce_content"><?PHP echo $newsText ;?></textarea>
							</fieldset>
							<fieldset>
								<input name="submit_news" type="submit" value="<?PHP echo "$liveConCMS_regularbutton_5"; ?>" />
								<input name="Reset" type="reset" value="<?PHP echo "$liveConCMS_regularbutton_4"; ?>" />
								<input name="submit_new_news" type="submit" value="<?PHP echo "$liveConCMS_regularbutton_6"; ?>" />
							</fieldset>
						</form>
					</div>
			</div>

			
			
		<hr />
		


	</div><!-- .bodywrapper -->
	


<?PHP include("liveconcms_footer.php");?>

	
<script>
$(document).ready(function(){
	$(".lc-deleteItem").lcDeleteItem();
	
	$("select[name=Language]").change(function(){
		var languageID = $(this).val();
		var url = window.location.href;
		window.location.href = sPage + "?dsp_language=" + languageID;
	});	
	
	$("form").submit(function(){
		var newsTitle = $("input[name=newsTitle]").val();
		var newsText = $("#intra_mce_content_ifr").contents().find(".mceContentBody").text();

		if ( newsTitle.length === 0 ) { lcErrorPopup('writenews-1'); return false; }
		if ( newsText.length === 0 ) { lcErrorPopup('writenews-2'); return false; }
		
		
	});
	
});
</script>


</body>

</html>
