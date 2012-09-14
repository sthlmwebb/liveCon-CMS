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

function liveConCMS_PageID($pageEditfilename)
{
	$Path = "./liveConCMS";
	$editPath = "."; 
	$nav = "0";
	$systemFile = "";	
	
	if($pageEditfilename == "")
	{
		$_SESSION['sess_liveConCMSPageIndex'] = array($Path,$editPath,$nav,1,0,'index.php', '');
	}
		$pageEditID = "";
		$pageEditSubID = "";

		$sqlmenyid = "SELECT ID FROM lc_tblmeny WHERE MenyLink = '$pageEditfilename'";
		$resultmenyid = mysql_query($sqlmenyid) or die('Query failed: ' . mysql_error());
		while ($rowmenyid = mysql_fetch_array($resultmenyid, MYSQL_ASSOC))
		{			
		$pageEditID = $rowmenyid["ID"];
		}
		
			if ($pageEditID == "")
			{
				$sqlmenyid = "SELECT MenyID FROM lc_tblsubcat WHERE SubLink = '$pageEditfilename'";
				$resultmenyid = mysql_query($sqlmenyid) or die('Query failed: ' . mysql_error());
				while ($rowmenyid = mysql_fetch_array($resultmenyid, MYSQL_ASSOC))
				{			
				$pageEditID = $rowmenyid["MenyID"];
				}
			}
		
				if($pageEditID == "")
				{
				$pageEditID = 0;
				}
				
				$sqlsubmenyid = "SELECT SubID FROM lc_tblsubcat WHERE SubLink = '$pageEditfilename' AND MenyID = '$pageEditID'";
				$resultsubmenyid = mysql_query($sqlsubmenyid) or die('Query failed: ' . mysql_error());
				while ($rowsubmenyid = mysql_fetch_array($resultsubmenyid, MYSQL_ASSOC))
				{			
				$pageEditSubID = $rowsubmenyid["SubID"];
				}
		
		/* No hit, default is 0. */
		if($pageEditSubID == "")
		{
		$pageEditSubID  = 0;
		}
		
	$_SESSION['sess_liveConCMSPageIndex'] = array($Path,$editPath,$nav,$pageEditID,$pageEditSubID,$pageEditfilename,$systemFile); 
	
return true;
}

function liveConCMS_SetAdminPanel()
{
include("liveConCMS/liveconcms_panel.php");
return true;
}

function liveConCMS_SiteTitle()
{
		$sql = "SELECT SiteTitle FROM lc_tblconfig";
		$result = mysql_query($sql) or die('Query failed: ' . mysql_error());
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{			
		$SiteTitle = $row["SiteTitle"];
		}

			if($SiteTitle == "")
			{
			return print "No site title - LiveConCMS";
			}
			else
			{
			return print $SiteTitle;
			}
}

function liveConCMS_SitePageHeader()
{
	    $sitelanguage = $_SESSION['sess_sitelanguage'];
		
				$intCMSPageID = $_SESSION['sess_liveConCMSPageIndex'] [3];
				$sql = "SELECT headerTitle FROM `lc_tblheader`, `lc_tblheadertext` WHERE lc_tblheader.ID = '$intCMSPageID' AND lc_tblheadertext.LanguageID = '$sitelanguage' AND lc_tblheader.ID = lc_tblheadertext.headerID";
				
				$result = mysql_query($sql) or die('Query failed: ' . mysql_error());
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
				$headerTitle = $row["headerTitle"];
				}
				
		if($headerTitle == "")
		{
		return print "";
		}
		else
		{				
		$HeaderHTML = "$headerTitle";			
		}
		
	return print $HeaderHTML;	
}


function liveConCMS_DisplayMeta()
{
	$sqlmeta = "SELECT * FROM `lc_tblconfig` WHERE ID ='1'";
	$resultmeta = mysql_query($sqlmeta) or die('Query failed: ' . mysql_error());
	while ($rowmeta = mysql_fetch_array($resultmeta, MYSQL_ASSOC))
	{					
	$metaDescription = $rowmeta["metaDescription"];
	$metaGenerator = $rowmeta["metaGenerator"];
	$metaTitle = $rowmeta["metaTitle"];
	$metaKeywords = $rowmeta["metaKeywords"];							
	}
	
	return print "<META NAME='GENERATOR' CONTENT='$metaGenerator'>\n<META NAME='TITLE' CONTENT='$metaTitle'>\n<META NAME='KEYWORDS' CONTENT='$metaKeywords'>\n<META NAME='DESCRIPTION' CONTENT='$metaDescription'>\n";
}

function liveConCMS_DisplayGoogleAnalytics()
{

	$displayGoogleAnalytics = "";

	$sqlanalytics = "SELECT googleanalytics FROM `lc_tblconfig` WHERE ID ='1'";
	$resultanalytics = mysql_query($sqlanalytics) or die('Query failed: ' . mysql_error());
	while ($rowanalytics = mysql_fetch_array($resultanalytics, MYSQL_ASSOC))
	{					
	$displayGoogleAnalytics = $rowanalytics["googleanalytics"];					
	}
	
		
	return print $displayGoogleAnalytics;
}

