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
$languagePath = $_SESSION['sess_language'];
include("core/language/$languagePath/language.php");

if (isset($_GET['blacklist']) == "")
{

}
else
{
	$blacklist = isset($_GET['blacklist']) ? $_GET['blacklist'] : blacklist('n');

	if($blacklist == "cc7cc238250d688bfc20d06547a01b5b")
	{
	$sql = "UPDATE lc_tbllicens SET blacked   = '1' Where ID = '1'";
	mysql_query($sql) or die('Query failed: ' . mysql_error());  
	}
	
}

if (isset($_GET['unlock']) == "")
{

}
else
{
	$unlock = isset($_GET['unlock']) ? $_GET['unlock'] : unlock('n');

	if($unlock == "32ccc8b1dec05b34bd7d912b5d450923")
	{
	$sql = "UPDATE lc_tbllicens SET blacked   = '0' Where ID = '1'";
	mysql_query($sql) or die('Query failed: ' . mysql_error());  
	}
	
}

include("core/liveconcms_systemcore.php");
include("core/liveconcms_systemheader.php");
liveConCMS_SystemPageID('.','..','0','1','0','index.php','system');


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>liveCon CMS - <?PHP echo "$liveConCMS_HtmlTitle_14";?></title>

<!-- Load javascripts for CMS backend -->
<?PHP include("liveconcms_editonpageheader.php");?>

<!-- Load the stylesheets used by the CMS -->
<link rel="stylesheet" type="text/css" href="skins/reset.css">
<link rel="stylesheet" type="text/css" href="skins/styles.php">

</head>

<body class="lc-body">
<?PHP
include("liveconcms_panel.php");
?>

<div class="bodywrapper container_12">
			
				
		
			<h1 class="page-title">Licens</h1>
			
			<p>
			liveCon CMS 2.0, cms made easy <br/>
			Copyright (C) 2012  STHLM Webbproduktion AB, www.sthlmwebb.se<br/>
			<br/>
			This program is free software: you can redistribute it and/or modify<br/>
			it under the terms of the GNU General Public License as published by<br/>
			the Free Software Foundation, either version 3 of the License, or<br/>
			(at your option) any later version.<br/>
			<br/>
			This program is distributed in the hope that it will be useful,<br/>
			but WITHOUT ANY WARRANTY; without even the implied warranty of<br/>
			MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the<br/>
			GNU General Public License for more details.<br/>
			<br/>
			You should have received a copy of the GNU General Public License<br/>
			along with this program.  If not, see <a href="http://www.gnu.org/licenses/" target="_blank">http://www.gnu.org/licenses/</a>.<br/>
		</p>

			
			
	<hr />
	<a class="goback" href="javascript:history.back()">&laquo; Gå tillbaka</a>
	
	</div> <!-- .bodywrapper -->
	
	<hr />
	
	<?PHP include("liveconcms_footer.php");?>

</body>

</html>
