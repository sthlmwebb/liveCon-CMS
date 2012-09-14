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

/* MENU */
if (isset($_POST['submit_meny']))
{		
$languagePath = $_SESSION['sess_language'];
include("language/$languagePath/language.php");

				 $lc_UserID =  $_SESSION['sess_id'];
				 $updateid = (int) isset($_GET['updateid']) ? $_GET['updateid'] : updateid('n');
				 $_POST = db_escape($_POST);

						if (ISSET($_POST['Meny'])) 
						{
						$Meny = 1;
						}
						else
						{
						$Meny = 0;
						}
									
						$sql = "UPDATE lc_tblmeny SET Active = '$Meny' Where ID = '$updateid'";		
						mysql_query_simple_exequter($sql);
																 
						 createLogg($lc_UserID, $liveConCMS_logg19);

				     		$sqlMeny = "SELECT * FROM `lc_tblsubcat` WHERE MenyID = '$updateid'";
							$resultMeny = mysql_query_exequter_with_return($sqlMeny);
							while ($rowMeny = mysql_fetch_array($resultMeny, MYSQL_ASSOC))
								{
									for($i = 0 ; $i < 1; $i++) 
									{
										$SubID[$i] = $rowMeny["SubID"];
										$SubLink[$i] = $rowMeny["SubLink"];
										$MenyIndex[$i] = $rowMeny["MenyIndex"];
																					
										
										if (ISSET($_POST["Checkbox$SubID[$i]"])) 
										{
										$Active = 1;
										}
										else
										{
										$Active = 0;
										}
										
										if (ISSET($_POST["CheckboxMeny$SubID[$i]"])) 
										{
										$huvudmenyn = 1;
										}
										else
										{
										$huvudmenyn = 0;
										}
										
										if($huvudmenyn == 1)
										{
											$sql = "SELECT MenyLink FROM `lc_tblmeny` WHERE ID ='$updateid'";
											$result = mysql_query_exequter_with_return($sql);
											while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
											{			
												$MenyLink = $row["MenyLink"];
											}
											$subText = $MenyLink;
																																
												$sql = "UPDATE lc_tblsubcat SET Active = '$Active', SubLink = '$subText', MenyIndex = '$huvudmenyn' Where SubID = '$SubID[$i]'";
												mysql_query_simple_exequter($sql);
												createLogg($lc_UserID, $liveConCMS_logg19);
										
												$sqlUpdate = "UPDATE lc_tblpages SET SubID = '$SubID[$i]' WHERE MenyID = '$updateid'";
												mysql_query_simple_exequter($sqlUpdate);
												
												$_SESSION['sess_menyupdated'] = 1; 
										}
										else
										{
											$sql = "SELECT MenyLink FROM `lc_tblmeny` WHERE ID ='$updateid'";
											$result = mysql_query_exequter_with_return($sql);
											while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
											{			
												$MenyLink = $row["MenyLink"];
											}
											$subText = $MenyLink;
											
												if($SubLink[$i] == $subText)
												{
													
													if($MenyIndex[$i] != $huvudmenyn)
													{
													$sql = "UPDATE lc_tblsubcat SET SubLink  = '#' Where SubID = '$SubID[$i]'";
													mysql_query_simple_exequter($sql);

													$sql2 = "UPDATE lc_tblpages SET SubID = '0' Where MenyID = '$updateid'";
													mysql_query_simple_exequter($sql2);	
													}
													
												}
											
												$sql = "UPDATE lc_tblsubcat SET Active = '$Active', MenyIndex = '$huvudmenyn' Where SubID = '$SubID[$i]'";
												mysql_query_simple_exequter($sql);
					
												$_SESSION['sess_menyupdated'] = 1; 
												createLogg($lc_UserID, $liveConCMS_logg20);
												
												
										}

										
									   if(empty($_FILES["File$SubID[$i]"]['name'])) 
									   {
									 
									   }
									   else
									   {
									 
											$upload_dir = "../"; 
							
										    $filetypes = 'php,PHP,htm,HTM,html,HTML'; 
										  
											$maxsize = (1024*900000); 
										
											if($_FILES["File$SubID[$i]"]['size'] > $maxsize) 
											  die('$liveConCMS_error_message_4 '.(string)($maxsize/1024).' KB. <br/><a href="liveconcms_menus.php">$liveConCMS_links2</a>'); 
											  
												$types = explode(',', $filetypes); 
												$file = explode('.', $_FILES["File$SubID[$i]"]['name']); 
												$extension = $file[sizeof($file)-1]; 
												if(!in_array(strtolower($extension), $types)) 
												die("<em>$liveConCMS_error_message_5</em> <strong>php, htm, html</strong><br/><a href='liveconcms_menus.php'>$liveConCMS_links2</a>"); 
										
												$thefile = $_FILES["File$SubID[$i]"]['name'];
																
																							
												if($thefile == $SubLink[$i])
												{
												 unlink($upload_dir.$thefile);
												}
												else
												{
													$siffra = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'); 
													while (file_exists($upload_dir.$thefile)) 
													{	 
													$thefile = $siffra[rand(0, count($siffra)-1)].$thefile; 
													} 		
												}
										
									
											if (is_uploaded_file($_FILES["File$SubID[$i]"]['tmp_name']) && move_uploaded_file($_FILES["File$SubID[$i]"]['tmp_name'],$upload_dir.$thefile)) 
											{ 
										
																					  
												  $sql = "UPDATE lc_tblsubcat SET Active = '$Active', MenyIndex = '$huvudmenyn', SubLink = '$thefile' Where SubID = '$SubID[$i]'";
												  mysql_query_simple_exequter($sql);
									
												 $_SESSION['sess_menyupdated'] = 1; 
												 createLogg($lc_UserID, $liveConCMS_logg21);	

											}
											else
											{
											$languagePath = $_SESSION['sess_language'];
										    include("language/$languagePath/language.php");
										
											  $lc_UserID =  $_SESSION['sess_id'];
											  createLogg($lc_UserID, $liveConCMS_errorlogg1); 
												
											  header("Refresh: 0;URL=liveconcms_error.php?error_id = 1");
											  exit; 
											}   
									   
									   }
									
									}
								}
				 
}


