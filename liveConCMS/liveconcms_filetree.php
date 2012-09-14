<?PHP 
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
?>
 
<?php
	$path = "../";
						
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