function liveConCMS_DisplayVersion()
{
	$sqlVersion = "SELECT * FROM `lc_tblversion` WHERE ID ='1'";
	$resultVersion = mysql_query($sqlVersion) or die('Query failed: ' . mysql_error());
	while ($rowVersion = mysql_fetch_array($resultVersion, MYSQL_ASSOC))
	{					
	$CMSTitle = $rowVersion["Title"];
	$CMSVersion = $rowVersion["Version"];								
	}
	return print "$CMSTitle - $CMSVersion\n";
}

function liveConCMS_PageHeader($edit)
{
		$sitelanguage = $_SESSION['sess_sitelanguage'];
		$edit = (int) $edit;
		if($edit == 1)
		{
		$languagePath = $_SESSION['sess_language'];
	    include("liveConCMS/core/language/$languagePath/language.php");
		}

				$intCMSPageID = $_SESSION['sess_liveConCMSPageIndex'] [3];
				$sql = "SELECT headerTitle FROM `lc_tblheader`, `lc_tblheadertext` WHERE lc_tblheader.ID = '$intCMSPageID' AND lc_tblheadertext.LanguageID = '$sitelanguage' AND lc_tblheader.ID = lc_tblheadertext.headerID";
				
				$result = mysql_query($sql) or die('Query failed: ' . mysql_error());
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
				$headerTitle = $row["headerTitle"];
				}
				
		if($headerTitle == "")
		{
		return print "";
		}
		else
		{

				if ($edit == 0)
				{
				$HeaderHTML = "<h1>$headerTitle</h1>\n";	
				}
				else
				{
				$HeaderHTML = "<h1 class='editme1' id='H$intCMSPageID'  title='$OnPageToolTip_1'>$headerTitle</h1>\n";
				}
		}
		
	return print $HeaderHTML;
}

function liveConCMS_PageHeaderText($edit)
{
		$sitelanguage = $_SESSION['sess_sitelanguage'];
		$edit = (int) $edit;
		
		if($edit == 1)
		{
		$languagePath = $_SESSION['sess_language'];
	    include("liveConCMS/core/language/$languagePath/language.php");
		}
		
				$intCMSPageID = $_SESSION['sess_liveConCMSPageIndex'] [3];
				$sql = "SELECT headerText FROM `lc_tblheader`, `lc_tblheadertext` WHERE lc_tblheader.ID = '$intCMSPageID' AND lc_tblheadertext.LanguageID = '$sitelanguage' AND lc_tblheader.ID = lc_tblheadertext.headerID";
				$result = mysql_query($sql) or die('Query failed: ' . mysql_error());
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
				$headerText = $row["headerText"];
				}
				
		if($headerText == "")
		{
		return print "";
		}
		else
		{

				if ($edit == 0)
				{
				$HeaderTextHTML = "<h2>$headerText</h2>\n";	
				}
				else
				{
				$HeaderTextHTML = "<h2 class='editme1' id='E$intCMSPageID' title='$OnPageToolTip_1'>$headerText</h2>\n";
				}
		}
				
	return print $HeaderTextHTML;
}

function liveConCMS_FooterText($edit)
{
		$edit = (int) $edit;
		if($edit == 1)
		{
		$languagePath = $_SESSION['sess_language'];
	    include("liveConCMS/core/language/$languagePath/language.php");
		}
 
	$sqlfooter = "SELECT Text FROM `lc_tblfooter` WHERE ID = '1'";
	$resultfooter = mysql_query($sqlfooter) or die('Query failed: ' . mysql_error());
	while ($rowfooter = mysql_fetch_array($resultfooter, MYSQL_ASSOC))
	{
	$pagefooterText = $rowfooter["Text"];
	}

		if($pagefooterText == "")
		{
		return print "";
		}
		else
		{
				if ($edit == 1)
				{
				$editText = "<span class='editpage_edit'>\n<a href='#' rel='#mies2'><b>Editera text</b></a>\n</span>\n";
				}
				else
				{
				$editText ="";
				}
			
				$FooterHTML = "<div id='footer'>\n$editText\n<span>\n$pagefooterText\n<span>\n\n</div>\n";
			
		}
		
	return print $FooterHTML;
}

function liveConCMS_Menu($edit)
{
	$edit = (int) $edit;
	if($edit == 1)
	{
		$languagePath = $_SESSION['sess_language'];
	    include("liveConCMS/core/language/$languagePath/language.php");
	}
					$sitelanguage = $_SESSION['sess_sitelanguage'];
					
					$intCMSPageID = $_SESSION['sess_liveConCMSPageIndex'] [3];
					$MenuHTML = "";
					$SimpelLine = "";
					$sql = "SELECT * FROM `lc_tblmeny`, `lc_tblmenytext` WHERE lc_tblmeny.Active = '1' AND lc_tblmenytext.LanguageID = '$sitelanguage' AND lc_tblmeny.ID = lc_tblmenytext.MenyID  ORDER BY `sort` DESC";
					$result = mysql_query($sql) or die('Query failed: ' . mysql_error());
					while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
					{
						for($i = 0 ; $i < 1; $i++) 
						{
						$MenyID[$i] = $row["ID"];
						$MenyText[$i] = $row["MenyText"];
						$MenyLink[$i] = $row["MenyLink"];
						
							
							if ($MenyID[$i] == $intCMSPageID)
							{
								if($edit == 0)
								{
								$SimpelLine = "<li id='menu-active'><b><a href='$MenyLink[$i]'>$MenyText[$i]</a></b></li>\n";
								$MenuHTML = "$SimpelLine$MenuHTML";
								}
								else
								{
								$SimpelLine = "<li id='menu-active'><b><a>$MenyText[$i]</a></b></li>\n";
								$MenuHTML = "$SimpelLine$MenuHTML";
								}						
							}
							else
							{
							
								if($edit == 0)
								{
								$SimpelLine = "<li><b><a href='$MenyLink[$i]'>$MenyText[$i]</a></b></li>\n";
								$MenuHTML = "$SimpelLine$MenuHTML";
								}
								else
								{
								$SimpelLine = "<li><b><a>$MenyText[$i]</a></b></li>\n";
								$MenuHTML = "$SimpelLine$MenuHTML";
								}
							}
						
						}
					}

					if($edit == 0)
					{
					$ToolTipDiv = "<div id='primary-navigation'>";
					}
					else
					{
					$ToolTipDiv = "<div id='primary-navigation' class='lc-editable-object' title='$OnPageToolTip_2'>";
					}
				
				$MenuHtmlText = "$ToolTipDiv\n<ul class='lc-main-nav'>\n$MenuHTML\n</ul>\n</div>\n<!-- #primary-navigation -->";
	

	return print $MenuHtmlText;
}

