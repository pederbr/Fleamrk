<?php
    include(__DIR__ . "/../includes/top_navbar.php");
    $tilkobling = new SQLite3(__DIR__ . '/../resources/db/fleamrk.db');

$stmt = $tilkobling->prepare(
    "SELECT item.*, bruker.*, merke.*, bilder.* FROM item, bruker, merke, bilder
    WHERE item.selgerID=bruker.brukerID AND item.merkeID=merke.merkeID AND bilder.gjenstandID=item.itemID AND itemID=:itemID"
);
$stmt->bindValue(':itemID', $_GET["itemID"], SQLITE3_TEXT);
$datasett = $stmt->execute();

$stmt2 = $tilkobling->prepare(
    "SELECT * FROM favoritt WHERE brukerID=:brukerID AND itemID=:itemID"
);
$stmt2->bindValue(':brukerID', $_SESSION["brukerID"], SQLITE3_TEXT);
$stmt2->bindValue(':itemID', $_GET["itemID"], SQLITE3_TEXT);
$datasett2 = $stmt2->execute();

$stmt3 = $tilkobling->prepare(
    "SELECT count(itemID) AS likes FROM favoritt WHERE itemID=:itemID"
);
$stmt3->bindValue(':itemID', $_GET["itemID"], SQLITE3_TEXT);
$datasett3 = $stmt3->execute();

while ($rad = $datasett2->fetchArray(SQLITE3_ASSOC)) {
    if (isset($rad['brukerID'])) {
        $favoritt = "yes";
    }
}

if (isset($_POST["submit"])) {
    $bruker = $_SESSION["brukerID"];
    $item = $_GET["itemID"];
    $stmt4 = $tilkobling->prepare(
        "INSERT INTO favoritt (itemID, brukerID) VALUES (:itemID, :brukerID)"
    );
    $stmt4->bindValue(':itemID', $item, SQLITE3_TEXT);
    $stmt4->bindValue(':brukerID', $bruker, SQLITE3_TEXT);
    $stmt4->execute();
    header("Refresh:0");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .item_large {
            display: flex;
            width: 80%;
            margin: 20px 10%;
            flex-wrap: wrap;
        }

        .item_large img {
            width: 90%;
            object-fit: cover;
            height: 85%;
            border-radius: 15px;
            border: 2px solid #735B46;
            margin-bottom: 10px;


        }

        .item_large h1 {
            margin-bottom: 10px;
            width: 100%;

        }

        .column {
            width: 50%;
            height: 500px;
        }

        .box_item {
            overflow: auto;
            width: 90%;
            background-color: #F2DCC9;
            margin-bottom: 10px;
            border-radius: 15px;
            padding: 10px;
            border: 2px solid #735B46;

        }

        .item_large p {
            font-size: 1.2rem;
            font-family: serif;

        }

        .item_large h2 {
            font-size: 2.2rem;

        }

        .button_buy {
            display: block;
            text-align: center;
            background-color: #735B46;
            font-size: 2.2rem;
            text-decoration: none;
            color: white;

        }

        .button_buy:hover {
            background-color: #574638;
            color: white;
        }

        #wrapper_button_small {
            display: flex;
        }

        .button_small {
            overflow: hidden;
            padding: 15px 10px;
            margin-right: 10px;
            display: block;
            text-align: center;
            background-color: #735B46;
            font-size: 1.5rem;
            text-decoration: none;
            color: white;
            width: 44%;
        }

        .button_small:hover {
            background-color: #574638;

        }
        #favourite {
            display: inline;
            font-size: 1.5rem;
            font-family: serif;
            height: 100%;
        }

        #favourite:hover {
            background-color: #574638;
        }

        @media screen and (max-width: 500px) {
            .item_large {
                width: 100%;
                margin: 0;
                align-items: center;
                }
            
                .button_small {
                    margin: 0;
                }

            #wrapper_button_small {
                width: 100%;
                align-content: space-between;
                margin-bottom: 10px;
                }

                .item_large img, .box_item,.column {
                width: 100%;
                }
                .column { 
                    height: 100%;
                    margin-bottom: 30px;
                }
        
        }


    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="/styles/main_style.css" />
    <title>item_for_sale</title>
</head>

<body>
    <main>
        <div class="item_large">
        <?php while ($verdi = $datasett->fetchArray(SQLITE3_ASSOC)) {
                if ($verdi['brukerID'] == $_SESSION["brukerID"]) {
                    $min_gjenstand = "yes";
                    }?>
            <h1><?php echo $verdi["navn_item"]; ?></h1>
            <div class="column">
                <img src="bilder_gjenstander/<?php echo $verdi["bildenavn"]; ?>" alt="<?php echo $verdi["bildenavn"]; ?>">
                <div id="wrapper_button_small">
                    <a class="box_item button_small" href="<?php echo $verdi["merke_link"]; ?>"
                        target="_blank"><?php echo $verdi["merke_navn"]; ?></a>
                        <?php if(isset($favoritt)) {
                            echo '<a class="box_item button_small">du liker denne</a>';}
                        else {
                            echo'
                            <form method="post" class="box_item button_small"
                            style="margin-left: 0px; margin-top: 0px; padding: 0px ;">
                            <input type="submit" name="submit" value="favoriser" id="favourite"
                                style="margin: 0px; padding: 0px;">';}?>
                    </form>
                </div>
                <?php while ($row = $datasett3->fetchArray(SQLITE3_ASSOC)) {?>
                <div id="text_likes">
                <p>gjenstanden er likt av <?php echo $row["likes"]; ?> personer</p>
                </div>
                <?php } ?>
            </div>
            <div class="column">
                <div class="box_item">
                    <p>selger: <?php echo $verdi["brukernavn"]; ?></p>
                </div>
                <div class="box_item" style="height: 74%;">
                    <h2><?php echo $verdi["pris"]; ?> kr</h2>
                    <h3><?php echo $verdi["size"]; ?> </h3>
                    <p><?php echo $verdi["beskrivelse"]; ?></p>
                </div>
                <?php if(isset($min_gjenstand)){
                    echo "<a class='box_item button_buy' 
                    href='slett_gjenstand.php?itemID=". $verdi["itemID"]."'> 
                    slett</a>";
                }
                else {
                    echo "<a class='box_item button_buy' 
                    href='kjøp.php?itemID=". $verdi["itemID"]."'> 
                    kjøp</a>";
                }?>
            </div>
        </div>
        </div>
        <?php } ?>
        <div class="sepeartion_line"></div>
        <div class="text_sales">
            <h2>Andre gjenstander til salgs</h2>
        </div>
        <?php include("ting_til_salgs.php")?>
    </main>
    <?php include(__DIR__ . "/../includes/footer.html")?>

</body>

</html>