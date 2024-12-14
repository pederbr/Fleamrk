<?php
    include(__DIR__ . "/../includes/top_navbar.php");
    $tilkobling = new SQLite3(__DIR__ . '/../resources/db/fleamrk.db');

    $stmt = $tilkobling->prepare(
        "SELECT * FROM bruker WHERE brukerID=:brukerID"
    );
    $stmt->bindValue(':brukerID', $_GET["oppdaterID"], SQLITE3_TEXT);
    $datasett = $stmt->execute();
    
    if (isset($_POST["submit"])){
        while ($rad = $datasett->fetchArray(SQLITE3_ASSOC)) {
            if ($_POST["txtBrukernavn"] != $rad["brukernavn"]) {
                $stmt = $tilkobling->prepare(
                    "SELECT brukerID FROM bruker WHERE brukernavn = :brukernavn"
                );
                $stmt->bindValue(':brukernavn', $_POST["txtBrukernavn"], SQLITE3_TEXT);
                $brukersjekk = $stmt->execute();
    
                if ($brukersjekk->fetchArray(SQLITE3_ASSOC)) {
                    echo 'Dette brukernavnet er tatt!';
                } else {
                    $stmt = $tilkobling->prepare(
                        "UPDATE bruker SET brukernavn=:brukernavn, email=:email, fornavn=:fornavn, etternavn=:etternavn, telefonnummer=:telefonnummer WHERE brukerID=:brukerID"
                    );
                    $stmt->bindValue(':brukernavn', $_POST["txtBrukernavn"], SQLITE3_TEXT);
                    $stmt->bindValue(':email', $_POST["txtMail"], SQLITE3_TEXT);
                    $stmt->bindValue(':fornavn', $_POST["txtFornavn"], SQLITE3_TEXT);
                    $stmt->bindValue(':etternavn', $_POST["txtEtternavn"], SQLITE3_TEXT);
                    $stmt->bindValue(':telefonnummer', $_POST["txtTelefonnummer"], SQLITE3_TEXT);
                    $stmt->bindValue(':brukerID', $_GET["oppdaterID"], SQLITE3_TEXT);
                    $stmt->execute();
                    print $stmt;
                    $_SESSION["fornavn"] = $_POST["txtFornavn"];
                    $_SESSION["etternavn"] = $_POST["txtEtternavn"]; 

                    header("Location:main.php");
                }
            } else {
                $stmt = $tilkobling->prepare(
                    "UPDATE bruker SET brukernavn=:brukernavn, email=:email, fornavn=:fornavn, etternavn=:etternavn, telefonnummer=:telefonnummer WHERE brukerID=:brukerID"
                );
                $stmt->bindValue(':brukernavn', $_POST["txtBrukernavn"], SQLITE3_TEXT);
                $stmt->bindValue(':email', $_POST["txtMail"], SQLITE3_TEXT);
                $stmt->bindValue(':fornavn', $_POST["txtFornavn"], SQLITE3_TEXT);
                $stmt->bindValue(':etternavn', $_POST["txtEtternavn"], SQLITE3_TEXT);
                $stmt->bindValue(':telefonnummer', $_POST["txtTelefonnummer"], SQLITE3_TEXT);
                $stmt->bindValue(':brukerID', $_GET["oppdaterID"], SQLITE3_TEXT);
                $stmt->execute();
                print $stmt;
                $_SESSION["fornavn"] = $_POST["txtFornavn"];
                $_SESSION["etternavn"] = $_POST["txtEtternavn"]; 

                header("Location:main.php");
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/main_style.css" />
    <title>oppdater_info</title>
</head>

<body>
    <main>
    <form method="post">
            <?php if($rad = $datasett->fetchArray(SQLITE3_ASSOC)) { ?>
            <br>
            <label for="txtBrukernavn"> Brukernavn:</label>
            <input type="text" name="txtBrukernavn" value="<?php echo $rad["brukernavn"];?>" />
            <br>
            <label for="txtMail">E-post adresse:</label>
            <input type="email" name="txtMail" value="<?php echo $rad["email"];?>"/>
            <br>
            <label for="txtFornavn">Fullt navn:</label>
            <div id="name_input">
                <input type="text" name="txtFornavn" value="<?php echo $rad["fornavn"];?>" />
                <input type="text" name="txtEtternavn" value="<?php echo $rad["etternavn"];?>"/>
            </div>
            <br>
            <label for="txtTelefonnummer">telefonnummer:</label>
            <input type="tel" name="txtTelefonnummer" value="<?php echo $rad["telefonnummer"];?>" />
            <br>
            <input type="submit" name="submit" value="oppdater bruker">
            <?php } ?>
        </form>
    </main>
    <?php include(__DIR__ . "/../includes/footer.html")?>

</body>

</html>