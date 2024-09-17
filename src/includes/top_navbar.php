<?php
session_start();
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" media="screen" href="main_style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar</title>
</head>

<body>
    <nav>
        <div id="float_left">
            <a href="main.php"><img src="website_pictures\fleamrk XS.png" alt="fleamrk"></a>
            <?php if(isset($_SESSION["brukerID"])){echo "<a href='ny_gjenstand.php'>legg ut</a>";}?>
            <a href="om_oss.php">om oss</a>
            <?php if($_SESSION["brukerID"]==14){echo "<a href='admin.php'>admin</a>";} ?>
        </div>
        <div id="float_right">
            <?php if(isset($_SESSION["brukerID"])){echo 
            "<a href='min_bruker.php'> hei " . $_SESSION['fornavn']. "</a>";}
           else{echo "<a href='index.php'>logg inn</a>"; }?>
        </div>
    </nav>

</body>

</html>