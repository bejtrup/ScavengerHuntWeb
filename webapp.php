<?php 
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, maximum-scale=1.0, minimun-scale=1.0, initial-scale=1.0" />
        <title>SHcph13</title>
        <link rel="stylesheet" type="text/css" href="css/index.css" />
<!--        <link rel="stylesheet" type="text/css" media="only screen and (min-width:50px) and (max-width: 500px)" href="css/index_layout_small.css" />
        <link rel="stylesheet" type="text/css" media="only screen and (min-width:501px) and (max-width: 800px)" href="css/index_layout_medium.css" />-->

        <!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script type="text/javascript" src="js/general.js"></script>
        <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
        <script type="text/javascript">
            window.onload = function() {
                    makeTasks();
            }
        </script>
 
</head>
<body>
    <header>
            <div class="outer">
                <img src="Images/logo.svg" style="width: 100%; margin-top: 12px;" />
            </div>
            <div class="middle">
               <h2 id="teamName"></h2>
               <p id="teamNum"></p>
               <h3 id="teamPoints"></h3>
                </div>
            <div class="update" onclick='reloadPage();'>
               <img src="Images/reload.svg" style="width: 100%;" />
            </div>
    </header>
    <div class="menu">
        <a id="emptyStorage" href="#" onclick="emptyStoarage();">nulstil</a>
        <a id="update" href="#" onclick="toggleShowTasks();">Se godkente</a>
    </div>
    <div class="webappbody" id="webappbody"></div>
    <div id="popup" style="display: none;"></div>
</body>
</html>