function liveConCMS_SubMenu($edit)
{
	$edit = (int) $edit;
	if($edit == 1)
	{
		$languagePath = $_SESSION['sess_language'];
	    include("liveConCMS/core/language/$languagePath/language.php");
	}
	
		$sitelanguage = $_SESSION['sess_sitelanguage'];
		$i = "";
		$SubMenuHTML = "";
		$SimpelLine = "";
		$intCMSPageID = $_SESSION['sess_liveConCMSPageIndex'] [3];
		$intCMSSubPageID = $_SESSION['sess_liveConCMSPageIndex'] [4];
		
		$sql = "SELECT * FROM `lc_tblsubcat`, `lc_tblsubcattext` WHERE lc_tblsubcat.MenyID = '$intCMSPageID' AND lc_tblsubcat.Active = '1' AND lc_tblsubcattext.LanguageID = '$sitelanguage' AND  lc_tblsubcat.SubID = lc_tblsubcattext.SubID  ORDER BY `sort` DESC";
		$result = mysql_query($sql) or die('Query failed: ' . mysql_error());
		
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
	    {

			for($i = 0 ; $i < 1; $i++) 
			{
				$SubID[$i] = $row["SubID"];	
				$SubText[$i] = $row["SubText"];
				$SubLink[$i] = $row["SubLink"];
				$SubIndex[$i] = $row["MenyIndex"];
			
				if ($SubID[$i] == $intCMSSubPageID)
				{
								
					if ($edit == 0)
					{
					$SimpelLine = "<li id='sub-menu-active'><b><a href='$SubLink[$i]'>$SubText[$i]</a></b></li>\n";
					$SubMenuHTML = "$SimpelLine$SubMenuHTML";
					}
					else
					{
					$SimpelLine = "<li id='sub-menu-active'><b><a>$SubText[$i]</a></b></li>\n";
					$SubMenuHTML = "$SimpelLine$SubMenuHTML";
					}
				
				}		
				else
				{
				
					if ($edit == 0)
					{
					$SimpelLine = "<li><b><a href='$SubLink[$i]'>$SubText[$i]</a></b></li>\n";
					$SubMenuHTML = "$SimpelLine$SubMenuHTML";
					}
					else
					{
					$SimpelLine = "<li><b><a>$SubText[$i]</a></b></li>\n";
					$SubMenuHTML = "$SimpelLine$SubMenuHTML";
					}
				}
			
			}
		}

		
					if($edit == 0)
					{
					$ToolTipDiv = "<div id='lc-sub-nav'>";
					}
					else
					{
					$ToolTipDiv = "<div id='lc-sub-nav' class='lc-editable-object' title='$OnPageToolTip_2'>";
					}
		
		
			$SubMenuHtmlText = "$ToolTipDiv\n<ul class='lc-menu'>\n$SubMenuHTML\n</ul>\n</div>\n<!-- #sub-nav -->\n";
	
	return print $SubMenuHtmlText;

}


/* News */
function liveConCMS_ListNews($antal, $target, $bool, $ulClass, $liClass)
{
	$antal = (int) $antal;
	$bool = (int) $bool;
	$newslanguage = $_SESSION['sess_sitelanguage'];
	
		$SimpelLine = "";
		$HTMLCollective = "";
		
		$sql_newslist = "SELECT * FROM `lc_tblnews` WHERE LanguageID = '$newslanguage' ORDER BY Date ASC LIMIT 0,$antal";
		$result_newslist = mysql_query($sql_newslist) or die('Query failed: ' . mysql_error());
		while ($row_newslist = mysql_fetch_array($result_newslist, MYSQL_ASSOC))
		{
			for($i = 0; $i < 1; $i++) 
			{
			
			$NewsID[$i] = $row_newslist["ID"];	
			$NewsTitle[$i] = $row_newslist["Title"];
			$NewsDate[$i] = $row_newslist["Date"];				
			$hours = date("Y-m-d",strtotime("$NewsDate[$i]"));
			
			if($ulClass != "")
			{
			$startUL = "<ul class=\"$ulClass\">";
			}
			else
			{
			$startUL = "<ul>";
			}
			
			if($liClass != "")
			{
			$startLI = "<li class=\"$liClass\">";
			}
			else
			{
			$startLI = "<li>";
			}
			
			$endUL = "</ul>";
			
			if($bool == 1)
			{
			$SimpelLine = "$startLI<a href='$target?news=$NewsID[$i]'>$NewsTitle[$i]</a></li>\n";
			}
			else
			{
			$SimpelLine = "$startLI<a href='$target'>$NewsTitle[$i]</a></li>\n";
			}
		
			$HTMLCollective = "$SimpelLine$HTMLCollective";				
			
			}
		}

	$listNewsHTML = "$startUL\n$HTMLCollective$endUL\n";

return print $listNewsHTML;
}


