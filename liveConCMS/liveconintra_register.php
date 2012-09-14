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
checkRole($_SESSION['sess_role'], 'liveconintra_register');


if (isset($_GET['del_userid']) == "")
{
}
else
{

$del_userid = (int) isset($_GET['del_userid']) ? $_GET['del_userid'] : del_userid('n');

$sql = 'DELETE FROM lc_tbladministrator WHERE ID = "'.$del_userid.'"  LIMIT 1';
mysql_query_simple_exequter($sql);
	   
$sql = 'DELETE FROM lc_tblanhorig WHERE UserID = "'.$del_userid.'"  LIMIT 1';
mysql_query_simple_exequter($sql);

$sql = 'DELETE FROM lc_tblnoticebord WHERE UserID = "'.$del_userid.'"  LIMIT 1';
mysql_query_simple_exequter($sql);

$lc_UserID =  $_SESSION['sess_id'];
createLogg($lc_UserID, $liveConCMS_logg38);

	if($del_userid == $lc_UserID)
	{
	  session_unset();
	  session_destroy();
	  header("Location: ../index.php");
	  exit;
	}
	else
	{	   
	header("Refresh: 0;URL=liveconintra_register.php");
	exit; 
	}

}


if (isset($_POST['submit']))
{

$_POST = db_escape($_POST);

 foreach($_POST as $key => $val)
  {
    $_POST[$key] = trim($val);
  }
  
  
 $userTitle = "";
 $userUsername = mysql_real_escape_string($_POST['userUsername']);
 $userPassword = mysql_real_escape_string($_POST['userPassword']);
 $userTitle = mysql_real_escape_string($_POST['userTitle']);
 $userFirstname = mysql_real_escape_string($_POST['userFirstname']);
 $userLastname = mysql_real_escape_string($_POST['userLastname']);
 
 $AdminEditable = 0;
 $AdminPages = 0;
 $AdminNews = 0;
 $AdminTemplates = 0;
 $AdminLanguages = 0;
 $AdminExplorer = 0;
 $AdminModules = 0;
 $AdminUser = 0;
 $AdminStatistic = 0;
 $AdminSystem = 0;

 if (empty($_POST['userUsername']) || empty($_POST['userPassword']) || empty($_POST['userFirstname']) ||
     empty($_POST['userLastname'])) 
  {
    $reg_error[] = 0;   
  }
  
  $sql = "SELECT COUNT(*) FROM lc_tbladministrator WHERE UserName ='{$_POST['userUsername']}'";
  $result = mysql_query_exequter_with_return($sql);
  
   if (mysql_result($result, 0) > 0) 
  {
    $reg_error[] = 1;
  }
  
			if (ISSET($_POST['adminperm1'])) 
			{
			$AdminPages = 1;
			}
			else
			{
			$AdminPages = 0;
			}
			
			if (ISSET($_POST['adminperm2'])) 
			{
			 $AdminNews = 1;
			}
			else
			{
			 $AdminNews = 0;
			}
			
			if (ISSET($_POST['adminperm3'])) 
			{
			 $AdminTemplates = 1;
			}
			else
			{
			 $AdminTemplates = 0;
			}
			if (ISSET($_POST['adminperm4'])) 
			{
			 $AdminLanguages = 1;
			}
			else
			{
			 $AdminLanguages = 0;
			}
			if (ISSET($_POST['adminperm5'])) 
			{
			 $AdminExplorer = 1;
			}
			else
			{
			 $AdminExplorer = 0;
			}
			if (ISSET($_POST['adminperm6'])) 
			{
			$AdminModules = 1;
			}
			else
			{
			$AdminModules = 0;
			}
			if (ISSET($_POST['adminperm7'])) 
			{
			$AdminUser = 1;
			}
			else
			{
			$AdminUser = 0;
			}
			if (ISSET($_POST['adminperm8'])) 
			{
			 $AdminStatistic = 1;
			}
			else
			{
			 $AdminStatistic = 0;
			}
			if (ISSET($_POST['adminperm9'])) 
			{
			$AdminSystem = 1;
			}
			else
			{
			$AdminSystem = 0;
			}
			if (ISSET($_POST['adminperm10'])) 
			{
			$AdminEditable = 1;
			}
			else
			{
			$AdminEditable = 0;
			}


  if (!isset($reg_error)) 
  {
  $Password =  md5($_POST['userPassword'] & $SaltedKey);
  
  			if (ISSET($_POST['rdbAdmin'])) 
			{
			$useradminRole = $_POST['rdbAdmin'];
			}
			else
			{
			$useradminRole = 0;
			}
  					$Dagensdatum = date('Y-m-d H:i:s');
					$sql = "INSERT INTO lc_tbladministrator (UserName, UserPassword, Firstname, Lastname, Adress, PostNr, Stad, Email, Tele, Mobile, Title, Role, LastLoggedin, IP, AcceptRules, languagepath, AdminEditable, AdminPages, AdminNews, AdminTemplates, AdminLanguages, AdminExplorer, AdminModules, AdminUser, AdminStatistic, AdminSystem) VALUES('$userUsername', '$Password', '$userFirstname', '$userLastname', '', '', '', '', '' , '', '$userTitle','$useradminRole', '$Dagensdatum','', '0', '$languagePath', '$AdminEditable', '$AdminPages', '$AdminNews','$AdminTemplates', '$AdminLanguages', '$AdminExplorer', '$AdminModules', '$AdminUser', '$AdminStatistic', '$AdminSystem')";
					mysql_query_simple_exequter($sql);
  
  					$sql = "SELECT ID FROM `lc_tbladministrator` WHERE UserName ='$userUsername'";
					$result = mysql_query_exequter_with_return($sql);
					while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
					{	
							$insertID = $row["ID"];
					}
					
					
					
					$sql = "INSERT INTO lc_tblanhorig (UserID, anhorigFirstname, anhorigLastname, anhorigEmail, anhorigTele, anhorigMobil) VALUES('$insertID', '', '', '', '', '')";
					mysql_query_simple_exequter($sql);
	
			$lc_UserID =  $_SESSION['sess_id'];
			createLogg($lc_UserID, $liveConCMS_logg39);
	
			$display_noticemessage = 1;	
			
			header("Refresh: 0;URL=liveconintra_register.php");
			exit; 

  }
  else
  {

  }


}	

