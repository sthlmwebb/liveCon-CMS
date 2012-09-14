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

$languagePath = $_SESSION['sess_language'];
include("core/language/$languagePath/language.php");

include("core/include/dbConn.php");
include("core/liveconcms_systemcore.php");
include("core/liveconcms_systemheader.php");
include("core/liveconcms_systemactions.php");

liveConCMS_SystemPageID('.','..','0','1','0','index.php','system');
checkRole($_SESSION['sess_role'], 'liveconcms_menus');

$sitelanguage = $_SESSION['sess_sitelanguage'];

$sql_upload = "SELECT manualupload FROM `lc_tblconfig` WHERE ID ='1'";
$result_upload = mysql_query($sql_upload) or die('Query failed: ' . mysql_error());
while ($row_upload = mysql_fetch_array($result_upload, MYSQL_ASSOC))
{				
$manualupload = $row_upload["manualupload"];	
}

$error_list[0] = $liveConCMS_error_message_1;
$error_list[1] = $liveConCMS_error_message_2;
$error_list[2] = $liveConCMS_error_message_3;	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LiveCon CMS - <?PHP echo "$liveConCMS_HtmlTitle_1";?></title>

<!-- Load javascripts for CMS backend -->
<?PHP include("liveconcms_editonpageheader.php");?>

<!-- Load the stylesheets used by the CMS -->
<link rel="stylesheet" type="text/css" href="skins/reset.css">
<link rel="stylesheet" type="text/css" href="skins/styles.php">


<script>
$(document).ready(function(){
	$(".lc-deleteItem").lcDeleteItem();		
});
</script>
<?PHP
if (isset($_SESSION['sess_tmpnoticehuvudmeny']))
{	
	echo "<script type='text/javascript'>
		$(document).ready(function(){
			$('body').append('<div id=\"freeow\"></div>');
			$('#freeow').freeow('$liveconcms_noticepopuptext1', '$liveconcms_noticepopuptext5', {
				classes: ['lc-notice ui-widget-content ui-state-highlight ui-corner-all ui-box-shadow'],
				autoHide: true
			});
		});
	</script>";
	unset($_SESSION['sess_tmpnoticehuvudmeny']);
}

if (isset($_SESSION['sess_tmpnoticesubmeny']))
{
	echo "<script type='text/javascript'>
		$(document).ready(function(){
			$('body').append('<div id=\"freeow\"></div>');
			$('#freeow').freeow('$liveconcms_noticepopuptext1', '$liveconcms_noticepopuptext6', {
				classes: ['lc-notice ui-widget-content ui-state-highlight ui-corner-all ui-box-shadow'],
				autoHide: true
			});
		});
	</script>";
	unset($_SESSION['sess_tmpnoticesubmeny']);
}

if (isset($_SESSION['sess_menyupdated']))
{
	echo "<script type='text/javascript'>
		$(document).ready(function(){
			$('body').append('<div id=\"freeow\"></div>');
			$('#freeow').freeow('$liveconcms_noticepopuptext3', '$liveconcms_noticepopuptext7', {
				classes: ['lc-notice ui-widget-content ui-state-highlight ui-corner-all ui-box-shadow'],
				autoHide: true
			});
		});
	</script>";
	unset($_SESSION['sess_menyupdated']);
}
?>

</head>

<body class="lc-body">

<?PHP
include("liveconcms_panel.php");
?>

