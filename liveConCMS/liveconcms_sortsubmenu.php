<?PHP
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

if (!isset($_SESSION['sess_liveConCMSPageIndex'] [3]))
{
	header("Refresh: 0;URL=../");
	exit; 
}
else
{
	$menuid = $_SESSION['sess_liveConCMSPageIndex'] [3];
    $sitelanguage = $_SESSION['sess_sitelanguage'];
	$sqlmenu = "SELECT * FROM `lc_tblmeny`, `lc_tblmenytext`  WHERE lc_tblmeny.ID = '$menuid' AND lc_tblmeny.ID = lc_tblmenytext.MenyID AND lc_tblmenytext.LanguageID = '$sitelanguage'";
	$resultmenu = mysql_query($sqlmenu) or die('Error, insert query failed');
	while ($rowmenu = mysql_fetch_array($resultmenu, MYSQL_ASSOC))
	{
	$MenyText = $rowmenu["MenyText"];	
	}
}
						
?>

<script type="text/javascript" src="liveConCMS/js/lc-sortMenus.js"></script>
<link rel="stylesheet" href="liveConCMS/skins/editNav.css" type="text/css">

<div>

	<p><?PHP echo "$liveConCMS_Onpage_6"; ?> <i>"<?PHP echo "$MenyText";?>"</i> <?PHP echo "$liveConCMS_Onpage_10"; ?></p>

	<div id="lc-sort-subMenus-Wrapper">		
		<form method="post" action="liveConCMS/core/include/updateTextSubMenu.php">
			<fieldset>
				<ul class="ui-sort-Navigation ui-sort-subNav">
					<?php
					$sitelanguage = $_SESSION['sess_sitelanguage'];
					$query  = "SELECT * FROM lc_tblsubcat, lc_tblsubcattext WHERE lc_tblsubcat.MenyID = '$menuid' AND lc_tblsubcattext.LanguageID = '$sitelanguage' AND lc_tblsubcat.SubID = lc_tblsubcattext.SubID ORDER BY sort ASC";
					$result = mysql_query($query) or die('Error, insert query failed');
					
					while($row = mysql_fetch_array($result, MYSQL_ASSOC))
					{
					$SubMenyText = $row['SubText'];
					
					?>
						<li id="recordsArray_<?php echo $row['SubID']; ?>" class="lc-sort-menu-li-container ui-state-default ui-corner-all">
							<span class="ui-icon ui-icon-grip-dotted-vertical"></span>
								<input type="text" id="lc-sub-nav-id<?php echo $row['SubID']; ?>" name="subMenuText<?php echo $row['SubID']; ?>" value="<?php echo $SubMenyText; ?>" />
						</li>
					<?php } ?>
				</ul>
			</fieldset>
			
			<fieldset>
				<input type="submit" name="submit" value="<?PHP echo "$liveConCMS_regularbutton_2"; ?>" style="display:none;"/>
			</fieldset>
		</form>
	</div>	

</div>
	
	
	
	
	
	
	
	