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
checkRole($_SESSION['sess_role'], 'liveconintra_singeluser');


$ID = $_SESSION['sess_id'];
			

					$sql = "SELECT * FROM `lc_tbladministrator`, `lc_tblanhorig` WHERE lc_tbladministrator.ID ='$ID' AND lc_tbladministrator.ID = lc_tblanhorig.UserID";
					$result = mysql_query_exequter_with_return($sql);
					while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
					{
					
							$Password = $row["UserPassword"];
					
							$Firstname = $row["Firstname"];
							$Lastname = $row["Lastname"];
							
							$Adress = $row["Adress"];
							$PostNr = $row["PostNr"];
							$Stad = $row["Stad"];
							$Email = $row["Email"];
							$Tele = $row["Tele"];
							$Mobile = $row["Mobile"];
							
							$Title = $row["Title"];
							
							
							$anhorigFirstname = $row["anhorigFirstname"];
							$anhorigLastname = $row["anhorigLastname"];
							
						
							$anhorigEmail = $row["anhorigEmail"];
							$anhorigTele = $row["anhorigTele"];
							$anhorigMobile = $row["anhorigMobil"];
							
							
					}
					
					
if (isset($_POST['submit']))
{
$_POST = db_escape($_POST);

  foreach($_POST as $key => $val)
  {
    $_POST[$key] = trim($val);
  }
  
  $noteFirstname = mysql_real_escape_string($_POST['noteFirstname']);
  $noteLastname = mysql_real_escape_string($_POST['noteLastname']);
  $noteAdress = mysql_real_escape_string($_POST['noteAdress']);
  $notePostnr = mysql_real_escape_string($_POST['notePostnr']);
  $noteCity = mysql_real_escape_string($_POST['noteCity']);
  $noteTele = mysql_real_escape_string($_POST['noteTele']);
  $noteMobil = mysql_real_escape_string($_POST['noteMobil']);
  $noteEmail = mysql_real_escape_string($_POST['noteEmail']);
  $noteAnhorigFirstname = mysql_real_escape_string($_POST['noteAnhorigFirstname']);
  $noteAnhorigLastname = mysql_real_escape_string($_POST['noteAnhorigLastname']);
  $noteAnhorigTele = mysql_real_escape_string($_POST['noteAnhorigTele']);
  $noteAnhorigMobil = mysql_real_escape_string($_POST['noteAnhorigMobil']);
  $noteAnhorigEmail = mysql_real_escape_string($_POST['noteAnhorigEmail']);
  
   $notePassword = mysql_real_escape_string($_POST['notePassword']);
   $noteNewPassword = mysql_real_escape_string($_POST['noteNewPassword']);
   $noteConfirmPassword = mysql_real_escape_string($_POST['noteConfirmPassword']);
  
  
   if (empty($_POST['noteFirstname']) || empty($_POST['noteLastname'])) 
  {
    $reg_error[] = 0;   
  }
  
  
	IF ($_POST['noteEmail'] != "")
	{

	  if (!preg_match('/^[-A-Za-z0-9_.]+[@][A-Za-z0-9_-]+([.][A-Za-z0-9_-]+)*[.][A-Za-z]{2,6}$/', $_POST['noteEmail'])) 
	  {
	    $reg_error[] = 1;  
	
	  }
 	}
 	
 	IF ($_POST['noteAnhorigEmail'] != "")
	{

	  if (!preg_match('/^[-A-Za-z0-9_.]+[@][A-Za-z0-9_-]+([.][A-Za-z0-9_-]+)*[.][A-Za-z]{2,6}$/', $_POST['noteAnhorigEmail'])) 
	  {
	    $reg_error[] = 2;  
	
	  }
 	}
 	
 	IF ($_POST['notePassword'] != "")
	{
  		$notePassword =  md5($_POST['notePassword'] & $SaltedKey);
  			
  		if ($Password != $notePassword)
  		{
  		$reg_error[] = 3; 
  		}
	 
 	}
 	
 	IF ($_POST['noteNewPassword'] != $_POST['noteConfirmPassword'])
	{
  		
  		$reg_error[] = 4; 	
	 
 	}

 	
 	
 	
 	
 	

  if (!isset($reg_error)) 
  {


 	$sql = "UPDATE lc_tbladministrator SET Firstname = '$noteFirstname', Lastname = '$noteLastname', Adress = '$noteAdress', PostNr = '$notePostnr', Stad = '$noteCity', Email = '$noteEmail', Tele = '$noteTele', Mobile = '$noteMobil' Where ID = '$ID'";
 	mysql_query_simple_exequter($sql);
 	
 	$sql = "UPDATE lc_tblanhorig SET anhorigFirstname = '$noteAnhorigFirstname', anhorigLastname = '$noteAnhorigLastname', anhorigEmail = '$noteAnhorigEmail', anhorigTele = '$noteAnhorigTele', anhorigMobil = '$noteAnhorigMobil' Where UserID = '$ID'";
    mysql_query_simple_exequter($sql);
 	
 	if ($_POST['notePassword'] != "")
 	{

 	$newPassword =  md5($_POST['noteNewPassword'] & $SaltedKey);
 	
	$sql = "UPDATE lc_tbladministrator SET UserPassword = '$newPassword' Where ID = '$ID'";
 	mysql_query_simple_exequter($sql); 
 
 	}

 	header("Refresh: 0;URL=liveconintra_singeluser.php");
 	exit; 
  } 

}

