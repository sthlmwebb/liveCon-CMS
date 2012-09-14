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

if (isset($_GET['logout'])){ 
 
 if (!isset($_SESSION['sess_language']))
 {
  session_unset();
  session_destroy();
  header("Location: ../index.php");
  exit;
}
else
{

 $languagePath = $_SESSION['sess_language'];
 include("core/language/$languagePath/language.php");
 $ID =  $_SESSION['sess_id'];
 $Dagensdatum = date('Y-m-d H:i:s');
  
 
 $sql = "UPDATE lc_tbladministrator SET LastLoggedin = '$Dagensdatum' Where ID = '$ID'";
 mysql_query_simple_exequter($sql);

$lc_UserID =  $_SESSION['sess_id'];
createLogg($lc_UserID, $liveConCMS_logg40); 

  session_unset();
  session_destroy();
  header("Location: ../index.php");
  exit;
  }
}

?>