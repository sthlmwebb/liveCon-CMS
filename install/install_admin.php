<?PHP
include("../liveConCMS/core/include/dbConn.php");
include("install_filefoldercheck.php");

/* Vi gör lite tester på rättigheterna */
$InitFileTest = doInitTest();
$fail = 0;

if($InitFileTest[0] == 1)
{
$fail = 1;
}
if($InitFileTest[1] == 1)
{
$fail = 1;
}
if($InitFileTest[2] == 1)
{
$fail = 1;
}
if($InitFileTest[3] == 1)
{
$fail = 1;
}
if($InitFileTest[4] == 1)
{
$fail = 1;
}
if($InitFileTest[5] == 1)
{
$fail = 1;
}
if($InitFileTest[6] == 1)
{
$fail = 1;
}


if (isset($_POST['submit']))
{
$txtUsername = $_POST['txtUsername'];
$txtPassword = $_POST['txtPassword'];

$txtFirstname = $_POST['txtFirstname'];
$txtLastname = $_POST['txtLastname'];

 if (empty($_POST['txtUsername']) || empty($_POST['txtPassword'])) 
  {
 	header("Refresh: 0;URL=install_admin.php?error=true");
	exit;
  }
  
  $txtPassword  =  md5($_POST['txtPassword'] & $SaltedKey);
  

 /* Vi droppar alla tabeller: */
$sql = "DROP TABLE IF EXISTS `lc_tbladministrator`;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "DROP TABLE IF EXISTS `lc_tblanhorig`;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "DROP TABLE IF EXISTS `lc_tblconfig`;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "DROP TABLE IF EXISTS `lc_tblfooter`;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "DROP TABLE IF EXISTS `lc_tblheader`;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "DROP TABLE IF EXISTS `lc_tblheadertext`;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "DROP TABLE IF EXISTS `lc_tblhistory`;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "DROP TABLE IF EXISTS `lc_tbllanguage`;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "DROP TABLE IF EXISTS `lc_tbllicens`;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "DROP TABLE IF EXISTS `lc_tblmeny`;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "DROP TABLE IF EXISTS `lc_tblmenytext`;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "DROP TABLE IF EXISTS `lc_tblmodules`;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "DROP TABLE IF EXISTS `lc_tblnews`;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "DROP TABLE IF EXISTS `lc_tblnoticebord`;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "DROP TABLE IF EXISTS `lc_tblpages`;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "DROP TABLE IF EXISTS `lc_tblpagestext`;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "DROP TABLE IF EXISTS `lc_tblsubcat`;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "DROP TABLE IF EXISTS `lc_tblsubcattext`;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "DROP TABLE IF EXISTS `lc_tbltemplates`;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "DROP TABLE IF EXISTS `lc_tbluploadedfiles`;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "DROP TABLE IF EXISTS `lc_tblversion`;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "DROP TABLE IF EXISTS `lc_tblvisitorlogg`;";
mysql_query($sql) or die('Query failed: ' . mysql_error());
// *************************************************************



// *************************************************************
// Skapar alla tabeller:

$sql = "CREATE TABLE IF NOT EXISTS `lc_tbladministrator` (
  `ID` int(2) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) NOT NULL,
  `UserPassword` varchar(50) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Adress` varchar(300) NOT NULL,
  `PostNr` varchar(10) NOT NULL,
  `Stad` varchar(200) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Tele` varchar(15) NOT NULL,
  `Mobile` varchar(50) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Role` int(1) NOT NULL,
  `LastLoggedin` datetime NOT NULL,
  `IP` varchar(30) NOT NULL,
  `AcceptRules` int(1) NOT NULL,
  `languagepath` varchar(250) NOT NULL,
  `AdminEditable` int(1) NOT NULL,
  `AdminPages` int(1) NOT NULL,
  `AdminNews` int(1) NOT NULL,
  `AdminTemplates` int(1) NOT NULL,
  `AdminLanguages` int(1) NOT NULL,
  `AdminExplorer` int(1) NOT NULL,
  `AdminModules` int(1) NOT NULL,
  `AdminUser` int(1) NOT NULL,
  `AdminStatistic` int(1) NOT NULL,
  `AdminSystem` int(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=0 ;";
mysql_query($sql) or die('Query failed: ' . mysql_error());



$sql = "CREATE TABLE IF NOT EXISTS `lc_tblanhorig` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `UserID` int(10) NOT NULL,
  `anhorigFirstname` varchar(100) NOT NULL,
  `anhorigLastname` varchar(100) NOT NULL,
  `anhorigEmail` varchar(100) NOT NULL,
  `anhorigTele` varchar(15) NOT NULL,
  `anhorigMobil` varchar(15) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS `lc_tblconfig` (
  `ID` int(1) NOT NULL,
  `Template` varchar(200) NOT NULL,
  `SiteTitle` varchar(150) NOT NULL,
  `metaKeywords` varchar(500) NOT NULL,
  `metaDescription` varchar(500) NOT NULL,
  `metaGenerator` varchar(500) NOT NULL,
  `metaTitle` varchar(500) NOT NULL,
  `htmlEditor` int(1) NOT NULL,
  `languagepath` varchar(20) NOT NULL,
  `googleanalytics` text NOT NULL,
  `manualupload` int(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS `lc_tblfooter` (
  `ID` int(1) NOT NULL,
  `Text` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS `lc_tblheader` (
  `ID` int(2) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS `lc_tblheadertext` (
  `headertextID` int(10) NOT NULL AUTO_INCREMENT,
  `headerID` int(10) NOT NULL,
  `LanguageID` int(10) NOT NULL,
  `headerTitle` varchar(250) NOT NULL,
  `headerText` varchar(250) NOT NULL,
  `headerLogo` varchar(250) NOT NULL,
  PRIMARY KEY (`headertextID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS `lc_tblhistory` (
  `HistoryID` int(10) NOT NULL AUTO_INCREMENT,
  `UserID` int(10) NOT NULL,
  `HistoryLogg` text NOT NULL,
  `HistoryDate` datetime NOT NULL,
  PRIMARY KEY (`HistoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS `lc_tbllanguage` (
  `LanguageID` int(10) NOT NULL AUTO_INCREMENT,
  `LanguageDesc` text NOT NULL,
  `LanguagePrefix` varchar(250) NOT NULL,
  PRIMARY KEY (`LanguageID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS `lc_tbllicens` (
  `ID` int(1) NOT NULL,
  `licens` varchar(100) NOT NULL,
  `Activated` int(1) NOT NULL,
  `blacked` int(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS `lc_tblmeny` (
  `ID` int(2) NOT NULL AUTO_INCREMENT,
  `MenyLink` varchar(100) NOT NULL,
  `Active` int(1) NOT NULL,
  `sort` int(2) NOT NULL,
  `Datum` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS `lc_tblmenytext` (
  `menytextID` int(10) NOT NULL AUTO_INCREMENT,
  `LanguageID` int(10) NOT NULL,
  `MenyID` int(10) NOT NULL,
  `MenyText` text NOT NULL,
  PRIMARY KEY (`menytextID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS `lc_tblmodules` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `pluginTitle` varchar(200) NOT NULL,
  `pluginPath` varchar(200) NOT NULL,
  `pluginFolder` varchar(250) NOT NULL,
  `pluginAbout` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=0 ;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS `lc_tblnews` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `LanguageID` int(10) NOT NULL,
  `Title` varchar(200) NOT NULL,
  `News` text NOT NULL,
  `Picture` varchar(200) NOT NULL,
  `Date` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS `lc_tblnoticebord` (
  `noteID` int(10) NOT NULL AUTO_INCREMENT,
  `UserID` int(10) NOT NULL,
  `notePosted` datetime NOT NULL,
  `noteTitle` varchar(300) NOT NULL,
  `noteText` text NOT NULL,
  PRIMARY KEY (`noteID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS `lc_tblpages` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `MenyID` int(10) NOT NULL,
  `SubID` int(10) NOT NULL,
  `Datum` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS `lc_tblpagestext` (
  `pagetextID` int(10) NOT NULL AUTO_INCREMENT,
  `pageID` int(10) NOT NULL,
  `LanguageID` int(10) NOT NULL,
  `pageTitle` varchar(250) NOT NULL,
  `pageText` text NOT NULL,
  `pageTextBackup` text NOT NULL,
  PRIMARY KEY (`pagetextID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS `lc_tblsubcat` (
  `SubID` int(2) NOT NULL AUTO_INCREMENT,
  `MenyID` int(2) NOT NULL,
  `SubLink` varchar(100) NOT NULL,
  `Active` int(1) NOT NULL,
  `MenyIndex` int(1) NOT NULL,
  `sort` int(2) NOT NULL,
  `Datum` datetime NOT NULL,
  PRIMARY KEY (`SubID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS `lc_tblsubcattext` (
  `submenytextID` int(10) NOT NULL AUTO_INCREMENT,
  `LanguageID` int(10) NOT NULL,
  `SubID` int(10) NOT NULL,
  `SubText` varchar(250) NOT NULL,
  PRIMARY KEY (`submenytextID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS `lc_tbltemplates` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `templateFilename` varchar(50) NOT NULL,
  `templateTitel` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS `lc_tbluploadedfiles` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `Posted` datetime NOT NULL,
  `Title` varchar(150) NOT NULL,
  `File` varchar(150) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS `lc_tblversion` (
  `ID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Version` varchar(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "CREATE TABLE IF NOT EXISTS `lc_tblvisitorlogg` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `Browser` varchar(255) NOT NULL,
  `IP` varchar(20) NOT NULL,
  `Recieved` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";
mysql_query($sql) or die('Query failed: ' . mysql_error());


/* Fyller på med lite nödvändig data*/
$Dagensdatum = date('Y-m-d H:i:s');
$sql = "INSERT INTO `lc_tbladministrator` (`ID`, `UserName`, `UserPassword`, `Firstname`, `Lastname`, `Adress`, `PostNr`, `Stad`, `Email`, `Tele`, `Mobile`, `Title`, `Role`, `LastLoggedin`, `IP`, `AcceptRules`, `languagepath`, `AdminEditable`, `AdminPages`, `AdminNews`, `AdminTemplates`, `AdminLanguages`, `AdminExplorer`, `AdminModules`, `AdminUser`, `AdminStatistic`, `AdminSystem`) VALUES
(1, '$txtUsername', '$txtPassword', '$txtFirstname', '$txtLastname', '', '', '', '', '', '', 'Systemägare', 1, '$Dagensdatum', '', 0, 'English', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "INSERT INTO `lc_tblanhorig` (`ID`, `UserID`, `anhorigFirstname`, `anhorigLastname`, `anhorigEmail`, `anhorigTele`, `anhorigMobil`) VALUES
(1, 1, '', '', '', '', '');";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "INSERT INTO `lc_tblconfig` (`ID`, `Template`, `SiteTitle`, `metaKeywords`, `metaDescription`, `metaGenerator`, `metaTitle`, `htmlEditor`, `languagepath`, `googleanalytics`, `manualupload`) VALUES
(1, 'admin', 'liveCon CMS 2.0', 'liveCon CMS, STHLM Webbproduktion, CMS, Enkel administration', 'liveCon, CMS, onpage, live edit, enkel administration', 'liveCon CMS', 'Template Demo', 1, 'English', '', $fail);";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "INSERT INTO `lc_tbllanguage` (`LanguageID`, `LanguageDesc`, `LanguagePrefix`) VALUES
(1, 'Svenska', 'Default')";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "INSERT INTO `lc_tblversion` (`ID`, `Title`, `Version`) VALUES
(1, 'liveCon CMS', 'v1.6');";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "INSERT INTO `lc_tblheader` (`ID`) VALUES (1);";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "INSERT INTO `lc_tblheadertext` (`headertextID`, `headerID`, `LanguageID`, `headerTitle`, `headerText`, `headerLogo`) VALUES
(1, 1, 1, 'Header title here', ' Header text here', '');";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "INSERT INTO `lc_tblmeny` (`ID`, `MenyLink`, `Active`, `sort`, `Datum`) VALUES
(1, 'index.php', 1, 1, '$Dagensdatum');";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "INSERT INTO `lc_tblmenytext` (`menytextID`, `LanguageID`, `MenyID`, `MenyText`) VALUES
(1, 1, 1, 'index');";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "INSERT INTO `lc_tblpages` (`ID`, `MenyID`, `SubID`, `Datum`) VALUES
(1, 1, 0, '$Dagensdatum');";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "INSERT INTO `lc_tblpagestext` (`pagetextID`, `pageID`, `LanguageID`, `pageTitle`, `pageText`, `pageTextBackup`) VALUES
(1, 1, 1, 'New Page', '<p>Pagecontent here</p>', '<p>Pagecontent here</p>');";
mysql_query($sql) or die('Query failed: ' . mysql_error());

$sql = "INSERT INTO `lc_tbllicens` (`ID`, `licens`, `Activated`, `blacked`) VALUES
(1, 'GNU', 1, 0);";
mysql_query($sql) or die('Query failed: ' . mysql_error());

header("Refresh: 0;URL=install_done.php");
exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>liveCon CMS - Installation</title>
<link href="../liveConCMS/skins/reset.css" rel="stylesheet" type="text/css" />
<link href="../liveConCMS/skins/styles.php" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../liveConCMS/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../liveConCMS/js/jquery-ui.1.8.11-min.js"></script>
<script type="text/javascript">
$(document).ready(function(){	
	//Execute UI button layout
	$("input:submit, input:reset").button();
});
</script>
</head>

<body id="lc-install" class="lc-body">

<div class="bodywrapper container_12">

<h1 class="page-title">Create superadmin</h1>

<hr />

	<?PHP
	
	if($fail == 1)
	{
	echo "<div class='ui-widget'>
				<div class='ui-state-error ui-corner-all'> 
					<span class='ui-icon ui-icon-alert'></span> 
							<span class='ui-state-error-text'>Error detected in server rights! Make sure you have permission to create folders, files, copy and delete! <br/>
								Ensure that Web server is not running in safe mode! <br/><br/><i>liveCon CMS will be set so that you have to manually upload files to the server. More info can be found under Settings.</i></span>
					</div>
			</div>";	
	}
	
	if (isset($_GET['error']))
	{
		echo "
			<div class='ui-widget'>
				<div class='ui-state-error ui-corner-all'> 
					<span class='ui-icon ui-icon-alert'></span> 
						<span class='ui-state-error-text'>You must enter a username and password.</span>
				</div>
			</div>";	
	}
	
?>	


	<form method="post">
		<table class="ui-widget ui-widget-content ui-corner-all tbl-style-1" id="tbl-profil-info">
			<thead>
				<tr>
					<td class="ui-widget-header ui-corner-tl first-cell">Administration information</td>
					<td class="ui-widget-header ui-corner-tr last-cell">&nbsp;</td>
				</tr>
			</thead>
			
			<tbody>
			<tr>
					<td class="first-cell"><b>Firstname</b></td>
					<td class="last-cell"><input name="txtFirstname" type="text"></td>
				</tr>
				<tr>
					<td class="first-cell"><b>Lastname</b></td>
					<td class="last-cell"><input name="txtLastname" type="text"></td>
				</tr>
				<tr>
					<td class="first-cell"><b>Username</b></td>
					<td class="last-cell"><input name="txtUsername" type="text"></td>
				</tr>
				<tr>
					<td class="first-cell"><b>Password</b></td>
					<td class="last-cell"><input name="txtPassword" type="text"></td>
				</tr>
		</tbody>
		</table>

		<input name="submit" type="submit" value="Install">
		</form>

		<hr />
		
</div>
</body>

</html>
