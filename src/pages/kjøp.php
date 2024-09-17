<?php
session_start();
$tilkobling=mysqli_connect ("localhost","root","", "fleamrk");

$sql=sprintf("UPDATE `fleamrk`.`item` SET `solgt` = '1' WHERE itemID=%s;",
$tilkobling->real_escape_string($_GET["itemID"]));
$datasett=$tilkobling->query($sql);

$sql2=sprintf("SELECT bruker.*,item.* FROM bruker, item WHERE bruker.brukerID=item.selgerID AND itemID=%s;",
$tilkobling->real_escape_string($_GET["itemID"]));
$datasett2=$tilkobling->query($sql2);

//print $sql2;
header( "refresh:5;url=main.php" );
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        html {
            height: 100%;
        }

        body {
            height: 100%;
        }

        #main_text {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }
        #main_text h1 {
            width: 100%;
            text-align: center;
        }

    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href=" main_style.css" />
    <title>Document</title>
</head>

<body>
    <div id="main_text">
        <h1>Gratulerer med ditt kjøp!</h1>
        <?php while ($rad =mysqli_fetch_array($datasett2)) { ?>
            
        <h2>ta kontakt med selger på: <?php echo $rad["telefonnummer"]; ?></h2>
        <?php } ?>

    </div>
</body>

</html>