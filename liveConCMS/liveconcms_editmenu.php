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
checkRole($_SESSION['sess_role'], 'liveconcms_editmenu');	
$sitelanguage = $_SESSION['sess_sitelanguage'];

if (isset($_GET['menuid']) == "")
{
	header("Refresh: 0;URL=liveconcms_menus.php");
	exit; 			
}
else
{
$menuid = (int) isset($_GET['menuid']) ? $_GET['menuid'] : menuid('n');

		$sql = "SELECT * FROM `lc_tblmeny`,`lc_tblmenytext` WHERE lc_tblmeny.ID ='$menuid' AND lc_tblmeny.ID = lc_tblmenytext.MenyID AND lc_tblmenytext.LanguageID = '$sitelanguage'";
		$result = mysql_query_exequter_with_return($sql);
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{				
			$menyText = $row["MenyText"];
			$menyLink = $row["MenyLink"];			
		}
}	


$sql_upload = "SELECT manualupload FROM `lc_tblconfig` WHERE ID ='1'";
$result_upload = mysql_query_exequter_with_return($sql_upload);
while ($row_upload = mysql_fetch_array($result_upload, MYSQL_ASSOC))
{				
$manualupload = $row_upload["manualupload"];	
}


if (isset($_GET['type']) == "")
{
				$SQLCount = "SELECT COUNT(*) FROM `lc_tbltemplates`";
				$resultatCount = mysql_query_exequter_with_return($SQLCount);
				while ($rowCount = mysql_fetch_array($resultatCount, MYSQL_ASSOC))
				{
				$templateCount = $rowCount["COUNT(*)"];
				}
					if($templateCount != 0)
					{				
					$addType = (int) 1;
					}
					else
					{
					$addType = (int) 2;
					}
}
else
{
$addType = (int) isset($_GET['type']) ? $_GET['type'] : type('n');
}

					
if (isset($_POST['submit']))
{
 $lc_UserID =  $_SESSION['sess_id'];
 createLogg($lc_UserID, $liveConCMS_logg10);
 
 $_POST = db_escape($_POST);
 
 
  foreach($_POST as $key => $val)
  {
    $_POST[$key] = trim($val);
  }

    
	if ($addType == 2)
    {
	
	$fileTitle = $_POST['fileSrc'];
	
	$fileControll = substr($fileTitle, 0, 3);
	if ($fileControll == "../")
	{
	$fileTitle = substr($fileTitle, 3);
	}
	
		
	 $sql = "UPDATE lc_tblmeny SET MenyLink = '$fileTitle' Where ID = '$menuid'";
	 mysql_query_simple_exequter($sql);
		
	  $_SESSION['sess_menyupdated'] = 1; 
	  header("Refresh: 0;URL=liveconcms_menus.php");
	  exit;
	
	}
	else
	{
				/* TEMPLATE */
				$valdTemplate = mysql_real_escape_string($_POST['Template']);
				$fileTitle = fileWords($menyLink);
				$fileTitle = strtolower($fileTitle);
				
			
				while (file_exists("../$menyLink")) 
				{	 
					if (!unlink("../$menyLink"))
					{
					header("Refresh: 0;URL=liveconcms_error.php?error_id = 2");
					exit; 
					}
				}
								
				if (!liveConFileCopy("templates/$valdTemplate", "../$fileTitle"))
				{
				header("Refresh: 0;URL=liveconcms_error.php?error_id = 2");
				exit; 
				}
				
				
				$sql = "UPDATE lc_tblmeny SET MenyLink = '$fileTitle' Where ID = '$menuid'";
				mysql_query_simple_exequter($sql);
		
			   $_SESSION['sess_menyupdated'] = 1; 						
			   header("Refresh: 0;URL=liveconcms_menus.php");
			   exit; 
		 /* */
	
	}
	
	
	
}

	function fileWords($phrase)
	{
	$chars = array("Å", "Ä", "Ö", "å", "ä", "ö", " ");
	$correctHTML  = array("A","A","O","a","a","p","_");
	$newphrase = str_replace($chars, $correctHTML, $phrase);

	return $newphrase;
	}						
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LiveCon CMS - <?PHP echo "$liveConCMS_HtmlTitle_2";?></title>

<!-- Load javascripts for CMS backend -->
<?PHP include("liveconcms_editonpageheader.php");?>

<!-- Load the stylesheets used by the CMS -->
<link rel="stylesheet" type="text/css" href="skins/reset.css">
<link rel="stylesheet" type="text/css" href="skins/styles.php">

