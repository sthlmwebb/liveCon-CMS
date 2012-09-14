<?php
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


/* SESSION Handler */	
if (!isset($_SESSION['sess_user']))
{
  $_SESSION['sess_user'] = "";
  header("Refresh: 0;URL=../");
  exit; 
}

if (!isset($_SESSION['sess_language']))
{
  header("Refresh: 0;URL=../");
  exit; 
}
else
{
$languagePath = $_SESSION['sess_language'];
include("language/$languagePath/language.php");
}

if (!isset($_SESSION['sess_sitelanguage']))
{
$_SESSION['sess_sitelanguage'] = 1; 
}


/* Counter */	
$sql_language = "SELECT COUNT(*) FROM `lc_tbllanguage`";
$Result_language = mysql_query_exequter_with_return($sql_language);
while ($rowLanguage = mysql_fetch_array($Result_language, MYSQL_ASSOC))
{
 $AntalSprak = $rowLanguage["COUNT(*)"];
}


$liveConCMSLicensActivated = $_SESSION['sess_licactivated'];
if($liveConCMSLicensActivated == "1")
{
}
else
{
 header("Refresh: 0;URL=licens/liveconcms_activate.php");
 exit; 
}

/* URL Management */	
if (isset($_GET['language']) == "")
{

}
else
{
 $_SESSION['sess_sitelanguage'] = (int) isset($_GET['language']) ? $_GET['language'] : language('n');
 
 /* check language, default se */
$LanguageChek = $_SESSION['sess_sitelanguage'];
$sql_language = "SELECT COUNT(*) FROM `lc_tbllanguage` WHERE LanguageID = ' $LanguageChek'";
$Result_language = mysql_query_exequter_with_return($sql_language);
while ($rowLanguage = mysql_fetch_array($Result_language, MYSQL_ASSOC))
{
$CountSprak = $rowLanguage["COUNT(*)"];
}
 
if($CountSprak == '0')
{
$_SESSION['sess_sitelanguage'] = 1; 
} 
}

/* */
$sql_upload = "SELECT manualupload FROM `lc_tblconfig` WHERE ID ='1'";
$result_upload = mysql_query_exequter_with_return($sql_upload);
while ($row_upload = mysql_fetch_array($result_upload, MYSQL_ASSOC))
{				
$manualupload = $row_upload["manualupload"];	
}


if (isset($_GET['update_plugin']) == "")
{

}
else
{
	$updateModules = (int) isset($_GET['update_plugin']) ? $_GET['update_plugin'] : update_plugin('n');
	
	if ($updateModules == 1)
	{
	pluginSearch("plugins/");
	}
}

if (isset($_GET['delete_plugin']) == "")
{

}
else
{
	$deletePlugin = (int) isset($_GET['delete_plugin']) ? $_GET['delete_plugin'] : delete_plugin('n');
	
	$sql = "SELECT * FROM `lc_tblmodules` WHERE ID ='$deletePlugin'";
	$result = mysql_query_exequter_with_return($sql);
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{				
		$pluginFolderToDelete = $row["pluginFolder"];	
	}
	
	if(file_exists("plugins/$pluginFolderToDelete/plugin_uninstall.php"))
	{
	 include("plugins/$pluginFolderToDelete/plugin_uninstall.php");
	}
	
	 	
	$sql = 'DELETE FROM lc_tblmodules WHERE ID = "'.$deletePlugin.'"  LIMIT 1';
	mysql_query_simple_exequter($sql);
	
	 $lc_UserID =  $_SESSION['sess_id'];
	 createLogg($lc_UserID, $liveConCMS_logg17);
	   
	header("Refresh: 0;URL=liveconcms_modules.php?edit=1");
  	exit; 
}



