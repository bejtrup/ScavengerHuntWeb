<!DOCTYPE html>
<html>
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
        <script type="text/javascript" src="js/general.js"></script>
        <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
    </head>
    <body>
        <h2>Hej.</h2>
        <h1>Scavenger Hunt 2014</h1>
        <h2>vi prøver med en hjemmeside i år</h2>
        <h2>det er her I skal aflevere alle jeres film/og fotos</h2>
        <h3>Skriv jeres hold web-ord her:</h3>
        <input type="text" id="teamWebWord" placeholder="hold web-ord">
        <div class="botton" onclick="teamCodes($('#teamWebWord').val());">let the games begin!</div>

        <div id="holdkode"></div>
    </body>
    <script type="text/javascript">
            window.onload = function() {
                    teamCodes("make");
            }

            function teamCodes(g){
                $(".teamWebWordError").remove();
                var teamCode = {
                    1:"d", 
                    2:"r",
                    3:"...",
                    4:"...",
                    5:"...",
                    6:"...",
                    7:"...",
                    8:".j.",
                    9:".u.",
                    10:"./.",
                    11:"../",
                    12:"/..",
                    13:".t.",
                    14:".k.",
                    15:".o."
                 };
            if( g == "make" ){
                for(var i = 1; i <= 15; i++ ){
                    $("#holdkode").append("<p>Hold"+i+"<i>:</i> "+teamCode[i]+"</p>");
                }
            }
            else {
                $.each(teamCode, function( index, value ) {
                        if( value == g){
                            $(".teamWebWordError").remove();
                            localStorage.setItem("myTeam",index);
                            window.location.href = 'http://bejt.dk/ScavengerHuntWeb/webapp.php';
                            exit;
                        }
                        else {
                            $(".teamWebWordError").remove();
                            $("#teamWebWord").before("<div class='teamWebWordError'>"+g+" kan ikke bruges</div>")
                        }
                    });
                }
                
            }


    </script>
</html>
