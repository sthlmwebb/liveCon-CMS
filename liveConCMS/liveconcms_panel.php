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

$Path = $_SESSION['sess_liveConCMSPageIndex'] [0];
$editPath = $_SESSION['sess_liveConCMSPageIndex'] [1];
$nav = $_SESSION['sess_liveConCMSPageIndex'] [2];
$pageEditID = $_SESSION['sess_liveConCMSPageIndex'] [3];
$pageEditSubID = $_SESSION['sess_liveConCMSPageIndex'] [4];
$pageEditfilename = $_SESSION['sess_liveConCMSPageIndex'] [5];
$SystemFile = $_SESSION['sess_liveConCMSPageIndex'] [6];

if (!isset($_SESSION['sess_id']))
{
  $_SESSION['sess_id'] = ""; 
}

if ($_SESSION['sess_id'] == "")
{

}
else
{
$ID = $_SESSION['sess_id'];				

$inactive = 1200;
if(isset($_SESSION['start']) ) {
	$session_life = time() - $_SESSION['start'];
	if($session_life > $inactive){
		echo "<script type='text/javascript'>";
		echo "window.location = '$Path/liveconcms_logout.php?logout='";
		echo "</script>";
		exit;
	}
}
$_SESSION['start'] = time();


if (!isset($pageEditSubID))
{
  $pageEditSubID = ""; 
}

if (isset($_GET['edit']) == "")
{
$edit = 0;
}
else
{
$edit = (int) isset($_GET['edit']) ? $_GET['edit'] : edit('n');
}
		$languagePath = $_SESSION['sess_language'];
	   	require_once("core/language/$languagePath/language.php");		
	
	
$sql = "SELECT * FROM `lc_tbladministrator` WHERE ID ='$ID'";
$result = mysql_query($sql) or die('Query failed: ' . mysql_error());
while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
					
$SelectFirstname = $row["Firstname"];
$SelectLastname = $row["Lastname"];
$senastInloggad = $row["LastLoggedin"];	
$IP = $row["IP"];								
}
					
$inloggadPerson = "$SelectFirstname $SelectLastname ";
$Role = $_SESSION['sess_role'];

$CheckIP = CheckIP();
If ($IP != $CheckIP)
{
echo "<script type='text/javascript'>";
echo "window.location = '$Path/liveconcms_logout.php?logout='";
echo "</script>";
exit;
}

