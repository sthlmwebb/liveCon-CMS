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
$languagePath = $_SESSION['sess_language'];
include("core/language/$languagePath/language.php");


if (isset($_GET['id']) == "")
{
header("Location: liveconintra_index.php");
exit;
}
else
{
$DownloadID = (int) isset($_GET['id']) ? $_GET['id'] : id('n');
	
	$sql = "SELECT * FROM `lc_tbluploadedfiles` WHERE ID = '$DownloadID'";
	$result = mysql_query_exequter_with_return($sql);
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
	$downloadFile = $row["File"];
	}
	
}

					
$path = "$downloadFile";

if ($fd = fopen ($path, "r")) {
    $fsize = filesize($path);
    $path_parts = pathinfo($path);
    $ext = strtolower($path_parts["extension"]);
    switch ($ext) {
        case "zip":
        header("Content-type: application/zip"); // add here more headers for diff. extensions
        header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a download
        break;
		case "txt":
        header("Content-type: application/txt"); // add here more headers for diff. extensions
        header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a download
        break;
		case "doc":
        header("Content-type: application/doc"); // add here more headers for diff. extensions
        header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a download
        break;
		case "docx":
        header("Content-type: application/docx"); // add here more headers for diff. extensions
        header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a download
        break;
		case "xlsx":
        header("Content-type: application/xlsx"); // add here more headers for diff. extensions
        header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a download
        break;
		case "pdf":
        header("Content-type: application/pdf"); // add here more headers for diff. extensions
        header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a download
        break;
        default;
        header("Content-type: application/octet-stream");
        header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
    }
    header("Content-length: $fsize");
    header("Cache-control: private"); //use this to open files directly
    while(!feof($fd)) {
        $buffer = fread($fd, 2048);
        echo $buffer;
    }
}
fclose ($fd);
exit;
?>