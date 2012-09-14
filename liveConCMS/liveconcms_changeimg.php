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

	header('Content-Type: text/html; charset=iso-8859-1'); 
	Header('Cache-Control: no-cache');
	Header('Pragma: no-cache');
	$languagePath = $_SESSION['sess_language'];
	include("core/language/$languagePath/language.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="js/jquery-ui.1.8.11-min.js" type="text/javascript"></script>
<script src="js/lc-core.php" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="skins/reset.css">
<link rel="stylesheet" type="text/css" href="skins/styles.php">

<style>
	body#lc-changeimg {
		background:transparent;
		padding:0;
		margin:0;
		border:none;
		height:100%;
		width:100%;
		overflow:hidden;
	}
	
	#lc-changeimg .lc-filethree {
		width:290px;
		height:290px;
		display:inline-block;
		float:left;
		overflow:scroll;
		border:1px solid #c2c2c2;
		padding:5px;
	}
	
	body#lc-changeimg .lc-thumb-preview {
		width:630px;
		height:300px;
		display:inline-block;
		float:right;
		background:#fff;
		overflow:hidden;
		border:1px solid #c2c2c2;
	}
	
	body#lc-changeimg .lc-thumb-preview img {
		max-width:620px;
		max-height:290px;
	}
	
	table#lc-changeimg-form textarea {
		width:500px;
		margin:0;
		padding:3px;
	}
	table#lc-changeimg-form input {
		margin:0;
		padding:3px;
	}
	
	table#lc-changeimg-form tr td  {
		vertical-align:middle;
		padding-bottom:3px;
	}
	
	table#lc-changeimg-form tr td:first-child  {
		width:300px;
	}	
	
	table#lc-changeimg-form input[name="lc-img-x"],
	table#lc-changeimg-form input[name="lc-img-y"] {
		width:50px;
		display:inline-block;
		float:left;
		margin-right:5px;
	}

</style>
<script type="text/javascript">
	lcChangeImg = {
		init: function () {
			$(".lc-filethree ul").lcfileTree();	
			this.selectImg();
		}, 	
		selectImg: function() {
			var imgContainer = $(".lc-thumb-preview");
			$(".lc-filethree ul li a").click(function(e){	
				e.preventDefault();
				var newImgSrc = $(this).attr('href');
				var $element = $(this);
				
				$(".lc-thumb-preview img").remove();		
				$(".lc-thumb-preview").lcLoadImg(newImgSrc, function(){
					$("#lc-change-img-realimg").remove();
					$(this).clone().appendTo('.hidden').css({'display':'none'}).attr('id','lc-change-img-realimg');
					var img = $("#lc-change-img-realimg");
					var imgWidth = img.width();
					var imgHeight = img.height();
					$(this).objCenter(".lc-thumb-preview");
					
					$("input[name=lc-img-x]").val(imgWidth);
					$("input[name=lc-img-y]").val(imgHeight);
				});
				$("input[name=lc-img-src]").val(newImgSrc);
				return false;				
			});	
		}
	};
	
	
	
	$(document).ready(function(){
		$( "#lc-tabs" ).tabs();
		lcChangeImg.init();
	});
</script>
</head>

<body id="lc-changeimg" class="lc-body">
	<div id="lc-tabs">
		<ul>
			<li><a href="#tabs-1"><?PHP echo "$liveconcms_changeimgtext1"; ?></a></li>
			<li><a href="#tabs-2"><?PHP echo "$liveconcms_changeimgtext2"; ?></a></li>
		</ul>	
		
		<div id="tabs-1">
			<div class="lc-filethree ui-corner-all">
			
				<?php
					$path = "../liveConCMS/uploaded/";
										
					function createDir($path = '.')
					{	
					$queue = "";
						if ($handle = opendir($path)) 
						{
							echo "<ul class='lc-browser-list'>";
						
							while (false !== ($file = readdir($handle))) 
							{
								if (is_dir($path.$file) && $file != '.' && $file !='..')
								printSubDir($file, $path, $queue);
								else if ($file != '.' && $file !='..')
									$queue[] = $file;
							}
								
							printQueue($queue, $path);
							echo "</ul>";
						}
					}
										
					function printQueue($queue, $path)
					{
						if ($queue != "")
						{
							foreach ($queue as $file) 
							{
								printFile($file, $path);
							}
						}						
					}
										
					function printFile($file, $path)
					{
						echo "<li class='lc-browser-file'><a class=\"lc-browser-file-link ui-corner-all\" href=\"".$path.$file."\"><span title='$path$file'>$file</span></a></li>";
					}
						
					function printSubDir($dir, $path)
					{
						if($dir != "liveConCMS")
						{
							echo "<li class='lc-browser-folder'><span title='$path$dir' class=\"lc-folder-title ui-corner-all\">$dir</span>";
							createDir($path.$dir."/");
							echo "</li>";
						}	
					}
							
					createDir($path);
				?>
			
			</div>
			<div class="lc-thumb-preview ui-corner-all"></div>
		</div>
		
		<div id="tabs-2"></div>	
	</div>

			<div class="lc-img-form">
				<table class="ui-widget" id="lc-changeimg-form">
					<tbody>
						<tr>
							<td><?PHP echo "$liveconcms_changeimgtext3"; ?></td>
							<td><input type="text" name="lc-img-src" value="." /></td>
						</tr>
						
						<tr>
							<td><?PHP echo "$liveconcms_changeimgtext4"; ?></td>
							<td><textarea name="lc-img-alt"></textarea></td>
						</tr>
						
						<tr>
							<td><?PHP echo "$liveconcms_changeimgtext5"; ?></td>
							<td><input type="text" name="lc-img-x" value="0" /><input type="text" name="lc-img-y" value="0" /></td>
						</tr>
					</tbody>
				</table>

				<form id="lc-form" method="post" target="_parent" action="ThisWillGetReplaced.php">
					<textarea name="TextArea1" id="TextArea1" style="display:none;"></textarea>
					<input name="lc_submit" type="submit" value="submit" style="display:none;" />
				</form>
				
			</div>
			<div class="hidden"></div>

</body>
</html>