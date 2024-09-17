<?php
session_start();
if($_SESSION["brukerID"]==14){

    $tilkobling=mysqli_connect ("localhost","root","", "fleamrk");
    $sql="SELECT * FROM bruker";
    $datasett = $tilkobling->query($sql);

    if (isset($_GET["slett_bruker"])){

        $sql=sprintf("DELETE FROM bruker WHERE brukerID=%s",
                $tilkobling->real_escape_string ($_GET["slett_bruker"])
                );
        $tilkobling->query($sql);
    }
    

    $sql2="SELECT item.*, merke_navn, brukernavn FROM item, bruker, merke WHERE item.selgerID=bruker.brukerID AND item.merkeID=merke.merkeID;";
    $datasett2 = $tilkobling->query($sql2);

    if (isset($_GET["slett_item"])){

      $sql2=sprintf("DELETE FROM item WHERE itemID=%s",
                    $tilkobling->real_escape_string ($_GET["slett_item"])
                    );
            $tilkobling->query($sql2);
    }
        
    
}else
{header("Location:main.php");}



?>



<!DOCTYPE html>
<html>
<!-- seksjon for metainfo -->

<head>
    <title> Sidetittel</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="stilarkfil.css" />
    <link rel="stylesheet" type="text/css" media="print" href="utskrift.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        #wrapper {
            display: flex;
            width: 100%;
            flex-wrap: wrap;
        }
        main{
            width: 100%;
            display: flex;
            flex-wrap: wrap;
        }

        .display a img {
            width: 20px;
            color: black;
            float: right;
            padding-left: 2px;
        }

        #list_users,
        #list_items {
            width: 550px;
        }

        #list_users,
        #list_items,
        .display {
            border: solid 2px grey;
            padding: 10px;
        }
        @media screen and (max-width: 500px) {

            #list_users,
        #list_items {
            width: 100%;
        }

        }

    </style>

</head>
<!-- seksjon for hovedinnhold -->

<body>
    <div id="wrapper">
        <header></header>
        <nav> <a href="main.php">home</a> </nav>
        <main>
            <article>
                <div id="list_users">
                    <h2>Brukere:</h2>
                    <?php while ($rad =mysqli_fetch_array($datasett)) { ?>

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
                            <img src="website_pictures\delete.png" alt="slett">
                        </a>
                        <a href="oppdater_info_bruker.php?oppdaterID=<?php echo $rad["brukerID"]; ?>">
                            <img src="website_pictures/uppdate.png" alt="oppdater">
                        </a>

                    </p>
                    <?php } ?>
                </div>
            </article>
            <article>
                <div id="list_items">
                    <h2>Gjenstander:</h2>
                    <?php while ($rad =mysqli_fetch_array($datasett2)) { ?>

                    <p class="display">
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

                        <a href="?slett_item=<?php echo $rad["itemID"];?>">
                            <img src="website_pictures\delete.png" alt="slett">
                        </a>
                    </p>
                    <?php } ?>
                </div>
            </article>
        </main>
    </div>

</body>

</html>