$error_list[0] = "$liveConCMS_error_message_6";
$error_list[1] = "$liveConCMS_error_message_7";
$error_list[2] = "$liveConCMS_error_message_8";
$error_list[3] = "$liveConCMS_error_message_9";
$error_list[4] = "$liveConCMS_error_message_10";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>liveCon CMS - Intranät</title>

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
			
		
			<h1 class="page-title"><?PHP echo "$liveConCMS_PageTitle_8"; ?></h1>

			<p><?PHP echo "$liveConCMS_pageText7_1";?></p>
			
			<hr />
			
			<form method="post">
			<table class="ui-widget ui-widget-content ui-corner-all tbl-style-1">
				<thead>
					<tr>
						<td class="ui-widget-header ui-corner-tl first-cell"><?PHP echo "$liveConCMS_WindowTitle_6"; ?></td>
						<td class="ui-widget-header ui-corner-tr last-cell">&nbsp;</td>
					</tr>
				</thead>

				<tbody>
					<tr>
						<td class=" first-cell"><?PHP echo "$liveConCMS_menuText7_1"; ?></td>
						<td class="last-cell">
						<input name="noteFirstname" type="text" value="<?PHP echo "$Firstname"; ?>" /></td>
					</tr>

					<tr>
						<td class="first-cell"><?PHP echo "$liveConCMS_menuText7_2"; ?></td>
						<td class="last-cell">
						<input name="noteLastname" type="text" value="<?PHP echo "$Lastname"; ?>" /></td>
					</tr>

					<tr>
						<td class="first-cell"><?PHP echo "$liveConCMS_menuText7_3"; ?></td>
						<td class="last-cell">
						<input name="noteAdress" type="text" value="<?PHP echo "$Adress"; ?>" /></td>
					</tr>

					<tr>
						<td class="first-cell"><?PHP echo "$liveConCMS_menuText7_11"; ?></td>
						<td class="last-cell">
						<input name="notePostnr" type="text" value="<?PHP echo "$PostNr"; ?>" /></td>
					</tr>
					
					<tr>
						<td class="first-cell"><?PHP echo "$liveConCMS_menuText7_4"; ?></td>
						<td class="last-cell">
						<input name="noteCity" type="text" value="<?PHP echo "$Stad"; ?>" /></td>
					</tr>

					<tr>
						<td class="first-cell"><?PHP echo "$liveConCMS_menuText7_5"; ?></td>
						<td class="last-cell">
						<input name="noteTele" type="text" value="<?PHP echo "$Tele"; ?>" /></td>
					</tr>
					
					<tr>
						<td class="first-cell"><?PHP echo "$liveConCMS_menuText7_6"; ?></td>
						<td class="last-cell">
						<input name="noteMobil" type="text" value="<?PHP echo "$Mobile"; ?>" /></td>
					</tr>
					
					<tr>
						<td class="first-cell"><?PHP echo "$liveConCMS_menuText7_7"; ?></td>
						<td class="last-cell">
						<input name="noteEmail" type="text" value="<?PHP echo "$Email"; ?>" /></td>
					</tr>
					
				</tbody>				
			</table>
			
			<hr />
			
			<table class="ui-widget ui-widget-content ui-corner-all tbl-style-1">
				<thead>
					<tr>
						<td class="ui-widget-header ui-corner-tl  first-cell"><?PHP echo "$liveConCMS_WindowTitle_7"; ?></td>
						<td class="ui-widget-header ui-corner-tr last-cell">&nbsp;</td>
					</tr>
				</thead>

				<tbody>
					<tr>
						<td class="first-cell"><?PHP echo "$liveConCMS_menuText7_1"; ?></td>
						<td class="last-cell">
						<input name="noteAnhorigFirstname" type="text" value="<?PHP echo "$anhorigFirstname"; ?>" /></td>
					</tr>

					<tr>
						<td class="first-cell"><?PHP echo "$liveConCMS_menuText7_2"; ?></td>
						<td class="last-cell">
						<input name="noteAnhorigLastname" type="text" value="<?PHP echo "$anhorigLastname"; ?>" /></td>
					</tr>

					<tr>
						<td class="first-cell"><?PHP echo "$liveConCMS_menuText7_5"; ?></td>
						<td class="last-cell">
						<input name="noteAnhorigTele" type="text" value="<?PHP echo "$anhorigTele"; ?>" /></td>
					</tr>
					
					<tr>
						<td class="first-cell"><?PHP echo "$liveConCMS_menuText7_6"; ?></td>
						<td class="last-cell">
						<input name="noteAnhorigMobil" type="text" value="<?PHP echo "$anhorigMobile"; ?>" /></td>
					</tr>
					
					<tr>
						<td class="first-cell"><?PHP echo "$liveConCMS_menuText7_7"; ?></td>
						<td class="last-cell">
						<input name="noteAnhorigEmail" type="text" value="<?PHP echo "$anhorigEmail"; ?>" /></td>
					</tr>
					
				</tbody>				
			</table>
			
			<hr />
			
			<table class="ui-widget ui-widget-content ui-corner-all tbl-style-1">
				<thead>
					<tr>
						<td class="ui-widget-header ui-corner-tl first-cell"><?PHP echo "$liveConCMS_WindowTitle_8"; ?></td>
						<td class="ui-widget-header ui-corner-tr last-cell">&nbsp;</td>
					</tr>
				</thead>

				<tbody>
					<tr>
						<td class="first-cell"><?PHP echo "$liveConCMS_menuText7_8"; ?></td>
						<td class="last-cell">
						<input name="notePassword" type="password" /></td>
					</tr>

					<tr>
						<td class="first-cell"><?PHP echo "$liveConCMS_menuText7_9"; ?></td>
						<td class="last-cell">
						<input name="noteNewPassword" type="password" /></td>
					</tr>

					<tr>
						<td class="first-cell"><?PHP echo "$liveConCMS_menuText7_10"; ?></td>
						<td class="last-cell">
						<input name="noteConfirmPassword" type="password" /></td>
					</tr>					
				</tbody>				
			</table>
			
			<hr />
			
		<input class="submit_01" name="submit" type="submit" value="<?PHP echo "$liveConCMS_regularbutton_2"; ?>" />
		<input class="reset_01" name="Reset" type="reset" value="<?PHP echo "$liveConCMS_regularbutton_4"; ?>" />
		
		</form>
		
		<hr />

	</div>
	

