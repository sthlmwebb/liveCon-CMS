<?php
session_start();
/*
 * Another In Place Editor - a jQuery edit in place plugin
 *
 * Copyright (c) 2009 Dave Hauenstein
 *
 * License:
 * This source file is subject to the BSD license bundled with this package.
 * Available online: {@link http://www.opensource.org/licenses/bsd-license.php}
 * If you did not receive a copy of the license, and are unable to obtain it,
 * email davehauenstein@gmail.com,
 * and I will send you a copy.
 *
 * Project home:
 * http://code.google.com/p/jquery-in-place-editor/
 *
 */
 
// sleep for a half or a second
// for demonstrating the 'saving...' functionality on the front end
usleep(1000000 * .5);

/*
 * These are the default parameters that get to the server from the in place editor
 *
 * $_POST['update_value']
 * $_POST['element_id']
 * $_POST['original_html']
 *
*/

/*
 * since the in place editor will display whatever the server returns
 * we're just going to echo out what we recieved. In reality, we can 
 * do validation and filtering on this value to determine if it was valid
*/


include("dbConn.php");



$value = replaceWord($_POST['update_value']);
$elementID = $_POST['element_id'];
echo $_POST['update_value'];


IF (substr($elementID, 0, 1) == "M")
{

$uppdateringsID = substr($elementID, 1);

$sql = "UPDATE lc_tblmeny 
        SET MenyText= '$value'
        Where ID = '$uppdateringsID'"; 
        mysql_query($sql) or die('Query failed: ' . mysql_error());

}
elseif(substr($elementID, 0, 1) == "S")
{

$uppdateringsID = substr($elementID, 1);

$sql = "UPDATE lc_tblsubcat 
        SET SubText= '$value'
        Where SubID = '$uppdateringsID'"; 

        mysql_query($sql) or die('Query failed: ' . mysql_error());

}
elseif(substr($elementID, 0, 1) == "H")
{
$sitelanguage = $_SESSION['sess_sitelanguage'];
$uppdateringsID = substr($elementID, 1);

$sql = "UPDATE lc_tblheadertext
        SET headerTitle ='$value'
        Where headerID = '$uppdateringsID' AND LanguageID = '$sitelanguage'"; 

        mysql_query($sql) or die('Query failed: ' . mysql_error());


}
elseif(substr($elementID, 0, 1) == "E")
{
$sitelanguage = $_SESSION['sess_sitelanguage'];
$uppdateringsID = substr($elementID, 1);

$value = nl2br($value);
$sql = "UPDATE lc_tblheadertext 
        SET headerText ='$value'
        Where headerID = '$uppdateringsID' AND LanguageID = '$sitelanguage'"; 

        mysql_query($sql) or die('Query failed: ' . mysql_error());
}
elseif(substr($elementID, 0, 1) == "T")
{

$uppdateringsID = substr($elementID, 1);

$sql = "UPDATE lc_tblpages
        SET pageTitle='$value'
        Where ID = '$uppdateringsID'"; 

        mysql_query($sql) or die('Query failed: ' . mysql_error());
}
elseif(substr($elementID, 0, 1) == "K")
{

$uppdateringsID = substr($elementID, 1);


$sql = "UPDATE lc_tblpages
        SET pageText ='$value'
        Where ID = '$uppdateringsID'"; 
		
		echo $sql;

}



function replaceWord($phrase)
{
$chars = array("å", "ä", "ö", "Å", "Ä", "Ö", "'");
$correctHTML  = array("&aring;", "&auml;", "&ouml;", "&Aring;", "&Auml;", "&Ouml;", "&quot;");
$newphrase = str_replace($chars, $correctHTML, $phrase);

return $newphrase;
}

