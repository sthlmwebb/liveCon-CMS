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

function liveConCMS_SystemPageID($Path, $editPath, $nav, $pageEditID, $pageEditSubID, $pageEditfilename, $system)
{
$_SESSION['sess_liveConCMSPageIndex'] = array($Path,$editPath,$nav,$pageEditID,$pageEditSubID,$pageEditfilename, $system); 
return true;
}

function CheckIP() 
{ 
   if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
      if (preg_match('/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}/', $_SERVER['HTTP_X_FORWARDED_FOR'], $addresses)) 
         return $addresses[0]; 
   } 
   return (isset($_SERVER['HTTP_CLIENT_IP'])) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR']; 
}


function pluginSearch($dir) 
{ 
$languagePath = $_SESSION['sess_language'];
include("language/$languagePath/language.php");

	if (is_dir($dir)) 
	{ 
		$dh = opendir($dir); 
				 while (false !== ($file = readdir($dh))) 
				 { 
				        if ($file != "." && $file != "..") 
						{ 
				            if (is_dir($dir."/".$file)) 
							{ 
							  			  
								if(file_exists("plugins/$file/plugin_install.php"))
								{	
							        $SQLInstall = false;
				                    include("plugins/$file/plugin_install.php");
									
									$SQLPlugin = "SELECT COUNT(*) FROM `lc_tblmodules` WHERE pluginTitle = '$pluginTitle' AND pluginPath = '$pluginFolder/$pluginFile'";
									$resultatPlugin= mysql_query_exequter_with_return($SQLPlugin);
									while ($rowPlugin = mysql_fetch_array($resultatPlugin, MYSQL_ASSOC))
									{
									$modulesCount = $rowPlugin["COUNT(*)"];
									}

										if($modulesCount != "0")
										{
											
										}
										else
										{
								
										$sql = "INSERT INTO lc_tblmodules(pluginTitle, pluginPath, pluginFolder, pluginAbout) VALUES('$pluginTitle', '$pluginFolder/$pluginFile', '$pluginFolder',  '$pluginAbout')";
										mysql_query_simple_exequter($sql);
										
										$lc_UserID =  $_SESSION['sess_id'];
										createLogg($lc_UserID, $liveConCMS_logg32);
										 
										$SQLInstall = true;
										include("plugins/$file/plugin_install.php");
										
										}
								
								}	
								else
								{
								
								}
						  
				            } 
				        } 
				 } 
		closedir($dh); 
	}
	else
	{

	}				
}

function liveConFileCopy($source, $dest, $options=array('folderPermission'=>0755,'filePermission'=>0755)) 
    { 
        $result=false; 
        
        if (is_file($source)) { 
            if ($dest[strlen($dest)-1]=='/') { 
                if (!file_exists($dest)) { 
                    cmfcDirectory::makeAll($dest,$options['folderPermission'],true); 
                } 
                $__dest=$dest."/".basename($source); 
            } else { 
                $__dest=$dest; 
            } 
            $result=copy($source, $__dest); 
            chmod($__dest,$options['filePermission']); 
            
        } elseif(is_dir($source)) { 
            if ($dest[strlen($dest)-1]=='/') { 
                if ($source[strlen($source)-1]=='/') { 
                   
                } else { 
                  
                    $dest=$dest.basename($source); 
                    @mkdir($dest); 
                    chmod($dest,$options['filePermission']); 
                } 
            } else { 
                if ($source[strlen($source)-1]=='/') { 
                  
                    @mkdir($dest,$options['folderPermission']); 
                    chmod($dest,$options['filePermission']); 
                } else { 
                
                    @mkdir($dest,$options['folderPermission']); 
                    chmod($dest,$options['filePermission']); 
                } 
            } 

            $dirHandle=opendir($source); 
            while($file=readdir($dirHandle)) 
            { 
                if($file!="." && $file!="..") 
                { 
                     if(!is_dir($source."/".$file)) { 
                        $__dest=$dest."/".$file; 
                    } else { 
                        $__dest=$dest."/".$file; 
                    } 
                  
                    $result=smartCopy($source."/".$file, $__dest, $options); 
                } 
            } 
            closedir($dirHandle); 
            
        } else { 
            $result=false; 
        } 
        return $result; 
    }


/* LOGG Funktion */	
/*****************************************/	

