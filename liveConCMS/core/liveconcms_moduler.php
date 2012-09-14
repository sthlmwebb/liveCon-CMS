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

function liveConCMS_ModulID($modulID)
{
		$modulID = (int) $modulID;

		$PluginPath = "";
		$sqlPluginid = "SELECT pluginPath FROM lc_tblmodules WHERE ID = '$modulID'";
		$resultPluginid = mysql_query_exequter_with_return($sqlPluginid);
		while ($rowPluginid = mysql_fetch_array($resultPluginid, MYSQL_ASSOC))
		{			
		$PluginPath = $rowPluginid["pluginPath"];
		}
			if($PluginPath == "")
			{
			return print "<p><b>Det finns inget plugin med korrekt id nummer!</b></p>";
			}
			else
			{
			$path_parts = pathinfo($PluginPath);
			$CMSpluginPath = $path_parts['dirname'];
			
			include("liveConCMS/plugins/$CMSpluginPath/plugin_api.php");
			return true;
			}		
}

function mysql_query_exequter_with_return($query)
{
	$sql = $query;

	if (!mysql_query($sql))
	{
	 $errorString = mysql_error();
	 createLogg(0, $errorString);
	 echo "Error in liveCon CMS, see history for complete error message!";
	 die;
	}
	else
	{
	return mysql_query($sql);
	}
}
?>