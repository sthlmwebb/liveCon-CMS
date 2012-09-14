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

if (isset($_GET['error_id']) == "")
{
	$error = (int) 0;
}
else
{
	$error = (int) isset($_GET['error_id']) ? $_GET['error_id'] : error_id('n');
}

if($error == 0)
{
$errorMainTitle = "$liveConCMS_error_message_15";
$errorTitle = "$liveConCMS_error_message_16";
$errorBeskrivning = "$liveConCMS_error_message_17";
}
elseif($error == 1)
{
$errorMainTitle = "$liveConCMS_error_message_18";
$errorTitle = "$liveConCMS_error_message_19";
$errorBeskrivning = "$liveConCMS_error_message_20";
}
elseif($error == 2)
{
$errorMainTitle = "$liveConCMS_error_message_21";
$errorTitle = "$liveConCMS_error_message_22";
$errorBeskrivning = "$liveConCMS_error_message_23";
}
elseif($error == 3)
{
$errorMainTitle = "$liveConCMS_error_message_25";
$errorTitle = "$liveConCMS_error_message_26";
$errorBeskrivning = "";
}
elseif($error == 4)
{
$errorMainTitle = "$liveConCMS_error_message_25";
$errorTitle = "$liveConCMS_error_message_27";
$errorBeskrivning = "";
}
elseif($error == 5)
{
$errorMainTitle = "$liveConCMS_error_message_25";
$errorTitle = "$liveConCMS_error_message_28";
$errorBeskrivning = "";
}
elseif($error == 6)
{
$errorMainTitle = "$liveConCMS_error_message_25";
$errorTitle = "$liveConCMS_error_message_29";
$errorBeskrivning = "";
}
elseif($error == 7)
{
$errorMainTitle = "$liveConCMS_error_message_25";
$errorTitle = "$liveConCMS_error_message_30";
$errorBeskrivning = "";
}

elseif($error == 8)
{
$errorMainTitle = "$liveConCMS_error_Topic_1 ";
$errorTitle = "$liveConCMS_error_message_31";
$errorBeskrivning = "";
}

else
{
$errorMainTitle = "N/A";
$errorTitle = "N/A";
$errorBeskrivning = "N/A";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>liveCon CMS - <?PHP echo "$liveConCMS_HtmlTitle_13";?></title>

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
			
		<h1 class="page-title"><?PHP echo "$errorMainTitle"; ?></h1>
					
		<p><?PHP echo "$errorTitle"; ?></p>
		<p><?PHP echo "$errorBeskrivning"; ?></p>

		<a class="goback" href="javascript:history.back()"><?PHP echo "$liveConCMS_links1";?></a>
		
		<hr>
		
	</div>
	
	<?PHP include("liveconcms_footer.php");?>

</body>

</html>
