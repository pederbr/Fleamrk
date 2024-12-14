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
            <?php if(isset($_SESSION["brukerID"])){echo "<a href='../pages/main.php?page=ny_gjenstand'>legg ut</a>";}?>
            <a href="../pages/main.php?page=om_oss">om oss</a>
            <?php if($_SESSION["brukerID"]==1){echo "<a href='../pages/main.php?page=admin'>admin</a>";} ?>
        </div>
        <div id="float_right">
            <?php if(isset($_SESSION["brukerID"])){echo 
            "<a href='../pages/main.php?page=min_bruker'> hei " . $_SESSION['fornavn']. "</a>";}
           else{echo "<a href='../pages/main.php?page=login'>logg inn</a>"; }?>
        </div>
    </nav>

</body>

</html>