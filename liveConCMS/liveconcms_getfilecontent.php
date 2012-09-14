<?PHP
header('Content-Type: text/html; charset=iso-8859-1'); 

$filetograb = $_POST['get_filename'];
GetFileContent($filetograb);


function GetFileContent($Filename)
{
$file = file_get_contents($Filename); 
$file = replacePHPToken($file);

if($file == "")
{
echo "Error";
}
else
{
echo $file;
}

}

function replacePHPToken($phrase)
{
$chars = array("<?PHP");
$correctHTML  = array("<?php");
$newphrase = str_replace($chars, $correctHTML, $phrase);

return $newphrase;
}



?>