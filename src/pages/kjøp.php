<?php
session_start();
$tilkobling = new SQLite3('fleamrk.db');

$sql = sprintf(
    "UPDATE item SET solgt = '1' WHERE itemID=%s;",
    $tilkobling->escapeString($_GET["itemID"])
);
$tilkobling->exec($sql);

$sql2 = sprintf(
    "SELECT bruker.*, item.* FROM bruker, item WHERE bruker.brukerID=item.selgerID AND itemID=%s;",
    $tilkobling->escapeString($_GET["itemID"])
);
$datasett2 = $tilkobling->query($sql2);

header("refresh:5;url=main.php");
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
        <?php while ($rad = $datasett2->fetchArray()) { ?>
            
        <h2>ta kontakt med selger på: <?php echo $rad["telefonnummer"]; ?></h2>
        <?php } ?>

    </div>
</body>

</html>