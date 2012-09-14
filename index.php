<?PHP
if (file_exists("liveConCMS/core/include/dbConnectionString.php")) 
{
$Installed = true;
include("liveConCMS/core/liveconcms_header.php");
include("liveConCMS/core/liveconcms_core.php");
liveConCMS_PageID($liveconCMSPage);
}
else
{
$Installed = false;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>liveCon CMS</title>
<link href="liveConCMS/skins/reset.css" rel="stylesheet" type="text/css" />
<link href="liveConCMS/skins/styles.php" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="liveConCMS/js/jquery-1.4.2.min.js"></script>

<script type="text/javascript">
	//Function to center a object on screen.
(function($){
     $.fn.extend({
          center: function () {
                return this.each(function() {
                        var top = ($(window).height() - $(this).outerHeight()) / 2;
                        var left = ($(window).width() - $(this).outerWidth()) / 2;
                        $(this).css({position:'absolute', margin:0, top: (top > 0 ? top : 0)+'px', left: (left > 0 ? left : 0)+'px'});
                });
        }
     });
})(jQuery);

	$(document).ready(function(){
		//Center .bodywrapper
		$('.bodywrapper').center();
	});
</script>
	
<?PHP 
if ($Installed)
{
liveConCMS_setHeader($edit);
}
?>
	
</head>

<body id="lc-splashscreen" class="lc-body">
<?PHP 
if ($Installed)
{
liveConCMS_setAdminPanel(); 
}
?>

<div class="bodywrapper container_12">
	<img src="liveConCMS/skins/images/big-lc-logo.png" />
	<?PHP
	if ($Installed)
	{
	echo "<span>liveCon CMS is installed</span>";
	echo "<br />";
	echo "<br />";
	echo "<a class='lc-link' href='admin.php'>Click here to login</a>";
	}
	else
	{
	echo "<span>liveCon CMS is not installed!</span>";
	echo "<br />";
	echo "<br />";
	echo "<a class='lc-link' href='Install/'>Click here to install</a>";
	}
	?>
</div>
</body>

<?PHP 
if ($Installed)
{
liveConCMS_BottomContent($edit);
}
?>
</html>