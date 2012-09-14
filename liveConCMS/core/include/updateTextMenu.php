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

if (!isset($_SESSION['sess_liveConCMSPageIndex'] [3]))
{
	header("Refresh: 0;URL=../../../");
	exit; 
}

if (isset($_POST['submit']))
	{		
		$_POST = db_escape($_POST);
		
				$sitelanguage = $_SESSION['sess_sitelanguage'];
			
				$sqlMeny = "SELECT * FROM lc_tblmeny, lc_tblmenytext WHERE lc_tblmenytext.LanguageID = '$sitelanguage' AND lc_tblmeny.ID = lc_tblmenytext.MenyID";
				$resultMeny = mysql_query($sqlMeny) or die('Query failed: ' . mysql_error());
				while ($rowMeny = mysql_fetch_array($resultMeny, MYSQL_ASSOC))
				{
					for($i = 0 ; $i < 1; $i++) 
					{
					$menyID[$i] = $rowMeny["ID"];			
					$menyText = $_POST["MenuText$menyID[$i]"];
				
					$sql = "UPDATE lc_tblmenytext 
					SET MenyText= '$menyText'
					Where MenyID = '$menyID[$i]' AND LanguageID= '$sitelanguage'"; 
					mysql_query($sql) or die('Query failed: ' . mysql_error());				
					}
				}
					
	}
	
 $goBackPage = $_SESSION['sess_liveConCMSPageIndex'] [5];		
 header("Refresh: 0;URL=../../../$goBackPage?edit=1");
 exit; 	
	
?>