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
liveConCMS_SystemPageID('.','..','0','1','0','index.php','system');
checkRole($_SESSION['sess_role'], 'liveconcms_modules');
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LiveCon CMS - <?PHP echo "$liveConCMS_HtmlTitle_7";?></title>

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

<body class="lc-body">

<?PHP
include("liveconcms_panel.php");
?>


	
	<div class="bodywrapper container_12">
			
		
			<h1 class="page-title"><?PHP echo "$liveConCMS_PageTitle_6";?></h1>
			<p><?PHP echo "$liveConCMS_pageText5_1";?></p>
			
			
			
			<hr />
			
			
			
			<a class="ui-button" title="<?PHP echo "$OnPageToolTip_10"; ?>" href="?update_plugin=1"><?PHP echo "$liveConCMS_button_4";?></a>
			
			
			
			<hr />
			
			
			
				
			<?PHP
	
			$SQLModules = "SELECT COUNT(*) FROM `lc_tblmodules`";
			$resultatModules= mysql_query_exequter_with_return($SQLModules);
			while ($rowModules = mysql_fetch_array($resultatModules, MYSQL_ASSOC))
			{
			$modulesCount = $rowModules["COUNT(*)"];
			}
			
			
			if($modulesCount == 0)
			{
			echo "<p><b>$liveConCMS_pageText5_2</b></p>";
			}
			else
			{
			
				echo "
					<table class='ui-widget ui-widget-content ui-corner-all tbl-style-1' id='lc-plugin-list'>
						<thead>
							<tr>
								<td class='ui-widget-header ui-corner-tl first-cell'>$liveConCMS_menuText5_1</td>
								<td class='ui-widget-header'>$liveConCMS_menuText5_2</td>
								<td class='ui-widget-header'>$liveConCMS_menuText5_3</td>
								<td class='ui-widget-header ui-corner-tr last-cell'>$liveConCMS_menuText5_4</td>
							</tr>
						</thead>
	
						<tbody>";			
			
			
			

					$sql = 'SELECT * FROM `lc_tblmodules` ORDER BY ID ASC';
					$result = mysql_query_exequter_with_return($sql);
					while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
					{
						for($i = 0; $i < 1; $i++) 
						{
						$moduleID[$i] = $row["ID"];	
						$moduleTitle[$i] = $row["pluginTitle"];	
						$modulePath[$i] = $row["pluginPath"];
						$moduleText[$i] = $row["pluginAbout"];
					
						echo "<tr>";
						echo "<td class='first-cell'>$moduleID[$i]</td>";
						echo "<td><a class='lc-module-link' href='plugins/$modulePath[$i]'>$moduleTitle[$i]</a></td>";
						echo "<td><p>$moduleText[$i]</p></td>";
						echo "<td class='last-cell'><a href='?delete_plugin=$moduleID[$i]' class='lc-deleteItem' title='$OnPageToolTip_9 &quot;$moduleTitle[$i]&quot;'>$OnPageToolTip_9 &quot;$moduleTitle[$i]&quot;</a></td>";
						echo "</tr>";

						}
					}
				
				echo "</tbody>";
				echo "</table>";
				
			}			
			?>
					

			
	
	</div> <!-- .bodywrapper -->
	
	
	<hr />	
	
	
	
	<?PHP include("liveconcms_footer.php");?>



</body>

</html>