function createLogg($UserID, $loggText)
{
$Dagensdatum = date('Y-m-d H:i:s');
$sql = "INSERT INTO lc_tblhistory (UserID, HistoryLogg, HistoryDate) VALUES('$UserID', '$loggText', '$Dagensdatum')";
mysql_query_simple_exequter($sql);

return true;
}

function deleteLoggEntry($ID)
{
	$sql = 'DELETE FROM lc_tblhistory WHERE ID = "'.$ID.'"';
	mysql_query_simple_exequter($sql);
	
return true;
}

function deleteLogg()
{
	$sql = "TRUNCATE TABLE lc_tblhistory";
	mysql_query_simple_exequter($sql);
	
return true;
}
	

function checkRole($intRole, $pagename)
{


	if (!isset($_SESSION['sess_role']))
	{
	 header("Refresh: 0;URL=liveconcms_logout.php?logout=");
	 exit; 
	}

 /* Super admin */
	$AllowedPageRole1 = array('liveconcms_addmenu','liveconcms_addsubmenu','liveconcms_addtemplate','liveconcms_changeimg','liveconcms_editmenu','liveconcms_history','liveconcms_languages','liveconcms_manager','liveconcms_menus','liveconcms_modules','liveconcms_newsarchive','liveconcms_startpage','liveconcms_statistics','liveconcms_system','liveconcms_templates','liveconcms_writenews','liveconintra_index','liveconintra_register', 'liveconintra_users');
	
  /* Admin */
	$AllowedPageRole0 = array('liveconintra_singel', 'liveconintra_singeluser', 'liveconcms_about');
	
 /* Regular user*/
	$AllowedPageRole2 = array('liveconcms_addmenu','liveconcms_addsubmenu','liveconcms_addtemplate','liveconcms_changeimg','liveconcms_editmenu','liveconcms_history','liveconcms_languages','liveconcms_manager','liveconcms_menus','liveconcms_modules','liveconcms_newsarchive','liveconcms_startpage','liveconcms_statistics','liveconcms_system','liveconcms_templates','liveconcms_writenews','liveconintra_index','liveconintra_register', 'liveconintra_users');
	
	
	if($intRole == 1)
	{
		if (in_array($pagename, $AllowedPageRole1)) 
		{
	
		}
		else
		{
		 header("Refresh: 0;URL=liveconcms_logout.php?logout=");
		 exit; 
		}	
	}
	elseif($intRole == 2)
	{
	
		if (in_array($pagename, $AllowedPageRole2)) 
		{
	
		}
		else
		{
		 header("Refresh: 0;URL=liveconcms_logout.php?logout=");
		 exit; 
		}	
	}
	else if($intRole == 0)
	{
		
		if (in_array($pagename, $AllowedPageRole0)) 
		{
	
		}
		else
		{
		 header("Refresh: 0;URL=liveconcms_logout.php?logout=");
		 exit; 
		}	
		
	}
	else if($intRole == 3)
	{
	
	  $AdminPages = $_SESSION['sess_liveConCustomMenu'] [0];
	  $AdminNews = $_SESSION['sess_liveConCustomMenu'] [1];
	  $AdminTemplates = $_SESSION['sess_liveConCustomMenu'] [2];
      $AdminLanguages = $_SESSION['sess_liveConCustomMenu'] [3];
      $AdminExplorer = $_SESSION['sess_liveConCustomMenu'] [4];
      $AdminModules = $_SESSION['sess_liveConCustomMenu'] [5];
      $AdminUser = $_SESSION['sess_liveConCustomMenu'] [6];
      $AdminStatistic = $_SESSION['sess_liveConCustomMenu'] [7];
      $AdminSystem = $_SESSION['sess_liveConCustomMenu'] [8];
	
	    if (in_array($pagename, $AllowedPageRole1)) 
		{
	
		}
		else
		{
		 header("Refresh: 0;URL=liveconcms_logout.php?logout=");
		 exit; 
		}
		
		if (!$intRole == 3 && $pagename == "liveconcms_startpage")
		{
		 header("Refresh: 0;URL=liveconcms_logout.php?logout=");
		 exit;
		}
		
		if (!$AdminPages == 1 && $pagename == "liveconcms_menus")
		{
		 header("Refresh: 0;URL=liveconcms_logout.php?logout=");
		 exit;
		}
		
		if (!$AdminNews == 1 && $pagename == "liveconcms_writenews")
		{
		 header("Refresh: 0;URL=liveconcms_logout.php?logout=");
		 exit;
		}
				
		if (!$AdminTemplates == 1 && $pagename == "liveconcms_templates")
		{
		 header("Refresh: 0;URL=liveconcms_logout.php?logout=");
		 exit;
		}
		
		if (!$AdminLanguages == 1 && $pagename == "liveconcms_languages")
		{
		 header("Refresh: 0;URL=liveconcms_logout.php?logout=");
		 exit;
		}
		
		if (!$AdminExplorer == 1 && $pagename == "liveconcms_manager")
		{
		 header("Refresh: 0;URL=liveconcms_logout.php?logout=");
		 exit;
		}
		
		if (!$AdminModules == 1 && $pagename == "liveconcms_modules")
		{
		 header("Refresh: 0;URL=liveconcms_logout.php?logout=");
		 exit;
		}
		
		if (!$AdminUser == 1 && $pagename == "liveconintra_register")
		{
		 header("Refresh: 0;URL=liveconcms_logout.php?logout=");
		 exit;
		}
		
		if (!$AdminStatistic == 1 && $pagename == "liveconcms_statistics")
		{
		 header("Refresh: 0;URL=liveconcms_logout.php?logout=");
		 exit;
		}
		
		if (!$AdminSystem == 1 && $pagename == "liveconcms_system")
		{
		 header("Refresh: 0;URL=liveconcms_logout.php?logout=");
		 exit;
		}
		

	}
	else
	{
	     header("Refresh: 0;URL=liveconcms_logout.php?logout=");
		 exit; 
	}
	
	
}

