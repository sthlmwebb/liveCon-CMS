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
checkRole($_SESSION['sess_role'], 'liveconcms_newsarchive');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LiveCon CMS - <?PHP echo "$liveConCMS_HtmlTitle_6";?></title>

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


</head>

<body class="lc-body container_12">

<?PHP
include("liveconcms_panel.php");
?>

<div class="bodywrapper">
							
			<h1 class="page-title"><?PHP echo "$liveConCMS_PageTitle_12";?></h1>
			<p><?PHP echo "$liveConCMS_pageText4_3";?></p>
	
	
			<hr />
	
	
			<table class="ui-widget ui-widget-content ui-corner-all tbl-style-1" id="tbl-news-archive">
				<thead>
					<tr>
						<td class="ui-widget-header ui-corner-tl first-cell"><?PHP echo "$liveConCMS_WindowTitle_23";?></td>
						<td class="ui-widget-header"><?PHP echo "$liveConCMS_WindowTitle_24";?></td>
						<td class="ui-widget-header tbl-edit-item-cell"><?PHP echo "$liveConCMS_WindowTitle_25";?></td>
						<td class="ui-widget-header tbl-delete-item-cell ui-corner-tr last-cell"><?PHP echo "$liveConCMS_WindowTitle_26";?></td>
					</tr>
				</thead>

				
				
					<?PHP					
					
						$Traffar = "SELECT COUNT(*) FROM `lc_tblnews`";
						$Restraffar = mysql_query_exequter_with_return($Traffar);
						while ($rowtraffar = mysql_fetch_array($Restraffar, MYSQL_ASSOC))
						{
						$Antal = $rowtraffar["COUNT(*)"];
						}
						
						$newoffset = "";
						// Nu bestämmer vi antal per sida och kollar vi upp totala antalet
						$limit = 15; // Antal per sida
					
						$result = @mysql_query("SELECT count(*) as count FROM `lc_tblnews`")
						  or die("Error fetching number in DB<br>".mysql_error());
						$row = @mysql_fetch_array($result);
						$numrows = $row['count']; // Antal i databasen
						 
						// Sedan kollar vi om startvariabeln är satt
						if (!isset($_GET['start']) || $_GET['start'] == "")
						  $start = 0;
						else
						  $start = $_GET['start'];
						 
						// Då räknar vi ut hur många sidor det blev
						$pages = intval($numrows/$limit);
						if ($numrows%$limit)
						  $pages++;
						 
						// Hämta länk till förstasidan och föregående sida
						if ($start > 0) {
						  $numlink = '<a class="lc-numlink lc-numlink-first ui-corner-left " href="?start=0">&laquo;&laquo;</a> ';
						  $numlink .= '<a class="lc-numlink lc-numlink-prev" href="?start='.($start - $limit).'">&laquo;</a> ';
						} else {
						  $numlink = '<a class="lc-numlink lc-numlink-first ui-corner-left ui-state-disabled" >&laquo;&laquo;</a> ';
						  $numlink .= '<a class="lc-numlink lc-numlink-prev ui-state-disabled" >&laquo;</a> ';
						}
						 
						// Hämta sidonummer
						for ($i = 1; $i <= $pages; $i++) {
						  $newoffset = $limit*($i-1);
						  if ($start == $newoffset)
							$numlink .= '<a class="lc-numlink lc-numlink-current ui-state-disabled">['.$i.']</a> ';
						  else
							$numlink .= '<a class="lc-numlink lc-numlink-next-link" href="?start='.$newoffset.'">'.$i.'</a> ';
						}
						 
						// Hämta länk till nästa sida
						if ($numrows > ($start + $limit))
						  $numlink .= '<a class="lc-numlink lc-numlink-next" href="?start='.($start + $limit).'">&raquo;</a> ';
						else
						  $numlink .= '<a class="lc-numlink lc-numlink-next ui-state-disabled">&raquo;</a> ';
						 
						// Hämta sista sidan
						if ($start != $newoffset)
						  $numlink .= '<a class="lc-numlink lc-numlink-last ui-corner-right" href="?start='.$newoffset.'">&raquo;&raquo;</a> ';
						else
						  $numlink .= '<a class="lc-numlink lc-numlink-last ui-corner-right ui-state-disabled">&raquo;&raquo;</a>';

					
					$sql = 'SELECT * FROM `lc_tblnews` ORDER BY Date DESC LIMIT '.$start.', '.$limit.'';
					$result = mysql_query_exequter_with_return($sql);
					while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
					{
					for($i = 0; $i < 1; $i++) 
					{
					$NewsID[$i] = $row["ID"];	
					$NewsTitle[$i] = $row["Title"];
					$NewsText[$i] = nl2br($row["News"]);
					$NewsDate[$i] = $row["Date"];
					
					
					
					echo "<tbody>";
					echo "	<tr>";
					echo "		<td class='first-cell'>$NewsDate[$i]</td>";
					echo "		<td>$NewsTitle[$i]</td>";
					echo "		<td class='tbl-edit-item-cell'><a class='lc-editItem' href='liveconcms_writenews.php?red_news_id=$NewsID[$i]' title='$OnPageToolTip_8 &quot;$NewsTitle[$i]&quot;'>Redigera nyheten</a></td>";
					echo "		<td class='last-cell'><a class='lc-deleteItem' href='?del_news_archiveid=$NewsID[$i]' title='$OnPageToolTip_9 &quot;$NewsTitle[$i]&quot;'>Ta bort nyheten</a></td>";
					echo "	</tr>";				
					echo "</tbody>";
							
					
					}
				
					}
								
				IF($red_id != "0")
				{

				$sql = "SELECT * FROM `lc_tblnews` WHERE ID = '$red_id'";
				$result = mysql_query_exequter_with_return($sql);
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
				$newsTitle = $row["Title"];
				$newsText = $row["News"];
				}

				}
				else
				{
				
				$newsTitle = "";
				$newsText = "";
				}


					?>
					
			</table>
			 
		<span class="lc-page-switch buttonset"><?PHP echo $numlink; ?></span>
		

		
		<hr />
		
	
	
		<a class="goback" href="liveconcms_writenews.php"><?PHP echo "$liveConCMS_links1";?></a>
		
		
		
		<hr />
		
		
		
	</div> <!-- .bodywrapper -->
	
	
	
	<?PHP include("liveconcms_footer.php");?>



</body>

</html>
