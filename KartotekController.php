<?php

class KatotekControl {
    public function __construct() {
             require_once 'DatabaseControl.php';
             $Database = new DatabaseKontrol();
             $Database->ConnectDatabase();
     }
     
     
     function AddKartotekUserToKartotek() {
        $sNewUserKartotek = $_GET['sNewUserKartotek'];
        $iUserId = $_SESSION['iUserId'];  
        
       $sCheck1 = "SELECT * FROM kartotek WHERE iUserIdAsk = '$iUserId' AND sKartotekUserEmail = '$sNewUserKartotek'";
       $sCheck2 = mysql_query($sCheck1);
       $sCheck = mysql_num_rows($sCheck2);
       


       if($sCheck == 0) { 
           $iQuery = "SELECT MAX(iKartotekUserId) FROM kartotek";
           $iQuery = mysql_query($iQuery);
           $result = mysql_fetch_array($iQuery);
           $iMaxKartotekUserId = $result['MAX(iKartotekUserId)'] + 1;
           
            $sQuery = "INSERT INTO kartotek VALUES (NULL, '$iUserId', '0', $iMaxKartotekUserId, '$sNewUserKartotek', '0', '1')";
            mysql_query($sQuery);
        }
        else{
           $sQuery2 = " update kartotek SET iKatotekStatus = '1' Where `iUserIdAsk` = '$iUserId' And `iUserIdFriend` ='0' And `sKartotekUserEmail` = '$sNewUserKartotek'  ";        
           mysql_query($sQuery2);  
        }
       return true;
        
    }
    
    function AddUserToKartotek() {
       $sNewUserKartotek = $_GET['sNewUserKartotek'];
       $iUserId = $_SESSION['iUserId'];  
       
       $sQuery = "SELECT * FROM users WHERE sUserEmail = '$sNewUserKartotek'";
       $sQuery1 = mysql_query($sQuery);
       $row = mysql_fetch_array($sQuery1);

       $iUseridReplay =  $row['iUserId']; 

       $sCheck = "SELECT * FROM kartotek WHERE iUseridAsk = '$iUserId' AND iUserIdFriend = '$iUseridReplay'";
       $sCheck = mysql_query($sCheck);
       $sCheck = mysql_num_rows($sCheck);
       
       if($sCheck == 0 && $iUserId != $iUseridReplay) {
       
            $sQuery = "INSERT INTO kartotek VALUES (NULL, '$iUserId', '$iUseridReplay', '0', '0', '0', '1')";
            mysql_query($sQuery);
       }
       else{
           
           $sQuery2 = " update kartotek SET iKatotekStatus = '1' Where `iUserIdAsk` = '$iUserId' And `iUserIdFriend` ='$iUseridReplay' ";        
           mysql_query($sQuery2);  
       }
       return true;
    }
    
    function GetUsersKartotek() {
       $iUserId = $_SESSION['iUserId'];                 
       $i = 0;

       $sQuery = "SELECT * FROM kartotek WHERE iUserIdAsk = '$iUserId' AND iKatotekStatus = '1'";
       $sQuery = mysql_query($sQuery);
       $sCheck = mysql_num_rows($sQuery);

        if($sCheck > 0)
        {
                $aArray = array();
                $aReturnResult = array();
                $i = 0;

                while($aResult = mysql_fetch_array($sQuery))
                {

                    
                       $aReturnResult['sKartotekUserEmail'] = $aResult['sKartotekUserEmail'];
                       $aReturnResult['sKartotekUserName'] = $aResult['sKartotekUserName'];
                       $aReturnResult['iKartotekUserId'] = $aResult['iKartotekUserId'];
                                                                               
                       $iUserIdFriend = $aResult['iUserIdFriend'];
                       $sQuery2 = "SELECT iUserId,sUserFirstname,sUserLastname FROM users WHERE iUserId = '$iUserIdFriend'";
                       $sQuery3 = mysql_query($sQuery2);
                       $aResult2 = mysql_fetch_array($sQuery3);
                   
                       $aReturnResult['iUserId'] = $aResult2['iUserId'];
                       $aReturnResult['sUserFirstname'] = $aResult2['sUserFirstname'];
                       $aReturnResult['sUserLastname'] = $aResult2['sUserLastname'];
                       
                          
                       if($aResult['iUserIdFriend'] == 0){
                           if($aResult['sKartotekUserName'] == '0') {
                               $aReturnResult['SortName'] = ucfirst(preg_replace("/[^a-zA-Z]/", "",$aResult['sKartotekUserEmail']));
                               
                           }
                           else {
                               $aReturnResult['SortName'] = ucfirst($aResult['sKartotekUserName']);
                           }
                       }
                       else {
                           $aReturnResult['SortName'] = ucfirst($aResult2['sUserFirstname']);
                       }
   
                       $aArray[$i] = $aReturnResult;  
                       $i += 1; 
                    
                }

                function compare_lastname($a, $b)
                              {
                return strnatcmp($a['SortName'], $b['SortName']);
                  }

                  // sort alphabetically by name
                  usort($aArray, 'compare_lastname');
                
                
                $aArray['NumberOfUsers'] = $i;
                return $aArray;
        }
        else
        {
            return false;
        }
            
    }
    
