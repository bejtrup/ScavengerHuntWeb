<?php

if(isset($_GET['sFunction']))
{    
    $sFunction = $_GET['sFunction'];
    
    switch ($sFunction)
    {
        case "GetTasksInfo":
            require_once '../Controllers/TaskController.php';
            $oTaskController = new TaskController();
            $result = $oTaskController->GetTasksInfo();
            //if(is_array($result)) 
            if(is_array($result))
                {
                    $result = json_encode($result);
                }
            else
                {
                   // $sResult = json_encode($result);
                    $result = "der er sket en fejl - GetTasksInfo";
                }
            echo $result;

        break;
        
        case "GetTasks":
             require_once '../Controllers/TaskController.php';
            $oTaskController = new TaskController();
            $result = $oTaskController->GetTasks();
            //if(is_array($result)) 
            if(is_array($result))
                {
                    $result = json_encode($result);
                }
            else
                {
                   // $sResult = json_encode($result);
                    $result = "der er sket en fejl - GetTasks";
                }
            echo $result;
        break;
        
        case "UpdateInputtasks";
            require_once '../Controllers/TaskController.php';
            $oTaskController = new TaskController();
            $result = $oTaskController->UpdateInputtasks();
            //if(is_array($result)) 
            if($result == true)
                {
                    $result = true; 
                }
            else
                {
                   // $sResult = json_encode($result);
                    $result = "der er sket en fejl - UpdateInputtasks";
                }
            echo $result;
        break;
        
        case "Getpending":
            require_once '../Controllers/TaskController.php';
            $oTaskController = new TaskController();
            $result = $oTaskController->Getpending();
            //if(is_array($result)) 
            if(is_array($result))
                {
                    $result = json_encode($result);
                }
            else
                {
                   // $sResult = json_encode($result);
                    $result = "der er sket en fejl - Getpending";
                }
            echo $result;

        break;
        
        case "saveVote";
            require_once '../Controllers/TaskController.php';
            $oTaskController = new TaskController();
            $result = $oTaskController->saveVote();
            //if(is_array($result)) 
            if($result == true)
                {
                    $result = true; 
                }
            else
                {
                   // $sResult = json_encode($result);
                    $result = false;
                }
            echo $result;
        break;
    }
}
?>
