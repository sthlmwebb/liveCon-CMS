<?PHP
session_start();
include("header.php");
$languagePath = $_SESSION['sess_language'];
include("../language/$languagePath/language.php");
?>
<div id="lc-changepic-php">
	<form method="post" enctype="multipart/form-data" action="changepic.php?filename=<?PHP echo "$filetoChange"; ?>&filetype=<?PHP echo "$filetype"; ?>">
		<input name="File" type="file" />
		<em>Filformat:<?PHP echo ".$filetype"; ?> </em>
		<input name="submit" type="submit" value="ladda upp" />
	</form>
                         
</body>

</div>