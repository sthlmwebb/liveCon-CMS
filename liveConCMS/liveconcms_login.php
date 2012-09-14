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

$_SESSION['lc_queries'] = 0;

if (isset($_POST['submit']))
{
	$_POST = db_escape($_POST);
 
	  foreach($_POST as $key => $val)
	  {
		$_POST[$key] = trim($val);
	  }
  
  	  $Username = mysql_real_escape_string($_POST['username']);
	  $Password = mysql_real_escape_string($_POST['password']);
	  $Password = md5($Password & $SaltedKey);
   
	  $sql = "SELECT ID FROM lc_tbladministrator
			 WHERE UserName='$Username' 
			 AND UserPassword='$Password'";
							  
	   $result = mysql_query_exequter_with_return($sql);

		 if (mysql_num_rows($result) == 0)
		 {
		  header("Location: ../admin.php?badlogin=");
		  exit;
		 }
		   
		   /* OLD LICENSE CHECK
		   $liveConCMSLicens = "";
		   $liveConCMSblacked = 0;
		   
			  $sqllicens = "SELECT * FROM `lc_tbllicens` WHERE ID = '1'";
			  $resultlicens = mysql_query_exequter_with_return($sqllicens);
			  while ($rowLicens = mysql_fetch_array($resultlicens, MYSQL_ASSOC))
			  {				
				$liveConCMSLicens = $rowLicens["licens"];
				$liveConCMSActivated = $rowLicens["Activated"];
				$liveConCMSblacked = $rowLicens["blacked"];
			  }
			 
			if($liveConCMSLicens == "")
			{
			header("Location: licens/liveconcms_select.php");
		    exit;
			}
			elseif($liveConCMSActivated == 0)
			{
			header("Location: licens/liveconcms_activate.php");
		    exit;
			}
			elseif($liveConCMSblacked == 1)
			{
			header("Location: licens/liveconcms_blacked.php");
			exit;
			}
			*/

			  $_SESSION['sess_id'] = mysql_result($result, 0, 'ID');  
			  $_SESSION['sess_user'] = $Username;
			  $_SESSION['sess_licens'] = "GNU";
			  $_SESSION['sess_licactivated'] = 1;
			  $ID =  $_SESSION['sess_id'];
			  $_SESSION['sess_showundo'] = 9999;
			

			$IP = CheckIP();
  
		  $sql = "UPDATE lc_tbladministrator SET IP = '$IP' Where ID = '$ID'";
		  mysql_query_simple_exequter($sql);
		  
		  
			$sqllanguage = "SELECT languagepath FROM lc_tbladministrator WHERE ID = '$ID'";
			$resullanguage = mysql_query_exequter_with_return($sqllanguage);
			while ($rowlanguage = mysql_fetch_array($resullanguage, MYSQL_ASSOC))
			{			
			$languagePath = $rowlanguage["languagepath"];
			}
			$_SESSION['sess_language'] = $languagePath;
		   			

			  $sql = "SELECT * FROM `lc_tbladministrator` WHERE ID = '$ID'";
			  $result = mysql_query_exequter_with_return($sql);
			  while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
			  {				
				$Role = $row["Role"];
				$AcceptRules = $row["AcceptRules"];
				
				$AdminPages = $row["AdminPages"];
				$AdminNews = $row["AdminNews"];
				$AdminTemplates = $row["AdminTemplates"];
				$AdminLanguages = $row["AdminLanguages"];
				$AdminExplorer = $row["AdminExplorer"];
				$AdminModules = $row["AdminModules"];
				$AdminUser = $row["AdminUser"];
				$AdminStatistic = $row["AdminStatistic"];
				$AdminSystem = $row["AdminSystem"];
				$AdminEditable = $row["AdminEditable"];
			  }
			  
			  $_SESSION['sess_role'] = $Role;

			  /* Custom menu */
			  if ($Role == 3)
			  {
			  $_SESSION['sess_liveConCustomMenu'] = array($AdminPages,$AdminNews,$AdminTemplates,$AdminLanguages,$AdminExplorer,$AdminModules,$AdminUser, $AdminStatistic, $AdminSystem, $AdminEditable); 
			  }
  
		if($AcceptRules == 0)
		{
			header("Refresh: 0;URL=liveconcms_acceptlicense.php");
			exit; 
		}
		else
		{
		 include("core/language/$languagePath/language.php");
		 				 
			 if($Role == '1')
			 {
			  /* Super admin */
			  createLogg($ID, $liveConCMS_logg1);
			  header("Refresh: 0;URL=liveconcms_startpage.php?edit=1");
			  exit; 
			 }
			 elseif($Role == '2')
			 {
			  /* admin */
			  createLogg($ID, $liveConCMS_logg1);
			  header("Refresh: 0;URL=liveconcms_startpage.php?edit=1");
			  exit; 
			 }
			  elseif($Role == '3')
			 {
			  /* admin light */
			  createLogg($ID, $liveConCMS_logg1);
			  header("Refresh: 0;URL=liveconcms_startpage.php?edit=1");
			  exit; 
			 }
			 else
			 {
			  /* user */
			  createLogg($ID, $liveConCMS_logg2);
			  header("Refresh: 0;URL=liveconintra_singel.php");
			  exit;
			 }
		}
}

function cutURL($phrase)
{
$chars = array("liveconcms_sucess.php");
$correctHTML  = array("");
$newphrase = str_replace($chars, $correctHTML, $phrase);

return $newphrase;
}
?>