if($Role == '1' || $Role == '2')
{
		$SQLModules = "SELECT COUNT(*) FROM `lc_tblmodules`";
		$resultatModules = mysql_query($SQLModules) or die('Query failed: ' . mysql_error());
		while ($rowModules = mysql_fetch_array($resultatModules, MYSQL_ASSOC))
		{
		$modulesCount = $rowModules["COUNT(*)"];
		}
			
	echo "
	<script>
	$(document).ready(function(){
		lcAdminPanel();
	});
	</script>
	";	
	echo "<link rel='stylesheet' type='text/css' href='liveConCMS/skins/styles.php' />\n";
	echo "<div id='lccms-adminpanel_wrapper'>\n";
	echo "<img id='lccms-panel-logo' src='$Path/skins/images/livecon_logo.png'>\n";
	echo "<div class='adminpanel'>\n";
	echo "<ul>\n";


	if ($edit == 0 && $nav == 0)
	{
	echo "<li class='adminpanel_editsite'><a class='lc-menu-default' href='$editPath/$pageEditfilename?edit=1&pageid=$pageEditSubID'><b>$liveConCMS_menu_1</b></a></li>\n";
	}
	elseif($edit == 1 && $nav == 0)
	{
	echo "<li class='adminpanel_navigation'><a class='lc-menu-default' href='$editPath/$pageEditfilename?edit=0'><b>$liveConCMS_menu_2</b></a></li>\n";
	}
	else
	{
	echo "<li class='adminpanel_navigation'><a class='lc-menu-default' href='$editPath/$pageEditfilename?edit=0'><b>$liveConCMS_menu_2</b></a></li>\n";
	}


	echo "
	<li class='adminpanel_pages'><a class='lc-menu-default' href='$Path/liveconcms_menus.php?edit=1'><b>$liveConCMS_menu_21</b></a>\n
		<div class='adminpanel_submenu_wrapper'>\n
			<ul class='adminpanel_submenu'>\n
				<li><a href='$Path/liveconcms_menus.php?edit=1'><b>$liveConCMS_menu_14</b></a></li>\n
				<li><a href='$Path/liveconcms_writenews.php?edit=1'><b>$liveConCMS_menu_4</b></a></li>\n			
				<li><a href='$Path/liveconcms_templates.php?edit=1'><b>$liveConCMS_menu_15</b></a></li>\n
				<li><a href='$Path/liveconcms_languages.php?edit=1'><b>$liveConCMS_menu_16</b></a></li>\n
			</ul>\n
		</div>\n
	</li>
	";

	echo "
		<li class='adminpanel_filemanager'><a class='lc-menu-default' href='$Path/liveconcms_manager.php?edit=1'><b>$liveConCMS_menu_20</b></a></li>\n
	";

	echo "<li class='adminpanel_plugin'><a class='lc-menu-default' href='$Path/liveconcms_modules.php?edit=1'><b>$liveConCMS_menu_5</b></a>\n";
	echo "<div class='adminpanel_submenu_wrapper'>\n";
	echo "<ul class='adminpanel_submenu'>\n";

		if($modulesCount == 0)
		{
		echo "<li><a href='#'><b>$liveConCMS_menu_12</b></a></li>\n";
		}
		else
		{

						$sql = 'SELECT * FROM `lc_tblmodules` ORDER BY ID ASC';
						$result = mysql_query($sql) or die('Query failed: ' . mysql_error());
						while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
						{
							for($i = 0; $i < 1; $i++) 
							{
							$moduleTitle[$i] = $row["pluginTitle"];	
							$modulePath[$i] = $row["pluginPath"];
						
							echo "<li><a href='plugins/$Path/$modulePath[$i]?edit=1'><b>$moduleTitle[$i]</b></a></li>\n";
							}
						}


		}
	echo "</ul>\n";
	echo "</div>\n";
	echo "</li>\n";

	echo "<li class='adminpanel_intrahome'><a class='lc-menu-default' href='$Path/liveconintra_index.php?edit=1'><b>$liveConCMS_menu_6</b></a>\n";
	echo "<div class='adminpanel_submenu_wrapper'>\n";
	echo "<ul class='adminpanel_submenu'>\n";
	echo "<li><a href='$Path/liveconintra_index.php?edit=1'><b>$liveConCMS_menu_7</b></a></li>\n";
	echo "<li><a href='$Path/liveconintra_users.php?edit=1'><b>$liveConCMS_menu_8</b></a></li>\n";
	echo "<li><a href='$Path/liveconintra_register.php?edit=1'><b>$liveConCMS_menu_9</b></a></li>\n";
	echo "</ul>\n";
	echo "</div>\n";
	echo "</li>\n";

	echo "
	<li class='adminpanel_statistics'><a class='lc-menu-default' href='$Path/liveconcms_statistics.php?edit=1'><b>Sidfakta</b></a>\n
		<div class='adminpanel_submenu_wrapper'>\n
			<ul class='adminpanel_submenu'>\n
				<li><a href='$Path/liveconcms_statistics.php?edit=1'><b>$liveConCMS_menu_17</b></a></li>\n
				<li><a href='$Path/liveconcms_history.php?edit=1'><b>$liveConCMS_menu_18</b></a></li>\n
			
			</ul>\n
		</div>\n
	</li>
	";


if ($_SESSION['sess_licens'] == "MASTERON DEVELOPER EDITION")
{
$PublishHTML = "<li><a href='$Path/liveconcms_publish.php'><b>Publicera liveCon CMS</b></a></li>\n";
}
else
{
$PublishHTML = "";
}


	echo "<li class='adminpanel_system'><a class='lc-menu-default' href='$Path/liveconcms_system.php?edit=1'><b>$liveConCMS_menu_10</b></a></li>\n";

	echo "<li class='adminpanel_help'><a class='lc-menu-default' href='$Path/liveconcms_about.php?edit=1'><b>$liveConCMS_menu_11</b></a>
			<div class='adminpanel_submenu_wrapper'>\n
				<ul class='adminpanel_submenu'>\n
					<li><a href='$Path/liveconcms_about.php?edit=1'><b>$liveConCMS_menu_11</b></a></li>\n
					$PublishHTML
					<li><a href='$Path/liveconcms_startpage.php?edit=1'><b>$liveConCMS_menu_19</b></a></li>\n		
				</ul>\n
			</div>\n
	</li>\n";
	echo "</ul>\n";
				
	echo "
	<div id='lc-profilinfo'>
		<a href='$Path/liveconintra_users.php' class='lc-profile-user-normal' title='$liveconcms_tooltip_meny1 $inloggadPerson'><b>Din profil</b></a>						
		<a href='$Path/liveconcms_logout.php?logout=' class='lc-profile-logout-normal' title='$liveconcms_tooltip_meny2'><b>$liveconcms_tooltip_meny2</b></a>	
	</div>\n";
	echo "</div>\n";
	echo "
		<div id='lc-minimize-panel' class=\"ui-corner-bottom\">
			<span class=\"lc-min\">Minimera</span>
			<span class=\"lc-max\">Maximera</span>
		</div>
	";
	echo "</div>\n";
}
elseif ($Role == '0')
{
	/* user */
	echo "
	<script>
	$(document).ready(function(){
		lcAdminPanel();
	});
	</script>
	";	
	echo "<div id='lccms-adminpanel_wrapper'>\n";
	echo "<img id='lccms-panel-logo' src='$Path/skins/images/livecon_logo.png'>\n";
	echo "<div class='adminpanel'>\n";
	echo "<ul>\n";

		
	echo "
		<li class='adminpanel_intrahome'><a class='lc-menu-default' href='$Path/liveconintra_singel.php?edit=1'><b>$liveConCMS_menu_6</b></a>\n
			<div class='adminpanel_submenu_wrapper'>\n
				<ul class='adminpanel_submenu'>\n
					<li><a href='$Path/liveconintra_singel.php?edit=1'><b>$liveConCMS_menu_7</b></a></li>\n
					<li><a href='$Path/liveconintra_singeluser.php?edit=1'><b>$liveConCMS_menu_8</b></a></li>\n
				</ul>\n
			</div>\n
		</li>\n
		";
		
	echo "<li class='adminpanel_help'><a class='lc-menu-default' href='$Path/liveconcms_about.php?edit=1'><b>$liveConCMS_menu_11</b></a></li>";
	echo "</ul>\n";

	echo "
	<div id='lc-profilinfo'>
		<a href='$Path/liveconintra_singeluser.php' class='lc-profile-user-normal' title='$liveconcms_tooltip_meny1 $inloggadPerson'><b>Din profil</b></a>						
		<a href='$Path/liveconcms_logout.php?logout=' class='lc-profile-logout-normal' title='$liveconcms_tooltip_meny2'><b>$liveconcms_tooltip_meny2</b></a>	
	</div>\n";

	echo "</div>\n";

	echo "</div>\n";

}
elseif ($Role == '3')
{
/* Custom */

		$SQLModules = "SELECT COUNT(*) FROM `lc_tblmodules`";
		$resultatModules = mysql_query($SQLModules) or die('Query failed: ' . mysql_error());
		while ($rowModules = mysql_fetch_array($resultatModules, MYSQL_ASSOC))
		{
		$modulesCount = $rowModules["COUNT(*)"];
		}

		echo "
			<script>
			$(document).ready(function(){
				lcAdminPanel();
			});
			</script>
			";	
			
	echo "<link rel='stylesheet' type='text/css' href='liveConCMS/skins/styles.php' />\n";
	echo "<div id='lccms-adminpanel_wrapper'>\n";
	echo "<img id='lccms-panel-logo' src='$Path/skins/images/livecon_logo.png'>\n";
	echo "<div class='adminpanel'>\n";
	echo "<ul>\n";
	
	if($_SESSION['sess_liveConCustomMenu'] [9] == 1)
	{
		if ($edit == 0 && $nav == 0)
		{
		echo "<li class='adminpanel_editsite'><a class='lc-menu-default' href='$editPath/$pageEditfilename?edit=1&pageid=$pageEditSubID'><b>$liveConCMS_menu_1</b></a></li>\n";
		}
		elseif($edit == 1 && $nav == 0)
		{
		echo "<li class='adminpanel_navigation'><a class='lc-menu-default' href='$editPath/$pageEditfilename?edit=0'><b>$liveConCMS_menu_2</b></a></li>\n";
		}
		else
		{
		echo "<li class='adminpanel_navigation'><a class='lc-menu-default' href='$editPath/$pageEditfilename?edit=0'><b>$liveConCMS_menu_2</b></a></li>\n";
		}
	}

	if($_SESSION['sess_liveConCustomMenu'] [0] == 1)
	{
		echo "
		<li class='adminpanel_pages'><a class='lc-menu-default' href='$Path/liveconcms_menus.php?edit=1'><b>$liveConCMS_menu_21</b></a>\n
		<div class='adminpanel_submenu_wrapper'>\n
			<ul class='adminpanel_submenu'>\n";
	}
	else
	{
	echo "
		<li class='adminpanel_pages'><a class='lc-menu-default' href='#'><b>$liveConCMS_menu_21</b></a>\n
		<div class='adminpanel_submenu_wrapper'>\n
			<ul class='adminpanel_submenu'>\n";
	}
			
				if($_SESSION['sess_liveConCustomMenu'] [0] == 1)
				{
				echo "<li><a href='$Path/liveconcms_menus.php?edit=1'><b>$liveConCMS_menu_14</b></a></li>\n";
				}
				if($_SESSION['sess_liveConCustomMenu'] [1] == 1)
				{
				echo "<li><a href='$Path/liveconcms_writenews.php?edit=1'><b>$liveConCMS_menu_4</b></a></li>\n";
				}
				if($_SESSION['sess_liveConCustomMenu'] [2] == 1)
				{
				echo "<li><a href='$Path/liveconcms_templates.php?edit=1'><b>$liveConCMS_menu_15</b></a></li>\n";
				}
				if($_SESSION['sess_liveConCustomMenu'] [3] == 1)
				{
				echo "<li><a href='$Path/liveconcms_languages.php?edit=1'><b>$liveConCMS_menu_16</b></a></li>\n";
				}
			echo "</ul>\n
		</div>\n
	</li>
	";

	if($_SESSION['sess_liveConCustomMenu'] [4] == 1)
	{
	echo "
		<li class='adminpanel_filemanager'><a class='lc-menu-default' href='$Path/liveconcms_manager.php?edit=1'><b>$liveConCMS_menu_20</b></a></li>\n
	";
	}

	if($_SESSION['sess_liveConCustomMenu'] [5] == 1)
	{
		echo "<li class='adminpanel_plugin'><a class='lc-menu-default' href='$Path/liveconcms_modules.php?edit=1'><b>$liveConCMS_menu_5</b></a>\n";
		echo "<div class='adminpanel_submenu_wrapper'>\n";
		echo "<ul class='adminpanel_submenu'>\n";

			if($modulesCount == 0)
			{
			echo "<li><a href='#'><b>$liveConCMS_menu_12</b></a></li>\n";
			}
			else
			{

							$sql = 'SELECT * FROM `lc_tblmodules` ORDER BY ID ASC';
							$result = mysql_query($sql) or die('Query failed: ' . mysql_error());
							while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
							{
								for($i = 0; $i < 1; $i++) 
								{
								$moduleTitle[$i] = $row["pluginTitle"];	
								$modulePath[$i] = $row["pluginPath"];
							
								echo "<li><a href='plugins/$Path/$modulePath[$i]?edit=1'><b>$moduleTitle[$i]</b></a></li>\n";
								}
							}


			}
		echo "</ul>\n";
		echo "</div>\n";
		echo "</li>\n";
    }
	echo "<li class='adminpanel_intrahome'><a class='lc-menu-default' href='$Path/liveconintra_index.php?edit=1'><b>$liveConCMS_menu_6</b></a>\n";
	echo "<div class='adminpanel_submenu_wrapper'>\n";
	echo "<ul class='adminpanel_submenu'>\n";
	echo "<li><a href='$Path/liveconintra_index.php?edit=1'><b>$liveConCMS_menu_7</b></a></li>\n";
	echo "<li><a href='$Path/liveconintra_users.php?edit=1'><b>$liveConCMS_menu_8</b></a></li>\n";
	
	if($_SESSION['sess_liveConCustomMenu'] [6] == 1)
	{
	echo "<li><a href='$Path/liveconintra_register.php?edit=1'><b>$liveConCMS_menu_9</b></a></li>\n";
	}
	
	echo "</ul>\n";
	echo "</div>\n";
	echo "</li>\n";

	if($_SESSION['sess_liveConCustomMenu'] [7] == 1)
	{
	echo "
	<li class='adminpanel_statistics'><a class='lc-menu-default' href='$Path/liveconcms_statistics.php?edit=1'><b>Sidfakta</b></a>\n
		<div class='adminpanel_submenu_wrapper'>\n
			<ul class='adminpanel_submenu'>\n
				<li><a href='$Path/liveconcms_statistics.php?edit=1'><b>$liveConCMS_menu_17</b></a></li>\n
				<li><a href='$Path/liveconcms_history.php?edit=1'><b>$liveConCMS_menu_18</b></a></li>\n
			
			</ul>\n
		</div>\n
	</li>
	";
    }


    if($_SESSION['sess_liveConCustomMenu'] [8] == 1)
	{
	echo "<li class='adminpanel_system'><a class='lc-menu-default' href='$Path/liveconcms_system.php?edit=1'><b>$liveConCMS_menu_10</b></a></li>\n";
	}
	
	echo "<li class='adminpanel_help'><a class='lc-menu-default' href='$Path/liveconcms_about.php?edit=1'><b>$liveConCMS_menu_11</b></a>
			<div class='adminpanel_submenu_wrapper'>\n
				<ul class='adminpanel_submenu'>\n
					<li><a href='$Path/liveconcms_about.php?edit=1'><b>$liveConCMS_menu_11</b></a></li>\n				
					<li><a href='$Path/liveconcms_startpage.php?edit=1'><b>$liveConCMS_menu_19</b></a></li>\n		
				</ul>\n
			</div>\n
	</li>\n";
	echo "</ul>\n";
			
			
	echo "
	<div id='lc-profilinfo'>
		<a href='$Path/liveconintra_users.php' class='lc-profile-user-normal' title='$liveconcms_tooltip_meny1 $inloggadPerson'><b>Din profil</b></a>						
		<a href='$Path/liveconcms_logout.php?logout=' class='lc-profile-logout-normal' title='$liveconcms_tooltip_meny2'><b>$liveconcms_tooltip_meny2</b></a>	
	</div>\n";
	echo "</div>\n";
	echo "
		<div id='lc-minimize-panel' class=\"ui-corner-bottom\">
			<span class=\"lc-min\">Minimera</span>
			<span class=\"lc-max\">Maximera</span>
		</div>
	";
	echo "</div>\n";

}
else
{
echo "<div id='lccms-adminpanel_wrapper'>\n";
echo "		<div class='adminpanel'>\n";
echo "<p> Error! </p>\n";
echo "		</div>\n";
echo "</div>\n";
}


}


?>