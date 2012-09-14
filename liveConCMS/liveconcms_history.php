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
checkRole($_SESSION['sess_role'], 'liveconcms_history');

if (isset($_POST['clear_logg']))
{

deleteLogg();
	   
header("Refresh: 0;URL=liveconcms_history.php");
exit; 

}


	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?PHP echo "$liveconcms_historytext7"; ?></title>


<!-- Load javascripts for CMS backend -->
<?PHP include("liveconcms_editonpageheader.php");?>

<!-- Load the stylesheets used by the CMS -->
<link rel="stylesheet" type="text/css" href="skins/reset.css">
<link rel="stylesheet" type="text/css" href="skins/styles.php">

</head>

<body class="lc-body">

<?PHP
include("liveconcms_panel.php");
?>

<div class="bodywrapper container_12">



	<h1 class="page-title"><?PHP echo "$liveconcms_historytext1";?></h1>
		<p><?PHP echo "$liveconcms_historytext2";?></p>
			
	
	<hr>
	<form method="post">
		<input name="clear_logg" type="submit" value="Töm logg" />
	
	<hr />
	
		<div class="ui-widget ui-widget-content ui-corner-all" id="licens-box">
			<span class="ui-widget-header ui-corner-top ui-helper-clearfix"><h3><?PHP echo "$liveconcms_historytext3";?></h3></span>
				
	
						<table class="ui-widget ui-corner-all tbl-style-1">
							<thead>
								<tr>
									<td class="first-cell"><strong><?PHP echo "$liveconcms_historytext4";?></strong></td>
									<td><strong><?PHP echo "$liveconcms_historytext5";?></strong></td>
									<td><strong><?PHP echo "$liveconcms_historytext6";?></strong></td>
								</tr>
							</thead>
							<tbody>
						
						<?PHP	
						
						$Traffar = "SELECT COUNT(*) FROM `lc_tblhistory`";
						$Restraffar = mysql_query_exequter_with_return($Traffar);
						while ($rowtraffar = mysql_fetch_array($Restraffar, MYSQL_ASSOC))
						{
						$Antal = $rowtraffar["COUNT(*)"];
						}
						
						$newoffset = "";
					
						$limit = 15; 
					
						$result = @mysql_query("SELECT count(*) as count FROM `lc_tblhistory`")
						  or die("Error fetching number in DB<br>".mysql_error());
						$row = @mysql_fetch_array($result);
						$numrows = $row['count']; 
						 
			
						if (!isset($_GET['start']) || $_GET['start'] == "")
						  $start = 0;
						else
						  $start = $_GET['start'];
						 
		
						$pages = intval($numrows/$limit);
						if ($numrows%$limit)
						  $pages++;
						 
				
						if ($start > 0) {
						  $numlink = '<a class="lc-numlink lc-numlink-first ui-corner-left " href="?start=0">&laquo;&laquo;</a> ';
						  $numlink .= '<a class="lc-numlink lc-numlink-prev" href="?start='.($start - $limit).'">&laquo;</a> ';
						} else {
						  $numlink = '<a class="lc-numlink lc-numlink-first ui-corner-left ui-state-disabled" >&laquo;&laquo;</a> ';
						  $numlink .= '<a class="lc-numlink lc-numlink-prev ui-state-disabled" >&laquo;</a> ';
						}
						 
						
						for ($i = 1; $i <= $pages; $i++) {
						  $newoffset = $limit*($i-1);
						  if ($start == $newoffset)
							$numlink .= '<a class="lc-numlink lc-numlink-current ui-state-disabled">['.$i.']</a> ';
						  else
							$numlink .= '<a class="lc-numlink lc-numlink-next-link" href="?start='.$newoffset.'">'.$i.'</a> ';
						}
						 
					
						if ($numrows > ($start + $limit))
						  $numlink .= '<a class="lc-numlink lc-numlink-next" href="?start='.($start + $limit).'">&raquo;</a> ';
						else
						  $numlink .= '<a class="lc-numlink lc-numlink-next ui-state-disabled">&raquo;</a> ';
					
					
						if ($start != $newoffset)
						  $numlink .= '<a class="lc-numlink lc-numlink-last ui-corner-right" href="?start='.$newoffset.'">&raquo;&raquo;</a> ';
						else
						  $numlink .= '<a class="lc-numlink lc-numlink-last ui-corner-right ui-state-disabled">&raquo;&raquo;</a>';

								
								
								
								
										$sql = 'SELECT * FROM `lc_tblhistory`, `lc_tbladministrator` WHERE lc_tblhistory.UserID = lc_tbladministrator.ID ORDER BY lc_tblhistory.HistoryID DESC LIMIT '.$start.', '.$limit.'';
										$result = mysql_query_exequter_with_return($sql);
										while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
										{
											for($i = 0; $i < 1; $i++) 
											{
											$HistoryHistoryID[$i] = $row["HistoryID"];
											$HistoryFirstname[$i] = $row["Firstname"];	
											$HistoryFirstname[$i] = $row["Firstname"];	
											$HistoryLastname[$i] = $row["Lastname"];	
											$HistoryHistoryLogg[$i] = $row["HistoryLogg"];	
											$HistoryHistoryDate[$i] = $row["HistoryDate"];	
											
											echo "<tr>";
											echo	"<td class='first-cell'>$HistoryFirstname[$i] $HistoryLastname[$i]</td>";
											echo	"<td>$HistoryHistoryLogg[$i]</td>";
											echo	"<td>$HistoryHistoryDate[$i]</td>";
											echo "</tr>";
											
										}
									}
									
								?>
							</tbody>	
						</table>
					</form>	
					</div>
				<hr />	
			<span class="lc-page-switch buttonset"><?PHP echo $numlink; ?></span>
		<hr />
			
	
		
	
	</div><!-- .body-wrapper -->

		
<?PHP include("liveconcms_footer.php");?>
		


</body>

</html>