<script>

	$(document).ready(function(){
	
		/*Global variables*/		
		var url = window.location.href;
		var type = $("input:radio").serialize();
		var formUrl = url+"&"+type;
				
		$("#lc-menu-form").attr('action', formUrl);
		
		/*Hide filebrowser by default*/
		$("#file-list .lc-browser").toggle();
		
		$("#lc-template-file").toggle();
		
		/*If filebrowser is checked in system setup, load the filetree*/
		if (type == "type=2"){
			filetree();
		}		

		/*Load filetree when you click on "use file" */
		$("#usefile").click(function(){
			filetree();
		});

		/*Load templates when click on radio*/
		$("#usetemplate").click(function(){
			filetree();
		});		
			
		/*Drop down, add selected value to input*/
		$("select").change(function () {
			var href = "";
			$("select option:selected").each(function () {
				href += $(this).text() + " ";
            });
			$("#fileSrc").val(href);
        }).trigger('change');
		
		/*Filetree funtion*/
		function filetree(){

			$("#fileSrc").val('');
			
			$("body").lcLoader();
			$(".lc-browser").css({
				'height':'0px',
				'overflow':'auto'
			});

			$(".lc-browser").load('liveconcms_filetree.php' ,function(){
				$(this).lcfileTree();
				$("#lcLoader").remove();
				$("#template-list").toggle();
				$("#lc-template-file").toggle();
				$("#file-list .lc-browser").toggle().animate({
					'height':'200px'
				}, 600);

				$(".lc-browser-file-link").click(function(e){			
					e.preventDefault();
					var href = $(this).attr('href');
					
					/*Validation*/
					var fileExt = $(this).attr('href').split('.').pop().toLowerCase();
					if ( fileExt == 'php' ) { $("#fileSrc").val(href); }
					else if ( fileExt == 'html' ) { $("#fileSrc").val(href) }
					else if ( fileExt == 'htm' ) { $("#fileSrc").val(href) }
					else {warning()}
					
				});
			});
		}
		
		/*Click on template*/
		function useTpl(){
			$("#fileSrc").val('');
			$("#file-list .lc-browser").animate({
					'height':'0px'
				}, 300, function(){
					$("#file-list .lc-browser").toggle();
					$("#lc-template-file").toggle();
					$("#template-list").toggle();
				
				});	
		}
				
		function warning(){
			$("body").append('<div id="lc-dialog" \/>');
			$("#lc-dialog").load('liveconcms_errorpopup.php',function(){
				$("#lc-dialog").dialog('open');
			});		
		}
		
		$("#lc-menu-form input:reset").click(function(){
			useTpl();
		});
			
		/*Submit form*/
		$("#lc-menu-form input:submit").click(function(e){
		
			var menyTitel = $("input[name=menyTitel]").val();
			
			var type = $("input:radio").serialize();
			var query  = $("#lc-menu-form").serialize();
			var formUrl = url+"&"+type;
			
			$("#lc-menu-form").attr('action', formUrl);	
						
			if (menyTitel.length === 0) {
				warning();
				return false;
			}
	
		});
			
	});
	
	
</script>

</head>

<body class="lc-body">
<?PHP
include("liveconcms_panel.php");
?>

<div class="bodywrapper container_12">
	
		<div class="container_wrapper">
			<h1 class="page-title"><?PHP echo "$liveConCMS_PageTitle_14"; ?> <i>"<?PHP echo "$menyText";?>"</i></h1>
			<p><?PHP echo "$liveConCMS_pageText12_1"; ?> <i>"<?PHP echo "$menyText";?>"</i>.</p>
				
			<hr />
		
			<div class="ui-widget ui-widget-content ui-corner-all" id="lc-template-form">
			<span class="ui-widget-header ui-corner-top ui-helper-clearfix"><h3><?PHP echo "$liveConCMS_WindowTitle_29"; ?></h3></span>
				<div class="ui-widget-content">
			
					<form name="form1" action="gets_replaced"  method="post" enctype="multipart/form-data" id="lc-menu-form">
					
					
					<fieldset id="lc-tpl-type">
					<?PHP
					if($manualupload == 1)
						{
							echo "<input id='usetemplate' type='radio' name='type' value='1' disabled><label for='usetemplate'>$liveconcms_editmenutext1</label>";
							echo "<input id='usefile' type='radio' name='type' value='2' checked='checked'><label for='usefile'>$liveconcms_editmenutext2</label>";
						}
						else
						{
							if($templateCount == 0)
							{
								echo "<input id='usetemplate' type='radio' name='type' value='1' disabled><label for='usetemplate'>$liveconcms_editmenutext1</label>";
								echo "<input id='usefile' type='radio' name='type' value='2' checked='checked'><label for='usefile'>$liveconcms_editmenutext2</label>";
							}
							else
							{
								echo "<input id='usetemplate' type='radio' name='type' value='1' checked='checked'><label for='usetemplate'>$liveconcms_editmenutext1</label>";
								echo "<input id='usefile' type='radio' name='type' value='2'><label for='usefile'>$liveconcms_editmenutext2</label>";
							}
						}
					?>
					</fieldset>
					
					<fieldset id="template-list">
						<?PHP
						if($manualupload != 1)
						{
						echo	"<strong>$liveConCMS_menuText2_5</strong> ";
						echo	"<select name='Template'>";
							
							$sql = 'SELECT * FROM `lc_tbltemplates` ORDER BY ID ASC';
								$result = mysql_query_exequter_with_return($sql);
								while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
								{
								for($i = 0; $i < 1; $i++) 
									{
									$TemplateID[$i] = $row["ID"];	
									$TemplateFileName[$i] = $row["templateFilename"];	
									$TemplateTitel[$i] = $row["templateTitel"];	
							
									echo "<option value=\"$TemplateFileName[$i]\">$TemplateTitel[$i]</option>";
									}
								}
						echo	"</select>";
						}
						?>
						
					</fieldset>
					
					<fieldset id="file-list">
						<div class="lc-browser"></div>
					</fieldset>
					
					<fieldset id="lc-template-file">
						<strong><?PHP echo "$liveconcms_editmenutext3"; ?></strong>
							<input type='text' name='fileSrc' readonly="readonly" id='fileSrc' value='' />
					</fieldset>

					<fieldset>
						<input name="submit" type="submit" value="<?PHP echo "$liveConCMS_regularbutton_2"; ?>" />
					</fieldset>
					</form>	
					
		</div>
	</div>
	
	<hr />
	
	<a class="goback" href="javascript:history.back()"><?PHP echo "$liveConCMS_links1";?></a>
	
	</div>
	
	<hr />
	
	<?PHP include("liveconcms_footer.php");?>


</body>

</html>
