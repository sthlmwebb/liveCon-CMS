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

include("dbConnectionString.php");

$SaltedKey = "Jonas1AndMartin1HaXXor42£4#1";	

$conn = mysql_connect($mysql_server, $mysql_user, $mysql_password);
mysql_select_db($mysql_database, $conn);

 
 
function db_escape ($post)						
{
   if (get_magic_quotes_gpc()) {
      return $post;
   }
   
   if (is_string($post)) {
     return mysql_real_escape_string($post);
   }
   
   foreach ($post as $key => $val) {
      $post[$key] = is_string($val) ? mysql_real_escape_string($val) : db_escape($val);
   }
   
   return $post;
}
 

function quote_smart($value)
{

   if (get_magic_quotes_gpc()) {
       $value = stripslashes($value);
   }

   if (!is_numeric($value)) {
       $value = "'" . mysql_real_escape_string($value) . "'";
   }
   return $value;
}
?>