if (isset($_POST['Submit_skin']))
{
$_POST = db_escape($_POST);

$valdTemplate = mysql_real_escape_string($_POST['Template']);

 $sql = "UPDATE tblconfig SET Template = '$valdTemplate' Where ID = '1'";
 mysql_query_simple_exequter($sql); 
}



if (isset($_POST['Submit_sitelanguage']))
{
$languagePath = $_SESSION['sess_language'];
include("language/$languagePath/language.php");

$_POST = db_escape($_POST);

$newlaguage = $_POST['newLanguage'];
$newprefix = $_POST['newPrefix'];

  if (empty($_POST['newLanguage'])) 
  {
    $reg_error[] = 0;   
  }
  
  
if (!isset($reg_error)) 
{
  $sql = "INSERT INTO lc_tbllanguage (LanguageDesc, LanguagePrefix) VALUES('$newlaguage', '$newprefix')";
  mysql_query_simple_exequter($sql);
  
    $sql = "SELECT LanguageID FROM `lc_tbllanguage` WHERE LanguageDesc = '$newlaguage' AND LanguagePrefix = '$newprefix'";
	$result = mysql_query_exequter_with_return($sql);
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{			
	$newsiteLanguageID = $row["LanguageID"];
	}
  
 
    $sql = "SELECT * FROM `lc_tblheadertext` WHERE LanguageID = '1'";
    $result = mysql_query_exequter_with_return($sql);
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
				for($i = 0; $i < 1; $i++) 
				{
				$headerID[$i] = $row["headerID"];	
			
				$sql = "INSERT INTO lc_tblheadertext(headerID, LanguageID, headerTitle, headerText, headerLogo) VALUES('$headerID[$i]', '$newsiteLanguageID', 'Header title here', 'Header text here', '')";
				mysql_query_simple_exequter($sql);
				}
		}
		
	$sql = "SELECT * FROM `lc_tblmenytext` WHERE LanguageID = '1'";
    $result = mysql_query_exequter_with_return($sql);
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
				for($i = 0; $i < 1; $i++) 
				{
				$MenyID[$i] = $row["MenyID"];	
				$MenyText[$i] = $row["MenyText"];	
			
				$sql = "INSERT INTO lc_tblmenytext(LanguageID, MenyID, MenyText) VALUES('$newsiteLanguageID', '$MenyID[$i]', '$MenyText[$i]')";
				mysql_query_simple_exequter($sql);
				}
		}
		
		
	$sql = "SELECT * FROM `lc_tblpagestext` WHERE LanguageID = '1'";
    $result = mysql_query_exequter_with_return($sql);
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
				for($i = 0; $i < 1; $i++) 
				{
				$pageID[$i] = $row["pageID"];	
			
				$sql = "INSERT INTO lc_tblpagestext(pageID, LanguageID, pageTitle, pageText, pageTextBackup) VALUES('$pageID[$i]', '$newsiteLanguageID', 'New Page', '<p>Pagecontent here</p>', '<p>Pagecontent here</p>')";
				mysql_query_simple_exequter($sql);
				}
		}
	
	$sql = "SELECT * FROM `lc_tblsubcattext` WHERE LanguageID = '1'";
    $result = mysql_query_exequter_with_return($sql);
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
				for($i = 0; $i < 1; $i++) 
				{
				$SubID[$i] = $row["SubID"];	
				$SubText[$i] = $row["SubText"];	
			
				$sql = "INSERT INTO lc_tblsubcattext(LanguageID, SubID, SubText) VALUES('$newsiteLanguageID', '$SubID[$i]', '$SubText[$i]')";
				mysql_query_simple_exequter($sql);
				}
		}	
	}	
	
	$lc_UserID =  $_SESSION['sess_id'];
	createLogg($lc_UserID, $liveConCMS_logg23);
	
	$display_noticemessage = 1;

}