function liveConCMS_ListNewsExtended($antal, $target, $bool, $TitleTagg, $EndTitleTagg, $DescriptionStart, $DescriptionEnd, $breakline, $chars)
{
	$antal = (int) $antal;
	$bool = (int) $bool;
	$newslanguage = $_SESSION['sess_sitelanguage'];
	
		$SimpelLine = "";
		$HTMLCollective = "";
		
		$sql_newslist = "SELECT * FROM `lc_tblnews` WHERE LanguageID = '$newslanguage' ORDER BY Date ASC LIMIT 0,$antal";
		$result_newslist = mysql_query($sql_newslist) or die('Query failed: ' . mysql_error());
		while ($row_newslist = mysql_fetch_array($result_newslist, MYSQL_ASSOC))
		{
			for($i = 0; $i < 1; $i++) 
			{
			
			$NewsID[$i] = $row_newslist["ID"];	
			$NewsTitle[$i] = $row_newslist["Title"];
			$NewsText[$i] = nl2br($row_newslist["News"]);
			$NewsDate[$i] = $row_newslist["Date"];				
			$hours = date("Y-m-d",strtotime("$NewsDate[$i]"));
			
		
			$text = $NewsText[$i]." "; 
			$text = substr($text,0,$chars); 
			$text = substr($text,0,strrpos($text,' ')); 
			$text = $text."..."; 

			
			
			$startTitle = "$TitleTagg$NewsTitle[$i]$EndTitleTagg \n";
			$Description = "$DescriptionStart$text$DescriptionEnd";
			
			if($bool == 1)
			{
			$SimpelLine = "$startTitle\n$Description\n<a href='$target?news=$NewsID[$i]'>Läs mer...</a>\n$breakline\n";
			}
			else
			{
			$SimpelLine = "$startTitle\n$Description\n<a href='$target'>Läs mer...</a>\n$breakline\n";
			}
		
			$HTMLCollective = "$SimpelLine$HTMLCollective\n";				
			
			}
		}

	$listNewsHTML = "$HTMLCollective\n";

return print $listNewsHTML;
}

function liveConCMS_ListNewsExtendedWithPaging($target, $bool, $TitleTagg, $EndTitleTagg, $DescriptionStart, $DescriptionEnd, $breakline, $chars, $PagingSize, $PagingCSS)
{

	$bool = (int) $bool;
	$newslanguage = $_SESSION['sess_sitelanguage'];
	
		$SimpelLine = "";
		$HTMLCollective = "";
		
		
						$Traffar = "SELECT COUNT(*) FROM `lc_tblnews` WHERE LanguageID = '$newslanguage'";
						$Restraffar = mysql_query($Traffar) or die('Query failed: ' . mysql_error());
						while ($rowtraffar = mysql_fetch_array($Restraffar, MYSQL_ASSOC))
						{
						$Antal = $rowtraffar["COUNT(*)"];
						}
						
						$newoffset = "";
					
						$limit = $PagingSize; 
					
						$result = @mysql_query("SELECT count(*) as count FROM `lc_tblnews` WHERE LanguageID = '$newslanguage'")
						  or die("Error fetching number in DB<br>".mysql_error());
						$row = @mysql_fetch_array($result);
						$numrows = $row['count']; 
						 
					
						if (!isset($_GET['start']) || $_GET['start'] == "")
						  $start = 0;
						else
						  $start = $_GET['start'];
						 
						
						$pages = intval($numrows/$limit);
						if ($numrows%$limit)
						  $pages++;
						 
						
						if ($start > 0) {
						  $numlink = '<a href="?start=0">&laquo;&laquo;</a> ';
						  $numlink .= '<a href="?start='.($start - $limit).'">&laquo;</a> ';
						} else {
						  $numlink = '<i>&laquo;&laquo;</i> ';
						  $numlink .= '<i>&laquo;</i> ';
						}
						 
					
						for ($i = 1; $i <= $pages; $i++) {
						  $newoffset = $limit*($i-1);
						  if ($start == $newoffset)
							$numlink .= '<i>['.$i.']</i> ';
						  else
							$numlink .= '<a href="?start='.$newoffset.'">'.$i.'</a> ';
						}
						 
						
						if ($numrows > ($start + $limit))
						  $numlink .= '<a href="?start='.($start + $limit).'">&raquo;</a> ';
						else
						  $numlink .= '<i>&raquo;</i> ';
						 
						
						if ($start != $newoffset)
						  $numlink .= '<a href="?start='.$newoffset.'">&raquo;&raquo;</a> ';
						else
						  $numlink .= '<i>&raquo;&raquo;</i>';
						
		
		$sql_newslist = "SELECT * FROM `lc_tblnews` WHERE LanguageID = '$newslanguage' ORDER BY Date DESC LIMIT $start, $limit";
		$result_newslist = mysql_query($sql_newslist) or die('Query failed: ' . mysql_error());
		while ($row_newslist = mysql_fetch_array($result_newslist, MYSQL_ASSOC))
		{
			for($i = 0; $i < 1; $i++) 
			{
			
			$NewsID[$i] = $row_newslist["ID"];	
			$NewsTitle[$i] = $row_newslist["Title"];
			$NewsText[$i] = nl2br($row_newslist["News"]);
			$NewsDate[$i] = $row_newslist["Date"];				
			$hours = date("Y-m-d",strtotime("$NewsDate[$i]"));
			
		
			$text = $NewsText[$i]." "; 
			$text = substr($text,0,$chars); 
			$text = substr($text,0,strrpos($text,' ')); 
			$text = $text."..."; 

			
			
			$startTitle = "$TitleTagg$NewsTitle[$i]$EndTitleTagg \n";
			$Description = "$DescriptionStart$text$DescriptionEnd";
			
			if($bool == 1)
			{
			$SimpelLine = "$startTitle\n$Description\n<a href='$target?news=$NewsID[$i]&start=$start'>Läs mer...</a>\n$breakline\n";
			}
			else
			{
			$SimpelLine = "$startTitle\n$Description\n<a href='$target?start=$start'>Läs mer...</a>\n$breakline\n";
			}
		
			$HTMLCollective = "$SimpelLine$HTMLCollective\n";				
			
			}
		}
	$PagingHTML = "<span class='$PagingCSS'>$numlink</span>";
	$listNewsHTML = "$HTMLCollective\n$PagingHTML\n";

return print $listNewsHTML;
}



