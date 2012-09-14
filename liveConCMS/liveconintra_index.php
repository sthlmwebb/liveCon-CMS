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
checkRole($_SESSION['sess_role'], 'liveconintra_index');

$file = "";
if (isset($_GET['del_id']) == "")
{

}
else
{
$DeleteEntry = (int) isset($_GET['del_id']) ? $_GET['del_id'] : del_id('n');

					$sql = "SELECT * FROM `lc_tbluploadedfiles` WHERE ID ='$DeleteEntry'";
					$result = mysql_query_exequter_with_return($sql);
					while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
					{
					
							$file = $row["File"];
							
					}



					if (file_exists($file)) 
					{ 
					unlink($file);
					$sql = "DELETE FROM lc_tbluploadedfiles WHERE ID = '$DeleteEntry'";
	    			mysql_query_simple_exequter($sql);
	    			
					$lc_UserID =  $_SESSION['sess_id'];
					createLogg($lc_UserID, $liveConCMS_logg36);
					
					header("Location: liveconintra_index.php");
				    exit;							
					} 
					else
					{
					$sql = "DELETE FROM lc_tbluploadedfiles WHERE ID = '$DeleteEntry'";
	    			mysql_query_simple_exequter($sql);
	    			
					$lc_UserID =  $_SESSION['sess_id'];
					createLogg($lc_UserID, $liveConCMS_logg36);
					
	    			header("Location: liveconintra_index.php");
				    exit;
					}


}



if (isset($_GET['del_noteid']) == "")
{

}
else
{
$DeleteNoteEntry = (int) isset($_GET['del_noteid']) ? $_GET['del_noteid'] : del_noteid('n');

					$sql = "SELECT UserID FROM `lc_tblnoticebord` WHERE noteID ='$DeleteNoteEntry'";
					$result = mysql_query_exequter_with_return($sql);
					while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
					{
					
							$checkUserID = $row["UserID"];
							
					}


					$ID = $_SESSION['sess_id']; 
					if ($ID == $checkUserID)
					{ 
					$sql = "DELETE FROM lc_tblnoticebord WHERE noteID = '$DeleteNoteEntry'";
	    			mysql_query_simple_exequter($sql);
						
					$lc_UserID =  $_SESSION['sess_id'];
					createLogg($lc_UserID, $liveConCMS_logg35);
	    			
				 	header("Location: liveconintra_index.php");
				    exit;						
					}


}




if (isset($_POST['submit_file']))
{


				if(empty($_FILES["DocFile"]['name'])) 
			   {
			
					
			   			  
			   }
			   else
			   {
			 
			   $generatetID = md5(uniqid());
			   mkdir("uploaded/$generatetID", 0777);
				
			   $upload_dir = "uploaded/$generatetID/"; 
				
				$filetypes = 'pdf,PDF,txt,TXT,doc,DOC,docx,DOCX,xlsx,XLSX,mp3,MP3,zip,Zip,xml,XML'; 
				  
				  	$maxsize = (1024*900000); 
				
					if($_FILES["DocFile"]['size'] > $maxsize) 
				      die('$liveConCMS_error_message_4'.(string)($maxsize/1024).' KB.'); 
				      
				        $types = explode(',', $filetypes); 
				   		$file = explode('.', $_FILES["DocFile"]['name']); 
				   		$extension = $file[sizeof($file)-1]; 
						$vartest = "<em> $liveConCMS_error_message_5 </em>";
				   		if(!in_array(strtolower($extension), $types)) 
				        die("$vartest<strong>Pdf, txt, Word, Excel, Mp3, Zip, Xml</strong> <br/> <a href='liveconintra_index.php'>Back</a>"); 
				
						$thefile = $_FILES["DocFile"]['name'];
										
						while (file_exists($upload_dir.$thefile)) 
						{ 
						unlink($upload_dir.$thefile);
						} 
				
				
				 	if (is_uploaded_file($_FILES["DocFile"]['tmp_name']) && move_uploaded_file($_FILES["DocFile"]['tmp_name'],$upload_dir.$thefile)) 
				    { 
				
										
						  $Dagensdatum = date('Y-m-d H:i:s');
						  $filetitle = $_POST['txtTitle'];
						 
						
							$sql = "INSERT INTO lc_tbluploadedfiles (Posted , Title , File) VALUES('$Dagensdatum', '$filetitle', '$upload_dir$thefile')";
							mysql_query_simple_exequter($sql);
							
							$lc_UserID =  $_SESSION['sess_id'];
							createLogg($lc_UserID, $liveConCMS_logg33);
							
 

				    }
				    else
				    {
				      header("Refresh: 0;URL=liveconcms_error.php?error_id = 1");
					  exit; 
				    }   
			   
			   }

}