    function GetFromKartotekToInvito() {
       $iUserId = $_SESSION['iUserId'];
       $iEventId = $_GET['iEventId'];
        
        $sQuery = "SELECT iUserIdFriend,iKartotekUserId,sKartotekUserEmail,sKartotekUserName FROM kartotek WHERE iKatotekStatus = '1' AND iUserIdAsk = '$iUserId' AND 
                   iUserIdFriend NOT IN (SELECT iUserId FROM eventdeltagere WHERE iEventId ='$iEventId' AND iUserId != 0) AND
                   iKartotekUserId NOT IN (SELECT iKartotekUserId FROM eventdeltagere WHERE iEventId ='$iEventId' AND iKartotekUserId != 0)";
        $sQuery = mysql_query($sQuery);
        $iCheck = mysql_num_rows($sQuery);
                  
        if($iCheck > 0) {
        
               $aArray = array();
               $aReturnResult = array();
               $i = 0;
            
            while ($aResult = mysql_fetch_array($sQuery)) {
                       
                       $iUserIdFriend = $aResult['iUserIdFriend'];
                       
                       $sQuery2 = "SELECT iUserId,sUserFirstname,sUserLastname FROM users WHERE iUserId = '$iUserIdFriend'";
                       $sQuery3 = mysql_query($sQuery2);
                       $aResult2 = mysql_fetch_array($sQuery3);
                   
                       $aReturnResult['iUserId'] = $aResult2['iUserId'];
                       $aReturnResult['sUserFirstname'] = $aResult2['sUserFirstname'];
                       $aReturnResult['sUserLastname'] = $aResult2['sUserLastname'];
                       
                       
                       $aReturnResult['iKartotekUserId'] = $aResult['iKartotekUserId'];
                       $aReturnResult['sKartotekUserEmail'] = $aResult['sKartotekUserEmail'];
                       $aReturnResult['sKartotekUserName'] = $aResult['sKartotekUserName'];
                       
                       
                       if($aResult['iUserIdFriend'] == 0){
                           if($aResult['sKartotekUserName'] == '0') {
                               $aReturnResult['SortName'] = ucfirst(preg_replace("/[^a-zA-Z]/", "",$aResult['sKartotekUserEmail']));
                               
                           }
                           else {
                               $aReturnResult['SortName'] = ucfirst($aResult['sKartotekUserName']);
                           }
                       }
                       else {
                           $aReturnResult['SortName'] = ucfirst($aResult2['sUserFirstname']);
                       }
                   
                       
                       $aArray[$i] = $aReturnResult;  
                       $i += 1; 
            }
                function compare_lastname($a, $b)
                              {
                return strnatcmp($a['SortName'], $b['SortName']);
                  }

                  // sort alphabetically by name
                  usort($aArray, 'compare_lastname');
            
                        
                  $aArray['NumberOfUsers'] = $i;
                  return $aArray;
        }
        else  {
            return false;
        }
    }
    
//    function GetFromKartotekToInvito() {
//       $iUserId = $_SESSION['iUserId'];
//       $iEventId = $_GET['iEventId'];
//       $i = 0;
//           
//       $sQuery = "SELECT iUserId,sUserFirstname,sUserLastname FROM users WHERE iUserId IN (SELECT iUserIdFriend FROM Kartotek WHERE iUserIdFriend NOT IN (SELECT iUserId FROM eventdeltagere WHERE iEventId ='$iEventId') AND iUserIdFriend != '0' AND iUserIdAsk = '$iUserId')";
//       $sQuery = mysql_query($sQuery);
//       $iCheck = mysql_num_rows($sQuery);
//
//
//       $sQuery2 = "SELECT sNoneUserEmail,sNoneUserName FROM kartotek WHERE iUserIdFriend = '0' AND iUserIdAsk = '$iUserId'";
//       $sQuery2 = mysql_query($sQuery2); 
//       $iCheck2 = mysql_num_rows($sQuery2);
//       $aResult2 = mysql_fetch_array($sQuery2);
//       
//       $aResult3 = $aResult + $aResult2;
//       $iCheck3 = $iCheck + $iCheck2;
//
//        if($iCheck > 0)
//        {
//            
//                $aArray = array();
//                $aReturnResult = array();
//                $i = 0;
//
//                while($aResult = mysql_fetch_array($sQuery))
//                {
//
//                       $aReturnResult['iUserId'] = $aResult['iUserId'];
//                       $aReturnResult['sUserFirstname'] = $aResult['sUserFirstname'];
//                       $aReturnResult['sUserLastname'] = $aResult['sUserLastname'];
//                     
//                       
//                       $aArray[$i] = $aReturnResult;  
//                       $i += 1; 
//                    
//                 }
//
// 
////                function compare_lastname($a, $b)
////                              {
////                return strnatcmp($a['sUserFirstname'], $b['sUserFirstname']);
////                  }
////
////                  // sort alphabetically by name
////                  usort($aArray, 'compare_lastname');
//                
////                  
////                  $aArray['NumberOfUsers'] = $i;
////                  return $aArray;
//        }
//        
//        else
//        {
//            return false;
//        }
//    }


//    function AddFromKartotekToInvito() {
//       $iUserId = $_GET['iUserId'];
//       $iEventId = $_GET['iEventId'];
//        
//       $sCheck1 = "SELECT * FROM eventdeltagere WHERE iEventId = '$iEventId' AND iUserId = '$iUserId'";
//       $sCheck2 = mysql_query($sCheck1);
//       $sCheck = mysql_num_rows($sCheck2);
//      
//       if($sCheck == 0) {        
//       
//            $sQuery = "INSERT INTO eventdeltagere VALUES (NULL, '$iEventId', '$iUserId', '0', '0')";
//            mysql_query($sQuery);
//
//            return $iEventId;
//            
//       }
//       else {
//           return false;
//       }
//    } 
    
