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
checkRole($_SESSION['sess_role'], 'liveconcms_statistics');

$avgday = 0;
$bigtotal  = 0;
$Totalavghits = 0;
$TotalavghitsHourly = 0;

$sql = "SELECT TO_DAYS(MAX(Recieved)) - TO_DAYS(MIN(Recieved)) AS record FROM lc_tblvisitorlogg";  
$results = mysql_query_exequter_with_return($sql);  
while ($myrow = mysql_fetch_array($results)) {  
$avgday = $myrow["record"];  
}  

$sql =  "SELECT COUNT(*) AS CNT FROM lc_tblvisitorlogg" ;  
$results = mysql_query_exequter_with_return($sql);   
while ( $myrow  =  mysql_fetch_array ($results )) 
{  
$bigtotal  =  $myrow ["CNT" ];  
}

if($avgday != 0)
{
$Totalavghits  = ( $bigtotal /$avgday );  
$Totalavghits  =  round ( $Totalavghits ); 
}
$TotalavghitsHourly = round ( $Totalavghits / 24 );
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LiveCon CMS - <?PHP echo "$liveConCMS_HtmlTitle_19";?></title>

<!-- Load javascripts for CMS backend -->
<?PHP include("liveconcms_editonpageheader.php");?>

<!-- Stylesheets for the CMS -->
<link rel="stylesheet" type="text/css" href="skins/reset.css">
<link rel="stylesheet" type="text/css" href="skins/styles.php">

</head>

<body class="lc-body">
<?PHP
include("liveconcms_panel.php");
?>

<div class="bodywrapper container_12">
			
				
		<div class="container_wrapper">
		
			<h1 class="page-title"><?PHP echo "$liveConCMS_PageTitle_15"; ?></h1>
			<p><?PHP echo "$liveConCMS_pageText13_1"; ?></p>
			
			
			<hr />
			
			
			<div class="ui-widget ui-widget-content ui-corner-all" id="lc-stats-simple-01">
				<span class="ui-widget-header ui-corner-top ui-helper-clearfix"><h3><?PHP echo "$liveConCMS_menuText13_1"; ?></h3></span>
					
						<table class="ui-widget ui-corner-all tbl-style-1">
							<thead>
								<tr>
									<td class="first-cell"><span><?PHP echo "$liveConCMS_menuText13_2"; ?></span></td>
									<td><span><?PHP echo "$liveConCMS_menuText13_3"; ?></span></td>
									<td class="last-cell"><span><?PHP echo "$liveConCMS_menuText13_4"; ?></span></td>
								</tr>
							</thead>
						
							<tbody>
								<?PHP
									$sql = 'SELECT * FROM `lc_tblvisitorlogg` ORDER BY ID DESC LIMIT 0,5';
									$result = mysql_query_exequter_with_return($sql); 
									while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
									{
										for($i = 0; $i < 1; $i++) 
										{
										$statisticBrowser[$i] = $row["Browser"];	
										$statisticIP[$i] = $row["IP"];
										$statisticRevieved[$i] = $row["Recieved"];
									
									
									
										echo "<tr>";
										echo	"<td class='first-cell'><span>$statisticBrowser[$i]</span></td>";
										echo	"<td><span>$statisticIP[$i]</span></td>";
										echo	"<td class='last-cell'><span>$statisticRevieved[$i]</span></td>";
										echo "</tr>";
									
										}
									}
								
								
								?>	
							</tbody>
					</table>
		
			</div>
			
			<hr />
			
			<div class="ui-widget ui-widget-content ui-corner-all" id="lc-stats-simple-02">
				<span class="ui-widget-header ui-corner-top ui-helper-clearfix"><h3><?PHP echo "$liveConCMS_menuText13_5"; ?></h3></span>			
						<table class="ui-widget ui-corner-all tbl-style-1">
							<thead>
								<tr>
									<td class="first-cell"><span><?PHP echo "$liveConCMS_menuText13_6"; ?></span></td>
									<td><span><?PHP echo "$liveConCMS_menuText13_7"; ?></span></td>
									<td class="last-cell"><span><?PHP echo "$liveConCMS_menuText13_8"; ?></span></td>
								</tr>
							</thead>
						
							<tbody>
								<tr>
									<td class="first-cell"><span><?PHP echo $bigtotal; ?></span></td>
									<td><span><?PHP echo $Totalavghits; ?></span></td>
									<td class="last-cell"><span><?PHP echo $TotalavghitsHourly; ?></span></td>
								</tr>
							</tbody>					
					</table>				
			</div>
			
			<hr />
			
			<div class="ui-widget ui-widget-content ui-corner-all" id="site-title">
				<span class="ui-widget-header ui-corner-top ui-helper-clearfix"><h3><?PHP echo "$liveConCMS_menuText13_9"; ?></h3></span>
					<div class="ui-widget-content">
						<p><?PHP echo "$liveConCMS_pageText13_2"; ?></p>
						<a href="http://google.se/analytics" target="_blank"><?php echo "$liveconcms_statisticstlink1"; ?></a>
					</div>		
			</div>
			
		</div>	
		
	<hr />

	<a class="goback" href="../"><?PHP echo "$liveConCMS_links4"; ?></a>
	
	<hr />
	
	</div>
	
	
	<?PHP include("liveconcms_footer.php");?>

</body>

</html>