if (isset($_POST['submit']))
{

$_POST = db_escape($_POST);

 foreach($_POST as $key => $val)
  {
    $_POST[$key] = trim($val);
  }
  
  
$ID = $_SESSION['sess_id']; 
$postNoteTitle = mysql_real_escape_string($_POST['noteTitle']);
$postNoteText = $_POST['noteText'];

$Dagensdatum = date('Y-m-d H:i:s');
$sql = "INSERT INTO lc_tblnoticebord (UserID, notePosted, noteTitle, noteText) VALUES('$ID', '$Dagensdatum', '$postNoteTitle', '$postNoteText')";
mysql_query_simple_exequter($sql);

$lc_UserID =  $_SESSION['sess_id'];
createLogg($lc_UserID, $liveConCMS_logg34);
	
$display_noticemessage = 1;	

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LiveCon CMS - <?PHP echo "$liveConCMS_HtmlTitle_8";?></title>

<!-- Load javascripts for CMS backend -->
<?PHP include("liveconcms_editonpageheader.php");?>

<!-- Load the "simple setup" for Tiny MCE -->
<script type="text/javascript" src="js/mce-simple-setup.js"></script>


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
			$('#freeow').freeow('Sparad', 'Meddelandet är postat på anslagstavlan.', {
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
			
			
			<h1 class="page-title"><?PHP echo "$liveConCMS_PageTitle_7";?></h1>
			<p><?PHP echo "$liveConCMS_pageText6_1";?></p>
			<p><?PHP echo "$liveConCMS_pageText6_2";?></p>
			
			<hr />

			<table class="ui-widget ui-widget-content ui-corner-all tbl-style-1" id="tbl-intra-doc">
				<thead>
					<tr>
						<td class="ui-widget-header ui-corner-tl first-cell"><?PHP echo "$liveConCMS_WindowTitle_23";?></td>
						<td class="ui-widget-header"><?PHP echo "$liveConCMS_WindowTitle_27";?></td>
						<td class="ui-widget-header"><?PHP echo "$liveConCMS_WindowTitle_28";?></td>
						<td class="ui-widget-header ui-corner-tr last-cell"><?PHP echo "$liveConCMS_WindowTitle_26";?></td>
					</tr>
				</thead>
				
			

				<tbody>
				
					<?PHP
					
						$Traffar = "SELECT COUNT(*) FROM `lc_tbluploadedfiles` ORDER BY `Posted` DESC";
						$Restraffar = mysql_query_exequter_with_return($Traffar);
						while ($rowtraffar = mysql_fetch_array($Restraffar, MYSQL_ASSOC))
						{
						$Antal = $rowtraffar["COUNT(*)"];
						}
						
						$newoffset = "";
						// Nu bestämmer vi antal per sida och kollar vi upp totala antalet
						$limit = 5; // Antal per sida
					
						$result = @mysql_query("SELECT count(*) as count FROM `lc_tbluploadedfiles` ORDER BY `Posted` DESC")
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
						  $numlink = '<a class="lc-numlink lc-numlink-first ui-corner-left ui-state-disabled" >&laquo;&laquo;</a> ';
						  $numlink .= '<a class="lc-numlink lc-numlink-prev ui-state-disabled" >&laquo;</a> ';
						}
						 
						// Hämta sidonummer
						for ($i = 1; $i <= $pages; $i++) {
						  $newoffset = $limit*($i-1);
						  if ($start == $newoffset)
							$numlink .= '<a class="lc-numlink lc-numlink-current ui-state-disabled">['.$i.']</a> ';
						  else
							$numlink .= '<a class="lc-numlink lc-numlink-next-link" href="?start='.$newoffset.'">'.$i.'</a> ';
						}
						 
						// Hämta länk till nästa sida
						if ($numrows > ($start + $limit))
						  $numlink .= '<a class="lc-numlink lc-numlink-next" href="?start='.($start + $limit).'">&raquo;</a> ';
						else
						  $numlink .= '<a class="lc-numlink lc-numlink-next ui-state-disabled">&raquo;</a> ';
						 
						// Hämta sista sidan
						if ($start != $newoffset)
						  $numlink .= '<a class="lc-numlink lc-numlink-last ui-corner-right" href="?start='.$newoffset.'">&raquo;&raquo;</a> ';
						else
						  $numlink .= '<a class="lc-numlink lc-numlink-last ui-corner-right ui-state-disabled">&raquo;&raquo;</a>';

					
					
					$sql = "SELECT * FROM `lc_tbluploadedfiles` ORDER BY `Posted` DESC LIMIT $start, $limit";
					$result = mysql_query_exequter_with_return($sql);
					while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
					{
					for($j = 0 ; $j < 1; $j++) 
					{
					$downloadID[$j] = $row["ID"];
					$downloadPosted[$j] = $row["Posted"];
					$downloadTitle[$j] = $row["Title"];
					$downloadFile[$j] = $row["File"];

					
					echo "<tr>";
					echo "	<td class='first-cell'>$downloadPosted[$j]</td>";
					echo "	<td>$downloadTitle[$j]</td>";
					echo "	<td><a class='lc-editItem' href='liveconcms_download.php?id=$downloadID[$j]' title='$OnPageToolTip_13 &quot;$downloadTitle[$j]&quot;'>$OnPageToolTip_13 &quot;$downloadTitle[$j]&quot;</a></td>";
					echo "	<td class='last-cell'><a class='lc-deleteItem' href='liveconintra_index.php?del_id=$downloadID[$j]' title='$OnPageToolTip_9 &quot;$downloadTitle[$j]&quot;'>$OnPageToolTip_9 &quot;$downloadTitle[$j]&quot;</a></td>";		
					echo "</tr>";
					}
					}
					
					?>
					</tbody>
						
			</table>
  
  
  
	<span class="lc-page-switch buttonset"><?PHP echo $numlink; ?></span>
	 

	<hr />

	
    <button id="lc-intra-upload-doc"><?PHP echo "$liveConCMS_intraPopup_1"; ?></button>

      <!--This box is hidden by default. It will popup when choosing "upload"-->
		<div id="lc-intra-upload-dialog" title="<?PHP echo "$liveConCMS_intraPopup_title";?>">
					
						<form id="lc-intra-upload-form" method="post" enctype="multipart/form-data">
							<p><?PHP echo "$liveConCMS_intraPopup_2"; ?></p>
						
							<fieldset>
								<strong><?PHP echo "$liveConCMS_intraPopup_3"; ?></strong>
								<input class="input01" name="txtTitle" type="text" />
								<em><?PHP echo "$liveConCMS_intraPopup_4"; ?></em>
							</fieldset>
								
							<fieldset>
								<strong><?PHP echo "$liveConCMS_intraPopup_5"; ?></strong>
								<input name="DocFile" type="file" />
								<em><?PHP echo "$liveConCMS_intraPopup_6"; ?></em>
							</fieldset>
							<fieldset>
								<input name="submit_file" type="submit" value="Ladda upp" />
							</fieldset>
						</form>
					
		</div>			
		
		

		<hr />


		
		<h2><?PHP echo "$liveConCMS_menuText6_1"; ?></h2>
		<p><?PHP echo "$liveConCMS_pageText6_3"; ?></p>
		

		
        <div id="accordionIntra">         
                
                <?PHP
                
        		$sql = "SELECT * FROM `lc_tblnoticebord`, `lc_tbladministrator` WHERE lc_tblnoticebord.UserID = lc_tbladministrator.ID ORDER BY lc_tblnoticebord.notePosted DESC LIMIT 0,10";
        		$result = mysql_query_exequter_with_return($sql);
        		while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
        		{
        		for($j = 0 ; $j < 1; $j++) 
        		{
        		
        		$noteID[$j] = $row["noteID"];
        		$noteUserID[$j] = $row["UserID"];
        		$notePosted[$j] = $row["notePosted"];
        		$noteTitle[$j] = $row["noteTitle"];
        		
        		$noteFirstname[$j] = $row["Firstname"];
        		$noteLastname[$j] = $row["Lastname"];
        		
        		$noteText[$j] = $row["noteText"];
        
                
        	    echo "	<h3><a href='#'>$noteFirstname[$j] $noteLastname[$j] - <i>$noteTitle[$j]</i></a></h3> ";
				echo "		<div>";      	     
				echo "				$noteText[$j]"; 
				echo "	<hr />";
				echo "	<span>$liveConCMS_menuText6_5 <i>($notePosted[$j])</i></span>";
				echo "	<span class='lc-breaker'> | </span>";
				if($ID == $noteUserID[$j])
        	    {
        	    echo "	<a class='lc-delete-msg' href='liveconintra_index.php?del_noteid=$noteID[$j]'>$liveConCMS_regularbutton_9</a>";  
        	    }

				echo "		</div>";
        		
        		}
        		}
        		
        		?>
             </div>
			
			
			<hr />


			<div class="ui-widget ui-widget-content ui-corner-all" id="tinymce_wrapper">
				<span class="ui-widget-header ui-corner-top ui-helper-clearfix"><h3><?PHP echo "$liveConCMS_WindowTitle_5";?></h3></span>
					<div class="ui-widget-content">
						<form method="post">
							<fieldset>
								<b><?PHP echo "$liveConCMS_menuText6_2";?></b>
								<input name="noteTitle" type="text" />
								<em><?PHP echo "$liveConCMS_menuText6_3";?></em>
							</fieldset>
							<fieldset>
								<strong><?PHP echo "$liveConCMS_menuText6_4";?></strong>
								<textarea name="noteText" cols="80" rows="15" class="input"></textarea>
							</fieldset>
							<fieldset>
								<input name="submit" type="submit" value="<?PHP echo "$liveConCMS_regularbutton_10";?>" />
								<input name="Reset" type="reset" value="<?PHP echo "$liveConCMS_regularbutton_4";?>" />
							</fieldset>						
						</form>
					</div>
			</div><!--MCE Wrapper-->

			
			
	<hr />
	
	
	
	</div> <!-- .bodywrapper -->
	
	
	
	<?PHP include("liveconcms_footer.php");?>
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
</body>

</html>