if (isset($_POST['submit_new_news']))
{
  header("Refresh: 0;URL=liveconcms_writenews.php");
  exit;
}


if (isset($_POST['submit_news']))
{

$_POST = db_escape($_POST);

  foreach($_POST as $key => $val)
  {
    $_POST[$key] = trim($val);
  }
  
  $UpdateTitle = mysql_real_escape_string($_POST['newsTitle']);
  $UpdateText = $_POST['newsText'];
  
	if (isset($_POST['SaveLanguage']))
	{
	$defaultnewsLanguage = $_POST['SaveLanguage'];
	}
	else
	{
	$defaultnewsLanguage = 1; 
	}
	
	
  
  IF($red_id == '0')
  {

	if($defaultnewsLanguage == 0)
	{
		$sql = 'SELECT LanguageID FROM `lc_tbllanguage`';
		$result = mysql_query_exequter_with_return($sql); 
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			for($i = 0; $i < 1; $i++) 
			{
			
			$LanguageIDToInsert[$i] = $row["LanguageID"];	
												
			 $Dagensdatum = date('Y-m-d H:i:s');
			 $sql = "INSERT INTO lc_tblnews (LanguageID, Title, News, Picture, Date) VALUES('$LanguageIDToInsert[$i]', '$UpdateTitle', '$UpdateText', '', '$Dagensdatum')";
			 mysql_query_simple_exequter($sql);

			}
		}
	
	  $lc_UserID =  $_SESSION['sess_id'];
	  createLogg($lc_UserID, $liveConCMS_logg24);
		
	  $display_noticemessage = 1;
	
	}
	else
	{
	  $Dagensdatum = date('Y-m-d H:i:s');
	  $sql = "INSERT INTO lc_tblnews (LanguageID, Title, News, Picture, Date) VALUES('$defaultnewsLanguage', '$UpdateTitle', '$UpdateText', '', '$Dagensdatum')";
	  mysql_query_simple_exequter($sql);
	 
	  $lc_UserID =  $_SESSION['sess_id'];
	  createLogg($lc_UserID, $liveConCMS_logg24);
		
	  $display_noticemessage = 1;
	}
	
	 
  }
  else
  {
   $sql = "UPDATE lc_tblnews SET LanguageID = '$defaultnewsLanguage', Title = '$UpdateTitle', News =  '$UpdateText'  Where ID = '$red_id'";
   mysql_query_simple_exequter($sql);
     
  $lc_UserID =  $_SESSION['sess_id'];
  createLogg($lc_UserID, $liveConCMS_logg25);
  
  $display_noticemessage = 1;

  }
}




