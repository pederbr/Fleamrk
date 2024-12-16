<?php
    session_start();
    $tilkobling = new SQLite3(__DIR__ . '/../resources/db/fleamrk.db');
    
    $stmt = $tilkobling->prepare(
        "SELECT item.*, bruker.*, merke.*, bilder.* FROM item, bruker, merke, bilder
        WHERE item.selgerID=bruker.brukerID AND item.merkeID=merke.merkeID AND bilder.gjenstandID=item.itemID AND brukerID=:brukerID"
    );
    $stmt->bindValue(':brukerID', $_SESSION["brukerID"], SQLITE3_TEXT);
    $datasett = $stmt->execute();
    
    $stmt2 = $tilkobling->prepare(
        "SELECT item.*, bruker.*, merke.*, bilder.*, favoritt.* FROM item, bruker, merke, bilder, favoritt 
        WHERE item.selgerID=bruker.brukerID AND item.merkeID=merke.merkeID AND bilder.gjenstandID=item.itemID 
        AND favoritt.itemID=item.itemID AND favoritt.brukerID=:brukerID"
    );
    $stmt2->bindValue(':brukerID', $_SESSION["brukerID"], SQLITE3_TEXT);
    $datasett2 = $stmt2->execute();

    $stmt3 = $tilkobling->prepare(
        "SELECT * FROM bruker WHERE brukerID=:brukerID"
    );
    $stmt3->bindValue(':brukerID', $_SESSION["brukerID"], SQLITE3_TEXT);
    $datasett3 = $stmt3->execute();

    /*print $stmt;
    print $stmt2;
    print $stmt3;*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="/styles/main_style.css" />
    <title>min_bruker</title>
    <style>
        article {
            width: 50%;
        }

        main {
            display: flex;
            width: 100%;
            flex-wrap: wrap;
        }

        #om_meg {
            width: 100%;
        }
    </style>
</head>

<body>
        <div id="om_meg">
            <?php while ($rad = $datasett3->fetchArray(SQLITE3_ASSOC)) { ?>
            <h1>om deg</h1>
            <h2>Brukernavn: <?php echo $rad["brukernavn"]; ?></h2>
            <h2> Ditt navn: <?php echo $rad["fornavn"]; ?> <?php echo $rad["etternavn"]; ?></h2>
            <h2>Du lagde profilen din: <?php echo $rad["create_time"]; ?></h2>
            <h2>Ditt telefonnummer: <?php echo $rad["telefonnummer"]; ?></h2>
            <a href="/pages/main.php?page=oppdater_info_bruker">
                <h2>oppdater info</h2>
            </a>
            <?php } ?>
        </div>

        <div class="sepeartion_line" style="width: 100%;"> </div>

        <article>
            <h1>dine gjenstander</h1>
            <div id="wrapper_sales">
                <?php while ($rad = $datasett->fetchArray(SQLITE3_ASSOC)) { 
            if($rad["solgt"]==0) {?>
                <div class="display" style="width: 27%; min-width: 150px;">
                    <a href="item.php?itemID=<?php echo $rad["itemID"]; ?>">
                        <img src="../resources/image_items/<?php echo $rad["bildenavn"]; ?>"
                            alt="<?php echo $rad["bildenavn"]; ?>">
                        <h3><?php echo $rad["navn_item"]; ?></h3>
                        <h4><?php echo $rad["pris"]; ?> kr</h4>
                        <p>selger: <?php echo $rad["brukernavn"]; ?></p>
                    </a>
                </div>
                <?php }} ?>
            </div>
        </article>
        <article>
            <h1>ting du liker</h1>
            <div id="wrapper_sales">
                <?php while ($rad = $datasett2->fetchArray(SQLITE3_ASSOC)) { 
            if($rad["solgt"]==0) {?>
                <div class="display" style="width: 27%; min-width: 150px;">
                    <a href="item.php?itemID=<?php echo $rad["itemID"]; ?>">
                        <img src="../resources/image_items/<?php echo $rad["bildenavn"]; ?>"
                            alt="<?php echo $rad["bildenavn"]; ?>">
                        <h3><?php echo $rad["navn_item"]; ?></h3>
                        <h4><?php echo $rad["pris"]; ?> kr</h4>
                        <p>selger: <?php echo $rad["brukernavn"]; ?></p>
                    </a>
                </div>
                <?php }} ?>
            </div>
        </article>
    </main>
</body>

</html>