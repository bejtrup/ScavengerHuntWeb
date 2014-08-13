<?php

class DatabaseKontrol
{
    
    public function ConnectDatabase()
    {
       $sHostname = "mydb14.surf-town.net";
//        $sHostname = "212.97.133.214";
       
       $sUserName = "hb94058_bejtrup";
       $sPassword = "David0xb"; 
       $sDataBaseName = "hb94058_invito";                  
	
       $db = mysql_connect($sHostname, $sUserName, $sPassword, true) or die("Unable to connect to the database");    
       mysql_select_db($sDataBaseName, $db);
       
     }
//     public function ConnectDatabase()
//    {
//       $sHostname = "localhost";
//       $sUserName = "root";
//       $sPassword = ""; 
//       $sDataBaseName = "event";                  
//	
//       $db = mysql_connect($sHostname, $sUserName, $sPassword, true) or die("Unable to connect to the database");    
//       mysql_select_db($sDataBaseName, $db);
//     }
}
?>