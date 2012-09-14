<?PHP
if (isset($_POST['submit']))
{
header("Refresh: 0;URL=install_db.php");
exit; 
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="sv" http-equiv="Content-Language" />
<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" />
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


		<h1 class="page-title">Install liveCon CMS</h1>
		<p>Welcome to liveCon CMS installation guide!</p>
		
		<hr />
		
		<h3>License</h3>
		<textarea class="ui-corner-all readonly="readonly" style="width:948px;">
			liveCon CMS 2.0, cms made easy
			Copyright (C) 2012 STHLM Webbproduktion AB, www.sthlmwebb.se

			 This program is free software: you can redistribute it and/or modify
			 it under the terms of the GNU General Public License as published by
			 the Free Software Foundation, either version 3 of the License, or
			 (at your option) any later version.

			 This program is distributed in the hope that it will be useful,
			 but WITHOUT ANY WARRANTY; without even the implied warranty of
			 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
			 GNU General Public License for more details.

			 You should have received a copy of the GNU General Public License
			 along with this program. If not, see http://www.gnu.org/licenses/.

		</textarea>

			<hr />

			<form method="post">
				<input name="submit" type="submit" value="I agree" /> 
			</form>

	</div>

</body>

</html>
