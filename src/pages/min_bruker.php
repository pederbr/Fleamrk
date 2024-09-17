<?php
    session_start();
    $tilkobling=mysqli_connect ("localhost","root","", "fleamrk");
    
    $sql=sprintf("SELECT item.*, bruker.*, merke.*, bilder.* FROM item, bruker, merke, bilder
    WHERE item.selgerID=bruker.brukerID AND item.merkeID=merke.merkeID AND bilder.gjenstandID=item.itemID AND brukerID=%s",
    $tilkobling->real_escape_string($_SESSION["brukerID"]));
    $datasett=$tilkobling->query($sql);
    
    $sql2=sprintf("SELECT item.*, bruker.*, merke.*, bilder.*, favoritt.* FROM item, bruker, merke, bilder, favoritt WHERE item.selgerID=bruker.brukerID AND item.merkeID=merke.merkeID AND bilder.gjenstandID=item.itemID AND favoritt.itemID=item.itemID AND  favoritt.brukerID='%s'",
    $tilkobling->real_escape_string($_SESSION["brukerID"]));
    $datasett2=$tilkobling->query($sql2);

    $sql3=sprintf("SELECT * FROM fleamrk.bruker WHERE brukerID='%s'",
    $tilkobling->real_escape_string($_SESSION["brukerID"]));
    $datasett3=$tilkobling->query($sql3);

    /*print $sql;
    print $sql2;
    print $sql3;*/


    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href=" main_style.css" />
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
    <nav>
        <div id="float_left">
            <a href="main.php"><img src="website_pictures\fleamrk XS.png" alt="fleamrk"></a>
            <?php if(isset($_SESSION["brukerID"])){echo "<a href='ny_gjenstand.php'>legg ut</a>";}?>
            <a href="om_oss.php">om oss</a>
            <?php if($_SESSION["brukerID"]==14){echo "<a href='admin.php'>admin</a>";} ?>
        </div>
        <div id="float_right">
            <a href='logout.php'>logg ut</a>
        </div>
    </nav>
    <main>

        <div id="om_meg">
            <?php while ($rad =mysqli_fetch_array($datasett3)) { ?>
            <h1>om deg</h1>
            <h2>Brukernavn: <?php echo $rad["brukernavn"]; ?></h2>
            <h2> Ditt navn: <?php echo $rad["fornavn"]; ?> <?php echo $rad["etternavn"]; ?></h2>
            <h2>Du lagde profilen din: <?php echo $rad["create_time"]; ?></h2>
            <h2>Ditt telefonnummer: <?php echo $rad["telefonnummer"]; ?></h2>
            <a href="oppdater_info_bruker.php?oppdaterID=<?php echo $rad["brukerID"]; ?>">
                <h2>oppdater info</h2>
            </a>
            <?php } ?>
        </div>

        <div class="sepeartion_line" style="width: 100%;"> </div>

        <article>
            <h1>dine gjenstander</h1>
            <div id="wrapper_sales">
                <?php while ($rad =mysqli_fetch_array($datasett)) { 
            if($rad["solgt"]==0) {?>
                <div class="display" style="width: 27%; min-width: 150px;">
                    <a href="item.php?itemID=<?php echo $rad["itemID"]; ?>">
                        <img src="bilder_gjenstander/<?php echo $rad["bildenavn"]; ?>"
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
                <?php while ($rad =mysqli_fetch_array($datasett2)) { 
            if($rad["solgt"]==0) {?>
                <div class="display" style="width: 27%; min-width: 150px;">
                    <a href="item.php?itemID=<?php echo $rad["itemID"]; ?>">
                        <img src="bilder_gjenstander/<?php echo $rad["bildenavn"]; ?>"
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
    <?php include("footer.html")?>

</body>

</html>