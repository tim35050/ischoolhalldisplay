<!DOCTYPE>
<html>
<head>
    <title>iPlasmatron</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"></meta>
    <link rel="stylesheet" type="text/css" href="css/style.css"></link>
    <!-- include jQuery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

    <!-- include Cycle2 -->
    <script src="js/jquery.cycle2.min.js"></script>

</head>
<body>

<?php 

    include 'parser.php';

    echo "<div class=\"cycle-slideshow composite\" 
        data-cycle-fx=\"".$CYCLE_FX."\" 
        data-cycle-slides=\"> div\"
        data-cycle-speed=\"".$CYCLE_SPEED."\"
        data-cycle-timeout=\"".$CYCLE_TIMEOUT."\">";

    echo $slides_combined;

    echo "</div>";
?>
    

</body>
</html>