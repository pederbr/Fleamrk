<?php
session_start();
if($_SESSION["brukerID"]==1){

    $tilkobling = new SQLite3(__DIR__ . '/../resources/db/fleamrk.db');
    $sql = "SELECT * FROM bruker";
    $datasett = $tilkobling->query($sql);

    if (isset($_GET["slett_bruker"])) {
        $sql = sprintf("DELETE FROM bruker WHERE brukerID=%s",
                $tilkobling->escapeString($_GET["slett_bruker"])
                );
        $tilkobling->exec($sql);
    }
    
    $sql2 = "SELECT item.*, merke_navn, brukernavn FROM item, bruker, merke WHERE item.selgerID=bruker.brukerID AND item.merkeID=merke.merkeID;";
    $datasett2 = $tilkobling->query($sql2);

    if (isset($_GET["slett_item"])) {
        $sql2 = sprintf("DELETE FROM item WHERE itemID=%s",
                    $tilkobling->escapeString($_GET["slett_item"])
                    );
        $tilkobling->exec($sql2);
    }
        
} else {
    header("Location:main.php");
}
?>

<!DOCTYPE html>
<html>
<!-- seksjon for metainfo -->

<head>
    <title>Admin</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="../styles/main_style.css" />
    <style>
        #icon-small {
            width: 30px;
            height: 30px;
        }   
    </style>
</head>
<!-- seksjon for hovedinnhold -->

<body>
    <div class="margin">
        <h1>Admin Panel</h1>
    </div>
    <main>
        <article>
            <div id="list_users">
                <h2>Brukere:</h2>
                <?php while ($rad = $datasett->fetchArray(SQLITE3_ASSOC)) { ?>
                <p class="display">
                    BrukerID: <?php echo $rad["brukerID"]; ?>
                    <br>
                    brukernavn: <?php echo $rad["brukernavn"]; ?>
                    <br>
                    email: <?php echo $rad["email"]; ?>
                    <br>
                    create_time: <?php echo $rad["create_time"]; ?>
                    <br>
                    navn: <?php echo $rad["fornavn"] . ' ' .  $rad["etternavn"]; ?>
                    <br>
                    tlf: <?php echo $rad["telefonnummer"]; ?>

                    <a href="?slett_bruker=<?php echo $rad["brukerID"]; ?>">
                        <img src="../styles/website_pictures/delete.png" alt="slett" id="icon-small">
                    </a>
                </p>
                <?php } ?>
            </div>
        </article>
        <article>
            <div id="list_items">
                <h2>Gjenstander:</h2>
                <div class="flex-container">
                    <?php while ($rad = $datasett2->fetchArray(SQLITE3_ASSOC)) { ?>
                    <div class="display">
                        ItemID: <?php echo $rad["itemID"]; ?>
                        <br>
                        selger: <?php echo $rad["brukernavn"]; ?>
                        <br>
                        Navn: <?php echo $rad["navn_item"]; ?>
                        <br>
                        beskrivelse: <?php echo $rad["beskrivelse"]; ?>
                        <br>
                        dato lagt ut: <?php echo $rad["create_time"]; ?>
                        <br>
                        solgt?: <?php echo $rad["solgt"]; ?>
                        <br>
                        pris: <?php echo $rad["pris"]; ?>
                        <br>
                        merke: <?php echo $rad["merke_navn"]; ?>

                        <a href='../includes/slett_gjenstand.php?itemID=<?php echo $rad["itemID"];?>'>
                        <img src="../styles/website_pictures/delete.png" alt="slett" id="icon-small">
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </article>
    </main>
</body>

</html>