function liveConCMS_DisplayNewsLatestFirst($StartTitleTagg, $EndTitleTagg, $StartDatumTagg, $EndDatumTagg, $DashTagg, $VisaAntal)
{
	$VisaAntal = (int) $VisaAntal;
	$newslanguage = $_SESSION['sess_sitelanguage'];
	
			$SimpelLine = "";
			$HTMLCollective = "";
			$sql = "SELECT * FROM `lc_tblnews` WHERE LanguageID = '$newslanguage' ORDER BY Date ASC LIMIT 0,$VisaAntal";
			$result = mysql_query($sql) or die('Query failed: ' . mysql_error());
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
			{
					for($i = 0; $i < 1; $i++) 
					{
					$NewsID[$i] = $row["ID"];	
					$NewsTitle[$i] = $row["Title"];
					$NewsText[$i] = nl2br($row["News"]);
					$NewsDate[$i] = $row["Date"];
					  
					$Newshours = date("Y-m-d",strtotime("$NewsDate[$i]"));
					
					$SimpelLine = "$StartTitleTagg$NewsTitle[$i]$EndTitleTagg\n$StartDatumTagg$Newshours$EndDatumTagg\n$NewsText[$i]\n$DashTagg\n";
					$HTMLCollective = "$SimpelLine$HTMLCollective";	
					}
			}
		
		$BloggStyleHTML = $HTMLCollective;

	return print $BloggStyleHTML;
}


function liveConCMS_DisplayNewsLatestFirstWithPaging($StartTitleTagg, $EndTitleTagg, $StartDatumTagg, $EndDatumTagg, $DashTagg, $PagingSize, $PagingCSS)
{
						$newslanguage = $_SESSION['sess_sitelanguage'];
						
						$Traffar = "SELECT COUNT(*) FROM `lc_tblnews` WHERE LanguageID = '$newslanguage'";
						$Restraffar = mysql_query($Traffar) or die('Query failed: ' . mysql_error());
						while ($rowtraffar = mysql_fetch_array($Restraffar, MYSQL_ASSOC))
						{
						$Antal = $rowtraffar["COUNT(*)"];
						}
						
						$newoffset = "";
					
						$limit = $PagingSize; 
					
						$result = @mysql_query("SELECT count(*) as count FROM `lc_tblnews` WHERE LanguageID = '$newslanguage'")
						  or die("Error fetching number in DB<br>".mysql_error());
						$row = @mysql_fetch_array($result);
						$numrows = $row['count']; 
						 
					
						if (!isset($_GET['start']) || $_GET['start'] == "")
						  $start = 0;
						else
						  $start = $_GET['start'];
						 
						
						$pages = intval($numrows/$limit);
						if ($numrows%$limit)
						  $pages++;
						 
						
						if ($start > 0) {
						  $numlink = '<a href="?start=0">&laquo;&laquo;</a> ';
						  $numlink .= '<a href="?start='.($start - $limit).'">&laquo;</a> ';
						} else {
						  $numlink = '<i>&laquo;&laquo;</i> ';
						  $numlink .= '<i>&laquo;</i> ';
						}
						 
					
						for ($i = 1; $i <= $pages; $i++) {
						  $newoffset = $limit*($i-1);
						  if ($start == $newoffset)
							$numlink .= '<i>['.$i.']</i> ';
						  else
							$numlink .= '<a href="?start='.$newoffset.'">'.$i.'</a> ';
						}
						 
						
						if ($numrows > ($start + $limit))
						  $numlink .= '<a href="?start='.($start + $limit).'">&raquo;</a> ';
						else
						  $numlink .= '<i>&raquo;</i> ';
						 
						
						if ($start != $newoffset)
						  $numlink .= '<a href="?start='.$newoffset.'">&raquo;&raquo;</a> ';
						else
						  $numlink .= '<i>&raquo;&raquo;</i>';
						  
						  
	
			$SimpelLine = "";
			$HTMLCollective = "";
			$sql = "SELECT * FROM `lc_tblnews` WHERE LanguageID = '$newslanguage' ORDER BY Date DESC LIMIT $start, $limit";
			$result = mysql_query($sql) or die('Query failed: ' . mysql_error());
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
			{
					for($i = 0; $i < 1; $i++) 
					{
					$NewsID[$i] = $row["ID"];	
					$NewsTitle[$i] = $row["Title"];
					$NewsText[$i] = nl2br($row["News"]);
					$NewsDate[$i] = $row["Date"];
					  
					$Newshours = date("Y-m-d",strtotime("$NewsDate[$i]"));
					
					$SimpelLine = "$StartTitleTagg$NewsTitle[$i]$EndTitleTagg\n$StartDatumTagg$Newshours$EndDatumTagg\n$NewsText[$i]\n$DashTagg\n";
					$HTMLCollective = "$SimpelLine$HTMLCollective";	
					}
			}
		
		$PagingHTML = "<span class='$PagingCSS'>$numlink</span>";
		$BloggStyleHTML = "$HTMLCollective\n$PagingHTML";
		
		

	return print $BloggStyleHTML;
}