    function AddFromLoadingtoEvent() {
       
       $iEventId = $_GET['iEventId'];
       $aInvitedUserIds = $_GET['aInvitedUserIds'];

       $str = $aInvitedUserIds;
       $arr1 = preg_split("/[\s,]+/", $str);
      
        
       foreach($arr1 as $value)
            {
           if(strpos($value,'IdKartotekUser') !== false) {
           
            $var = substr($value, 14); 
            
                           
            $sQuery = "INSERT INTO eventdeltagere VALUES (NULL, '$iEventId', '0', '$var', '0', '0')";
            mysql_query($sQuery); 
               
           }
           else {
            
               
            $sQuery = "INSERT INTO eventdeltagere VALUES (NULL, '$iEventId', '$value', '0', '0', '0')";
            mysql_query($sQuery); 
           }
           
           

       }
       

       return $iEventId;
//       
//       $sCheck1 = "SELECT * FROM eventdeltagere WHERE iEventId = '$iEventId' AND iUserId = '$iUserId'";
//       $sCheck2 = mysql_query($sCheck1);
//       $sCheck = mysql_num_rows($sCheck2);
//      
//       if($sCheck == 0) {        
//       
//            $sQuery = "INSERT INTO eventdeltagere VALUES (NULL, '$iEventId', '$iUserId', '0', '0')";
//            mysql_query($sQuery);
//
//            return $iEventId;
//            
//       }
//       else {
//           return false;
//       }
    } 
    
    function UpdateKartokekuserName(){
        
       $iUserID = $_GET['iUserID'];
       $kartotekId = $_GET['KartotekuserId'];
       $KartotekuserName = $_GET['KartotekuserName'];
     
       $sQuery = " update kartotek SET `sKartotekUserName` = '$KartotekuserName' Where `iUserIdAsk` = '$iUserID' And `iKartotekUserId` = '$kartotekId' ";        
       mysql_query($sQuery);

       return true;
       
       
    }
    
    function DeletereKartokekUser(){
        
       $iUserID = $_GET['iUserID'];
       $KartotekUserId = $_GET['KartotekUserId'];
       $iKartotekId = $_GET['iKartotekId'];
      
       if( $KartotekUserId == 0){
       $sQuery = " update kartotek SET iKatotekStatus = '0' Where `iUserIdAsk` = '$iUserID' And `iKartotekUserId` = '$iKartotekId' And `iUserIdFriend` ='$KartotekUserId' ";        
       mysql_query($sQuery);
       }
       else {
       $sQuery = " update kartotek SET iKatotekStatus = '0' Where `iUserIdAsk` = '$iUserID' And `iUserIdFriend` ='$KartotekUserId' ";        
       mysql_query($sQuery);  
       }
       return true;
    } 
}
?>
