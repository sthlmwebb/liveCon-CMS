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

if (!isset($_SESSION['sess_user']))
{
  header("Refresh: 0;URL=../../liveconcms_logout.php?logout=");
  exit; 
}

function getDBConnection()
{
include("../../core/include/dbConn.php");
}


function mysql_pluginquery_executer($query)
{
$sql = $query;
mysql_query($sql) or die('Query failed: ' . mysql_error());
}


function CheckIP() 
{ 
   if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
      if (preg_match('/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}/', $_SERVER['HTTP_X_FORWARDED_FOR'], $addresses)) 
         return $addresses[0]; 
   } 
   return (isset($_SERVER['HTTP_CLIENT_IP'])) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR']; 
}

?>
