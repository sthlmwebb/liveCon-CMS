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

$Path = $_SESSION['sess_liveConCMSPageIndex'] [0];
?>
<!--	
	Javascripts used by the CMS backend. Not on the actuall site.
	Do not make any changes in this file.
	Note: Theres a couple of javascript that gets loaded directly from the php files.
-->
<script src="<?PHP echo $Path; ?>/js/jquery.js" type="text/javascript"></script>
<script src="<?PHP echo $Path; ?>/js/lc-core.php" type="text/javascript"></script>
<script src="<?PHP echo $Path; ?>/js/jquery.freeow.min.js" type="text/javascript"></script>
<script>
if (typeof jQuery != 'undefined') { 
}else{
		document.write('<script src="<?PHP echo $Path; ?>/js/jquery-1.4.2.min.js" type="text/javascript"><\/script>');		
}


if (typeof jQuery.tools != 'undefined') {
  
}else{
     document.write('<script src="<?PHP echo $Path; ?>/js/jquery-tools-min.js" type="text/javascript"><\/script>');
}


if (typeof jQuery().editInPlace != 'undefined') {
   
}else{
document.write('<script src="<?PHP echo $Path; ?>/js/jquery.editinplace.js" type="text/javascript"><\/script>');
document.write('<script src="<?PHP echo $Path; ?>/js/editinplace.js" type="text/javascript"><\/script>');
}

if (typeof jQueryui != 'undefined') {
 
 
}else{
   document.write('<script src="<?PHP echo $Path; ?>/js/jquery-ui.1.8.11-min.js" type="text/javascript"><\/script>');
   document.write('<script src="<?PHP echo $Path; ?>/js/jqueryload.js" type="text/javascript"><\/script>');
   document.write('<script src="<?PHP echo $Path; ?>/js/lc-jqueryload-client.js" type="text/javascript"><\/script>');
   document.write('<script src="<?PHP echo $Path; ?>/js/tooltip.js" type="text/javascript"><\/script>');  
}

if (typeof tinymce != 'undefined') {
 
 
}else{
 
   document.write('<script src="<?PHP echo $Path; ?>/js/tiny_mce/tiny_mce.js" type="text/javascript"><\/script>');
   
 
}

</script>

<?PHP
  echo "<link rel='stylesheet' type='text/css' href='liveConCMS/skins/styles.php' />\n";
  echo "<link rel='stylesheet' type='text/css' href='liveConCMS/skins/adminpanel.css' />\n";
  echo "<link rel='stylesheet' type='text/css' href='liveConCMS/skins/onpage.css' />\n";
  echo "<link rel='stylesheet' type='text/css' href='liveConCMS/skins/jquery-ui/jquery-ui-1.8.4.custom.css' />\n";
?>