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
include("core/liveconcms_systemactions.php");
$languagePath = $_SESSION['sess_language'];
include("core/language/$languagePath/language.php");
liveConCMS_SystemPageID('.','..','0','1','0','index.php','system');
checkRole($_SESSION['sess_role'], 'liveconcms_templates');

$display_noticemessage = 0;

$sql_upload = "SELECT manualupload FROM `lc_tblconfig` WHERE ID ='1'";
$result_upload = mysql_query($sql_upload) or die('Query failed: ' . mysql_error());
while ($row_upload = mysql_fetch_array($result_upload, MYSQL_ASSOC))
{				
$manualupload = $row_upload["manualupload"];	
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LiveCon CMS - <?PHP echo "$liveConCMS_HtmlTitle_1";?></title>

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
if (isset($_SESSION['sess_tmpnotice']))
{
	echo "<script type='text/javascript'>
		$(document).ready(function(){
			$('body').append('<div id=\"freeow\"></div>');
			$('#freeow').freeow('Sparad', 'Mallen är tillagd i systemet.', {
				classes: ['lc-notice ui-widget-content ui-state-highlight ui-corner-all ui-box-shadow'],
				autoHide: true
			});
		});
	</script>";
	unset($_SESSION['sess_tmpnotice']);
}
?>
</head>

<body class="lc-body">

<?PHP
include("liveconcms_panel.php");
?>

<div class="bodywrapper container_12">



			<h1 class="page-title"><?PHP echo "$liveconcms_templatestext1"; ?></h1>
				<p><?PHP echo "$liveconcms_templatestext2"; ?></p>

				<hr />		

				
			<?PHP 
			if($manualupload == 1)
			{
			echo "<a class='addButton' href='liveconcms_addtemplate.php' disabled>$liveConCMS_button_3</a>";
			}
			else
			{
			echo "<a class='addButton' href='liveconcms_addtemplate.php'>$liveConCMS_button_3</a>";
			}
			?>
						
			<hr />
				
		
			<div class="ui-widget ui-widget-content ui-corner-all" id="templates">
			<span class="ui-widget-header ui-corner-top ui-helper-clearfix"><h3><?PHP echo "$liveConCMS_WindowTitle_1 ";?></h3></span>
				<?PHP

				$SQLCount = "SELECT COUNT(*) FROM `lc_tbltemplates`";
				$resultatCount = mysql_query_exequter_with_return($SQLCount); 
				while ($rowCount = mysql_fetch_array($resultatCount, MYSQL_ASSOC))
				{
				$templateCount = $rowCount["COUNT(*)"];
				}

				if($templateCount != 0)
				{
						echo	"<table class='ui-widget ui-corner-all tbl-style-1'>";
						echo	"	<thead>";
						echo	"		<tr>";
						echo	"			<td class='first-cell'>$liveConCMS_WindowTitle_27</td>";
						echo	"			<td>$liveConCMS_WindowTitle_24</td>";
						echo	"			<td class='last-cell'>$liveConCMS_WindowTitle_26</td>";
						echo	"		</tr>";
						echo	"	</thead>";
						echo "<tbody>";
						
								$sql = 'SELECT * FROM `lc_tbltemplates` ORDER BY ID ASC';
								$result = mysql_query_exequter_with_return($sql); 
								while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
								{
								for($i = 0; $i < 1; $i++) 
									{
									$TemplateID[$i] = $row["ID"];	
									$TemplateFileName[$i] = $row["templateFilename"];	
									$TemplateTitel[$i] = $row["templateTitel"];	
							
									echo "	<tr>";
									echo "		<td class='first-cell'>$TemplateFileName[$i]</td>";
									echo "		<td>$TemplateTitel[$i]</td>";
									echo "		<td class='last-cell'><a class='lc-deleteItem' href='?del_template=$TemplateID[$i]' title='$liveConCMS_regularbutton_9 &quot;$TemplateFileName[$i]&quot;'>$liveConCMS_regularbutton_9</a></td>";
									echo "	</tr>";
									}
								}
						echo "</tbody>";
						echo "</table>";
				}
				else
				{
				
				}
				?>							
		</div>
		
		<hr>
	
	</div><!-- .body-wrapper -->



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
		
<?PHP include("liveconcms_footer.php");?>

<!-- SLUT -->



</body>

</html>
