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

include("dbConn.php");
include("../liveconcms_systemcore.php");

if (!isset($_SESSION['sess_liveConCMSPageIndex'] [3]))
{
	header("Refresh: 0;URL=../../../");
	exit; 
}
else
{
	$menuid = $_SESSION['sess_liveConCMSPageIndex'] [3];
}

if (isset($_POST['submit']))
	{		
		$_POST = db_escape($_POST);
				
				$sitelanguage = $_SESSION['sess_sitelanguage'];
				$sqlMeny = "SELECT * FROM `lc_tblsubcat`,`lc_tblsubcattext` WHERE lc_tblsubcat.MenyID = '$menuid' AND lc_tblsubcattext.LanguageID = '$sitelanguage' AND lc_tblsubcat.SubID = lc_tblsubcattext.SubID";
				
				
				$resultMeny = mysql_query($sqlMeny) or die('Query failed: ' . mysql_error());
				while ($rowMeny = mysql_fetch_array($resultMeny, MYSQL_ASSOC))
				{
					for($i = 0 ; $i < 1; $i++) 
					{
					$menyID[$i] = $rowMeny["SubID"];
					
				
					$menyText = $_POST["subMenuText$menyID[$i]"];
					
				
					$sql = "UPDATE lc_tblsubcattext 
					SET SubText = '$menyText'
					Where SubID = '$menyID[$i]' AND LanguageID= '$sitelanguage'"; 
					mysql_query($sql) or die('Query failed: ' . mysql_error());
					
					
					}
				}
					
	}
	
 $goBackPage = $_SESSION['sess_liveConCMSPageIndex'] [5];	
 header("Refresh: 0;URL=../../../$goBackPage?edit=1");
 exit; 	
	
?>