<?php
session_start();

$tilkobling = new SQLite3(__DIR__ . '/../resources/db/fleamrk.db');
$sql = "SELECT * FROM bruker";
$datasett = $tilkobling->query($sql);

if (isset($_POST["submit"])) {
    $sql = sprintf(
        "SELECT brukerID FROM bruker WHERE brukernavn = '%s'",
        $tilkobling->escapeString($_POST["txtBrukernavn"])
    );
    $brukersjekk = $tilkobling->query($sql);
    
    if ($brukersjekk->fetchArray(SQLITE3_ASSOC)) {
        echo 'Dette brukernavnet er tatt!';
    } else {
        $txtBrukernavn = $_POST['txtBrukernavn'];
        $txtMail = $_POST['txtMail'];
        $txtFornavn = $_POST['txtFornavn'];
        $txtEtternavn = $_POST['txtEtternavn'];
        $txtTlf = $_POST['txtTlf'];
        if (empty($txtBrukernavn) || empty($txtMail) || empty($txtFornavn) || empty($txtEtternavn) || empty($txtTlf)) {
            echo 'Fyll inn alle feltene';
        } else {
            $passord = password_hash($_POST["txtPassord"], PASSWORD_DEFAULT);
            $sql = sprintf(
                "INSERT INTO bruker (brukernavn, email, passord, fornavn, etternavn, telefonnummer) 
                VALUES ('%s', '%s', '%s', '%s', '%s', '%s')",
                $tilkobling->escapeString($_POST["txtBrukernavn"]),
                $tilkobling->escapeString($_POST["txtMail"]),
                $tilkobling->escapeString($passord),
                $tilkobling->escapeString($_POST["txtFornavn"]),
                $tilkobling->escapeString($_POST["txtEtternavn"]),
                $tilkobling->escapeString($_POST["txtTlf"])
            );
            $tilkobling->exec($sql);

            $sql2 = sprintf(
                "SELECT brukerID FROM bruker WHERE brukernavn = '%s'",
                $tilkobling->escapeString($_POST["txtBrukernavn"])
            );
            $datasett = $tilkobling->query($sql2);

            if ($datasett->fetchArray(SQLITE3_ASSOC)) {
                while ($row = $datasett->fetchArray(SQLITE3_ASSOC)) {
                    $id = $row["brukerID"];
                }
            }

            $_SESSION["brukerID"] = $id;
            $_SESSION["fornavn"] = $_POST["txtFornavn"];
            $_SESSION["etternavn"] = $_POST["txtEtternavn"];

            header("Location:../includes/login.php");
        }
    }
}
?>

<!DOCTYPE html>
<html>
<!-- seksjon for metainfo -->

<head>
    <title> Sidetittel</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="/styles/main_style.css" />
    <link rel="stylesheet" type="text/css" media="print" href="utskrift.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        h2, p {
            margin: 10px;
        }
        main {
            padding: 10px;
        }
    </style>

</head>
<!-- seksjon for hovedinnhold -->

<body>
    <main>
    <h2>Ny bruker:</h2>
    <div id="form_wrapper">
        <form id="add" method="post">
            <br>
            <label for="txtBrukernavn"> Brukernavn:</label>
            <input type="text" name="txtBrukernavn" placeholder="brukernavn" />
            <br>
            <label for="txtMail">E-post adresse:</label>
            <input type="email" name="txtMail" placeholder="ola.nordmann@gmail.com"/>
            <br>
            <label for="txtPassord">Lag passord:</label>
            <input type="password" name="txtPassord" placeholder="********"/>
            <br>
            <label for="txtFornavn">Fullt navn:</label>
            <div id="name_input">
                <input type="text" name="txtFornavn" placeholder="fornavn" />
                <input type="text" name="txtEtternavn" placeholder="etternavn"/>
            </div>
            <br>
            <label for="txtTlf">telefonnummer:</label>
            <input type="tel" name="txtTlf" placeholder="12345678"/>
            <br>
            <input type="submit" name="submit" value="Lag ny bruker">
        </form>
    </div>
    <p>
    har du allerede bruker?
    <a href="/index.php">Logg inn her</a>
    </p>
    </main>
    <?php include(__DIR__ . "/../includes/footer.html")?>
   
</body>

</html>