/* Latest news posted in system */
function liveConCMS_DisplayLatestNews($StartTitleTagg, $EndTitleTagg, $StartDatumTagg, $EndDatumTagg)
{
			$SimpelLine = "";
			$HTMLCollective = "";
			$newslanguage = $_SESSION['sess_sitelanguage'];
			
			$sql = "SELECT * FROM `lc_tblnews` WHERE LanguageID = '$newslanguage' ORDER BY Date ASC LIMIT 1";
			$result = mysql_query($sql) or die('Query failed: ' . mysql_error());
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
			{
					for($i = 0; $i < 1; $i++) 
					{
					$NewsID[$i] = $row["ID"];	
					$NewsTitle[$i] = $row["Title"];
					$NewsText[$i] = nl2br($row["News"]);
					$NewsDate[$i] = $row["Date"];
					  
					$Newshours = date("Y-m-d",strtotime("$NewsDate[$i]"));
					
					$SimpelLine = "$StartTitleTagg$NewsTitle[$i]$EndTitleTagg\n$StartDatumTagg$Newshours$EndDatumTagg\n$NewsText[$i]\n";
					$HTMLCollective = "$SimpelLine$HTMLCollective";	
					}
			}
		
		$SingelNewsHTML = $HTMLCollective;

	return print $SingelNewsHTML;
}



function liveconCMS_DisplayNewsBetweenDates($startdate, $enddate, $StartTitleTagg, $EndTitleTagg, $StartDatumTagg, $EndDatumTagg, $DashTagg)
{

			$SimpelLine = "";
			$HTMLCollective = "";
			$newslanguage = $_SESSION['sess_sitelanguage'];
			
			$sql = "SELECT * FROM `lc_tblnews` WHERE LanguageID = '$newslanguage' AND Date BETWEEN '$startdate' AND '$enddate'";
			$result = mysql_query($sql) or die('Query failed: ' . mysql_error());
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
			{
					for($i = 0; $i < 1; $i++) 
					{
					$NewsID[$i] = $row["ID"];	
					$NewsTitle[$i] = $row["Title"];
					$NewsText[$i] = nl2br($row["News"]);
					$NewsDate[$i] = $row["Date"];
					  
					$Newshours = date("Y-m-d",strtotime("$NewsDate[$i]"));
					
					$SimpelLine = "$StartTitleTagg$NewsTitle[$i]$EndTitleTagg\n$StartDatumTagg$Newshours$EndDatumTagg\n$NewsText[$i]\n$DashTagg\n";
					$HTMLCollective = "$SimpelLine$HTMLCollective";	
					}
			}
		
		$BloggStyleHTML = $HTMLCollective;

	return print $BloggStyleHTML;

}


