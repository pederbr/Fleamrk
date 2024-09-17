<?php
    $tilkobling=mysqli_connect ("localhost","root","", "fleamrk");
    $sql="SELECT item.*, merke_navn, brukernavn, bildenavn FROM item, bruker, merke, bilder
    WHERE item.selgerID=bruker.brukerID AND item.merkeID=merke.merkeID AND 
    bilder.gjenstandID=item.itemID;";
    $datasett = $tilkobling->query($sql);
?>

<!DOCTYPE html>
<html>
<!-- seksjon for metainfo -->

<head>
    <style>

    </style>
    <title> ting_til_salgs</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href=" main_style.css" />
    <link rel="stylesheet" type="text/css" media="print" href="utskrift.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<!-- seksjon for hovedinnhold -->

<body>

    <div id="wrapper_sales">
        <?php while ($rad =mysqli_fetch_array($datasett)) { 
            if($rad["solgt"]==0) {?>
        <div class="display">
            <a href="item.php?itemID=<?php echo $rad["itemID"]; ?>">
                <img src="bilder_gjenstander/<?php echo $rad["bildenavn"]; ?>" alt="<?php echo $rad["bildenavn"]; ?>">
                <h3><?php echo $rad["navn_item"]; ?></h3>
                <h4><?php echo $rad["pris"]; ?> kr</h4>
                <p>selger: <?php echo $rad["brukernavn"]; ?></p>
            </a>
        </div>
        <?php }} ?>
    </div>
</body>

</html>