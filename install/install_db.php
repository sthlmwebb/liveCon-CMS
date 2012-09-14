<?PHP
if (isset($_POST['submit']))
{

 foreach($_POST as $key => $val)
  {
    $_POST[$key] = trim($val);
  }
  
  $txtServer = $_POST['txtServer'];
  $txtDB = $_POST['txtDB'];
  $txtUser = $_POST['txtUser'];
  $txtPassword = $_POST['txtPassword'];
  
  
  if (empty($_POST['txtServer']) || empty($_POST['txtDB']) || empty($_POST['txtUser'])) 
  {
 	header("Refresh: 0;URL=install_db.php?badconnection=true");
	exit;
  }
  
	
	$conn = mysql_connect($txtServer, $txtUser, $txtPassword);
	
	if(!$conn)
	{
		header("Refresh: 0;URL=install_db.php?badconnection=true");
		exit; 
	}
	else
	{
	
		if($conn)
		{
			$dbcheck = mysql_select_db("$txtDB"); 
			
			if(!$dbcheck)
			{
				$sql = "CREATE DATABASE $txtDB";
  				mysql_query($sql) or die (mysql_error());			
  			}
		
		}
	}
								
					if (file_exists("../liveConCMS/core/include/dbConnectionString.php")) 
					{ 
						if(!unlink("../liveConCMS/core/include/dbConnectionString.php"))
						{
							header("Refresh: 0;URL=install_db.php?rmverror=true");
							exit; 
						}
					} 	
					
					$Variabell = "$"."mysql_server";
					$Variabel2 = "$"."mysql_user";
					$Variabel3 = "$"."mysql_password";
					$Variabel4 = "$"."mysql_database";

					$VariabelStart = '"';
					$VariabelSlut = '";';

$content = "<?PHP
$Variabell = $VariabelStart$txtServer$VariabelSlut
$Variabel2 = $VariabelStart$txtUser$VariabelSlut
$Variabel3 = $VariabelStart$txtPassword$VariabelSlut
$Variabel4 = $VariabelStart$txtDB$VariabelSlut	 				
?>";					
	
					$filename = "../liveConCMS/core/include/dbConnectionString.php"; 
					$strlength = strlen($content); 
					$create = fopen($filename, "w"); 
					$write = fwrite($create, $content, $strlength); 
					$close = fclose($create); 
					
if(!$create)
{
header("Refresh: 0;URL=install_db.php?badconnectionfile=true");
exit; 
}
else
{
header("Refresh: 0;URL=install_admin.php");
exit; 
}									


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

<h1 class="page-title">Databas</h1>

<p>The system must have permissions to write to the folder <i>liveConCMS/core/include.</i> Fill in database connectionstring</p>

<hr />

		<?PHP
		if (isset($_GET['badconnection']))
		{
			echo "
				<div class='ui-widget'>
					<div class='ui-state-error ui-corner-all'> 
						<span class='ui-icon ui-icon-alert'></span> 
							<span class='ui-state-error-text'>Can not connect to database! Check settings.</span>	
					</div>
				</div>";	
		}
		
		if (isset($_GET['rmverror']))
		{
			echo "
				<div class='ui-widget'>
					<div class='ui-state-error ui-corner-all'> 
						<span class='ui-icon ui-icon-alert'></span> 
							<span class='ui-state-error-text'>
							Can't delete dbconnections.php! Check server rights.									
							</span>	
					</div>
				</div>";	
		}
		if (isset($_GET['badconnectionfile']))
		{
			echo "
				<div class='ui-widget'>
					<div class='ui-state-error ui-corner-all'> 
						<span class='ui-icon ui-icon-alert'></span> 
							<span class='ui-state-error-text'>
							Unable to write to <i>liveConCMS/core/include/dbConnectionString.php</i> Make sure the file has write permissions!									
							</span>	
					</div>
				</div>";	
		}
		?>	

			<form method="post">
				<table class="ui-widget ui-widget-content ui-corner-all tbl-style-1" id="tbl-profil-info">
					<thead>
						<tr>
							<td class="ui-widget-header ui-corner-tl first-cell">Database details:</td>
							<td class="ui-widget-header ui-corner-tr last-cell">&nbsp;</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="first-cell"><b>Server</b></td>
							<td class="last-cell"><input name="txtServer" type="text" /></td>
						</tr>
						<tr>
							<td class="first-cell"><b>Database name</b></td>
							<td class="last-cell"><input name="txtDB" type="text" /></td>
						</tr>
						<tr>
							<td class="first-cell"><b>Username</b></td>
							<td class="last-cell"><input name="txtUser" type="text" /></td>
						</tr>
						<tr>
							<td class="first-cell"><b>Password</b></td>
							<td class="last-cell"><input name="txtPassword" type="text" /></td>
						</tr>					
					</tbody>
				</table>
					
				<input name="submit" type="submit" value="Next" />
				<input name="Reset" type="reset" value="Reset" />
			</form>	

<hr />
	
</div>
</body>

</html>
