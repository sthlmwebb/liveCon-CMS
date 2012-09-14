<?php
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

include("include/dbConn.php");

$liveconCMSPage = basename($_SERVER['PHP_SELF']);
$liveConFileExt = pathinfo($liveconCMSPage);

if(empty($liveConFileExt['extension']))
{
$liveconCMSPage = "index.php";
}

if (!isset($_SESSION['sess_id']))
{
  $_SESSION['sess_id'] = ""; 
}

if (!isset($_SESSION['sess_sitelanguage']))
{
$_SESSION['sess_sitelanguage'] = 1; 
}

if (isset($_GET['language']) == "")
{

}
else
{
$_SESSION['sess_sitelanguage'] = (int) isset($_GET['language']) ? $_GET['language'] : language('n');

$LanguageChek = $_SESSION['sess_sitelanguage'];
$sql_language = "SELECT COUNT(*) FROM `lc_tbllanguage` WHERE LanguageID = ' $LanguageChek'";
$Result_language = mysql_query($sql_language) or die('Query failed: ' . mysql_error());
while ($rowLanguage = mysql_fetch_array($Result_language, MYSQL_ASSOC))
{
$CountSprak = $rowLanguage["COUNT(*)"];
}
 
if($CountSprak == '0')
{
$_SESSION['sess_sitelanguage'] = 1; 
} 
}
	

if ($_SESSION['sess_id'] == "")
{
$edit = (int) 0;
$page_id = (int) 1;
$undo = (int) 0;
}
else
{
		if (isset($_GET['edit']) == "")
		{
			$edit = (int) 0;
		}
		else
		{
			$edit = (int) isset($_GET['edit']) ? $_GET['edit'] : edit('n');
		}



	if (isset($_GET['page_id']) == "")
	{
		$page_id = (int) 1;
	}
	else
	{
		$page_id = (int) isset($_GET['page_id']) ? $_GET['page_id'] : page_id('n');
	}


	if (isset($_GET['undo']) == "")
	{
		$undo = (int) 0;
	}
	else
	{
		$undo = (int) isset($_GET['undo']) ? $_GET['undo'] : undo('n');
		$menyType = (int) isset($_GET['type']) ? $_GET['type'] : type('n');
		$pagetextID = (int) isset($_GET['pagetextid']) ? $_GET['pagetextid'] : pagetextid('n');
		
		$pageEditID = $_SESSION['sess_liveConCMSPageIndex'] [3];
		$pageEditSubID = $_SESSION['sess_liveConCMSPageIndex'] [4];
		$pageEditfilename = $_SESSION['sess_liveConCMSPageIndex'] [5];
		
			if ($menyType == (int) 1)
			{
			$sqlUndo = "UPDATE lc_tblpagestext SET lc_tblpagestext.pageText = lc_tblpagestext.pageTextBackup Where pageID = '$pagetextID'";
			mysql_query($sqlUndo) or die("error");
			}
			elseif($menyType == (int) 2)
			{
			$sqlUndo = "UPDATE lc_tblpagestext SET lc_tblpagestext.pageText = lc_tblpagestext.pageTextBackup Where pageID = '$pagetextID'";
			mysql_query($sqlUndo) or die("error");
			}
			else
			{
			}
		
		$_SESSION['sess_showundo'] = (int) 9999;

		header("Refresh: 0;URL=$pageEditfilename?edit=$edit&pageid=$pageEditSubID");
		exit; 
	}
}

if (isset($_POST['lc_submit']))
{
    $sitelanguage = $_SESSION['sess_sitelanguage'];
	$pageEditID = $_SESSION['sess_liveConCMSPageIndex'] [3];
	$pageEditSubID = $_SESSION['sess_liveConCMSPageIndex'] [4];
	$pageEditfilename = $_SESSION['sess_liveConCMSPageIndex'] [5];
	
		$pageText = "";
		$main = (int) 0;
	
		if($pageEditID != (int) 0)
		{
			$sqlText = "SELECT pageText, ID FROM `lc_tblpages`, `lc_tblpagestext` WHERE lc_tblpages.MenyID = '$pageEditID' AND lc_tblpages.SubID = '$pageEditSubID' AND lc_tblpagestext.LanguageID = '$sitelanguage' AND lc_tblpages.ID = lc_tblpagestext.pageID";
			$resultText = mysql_query($sqlText) or die('Query failed: ' . mysql_error());
			while ($rowText = mysql_fetch_array($resultText, MYSQL_ASSOC))
			{
				$pageText = $rowText["pageText"];
				$pagetextID = $rowText["ID"];
				
				if($pageText != "")
				{
				$main = (int) 1;
				}
			}
		}
	
			if($pageText == "")
			{
				$sqlText = "SELECT pageText, ID FROM `lc_tblpages`, `lc_tblpagestext`  WHERE lc_tblpages.SubID = '$pageEditSubID' AND lc_tblpagestext.LanguageID = '$sitelanguage' AND lc_tblpages.ID = lc_tblpagestext.pageID";
				$resultText = mysql_query($sqlText) or die('Query failed: ' . mysql_error());
				while ($rowText = mysql_fetch_array($resultText, MYSQL_ASSOC))
				{
				$pageText = $rowText["pageText"];
				$pagetextID = $rowText["ID"];
				}
			}
			
		if($pageText == "")	
		{
		$pageText = "<p>Kunnde inte hitta någon text i databasen.</p>";
		}
	
	
	$_POST = db_escape($_POST);
	$htmlText = replaceWord($_POST['TextArea1']);
	
	if($main == (int) 0)
	{
	$sqlBackup = "UPDATE lc_tblpagestext SET pageTextBackup = '$pageText' WHERE pageID = '$pagetextID' AND LanguageID = '$sitelanguage'";
	mysql_query($sqlBackup) or die('Query failed: ' . mysql_error());

	$sql = "UPDATE lc_tblpagestext SET pageText = '$htmlText' WHERE pageID = '$pagetextID' AND LanguageID = '$sitelanguage'";
	mysql_query($sql) or die('Query failed: ' . mysql_error());

	$_SESSION['sess_showundo'] = $pageEditSubID;
	}
	else
	{
	$sqlBackup = "UPDATE lc_tblpagestext SET pageTextBackup = '$pageText' WHERE pageID = '$pagetextID' AND LanguageID = '$sitelanguage'";
	mysql_query($sqlBackup) or die('Query failed: ' . mysql_error());
	
	$sql = "UPDATE lc_tblpagestext SET pageText = '$htmlText' WHERE pageID = '$pagetextID' AND LanguageID = '$sitelanguage'";
	mysql_query($sql) or die('Query failed: ' . mysql_error()); 

	$_SESSION['sess_showundo'] = $pageEditID;
	}
	
		
	
	header("Refresh: 0;URL=$pageEditfilename?edit=$edit&pageid=$pageEditSubID");
	exit; 
}

