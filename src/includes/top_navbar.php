<?php
session_start();
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" media="screen" href="../styles/main_style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar</title>
</head>

<body>
    <nav>
        <div id="float_left">
            <a href="../pages/main.php"><img src="../styles/website_pictures/fleamrk XS.png" alt="fleamrk"></a>
            <?php if(isset($_SESSION["brukerID"])){echo "<a href='../pages/ny_gjenstand.php'>legg ut</a>";}?>
            <a href="../pages/om_oss.php">om oss</a>
            <?php if($_SESSION["brukerID"]==14){echo "<a href='../pages/admin.php'>admin</a>";} ?>
        </div>
        <div id="float_right">
            <?php if(isset($_SESSION["brukerID"])){echo 
            "<a href='../pages/min_bruker.php'> hei " . $_SESSION['fornavn']. "</a>";}
           else{echo "<a href='../pages/index.php'>logg inn</a>"; }?>
        </div>
    </nav>

</body>

</html>