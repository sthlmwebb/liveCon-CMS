<?PHP
session_start();
include("header.php");
$languagePath = $_SESSION['sess_language'];
include("../language/$languagePath/language.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>liveCon CMS - <?PHP echo "$liveConCMS_HtmlTitle_16";?></title>
<link rel="stylesheet" type="text/css" href="../../../liveConCMS/skins/admin.css" />
<style type="text/css">
.style1 {
	font-size: x-small;
}
</style>
</head>

<body>
<div id="done">
<img src="../../skins/images/icon_info.png" width="64" height="64" />
<p><?PHP echo "$liveConCMS_changePicture_5"; ?></p>
<br>
<p class="style1"><a href="done.php?close=1"><?PHP echo "$liveConCMS_changePicture_6"; ?></a></p>
</div>
</body>

</html>
