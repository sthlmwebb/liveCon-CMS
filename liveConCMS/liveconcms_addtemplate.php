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
checkRole($_SESSION['sess_role'], 'liveconcms_addtemplate');		
								
if (isset($_POST['submit']))
{

 $lc_UserID =  $_SESSION['sess_id'];
 createLogg($lc_UserID, $liveConCMS_logg18);

 $_POST = db_escape($_POST);
 $templateTitle = mysql_real_escape_string($_POST['templateTitel']);
 
  foreach($_POST as $key => $val)
  {
    $_POST[$key] = trim($val);
  }


			if(empty($_FILES["File"]['name'])) 
			{		
			
			}
			   else
			   {
					   
			   		$upload_dir = "templates/"; 
	
				  	$filetypes = 'php,PHP'; 
				  
				  	$maxsize = (1024*900000); 
				
					if($_FILES["File"]['size'] > $maxsize) 
				      die('$liveConCMS_error_message_4'.(string)($maxsize/1024).' KB. <br/><a href="liveconcms_addtemplate.php">$liveConCMS_links2</a>'); 
				      
				        $types = explode(',', $filetypes); 
				   		$file = explode('.', $_FILES["File"]['name']); 
				   		$extension = $file[sizeof($file)-1]; 
				   		if(!in_array(strtolower($extension), $types)) 
				        die("<em>$liveConCMS_error_message_5</em> <strong>php</strong><br/><a href='liveconcms_addtemplate.php'>$liveConCMS_links2</a>"); 
				
						$thefile = $_FILES["File"]['name'];
					
							$siffra = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'); 
							while (file_exists($upload_dir.$thefile)) 
							{	 
							$thefile = $siffra[rand(0, count($siffra)-1)].$thefile; 
							} 			
				
				 	if (is_uploaded_file($_FILES["File"]['tmp_name']) && move_uploaded_file($_FILES["File"]['tmp_name'],$upload_dir.$thefile)) 
				    { 
				
							  $sql = "INSERT INTO lc_tbltemplates(templateFilename, templateTitel) VALUES('$thefile', '$templateTitle')";
							  mysql_query_simple_exequter($sql);
							  $_SESSION['sess_tmpnotice'] = 1;
							  header("Refresh: 0;URL=liveconcms_templates.php");
							  exit; 
				    }
				    else
				    {
				    header("Refresh: 0;URL=liveconcms_error.php?error_id = 1");
					exit; 
				    }   
			   
			   }

}					
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LiveCon CMS - <?PHP echo "$liveConCMS_HtmlTitle_4";?></title>

<!-- Load javascripts for CMS backend -->
<?PHP include("liveconcms_editonpageheader.php");?>

<!-- Load the stylesheets used by the CMS -->
<link rel="stylesheet" type="text/css" href="skins/reset.css">
<link rel="stylesheet" type="text/css" href="skins/styles.php">

<script>
	$(document).ready(function(){
		$("form").submit(function(){
		
			var templateTitel = $("input[name=templateTitel]").val();
			var file = $("input[name=File]").val();
			var fileExt = file.split('.').pop().toLowerCase();

			if ( templateTitel.length === 0 ) { lcErrorPopup('addtemplate-1'); return false }
			else if ( file.length === 0 ) { lcErrorPopup('addtemplate-2'); return false }
		});
			
	});
</script

</head>

<body class="lc-body">
<?PHP
include("liveconcms_panel.php");
?>

<div class="bodywrapper container_12">
	
		<h1 class="page-title"><?PHP echo "$liveConCMS_PageTitle_4";?></h1>
		<p><?PHP echo "$liveConCMS_pageText11_1";?></p>
		

		<hr />
		
		
			<div class="ui-widget ui-widget-content ui-corner-all">
				<span class="ui-widget-header ui-corner-top ui-helper-clearfix"><h3><?PHP echo "$liveConCMS_WindowTitle_22";?></h3></span>
					<div class="ui-widget-content">
						<form method="post" enctype="multipart/form-data">
						<fieldset>
							<strong><?PHP echo "$liveConCMS_menuText11_1";?></strong> 
							<input class="form_metaKeywords" type="text" value="" name="templateTitel"/>
							<em><?PHP echo "$liveConCMS_menuText11_2";?></em>
						</fieldset>
						<fieldset>
							<strong><?PHP echo "$liveConCMS_menuText11_3";?></strong> 
							<input type='file' name='File'/>
							<em><?PHP echo "$liveConCMS_menuText11_4";?></em>
						</fieldset>						
							<input name="submit" type="submit" value="<?PHP echo "$liveConCMS_regularbutton_2"; ?>" />
							<input name="Reset1" type="reset" value="<?PHP echo "$liveConCMS_regularbutton_4"; ?>" />
						</form>						
					</div>
			</div>
	
	<hr />
	
	<a class="goback" href="javascript:history.back()"><?PHP echo "$liveConCMS_links1";?></a>
	<hr />
	</div> <!-- .bodywrapper -->
	
	
	
	<?PHP include("liveconcms_footer.php");?>

</body>

</html>