/* MENu */
if (isset($_GET['del_meny_subid']) == "")
{

}
else
{
$del_subid = (int) isset($_GET['del_meny_subid']) ? $_GET['del_meny_subid'] : del_meny_subid('n');

		$sql = "SELECT SubLink, MenyIndex FROM `lc_tblsubcat` WHERE SubID ='$del_subid'";
		$result = mysql_query_exequter_with_return($sql);
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{				
			$SubLinkToDelete = $row["SubLink"];	
			$SubLinkMeny = $row["MenyIndex"];	
		}
		
		if($SubLinkMeny == 1)
		{
			 $reg_error[] = 0; 	 
		}
			if (!isset($reg_error)) 
			{
				
					if ($manualupload == 0)
					{
						
						if($SubLinkToDelete != "index.php")
						{
							if (file_exists("../$SubLinkToDelete")) 
							{ 
							 unlink("../$SubLinkToDelete");
							}
						}
					}					

					$sql = "DELETE FROM lc_tblsubcat WHERE SubID = '$del_subid'";
					mysql_query_simple_exequter($sql);
					
					$sql = "DELETE FROM lc_tblsubcattext WHERE SubID = '$del_subid'";
					mysql_query_simple_exequter($sql);
					
					
					$sql = "SELECT ID FROM `lc_tblpages` WHERE SubID = '$del_subid'";
					$result = mysql_query_exequter_with_return($sql);
					while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
					{				
					 $pagetextID = $row["ID"];					
					}
					
					$sql = "DELETE FROM lc_tblpages WHERE SubID = '$del_subid'";
					mysql_query_simple_exequter($sql);
					
					$sql = "DELETE FROM lc_tblpagestext WHERE pageID = '$pagetextID'";
					mysql_query_simple_exequter($sql);
					
					$lc_UserID =  $_SESSION['sess_id'];
					createLogg($lc_UserID, $liveConCMS_logg12);
				   
				  header("Refresh: 0;URL=liveconcms_menus.php");
				  exit; 
			  }
}

if (isset($_GET['del_meny_menuid']) == "")
{

}
else
{
$del_menuid = (int) isset($_GET['del_meny_menuid']) ? $_GET['del_meny_menuid'] : del_meny_menuid('n');

		$sql = "SELECT MenyLink FROM `lc_tblmeny` WHERE ID ='$del_menuid'";
		$result = mysql_query_exequter_with_return($sql);
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{				
			$LinkToDelete = $row["MenyLink"];	
		}

		if(strtolower($LinkToDelete) == "index.php")
		{
			$reg_error[] = 1; 	 
		}

		if (!isset($reg_error)) 
		{
			if ($manualupload == 0)
			{
				if (file_exists("../$LinkToDelete")) 
				{ 
				unlink("../$LinkToDelete");
				} 
			}
		
			$sql = "DELETE FROM lc_tblmeny WHERE ID = '$del_menuid'";
			mysql_query_simple_exequter($sql);
			
			$sql = "DELETE FROM lc_tblmenytext WHERE MenyID = '$del_menuid'";
			mysql_query_simple_exequter($sql);
			
				$sqlMeny = "SELECT * FROM `lc_tblsubcat` WHERE MenyID = '$del_menuid'";
				$resultMeny = mysql_query_exequter_with_return($sqlMeny);
				while ($rowMeny = mysql_fetch_array($resultMeny, MYSQL_ASSOC))
				{
					for($i = 0 ; $i < 1; $i++) 
					{
					$SubLinkToDelete[$i] = $rowMeny["SubLink"];		
					
					 if ($manualupload == 0)
					 {
						if (file_exists("../$SubLinkToDelete[$i]")) 
						{ 
						unlink("../$SubLinkToDelete[$i]");
						} 
					 }
					
					}
				}
			
			
			$sql = "DELETE FROM lc_tblheader WHERE ID = '$del_menuid'";
			mysql_query_simple_exequter($sql);
			
			$sql = "DELETE FROM lc_tblheadertext WHERE headerID = '$del_menuid'";
			mysql_query_simple_exequter($sql);
			
	
			
			$sql = "SELECT SubID FROM `lc_tblsubcat` WHERE MenyID = '$del_menuid'";
			$result = mysql_query_exequter_with_return($sql);
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
			{
				for($i = 0; $i < 1; $i++) 
				{		
				$SubIDToDel[$i] = $row["SubID"];

				$sql = "DELETE FROM lc_tblsubcattext WHERE SubID = '$SubIDToDel[$i]'";
				mysql_query_simple_exequter($sql);
				
					
					$sql1 = "SELECT ID FROM `lc_tblpages` WHERE SubID  = '$SubIDToDel[$i]'";
					$result1 = mysql_query_exequter_with_return($sql1);
						while ($rows1 = mysql_fetch_array($result1, MYSQL_ASSOC))
						{
							for($k = 0; $k < 1; $k++) 
							{			
							$pagetextIDsub[$k] = $rows1["ID"];	
							
					
							$sql = "DELETE FROM lc_tblpagestext WHERE pageID = '$pagetextIDsub[$k]'";
							mysql_query_simple_exequter($sql);
							
							}						
						}
				
				$sql = "DELETE FROM lc_tblpages WHERE SubID = '$SubIDToDel[$i]'";
				mysql_query_simple_exequter($sql);
			
				}
				
			}
			
			$sql = "DELETE FROM lc_tblsubcat WHERE MenyID = '$del_menuid'";
			mysql_query_simple_exequter($sql);
			
					
			 $sql = "SELECT ID FROM `lc_tblpages` WHERE MenyID = '$del_menuid'";
			 $result = mysql_query_exequter_with_return($sql);
				while ($rows = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					for($j = 0; $j < 1; $j++) 
					{			
					$pagetextIDs[$j] = $rows["ID"];	
					
			
					$sql = "DELETE FROM lc_tblpagestext WHERE pageID = '$pagetextIDs[$j]'";
					mysql_query_simple_exequter($sql);
					
					}						
				}
				
				$sql = "DELETE FROM lc_tblpages WHERE MenyID = '$del_menuid'";
				mysql_query_simple_exequter($sql);
			
			$lc_UserID =  $_SESSION['sess_id'];
			createLogg($lc_UserID, $liveConCMS_logg13);
		   
			header("Refresh: 0;URL=liveconcms_menus.php");
			exit; 
		}

}

