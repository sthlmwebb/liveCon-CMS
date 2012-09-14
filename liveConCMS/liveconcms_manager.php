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
checkRole($_SESSION['sess_role'], 'liveconcms_manager');
$sitelanguage = $_SESSION['sess_sitelanguage'];

if (!isset($_SESSION['sess_undo']))
{
$_SESSION['sess_undo'] = ""; 
$_SESSION['sess_undofile'] = ""; 
}

if (isset($_POST['submit_filetext']))
{
	$Text = $_POST['codeHilighter'];
	$hiddenfilename = $_POST['filename'];
	
	$file = file_get_contents($hiddenfilename); 

	IF($Text == "" || $hiddenfilename == "")
	{
	}
	else
	{
	
	$fp = fopen($hiddenfilename, 'w');
	$_SESSION['sess_undo'] = $file;
	$_SESSION['sess_undofile'] = $hiddenfilename; 
	fwrite($fp, $Text);
	fclose($fp);
	}
	
	$display_noticemessage = 1;
}


if (isset($_POST['submit_undo']))
{

    $UndoText = $_SESSION['sess_undo'];
	
	
	$hiddenfilename = $_SESSION['sess_undofile'];
	

    $fp = fopen($hiddenfilename, 'w');
	
	fwrite($fp, $UndoText);
	fclose($fp);
	
	$_SESSION['sess_undo'] = "";
	$_SESSION['sess_undofile'] = "";
	
	header("Refresh: 0;URL=liveconcms_manager.php");
	exit;
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LiveCon CMS</title>

<!-- Load javascripts for CMS backend -->
<?PHP include("liveconcms_editonpageheader.php");?>

<!-- Load the stylesheets used by the CMS -->
<link rel="stylesheet" type="text/css" href="skins/reset.css">
<link rel="stylesheet" type="text/css" href="skins/styles.php">

<script src="js/codehighlighter/codemirror.js" type="text/javascript"></script>
<script type="text/javascript" src="js/multiuploader/swfupload.js"></script>
<script type="text/javascript" src="js/multiuploader/swfupload.queue.js"></script>
<script type="text/javascript" src="js/multiuploader/fileprogress.js"></script>
<script type="text/javascript" src="js/multiuploader/handlers.js"></script>

<script type="text/javascript">
var swfu;

function multiuploader(path) {
	var settings = {
	
	flash_url : "js/multiuploader/swfupload.swf",
	upload_url: "liveconcms_multiupload.php",
	post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
	post_params: {"PHPtest" : path},
	file_size_limit : "10 MB",
	file_types : "*.*",
	file_types_description : "All Files",
	file_upload_limit : 100,
	file_queue_limit : 0,
	custom_settings : {
		progressTarget : "fsUploadProgress",
		cancelButtonId : "btnCancel"
	},
	debug: false,

	// Button settings
	button_image_url : "images/SmallSpyGlassWithTransperancy_17x18.png",
	button_placeholder_id : "upl-placeholderbutton",
	button_width: 180,
	button_height: 20,
	button_text : '<span class="button">Klicka här för att välja filer</span>',
	button_text_style : '.button { font-family: Trebuchet MS, Helvetica, sans-serif; font-size: 12pt; }',
	button_text_top_padding: 0,
	button_text_left_padding: 10,
	button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
	button_cursor: SWFUpload.CURSOR.HAND,



	// The event handler functions are defined in handlers.js
	file_queued_handler : fileQueued,
	file_queue_error_handler : fileQueueError,
	upload_start_handler : uploadStart,
	upload_progress_handler : uploadProgress,
	upload_error_handler : uploadError,
	upload_success_handler : uploadSuccess,
	upload_complete_handler : uploadComplete,
	queue_complete_handler : queueComplete	// Queue plugin event
	};

	swfu = new SWFUpload(settings);
};
 
function createFolder(title){
	$("#lc-dialog").remove();
	$("body").append('<div id="lc-dialog" \/>');
	$("#lc-dialog").dialog({
		title: title,
		modal: true,
		autoOpen: false,
		width:'500px',
		height:'auto',
		beforeClose: function(){
			$(this).dialog('destroy');
		}
	});

	
	$("#lc-dialog").load('liveconcms_manager_createfolder.php', function() {
	
		$("#lc-dialog .lc-browser-list:first-child").before('<li id="lc-filetree-root" class="lc-browser-file"><span title="../" class="lc-folder-title ui-corner-all" style="cursor: pointer;">../</span></li>');
					
		$("#lc-dialog .lc-tabs").tabs();
		$("#lc-dialog").dialog('open');
		$("#lc-dialog .lc-tabs").tabs('select', 0);
		$("#lc-dialog .lc-tabs").tabs({ disabled: [1] });		
		
		$("input[name=lc_manager_createfolder_name]").keyup(function () {
			var fileName = $(this).val();
			if ( fileName.length === 0 ) {
				$("#lc-dialog").dialog({
					buttons: {
							"Nästa steg": function() 
							{
								$("input[name=lc_manager_createfolder_name]").toggleClass( "ui-state-error", 500 );
							},	
							"Avbryt": function() 
							{
								$("#lc-dialog").remove();							
							}								
					}
				});
			}
			else {
				$("#lc-dialog").dialog({
					buttons: {
							"Nästa steg": function() 
							{
								$("#lc-dialog .lc-tabs").tabs({ disabled: [] });
								$("input[name=lc_manager_createfolder-name]").removeClass('ui-state-error');
								$("#lc-dialog .lc-tabs").tabs('select', 1);
								
								/*Create submit button*/
								$("#lc-dialog").dialog({ buttons: 
									{ 
										"Slutför" : function() 
										{ 
											$("#lc-dialog").find('input[name=submit_mapp]').trigger('click');
										},
										"Avbryt": function() 
										{
											$("#lc-dialog").remove();							
										}											
									} 
								});
							},
							"Avbryt": function() 
							{
								$("#lc-dialog").remove();							
							}								
					}
				});
			}			
		}).keyup();
		
		$(".lc-browser-file-link").click(function(e){
			e.preventDefault();
			$("input[name=lc_manager_createfolder_location]").addClass( "ui-state-error", 500 );
			$("input[name=lc_manager_createfolder_location]").val('Du kan ej välja en fil');
		});
		
		$("span.lc-folder-title").click(function(e) {
			$("input[name=lc_manager_createfolder_location]").removeClass( "ui-state-error" );
			var path = $(this).attr('title');
			$("input[name=lc_manager_createfolder_location]").val(path);		
		});		
		

		
	});
	return false;
}

function uploadFile(title){
	$("#lc-dialog").remove();
	$("body").append('<div id="lc-dialog" \/>');
	$("#lc-dialog").dialog({
		title: title,
		modal: true,
		autoOpen: false,
		width:'500px',
		height:'auto',
		beforeClose: function(){
			$(this).dialog('destroy');
		}
	});

	
	$("#lc-dialog").load('liveconcms_manager_uploadfile.php', function() {
	
		$("#lc-dialog .lc-browser-list:first-child").before('<li id="lc-filetree-root" class="lc-browser-file"><span title="../" class="lc-folder-title ui-corner-all" style="cursor: pointer;">../</span></li>');
	
		$("#lc-dialog .lc-tabs").tabs();
		$("#lc-dialog").dialog('open');
		$("#lc-dialog .lc-tabs").tabs('select', 0);
		$("#lc-dialog .lc-tabs").tabs({ disabled: [1] });
				
				
		$(".lc-browser-file-link").click(function(e){
			e.preventDefault();
			$("input[name=lc_manager_uploadfile_location]").addClass( "ui-state-error", 500 );
			$("input[name=lc_manager_uploadfile_location]").val('Du måste välja en mapp');
		});
		
		$("span.lc-folder-title").bind('click', function(e) {
			$("input[name=lc_manager_uploadfile_location]").removeClass( "ui-state-error" );
			var path = $(this).attr('title');
			$("input[name=lc_manager_uploadfile_location]").val(path);		
		});	

		$("#lc-dialog").dialog({ 
		buttons: { 
				"Nästa steg" : function() { 
					var path = $("input[name=lc_manager_uploadfile_location]").val();
					if ( path.length === 0 ) { 
						$("input[name=lc_manager_uploadfile_location]").toggleClass( "ui-state-error", 500 );
					}
					else { 
					
						/*Execute multiuploader and set path*/
						var path = $("input[name=lc_manager_uploadfile_location]").val();
						multiuploader(""+path+"/");		

						$("#lc-dialog .lc-tabs").tabs({ disabled: [] }); 				
						$("input[name=lc_manager_createfolder_name]").removeClass( "ui-state-error" );						
						$("#lc-dialog .lc-tabs").tabs('select', 1);											
							$("#lc-dialog").dialog({ buttons: { 
									"Ladda upp" : function() { 
										/*Upload files*/
										swfu.startUpload();
									},
									"Stäng fönstret": function(){
										$("#lc-dialog").dialog('close').remove();							
									}											
								} 
							});						
					}
				},
				"Avbryt": function() {
					$("#lc-dialog").remove();							
				}											
		} 
		});
		


	});
	return false;
}

function fullscreen(){			
	var fullwidth = '916px';
	var codeWidth = $("#lc-code-container").width();				
	
	if (codeWidth == '660') {
		$("#lc-filetree").toggle();	
		$("#lc-code-container").css({
			width:fullwidth
		});
	}
	else {
		$("#lc-filetree").toggle();	
		$("#lc-code-container").css({
			width:'660px'
		});				
	}	
}
</script>


<?PHP
if (isset($display_noticemessage))
{
	echo "<script type='text/javascript'>
		$(document).ready(function(){
			$('body').append('<div id=\"freeow\"></div>');
			$('#freeow').freeow('$liveconcms_noticepopuptext3', '$liveconcms_noticepopuptext4', {
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
		<h1 class="page-title"><?PHP echo "$liveconcms_filebrowser1"; ?></h1>
		<p><?PHP echo "$liveconcms_filebrowser2"; ?></p>
		<hr />
				
			<div class="ui-widget ui-widget-content ui-corner-all" >
				<span class="ui-widget-header ui-corner-top ui-helper-clearfix"><h3><?PHP echo "$liveconcms_filebrowser3"; ?></h3></span>
				
					<div class="lc-toolbar">
						<button class="lc-toolbar-maximize" title="Maximera kodfönstret"><?PHP echo "$liveconcms_filebrowser4"; ?></button>
						<span class="lc-toolbar-split">|</span>
						<button class="lc-toolbar-code-save" title="Spara filen"><?PHP echo "$liveconcms_filebrowser5"; ?></button>	
						<?PHP
						if ($_SESSION['sess_undo'] != "")
						{						
						echo "<button class=\"lc-toolbar-code-revert\" title=\"$liveconcms_filebrowser8\">Revert code</button>";
						}
						else
						{
						echo "<button disabled=\"disabled\" class=\"lc-toolbar-code-revert\" title=\"$liveconcms_filebrowser8\">Revert code</button>";
						}
						?>						
						<span class="lc-toolbar-split">|</span>
						<button class="lc-toolbar-createfolder" title="Skapa mapp på servern"><?PHP echo "$liveconcms_filebrowser6"; ?></button>
						<button class="lc-toolbar-uploadfile" title="Ladda upp fil"><?PHP echo "$liveconcms_filebrowser7"; ?></button>						
					</div>
					
					<div class="ui-widget-content">				
						<div id="lc-filetree"></div>	
						
						<div id="lc-code-container"></div>
						
												

					
					</div>
			</div>
						<form id="lc-code-form" method="Post">
							<fieldset>
								<textarea id="lc-code-new" style="display:none;" name="codeHilighter"></textarea>
								<input type="text" value="" name="filename" style="display:none;" />
								<input type="submit" name="submit_filetext" value="Spara"  style="display:none;" />
								
								<?PHP
								if ($_SESSION['sess_undo'] != "")
								{
								echo "<input name='submit_undo' type='submit' value='$liveconcms_filebrowser9' style='display:none;' />";
								}
								?>
								
								
							</fieldset>
						</form>							
	</div><!-- .bodywrapper -->
	
	<hr />
	
	<?php include("liveconcms_footer.php"); ?>

	
<script>
/*Document ready*/
$(function () {

$(".lc-toolbar button.lc-toolbar-maximize").button({
            icons: {primary: "ui-icon-arrow-4-diag"},
			text: false
});

$(".lc-toolbar button.lc-toolbar-createfolder").button({
            icons: {primary: "ui-icon-folder-collapsed"},
			text: false			
}).click(function(){
	var elmtitle = $(this).text();
	createFolder(elmtitle);
	});

$(".lc-toolbar button.lc-toolbar-uploadfile").button({
            icons: {primary: "ui-icon-document"},
			text: false			
}).click(function(){
	var elmtitle = $(this).text();
	uploadFile(elmtitle);
	});
	
$(".lc-toolbar button.lc-toolbar-code-save").button({
            icons: {primary: "ui-icon-disk"},
			text: false		
});

$(".lc-toolbar button.lc-toolbar-code-revert").button({
            icons: {primary: "ui-icon-transfer-e-w"},
			text: false	
});

$(".lc-toolbar-maximize").bind('click', function(){
	fullscreen();
});	
	
$("#lc-filetree").load('liveconcms_filetree.php', function(){
	$("#lc-filetree ul").lcfileTree();
	$("#lc-filetree ul li a").click(function(loadFile){
	
		loadFile.preventDefault();
		
		$("#lc-code").remove();	
		$(".CodeMirror-wrapping").remove();
		$("#lc-code-container img").remove();
		
		var href = $(this).attr('href');	
		var fileExt = $(this).attr('href').split('.').pop().toLowerCase();
		
		if ( fileExt == "png" ){ loadImg() }
		else if ( fileExt == "jpg" ){ loadImg() }
		else if ( fileExt == "jpeg" ){ loadImg() }
		else if ( fileExt == "gif" ){ loadImg() }
					
		else if ( fileExt == "php") { loadCode() }
		else if ( fileExt == "html") { loadCode() }
		else if ( fileExt == "htm") { loadCode() }
		else if ( fileExt == "css") { loadCode() }
		else if ( fileExt == "js") { loadCode() }
		else if ( fileExt == "txt") { loadCode() }
		
		else {lcErrorPopup('manager-1')}
		
		function loadImg(){			
			$("#lc-code-container img").remove();	

			$("#lc-code-container").lcLoadImg(href, function(){		
				$("#lc-code-container img").css({
					'max-width':'400px'
				});		
				$(this).objCenter();
				
			});
		}

		function loadCode(){		
			$("input[name=filename]").val(href);
			$("#lc-code-container").append('<p class="lc-loading">Laddar</p>');
			$(".lc-loading").objCenter();
			$.ajax({
				type: "POST",
				url: "liveconcms_getfilecontent.php",
				data: "get_filename="+href,
				success: function(msg){	
					
					$("#lc-code-container").append('<textarea id="lc-code"></textarea>');
					$("#lc-code").text(msg);
															
					var editor = CodeMirror.fromTextArea('lc-code', {
						height: "400px",
						parserfile: ["parsexml.js", "parsecss.js", "tokenizejavascript.js", "parsejavascript.js",
									 "tokenizephp.js", "parsephp.js", "parsephphtmlmixed.js"],
						stylesheet: ["skins/codehighlighter/xmlcolors.css", "skins/codehighlighter/jscolors.css", "skins/codehighlighter/csscolors.css", "skins/codehighlighter/phpcolors.css"],
						path: "js/codehighlighter/",
						continuousScanning: 500,
						lineNumbers: true,
						onLoad: function(){
							$(".lc-loading").remove();
						}
					});
								
					
					$(".lc-toolbar-code-save").click(function(){
						var newCode = editor.getCode();
						$("#lc-code-new").text(newCode);					
						$("input[name='submit_filetext']").trigger('click');
					});	
					
					$("#lc-code-form").submit(function(){
						var newCode = editor.getCode();
						$("#lc-code-new").text(newCode);					
					});
					
					$(".lc-toolbar-code-revert").click(function(){		
						$("input[name='submit_undo']").trigger('click');
					});						
				},
				error: function() {
					lcErrorPopup('manager-2');
				}
			});
		}
								

	});

});


		
});
</script>
	
</body>
</html>