<div class="bodywrapper container_12">



			<h1 class="page-title"><?PHP echo "$liveconcms_new_menuText1"; ?></h1>
				<p><?PHP echo "$liveconcms_new_menuText2"; ?></p>
		
		
				<hr />	
				
				
				<?PHP echo "<a id='button-addNew-Menu' class='addButton' href='liveconcms_addmenu.php'>$liveConCMS_button_1</a><hr />";?>


				
				<div id="accordion">
			
				<!--  START LOOP-->
							
				<?PHP
				$menuNumber = 1;
				$sqlmenu = "SELECT * FROM `lc_tblmeny`,`lc_tblmenytext` WHERE lc_tblmeny.ID = lc_tblmenytext.MenyID AND lc_tblmenytext.LanguageID = '$sitelanguage' ORDER BY `sort` ASC";
				$resultmenu = mysql_query_exequter_with_return($sqlmenu);
									while ($rowmenu = mysql_fetch_array($resultmenu, MYSQL_ASSOC))
									{																		
										for($i = 0 ; $i < 1; $i++) 
										{
											$MenyID = $rowmenu["ID"];
											$MenyTitle = $rowmenu["MenyText"];
										    $MenyActive = $rowmenu["Active"];
																					
												if($menuNumber == 1)
												{
												echo "<h3 class='current firstpane'><a href='#'>$liveConCMS_pageSite1_menu $menuNumber - $MenyTitle</a></h3>\n";	
												echo "<div class='pane' style='display:block'>\n";								
												}
												else
												{
												echo "<h3><a href='#'>$liveConCMS_pageSite1_menu $menuNumber - $MenyTitle</a></h3>\n";	
												echo "<div class='pane'>\n";								
												}
												
												echo "<form method='post' action='liveconcms_menus.php?updateid=$MenyID' enctype='multipart/form-data'>\n";
						
											
															if ($MenyActive == 1)
															{
																/* Pekar mot automatisk uppladdning eller mot manuell */
																
																echo "	<div class='main-nav-settings'>
																			<input id='activate-main-nav-$menuNumber' name='Meny' type='checkbox'  checked='checked' />
																				<label for='activate-main-nav-$menuNumber'>$liveConCMS_pageSite1_Checkbox1</label>
																		
																					<ul>
																						<li><a class='button-edit-mainNav' href ='liveconcms_editmenu.php?menuid=$MenyID'>$OnPageToolTip_6</a></li>
																							<li><a class='lc-deleteItem button-delete-mainNav' href ='?del_meny_menuid=$MenyID'>$OnPageToolTip_7</a></li>
																								<li><a class='addButton' href ='liveconcms_addsubmenu.php?menuid=$MenyID'>$liveConCMS_button_2</a>\n</li>
																					</ul>
																		</div>";
																
																
																	
															echo "	<hr />";
															}
															else
															{
																
																echo "	<div class='main-nav-settings'>
																		<input id='activate-main-nav-$menuNumber' name='Meny' type='checkbox'>
																			<label for='activate-main-nav-$menuNumber'>$liveConCMS_pageSite1_Checkbox2</label>
																									
																				<ul>														
																					<li><a class='button-edit-mainNav' href ='liveconcms_editmenu.php?menuid=$MenyID'>$OnPageToolTip_6</a></li>
																						<li><a class='lc-deleteItem button-delete-mainNav' href ='?del_meny_menuid=$MenyID'>$OnPageToolTip_7</a></li>
																							<li><a class='addButton' href ='liveconcms_addsubmenu.php?menuid=$MenyID'>$liveConCMS_button_2</a>\n</li>
																				
																	</div>";
																
																
																
															echo "	<hr />";
															}
														
					
					
																$sqlSub = "SELECT * FROM `lc_tblsubcat`, `lc_tblsubcattext` WHERE lc_tblsubcat.MenyID = '$MenyID' AND lc_tblsubcattext.LanguageID = '$sitelanguage' AND lc_tblsubcat.SubID = lc_tblsubcattext.SubID ORDER BY `sort` ASC";
																
																$resultSub = mysql_query_exequter_with_return($sqlSub);
																while ($rowSub = mysql_fetch_array($resultSub, MYSQL_ASSOC))
																{
																	for($j = 0 ; $j < 1; $j++) 
																	{
																		$SubID[$j] = $rowSub["SubID"];
																		$SubText[$j] = $rowSub["SubText"];
																		$SubLink[$j] = $rowSub["SubLink"];
																		$SubActive[$j] = $rowSub["Active"];
																		$SubMenyIndex[$j] = $rowSub["MenyIndex"];

																		echo "	<div class='submenu_list_container'>";
																		echo "		<ul class='submenu_list_options-1'>";
																		echo "			<li class='submenu_name'><b>$liveConCMS_menuText1_1&nbsp;</b><span>$SubText[$j]</span></li>";
																		echo "				<li class='submenu_link'><b>$liveConCMS_menuText1_2&nbsp;</b><span>$SubLink[$j]</span></li>";
																		
																		if ($manualupload == 0)
																		{
																			if(	$SubMenyIndex[$j] == "0")
																			{																		
																			echo "	<li class='submenu_file'><input type='file' name='File$SubID[$j]' /></li>";
																			}
																			else
																			{
																			echo "	<li class='submenu_file'><input type='file' name='File$SubID[$j]' disabled='disabled' /></li>";
																			}
																		}
																			echo "	</ul>";
																			
																				IF ($SubActive[$j] == "1")
																				{
																				
																					if ($SubMenyIndex[$j] == 0)
																					{
																						echo "	<ul class='submenu_list_options-2'>";
																						echo "		<li class='activate-submenu'>
																										<input id='activate-submenu-$SubID[$j]' type='checkbox' name='Checkbox$SubID[$j]' checked='checked'/>
																											<label for='activate-submenu-$SubID[$j]'>$liveConCMS_pageSite1_Checkbox3</label>
																									</li>
																									
																									<li class='sub-like-nav'>
																										<input id='sub-like-nav$SubID[$j]' type='checkbox' name='CheckboxMeny$SubID[$j]'/>
																											<label for='sub-like-nav$SubID[$j]'>$OnPageToolTip_4</label>
																									</li>
																								
																									<li class='delete-sub'><a class='lc-deleteItem deleteButton' href ='?del_meny_subid=$SubID[$j]'>$OnPageToolTip_9</a></li>\n";
																									
																						echo "	</ul>";
																					}
																					else
																					{
																						echo "	<ul class='submenu_list_options-2'>";																					
																						echo "		<li class='activate-submenu'>
																										<input id='activate-submenu-$SubID[$j]' type='checkbox' name='Checkbox$SubID[$j]' checked='checked'/>
																											<label for='activate-submenu-$SubID[$j]'>$liveConCMS_pageSite1_Checkbox3</label>
																									</li>

																									<li class='sub-like-nav'>
																										<input id='sub-like-nav$SubID[$j]' type='checkbox' name='CheckboxMeny$SubID[$j]' checked='checked'/>
																											<label for='sub-like-nav$SubID[$j]'>$OnPageToolTip_5</label>
																									</li>	
																									
																									<li class='delete-sub'><a class='lc-deleteItem deleteButton' href ='?del_meny_subid=$SubID[$j]'>$OnPageToolTip_3</a></li>\n";
																						echo "	</ul>";
																					}
																			
																				}
																				else
																				{
																				
																					if ($SubMenyIndex[$j] == 0)
																					{
																					echo "	<ul class='submenu_list_options-2'>";
																					echo "		<li class='activate-submenu'>
																									<input id='activate-submenu-$SubID[$j]' type='checkbox' name='Checkbox$SubID[$j]'/>
																										<label for='activate-submenu-$SubID[$j]'><em>$liveConCMS_pageSite1_Checkbox4</em></label>
																								</li>
																								
																								<li class='sub-like-nav'>
																									<input id='sub-like-nav$SubID[$j]' type='checkbox' name='CheckboxMeny$SubID[$j]'/>
																										<label for='sub-like-nav$SubID[$j]'>$OnPageToolTip_4</label>
																								</li>	
																								
																								<li class='delete-submenu'><a class='lc-deleteItem deleteButton' href ='?del_meny_subid=$SubID[$j]'>$OnPageToolTip_3</a></li>\n";
																					echo "	</ul>";
																					}
																					else
																					{
																					echo "	<ul class='submenu_list_options-2'>";
																					echo "		<li class='activate-submenu'>
																									<input id='activate-submenu-$SubID[$j]' type='checkbox' name='Checkbox$SubID[$j]'/>
																										<label for='activate-submenu-$SubID[$j]'>$liveConCMS_pageSite1_Checkbox4</label>
																								</li>
																								
																								<li class='sub-like-nav'>	
																									<input id='sub-like-nav$SubID[$j]' type='checkbox' name='CheckboxMeny$SubID[$j]' checked='checked'/>
																										<label for='sub-like-nav$SubID[$j]'>$OnPageToolTip_5</label>
																								</li>
																								
																								<li class='delete-submenu'><a class='lc-deleteItem deleteButton' href ='?del_meny_subid=$SubID[$j]'>$OnPageToolTip_3</a></li>\n";
																					echo "	</ul>";
																					
																					}
																				}
																		
																			echo "</div>";
																		}
																}
												
						
						
											echo "<hr />";
												
											echo	"<input name='submit_meny' type='submit' value='$liveConCMS_regularbutton_2' />\n";
											echo	"<input name='Reset' type='reset' value='$liveConCMS_regularbutton_4' />\n";
												
											echo	"</form>\n";
											echo "</div>\n";
											
											// Stegar upp menyn 1 steg
											$menuNumber = $menuNumber + 1;
											
											}	
										}
									
					?>
					<!-- SLUT LOOP -->
				
					<!-- SLUT -->

				</div><!-- #accordion -->

	

		<hr />
		
			
	
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
