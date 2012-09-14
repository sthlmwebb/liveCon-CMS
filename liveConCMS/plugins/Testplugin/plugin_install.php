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

/* Titel för plugin */
$pluginTitle = "My first plugin";

/* Mappen pluginet kommer ligga under, tex "TestPlugin" om det kommer ligga under liveConCMS/plugins/TestPlugin */
$pluginFolder = "Testplugin";

/* Filen man ska slussas till från modul menyn */
$pluginFile = "myfirstplugin.php";

/*Om pluginet */
$pluginAbout = "Plugin for liveCon CMS";

/*
Ska pluginet lagra information i databasen så måste eventuella tabeller
att skapas i databasen.

Lägg din SQL mellan {..}

Se exemplet nedan. 
*/

if($SQLInstall)
{

/* Koden för att skapa tabellerna i databasen.*/
$sql = "CREATE TABLE IF NOT EXISTS `tbltestplugin` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TextArea` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

/* Använd denna för att köra din sql fråga ovan */
mysql_pluginquery_executer($sql);


/* Laddar in lite data i tabellen vi skapade ovan */
$sql = "INSERT INTO `tbltestplugin` (`ID`, `TextArea`) VALUES
(1, 'Hello world!');";
mysql_pluginquery_executer($sql);

}
?>