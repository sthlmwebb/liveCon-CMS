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
include("core/include/rsslib.php");
include("core/liveconcms_systemcore.php");
include("core/liveconcms_systemheader.php");

$languagePath = $_SESSION['sess_language'];
include("core/language/$languagePath/language.php");
liveConCMS_SystemPageID('.','..','0','1','0','index.php','system');
checkRole($_SESSION['sess_role'], 'liveconcms_startpage');	
function replaceWord($phrase)
{
$chars = array("å", "ä", "ö", "Å", "Ä", "Ö", "'");
$correctHTML  = array("&aring;", "&auml;", "&ouml;", "&Aring;", "&Auml;", "&Ouml;", "&quot;");
$newphrase = str_replace($chars, $correctHTML, $phrase);

return $newphrase;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?PHP echo "$liveconcms_startpagetext1"; ?></title>

<!-- Load javascripts for CMS backend -->
<?PHP include("liveconcms_editonpageheader.php");?>

<!-- Stylesheets for the CMS -->
<link rel="stylesheet" type="text/css" href="skins/reset.css">
<link rel="stylesheet" type="text/css" href="skins/styles.php">

</head>

<body class="lc-body">
<?PHP
include("liveconcms_panel.php");
?>

<div class="bodywrapper container_12">
				
			<h1 class="page-title"><?PHP echo "$liveconcms_startpagetext2"; ?></h1>
			<p><?PHP echo "$liveconcms_startpagetext3"; ?></p>
			
		
		
			<div class="clear"></div>		
			<hr />
			
	

			<div class="grid_4 alpha">
				<div class="lc-startpage-quicklinks ui-corner-all">
					<a href="../index.php">
						<img src="skins/images/startpage_browse.png" />
						<h3><?PHP echo "$liveconcms_startpagetext4"; ?></h3>
						<p><?PHP echo "$liveconcms_startpagetext5"; ?></p>
					</a>
				</div>
			</div>
			
			<div class="grid_4">			
				<div class="lc-startpage-quicklinks ui-corner-all">
					<a href="liveconcms_menus.php">
						<img src="skins/images/startpage_pages.png" />
						<h3><?PHP echo "$liveconcms_startpagetext6"; ?></h3>
						<p><?PHP echo "$liveconcms_startpagetext7"; ?></p>
					</a>				
				</div>
			</div>
			
			<div class="grid_4 omega">			
				<div class="lc-startpage-quicklinks ui-corner-all">
					<a href="liveconcms_writenews.php">
						<img src="skins/images/startpage_news.png" />
						<h3><?PHP echo "$liveconcms_startpagetext8"; ?></h3>
						<p><?PHP echo "$liveconcms_startpagetext9"; ?></p>
					</a>				
				</div>					
			</div>					

			
			
			<div class="clear"></div>		
			<hr />
	

			<div class="grid_12 alpha omega">
				<div class="ui-widget ui-widget-content ui-corner-all" id="lc-newsfeed">
					<span class="ui-widget-header ui-corner-top ui-helper-clearfix"><h3><?PHP echo "$liveconcms_startpagetext10"; ?></h3></span>
						<div class="ui-widget-content">
							<?PHP
							echo replaceWord(RSS_Display("http://www.sthlmwebbproduktion.se/rss/rss_feed.xml", 15));
							?>
						</div>		
				</div>		
			</div>		
			<div class="clear"></div>		
			
			<hr />

			<span class="grid_12 alpha omega"><p><img src="skins/images/RSS_16px.png" style="vertical-align:middle;"/> <?PHP echo "$liveconcms_startpagetext11"; ?><a href="#" class="lc-link"> <?PHP echo "$liveconcms_startpagetext12"; ?></a></p></span>
			
			<div class="clear"></div>		
			<hr />
	
	
	
</div>
	
	
	
	<?PHP include("liveconcms_footer.php");?>

	
	
</body>

</html>
