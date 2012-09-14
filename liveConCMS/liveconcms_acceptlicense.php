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

$Role = $_SESSION['sess_role'];
$ID =  $_SESSION['sess_id'];
 
if (isset($_POST['submit']))
{
			$sql = "UPDATE lc_tbladministrator SET AcceptRules = '1' Where ID = '$ID'";
			mysql_query_simple_exequter($sql);
			
		if($Role == '1')
		{
		header("Refresh: 0;URL=liveconcms_startpage.php");
		exit; 
		}
		elseif($Role == '2')
		{
		header("Refresh: 0;URL=liveconcms_startpage.php");
		exit; 
		}
		elseif($Role == '3')
		{
		header("Refresh: 0;URL=liveconcms_startpage.php");
		exit; 
		}
		else
		{
		header("Refresh: 0;URL=liveconintra_singel.php");
		exit;
		}
}

if (isset($_POST['submit_no']))
{
header("Refresh: 0;URL=liveconcms_logout.php?logout=");
exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="sv" http-equiv="Content-Language" />
<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" />
<title>liveCon CMS - Installation</title>
<link rel="stylesheet" type="text/css" href="skins/reset.css">
<link rel="stylesheet" type="text/css" href="skins/styles.php">
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery-ui.1.8.11-min.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){	
	//Execute UI button layout
	$("input:submit, input:reset").button();
});
</script>

</head>

<body id="lc-install" class="lc-body container_12">

	<div class="bodywrapper">


		<h1 class="page-title">License</h1>
		
		<hr />
		

<textarea class="ui-corner-all readonly="readonly" style="width:948px;">

    liveCon CMS 2.0, cms made easy
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

</textarea>

			<hr />

			<form method="post">
				<input name="submit" type="submit" value="I agree" /> 
				<input name="submit_no" type="submit" value="No thanks" /> 
			</form>

	</div>

</body>

</html>
