<?php

if(isset($_GET['url']))
{    
    $url = $_GET['url'];
    $imgName = $_GET['imgName'];
    $TeamNum= $_GET['TeamNum'];
    $AsignNum = $_GET['AsignNum'];
    
    require_once 'Controllers/TaskController.php';
            $oTaskController = new TaskController();
            $result = $oTaskController->setInputtasks();
            
            if($result == true)
                {
                    $result = "Opgaven er afleveret <a href='http://bejt.dk/ScavengerHuntWeb/webapp.php'>Gå tilbage til opgaverne</a>";
                }
            else if( $result == 'afleveret')
                {
                   // $sResult = json_encode($result);
                    $result = "Opgaven er allerede afleveret - så dette svar er ikke sendt ind <a href='http://bejt.dk/ScavengerHuntWeb/webapp.php'>Gå tilbage til opgaverne</a>";
                }
            else {
                $result = "Der er sket en fejl - <a href='javascript:history.go(0)'>KLIK HER</a>";
            }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, maximum-scale=1.0, minimun-scale=1.0, initial-scale=1.0" />
        <title>succes</title>
        <link rel="stylesheet" type="text/css" href="css/index.css" />
<!--        <link rel="stylesheet" type="text/css" media="only screen and (min-width:50px) and (max-width: 500px)" href="css/index_layout_small.css" />
        <link rel="stylesheet" type="text/css" media="only screen and (min-width:501px) and (max-width: 800px)" href="css/index_layout_medium.css" />-->

        <!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script type="text/javascript" src="js/general.js"></script>
        <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
    </head>
    <body>
        <h1>Du har afleveret <?php echo $AsignNum ?> for <?php echo $TeamNum ?></h1>
        <img  src="<?php echo $url ?>" style="width: 300px;">
        <br>
        <div>
            <?php  echo $result; ?>
        </div>
    </body>
</html>
