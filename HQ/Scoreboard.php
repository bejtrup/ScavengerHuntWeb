<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, maximum-scale=1.0, minimun-scale=1.0, initial-scale=1.0" />
        <title>SHcph13HQ</title>
        <link rel="stylesheet" type="../text/css" href="../css/index.css" />
        <link rel="stylesheet" type="../text/css" href="../css/indexHQ.css" />
<!--        <link rel="stylesheet" type="text/css" media="only screen and (min-width:50px) and (max-width: 500px)" href="css/index_layout_small.css" />
        <link rel="stylesheet" type="text/css" media="only screen and (min-width:501px) and (max-width: 800px)" href="css/index_layout_medium.css" />-->

        <!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script type="text/javascript" src="../js/general.js"></script>
        <script type="text/javascript" src="../js/jquery-1.9.1.js"></script>
    </head>
    <body>
        <div class="scoreList"></div>
        <div class="AssWrapper"></div>
        <div class="TeamDivWrapper">
                <div id="scroller-anchor"></div>
                <div class="TeamChartWrapper"></div>
                <div class="TeamDiv"></div>
        </div>
        

        <script type="text/javascript">
            window.onload = function() {
                    makeScorboard();      
                    $('.TeamDivWrapper').on('scroll', function () {
                        $('.AssWrapper').scrollTop($(this).scrollTop());
                    });
                    moveScroller();
                    function moveScroller() {
                        var move = function() {
                            var st = $(window).scrollTop();
                            var ot = $("#scroller-anchor").offset().top;
                            var s = $(".TeamChartWrapper");
                            if(st > ot) {
                                s.css({
                                    position: "fixed",
                                    top: "0px"
                                });
                            } else {
                                if(st <= ot) {
                                    s.css({
                                        position: "relative",
                                        top: ""
                                    });
                                }
                            }
                        };
                        $(".TeamDivWrapper").scroll(move);
                        move();
                    }

            }
        
        </script>
    </body>

</html>