<?PHP
if (isset($reg_error))
{
	echo	"<div id='popup' title='Error'>";
	echo			"<div>";
	echo				"<b>$liveConCMS_error_Topic_1<br /><br /></b>";

							for ($i=0; $i < sizeof($reg_error); $i++) 
							{
								echo "<em>{$error_list[$reg_error[$i]]}</em><br>\n";
							}	
							
	echo			"</div>";
	echo	"</div>";
		
}
?>	

<script>
	$(document).ready(function(){
		$(".lc-delete-msg").click(function(e){
			var delUrl = $(this).attr('href');
			var refreshUrl = window.location.href;
			var text = $(this).text();
			e.preventDefault();
			$("body").append('<div id="lc-dialog" \/>');
			$("#lc-dialog").dialog({	
				autoOpen: false,
				resizable: false,
				width: '400px',
				height: 'auto',
				modal: true,
				position: ['center', 'center'],
				title:text
			});
			$("#lc-dialog").html(function(){
				return '<div><img class="lc-dialog-icon" src="skins/images/dialog-info.png" style="max-height:50px;" /><p>Denna åtgärd går ej att ångra.</p></div>';
			});			
			$("#lc-dialog").dialog({ buttons: { 
				"Ta bort": function() {	
					$(".ui-dialog").remove();	
					$("body").lcLoader();					
					$.post(delUrl, function(){
						window.location = refreshUrl
					});					
				},
				"Avbryt": function() { 
					$(this).dialog("close"); 
					$("#lc-dialog").remove(); 
				}		
				}
			});
			$("#lc-dialog").dialog('open');			
		});
	});
</script>

	
<?PHP include("liveconcms_footer.php");?>



</body>

</html>
