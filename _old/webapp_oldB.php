<?php

if (isset($_POST['upload'])) {
//    echo 'daniel';
    
  $destination = __DIR__ . '/uploaded/';
  if ($_FILES['filemane']['error'] == 0){
      move_uplaoded_file($_FILES['filename']['temp_name'], $destination . $_FILES['filemane']['name']);
  }
}
?>
<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, maximum-scale=1.0, minimun-scale=1.0, initial-scale=1.0" />
        <title>SHcph13</title>
        <link rel="stylesheet" type="text/css" href="css/index.css" />
<!--        <link rel="stylesheet" type="text/css" media="only screen and (min-width:50px) and (max-width: 500px)" href="css/index_layout_small.css" />
        <link rel="stylesheet" type="text/css" media="only screen and (min-width:501px) and (max-width: 800px)" href="css/index_layout_medium.css" />-->

        <!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <!--<script type="text/javascript" src="js/general.js"></script>-->
        <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
    </head>
    <body>
        <header>
            <div>
                <h1>SH14</h1>
            </div>
            <div>
                
                <form action='<?php echo $_SERVER['PHP_SELF'];?>' metode='post' enctype='multipart/form-data' >
                    <input  type='file' name='filename' id='filename' >
                    <!--accept='image/*;capture=camera'-->
                    <input type='submit' name='upload' value='aflever'>
                </form>
                
                
               <h2 id="teamName"></h2>
               <p id="teamNum"></p>
               <h3 id="teamPoints"></h3>
            </div>
        </header>
        <div class="webappbody" id="webappbody"></div>
    </body>
</html>