/* TEMPLATE */
 if (isset($_GET['del_template']) == "")
{

}
else
{
$del_templateid = (int) isset($_GET['del_template']) ? $_GET['del_template'] : del_template('n');

		$sql = "SELECT templateFilename FROM `lc_tbltemplates` WHERE ID ='$del_templateid'";
		$result = mysql_query_exequter_with_return($sql);
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{				
			$TemplateToDelete = $row["templateFilename"];	
		}
		
					if (file_exists("templates/$TemplateToDelete")) 
					{ 
					unlink("templates/$TemplateToDelete");
					} 	

					$sql = "DELETE FROM lc_tbltemplates WHERE ID = '$del_templateid' LIMIT 1";
					mysql_query_simple_exequter($sql);
					
					$lc_UserID =  $_SESSION['sess_id'];
					createLogg($lc_UserID, $liveConCMS_logg14);
					
					header("Refresh: 0;URL=liveconcms_templates.php?edit=1");
				  exit; 
}

/* Language */
if (isset($_GET['del_lang']) == "")
{

}
else
{
$del_lang = (int) isset($_GET['del_lang']) ? $_GET['del_lang'] : del_lang('n');

	$sql = "DELETE FROM lc_tbllanguage WHERE LanguageID = '$del_lang' LIMIT 1";
	mysql_query_simple_exequter($sql);
	
	$sql = "DELETE FROM lc_tblheadertext WHERE LanguageID = '$del_lang'";
	mysql_query_simple_exequter($sql);
	
	$sql = "DELETE FROM lc_tblmenytext WHERE LanguageID = '$del_lang'";
	mysql_query_simple_exequter($sql);
	
	$sql = "DELETE FROM lc_tblpagestext WHERE LanguageID = '$del_lang'";
	mysql_query_simple_exequter($sql);;
	
	$sql = "DELETE FROM lc_tblsubcattext WHERE LanguageID = '$del_lang'";
	mysql_query_simple_exequter($sql);
	
	$sql = "DELETE FROM lc_tblnews WHERE LanguageID = '$del_lang'";
	mysql_query_simple_exequter($sql);

	$sitelanguage = $_SESSION['sess_sitelanguage'];
	
	if ($sitelanguage == $del_lang)
	{
	$_SESSION['sess_sitelanguage'] = 1;
	}
	
	$lc_UserID =  $_SESSION['sess_id'];
	createLogg($lc_UserID, $liveConCMS_logg15);
					
	header("Refresh: 0;URL=liveconcms_languages.php?edit=1");
    exit; 
}


/* News */
if (isset($_GET['red_news_id']) == "")
{
$red_id = 0;
}
else
{
$red_id = (int) isset($_GET['red_news_id']) ? $_GET['red_news_id'] :red_news_id('n');
}

if (isset($_GET['del_news_id']) == "")
{

}
else
{
$del_id = (int) isset($_GET['del_news_id']) ? $_GET['del_news_id'] : del_news_id('n');

$sql = 'DELETE FROM lc_tblnews WHERE ID = "'.$del_id.'"  LIMIT 1';
	   mysql_query_simple_exequter($sql);
	   
	   $lc_UserID =  $_SESSION['sess_id'];
	   createLogg($lc_UserID, $liveConCMS_logg16);
	
	   header("Refresh: 0;URL=liveconcms_writenews.php");
  		exit; 

}

if (isset($_GET['del_news_archiveid']) == "")
{

}
else
{
$del_id = (int) isset($_GET['del_news_archiveid']) ? $_GET['del_news_archiveid'] : del_news_archiveid('n');

$sql = 'DELETE FROM lc_tblnews WHERE ID = "'.$del_id.'"  LIMIT 1';
	    mysql_query_simple_exequter($sql);
	   
	   $lc_UserID =  $_SESSION['sess_id'];
	   createLogg($lc_UserID, $liveConCMS_logg16);
	   
	   header("Refresh: 0;URL=liveconcms_newsarchive.php");
  		exit; 
}
?>