if (isset($_POST['submitfooter']))
{
	$pageEditSubID = $_SESSION['sess_liveConCMSPageIndex'] [4];
	$pageEditfilename = $_SESSION['sess_liveConCMSPageIndex'] [5];
	
	$_POST = db_escape($_POST);

	$htmlfooterText = $_POST['TextArea2'];

	$sql = "UPDATE lc_tblfooter SET Text = '$htmlfooterText' Where ID = '1'";
	mysql_query($sql) or die('Query failed: ' . mysql_error()); 

	header("Refresh: 0;URL=$pageEditfilename?edit=$edit&pageid=$pageEditSubID");
	exit; 
}

	function replaceWord($phrase)
	{
	$chars = array("'");
	$correctHTML  = array("&quot;");
	$newphrase = str_replace($chars, $correctHTML, $phrase);

	return $newphrase;
	}
	
	
if (!isset($_SESSION['sess_visitor']))
{
	$_SESSION['sess_visitor'] = 1; 
	$my_browser  =  $_SERVER['HTTP_USER_AGENT']; 
	$my_ip  = $_SERVER['REMOTE_ADDR'];
	
	
	$Dagensdatum = date('Y-m-d H:i:s');
    $sql = "INSERT INTO lc_tblvisitorlogg (Browser, IP, Recieved) VALUES('$my_browser', '$my_ip', '$Dagensdatum')";
    mysql_query($sql) or die('Query failed: ' . mysql_error());
}



/* API */
if (isset($_GET['news']) == "")
	{
		$api_news = (int) 0;
		$api_NewsTitle = "Ingen nyhet hittades!";
		$api_NewsText = "";
		$api_NewsDate = "";
	}
	else
	{
		$api_NewsTitle = "Ingen nyhet hittades!";
	    $api_NewsText = "";
		$api_NewsDate = "";
		
		$api_news = (int) isset($_GET['news']) ? $_GET['news'] : news('n');
		
		$sql_newsAPI = "SELECT * FROM `lc_tblnews` WHERE ID = '$api_news'";
		$result_newsAPI = mysql_query($sql_newsAPI) or die('Query failed: ' . mysql_error());
			while ($row_newsAPI = mysql_fetch_array($result_newsAPI, MYSQL_ASSOC))
			{
			$api_NewsTitle = $row_newsAPI["Title"];
			$api_NewsText = $row_newsAPI["News"];
			$api_NewsDate = $row_newsAPI["Date"];
			}
	}

	
if (isset($_POST['submit_apiContact']))
{
$From = "";

 foreach($_POST as $key => $val)
  {
    $_POST[$key] = trim($val);
  }
  
  $mailName = stripslashes($_POST['txt_apiFormName']);
  $mailPhone = stripslashes($_POST['txt_apiFormPhone']);
  $mailEmail = stripslashes($_POST['txt_apiFormEmail']);
  $mailMessage = stripslashes($_POST['txt_apiFormMessage']);
  $hiddenAdress = $_POST['hidden_epost'];
  $hiddenredirect = $_POST['hidden_redirect'];

      if (!preg_match('/^[-A-Za-z0-9_.]+[@][A-Za-z0-9_-]+([.][A-Za-z0-9_-]+)*[.][A-Za-z]{2,6}$/', $_POST['txt_apiFormEmail'])) 
	 {
	    $From = "no-replay@liveconcms.se"; 
	 }
	 else
	 {
		$From = stripslashes($_POST['txt_apiFormEmail']);
	 }
	   
  
  $topic = "Meddelande från hemsidan";
  
  $headers = "MIME-Version: 1.0 \r\n"; 
  $headers .= "Content-type: text/html; charset=iso-8859-1 \r\n"; 
  $headers .= "From: $From \r\n"; 
  $headers .= "Cc:"; 
  
  $txtMessage = "
 <html>
 <body>
  <b>Från:</b><br/>
  $mailName
  
  <br/>
  <br/>
  <b>Telefon:</b><br/>
  $mailPhone
  
  <br/>
  <br/>
  <b>Meddelande:</b><br/>
  $mailMessage
  
  </body>
  </html>";
  
  
		mail('$hiddenAdress',$topic,$txtMessage,$headers);
		header("location:$hiddenredirect");
}

	
?>