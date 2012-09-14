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
include("core/liveconcms_systemheader.php");
$languagePath = $_SESSION['sess_language'];
include("core/language/$languagePath/language.php");
liveConCMS_SystemPageID('.','..','0','1','0','index.php','system');

if (isset($_GET['publish']))
{ 

/* Uppdaterar licensen 
$sql = "UPDATE lc_tbllicens SET licens = '', Activated = '0' Where ID = '1'";
mysql_query_simple_exequter($sql);*/

header("Refresh: 0;URL=liveconcms_logout.php?logout=");
exit; 
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LiveCon CMS - <?PHP echo "$liveConCMS_HtmlTitle_12";?></title>

<!-- Load javascripts for CMS backend -->
<?PHP include("liveconcms_editonpageheader.php");?>

<!-- Load the stylesheets used by the CMS -->
<link rel="stylesheet" type="text/css" href="skins/reset.css">
<link rel="stylesheet" type="text/css" href="skins/styles.php">

</head>

<body id="lc-about" class="lc-body container_12">
<?PHP
include("liveconcms_panel.php");
?>

<div class="bodywrapper">
			
				
		<div class="container_wrapper">
		
			<h1 class="page-title">Publicera <?PHP echo "$liveConCMS_PageTitle_11";?></h1>
			<p>För att publicera din kopia av liveCon CMS klicka på länken nedan.</p>
			<p>Efter att din kopia publicerats kommer du automatiskt att loggas ut. <br/><br/><b>Du kommer sedan att behöva registrera liveCon CMS. Registreringsuppgifter får du av din återförsäljare.</b></p>
			<br/>
			<a href="liveconcms_publish.php?publish=">Publicera liveCon CMS</a>
			
			
			<hr>

		
			
			
			


		</div>		


		
	<a class="goback" href="javascript:history.back()"><?PHP echo "$liveConCMS_links1";?></a>
	
	
	
	<hr />
	
	
	
	</div>
	
	
	
	<?PHP include("liveconcms_footer.php");?>

</body>

</html>
