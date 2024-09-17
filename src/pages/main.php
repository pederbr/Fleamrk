<?php
    $tilkobling=mysqli_connect ("localhost","root","", "fleamrk");

if (isset($_GET["submit"])){
    
$sql= sprintf("SELECT item.*, merke_navn, brukernavn, bildenavn FROM item, bruker, merke, bilder
WHERE item.selgerID=bruker.brukerID AND item.merkeID=merke.merkeID AND 
bilder.gjenstandID=item.itemID AND navn_item LIKE '%%%s%%'", 
$tilkobling->real_escape_string($_GET["txtSokestreng"]));

$datasett = $tilkobling->query($sql);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="main_style.css" />
    <title>main</title>
    <style>
        #hidden {
            width: 0;
            height: 0;
        }
    </style>

</head>

<body>
    <?php 
    include("top_navbar.php");?>
    <main>
        <div class="margin">
            <h1>Ting til salgs</h1>
        </div>
        <form method="get">
            <label for="txtSokestreng"> </label>
            <input type="text" name="txtSokestreng" id="search" placeholder="søk.." />
            <button type="submit" name="submit" id="hidden"> </button>
        </form>
        <div id="wrapper_sales">
            <?php if(isset($datasett)) {
                while ($rad=mysqli_fetch_array($datasett)) {
                    if($rad["solgt"]==0) {?>
                        <div class="display">
                            <a href="item.php?itemID=<?php echo $rad["itemID"]; ?>">
                                <img src="bilder_gjenstander/<?php echo $rad["bildenavn"]; ?>"
                                    alt="<?php echo $rad["bildenavn"]; ?>">
                                <h3><?php echo $rad["navn_item"]; ?></h3>
                                <h4><?php echo $rad["pris"]; ?> kr</h4>
                                <p>selger: <?php echo $rad["brukernavn"]; ?></p>
                            </a>
                        </div>
        <?php }}?> </div>
    <?php }else{include("ting_til_salgs.php");} ?>
    </main>
    <?php include("footer.html")?>

</body>

</html>