/* MYSQL Queries */
function mysql_query_simple_exequter($query)
{
	$sql = $query;

	if (!mysql_query($sql))
	{
	 $lc_UserID =  $_SESSION['sess_id'];
	 $errorStringSQL = mysql_error();
     $errorStringSQL  = addslashes($errorStringSQL);	
	 $Errorquery = addslashes($sql);

	 $loggInDatabase = "$errorStringSQL\n\n$Errorquery";
	 	 
	 createLogg($lc_UserID, $loggInDatabase);
	 echo "Error in liveCon CMS, see history for complete error message!";
	 echo "<br/>";
	 echo "<br/>";
	 echo "<a href='../index.php'>[Back to liveCon CMS]</a>";
	 die;
	}
}

function mysql_query_exequter_with_return($query)
{
	$sql = $query;

	if (!mysql_query($sql))
	{
	 $lc_UserID =  $_SESSION['sess_id'];
	 $errorStringSQL = mysql_error();
     $errorStringSQL  = addslashes($errorStringSQL);	
	 $Errorquery = addslashes($sql);

	 $loggInDatabase = "$errorStringSQL\n\n$Errorquery";
	 	 
	 createLogg($lc_UserID, $loggInDatabase);
	 echo "Error in liveCon CMS, see history for complete error message!";
	 die;
	}
	else
	{
	return mysql_query($sql);
	}
}

function mysql_query_count($query)
{
$_SESSION['lc_queries']++;
return mysql_query($query);
}

function mysql_pluginquery_executer($query)
{
$sql = $query;
mysql_query_simple_exequter($sql);
}

function mysql_query_pluginuninstall_executer($query)
{
$languagePath = $_SESSION['sess_language'];
include("language/$languagePath/language.php");

$string = $query;
$chunks = explode(",", $string);

	foreach ($chunks as &$value) 
	{
		$systemTables = array("lc_tbladministrator", "lc_tblanhorig", "lc_tblconfig", "lc_tblfooter", "lc_tblheader", "lc_tblheadertext", "lc_tblhistory", "lc_tbllanguage", "lc_tbllicens", "lc_tblmeny", "lc_tblmenytext", "lc_tblmodules", "lc_tblnews", "lc_tblnoticebord", "lc_tblpages", "lc_tblpagestext", "lc_tblsubcat", "lc_tblsubcattext", "lc_tbltemplates", "lc_tbluploadedfiles", "lc_tblversion", "lc_tblvisitorlogg");
		
		if (in_array($value, $systemTables)) 
		{
	
		}
		else
		{
		$sql = "DROP TABLE $value";
		mysql_query_simple_exequter($sql);
		}
	}
}
?>