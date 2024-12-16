<?php
    $tilkobling = new SQLite3(__DIR__ . '/../resources/db/fleamrk.db');
    
if (isset($_POST["submit"])) {
    $sql = sprintf("INSERT INTO merke (merke_navn, merke_info, merke_link) VALUES('%s', '%s', '%s')",
    $tilkobling->escapeString($_POST["txtNavn"]),
    $tilkobling->escapeString($_POST["txtInfo"]),
    $tilkobling->escapeString($_POST["txtLink"])
    );
    $tilkobling->exec($sql);

    print $sql;
    header("Location:main.php");
}
?>

<!DOCTYPE html>
<html>
<!-- seksjon for metainfo -->

<head>
    <title> Sidetittel</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="/styles/main_style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



</head>
<!-- seksjon for hovedinnhold -->

<body>
    <div id="form_wrapper">
        <form id="add" method="post">
            <label for="txtNavn">Navn:</label>
            <input type="text" name="txtNavn" />
            <br>
            <label for="txtInfo">Info:</label>
            <input type="text" name="txtInfo" />
            <br>
            <label for="txtLink">Link til merkets hjemmeside:</label>
            <input type="text" name="txtLink" />
            <br>
            <input type="submit" name="submit" value="Legg til merke">
        </form>

    </div>
</body>

</html>