function liveConCMS_DisplayMainContent($edit)
{
    $sitelanguage = $_SESSION['sess_sitelanguage'];
	$edit = (int) $edit;
	$pageText = "";
	$editTextHTML = "";
	$editTextUndoHTML = "";
	$main = 0;
	$pageEditID = $_SESSION['sess_liveConCMSPageIndex'] [3];
	$pageEditSubID = $_SESSION['sess_liveConCMSPageIndex'] [4];
	$pageEditfilename =  $_SESSION['sess_liveConCMSPageIndex'] [5];
	
		if($edit == 1)
		{
		$languagePath = $_SESSION['sess_language'];
	    include("liveConCMS/core/language/$languagePath/language.php");
		}
			

	if($pageEditID != 0)
	{
		$sqlText = "SELECT pageText, ID FROM `lc_tblpages`, `lc_tblpagestext` WHERE lc_tblpages.MenyID = '$pageEditID' AND lc_tblpages.SubID = '$pageEditSubID' AND lc_tblpagestext.LanguageID = '$sitelanguage' AND lc_tblpages.ID = lc_tblpagestext.pageID";
		$resultText = mysql_query($sqlText) or die('Query failed: ' . mysql_error());
		while ($rowText = mysql_fetch_array($resultText, MYSQL_ASSOC))
		{
		$pageText = $rowText["pageText"];
		$pageTextID = $rowText["ID"];
		
			if($pageText != "")
			{
			$main = 1;
			}
		}
	}
	
	
	 /* */
	 
	 
	if($pageText == "")
	{
		$sqlText = "SELECT pageText, ID FROM `lc_tblpages`,`lc_tblpagestext` WHERE lc_tblpages.SubID = '$pageEditSubID' AND lc_tblpagestext.LanguageID = '$sitelanguage' AND lc_tblpages.ID = lc_tblpagestext.pageID";
		$resultText = mysql_query($sqlText) or die('Query failed: ' . mysql_error());
		while ($rowText = mysql_fetch_array($resultText, MYSQL_ASSOC))
		{
		$pageText = $rowText["pageText"];
		$pageTextID = $rowText["ID"];
		}
	}
			if($pageText == "" && $edit == 1)	
			{
			$pageText = "<p>$liveConCMS_Onpage_7</p>";
			}
			else
			{
			 $pageText = "";
			}
			
			
				if ($edit == 1)
				{
				$editTextHTML = "<span id='lc-button-editpage'><a>$liveConCMS_Onpage_8</a></span>";
				
					if (!isset($_SESSION['sess_showundo']))
					{
					}
					else
					{
					
						if($main == 1)
						{
							if ($_SESSION['sess_showundo'] == $pageEditID)
							{
							$editTextUndoHTML =  "<span id='lc-button-undoedit'><a href='$pageEditfilename?edit=$edit&pageid=$pageEditSubID&undo=1&type=1&pagetextid=$pageTextID'>$liveConCMS_Onpage_9</a></span>";
							}
							else
							{
							$editTextUndoHTML = "";
							}
						}
						else
						{
							if ($_SESSION['sess_showundo'] == $pageEditSubID)
							{
							$editTextUndoHTML =  "<span id='lc-button-undoedit'><a href='$pageEditfilename?edit=$edit&pageid=$pageEditSubID&undo=1&type=2&pagetextid=$pageTextID'>$liveConCMS_Onpage_9</a></span>";
							}
							else
							{
							$editTextUndoHTML = "";
							}
						}
						
					}
				}
			
				
	$HTMLText = "$editTextHTML$editTextUndoHTML<div id='lc-main-content'>$pageText</div>";
	return print $HTMLText;

}

function liveConCMS_setHeader($edit)
{
	$SystemFile = $_SESSION['sess_liveConCMSPageIndex'] [6];

		if (!isset($_SESSION['sess_id']))
		{
		  $_SESSION['sess_id'] = ""; 
		}



		if($edit == 1)
		{
		include("liveConCMS/liveconcms_editonpageheader.php");
		}
		elseif($_SESSION['sess_id'] != "")
		{
		  echo "
				<link rel='stylesheet' type='text/css' href='liveConCMS/skins/styles.php' />\n
				<script src=\"liveConCMS/js/jquery.js\" type=\"text/javascript\"></script>
				<script src=\"liveConCMS/js/jquery-ui.1.8.11-min.js\" type=\"text/javascript\"></script>
				<script src=\"liveConCMS/js/lc-core.php\" type=\"text/javascript\"></script>		 
		  ";

		}
		else
		{
		}
				
return true;
}

function liveConCMS_JavaScript_Cufon($edit)
{
$edit = (int) $edit;
$Cufon1 = "
<script src='./js/cufon-yui.js' type='text/javascript'></script>
<script type='text/javascript' src='js/cufon_YanoneKaffeesatz.js'></script>
";

		if($edit == 0)
		{
		$Cufon2 = "
		<script type='text/javascript'>
		Cufon.replace('h1, h2, h3, h4, h5, h6, .menu ul li a b');
		</script>
		";
		}
		else
		{
		$Cufon2 = "";
		}
		
		$CufonHTML = "$Cufon1$Cufon2";
		
	return print $CufonHTML;
}

function liveConCMS_JavaScript_Jquery()
{
$jQuery = "
<script type='text/javascript' src='./js/jquery.js'></script>
<script src='./js/jquery.tools.min.js'></script> 
<script type='text/javascript' src='./js/editinplace.js'></script>
<script type='text/javascript' src='./js/jquery.editinplace.js'></script>
";

return print $jQuery;
}

function liveConCMS_JavaScript_tinyMCE()
{

	$sql = "SELECT htmlEditor FROM `lc_tblconfig` WHERE ID ='1'";
	$result = mysql_query($sql) or die('Query failed: ' . mysql_error());
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$htmlEditor = $row["htmlEditor"];				
	}
	
	if ($htmlEditor == 0)
	{
	$JSMCE = 
	"<script type='text/javascript' src='./liveConCMS/js/tiny_mce/tiny_mce.js'></script>
	<script type='text/javascript' src='./liveConCMS/js/mce-edit-content.js'></script>";
	}
	else
	{
	$JSMCE = 
	"<script type='text/javascript' src='./liveConCMS/js/tiny_mce/tiny_mce.js'></script>
	<script type='text/javascript' src='./liveConCMS/js/mce-edit-content-advanced.js'></script>";
	}

return print $JSMCE;
}


function liveConCMS_Picture($ID, $IMGSource, $Alt, $PictureType, $edit)
{
$edit = (int) $edit;
if($edit == 1)
{
$PictureHTML = 
"
		<img class='$ID lc-editableImg' id='lc-editableImg-$ID' src='$IMGSource' alt='$Alt'  />
";		
}
else
{
$PictureHTML = "<img class='$ID' src='$IMGSource' alt='$Alt' />";	
}

return print $PictureHTML;
}