$error_list[0] = "$liveConCMS_error_message_11";
$error_list[1] = "$liveConCMS_error_message_12";
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LiveCon CMS - <?PHP echo "$liveConCMS_HtmlTitle_10";?></title>

<!-- Load javascripts for CMS backend -->
<?PHP include("liveconcms_editonpageheader.php");?>


<!-- Load the stylesheets used by the CMS -->
<link rel="stylesheet" type="text/css" href="skins/reset.css">
<link rel="stylesheet" type="text/css" href="skins/styles.php">

<script>
$(document).ready(function(){
	$(".lc-deleteItem").lcDeleteItem();
});
</script>

<?PHP
if (isset($display_noticemessage))
{
	echo "<script type='text/javascript'>
		$(document).ready(function(){
			$('body').append('<div id=\"freeow\"></div>');
			$('#freeow').freeow('Sparad', 'Användaren är skapad i systemet.', {
				classes: ['lc-notice ui-widget-content ui-state-highlight ui-corner-all ui-box-shadow'],
				autoHide: true
			});
		});
	</script>";
}
?>
</head>

<body class="lc-body">
<?PHP
include("liveconcms_panel.php");
?>

<div class="bodywrapper container_12">
			
		
			<h1 class="page-title"><?php echo "$liveConCMS_PageTitle_9"; ?></h1>

			<p><?PHP echo "$liveConCMS_pageText8_1";?></p>
			<p><?PHP echo "$liveConCMS_pageText8_2";?></p>

			
			<hr />
			
			
			<table class="ui-widget ui-widget-content ui-corner-all tbl-style-1" id="tbl-intra-userlist">
				<thead>
					<tr>
						<td class="ui-widget-header ui-corner-tl first-cell"><?php echo "$liveConCMS_WindowTitle_9"; ?></td>
						<td class="ui-widget-header"><?php echo "$liveConCMS_WindowTitle_10"; ?></td>
						<td class="ui-widget-header"><?php echo "$liveConCMS_WindowTitle_11"; ?></td>
						<td class="ui-widget-header"><?php echo "$liveConCMS_WindowTitle_12"; ?></td>
						<td class="ui-widget-header"><?php echo "$liveConCMS_WindowTitle_13"; ?></td>
						<td class="ui-widget-header tbl-edit-item-cell"><?php echo "$liveConCMS_WindowTitle_14"; ?></td>
						<td class="ui-widget-header tbl-delete-item-cell ui-corner-tr"><?php echo "$liveConCMS_WindowTitle_15"; ?></td>
					</tr>
				</thead>

				<tbody>
				<?PHP
					
					$Traffar = "SELECT COUNT(*) FROM `lc_tbladministrator`";
					$Restraffar = mysql_query_exequter_with_return($Traffar);
					while ($rowtraffar = mysql_fetch_array($Restraffar, MYSQL_ASSOC))
					{
					$Antal = $rowtraffar["COUNT(*)"];
					}
					
					$newoffset = "";
					// Nu bestämmer vi antal per sida och kollar vi upp totala antalet
					$limit = 25; // Antal per sida
				
					$result = @mysql_query("SELECT count(*) as count FROM `lc_tbladministrator`")
					  or die("Error fetching number in DB<br>".mysql_error());
					$row = @mysql_fetch_array($result);
					$numrows = $row['count']; // Antal i databasen
					 
					// Sedan kollar vi om startvariabeln är satt
					if (!isset($_GET['start']) || $_GET['start'] == "")
					  $start = 0;
					else
					  $start = $_GET['start'];
					 
					// Då räknar vi ut hur många sidor det blev
					$pages = intval($numrows/$limit);
					if ($numrows%$limit)
					  $pages++;
					 
					// Hämta länk till förstasidan och föregående sida
					if ($start > 0) {
					  $numlink = '<a class="lc-numlink lc-numlink-first ui-corner-left " href="?start=0">&laquo;&laquo;</a> ';
					  $numlink .= '<a class="lc-numlink lc-numlink-prev" href="?start='.($start - $limit).'">&laquo;</a> ';
					} else {
					  $numlink = '<a class="lc-numlink lc-numlink-first ui-corner-left ui-state-disabled" >&laquo;&laquo;</a>';
					  $numlink .= '<a class="lc-numlink lc-numlink-prev ui-state-disabled" >&laquo;</a> ';
					}
					 
					// Hämta sidonummer
					for ($i = 1; $i <= $pages; $i++) {
					  $newoffset = $limit*($i-1);
					  if ($start == $newoffset)
					    $numlink .= '<a class="lc-numlink lc-numlink-current ui-state-disabled">['.$i.']</a>';
					  else
					    $numlink .= '<a class="lc-numlink lc-numlink-next-link" href="?start='.$newoffset.'">'.$i.'</a>';
					}
					 
					// Hämta länk till nästa sida
					if ($numrows > ($start + $limit))
					  $numlink .= '<a class="lc-numlink lc-numlink-next" href="?start='.($start + $limit).'">&raquo;</a>';
					else
					  $numlink .= '<a class="lc-numlink lc-numlink-next ui-state-disabled">&raquo;</a>';
					 
					// Hämta sista sidan
					if ($start != $newoffset)
					  $numlink .= '<a class="lc-numlink lc-numlink-last ui-corner-right" href="?start='.$newoffset.'">&raquo;&raquo;</a>';
					else
					  $numlink .= '<a class="lc-numlink lc-numlink-last ui-corner-right ui-state-disabled">&raquo;&raquo;</a>';

					$sql1 = "SELECT * FROM `lc_tbladministrator` ORDER BY ID ASC LIMIT $start, $limit";
					$result1 = mysql_query_exequter_with_return($sql1);
					while ($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
					{
					for($j = 0 ; $j < 1; $j++) 
					{
					
					$userID[$j] = $row1["ID"];
					$userFirstnames[$j] = $row1["Firstname"];
					$userLastnames[$j] = $row1["Lastname"];
					$userEmail[$j] = $row1["Email"];
					$userTele[$j] = $row1["Tele"];
					$userMobile[$j] = $row1["Mobile"];
					$userTitles[$j] = $row1["Title"];
					$userRole[$j] = $row1["Role"];


					echo "<tr>";
					echo "	<td class='first-cell'>$userTitles[$j]</td>";
					echo "	<td>$userFirstnames[$j] $userLastnames[$j]</td>";
					echo "	<td>$userEmail[$j]</td>";
					echo "	<td>$userTele[$j]</td>";
					echo "	<td>$userMobile[$j]</td>";
					echo "	<td class='tbl-edit-item-cell'><a class='lc-editItem' href='liveconintra_users.php?red_userid=$userID[$j]' title='$OnPageToolTip_11 $userFirstnames[$j] $userLastnames[$j]&rsquo;s $OnPageToolTip_12'><span>Editera användare</span></a></td>";
					
					if($userRole[$j] == '0' || $userRole[$j] == '2' || $userRole[$j] == '3')
					{
					echo "	<td class='last-cell tbl-delete-item-cell'><a class='lc-deleteItem' href='liveconintra_register.php?del_userid=$userID[$j]' title='$OnPageToolTip_9 $userFirstnames[$j] $userLastnames[$j]&rsquo;s $OnPageToolTip_12'><span>Ta bort användare</span></a></td>";
					}
					else
					{
					echo "	<td class='last-cell tbl-delete-item-cell'>&nbsp;</td>";
					}
					
					echo "</tr>";
					
					}
					}
					?>
					
				</tbody>				
			</table>
		
		<span class="lc-page-switch buttonset"><?PHP echo $numlink; ?></span>
		
		<hr />
		
		
		
			<h2><?PHP echo "$liveConCMS_menuText8_6"; ?></h2>
			<form method="post">
			<table class="ui-widget ui-widget-content ui-corner-all tbl-style-1" id="tbl-profil-registerUser">
				<thead>
					<tr>
						<td class="ui-widget-header ui-corner-tl first-cell"><?PHP echo "$liveConCMS_WindowTitle_16"; ?></td>
						<td class="ui-widget-header ui-corner-tr">&nbsp;</td>
					</tr>
				</thead>

				<tbody>
					<tr>
						<td class="first-cell"><?PHP echo "$liveConCMS_menuText8_1"; ?></td>
						<td class="last-cell"><input name="userUsername" type="text" /></td>
					</tr>

					<tr>
						<td class="first-cell"><?PHP echo "$liveConCMS_menuText8_2"; ?></td>
						<td class="last-cell"><input name="userPassword" type="password" /></td>
					</tr>

					<tr>
						<td class="first-cell"><?PHP echo "$liveConCMS_menuText8_3"; ?></td>
						<td class="last-cell"><input name="userTitle" type="text" /></td>
					</tr>
					
					<tr>
						<td class="first-cell"><?PHP echo "$liveConCMS_menuText8_4"; ?></td>
						<td class="last-cell"><input name="userFirstname" type="text" /></td>
					</tr>
					
					<tr>
						<td class="first-cell"><?PHP echo "$liveConCMS_menuText8_5"; ?></td>
						<td class="last-cell"><input name="userLastname" type="text" /></td>
					</tr>
					<tr>
						<td class="first-cell"></td>
						<td class="last-cell">
							<input type="radio" id='lc-admin-permission-regular' name="rdbAdmin"  value="0" checked="checked" />
							<label for="lc-admin-permission-regular" title="Information om permission här"><?PHP echo "$liveconcms_register_user1"; ?></label>							
						
							<input type="radio" id='lc-admin-permission-full' name="rdbAdmin"  value="2" />
							<label for="lc-admin-permission-full" title="Information om permission här"><?PHP echo "$liveconcms_registercheckbox"; ?></label>	
													
							<input type="radio" id="lc-admin-permission-custom" name="rdbAdmin"  value="3" />
							<label for="lc-admin-permission-custom" title="Information om permission här"><?PHP echo "$liveconcms_register_user2"; ?></label>
							
						</td>
					</tr>
					<tr>
						<td class="first-cell"></td>
						<td class="last-cell">
							<div class="lc-admin-permission-checkboxes">
								
								<input id="permission10" name="adminperm10" type="checkbox" />
								<label for="permission10"><?PHP echo "$liveconcms_register_user3"; ?></label>
								
								<input id="permission1" name="adminperm1" type="checkbox" />
								<label for="permission1"><?PHP echo "$liveconcms_register_user4"; ?></label>
								
								<input id="permission2" name="adminperm2" type="checkbox" />
								<label for="permission2"><?PHP echo "$liveconcms_register_user5"; ?></label>		

								<input id="permission3" name="adminperm3" type="checkbox" />
								<label for="permission3"><?PHP echo "$liveconcms_register_user6"; ?></label>	

								<input id="permission4" name="adminperm4" type="checkbox" />
								<label for="permission4"><?PHP echo "$liveconcms_register_user7"; ?></label>
								
								<input id="permission5" name="adminperm5" type="checkbox" />
								<label for="permission5"><?PHP echo "$liveconcms_register_user8"; ?></label>		

								<input id="permission6" name="adminperm6" type="checkbox" />
								<label for="permission6"><?PHP echo "$liveconcms_register_user9"; ?></label>	

								<input id="permission7" name="adminperm7" type="checkbox" />
								<label for="permission7"><?PHP echo "$liveconcms_register_user10"; ?></label>
								
								<input id="permission8" name="adminperm8" type="checkbox" />
								<label for="permission8"><?PHP echo "$liveconcms_register_user11"; ?></label>		

								<input id="permission9" name="adminperm9" type="checkbox" />
								<label for="permission9"><?PHP echo "$liveconcms_register_user12"; ?></label>	
							</div>
						</td>
					</tr>					
				</tbody>				
			</table>
				
				<hr />
						
				<input class="submit_01" name="submit" type="submit" value="<?PHP echo "$liveConCMS_regularbutton_2"; ?>" />
				<input class="reset_01" name="Reset" type="reset" value="<?PHP echo "$liveConCMS_regularbutton_4"; ?>" />
	   
			</form>
			
			
			
		<hr />
		
		
		
	</div><!-- .bodywrapper -->
	
	
	
	<?PHP include("liveconcms_footer.php");?>

	
	
	<!-- POP Fönstret för fel --->	
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
		$(".lc-admin-permission-checkboxes").hide();
		$("#lc-admin-permission-custom").click(function(){
			$(".lc-admin-permission-checkboxes").toggle('blind');	
		});
		$("#lc-admin-permission-regular").click(function(){
			$(".lc-admin-permission-checkboxes").hide();
		});	
		$("#lc-admin-permission-full").click(function(){
			$(".lc-admin-permission-checkboxes").hide();	
		});				
	});
</script>


</body>

</html>
