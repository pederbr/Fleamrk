<?php
include("top_navbar.php");
$tilkobling = new mysqli("localhost", "root", "", "fleamrk");

$sql2 = "SELECT * FROM merke";
$datasett2 = $tilkobling->query($sql2);

$brukerID = $_SESSION["brukerID"];

if (isset($_POST["submit"])) {
    $navn = $_POST['txtNavn'];
    $beskrivelse = $_POST['txtBeskrivelse'];
    $størrelse = $_POST['txtStørrelse'];
    $pris = $_POST['txtPris'];
    $merke = $_POST['lstMerke'];

    if (empty($navn) || empty($beskrivelse) || empty($størrelse) || empty($pris || empty($merke))) {
        echo 'Fyll inn alle feltene';
    } else {
        $sql = sprintf(
            "INSERT INTO `fleamrk`.`item` 
                            (`navn_item`, `beskrivelse`, `size`, `selgerID`, `solgt`, `pris`, `merkeID`) 
                            VALUES('%s', '%s', '%s', '$brukerID', '0', '%s', '%s')",
            $tilkobling->real_escape_string($_POST["txtNavn"]),
            $tilkobling->real_escape_string($_POST["txtBeskrivelse"]),
            $tilkobling->real_escape_string($_POST["txtStørrelse"]),
            $tilkobling->real_escape_string($_POST["txtPris"]),
            $tilkobling->real_escape_string($_POST["lstMerke"])

        );
        $tilkobling->query($sql);
        print $sql;

        $sql2 = sprintf(
            "SELECT itemID FROM item WHERE navn_item = '%s'",
            $tilkobling->real_escape_string($_POST["txtNavn"])
        );
        $datasett2 = $tilkobling->query($sql2);

        if ($datasett2->num_rows > 0) {
            // output data of each row
            while ($row = $datasett2->fetch_assoc()) {
                $_SESSION["itemID"] = $row["itemID"];
                echo "suksess!";
                echo $_SESSION["itemID"];
                header("Location:last_opp_bilde.php");
            }
        } else {echo "feil i opplasting";}
    }
}




?>


<!DOCTYPE html>
<html>
<!-- seksjon for metainfo -->

<head>
    <title> Sidetittel</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="main_style.css" />
    <link rel="stylesheet" type="text/css" media="print" href="utskrift.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



</head>
<!-- seksjon for hovedinnhold -->

<body>
    <div id="form_wrapper">
        <form id="add" method="post">
            <label for="txtNavn">Navn på produktet:</label>
            <input type="text" name="txtNavn" placeholder="navn" />
            <br>
            <label for="txtBeskrivelse">Beskrivelse:</label>
            <textarea type="text" name="txtBeskrivelse" placeholder="..."> </textarea>
            <br>
            <label for="txtStørrelse">Størrelse:</label>
            <input type="text" name="txtStørrelse" placeholder="størrelse" />
            <br>
            <label for="txtPris">Pris:</label>
            <input type="number" name="txtPris" placeholder="100" />
            <br>
            <label for="lstMerke">Merke:</label>
            <select name="lstMerke">
                <?php while ($rad = mysqli_fetch_array($datasett2)) { ?>
                    <option value="<?php echo $rad["merkeID"]; ?>"> <?php echo $rad["merke_navn"]; ?>
                    </option>}
                <?php } ?>
            </select>
            <p> ser du ikke ditt merke? <a href="nytt_merke.php" target="_blank">lag ditt eget!</a></p>
            <input type="submit" name="submit" value="Legg inn gjenstand">
        </form>

    </div>
    <?php include("footer.html") ?>

</body>

</html>