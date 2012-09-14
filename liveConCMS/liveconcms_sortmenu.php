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
?>


<script type="text/javascript" src="liveConCMS/js/lc-sortMenus.js"></script>
<link rel="stylesheet" href="liveConCMS/skins/editNav.css" type="text/css">
			

<div>
			
	<p><?PHP echo "$liveConCMS_Onpage_4"; ?></p>

	
	
		<div id="lc-sort-mainMenus-Wrapper">
			<form method="post" action="liveConCMS/core/include/updateTextMenu.php">
				<fieldset>
					<ul class="ui-sort-Navigation ui-sort-mainNav">
						<?php
						$sitelanguage = $_SESSION['sess_sitelanguage'];
						$query  = "SELECT * FROM lc_tblmeny, lc_tblmenytext WHERE lc_tblmenytext.LanguageID = '$sitelanguage' AND lc_tblmeny.ID = lc_tblmenytext.MenyID  ORDER BY sort ASC";
						$result = mysql_query($query) or die('Error, insert query failed');
						
						while($row = mysql_fetch_array($result, MYSQL_ASSOC))
						{
						$MenyText = $row['MenyText'];
						$MenyID = $row['ID'];
						?>
							<li id="recordsArray_<?php echo $row['ID']; ?>" class="lc-sort-menu-li-container ui-state-default ui-corner-all">
								<span class="ui-icon ui-icon-grip-dotted-vertical"></span>
									<input id="lc-main-nav-id<?php echo $row['ID']; ?>" name="MenuText<?php echo $row['ID']; ?>" type="text" value="<?php echo "$MenyText" ?>"/>
							</li>	
						<?php } ?>
					</ul>
				</fieldset>
		
				<fieldset>
					<input type="submit" name="submit" value="<?PHP echo "$liveConCMS_regularbutton_2"; ?>" style="display:none;" />
				</fieldset>
			</form>
		</div><!-- #lc-sortmenus-Wrapper -->

</div>