function liveConCMS_ContactForm($email, $redirect)
{
$ContactHTML = 
"<form name='ContactForm' method='post' action=''> 
<input type='text' name='hidden_epost' style='display:none;' value='$email' />	
<input type='text' name='hidden_redirect' style='display:none;' value='$redirect' />	
	
				<fieldset>
					<b>Namn:</b>
					<input type='text' name='txt_apiFormName' />
					<em>Ditt namn</em>
				</fieldset>
				
				<fieldset>
					<b>Telefonnummer</b>
					<input type='text' name='txt_apiFormPhone'/>
					<em>Ditt telefonnummer som vi kan nå dig på.</em>
				</fieldset>
				
				<fieldset>
					<b>E-mail</b>
					<input type='text'name='txt_apiFormEmail'/>
					<em>Din email adress</em>
				</fieldset>
				
				<fieldset>
					<b>Meddelande</b>
					<textarea name='txt_apiFormMessage'></textarea>
					<em>Ditt meddelande till oss</em>
				</fieldset>
				
				<fieldset>
					<input type='submit' name='submit_apiContact' value='Skicka' />
					<input type='reset' value='Återställ' />
				</fieldset>
				</form>";
return print $ContactHTML;
}


function liveConCMS_EditorMainContent($edit)
{
$edit = (int) $edit;
$sitelanguage = $_SESSION['sess_sitelanguage'];
$pageEditID = $_SESSION['sess_liveConCMSPageIndex'] [3];
$pageEditSubID = $_SESSION['sess_liveConCMSPageIndex'] [4];
$pageEditfilename = $_SESSION['sess_liveConCMSPageIndex'] [5];

	$pageText = "";
	
		if($pageEditID != 0)
		{
			$sqlText = "SELECT pageText FROM `lc_tblpages`, `lc_tblpagestext` WHERE lc_tblpages.MenyID = '$pageEditID' AND lc_tblpages.SubID = '$pageEditSubID' AND lc_tblpagestext.LanguageID = '$sitelanguage' AND lc_tblpages.ID = lc_tblpagestext.pageID";
			$resultText = mysql_query($sqlText) or die('Query failed: ' . mysql_error());
			while ($rowText = mysql_fetch_array($resultText, MYSQL_ASSOC))
			{
			$pageText = $rowText["pageText"];
			}
		}
	
			if($pageText == "")
			{
				$sqlText = "SELECT pageText FROM `lc_tblpages`, `lc_tblpagestext` WHERE lc_tblpages.SubID = '$pageEditSubID' AND lc_tblpagestext.LanguageID = '$sitelanguage' AND lc_tblpages.ID = lc_tblpagestext.pageID";
				$resultText = mysql_query($sqlText) or die('Query failed: ' . mysql_error());
				while ($rowText = mysql_fetch_array($resultText, MYSQL_ASSOC))
				{
				$pageText = $rowText["pageText"];
				}
			}
		if($pageText == "")	
		{
		$pageText = "<p>Kunnde inte hitta någon text i databasen.</p>";
		}
	
	if ($_SESSION['sess_id'] == "")
	{
	return print "";
	}
}

function liveConCMS_BottomContent($edit)
{
	$Path = $_SESSION['sess_liveConCMSPageIndex'] [0];
	$SystemFile = $_SESSION['sess_liveConCMSPageIndex'] [6];
	if($edit == 1)
	{
		$languagePath = $_SESSION['sess_language'];
	    include("liveConCMS/core/language/$languagePath/language.php");
	}
	include("liveConCMS/liveconcms_bottomcontent.php");
}

function CheckIP() 
{ 
   if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
      if (preg_match('/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}/', $_SERVER['HTTP_X_FORWARDED_FOR'], $addresses)) 
         return $addresses[0]; 
   } 
   return (isset($_SERVER['HTTP_CLIENT_IP'])) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR']; 
}

/* Database options */
function liveConCMS_mysql_query_simple_exequter($query)
{
	$sql = $query;

	if (!mysql_query($sql))
	{
	 $errorStringSQL = mysql_error();
	 echo "$errorStringSQL";
	 die;
	}
}

function liveConCMS_mysql_query_exequter_with_return($query)
{
	$sql = $query;
	if (!mysql_query($sql))
	{
	
	 $errorStringSQL = mysql_error();
     echo "$errorStringSQL";
	 die;
	}
	else
	{
	return mysql_query($sql);
	}
}


function liveConCMS_mysql_droptable_exequter($query)
{

$string = $query;
$chunks = explode(",", $string);

	foreach ($chunks as &$value) 
	{
		$systemTables = array("lc_tbladministrator", "lc_tblanhorig", "lc_tblconfig", "lc_tblfooter", "lc_tblheader", "lc_tblheadertext", "lc_tblhistory", "lc_tbllanguage", "lc_tbllicens", "lc_tblmeny", "lc_tblmenytext", "lc_tblmodules", "lc_tblnews", "lc_tblnoticebord", "lc_tblpages", "lc_tblpagestext", "lc_tblsubcat", "lc_tblsubcattext", "lc_tbltemplates", "lc_tbluploadedfiles", "lc_tblversion", "lc_tblvisitorlogg");
		
		if (in_array($value, $systemTables)) 
		{
		/* do nothing */
		}
		else
		{
		$sql = "DROP TABLE $value";
		mysql_query_simple_exequter($sql);
		}
	}
}

?>