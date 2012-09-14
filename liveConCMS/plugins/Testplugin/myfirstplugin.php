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

/* Skapar en databasconnection till livecon databasen. */
include("../liveconcms_pluginapi.php");
getDBConnection();
?>

<html>
	<head>
		<title>Plugin</title>
	</head>
		
		<body>
			<h1>Test plugin for liveCon CMS</h1>
			<p>Plugin is installed!</p>
			<hr/>
			<?PHP
					$sql = "SELECT * FROM `tbltestplugin` WHERE ID ='1'";
					$result = mysql_query($sql) or die('Query failed: ' . mysql_error());
					while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
					{				
						$showMessage = $row["TextArea"];	
					}
				echo "<i>Message from database:</i> <br/>";	
				echo $showMessage;
			?>
		<hr/>
		</body>

</html>