if (isset($_POST['Submit_meta']))
{
$_POST = db_escape($_POST);

$metaKeywords  = mysql_real_escape_string($_POST['metaKeywords']);
$metaDescription  = mysql_real_escape_string($_POST['metaDescription']);

 $sql = "UPDATE lc_tblconfig SET metaKeywords  = '$metaKeywords', metaDescription = '$metaDescription'  Where ID = '1'";
 mysql_query_simple_exequter($sql); 

 $lc_UserID =  $_SESSION['sess_id'];
 createLogg($lc_UserID, $liveConCMS_logg26);
  
  $display_noticemessage = 1;

}


if (isset($_POST['Submit_title']))
{
$_POST = db_escape($_POST);

$titelText  = mysql_real_escape_string($_POST['titelText']);

 $sql = "UPDATE lc_tblconfig SET SiteTitle = '$titelText' Where ID = '1'";
 mysql_query_simple_exequter($sql);  

 $lc_UserID =  $_SESSION['sess_id'];
 createLogg($lc_UserID, $liveConCMS_logg27);
 
 $display_noticemessage = 1;

}

if (isset($_POST['Submit_editor']))
{
$_POST = db_escape($_POST);

$htmleditor  = $_POST['htmleditor'];

 $sql = "UPDATE lc_tblconfig SET htmlEditor = '$htmleditor' Where ID = '1'";
 mysql_query_simple_exequter($sql);

 $lc_UserID =  $_SESSION['sess_id'];
 createLogg($lc_UserID, $liveConCMS_logg28);
 
 $display_noticemessage = 1;

}


if (isset($_POST['Submit_language']))
{
$_POST = db_escape($_POST);


$valdtSprak = mysql_real_escape_string($_POST['Template']);

	if (file_exists("core/language/$valdtSprak/language.php")) 
	{
	 $lc_UserID =  $_SESSION['sess_id'];
	 $sql = "UPDATE lc_tbladministrator SET languagepath  = '$valdtSprak' Where ID = '$lc_UserID'";
	 mysql_query($sql);  
	 
	 $_SESSION['sess_language'] = $valdtSprak;

	
	createLogg($lc_UserID, $liveConCMS_logg29);
 
 $display_noticemessage = 1;

	 }
	 else
	 {
	 $reg_error[] = 3; 
	 }
}


if (isset($_POST['Submit_google']))
{

$_POST = db_escape($_POST);

$googleText  = $_POST['googleText'];

 $sql = "UPDATE lc_tblconfig SET googleanalytics = '$googleText' Where ID = '1'";
 mysql_query_simple_exequter($sql); 
 
 $lc_UserID =  $_SESSION['sess_id'];
 createLogg($lc_UserID, $liveConCMS_logg30);
 
 $display_noticemessage = 1;

}

if (isset($_POST['Submit_uploadtype']))
{

$_POST = db_escape($_POST);

$manueluppload  = $_POST['manualupload'];

 $sql = "UPDATE lc_tblconfig SET manualupload = '$manueluppload' Where ID = '1'";
mysql_query_simple_exequter($sql);

 $lc_UserID =  $_SESSION['sess_id'];
 createLogg($lc_UserID, $liveConCMS_logg31);
 
 $display_noticemessage = 1;

}

?>