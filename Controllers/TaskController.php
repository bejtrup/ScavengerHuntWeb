<?php
class TaskController {
    public function __construct() {
             require_once 'DatabaseControl.php';
             $Database = new DatabaseKontrol();
             $Database->ConnectDatabase();
     }
                
    function GetTasksInfo() {
         $TeamNum = $_GET['TeamNum'];
         $teamName = "";
         
         $aArray = array();
         $taskInfo = array();
         $aReturnResult = array();

       // $sQuery =   "select * from `shtasks` T
       //              left join `shstatus` S on T.`taskId` = S.`taskId` and S.teamId = '$TeamNum'
       //              left join `shteams` E on S.`teamId` = E.teamId
       //              ORDER BY `TaskNum`"; 

       $sQuery =   "select * from `shtasks` T
                    left join `shstatus` S on T.`taskId` = S.`taskId` and S.teamId = '$TeamNum'
                    left join `shteams` E on E.teamId = '$TeamNum'
                    ORDER BY `TaskNum`";

       $sQuery = mysql_query($sQuery);
       $sCheck = mysql_num_rows($sQuery);

        if($sCheck > 0)
        {
                $aArray = array();
                $aReturnResult = array();
                $i = 1;
                $P = 0;

                while($aResult = mysql_fetch_array($sQuery))
                {                 
                   $aReturnResult['taskNum'] = $aResult['TaskNum']; 
                   $aReturnResult['beskrivelse'] = $aResult['TaskName'];
                   $aReturnResult['point']= $aResult['TaskPoint'];
                   $aReturnResult['status']= $aResult['status'];
                   $aReturnResult['EksPoint']= $aResult['EksPoint']; 
                   $aReturnResult['Filename']= $aResult['Filename'];
                   $aReturnResult['msg']= $aResult['msg'];
                   $aReturnResult['fileURL']= $aResult['fileURL'];
                         
                   if ( $aResult['teamNum'] != NULL ){ $teamNum = $aResult['teamNum']; }
                   if ( $aResult['teamName'] != NULL ){ $teamName = $aResult['teamName']; }
                   If ( $aResult['status'] == "yes") { $P = $P + $aResult['TaskPoint'] + $aReturnResult['EksPoint']; }
                   
                   $taskInfo[$i] = $aReturnResult;  
                   
                   $i += 1;             
                }
                $aArray['Tasks'] = $taskInfo;
                $aArray['teamNum'] = $teamNum;
                $aArray['teamName'] = $teamName;
                $aArray['teamPoints'] = $P;
                $aArray['result'] = true;
                $aArray['NumberOfUserMadeEvents'] = $i - 1;
                return $aArray;
        }
        else
        {
            return false;
        }
    }
function GetTasks(){
       $sQuery =   "select * from `shtasks`"; 

       $sQuery = mysql_query($sQuery);
       $sCheck = mysql_num_rows($sQuery);

        if($sCheck > 0)
        {
                $aArray = array();
                $aReturnResult = array();
                $Tasks = array();
                $i = 1;

                while($aResult = mysql_fetch_array($sQuery))
                {                 
                   $aReturnResult['TaskNum'] = $aResult['TaskNum']; 
                   $aReturnResult['TaskName'] = $aResult['TaskName'];
                   $aReturnResult['TaskPoint']= $aResult['TaskPoint'];
                   $Tasks[$i] = $aReturnResult;  
                   
                   $i += 1;             
                }
                $aArray["tasks"] = $Tasks;
                $aArray['result'] = true;
                return $aArray;
        }
        else
        {
            return false;
        }
}

function Getpending(){
    
$sQuery =   "SELECT * FROM `shtasks` T
                    LEFT JOIN `shstatus` S ON T.`taskId` = S.`taskId`
                    LEFT JOIN `shteams` E ON S.`teamId` = E.teamId
                    WHERE STATUS = 'pen'
                    ORDER BY `TaskNum`
                    LIMIT 1"; 

       $sQuery = mysql_query($sQuery);
       $sCheck = mysql_num_rows($sQuery);

        if($sCheck > 0)
        {
                $aArray = array();
                $aReturnResult = array();
                $Tasks = array();
                $i = 1;

                while($aResult = mysql_fetch_array($sQuery))
                {                 
                   $aReturnResult['TaskNum'] = $aResult['TaskNum']; 
                   $aReturnResult['TaskName'] = $aResult['TaskName'];
                   $aReturnResult['TaskPoint']= $aResult['TaskPoint'];
                   $aReturnResult['teamNum']= $aResult['teamNum'];
                   $aReturnResult['teamName']= $aResult['teamName'];
                   $aReturnResult['fileURL']= $aResult['fileURL'];
                   
                   $Tasks[$i] = $aReturnResult;  
                   
                   $i += 1;             
                }
                $aArray["tasks"] = $Tasks;
                $aArray['result'] = true;
                return $aArray;
        }
        else
        {
            return false;
        }
}

    function UpdateInputtasks(){
    
        
//        $x=1; 
//        while($x<=100)
//      {
//
//           $sQuery = "INSERT INTO shtasks VALUES (NULL, '$x', '', '')";
//           mysql_query($sQuery);
//           $x++;
//      } 
//            
//        }
        
        //Get the JSON string
        $sJSONMenucards = $_GET['tasksinfo'];
        //Convert the JSON string into an array
        $aJSONMenucards = json_decode($sJSONMenucards);
        
        foreach($aJSONMenucards as  $value) {
            
            $TaskNum =  $value -> {'TaskNum'}  ;
            $TaskName =  $value -> {'TaskName'};
            $TaskPoint =  $value -> {'TaskPoint'};

            $sQuery = " UPDATE shtasks SET `TaskPoint` = '$TaskPoint', TaskName = '$TaskName' WHERE `taskid` = '$TaskNum'  ";        
            mysql_query($sQuery);
            
            
        }
        return true;
    }

    function saveVote(){

            
            $taskStatus =  $_GET['taskStatus'];
            $save =  $_GET['save'];
            $message =  $_GET['message'];
            $extrapoint = $_GET['extrapoint'];
            $teamNum =  $_GET['teamNum'];
            $TaskNum = $_GET['TaskNum'];
            
            //echo "UPDATE shstatus SET `status` = '$taskStatus', EksPoint = '$extrapoint', save = '$save', msg = '$message' WHERE `taskid` = '$TaskNum' AND`teamId` = '$teamNum'";
            
            $sQuery = "UPDATE shstatus SET `status` = '$taskStatus', EksPoint = '$extrapoint', save = '$save', msg = '$message' WHERE `taskid` = '$TaskNum' AND`teamId` = '$teamNum'";        
            mysql_query($sQuery);
        return true;
    }
    
    function setInputtasks(){
        
            $url = $_GET['url'];
            $imgName = $_GET['imgName'];
            $TeamNum = $_GET['TeamNum'];
            $TeamNum = substr($TeamNum, 4);
            $AsignNum = $_GET['AsignNum'];
            $AsignNum = substr($AsignNum, 3);

            
            $sQuery =   "select * from `shstatus` WHERE teamId = '$TeamNum' AND taskId = '$AsignNum' "; 

            $sQuery = mysql_query($sQuery);
            $sCheck = mysql_num_rows($sQuery);

        if($sCheck == 0){            
            
            $sQuery = "INSERT INTO shstatus VALUES (NULL, '$TeamNum', '$AsignNum', 'pen', '0', '$imgName', '', '0', '$url' ) ";        
            mysql_query($sQuery);
            return true;
        }
        else {
            return 'afleveret';
        }
    }
}
?>